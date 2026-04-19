<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KycRequest;
use App\Models\Country;
use App\Models\SourceOfFund;
use App\Models\File;
use App\Models\KycFile;
use App\Models\KycDetail;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KycController extends Controller
{
    public function index()
    {
        $kyc = auth()->user()->kycDetail;
        $countries = Country::all();
        $sourcesOfFunds = SourceOfFund::all();
        
        return view('admin.kyc.index', compact('kyc', 'countries', 'sourcesOfFunds'));
    }

    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }

    public function saveStep(KycRequest $request)
    {
        $user = auth()->user();
        $step = $request->input('step_number');
        $kycDetail = KycDetail::firstOrNew(['user_id' => $user->id]);

        if (in_array($kycDetail->kyc_status, ['pending', 'approved'])) {
            return response()->json([
                'status' => false,
                'message' => 'Your KYC application is locked and currently under review.'
            ], 403);
        }

        if ($step == 1) {
            $kycDetail->fill($request->except(['_token', 'step_number']));
        }

        if ($step == 2) {
            $kycDetail->id_type = $request->id_type;
            
            if ($request->hasFile('id_front')) {
                $this->handleFileUpload($user->id, $request->file('id_front'), 'id_front');
            }
            if ($request->hasFile('id_back')) {
                $this->handleFileUpload($user->id, $request->file('id_back'), 'id_back');
            }
        }

        if ($step == 3) {
            if ($request->hasFile('selfie')) {
                $this->handleFileUpload($user->id, $request->file('selfie'), 'selfie');
            }
        }

        if ($step == 4) {
            if ($request->hasFile('address_proof')) {
                $this->handleFileUpload($user->id, $request->file('address_proof'), 'address_proof');
            }
        }

        if ($step == 5) {
            $kycDetail->fill($request->only(['bank_account_name', 'bank_name', 'account_number', 'bvn']));
        }

        if ($step == 6) {
            $kycDetail->is_pep = $request->has('is_pep') ? true : false;
            $kycDetail->kyc_status = 'pending';
        }

        // Update progress logically
        if (empty($kycDetail->kyc_step) || $kycDetail->kyc_step < $step) {
            $kycDetail->kyc_step = $step;
        }

        $kycDetail->save();

        return response()->json([
            'status' => true,
            'message' => 'Step '. $step .' saved successfully',
            'step' => $step
        ]);
    }

    private function handleFileUpload($userId, $uploadedFile, $fileName)
    {
        $path = $uploadedFile->store('kyc', 'public');

        $fileRecord = File::create([
            'file_path' => $path,
            'disk' => 'public',
            'mime_type' => $uploadedFile->getMimeType(),
            'original_name' => $uploadedFile->getClientOriginalName()
        ]);

        KycFile::updateOrCreate(
            ['user_id' => $userId, 'file_name' => $fileName],
            ['file_id' => $fileRecord->id]
        );
    }
}
