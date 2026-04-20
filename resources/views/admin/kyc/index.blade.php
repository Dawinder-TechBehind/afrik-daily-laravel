@extends('adminlte::page')

@section('title', 'KYC Verification')

@section('plugins.Select2', true)

@section('content_header')
    <h1>KYC Verification / Profile</h1>
@stop

@section('css')
<style>
    /* Match Select2 to standard AdminLTE inputs */
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
        padding: .375rem .75rem !important;
        border: 1px solid #ced4da !important;
        border-radius: .25rem !important;
        box-shadow: inset 0 0 0 transparent !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding-left: 0 !important;
        color: #495057 !important;
    }
    .select2-container--default.select2-container--disabled .select2-selection--single {
        background-color: #e9ecef !important;
    }
    fieldset:disabled a.btn {
        pointer-events: auto !important;
    }
</style>
@stop

@section('content')

@php
    $isLocked = isset($kyc) && in_array($kyc->kyc_status, ['pending', 'approved']);
    $userFiles = auth()->user()->kycFiles ?? collect();
    $routePrefix = auth()->user()->hasRole('admin') ? 'admin.' : 'investor.';
@endphp

@if(isset($kyc))
    @if($kyc->kyc_status == 'pending')
        <div class="alert alert-warning">
            <h5><i class="icon fas fa-exclamation-triangle"></i> Application Under Review!</h5>
            Your submitted KYC profile is currently under admin review. Form editing is temporarily securely locked.
        </div>
    @elseif($kyc->kyc_status == 'approved')
        <div class="alert alert-success">
            <h5><i class="icon fas fa-check"></i> Application Approved!</h5>
            Your identity has been fully verified. Profile locked to preserve integrity.
        </div>
    @elseif($kyc->kyc_status == 'rejected')
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Application Rejected!</h5>
            There was an issue verifying your submitted identity details. Form editing is unlocked; please review and re-submit your details.
        </div>
    @endif
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="kyc-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab1-tab" data-toggle="pill" href="#tab1" role="tab">1. Personal Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="tab2-tab" data-toggle="pill" href="#tab2" role="tab">2. Identity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="tab3-tab" data-toggle="pill" href="#tab3" role="tab">3. Facial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="tab4-tab" data-toggle="pill" href="#tab4" role="tab">4. Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="tab5-tab" data-toggle="pill" href="#tab5" role="tab">5. Bank & Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="tab6-tab" data-toggle="pill" href="#tab6" role="tab">6. Compliance</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="kyc-tabs-content">
                    
                    <!-- TAB 1: Personal Info -->
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                        <form id="form-step-1" class="kyc-form" novalidate>
                            @csrf
                            <input type="hidden" name="step_number" value="1">
                            <fieldset {{ $isLocked ? 'disabled' : '' }}>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" class="form-control" value="{{ $kyc->full_name ?? auth()->user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ $kyc->email ?? auth()->user()->email }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $kyc->phone ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" value="{{ $kyc->dob ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ isset($kyc) && $kyc->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ isset($kyc) && $kyc->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ isset($kyc) && $kyc->gender == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Nationality</label>
                                    <input type="text" name="nationality" class="form-control" value="{{ $kyc->nationality ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <x-searchable-dropdown name="country_id" id="country_id" :options="$countries" :selected="$kyc->country_id ?? null" placeholder="Search Country..." :required="true" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>State <span class="text-danger">*</span></label>
                                    <x-searchable-dropdown name="state_id" id="state_id" :options="isset($kyc) && $kyc->state ? [$kyc->state] : []" :selected="$kyc->state_id ?? null" placeholder="Search State..." :required="true" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>City <span class="text-danger">*</span></label>
                                    <x-searchable-dropdown name="city_id" id="city_id" :options="isset($kyc) && $kyc->city ? [$kyc->city] : []" :selected="$kyc->city_id ?? null" placeholder="Search City..." :required="true" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control" value="{{ $kyc->postal_code ?? '' }}">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label>Full Address <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" required>{{ $kyc->address ?? '' }}</textarea>
                                </div>
                            </div>
                            <h5 class="mt-4 border-bottom pb-2">Financial Info</h5>
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <label>Occupation <span class="text-danger">*</span></label>
                                    <input type="text" name="occupation" class="form-control" value="{{ $kyc->occupation ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Employer Name</label>
                                    <input type="text" name="employer_name" class="form-control" value="{{ $kyc->employer_name ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Annual Income Range <span class="text-danger">*</span></label>
                                    <input type="text" name="annual_income_range" class="form-control" value="{{ $kyc->annual_income_range ?? '' }}" required placeholder="e.g. $50,000 - $100,000">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Source of Funds <span class="text-danger">*</span></label>
                                    <x-searchable-dropdown name="source_of_funds_id" id="source_of_funds_id" :options="$sourcesOfFunds" :selected="$kyc->source_of_funds_id ?? null" placeholder="Search Source..." :required="true" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Investment Experience <span class="text-danger">*</span></label>
                                    <select name="investment_experience" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="beginner" {{ isset($kyc) && $kyc->investment_experience == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ isset($kyc) && $kyc->investment_experience == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="experienced" {{ isset($kyc) && $kyc->investment_experience == 'experienced' ? 'selected' : '' }}>Experienced</option>
                                    </select>
                                </div>
                            </div>
                            @if(!$isLocked)
                                <button type="submit" class="btn btn-primary float-right mt-3">Save & Continue</button>
                            @endif
                            </fieldset>
                        </form>
                    </div>

                    <!-- TAB 2: Identity -->
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <form id="form-step-2" class="kyc-form" novalidate>
                            @csrf
                            <input type="hidden" name="step_number" value="2">
                            <fieldset {{ $isLocked ? 'disabled' : '' }}>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>ID Type <span class="text-danger">*</span></label>
                                    <select name="id_type" class="form-control" required>
                                        <option value="">Select Document</option>
                                        <option value="national_id" {{ isset($kyc) && $kyc->id_type == 'national_id' ? 'selected' : '' }}>National ID</option>
                                        <option value="passport" {{ isset($kyc) && $kyc->id_type == 'passport' ? 'selected' : '' }}>Passport</option>
                                        <option value="drivers_license" {{ isset($kyc) && $kyc->id_type == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Upload ID Front <span class="text-danger">*</span> <small class="text-muted">(jpg, png, pdf)</small></label>
                                    @if($isLocked)
                                        @php $idFront = $userFiles->where('file_name', 'id_front')->first(); @endphp
                                        @if($idFront)
                                            <div class="mt-2"><a href="{{ $idFront->file->url() }}" target="_blank" class="btn btn-sm btn-info w-100"><i class="fas fa-eye"></i> View Uploaded Image</a></div>
                                        @else
                                            <div class="mt-2 text-muted">No file uploaded</div>
                                        @endif
                                    @else
                                        <input type="file" name="id_front" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" @if(!isset($kyc) || !$kyc->kyc_step) required @endif>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Upload ID Back <small class="text-muted">(optional)</small></label>
                                    @if($isLocked)
                                        @php $idBack = $userFiles->where('file_name', 'id_back')->first(); @endphp
                                        @if($idBack)
                                            <div class="mt-2"><a href="{{ $idBack->file->url() }}" target="_blank" class="btn btn-sm btn-info w-100"><i class="fas fa-eye"></i> View Uploaded Image</a></div>
                                        @else
                                            <div class="mt-2 text-muted">No file uploaded</div>
                                        @endif
                                    @else
                                        <input type="file" name="id_back" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf">
                                    @endif
                                </div>
                            </div>
                            @if(!$isLocked)
                                <button type="submit" class="btn btn-primary float-right mt-3">Save & Continue</button>
                            @endif
                            </fieldset>
                        </form>
                    </div>

                    <!-- TAB 3: Facial -->
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <form id="form-step-3" class="kyc-form" novalidate>
                            @csrf
                            <input type="hidden" name="step_number" value="3">
                            <fieldset {{ $isLocked ? 'disabled' : '' }}>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>Upload Selfie Image <span class="text-danger">*</span> <small class="text-muted">(jpg, png; clear face required)</small></label>
                                    @if($isLocked)
                                        @php $selfie = $userFiles->where('file_name', 'selfie')->first(); @endphp
                                        @if($selfie)
                                            <div class="mt-2"><a href="{{ $selfie->file->url() }}" target="_blank" class="btn btn-sm btn-info w-100"><i class="fas fa-eye"></i> View Uploaded Image</a></div>
                                        @else
                                            <div class="mt-2 text-muted">No file uploaded</div>
                                        @endif
                                    @else
                                        <input type="file" name="selfie" class="form-control-file" accept=".jpg,.jpeg,.png" @if(!isset($kyc) || !$kyc->kyc_step) required @endif>
                                    @endif
                                </div>
                            </div>
                            @if(!$isLocked)
                                <button type="submit" class="btn btn-primary float-right mt-3">Save & Continue</button>
                            @endif
                            </fieldset>
                        </form>
                    </div>

                    <!-- TAB 4: Address -->
                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                        <form id="form-step-4" class="kyc-form" novalidate>
                            @csrf
                            <input type="hidden" name="step_number" value="4">
                            <fieldset {{ $isLocked ? 'disabled' : '' }}>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label>Proof of Address <span class="text-danger">*</span> <small class="text-muted">(Utility bill or bank statement within last 3 months)</small></label>
                                    @if($isLocked)
                                        @php $addressProof = $userFiles->where('file_name', 'address_proof')->first(); @endphp
                                        @if($addressProof)
                                            <div class="mt-2" style="max-width:300px;"><a href="{{ $addressProof->file->url() }}" target="_blank" class="btn btn-sm btn-info w-100"><i class="fas fa-eye"></i> View Uploaded Document</a></div>
                                        @else
                                            <div class="mt-2 text-muted">No file uploaded</div>
                                        @endif
                                    @else
                                        <input type="file" name="address_proof" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" @if(!isset($kyc) || !$kyc->kyc_step) required @endif>
                                    @endif
                                </div>
                            </div>
                            @if(!$isLocked)
                                <button type="submit" class="btn btn-primary float-right mt-3">Save & Continue</button>
                            @endif
                            </fieldset>
                        </form>
                    </div>

                    <!-- TAB 5: Bank -->
                    <div class="tab-pane fade" id="tab5" role="tabpanel">
                        <form id="form-step-5" class="kyc-form" novalidate>
                            @csrf
                            <input type="hidden" name="step_number" value="5">
                            <fieldset {{ $isLocked ? 'disabled' : '' }}>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Bank Account Name <span class="text-danger">*</span></label>
                                    <input type="text" name="bank_account_name" class="form-control" value="{{ $kyc->bank_account_name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Bank Name <span class="text-danger">*</span></label>
                                    <input type="text" name="bank_name" class="form-control" value="{{ $kyc->bank_name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Account Number <span class="text-danger">*</span></label>
                                    <input type="text" name="account_number" class="form-control" value="{{ $kyc->account_number ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>BVN <small class="text-muted">(optional)</small></label>
                                    <input type="text" name="bvn" class="form-control" value="{{ $kyc->bvn ?? '' }}">
                                </div>
                            </div>
                            @if(!$isLocked)
                                <button type="submit" class="btn btn-primary float-right mt-3">Save & Continue</button>
                            @endif
                            </fieldset>
                        </form>
                    </div>

                    <!-- TAB 6: Compliance -->
                    <div class="tab-pane fade" id="tab6" role="tabpanel">
                        <form id="form-step-6" class="kyc-form" novalidate>
                            @csrf
                            <input type="hidden" name="step_number" value="6">
                            <fieldset {{ $isLocked ? 'disabled' : '' }}>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_pep" name="is_pep" value="1" {{ isset($kyc) && $kyc->is_pep ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_pep">I am a Politically Exposed Person (PEP)</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="own_funds" name="own_funds_confirmation" value="1" {{ isset($kyc) && ($kyc->kyc_status != 'draft' || $kyc->kyc_step >= 6) ? 'checked' : '' }} required>
                                        <label class="custom-control-label" for="own_funds">I confirm these are my own funds <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="risk_ack" name="risk_acceptance" value="1" {{ isset($kyc) && ($kyc->kyc_status != 'draft' || $kyc->kyc_step >= 6) ? 'checked' : '' }} required>
                                        <label class="custom-control-label" for="risk_ack">I accept the investment risks <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="terms" name="terms_acceptance" value="1" {{ isset($kyc) && ($kyc->kyc_status != 'draft' || $kyc->kyc_step >= 6) ? 'checked' : '' }} required>
                                        <label class="custom-control-label" for="terms">I accept the Terms and Conditions <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            @if(!$isLocked)
                                <button type="submit" class="btn btn-success float-right mt-3">Finalize & Submit KYC</button>
                            @endif
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        
        // Initialize Select2 integration
        $('.select2').select2({
            theme: 'default', // standard sizing matching AdminLTE logic via custom CSS above
            width: '100%'
        });
        
        // Restore step tabs logically
        let currentStep = {{ $kyc->kyc_step ?? 0 }};
        if(currentStep > 0 && currentStep < 6) {
            let nextTab = currentStep + 1;
            for(let i = 1; i <= nextTab; i++) {
                $('#tab' + i + '-tab').removeClass('disabled');
            }
            $('#tab' + nextTab + '-tab').tab('show');
        } else if (currentStep >= 6) {
             for(let i = 1; i <= 6; i++) {
                $('#tab' + i + '-tab').removeClass('disabled');
            }
        }

        // Dependent Logic
        $('#country_id').change(function() {
            let cid = $(this).val();
            if(cid) {
                $.get('{{ route($routePrefix . "kyc.states") }}', {country_id: cid}, function(data) {
                    $('#state_id').empty().append('<option value="">Select State...</option>');
                    $.each(data, function(index, state) {
                        $('#state_id').append('<option value="'+state.id+'">'+state.name+'</option>');
                    });
                    $('#state_id').trigger('change');
                });
            }
        });

        $('#state_id').change(function() {
            let sid = $(this).val();
            if(sid) {
                $.get('{{ route($routePrefix . "kyc.cities") }}', {state_id: sid}, function(data) {
                    $('#city_id').empty().append('<option value="">Select City...</option>');
                    $.each(data, function(index, city) {
                        $('#city_id').append('<option value="'+city.id+'">'+city.name+'</option>');
                    });
                    $('#city_id').trigger('change');
                });
            }
        });

        // AJAX Request Engine
        $('.kyc-form').on('submit', function(e) {
            e.preventDefault();
            
            let form = $(this);
            let btn = form.find('button[type="submit"]');
            let originalText = btn.html();
            let stepNum = form.find('input[name="step_number"]').val();
            
            form.find('.invalid-feedback').remove();
            form.find('.is-invalid').removeClass('is-invalid');
            
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
            
            let formData = new FormData(this);
            
            $.ajax({
                url: '{{ route($routePrefix . "kyc.save") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    btn.prop('disabled', false).html(originalText);
                    
                    if(response.status) {
                        if (typeof toastr !== 'undefined') toastr.success(response.message);
                        
                        // If it was the final step, dynamically lock screen by reloading
                        if (stepNum == 6) {
                            setTimeout(function(){ window.location.reload(); }, 1500);
                            return;
                        }

                        let returnedStep = parseInt(response.step);
                        let nextStep = returnedStep + 1;
                        
                        if(nextStep <= 6) {
                            $('#tab' + nextStep + '-tab').removeClass('disabled');
                            $('#tab' + nextStep + '-tab').tab('show');
                        }
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalText);
                    if(xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            let input = form.find('[name="'+field+'"]');
                            if(input.length) {
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback" style="display:block;">'+messages[0]+'</div>');
                            }
                        });
                        if (typeof toastr !== 'undefined') toastr.error('Please check the form for errors.');
                    } else if (xhr.status === 403) {
                         if (typeof toastr !== 'undefined') toastr.error(xhr.responseJSON.message);
                    } else {
                        if (typeof toastr !== 'undefined') toastr.error('An error occurred. Please try again.');
                    }
                }
            });
        });
    });
</script>
@stop
