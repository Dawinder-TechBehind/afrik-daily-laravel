<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kyc_details', function (Blueprint $table) {
            $table->dropColumn(['own_funds_confirmation', 'risk_acceptance', 'terms_acceptance']);
        });
    }

    public function down(): void
    {
        Schema::table('kyc_details', function (Blueprint $table) {
            $table->boolean('own_funds_confirmation')->default(false);
            $table->boolean('risk_acceptance')->default(false);
            $table->boolean('terms_acceptance')->default(false);
        });
    }
};
