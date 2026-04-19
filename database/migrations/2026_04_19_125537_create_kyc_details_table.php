<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kyc_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
            $table->string('postal_code')->nullable();
            
            $table->string('occupation')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('annual_income_range')->nullable();
            $table->foreignId('source_of_funds_id')->nullable()->constrained()->nullOnDelete();
            $table->string('investment_experience')->nullable();
            
            $table->string('id_type')->nullable();
            
            $table->string('bank_account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bvn')->nullable();
            
            $table->boolean('is_pep')->default(false);
            $table->boolean('own_funds_confirmation')->default(false);
            $table->boolean('risk_acceptance')->default(false);
            $table->boolean('terms_acceptance')->default(false);
            
            $table->tinyInteger('kyc_step')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kyc_details');
    }
};
