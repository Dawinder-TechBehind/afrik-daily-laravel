<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class ImportLocationData extends Command
{
    protected $signature = 'app:import-location-data';
    protected $description = 'Import countries, states, and cities from dr5hn remote JSON.';

    public function handle()
    {
        ini_set('memory_limit', '2G'); // Expand limit for large array parsing
        
        $url = 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/refs/heads/master/json/countries%2Bstates%2Bcities.json';
        $this->info("Downloading location data from repository...");

        // Download locally to handle easily
        $tempPath = storage_path('app/temp_locations.json');
        file_put_contents($tempPath, fopen($url, 'r'));

        $this->info("Parsing JSON payload...");
        $jsonContent = file_get_contents($tempPath);
        $data = json_decode($jsonContent, true);

        if (!$data) {
            $this->error("Failed to parse JSON file.");
            @unlink($tempPath);
            return;
        }

        $this->info(count($data) . " countries found. Seeding...");
        
        $this->withProgressBar($data, function ($countryData) {
            DB::transaction(function () use ($countryData) {
                // Determine ISO code cleanly
                $iso = $countryData['iso2'] ?? substr($countryData['name'], 0, 2);
                
                $country = Country::firstOrCreate(
                    ['name' => $countryData['name']],
                    ['code' => $iso]
                );

                if (isset($countryData['states']) && is_array($countryData['states'])) {
                    foreach ($countryData['states'] as $stateData) {
                        $state = State::firstOrCreate(
                            [
                                'country_id' => $country->id,
                                'name' => $stateData['name']
                            ]
                        );

                        if (isset($stateData['cities']) && is_array($stateData['cities'])) {
                            
                            // Optimization: Check duplication to skip massive inserts
                            if ($state->cities()->exists()) {
                                continue;
                            }

                            $cityInserts = [];
                            foreach ($stateData['cities'] as $cityData) {
                                $cityInserts[] = [
                                    'state_id' => $state->id,
                                    'name' => $cityData['name'],
                                ];
                            }
                            
                            foreach (array_chunk($cityInserts, 500) as $chunk) {
                                City::insertOrIgnore($chunk);
                            }
                        }
                    }
                }
            });
        });

        $this->newLine();
        $this->info("Location data successfully populated!");
        @unlink($tempPath);
    }
}
