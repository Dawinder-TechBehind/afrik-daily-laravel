<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kyc_details', function (Blueprint $table) {
            $table->enum('kyc_status', ['draft', 'pending', 'approved', 'rejected'])->default('draft')->after('kyc_step');
        });
    }

    public function down(): void
    {
        Schema::table('kyc_details', function (Blueprint $table) {
            $table->dropColumn('kyc_status');
        });
    }
};
