<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KycRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $step = $this->input('step_number');
        $kycDetail = auth()->user()->kycDetail;

        if ($step == 1) {
            return [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:kyc_details,email,' . optional($kycDetail)->id,
                'phone' => 'nullable|string|max:20',
                'dob' => 'nullable|date',
                'gender' => 'nullable|in:male,female,other',
                'nationality' => 'nullable|string|max:255',
                'address' => 'required|string',
                'country_id' => 'required|exists:countries,id',
                'state_id' => 'required|exists:states,id',
                'city_id' => 'required|exists:cities,id',
                'postal_code' => 'nullable|string|max:20',
                
                'occupation' => 'required|string|max:255',
                'employer_name' => 'nullable|string|max:255',
                'annual_income_range' => 'required|string|max:255',
                'source_of_funds_id' => 'required|exists:source_of_funds,id',
                'investment_experience' => 'required|in:beginner,intermediate,experienced',
            ];
        }

        if ($step == 2) {
            return [
                'id_type' => 'required|in:national_id,passport,drivers_license',
                'id_front' => 'required|file|mimes:jpg,png,pdf|max:2048',
                'id_back' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            ];
        }

        if ($step == 3) {
            return [
                'selfie' => 'required|file|mimes:jpg,png|max:2048',
            ];
        }

        if ($step == 4) {
            return [
                'address_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
            ];
        }

        if ($step == 5) {
            return [
                'bank_account_name' => 'required|string|max:255',
                'bank_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:50',
                'bvn' => 'nullable|string|max:20',
            ];
        }

        if ($step == 6) {
            return [
                'is_pep' => 'nullable',
                'own_funds_confirmation' => 'required|accepted',
                'risk_acceptance' => 'required|accepted',
                'terms_acceptance' => 'required|accepted',
            ];
        }

        return [];
    }
}
