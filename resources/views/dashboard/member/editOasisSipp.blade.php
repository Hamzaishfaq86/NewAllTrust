@extends('dashboard.dashboard')

@section('content')
    <div class="position-relative">
        @if(session('success'))
            <div class="alert alert-success position-absolute w-75 z-5 right-0 alert-dismissible fade show" style="top: 20px;" role="alert" id="successAlert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error')) <!-- Check for an error session -->
        <div class="alert alert-danger position-absolute w-75 z-5 right-0 alert-dismissible fade show" style="top: 20px;" role="alert" id="errorAlert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <script>
            // Function to remove alert after 6 seconds
            setTimeout(() => {
                const alertElement = document.getElementById('successAlert') || document.getElementById('errorAlert'); // Check both alerts
                if (alertElement) {
                    alertElement.classList.remove('show');
                    setTimeout(() => alertElement.remove(), 200);
                }
            }, 6000);
        </script>
    </div>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row ">

            <!-- Multi Steps Registration -->
            <div class="d-flex col-12 align-items-center justify-content-center authentication-bg p-5">
                <div class="col-10">
                    <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
                        <div class="bs-stepper-content px-0">

                            <form id="multiStepsForm" method="POST" enctype="multipart/form-data" action="{{ route('members.oasis.update') }}">
                                @csrf
                                <input type="hidden" name="member_id" value="{{ $editMember->id }}">
                                <!-- Adviser Details -->
                                <div id="adviserDetails" class="content" style="display: block;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Applications</h4>
                                      
                                    </div>
                                    <div class="row g-6">

                                        {{-- ============================  ====================== ==============================--}}
                                        {{-- ============================   Application multiform  start    ====================--}}


                                        <!-- Content -->
                                        <div class="authentication-wrapper authentication-cover authentication-bg">
                                            <div class="authentication-inner row">
                                                <!-- Multi Steps Registration -->
                                                <div class="d-flex col-12 align-items-center justify-content-center authentication-bg p-5">
                                                    <div class="col-10">
                                                        <div id="multiStepValidation" class="bs-stepper border-none shadow-none mt-5">
                                                            <div class="bs-stepper-content px-0">

                                                                <!-- Step 1: Adviser Details -->
                                                                <div id="stepPersonal" class="form-step" style="display: block;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-4">Personal Details</h4>
                                                                    </div>
                                                                    <div class="row g-10 mt-3">
                                                                      
                                                                        
                                                                
                                                                        <!-- Title -->
                                                                        <!--<div class="row">-->
                                                                        <!--    <div class="form-group col-md-12 mb-3 mt-5">-->
                                                                        <!--        <label for="role">Selected Member</label>-->
                                                                        <!--        <select class="form-control" id="title" name="role" readonly>-->
                                                                        <!--            @foreach($memberOasis as $mem)-->
                                                                        <!--                <option value="{{ $mem->id }}">{{ $mem->name }}</option> <!-- Display each user's name -->
                                                                        <!--            @endforeach-->
                                                                        <!--        </select>-->
                                                                        <!--    </div>-->
                                                                        <!--</div>-->

                                                                        <div class="row">
                                                                            <!-- Forename -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="forename">Forename</label>
                                                                                <input type="text" class="form-control" id="forename" name="forename" value="{{@$editMember->forename}}" placeholder="Forename">
                                                                            </div>

                                                                            <!-- Surname -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="surname">Surname</label>
                                                                                <input type="text" class="form-control" id="surname" name="surname" value="{{@$editMember->surname}}" placeholder="Surname">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Permanent Residential Address -->
                                                                        <div class="row">
                                                                            <div class=" col-6 form-group mb-3">
                                                                                <label for="address">Permanent Residential Address</label>
                                                                                <input type="text" class="form-control" id="address" name="address" value="{{@$editMember->address}}" placeholder="Enter Address">
                                                                            </div>

                                                                            <!-- Country and Postcode -->

                                                                            <div class="col-md-6">
                                                                                <label for="country">Country</label>
                                                                                <input type="text" class="form-control" id="country" name="country" value="{{@$editMember->country}}" placeholder="Country">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="postcode">Postcode</label>
                                                                                <input type="text" class="form-control" id="postcode" name="postcode" value="{{@$editMember->postcode}}" placeholder="Postcode">
                                                                            </div>
                                                                            <div class="col-6 form-group mb-3">
                                                                                <label for="telephone">Telephone Number (inc. Area Code)</label>
                                                                                <input type="tel" class="form-control" id="telephone" name="telephone" value="{{@$editMember->telephone}}" placeholder="Enter Telephone Number">
                                                                            </div>

                                                                        </div>



                                                                        <!-- Telephone Number -->
                                                                        <div class="row">

                                                                            <!-- Email Address -->
                                                                            <div class="form-group mb-3">
                                                                                <label for="email">Email Address</label>
                                                                                <input type="email" class="form-control" id="email" value="{{@$editMember->email}}" name="email" placeholder="Enter Email">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Gender</label><br>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male"
                                                                                        {{ (old('gender', json_decode(@$editMember->gender)) == 'Male') ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="genderMale">Male</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female"
                                                                                        {{ (old('gender', json_decode(@$editMember->gender)) == 'Female') ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="genderFemale">Female</label>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row d-flex">
                                                                            <!-- Gender -->

                                                                            <div class="col-6 form-group mb-3">
                                                                                <label for="nationality">Nationality/Citizenship</label>
                                                                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{@$editMember->nationality}}" placeholder="Enter Nationality/Citizenship">
                                                                            </div>
                                                                            <div class=" col-6 form-group mb-3">
                                                                                <label for="dob">Date of Birth</label>
                                                                                <input type="date" class="form-control" id="dob" name="dob" value="{{@$editMember->dob}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Date of Birth -->
                                                                        <div class=" d-flex">
                                                                            <!-- Marital Status -->
                                                                            <div class="form-group mb-3">
                                                                                <label>Marital Status</label><br>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="marital_status" id="statusSingle" {{ (old('marital_status', json_decode($editMember->marital_status)) == 'Single') ? 'checked' : '' }} value="Single">
                                                                                    <label class="form-check-label" for="statusSingle">Single</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="maritalStatus" id="statusMarried" {{ (old('marital_status', json_decode($editMember->marital_status)) == 'Married/Civil Partnership') ? 'checked' : '' }} value="Married/Civil Partnership">
                                                                                    <label class="form-check-label" for="statusMarried">Married/Civil Partnership</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-12 form-group mb-3">
                                                                                <label for="spouse_dob">Spouse's/Civil Partner's Date of Birth</label>
                                                                                <input type="date" class="form-control" id="spouse_dob" name="spouse_dob" placeholder="mm/dd/yyyy" value="{{@$editMember->spouse_dob}}">
                                                                            </div>
                                                                        </div>


                                                                        <div class="form-group mb-3">
                                                                            <label>Is there a pension sharing or pension earmarking order in place?</label><br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="pension_order" id="pensionYes" value="Yes" {{ ($editMember->pension_order == 'Yes') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="pensionYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="pension_order" id="pensionNo" value="No" {{ ($editMember->pension_order == 'No') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="pensionNo">No</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Occupation -->
                                                                        <div class="row">
                                                                            <div class=" col-12 form-group mb-3">
                                                                                <label for="occupation">Occupation</label>
                                                                                <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter your occupation" value="{{@$editMember->occupation}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Employment Status -->
                                                                        <div class="form-group mb-3">
                                                                            <label>What is your employment status?</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="employment_status" id="employed" value="Employed" {{ ($editMember->employment_status == 'Employed') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="employed">Employed</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Opted Out of Pension Arrangement -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Have you opted out of any occupational or employer-sponsored pension arrangement in favour of this pension arrangement?</label><br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opt_out" id="optOutYes" value="Yes" {{ ($editMember->opt_out == 'Yes') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="optOutYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opt_out" id="optOutNo" value="No" {{ ($editMember->opt_out == 'No') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="optOutNo">No</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Pension Protection -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Do you have protection of existing pension rights with HM Revenue & Customs?</label><br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="pension_protection" id="protectionYes" value="Yes" {{ ($editMember->pension_protection == 'Yes') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="protectionYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="pension_protection" id="protectionNo" value="No" {{ ($editMember->pension_protection == 'No') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="protectionNo">No</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Protection Types -->
                                                                        <div class="form-group mb-3">
                                                                            <label>If Yes, please confirm which of the following boxes are applicable:</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" id="enhanced_protection" name="protection_type[]" value="Enhanced Protection"
                                                                                    {{ (is_array(old('protection_type', json_decode($editMember->protection_type))) && in_array('Enhanced Protection', old('protection_type', json_decode($editMember->protection_type)))) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="enhanced_protection">Enhanced Protection</label>
                                                                            </div>
                                                                        </div>


                                                                        <!-- Annual Allowance -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Are you subject to the money purchase annual allowance?</label><br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="annual_allowance" id="allowanceYes" value="Yes" {{ ($editMember->annual_allowance == 'Yes') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="allowanceYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="annual_allowance" id="allowanceNo" value="No" {{ ($editMember->annual_allowance == 'No') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="allowanceNo">No</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- First Payment Date -->
                                                                        <div class="row">
                                                                            <div class="form-group mb-3">
                                                                                <label>If Yes, please confirm the date the first payment occurred</label>
                                                                                <input type="date" class="form-control" id="first_payment_date" name="first_payment_date" value="{{@$editMember->first_payment_date}}">
                                                                            </div>

                                                                        </div>
                                                                        {{-- ============= ================= ========================= ==--}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary" disabled>
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 2: Fee & Commission -->
                                                                <div id="stepFeeCommission" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Tax Relief Benefits</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        {{-- ==========================================================================                         ----}}

                                                                        <h4>Entitlement to Tax Relief</h4>
                                                                        <p>Please tick one box only:</p>

                                                                        <!-- Entitlement to Tax Relief options -->
                                                                        <div class="form-group">
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option1" {{ (old('tax_relief', $editMember->tax_relief) == 'option1') ? 'checked' : '' }} value="option1">
                                                                                <label class="form-check-label" for="option1">
                                                                                    I have relevant UK earnings chargeable to UK income tax, and I have been resident in the UK some time during the current tax year.
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option2" {{ (old('tax_relief', $editMember->tax_relief) == 'option2') ? 'checked' : '' }} value="option2">
                                                                                <label class="form-check-label" for="option2">
                                                                                    I have general earnings from overseas Crown employment subject to UK tax in the current tax year.
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option3" {{ (old('tax_relief', $editMember->tax_relief) == 'option3') ? 'checked' : '' }} value="option3">
                                                                                <label class="form-check-label" for="option3">
                                                                                    My spouse/civil partner has general earnings from overseas Crown employment subject to UK tax in the current tax year.
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option4" {{ (old('tax_relief', $editMember->tax_relief) == 'option4') ? 'checked' : '' }} value="option4">
                                                                                <label class="form-check-label" for="option4">
                                                                                    I am not resident in the UK in the current tax year, but I was resident in the UK at some time during the five tax years immediately before the tax year in question, and I was resident in the UK when I joined the pension scheme, and I have relevant UK earnings chargeable to UK income tax.
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option5" {{ (old('tax_relief', $editMember->tax_relief) == 'option5') ? 'checked' : '' }} value="option5">
                                                                                <label class="form-check-label" for="option5">
                                                                                    I have no relevant UK earnings chargeable to income tax, but I have been resident in the UK some time during the current tax year.
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option6" {{ (old('tax_relief', $editMember->tax_relief) == 'option6') ? 'checked' : '' }} value="option6">
                                                                                <label class="form-check-label" for="option6">
                                                                                    I or my spouse/civil partner are in overseas Crown employment but do not have general earnings subject to UK tax in the current tax year.
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option7" {{ (old('tax_relief', $editMember->tax_relief) == 'option7') ? 'checked' : '' }} value="option7">
                                                                                <label class="form-check-label" for="option7">
                                                                                    I cannot tick any of the above, but I was resident in the UK, or had earnings chargeable to UK income tax, at some time during the five years immediately before the tax year in question, and I was resident in the UK when I joined the SIPP.
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input" type="radio" name="tax_relief" id="option8" {{ (old('tax_relief', $editMember->tax_relief) == 'option8') ? 'checked' : '' }} value="option8">
                                                                                <label class="form-check-label" for="option8">
                                                                                    I cannot tick any of the above.
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        {{-- ==========================================================================                         ----}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 3: Investment Strategy -->
                                                                <div id="stepInvestmentStrategy" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Contributions</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        {{-- =================================================================            --}}

                                                                        <h4>Personal Contributions (net)</h4>

                                                                        <!-- Regular Contribution -->
                                                                        <div class="row">
                                                                            <div class="col-6 form-group mb-3">
                                                                                <label for="contribute_regular_contribution">Regular Contribution</label>
                                                                                <input type="text" class="form-control" id="contribute_regular_contribution" name="contribute_regular_contribution" value="{{@$editMember->contribute_regular_contribution}}" placeholder="Enter amount">
                                                                            </div>

                                                                            <!-- Single Contribution -->
                                                                            <div class="col-6 form-group mb-3">
                                                                                <label for="contribute_single_contribution">Single Contribution</label>
                                                                                <input type="text" class="form-control" id="contribute_single_contribution" name="contribute_single_contribution" value="{{@$editMember->contribute_single_contribution}}" placeholder="Enter amount">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Regular Contribution Payment Frequency -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Regular Contribution Payment Frequency</label><br>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="payment_frequency" id="monthly_payment_frequency" value="Monthly"
                                                                                    {{ (@$editMember->payment_frequency == 'Monthly') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="monthly">Monthly</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="payment_frequency" id="quarterly_payment_frequency" value="Quarterly"
                                                                                    {{ (@$editMember->payment_frequency == 'Quarterly') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="quarterly">Quarterly</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="payment_frequency" id="half_yearly_payment_frequency" value="Half-yearly"
                                                                                    {{ (@$editMember->payment_frequency == 'Half-yearly') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="half_yearly">Half-yearly</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="payment_frequency" id="yearly" value="Yearly"
                                                                                    {{ (@$editMember->payment_frequency == 'Yearly') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="yearly">Yearly</label>
                                                                            </div>

                                                                        </div>


                                                                        <!-- Start Date for Regular Contributions -->
                                                                        <div class="row">
                                                                            <div class=" col-12 form-group mb-3">
                                                                                <label for="start_date">Start Date for Regular Contributions</label>
                                                                                <input type="date" class="form-control" id="start_date" placeholder="mm/dd/yyyy" name="start_date" value="{{@$editMember->start_date}}">

                                                                            </div>
                                                                        </div>

                                                                        <!-- Will your employer pay your personal contributions on your behalf? -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Will your employer pay your personal contributions on your behalf?</label><br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="employer_pay" id="employerYes" value="Yes" {{ (old('employer_pay', $editMember->employer_pay) == 'Yes') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="employerYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="employer_pay" id="employerNo" value="No" {{ (old('employer_pay', $editMember->employer_pay) == 'No') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="employerNo">No</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Instruction for Employer Details -->
                                                                        <div class="alert alert-info mt-3">
                                                                            If YES, the employer details section of this form must be completed.
                                                                        </div>


                                                                        {{-- =================================================================            --}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 4: Bank Details -->
                                                                <div id="stepBankDetails" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Employer Details</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        {{-- ============================                     --}}
                                                                       
                                                                        <p>Please complete this section if your employer will be contributing to your SIPP or paying your personal contributions on your behalf.</p>

                                                                        <div class="row">
                                                                            <!-- Employer Name -->
                                                                            <div class="form-group mb-3 col-6">
                                                                                <label for="employer_name">Name</label>
                                                                                <input type="text" class="form-control" id="employer_name" name="employer_name" placeholder="Enter employer name" value="{{@$editMember->employer_name}}">
                                                                            </div>

                                                                            <!-- Registered Office -->
                                                                            <div class="col-md-6  form-group mb-3">
                                                                                <label for="registered_office">Registered Office (if applicable)</label>
                                                                                <input type="text" class="form-control" id="registered_office" name="registered_office" placeholder="Enter registered office" value="{{@$editMember->registered_office}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Postcode -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="employee_postcode">Postcode</label>
                                                                                <input type="text" class="form-control" id="employee_postcode" name="employee_postcode" placeholder="Enter postcode" value="{{@$editMember->employee_postcode}}">
                                                                            </div>

                                                                            <!-- Telephone Number -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="telephone_number">Telephone Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control" id="telephone_number" name="telephone_number" placeholder="Enter telephone number" value="{{@$editMember->telephone_number}}"">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Contact Name -->
                                                                        <div class=" row">
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="employee_contact_name">Contact Name</label>
                                                                                <input type="text" class="form-control" id="employee_contact_name" name="employee_contact_name" placeholder="Enter contact name" value="{{@$editMember->employee_contact_name}}">
                                                                            </div>

                                                                            <!-- Email Address -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="email_address">Email Address</label>
                                                                                <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Enter email address" value="{{@$editMember->email_address}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Trading Address -->
                                                                            <div class="form-group mb-3 col-md-6">
                                                                                <label for="trading_address">Trading Address (if different from above)</label>
                                                                                <input type="text" class="form-control" id="trading_address" name="trading_address" placeholder="Enter trading address" value="{{@$editMember->trading_address}}">
                                                                            </div>

                                                                            <!-- Trading Postcode -->
                                                                            <div class="form-group mb-3 col-md-6">
                                                                                <label for="trading_postcode">Postcode (for Trading Address)</label>
                                                                                <input type="text" class="form-control" id="trading_postcode" name="trading_postcode" placeholder="Enter postcode" value="{{@$editMember->trading_postcode}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Fax Number -->
                                                                            <div class="form-group mb-3 col-md-6">
                                                                                <label for="fax_number">Fax Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control" id="fax_number" name="fax_number" placeholder="Enter fax number" value="{{@$editMember->fax_number}}">
                                                                            </div>

                                                                            <!-- Additional Telephone Number -->
                                                                            <div class="form-group mb-3 col-md-6">
                                                                                <label for="additional_telephone">Additional Telephone Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control" id="additional_telephone" name="additional_telephone" placeholder="Enter additional telephone number" value="{{@$editMember->additional_telephone}}">
                                                                            </div>
                                                                        </div>
                                                                        {{-- ============================                     --}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 5: DB Transfer -->
                                                                <div id="stepDBTransfer" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Employer Contributions</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        {{-- ==============================              --}}

                                                                       
                                                                        <p>This section is to be completed by the employer. Please confirm the level of contributions you propose to pay for this member.</p>

                                                                        <div class="row">
                                                                            <!-- Employer Gross Regular Contribution -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="regular_contribution">Employer (Gross) - Regular Contribution</label>
                                                                                <input type="text" class="form-control" id="regular_contribution" name="regular_contribution" placeholder="Enter amount" value="{{@$editMember->contribute_single_contribution}}">
                                                                            </div>

                                                                            <!-- Employer Gross Single Contribution -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="single_contribution">Employer (Gross) - Single Contribution</label>
                                                                                <input type="text" class="form-control" id="single_contribution" name="single_contribution" placeholder="Enter amount" value="{{@$editMember->contribute_single_contribution}}">
                                                                            </div>
                                                                        </div>

                                                                        {{-- ==============================              --}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 6: Policies & Financial Crime -->
                                                                <div id="stepPoliciesCrime" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Employer's Declaration</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        {{-- ====================================         ========--}}
                                                                     
                                                                        <p>To be signed by an authorised signatory of the employer other than the member, unless the member is the only authorised signatory or self-employed.</p>

                                                                        <div class="row">
                                                                            <!-- Signature -->
                                                                            <div class="col-md-6 form-group mb-3">
                                                                                <label for="signature">Signature</label>
                                                                                <input type="text" class="form-control" id="signature" name="signature" placeholder="Signature" value="{{@$editMember->signature}}">
                                                                            </div>

                                                                            <!-- Print Name -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="print_name">Print Name</label>
                                                                                <input type="text" class="form-control" id="print_name" name="print_name" placeholder="Enter name" value="{{@$editMember->print_name}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Position -->
                                                                            <div class=" col-md-6  form-group mb-3">
                                                                                <label for="position">Position</label>
                                                                                <input type="text" class="form-control" id="position" name="position" placeholder="Enter position" value="{{@$editMember->position}}"">
                                                                            </div>

                                                                            <!-- Date -->
                                                                            <div class=" col-md-6 form-group mb-3">
                                                                                <label for="date">Date</label>
                                                                                <input type="date" class="form-control" id="date" name="date" value="{{@$editMember->date}}">
                                                                            </div>
                                                                        </div>
                                                                        {{-- ====================================         ========--}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 7: Non-Standard Assets -->
                                                                <div id="stepNonStandardAssets" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Financial Adviser</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                      
                                                                        <p>Please give details of your financial adviser. Correspondence will normally be sent to your financial adviser.</p>

                                                                        <!-- Contact Name -->
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="financial_contact_name">Contact Name</label>
                                                                                <input type="text" class="form-control" id="financial_contact_name" name="financial_contact_name" placeholder="Enter contact name" value="{{@$editMember->financial_contact_name}}">
                                                                            </div>

                                                                            <!-- Company Name -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="company_name">Company Name</label>
                                                                                <input type="text" class="form-control" id="financial_company_name" name="financial_company_name" placeholder="Enter company name" value="{{@$editMember->financial_company_name}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Address -->
                                                                        <div class="row">
                                                                            <div class="form-group  col-12 mb-3">
                                                                                <label for="address">Address</label>
                                                                                <input type="text" class="form-control mb-2" id="street_address" name="street_address" placeholder="Street Address" value="{{@$editMember->street_address}}">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{@$editMember->city}}">
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control" id="financial_postcode" name="financial_postcode" placeholder="Postcode" value="{{@$editMember->financial_postcode}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Telephone and Fax Number -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="financial_telephone_number">Telephone Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control mb-2" id="financial_telephone_number" name="financial_telephone_number" placeholder="Enter telephone number" value="{{@$editMember->financial_telephone_number}}">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="financial_fax_number">Fax Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control mb-2" id="financial_fax_number" name="financial_fax_number" placeholder="Enter fax number" value="{{@$editMember->financial_fax_number}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Email Address -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="financial_email_address">Email Address</label>
                                                                                <input type="email" class="form-control" id="financial_email_address" name="financial_email_address" placeholder="Enter email address" value="{{@$editMember->financial_email_address}}">
                                                                            </div>

                                                                            <!-- Regulated By -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="regulated_by">Regulated By</label>
                                                                                <input type="text" class="form-control" id="regulated_by" name="regulated_by" placeholder="Enter regulated authority" value="{{@$editMember->regulated_by}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Authorisation Number -->
                                                                        <div class="row">
                                                                            <div class="form-group row row mb-3">
                                                                                <label for="authorisation_number">Authorisation Number</label>
                                                                                <input type="text" class="form-control" id="authorisation_number" name="authorisation_number" placeholder="Enter authorisation number" value="{{@$editMember->authorisation_number}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Is Financial Adviser Appointed Representative or Part of a Network? -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Is the financial adviser an appointed representative or part of a network?</label><br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="network_status" id="network_yes" value="Yes" {{ (old('paymenetwork_statusnt_frequency', $editMember->network_status) == 'Yes') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="network_yes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="network_status" id="network_no" value="No" {{ (old('network_status', $editMember->network_status) == 'No') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="network_no">No</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Name of Network or Principal -->
                                                                        <div class="row">
                                                                            <div class="col-md-6 form-group mb-3">
                                                                                <label for="network_name">Name of Network or Principal</label>
                                                                                <input type="text" class="form-control" id="network_name" name="network_name" placeholder="Enter name of network or principal" value="{{@$editMember->network_name}}">
                                                                            </div>

                                                                            <!-- Regulated By (Second Time) -->
                                                                            <div class="col-md-6 form-group mb-3">
                                                                                <label for="regulated_by_second">Regulated By (Again)</label>
                                                                                <input type="text" class="form-control" id="regulated_by_second" name="regulated_by_second" placeholder="Enter regulated authority again" value="{{@$editMember->regulated_by_second}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Company Authorisation Number -->
                                                                        <div class="form-group row col-md-12 mb-3">
                                                                            <label for="company_authorisation_number">Company Authorisation Number</label>
                                                                            <input type="text" class="form-control" id="company_authorisation_number" name="company_authorisation_number" placeholder="Enter company authorisation number" value="{{@$editMember->company_authorisation_number}}">
                                                                        </div>
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 8: Agreement Section -->
                                                                <div id="stepAgreement" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0"> Beneficiaries </h4>

                                                                    </div>
                                                                    <div class="row g-6">
                                                                        {{-- =============================================================                                --}}
                                                                        <h4>Nomination of Beneficiaries and Charity</h4>
                                                                        <p>In the event of your death, please confirm the percentage split of any benefits you wish to be paid to your nominated beneficiaries.</p>

                                                                        <!-- Beneficiaries Section -->
<!-- First Section: Beneficiary Section -->
 <div class="beneficiary-section">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name of Dependant/Beneficiary</th>
                <th>Relationship</th>
                <th>Percentage (%)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="beneficiary-list">
            @php
                $beneficiaryNames = $editMember->beneficiary_name ? json_decode($editMember->beneficiary_name, true) : [];
                $relationships = $editMember->relationship ? json_decode($editMember->relationship, true) : [];
                $percentages = $editMember->percentage ? json_decode($editMember->percentage, true) : [];

                // Ensure all arrays have the same length by using the smallest array length
                $length = min(count($beneficiaryNames), count($relationships), count($percentages));
            @endphp

            @for ($index = 0; $index < $length; $index++)
                <tr>
                    <td><input type="text" class="form-control" name="beneficiary_name[]" value="{{ $beneficiaryNames[$index] ?? '' }}"></td>
                    <td><input type="text" class="form-control" name="beneficiary_relationship[]" value="{{ $relationships[$index] ?? '' }}"></td>
                    <td><input type="number" class="form-control" name="beneficiary_percentage[]" value="{{ $percentages[$index] ?? '' }}"></td>
                    <td><button type="button" class="btn btn-danger remove-beneficiary">Remove</button></td>
                </tr>
            @endfor
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" id="add-beneficiary">Add Beneficiary</button>
</div>





                                                                        <hr>

                                                                        <!-- Charities Section -->
                                                                        <p>If you wish to nominate a charity/charities this should be done now as it cannot be left to the operator’s discretion.</p>
<div class="charity-section">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name of Charity</th>
            <th>Percentage (%)</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="charity-list">
            @php
                // Decode the charity names and percentages
                $charityname = $editMember->charity_name ? json_decode($editMember->charity_name, true) : [];
                $charitypercentage = $editMember->charity_percentage ? json_decode($editMember->charity_percentage, true) : [];

                // Ensure both arrays are of the same length
                $charityLength = min(count($charityname), count($charitypercentage));
            @endphp

            @for ($index = 0; $index < $charityLength; $index++)
            <tr>
                <td><input type="text" class="form-control" name="charity_name[]" value="{{ $charityname[$index] ?? '' }}"></td>
                <td><input type="number" class="form-control" name="charity_percentage[]" value="{{ $charitypercentage[$index] ?? '' }}"></td>
                <td><button type="button" class="btn btn-danger remove-charity">Remove</button></td>
            </tr>
            @endfor
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" id="add-charity">Add Charity</button>
</div>

<!-- Script to handle adding and removing rows -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle Add and Remove functionality for the Beneficiary Section
        const beneficiaryList = document.getElementById('beneficiary-list');
        const addBeneficiaryButton = document.getElementById('add-beneficiary');
        addBeneficiaryButton.addEventListener('click', function () {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="form-control" name="beneficiary_name[]" value=""></td>
                <td><input type="text" class="form-control" name="beneficiary_relationship[]" value=""></td>
                <td><input type="number" class="form-control" name="beneficiary_percentage[]" value=""></td>
                <td><button type="button" class="btn btn-danger remove-beneficiary">Remove</button></td>
            `;
            beneficiaryList.appendChild(newRow);
            addRemoveEvent(newRow, 'beneficiary');
        });

        // Handle Add and Remove functionality for the Charity Section
        const charityList = document.getElementById('charity-list');
        const addCharityButton = document.getElementById('add-charity');
        addCharityButton.addEventListener('click', function () {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="form-control" name="charity_name[]" value=""></td>
                <td><input type="number" class="form-control" name="charity_percentage[]" value=""></td>
                <td><button type="button" class="btn btn-danger remove-charity">Remove</button></td>
            `;
            charityList.appendChild(newRow);
            addRemoveEvent(newRow, 'charity');
        });

        // Function to handle remove button click event for both sections
        function addRemoveEvent(row, type) {
            const removeButton = row.querySelector(`.remove-${type}`);
            removeButton.addEventListener('click', function () {
                row.remove();
            });
        }

        // Attach remove event to existing rows
        const existingBeneficiaryRows = beneficiaryList.querySelectorAll('tr');
        existingBeneficiaryRows.forEach(function (row) {
            addRemoveEvent(row, 'beneficiary');
        });

        const existingCharityRows = charityList.querySelectorAll('tr');
        existingCharityRows.forEach(function (row) {
            addRemoveEvent(row, 'charity');
        });
    });
</script>

                                                                        {{-- ===========================================================================                       --}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepAgreement" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Investment </h4>

                                                                    </div>
                                                                    <div class="row g-6">
                                                                        {{-- =============================================================                                --}}

                                                                        <!-- Investment Options -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Investment Options (Pick One)</label><br>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="investment_option" id="full_investment" value="full_investment" {{ ($editMember->investment_option == 'full_investment') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="full_investment">Full Investment</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="investment_option" id="single_investment" value="single_investment" {{ ($editMember->investment_option == 'single_investment') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="single_investment">Single Investment</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Investment Details -->
                                                                        <h5>Investment Details</h5>

                                                                        @php
                                                                            // Decode the investment details JSON
                                                                            $investmentDetails = json_decode(@$editMember->investment_details) ?? [];
                                                                        @endphp

                                                                        <div class="form-group mb-3">
                                                                            <label>Select Any</label><br>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" id="network_platform" name="investment_details[]" value="network_platform"
                                                                                    {{ (is_array(old('investment_details', $investmentDetails)) && in_array('network_platform', old('investment_details', $investmentDetails))) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="network_platform">Network platform trading account</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" id="investment_manager" name="investment_details[]" value="investment_manager"
                                                                                    {{ (is_array(old('investment_details', $investmentDetails)) && in_array('investment_manager', old('investment_details', $investmentDetails))) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="investment_manager">Investment Manager</label>
                                                                            </div>
                                                                        </div>



                                                                        <!-- Investment Manager Details -->
                                                                        <h5>Investment Manager Details</h5>
                                                                        <p>Please provide details of your chosen investment manager (if known).</p>

                                                                        <!-- Contact Name -->
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="contact_name">Contact Name</label>
                                                                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter contact name" value="{{@$editMember->contact_name}}">
                                                                            </div>

                                                                            <!-- Company Name -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="investment_company_name">Company Name</label>
                                                                                <input type="text" class="form-control" id="investment_company_name" name="investment_company_name" placeholder="Enter company name" value="{{@$editMember->investment_company_name}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Address -->
                                                                        <div class="row">
                                                                            <div class="form-group  col-md-12 mb-3">
                                                                                <label for="address">Address</label>
                                                                                <input type="text" class="form-control mb-2" id="address" name="investment_address" placeholder="Enter address" value="{{@$editMember->investment_address}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Telephone and Fax Number -->
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="address">Postal Code</label>
                                                                                <input type="text" class="form-control" id="investment_postcode" name="investment_postcode" placeholder="Enter postcode" value="{{@$editMember->investment_postcode}}">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="telephone_number">Telephone Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control mb-2" id="telephone_number" name="investment_telephone_number" placeholder="Enter telephone number" value="{{@$editMember->investment_telephone_number}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Email Address -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="email_address">Email Address</label>
                                                                                <input type="email" class="form-control" id="email_address" name="investment_email_address" placeholder="Enter email address" value="{{@$editMember->investment_email_address}}">
                                                                            </div>

                                                                            <!-- Plan Type -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="plan_type">Plan Type</label>
                                                                                <input type="text" class="form-control" id="plan_type" name="plan_type" placeholder="Enter plan type" value="{{@$editMember->plan_type}}">
                                                                            </div>
                                                                        </div>


                                                                        {{-- ===========================================================================                       --}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepAgreement" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Benefits </h4>

                                                                    </div>
                                                                    <div class="row g-6">


                                                                        <h4>Taking Benefits</h4>
                                                                        <p>Please ensure you complete this section if you intend to take retirement benefits from your SIPP in the near future. Failure to complete this section may result in a delay paying your retirement benefits. Please note that pension payments can only be made once your SIPP has received the appropriate funds.</p>

                                                                        <p>Special terms and conditions apply to scheme pension, as it requires that we establish your SIPP under an individual trust. Further details of the additional fees and services applying to scheme pension are available on request.</p>

                                                                        <p>You should seek financial advice from a suitably qualified professional before taking benefits.</p>

                                                                        <!-- Taking Benefits in the Near Future -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Do you intend to take benefits in the near future?</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="take_benefits_soon" id="yes_benefits" value="yes" {{ ($editMember->take_benefits_soon == 'yes') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="yes_benefits">YES</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="take_benefits_soon" id="no_benefits" value="no" {{ ($editMember->take_benefits_soon == 'no') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="no_benefits">NO</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- How to Take Benefits -->
                                                                        <div class="form-group mb-3">
                                                                            <label>If 'YES' please confirm how you wish to take your benefits</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="benefits_method" id="flexi_access" value="Flexi-Access Drawdown" {{ ($editMember->benefits_method == 'Flexi-Access Drawdown') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="flexi_access">Flexi-Access Drawdown</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="benefits_method" id="ufpls" value="Uncrystallised Funds Pensions Lump Sum" {{ ($editMember->benefits_method == 'Uncrystallised Funds Pensions Lump Sum') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="ufpls">Uncrystallised Funds Pensions Lump Sum</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="benefits_method" id="scheme_pension" value="Scheme Pension" {{ ($editMember->benefits_method == 'Scheme Pension') ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="scheme_pension">Scheme Pension</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Anticipated Benefit Start Date -->
                                                                        <div class="form-group row col-12 mb-3">
                                                                            <label for="benefit_start_date">Anticipated Benefit Start Date</label>
                                                                            <input type="date" class="form-control" id="benefit_start_date" name="benefit_start_date" value="{{@$editMember->benefit_start_date}}">
                                                                        </div>


                                                                        {{-- ===========================================================================                       --}}
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-label-secondary">
                                                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-primary">
                                                                                <span class="align-middle d-sm-inline-block px-3 py-1 d-none me-sm-1 me-0">Next</span>
                                                                                <i class="ti ti-arrow-right ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepAgreement" class="form-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Other Benefits </h4>

                                                                    </div>

                                                                    <div class="row g-6">

                                                                        
                                                                        <p>Please provide details of the benefits from other arrangements you wish to transfer to your SIPP. Transfers and assignments to your SIPP can only be made once we have confirmed establishment of your SIPP.</p>

                                                                        <!-- Provider Full Name and Address -->
                                                                        <div class="row">
                                                                            <div class="col-md-6 form-group mb-3">
                                                                                <label for="provider_name">Provider's Full Name and Address Name</label>
                                                                                <input type="text" class="form-control" id="provider_name" name="provider_name" value="{{@$editMember->provider_name}}" placeholder="Enter provider's full name and address">
                                                                            </div>

                                                                            <!-- Address -->
                                                                            <div class="col-md-6 form-group mb-3">
                                                                                <label for="address">Address</label>
                                                                                <input type="text" class="form-control mb-2" id="address" name="other_benefits_address" value="{{@$editMember->other_benefits_address}}" placeholder="Enter address">
                                                                                <input type="text" class="form-control mb-2" id="other_benefits_postcode" name="other_benefits_postcode" placeholder="Postcode" value="{{@$editMember->other_benefits_postcode}}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Telephone Number and Fax Number -->
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="telephone_number">Telephone Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control mb-2" id="telephone_number" name="other_telephone_number" value="{{@$editMember->other_telephone_number}}" placeholder="Enter telephone number">
                                                                            </div>
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="fax_number">Fax Number (inc. Area Code)</label>
                                                                                <input type="text" class="form-control mb-2" id="fax_number" name="other_fax_number" value="{{@$editMember->other_fax_number}}" placeholder="Enter fax number">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Email Address -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="email_address">Email Address</label>
                                                                                <input type="email" class="form-control" id="email_address" name="other_email_address" value="{{@$editMember->other_email_address}}" placeholder="Enter email address">
                                                                            </div>

                                                                            <!-- Plan/Scheme Type -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="plan_scheme_type">Plan/Scheme Type</label>
                                                                                <input type="text" class="form-control" id="plan_scheme_type" name="plan_scheme_type" value="{{@$editMember->plan_scheme_type}}" placeholder="Enter plan/scheme type">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Is this an occupational scheme? -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Is this an occupational scheme?</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="is_occupational_scheme" {{ ($editMember->is_occupational_scheme == 'yes') ? 'checked' : '' }} id="occupational_yes" value="yes">
                                                                                <label class="form-check-label" for="occupational_yes">YES</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="is_occupational_scheme" {{ ($editMember->is_occupational_scheme == 'no') ? 'checked' : '' }} value="no">
                                                                                <label class="form-check-label" for="occupational_no">NO</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Plan/Scheme Name -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="plan_scheme_name">Plan/Scheme Name (in full)</label>
                                                                                <input type="text" class="form-control" id="plan_scheme_name" name="plan_scheme_name" value="{{@$editMember->plan_scheme_name}}" placeholder="Enter plan/scheme name">
                                                                            </div>

                                                                            <!-- Pension Scheme Tax Reference -->
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="pension_scheme_tax_reference">Pension Scheme Tax Reference</label>
                                                                                <input type="text" class="form-control" id="pension_scheme_tax_reference" name="pension_scheme_tax_reference" value="{{@$editMember->pension_scheme_tax_reference}}" placeholder="Enter pension scheme tax reference">
                                                                            </div>

                                                                        </div>
                                                                        <!-- Value of Fund to be Transferred -->
                                                                        <div class="row">
                                                                            <div class="form-group col-12 mb-3">
                                                                                <label for="fund_value">Value of Fund to be Transferred (£)</label>
                                                                                <input type="text" class="form-control" id="fund_value" name="fund_value" value="{{@$editMember->fund_value}}" placeholder="Enter fund value">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Does this represent the full value of the current plan/scheme? -->
                                                                        <div class="form-group mb-3">
                                                                            <label>Does this represent the full value of the current plan/scheme?</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="full_value_scheme" {{ (old('full_value_scheme', $editMember->full_value_scheme) == 'yes') ? 'checked' : '' }} id="full_value_yes" value="yes">
                                                                                <label class="form-check-label" for="full_value_yes">YES</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="full_value_scheme" {{ (old('full_value_scheme', $editMember->full_value_scheme) == 'no') ? 'checked' : '' }} id="full_value_no" value="no">
                                                                                <label class="form-check-label" for="full_value_no">NO</label>
                                                                            </div>
                                                                        </div>

                                                                            <!-- Have any funds been crystallised? -->
                                                                            <div class="form-group mb-3">
                                                                                <label>Have any funds been crystallised?</label><br>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="funds_crystallised" {{ (old('funds_crystallised', $editMember->funds_crystallised) == 'yes') ? 'checked' : '' }} id="funds_yes" value="yes">
                                                                                    <label class="form-check-label" for="funds_yes">YES (all funds)</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="funds_crystallised" {{ (old('funds_crystallised', $editMember->funds_crystallised) == 'some') ? 'checked' : '' }} id="funds_some" value="some">
                                                                                    <label class="form-check-label" for="funds_some">YES (some funds)</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="funds_crystallised" {{ (old('funds_crystallised', $editMember->funds_crystallised) == 'no') ? 'checked' : '' }} id="funds_no" value="no">
                                                                                    <label class="form-check-label" for="funds_no">NO</label>
                                                                                </div>
                                                                            </div>

                                                                            <!-- If YES, please confirm how they were crystallised -->
                                                                            <div class="form-group mb-3">
                                                                                <label>If YES, please confirm how they were crystallised</label><br>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="crystallised_method" {{ (old('crystallised_method', $editMember->crystallised_method) == 'Capped Drawdown') ? 'checked' : '' }} id="crystallised_capped" value="Capped Drawdown">
                                                                                    <label class="form-check-label" for="crystallised_capped">Capped Drawdown</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="crystallised_method" {{ (old('crystallised_method', $editMember->crystallised_method) == 'Flexi-Access Drawdown') ? 'checked' : '' }} id="crystallised_flexi" value="Flexi-Access Drawdown">
                                                                                    <label class="form-check-label" for="crystallised_flexi">Flexi-Access Drawdown</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="crystallised_method" {{ (old('crystallised_method', $editMember->crystallised_method) == 'Scheme Pension') ? 'checked' : '' }} id="crystallised_scheme" value="Scheme Pension">
                                                                                    <label class="form-check-label" for="crystallised_scheme">Scheme Pension</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="crystallised_method" {{ (old('crystallised_method', $editMember->crystallised_method) == 'Other') ? 'checked' : '' }}  id="crystallised_other" value="Other">
                                                                                    <label class="form-check-label" for="crystallised_other">Other (please specify)</label>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Signature -->
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6 mb-3">
                                                                                    <label for="signature">Signature</label>
                                                                                    <input type="text" class="form-control" id="other_signature" name="other_signature" placeholder="Sign here" value="{{@$editMember->other_signature}}">
                                                                                </div>

                                                                                <!-- Print Name -->
                                                                                <div class="form-group col-md-6 mb-3">
                                                                                    <label for="print_name">Print Name</label>
                                                                                    <input type="text" class="form-control" id="other_print_name" name="other_print_name" placeholder="Enter your name" value="{{@$editMember->other_print_name}}">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Date -->
                                                                            <div class="row">
                                                                                <div class="form-group mb-3">
                                                                                    <label for="date">Date</label>
                                                                                    <input type="date" class="form-control" id="date" name="other_date" value="{{@$editMember->other_date}}">
                                                                                </div>
                                                                            </div>

                                                                            {{--                                                                                ===========================================================================                       --}}
                                                                            <div class="col-12 d-flex justify-content-between">
                                                                                <button class="btn-prev-step btn-label-secondary">
                                                                                    <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                                </button>
                                                                                <button type="button" class="btn-next-step btn-primary">
                                                                                    <span class="align-middle d-sm-inline-block d-none px-3 py-1 me-sm-1 me-0">Next</span>
                                                                                    <i class="ti ti-arrow-right ti-xs"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div id="stepAgreement" class="form-step" style="display: none;">
                                                                        <div class="content-header mb-6">
                                                                            <h4 class="mb-0">Consent/Declaration </h4>

                                                                        </div>
                                                                        <div class="row g-6">


                                                                            <h4>Member Consent</h4>
                                                                            <p>Rowanmoor Personal Pensions Limited may want to contact you occasionally by post or email to let you know about other products and services available from us, or to forward your contact details to another firm associated with the Embark Group Limited of which Rowanmoor is part. Please indicate your preferences by ticking the relevant boxes:</p>

                                                                            <!-- Consent for Contacting about Products and Services -->
                                                                            <div class="form-group mb-3">
                                                                                <label>I consent to Rowanmoor Personal Pensions Limited contacting me about other products and services.</label><br>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="contact_consent" {{ (old('contact_consent', $editMember->contact_consent) == 'yes') ? 'checked' : '' }} id="contact_yes" value="yes">
                                                                                    <label class="form-check-label" for="contact_yes">YES</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="contact_consent" {{ (old('contact_consent', $editMember->contact_consent) == 'no') ? 'checked' : '' }} id="contact_no" value="no">
                                                                                    <label class="form-check-label" for="contact_no">NO</label>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Consent for Passing Contact Details to Other Subsidiaries -->
                                                                           <div class="form-group mb-3">
                                                                            <label>I consent to Rowanmoor Personal Pensions Limited passing my contact details to other subsidiaries within Embark Group Limited, for them to contact me about their products and services.</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="passing_contact_consent" {{ (old('passing_contact_consent', $editMember->passing_contact_consent) == 'yes') ? 'checked' : '' }} id="pass_contact_yes" value="yes">
                                                                                <label class="form-check-label" for="pass_contact_yes">YES</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="passing_contact_consent" {{ (old('passing_contact_consent', $editMember->passing_contact_consent) == 'no') ? 'checked' : '' }} id="pass_contact_no" value="no">
                                                                                <label class="form-check-label" for="pass_contact_no">NO</label>
                                                                            </div>
                                                                        </div>


                                                                            <!-- Preferred Contact Method if YES -->
                                                                            <div class="form-group mb-3">
                                                                                <label>If you have answered 'yes' to any of the above, please confirm how you would prefer to be contacted.</label><br>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="contact_method" {{ (old('contact_method', $editMember->contact_method) == 'email') ? 'checked' : '' }} id="contact_by_email" value="email">
                                                                                    <label class="form-check-label" for="contact_by_email">I would prefer to be contacted by email using the email address provided on page 2</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="contact_method" {{ (old('contact_method', $editMember->contact_method) == 'post') ? 'checked' : '' }} id="contact_by_post" value="post">
                                                                                    <label class="form-check-label" for="contact_by_post">I would prefer to be contacted by post</label>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="row">
                                                                                <!-- Signature Section for Member Consent -->
                                                                                <div class="form-group col-md-6 mb-3">
                                                                                    <label for="signature">Signature</label>
                                                                                    <input type="text" class="form-control" id="signature" name="signature_consent" value="{{ old('signature_consent', $editMember->signature_consent) }}" placeholder="Sign here">
                                                                                </div>
                                                                            
                                                                                <!-- Print Name -->
                                                                                <div class="form-group col-md-6 mb-3">
                                                                                    <label for="print_name">Print Name</label>
                                                                                    <input type="text" class="form-control" id="print_name" name="signatur_print_name" value="{{ old('signatur_print_name', $editMember->signatur_print_name) }}" placeholder="Enter your name">
                                                                                </div>
                                                                            </div>


                                                                            <!-- Date -->
                                                                            <div class="row">
                                                                                <div class=" col-12 form-group mb-3">
                                                                                    <label for="date">Date</label>
                                                                                    <input type="date" class="form-control" id="date" name="date" value="{{@$editMember->date}}">
                                                                                </div>
                                                                            </div>

                                                                            <h4 class="mt-5">Member Declaration</h4>
                                                                            <p>To be signed by an authorised signatory of the employer other than the member, unless the member is the only authorised signatory or self-employed.</p>
                                                                            <p>The information provided on this form is correct to the best of my knowledge. I confirm I understand that once a contribution has been made to a SIPP, it cannot be returned.</p>

                                                                            <!-- Signature Section for Member Declaration -->
                                                                           <div class="row">
                                                                                <div class="form-group col-md-6 mb-3">
                                                                                    <label for="signature_declaration">Signature</label>
                                                                                    <input type="text" class="form-control" id="signature_declaration" name="signature_declaration" value="{{ old('signature_declaration', $editMember->signature_declaration) }}" placeholder="Sign here">
                                                                                </div>
                                                                            
                                                                                <!-- Print Name -->
                                                                                <div class="form-group col-md-6 mb-3">
                                                                                    <label for="print_name_declaration">Print Name</label>
                                                                                    <input type="text" class="form-control" id="print_name_declaration" name="print_name_declaration" value="{{ old('print_name_declaration', $editMember->print_name_declaration) }}" placeholder="Enter your name">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <!-- Position -->
                                                                            <div class="row">
                                                                                <div class="col-md-6 form-group mb-3">
                                                                                    <label for="position">Position</label>
                                                                                    <input type="text" class="form-control" id="position" name="position_declaration" value="{{ old('position_declaration', $editMember->position_declaration) }}" placeholder="Enter your position">
                                                                                </div>
                                                                            
                                                                                <!-- Date -->
                                                                                <div class="col-md-6 form-group mb-3">
                                                                                    <label for="declaration_date">Date</label>
                                                                                    <input type="date" class="form-control" id="declaration_date" name="declaration_date" value="{{ old('declaration_date', $editMember->declaration_date) }}">
                                                                                </div>
                                                                            </div>


                                                                            {{--                                                                                ===========================================================================                       --}}
                                                                            <div class="col-12 d-flex justify-content-between">
                                                                                <button class="btn-prev-step btn-label-secondary">
                                                                                    <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                                </button>
                                                                                {{--                                                                                <button type="button" class="btn-next-step btn-primary">--}}
                                                                                {{--                                                                                    <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>--}}
                                                                                {{--                                                                                    <i class="ti ti-arrow-right ti-xs"></i>--}}
                                                                                {{--                                                                                </button>--}}
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- / Multi Steps Registration -->
                                                </div>
                                            </div>

                                            <!-- Updated JavaScript with new class and id names -->
                                            <script>
                                               document.addEventListener('DOMContentLoaded', function () {
    const nextBtns = document.querySelectorAll('.btn-next-step');
    const prevBtns = document.querySelectorAll('.btn-prev-step');
    const steps = document.querySelectorAll('.form-step');
    let currentStep = 0;

    // Show next step
    nextBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default form behavior
            if (currentStep < steps.length - 1) {
                steps[currentStep].style.display = 'none'; // Hide current step
                currentStep++; // Increment to next step
                steps[currentStep].style.display = 'block'; // Show next step
            }
            togglePrevButton();
        });
    });

    // Show previous step
    prevBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default form behavior
            if (currentStep > 0) {
                steps[currentStep].style.display = 'none'; // Hide current step
                currentStep--; // Decrement to previous step
                steps[currentStep].style.display = 'block'; // Show previous step
            }
            togglePrevButton();
        });
    });

    // Enable/Disable previous button
    function togglePrevButton() {
        prevBtns.forEach((btn) => {
            btn.disabled = currentStep === 0;
        });
    }
});

                                            </script>


                                        {{--              ============================  ====================== ==============================--}}
{{--              ============================   Application multiform  end    ====================--}}




                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" disabled>
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Identifyn -->
                                <div id="personalInfoValidation" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Corporate</h4>
                                    </div>
                                    <div class="row g-6">

                                        <h4>Corporate Verification Certificate</h4>
                                        <p>To be completed by a regulated UK or EU Intermediary when introducing retail sector business. Please complete a separate certificate for all employers contributing to the SIPP.</p>

                                        <!-- Company Information Section -->
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" class="form-control" id="company_name" name="infor_company_name" placeholder="Company Name" value="{{@$editMember->infor_company_name}}">
                                            </div>

                                            <div class=" col-md-6 form-group mb-3">
                                                <label for="entity_type">Type of Entity</label>
                                                <input type="text" class="form-control" id="entity_type" name="entity_type" placeholder="Ltd, Co, Partnership, PLC" value="{{@$editMember->entity_type}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="registered_address">Registered Address</label>
                                                <input type="text" class="form-control" id="registered_address" name="registered_address" placeholder="Registered Address" value="{{@$editMember->registered_address}}">
                                            </div>

                                            <div class=" col-md-6 form-group mb-3">
                                                <label for="registered_number">Registered Number (If applicable)</label>
                                                <input type="text" class="form-control" id="registered_number" name="registered_number" placeholder="Registered Number" value="{{@$editMember->registered_number}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="country" name="infor_country" placeholder="Country" value="{{@$editMember->infor_country}}">
                                            </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="company_info_postcode">Postcode</label>
                                                <input type="text" class="form-control" id="postcode" name="company_info_postcode" placeholder="Postcode" value="{{@$editMember->company_info_postcode}}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="nature_of_business">Nature of Business</label>
                                            <input type="text" class="form-control" id="nature_of_business" name="nature_of_business" placeholder="Nature of Business" value="{{@$editMember->nature_of_business}}">
                                        </div>

                                        <!-- Control Information Section -->
                                        <h5>Control Information</h5>

                                            <div class="form-group  mb-3">
                                                <label for="controller_name">Name (and Date of Birth if known) of Individuals who Exercise Control over the Management of the Company</label>
                                                <input type="text" class="form-control mb-2" id="controller_name" name="controller_names[]" placeholder="Name" value="{{@$editMember->controller_names}}">
                                                <input type="date" class="form-control mb-2" name="controller_dobs[]" value="{{@$editMember->controller_dobs}}">
                                            </div>

                                            <div class="form-group  mb-3">
                                                <label for="individual_verification">Identity Verification Certificates will be required for each individual named in this section</label>
                                                <input type="checkbox" id="individual_verification" name="individual_verification" value="{{@$editMember->individual_verification}}">
                                            </div>


                                        <!-- Beneficial Owner Information Section -->
                                        <h5>Beneficial Owners (25% or More Ownership)</h5>

                                        <div class="form-group mb-3">
                                            <label for="beneficial_owner_name">Name (and Date of Birth if known) of Principal Beneficial Owners (over 25%)</label>
                                            <input type="text" class="form-control mb-2" id="beneficial_owner_name" name="beneficial_owner_names[]" placeholder="Name" value="{{@$editMember->beneficial_owner_names}}">
                                            <input type="date" class="form-control mb-2" name="beneficial_owner_dobs[]" value="{{@$editMember->beneficial_owner_dobs}}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="beneficial_verification">Identity Verification Certificates will be required for each individual named in this section</label>
                                            <input type="checkbox" id="beneficial_verification" name="beneficial_verification" value="{{@$editMember->beneficial_verification}}">
                                        </div>

                                        <!-- Certification Section -->
                                        <h5>Certification</h5>
                                        <div class="form-group mb-3">
                                            <p>We certify that:</p>
                                            <ul>
                                                <li>All the information given above was obtained by myself/us in relation to this customer</li>
                                                <li>The evidence I/we have obtained to identify the customer</li>
                                            </ul>
                                        
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="standard_verification" name="standard_verification"
                                                    value="1" {{ @$editMember->standard_verification ? 'checked' : '' }}>
                                                <label class="form-check-label" for="standard_verification">
                                                    Meets the standard evidence set out within the guidance for UK Financial Sector issued by the JMLSG
                                                </label>
                                            </div>
                                        
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="confirmation_letter" name="confirmation_letter"
                                                    value="1" {{ @$editMember->confirmation_letter ? 'checked' : '' }}>
                                                <label class="form-check-label" for="confirmation_letter">
                                                    I/we have attached the required documents for identification
                                                </label>
                                            </div>
                                        
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="open_account" name="open_account"
                                                    value="1" {{ @$editMember->open_account ? 'checked' : '' }}>
                                                <label class="form-check-label" for="open_account">
                                                    Open request, I will supply additional verification documents
                                                </label>
                                            </div>
                                        </div>


                                        <!-- Signature Section -->
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="name_of_regulated_firm">Name of Regulated Firm</label>
                                                <input type="text" class="form-control" id="name_of_regulated_firm" name="name_of_regulated_firm"
                                                    value="{{ @$editMember->name_of_regulated_firm }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="regulator_name_reference">Regulator's Name and Reference Number</label>
                                                <input type="text" class="form-control" id="regulator_name_reference" name="regulator_name_reference"
                                                    value="{{ @$editMember->regulator_name_reference }}">
                                            </div>
                                        </div>
                                        
                                        <p>OR</p>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="regulated_individual_name">Name of Regulated Individual</label>
                                                <input type="text" class="form-control" id="regulated_individual_name" name="regulated_individual_name"
                                                    value="{{ @$editMember->regulated_individual_name }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="regulated_individual_reference">Regulator's Name and Reference Number</label>
                                                <input type="text" class="form-control" id="regulated_individual_reference" name="regulated_individual_reference"
                                                    value="{{ @$editMember->regulated_individual_reference }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="signature">Signed (Original Signature Required)</label>
                                                <input type="text" class="form-control" id="signature" name="signature_segnature"
                                                    value="{{ @$editMember->signature_segnature }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="regulated_name"
                                                    value="{{ @$editMember->regulated_name }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="position">Position</label>
                                                <input type="text" class="form-control" id="position" name="regulated_position"
                                                    value="{{ @$editMember->regulated_position }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="date">Date</label>
                                                <input type="date" class="form-control" id="signature_date" name="signature_date"
                                                    value="{{ @$editMember->signature_date }}">
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Identify -->
                                <div id="personalInfoValidation" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Identity </h4>
                                    </div>
                                    <div class="row g-6">

                                        <h4>Identity Verification Certificate</h4>
                                        <p>
                                            To be completed by a regulated UK or EU Intermediary when introducing retail sector business. Please complete a separate certificate for all parties to the contract (e.g., joint applicants, trustees, settlors, and third parties) where you have been required to undertake identification. If an application is being made on behalf of a minor, identity verification is required for both the minor and their legal guardian (i.e., the person who has parental responsibility for them).
                                        </p>

                                        <!-- Applicant Information -->
                                         
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="applicant_name">Name of Applicant/Trustee/Third Party</label>
                                                <input type="text" class="form-control" id="applicant_name" name="applicant_name" placeholder="Name"
                                                    value="{{ @$editMember->applicant_name }}">
                                            </div>
                                            
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="dob">Date of Birth</label>
                                                <input type="date" class="form-control" id="dob" name="application_dob"
                                                    value="{{ @$editMember->application_dob }}">
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="applicant_address" placeholder="Address">{{ @$editMember->applicant_address }}</textarea>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="country" name="application_country" placeholder="Country"
                                                    value="{{ @$editMember->application_country }}">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="applicant_info_postcode">Postcode</label>
                                                <input type="text" class="form-control" id="applicant_info_postcode" name="applicant_info_postcode" placeholder="Postcode"
                                                    value="{{ @$editMember->applicant_info_postcode }}">
                                            </div>
                                            
                                            <!-- Address Change Section -->
                                            <div class="form-group mb-3">
                                                <label for="changed_address">If this individual has changed address in the last three months, please give the previous address here.</label>
                                                <input type="text" class="form-control" id="changed_address" name="changed_address" placeholder="Previous Address"
                                                    value="{{ @$editMember->changed_address }}">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="previous_country">Previous Country</label>
                                                <input type="text" class="form-control" id="previous_country" name="previous_country" placeholder="Previous Country"
                                                    value="{{ @$editMember->previous_country }}">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="previous_postcode">Previous Postcode</label>
                                                <input type="text" class="form-control" id="previous_postcode" name="previous_postcode" placeholder="Previous Postcode"
                                                    value="{{ @$editMember->previous_postcode }}">
                                            </div>

                                        

                                        <!-- Certification Section -->
                                        <h5>Certification</h5>
                                        <p>I/We certify that:</p>
                                        <ul>
                                            <li>All the information given above was obtained by me/us in relation to this customer;</li>
                                            <li>The evidence I/we have obtained to identify the customer meets the standard evidence set out within the guidance for UK Financial Sector issued by the JMLSG;</li>
                                        </ul>

                                      
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="regulator_firm_name">Name of Regulated Firm</label>
                                                <input type="text" class="form-control" id="regulator_firm_name" name="regulator_firm_name" placeholder="Regulated Firm Name"
                                                    value="{{ @$editMember->regulator_firm_name }}">
                                            </div>
                                            
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="regulator_reference">Regulator's Name and Reference Number</label>
                                                <input type="text" class="form-control" id="regulator_reference" name="regulator_reference" placeholder="Regulator's Name and Reference Number"
                                                    value="{{ @$editMember->regulator_reference }}">
                                            </div>
                                            
                                            <p>OR</p>
                                            
                                            <div class="row">
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="regulated_cer_individual_name">Name of Regulated Individual</label>
                                                    <input type="text" class="form-control" id="regulated_cer_individual_name" name="regulated_cer_individual_name" placeholder="Regulated Individual Name"
                                                        value="{{ @$editMember->regulated_cer_individual_name }}">
                                                </div>
                                            
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="regulated_certification_individual_reference">Regulator's Name and Reference Number</label>
                                                    <input type="text" class="form-control" id="regulated_certification_individual_reference" name="regulated_certification_individual_reference" placeholder="Regulator's Name and Reference Number"
                                                        value="{{ @$editMember->regulated_certification_individual_reference }}">
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="signature">Signature</label>
                                                    <input type="text" class="form-control" id="signature" name="certification_signature" placeholder="Signature"
                                                        value="{{ @$editMember->certification_signature }}">
                                                </div>
                                            
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="certification_name" placeholder="Name"
                                                        value="{{ @$editMember->certification_name }}">
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="position">Position</label>
                                                    <input type="text" class="form-control" id="position" name="certification_position" placeholder="Position"
                                                        value="{{ @$editMember->certification_position }}">
                                                </div>
                                            
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="date">Date</label>
                                                    <input type="date" class="form-control" id="date" name="certification_date"value="{{ @$editMember->certification_date }}">
                                                </div>
                                            </div>


                                       </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Details -->
                                <div id="bank_details" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Agreement</h4>
                                    </div>
                                    <div class="row g-6">

{{--                                        <h4>Agreement</h4>--}}

                                        <!-- Section One: Initial and Ongoing Fees -->
                                        <h5>Section One - Initial and ongoing fees</h5>

                                        <!-- Defined Fee Section -->
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="defined_fee">Defined Fee - Initial Fee for arranging the SIPP</label>
                                                <input type="text" class="form-control" id="defined_fee" name="defined_fee" placeholder="Initial Fee" value="{{ @$editMember->defined_fee }}">
                                            </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="annual_fee_defined">Annual Fee</label>
                                                <input type="text" class="form-control" id="annual_fee_defined" name="annual_fee_defined" placeholder="Annual Fee" value="{{ @$editMember->annual_fee_defined }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6  mb-3">
                                                <label for="date_fee">Payment Date</label>
                                                <input type="date" class="form-control" id="date_fee" name="date_fee" value="{{ @$editMember->date_fee }}">
                                            </div>

                                            <!-- Percentage of Fund or Specific Investments Section -->
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="percentage_fund">Percentage of Fund or Specific Investments</label>
                                                <input type="text" class="form-control" id="percentage_fund" name="percentage_fund" placeholder="Percentage of Fund" value="{{ @$editMember->percentage_fund }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="annual_fee_fund">Annual Fee</label>
                                                <input type="text" class="form-control" id="annual_fee_fund" name="annual_fee_fund" placeholder="Annual Fee" value="{{ @$editMember->annual_fee_fund }}">
                                            </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="date_fund">Payment Date</label>
                                                <input type="date" class="form-control" id="date_fund" name="date_fund" value="{{ @$editMember->date_fund }}">
                                            </div>
                                        </div>

                                        <!-- Percentage of Gross Contributions Section -->
                                      <div class="row">
                                          <div class="form-group col-md-6 mb-3">
                                              <label for="gross_contribution">Percentage of Gross Contributions</label>
                                              <input type="text" class="form-control" id="gross_contribution" name="gross_contribution" placeholder="Percentage of Gross Contributions" value="{{ @$editMember->gross_contribution }}">
                                          </div>

                                          <div class="form-group col-md-6 mb-3">
                                              <label for="annual_fee_gross">Annual Fee</label>
                                              <input type="text" class="form-control" id="annual_fee_gross" name="annual_fee_gross" placeholder="Annual Fee" value="{{ @$editMember->annual_fee_gross }}">
                                          </div>
                                      </div>

                                        <div class="form-group mb-3">
                                            <label for="date_gross">Payment Date</label>
                                            <input type="date" class="form-control" id="date_gross" name="date_gross" value="{{ @$editMember->date_gross }}">
                                        </div>

                                        <!-- Section Two: Transfer Related Fees -->
                                        <h5>Section Two - Transfer related fees</h5>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="transfer_value">Transfer Value</label>
                                                <input type="text" class="form-control" id="transfer_value" name="transfer_value" placeholder="Transfer Value" value="{{ @$editMember->transfer_value }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="fee_transfer">Percentage or Amount Fee for Transfer</label>
                                                <input type="text" class="form-control" id="fee_transfer" name="fee_transfer" placeholder="Fee for Transfer" value="{{ @$editMember->fee_transfer }}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="payment_received">Payment Received Date</label>
                                            <input type="date" class="form-control" id="payment_received" name="payment_received" value="{{ @$editMember->payment_received }}">
                                        </div>

                                        <!-- Apply for Future Transfers -->
                                        <div class="form-group mb-3">
                                            <label>Will the same terms apply for future transfers paid into the SIPP?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="future_transfers" id="future_transfers_yes" value="Yes" {{ (old('future_transfers', $editMember->future_transfers) == 'Yes') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="future_transfers_yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="future_transfers" id="future_transfers_no" value="No" {{ (old('future_transfers', $editMember->future_transfers) == 'No') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="future_transfers_no">No</label>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- DB Transfer -->
                                <div id="BD_Transfer" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Declaration</h4>
                                    </div>
                                    <div class="row g-6">


{{--                                        <h4>Declaration</h4>--}}

                                        <!-- SIPP Member Section -->
                                        <h5>To be signed by the SIPP Member</h5>

                                       <div class="row">
                                           <div class="form-group col-md-6 mb-3">
                                               <label for="signature_member">Signature</label>
                                               <input type="text" class="form-control" id="signature_member" name="signature_member" placeholder="Signature" value="{{ @$editMember->signature_member }}">
                                           </div>

                                           <div class="form-group col-md-6 mb-3">
                                               <label for="print_name_member">Print Name</label>
                                               <input type="text" class="form-control" id="print_name_member" name="print_name_member" placeholder="Print Name" value="{{ @$editMember->print_name_member }}">
                                           </div>
                                       </div>

                                        <div class="row">
                                            <div class="col-12 form-group mb-3">
                                                <label for="date_member">Date</label>
                                                <input type="date" class="form-control" id="date_member" name="date_member" value="{{ @$editMember->date_member }}">
                                            </div>
                                        </div>

                                        <h5>To be completed by the financial adviser</h5>

                                        <div class="form-group mb-3">
                                            <label>Is your financial adviser an appointed representative, or part of an adviser network?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="adviser_network" id="adviser_network_yes" value="Yes" {{ (old('adviser_network', $editMember->adviser_network) == 'Yes') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="adviser_network_yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="adviser_network" id="adviser_network_no" value="No" {{ (old('adviser_network', $editMember->adviser_network) == 'No') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="adviser_network_no">No</label>
                                            </div>
                                        </div>

                                       <div class="row">
                                           <div class="form-group col-12 mb-3">
                                               <label for="name_of_network">If yes, please provide the name of the network</label>
                                               <input type="text" class="form-control" id="name_of_network" name="name_of_network" placeholder="Name of Network" value="{{ @$editMember->name_of_network }}">
                                           </div>
                                       </div>

                                        <div class="form-group mb-3">
                                            <label>Is payment to be made to your network?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="network_payment" id="network_payment_yes" value="Yes" {{ (old('network_payment', $editMember->network_payment) == 'Yes') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="network_payment_yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="network_payment" id="network_payment_no" value="No" {{ (old('network_payment', $editMember->network_payment) == 'No') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="network_payment_no">No</label>
                                            </div>
                                        </div>

                                        <!-- Payment Details Section -->
                                        <div class="form-group mb-3">
    <label>Fees to be paid by:</label>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="fees_paid_by[]" id="cheque" value="Cheque" 
            {{ (old('fees_paid_by') && in_array('Cheque', old('fees_paid_by'))) ? 'checked' : ((isset($editMember) && is_array($editMember->fees_paid_by) && in_array('Cheque', $editMember->fees_paid_by)) ? 'checked' : '') }}>
        <label class="form-check-label" for="cheque">Cheque</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="fees_paid_by[]" id="chaps_bacs" value="CHAPS/BACS" 
            {{ (old('fees_paid_by') && in_array('CHAPS/BACS', old('fees_paid_by'))) ? 'checked' : ((isset($editMember) && is_array($editMember->fees_paid_by) && in_array('CHAPS/BACS', $editMember->fees_paid_by)) ? 'checked' : '') }}>
        <label class="form-check-label" for="chaps_bacs">CHAPS/BACS</label>
    </div>
</div>

                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="{{ @$editMember->bank_name }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="branch">Branch</label>
                                                <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch" value="{{ @$editMember->branch }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="account_name">Account Name</label>
                                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{ @$editMember->account_name }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="account_number">Account Number</label>
                                                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="{{ @$editMember->account_number }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="sort_code">Sort Code</label>
                                                <input type="text" class="form-control" id="sort_code" name="sort_code" placeholder="Sort Code" value="{{ @$editMember->sort_code }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="signature_adviser">Signature (Adviser)</label>
                                                <input type="text" class="form-control" id="signature_adviser" name="signature_adviser" placeholder="Signature" value="{{ @$editMember->signature_adviser }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="name_adviser">Name</label>
                                                <input type="text" class="form-control" id="name_adviser" name="name_adviser" placeholder="Name" value="{{ @$editMember->name_adviser }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="position_adviser">Position</label>
                                                <input type="text" class="form-control" id="position_adviser" name="position_adviser" placeholder="Position" value="{{ @$editMember->position_adviser }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="date_adviser">Date</label>
                                                <input type="date" class="form-control" id="date_adviser" name="date_adviser" value="{{ @$editMember->date_adviser }}">
                                            </div>
                                        
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="company_stamp">Company Stamp</label>
                                                <input type="text" class="form-control" id="company_stamp" name="company_stamp" placeholder="Company Stamp" value="{{ @$editMember->company_stamp }}">
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Policies & Financial Crime -->
                                <div id="polocoesCrime" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Bank Account</h4>
                                    </div>
                                    <div class="row g-6">
                                   <!-- =========================== bank account further details card start =========================== !-->
                                        <div class="auth-container auth-overlay auth-bg-pattern">
                                            <div class="auth-content row">
                                                <!-- Multi Steps Registration -->
                                                <div class="d-flex col-12 align-items-center justify-content-center auth-bg-pattern p-5">
                                                    <div class="col-10">
                                                        <div id="multiFormStepper" class="form-stepper border-none shadow-none mt-5">
                                                            <div class="form-stepper-content px-0">

                                                                <!-- Step 1: Personal Details -->
                                                                <div id="stepFirst" class="step-content-bank" style="display: block;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Pension Scheme Details</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <h5>Personal Info Content</h5>

                                                                      <div class="row">
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="pension_scheme_type">Pension Scheme Type</label>
                                                                                <input type="text" class="form-control" id="pension_scheme_type" name="pension_scheme_type" placeholder="Pension Scheme Type" value="{{ @$editMember->pension_scheme_type }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="pension_scheme_name">Pension Scheme Name</label>
                                                                                <input type="text" class="form-control" id="pension_scheme_name" name="pension_scheme_name" placeholder="Pension Scheme Name" value="{{ @$editMember->pension_scheme_name }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6 mb-3">
                                                                                <label for="pension_provider_name">Pension Provider Name</label>
                                                                                <input type="text" class="form-control" id="pension_provider_name" name="pension_provider_name" placeholder="Pension Provider Name" value="{{ @$editMember->pension_provider_name }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-12 mb-3">
                                                                                <label for="professional_trustee_address">Professional Trustee Address</label>
                                                                                <textarea class="form-control" id="professional_trustee_address" name="professional_trustee_address" rows="3" placeholder="Professional Trustee Address">{{ @$editMember->professional_trustee_address }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group mb-3">
                                                                            <label for="scheme_admin_address">Scheme Administrator Address</label>
                                                                            <textarea class="form-control" id="scheme_admin_address" name="scheme_admin_address" rows="3" placeholder="Scheme Administrator Address">{{ @$editMember->scheme_admin_address }}</textarea>
                                                                        </div>
                                                                        
                                                                        <div class="form-group mb-3">
                                                                            <label>Does Employer Pay Premiums?</label>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="employer_pay_premiums" id="employer_yes" value="Yes" {{ old('employer_pay_premiums', @$editMember->employer_pay_premiums) == 'Yes' ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="employer_yes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="employer_pay_premiums" id="employer_no" value="No" {{ old('employer_pay_premiums', @$editMember->employer_pay_premiums) == 'No' ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="employer_no">No</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group mb-3">
                                                                                <label for="hmrc_registration_number">HMRC Registration Number</label>
                                                                                <input type="text" class="form-control" id="hmrc_registration_number" name="hmrc_registration_number" placeholder="HMRC Registration Number" value="{{ @$editMember->hmrc_registration_number }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group mb-3">
                                                                                <label for="alt_scheme_admin_address">Alternative Scheme Administrator Address</label>
                                                                                <textarea class="form-control" id="alt_scheme_admin_address" name="alt_scheme_admin_address" rows="3" placeholder="Alternative Scheme Administrator Address">{{ @$editMember->alt_scheme_admin_address }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group mb-3">
                                                                            <label>Are Statements Required?</label>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="statements_required" id="statements_yes" value="Yes" {{ old('statements_required', @$editMember->statements_required) == 'Yes' ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="statements_yes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="statements_required" id="statements_no" value="No" {{ old('statements_required', @$editMember->statements_required) == 'No' ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="statements_no">No</label>
                                                                            </div>
                                                                        </div>




                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank btn-label-secondary" disabled>
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0 disabled ">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step-bank btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 2: Adviser Details -->
                                                                <div id="stepSecond" class="step-content-bank" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Trustees Details</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <h6>Members and Trustees </h6>
                                                                        <h5>Member Details (please delete as appropriate)</h5>
                                                                        <div id="member-form-container">
                                                                            <div class="member-form">
                                                                               <div class="row">
    <div class="form-group col-md-6 mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="member_title[]" placeholder="Title" value="{{ @$editMember->member_title }}">
    </div>

    <div class="form-group col-md-6 mb-3">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name[]" placeholder="First Name" value="{{ @$editMember->first_name }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 mb-3">
        <label for="middle_name">Middle Name(s)</label>
        <input type="text" class="form-control" name="middle_name[]" placeholder="Middle Name(s)" value="{{ @$editMember->middle_name }}">
    </div>

    <div class="form-group col-md-6 mb-3">
        <label for="surname">Surname</label>
        <input type="text" class="form-control" name="member_surname[]" placeholder="Surname" value="{{ @$editMember->member_surname }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 mb-3">
        <label for="date_of_birth">Date of Birth</label>
        <input type="date" class="form-control" name="date_of_birth[]" placeholder="Date of Birth" value="{{ @$editMember->date_of_birth }}">
    </div>

    <div class="form-group col-md-6 mb-3">
        <label for="gender">Gender</label>
        <input type="text" class="form-control" name="tanee_member_gender[]" placeholder="Gender" value="{{ @$editMember->tanee_member_gender }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 mb-3">
        <label for="nationality">Nationality</label>
        <input type="text" class="form-control" name="member_nationality[]" placeholder="Nationality" value="{{ @$editMember->member_nationality }}">
    </div>

    <div class="form-group col-md-6 mb-3">
        <label for="country_of_birth">Country of Birth</label>
        <input type="text" class="form-control" name="country_of_birth[]" placeholder="Country of Birth" value="{{ @$editMember->country_of_birth }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 mb-3">
        <label for="home_telephone_number">Home Telephone Number</label>
        <input type="text" class="form-control" name="home_telephone_number[]" placeholder="Home Telephone Number" value="{{ @$editMember->home_telephone_number }}">
    </div>

    <div class="form-group col-md-6 mb-3">
        <label for="mobile_number">Mobile Number</label>
        <input type="text" class="form-control" name="mobile_number[]" placeholder="Mobile Number" value="{{ @$editMember->mobile_number }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 mb-3">
        <label for="email_address">Email Address</label>
        <input type="email" class="form-control" name="member_email_address[]" placeholder="Email Address" value="{{ @$editMember->member_email_address }}">
    </div>

    <div class="form-group col-md-6 mb-3">
        <label for="current_address">Current Address</label>
        <textarea class="form-control" name="current_address[]" placeholder="Current Address">{{ @$editMember->current_address }}</textarea>
    </div>
</div>

<div class="form-group mb-3">
    <label for="date_moved_in">Date Moved In</label>
    <input type="date" class="form-control" name="date_moved_in[]" placeholder="Date Moved In" value="{{ @$editMember->date_moved_in }}">
</div>

<div class="form-group mb-3">
    <label>Are Statements Required?</label>
    <select class="form-control" name="member_statements_required[]">
        <option value="Yes" {{ old('member_statements_required', @$editMember->member_statements_required) == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ old('member_statements_required', @$editMember->member_statements_required) == 'No' ? 'selected' : '' }}>No</option>
    </select>
</div>

<div class="form-group mb-3">
    <label>Is This Individual a Member Trustee?</label>
    <select class="form-control" name="is_member_trustee[]">
        <option value="Yes" {{ old('is_member_trustee', @$editMember->is_member_trustee) == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ old('is_member_trustee', @$editMember->is_member_trustee) == 'No' ? 'selected' : '' }}>No</option>
    </select>
</div>

<div class="form-group mb-3">
    <label>Is Online Banking Required?</label>
    <select class="form-control" name="is_online_banking_required[]">
        <option value="Yes" {{ old('is_online_banking_required', @$editMember->is_online_banking_required) == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ old('is_online_banking_required', @$editMember->is_online_banking_required) == 'No' ? 'selected' : '' }}>No</option>
    </select>
</div>


                                                                                <button type="button" class="btn btn-danger remove-member">Remove</button>
                                                                                <hr>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" id="add-member" class="btn btn-primary">Add Member</button>



                                                                        <script>
                                                                            document.addEventListener('DOMContentLoaded', function () {
                                                                                const addMemberBtn = document.getElementById('add-member');
                                                                                const memberFormContainer = document.getElementById('member-form-container');

                                                                                addMemberBtn.addEventListener('click', function () {
                                                                                    const newMemberForm = document.querySelector('.member-form').cloneNode(true);
                                                                                    newMemberForm.querySelectorAll('input, textarea, select').forEach(input => {
                                                                                        input.value = ''; // Clear the inputs
                                                                                    });
                                                                                    memberFormContainer.appendChild(newMemberForm);
                                                                                });

                                                                                memberFormContainer.addEventListener('click', function (e) {
                                                                                    if (e.target.classList.contains('remove-member')) {
                                                                                        if (document.querySelectorAll('.member-form').length > 1) {
                                                                                            e.target.closest('.member-form').remove();
                                                                                        } else {
                                                                                            alert('At least one member form must remain.');
                                                                                        }
                                                                                    }
                                                                                });
                                                                            });
                                                                        </script>


                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank btn-label-secondary waves-effect">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step-bank btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepSecond" class="step-content-bank" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Choose Your Account</h4>
                                                                    </div>
                                                                    <div class="row g-6">


                                                                        <div class="form-group">
                                                                            <label for="account_opening">I/We would like to open:</label>
                                                                            <div class="form-group">
                                                                                <label for="account_opening">I/We would like to open:</label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="sipp_ssas_account[]" value="sipp_ssas_account" id="sipp_ssas_account"
                                                                                    {{ (is_array(old('sipp_ssas_account', $editMember->sipp_ssas_account ?? [])) && in_array('sipp_ssas_account', old('sipp_ssas_account', $editMember->sipp_ssas_account ?? []))) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="sipp_ssas_account">
                                                                                        A SIPP/SSAS Account Only
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="cheque_book_required[]" value="cheque_book_required" id="cheque_book_required"
                                                                                    {{ (is_array(old('cheque_book_required', $editMember->cheque_book_required ?? [])) && in_array('cheque_book_required', old('cheque_book_required', $editMember->cheque_book_required ?? []))) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="cheque_book_required">
                                                                                        Is a cheque book required
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="fixed_term_savings_sipp_ssas_account[]" value="fixed_term_savings_sipp_ssas_account" id="fixed_term_savings_sipp_ssas_account"
                                                                                    {{ (is_array(old('fixed_term_savings_sipp_ssas_account', $editMember->fixed_term_savings_sipp_ssas_account ?? [])) && in_array('fixed_term_savings_sipp_ssas_account', old('fixed_term_savings_sipp_ssas_account', $editMember->fixed_term_savings_sipp_ssas_account ?? []))) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label" for="fixed_term_savings_sipp_ssas_account">
                                                                                        A Fixed Term Savings Account and a SIPP/SSAS Account (please complete Section 4)
                                                                                    </label>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                        <p class="mt-3">*Please note a SIPP/SSAS Account with Metro Bank is also required in order to open a Fixed Term Savings Account.</p>



                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank btn-outline-secondary">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step-bank btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepSecond" class="step-content-bank" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Your Fixed Term Deposit Details</h4>
                                                                    </div>
                                                                    <div class="row g-6">


                                                                        <div class="form-group row">
                                                                            <div class="col-md-6">
                                                                                <label for="amount_to_be_deposited">Amount to be deposited</label>
                                                                                <input type="number" class="form-control" id="amount_to_be_deposited" name="amount_to_be_deposited" value="{{ @$editMember->amount_to_be_deposited }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="term_months">Term (months)</label>
                                                                                <input type="text" class="form-control" id="term_months" name="term_months" value="{{ @$editMember->term_months }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group mt-3">
                                                                            <label>Funds to be deposited by:</label><br>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="funds_deposited_by[]" value="cheque" id="cheque_option"
                                                                                {{ (is_array(old('funds_deposited_by', $editMember->funds_deposited_by ?? [])) && in_array('cheque', old('funds_deposited_by', $editMember->funds_deposited_by ?? []))) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="cheque_option">
                                                                                    Cheque made payable to the Pension Scheme
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="funds_deposited_by[]" value="electronic_transfer" id="electronic_transfer_option"
                                                                                {{ (is_array(old('funds_deposited_by', $editMember->funds_deposited_by ?? [])) && in_array('electronic_transfer', old('funds_deposited_by', $editMember->funds_deposited_by ?? []))) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="electronic_transfer_option">
                                                                                    Electronic transfer from another bank (account details to which funds are to be sent will be provided by Metro Bank once the SIPP/SSAS Account has been opened)
                                                                                </label>
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank btn-label-secondary waves-effect">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step-bank btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepSecond" class="step-content-bank" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Manadate</h4>
                                                                    </div>
                                                                    <div class="row g-6">

                                                                        <div class="form-group">
                                                                            <label>In this section, you tell us how many Authorised Signatories are required to operate this account.</label>
                                                                            <p>Completion of this Mandate authorises Metro Bank to accept all instructions given, or acts performed, in accordance with the "Our Service Relationship with Business Customers" brochure and/or this Mandate on behalf of the Trustees of the Pension Scheme.</p>
                                                                            <div class="form-check">
    <input class="form-check-input" type="checkbox" name="professional_trustee_only" id="professional_trustee_only"
    {{ old('professional_trustee_only', $editMember->professional_trustee_only ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="professional_trustee_only">
        Professional Trustee(s) only to sign
    </label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" name="authorised_signatories" id="authorised_signatories"
    {{ old('authorised_signatories', $editMember->authorised_signatories ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="authorised_signatories">
        Please specify the number of authorised signatories on behalf of Professional Trustees
    </label>
</div>

                                                                        </div>

                                                                        <div class="form-group mt-3">
                                                                            <label>
                                                                                Please write below the specific instructions for signing transactions: (we need to know specifically who will be signing transactions on this account. We can only accept instructions that are signed in accordance with these instructions)
                                                                            </label>
                                                                            <textarea class="form-control" name="signing_instructions" rows="3">{{ old('signing_instructions', $editMember->signing_instructions ?? '') }}</textarea>

                                                                        </div>

                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank btn-label-secondary waves-effect ">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step-bank btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepSecond" class="step-content-bank" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Privacy Notice</h4>
                                                                    </div>
                                                                    <div class="row g-6">


                                                                        <!-- Fraud Prevention Agencies and Declaration Section -->
                                                                        <div class="form-group">
                                                                            <h4>Fraud Prevention Agencies</h4>
                                                                            <p>If you give false or inaccurate information and fraud is identified or suspected, details may be passed to fraud prevention agencies and/or CRA to prevent fraud and money laundering. Law enforcement agencies may access and use this information.</p>
                                                                        </div>

                                                                        <!-- Declaration Section -->
                                                                        <div class="form-group">
                                                                            <h4>Declaration</h4>
                                                                            <p>
                                                                                You authorize Metro Bank PLC to disclose details of your account(s) to your professional adviser (as detailed below) and your pension provider as named on the application form or the successors in title.
                                                                            </p>
                                                                            <p>
                                                                                You acknowledge that your Metro Bank account will be subject to the terms and conditions outlined in the documents <strong>"Our Service Relationship with Business Customers"</strong> and the <strong>"Important Information Summary"</strong> for this product.
                                                                            </p>
                                                                        </div>

                                                                        <!-- Certification Section -->
                                                                        <div class="form-group">
                                                                            <h4>Certification</h4>
                                                                            <p>I certify that I have reviewed the Pension Trust Deed in respect of the above-named Pension Scheme and:</p>
                                                                            <ul>
                                                                                <li>The person has been properly constituted</li>
                                                                                <li>The trustees are empowered to open the account</li>
                                                                                <li>The trustees have been provided with all required banking services</li>
                                                                            </ul>
                                                                        </div>

                                                                        <!-- Professional Trustee(s) Section -->
                                                                        <div class="form-group mt-4">
                                                                            <h4>Professional Trustee(s)</h4>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="print_name">Print Name</label>
                                                                                    <input type="text" class="form-control" name="privacy_print_name[]" placeholder="Enter Name" value="{{ @$editMember->privacy_print_name }}">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="signature">Signature</label>
                                                                                    <input type="text" class="form-control" name="privacy_signature[]" placeholder="Enter Signature" value="{{ @$editMember->privacy_signature }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-6">
                                                                                    <label for="position">Position</label>
                                                                                    <input type="text" class="form-control" name="privacy_position[]" placeholder="Enter Position" value="{{ @$editMember->privacy_position }}">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="date">Date</label>
                                                                                    <input type="date" class="form-control" name="privacy_date[]" value="{{ @$editMember->privacy_date }}">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Repeat for additional Professional Trustee -->
                                                                            <button type="button" class="btn btn-secondary mt-3" onclick="addTrustee()">Add Trustee</button>
                                                                        </div>


                                                                        <script>
                                                                            function addTrustee() {
                                                                                const container = document.querySelector('.container');
                                                                                const trusteeSection = document.createElement('div');
                                                                                trusteeSection.innerHTML = `
            <div class="row mt-4">
                <div class="col-md-6">
                    <label for="print_name">Print Name</label>
                    <input type="text" class="form-control" name="print_name[]" placeholder="Enter Name" >
                </div>
                <div class="col-md-6">
                    <label for="signature">Signature</label>
                    <input type="text" class="form-control" name="signature[]" placeholder="Enter Signature" >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="position">Position</label>
                    <input type="text" class="form-control" name="position[]" placeholder="Enter Position" >
                </div>
                <div class="col-md-6">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date[]" >
                </div>
            </div>`;
                                                                                container.appendChild(trusteeSection);
                                                                            }
                                                                        </script>


                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank btn-label-secondary waves-effect">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step-bank btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="stepSecond" class="step-content-bank" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Declaration and Signatures</h4>
                                                                    </div>
                                                                    <div class="row g-6">

                                                                        <div class="form-group">
                                                                            <h4>Member Trustee(s)</h4>

                                                                            <!-- Repeater Section -->
                                                                            <div id="trustee-section">
                                                                                <!-- First Trustee (Initial fields) -->
                                                                                <div class="row trustee-entry mb-3" id="trustee_1">
                                                                                    <div class="col-md-4">
                                                                                        <label for="trustee_name_1">Print Name</label>
                                                                                        <input type="text" class="form-control" name="trustee_name[]" id="trustee_name_1" placeholder="Enter Trustee Name" value="{{ @$editMember->trustee_name }}">
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label for="trustee_signature_1">Signature</label>
                                                                                        <input type="text" class="form-control" name="trustee_signature[]" id="trustee_signature_1" placeholder="Enter Signature" value="{{ @$editMember->trustee_signature }}">
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label for="trustee_date_1">Date</label>
                                                                                        <input type="date" class="form-control" name="trustee_date[]" id="trustee_date_1" value="{{ @$editMember->trustee_date }}">
                                                                                    </div>
                                                                                    <div class="col-md-1 d-flex align-items-end">
                                                                                        <button type="button" class="btn btn-danger remove-trustee-btn" data-id="trustee_1">Remove</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Button to Add More Trustee Fields -->
                                                                            <div class="form-group">
                                                                                <button type="button" class="btn btn-secondary" id="add-trustee-btn">Add Another Trustee</button>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Repeater Script -->
                                                                        <script>
                                                                            let trusteeCount = 1;

                                                                            // Function to add more trustee entries dynamically
                                                                            document.getElementById('add-trustee-btn').addEventListener('click', function () {
                                                                                trusteeCount++;
                                                                                let newTrusteeEntry = `
        <div class="row trustee-entry mb-3" id="trustee_${trusteeCount}">
            <div class="col-md-4">
                <label for="trustee_name_${trusteeCount}">Print Name</label>
                <input type="text" class="form-control" name="trustee_name[]" id="trustee_name_${trusteeCount}" placeholder="Enter Trustee Name" >
            </div>
            <div class="col-md-4">
                <label for="trustee_signature_${trusteeCount}">Signature</label>
                <input type="text" class="form-control" name="trustee_signature[]" id="trustee_signature_${trusteeCount}" placeholder="Enter Signature" >
            </div>
            <div class="col-md-3">
                <label for="trustee_date_${trusteeCount}">Date</label>
                <input type="date" class="form-control" name="trustee_date[]" id="trustee_date_${trusteeCount}" >
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-trustee-btn" data-id="trustee_${trusteeCount}">Remove</button>
            </div>
        </div>`;

                                                                                document.getElementById('trustee-section').insertAdjacentHTML('beforeend', newTrusteeEntry);

                                                                                // Add event listener to the newly added remove button
                                                                                document.querySelector(`#trustee_${trusteeCount} .remove-trustee-btn`).addEventListener('click', function () {
                                                                                    document.getElementById(this.getAttribute('data-id')).remove();
                                                                                });
                                                                            });

                                                                            // Function to remove trustee entries dynamically
                                                                            document.querySelectorAll('.remove-trustee-btn').forEach(function (btn) {
                                                                                btn.addEventListener('click', function () {
                                                                                    document.getElementById(this.getAttribute('data-id')).remove();
                                                                                });
                                                                            });
                                                                        </script>


                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank  btn-label-secondary waves-effect">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step-bank btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
{{--                                                                       professionl adviser details     --}}
                                                                <div id="stepSecond" class="step-content-bank" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Professional Adviser Details</h4>
                                                                    </div>
                                                                    <div class="row g-6">

                                                                        <div class="row">
                                                                            <!-- Name of Company -->
                                                                            <div class="col-md-4">
                                                                                <label for="company_name">Name of Company</label>
                                                                                <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" value="{{ @$editMember->company_name }}">
                                                                            </div>
                                                                            <!-- Address -->
                                                                            <div class="col-md-4">
                                                                                <label for="company_address">Address</label>
                                                                                <input type="text" class="form-control" name="company_address" placeholder="Enter Address" value="{{ @$editMember->company_address }}">
                                                                            </div>
                                                                            <!-- Post Code -->
                                                                            <div class="col-md-4">
                                                                                <label for="company_post_code">Post Code</label>
                                                                                <input type="text" class="form-control" name="company_post_code" placeholder="Enter Post Code" value="{{ @$editMember->company_post_code }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mt-2">
                                                                            <!-- Telephone Number -->
                                                                            <div class="col-md-4">
                                                                                <label for="company_telephone">Telephone Number</label>
                                                                                <input type="text" class="form-control" name="company_telephone" placeholder="Enter Telephone Number" value="{{ @$editMember->company_telephone }}">
                                                                            </div>
                                                                            <!-- Contact Name -->
                                                                            <div class="col-md-4">
                                                                                <label for="contact_person">Contact Name</label>
                                                                                <input type="text" class="form-control" name="contact_person" placeholder="Enter Contact Name" value="{{ @$editMember->contact_person }}">
                                                                            </div>
                                                                            <!-- Email -->
                                                                            <div class="col-md-4">
                                                                                <label for="contact_email">Email</label>
                                                                                <input type="email" class="form-control" name="contact_email" placeholder="Enter Email Address" value="{{ @$editMember->contact_email }}">
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step-bank btn-label-secondary waves-effect">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / Multi Steps Registration -->
                                            </div>
                                        </div>

                                        <script>
                                              document.addEventListener('DOMContentLoaded', function () {
                                                const nextButtons = document.querySelectorAll('.btn-next-step-bank');
                                                const prevButtons = document.querySelectorAll('.btn-prev-step-bank');
                                                const steps = document.querySelectorAll('.step-content-bank');
                                                let currentStep = 0;

                                                // Show next step
                                                nextButtons.forEach((button) => {
                                                    button.addEventListener('click', (event) => {
                                                        event.preventDefault(); // Prevent default form behavior
                                                        if (currentStep < steps.length - 1) {
                                                            steps[currentStep].style.display = 'none'; // Hide current step
                                                            currentStep++; // Increment to next step
                                                            steps[currentStep].style.display = 'block'; // Show next step
                                                        }
                                                        togglePrevButton();
                                                    });
                                                });

                                                // Show previous step
                                                prevButtons.forEach((button) => {
                                                    button.addEventListener('click', (event) => {
                                                        event.preventDefault(); // Prevent default form behavior
                                                        if (currentStep > 0) {
                                                            steps[currentStep].style.display = 'none'; // Hide current step
                                                            currentStep--; // Decrement to previous step
                                                            steps[currentStep].style.display = 'block'; // Show previous step
                                                        }
                                                        togglePrevButton();
                                                    });
                                                });

                                                // Enable/Disable previous button
                                                function togglePrevButton() {
                                                    prevButtons.forEach((button) => {
                                                        button.disabled = currentStep === 0;
                                                    });
                                                }
                                            });

                                        </script>
                                        <!-- =========================== bank account further details card end =========================== !-->

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Non Standard Assets -->
                                <div id="non_standard_assets" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Self-Certification Form</h4>
                                    </div>
                                    <div class="row g-6">
                                        <!-- =========================== Self Certification form further details card start =========================== !-->
                                        <div class="registration-container registration-overlay bg-pattern">
                                            <div class="registration-content row">
                                                <!-- Multi Steps Registration -->
                                                <div class="d-flex col-12 align-items-center justify-content-center bg-pattern p-5">
                                                    <div class="col-10">
                                                        <div id="multiStepWizard" class="form-wizard border-none shadow-none mt-5">
                                                            <div class="form-wizard-content px-0">

                                                                <!-- Step 1: Personal Details -->
                                                                <div id="personalStep" class="wizard-step" style="display: block;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Part 1</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <!-- ===================  part 1 start ============= !-->
                                                                        <!-- Important Information Section -->
                                                                        <h3>Important: Please read this information before you complete the form</h3>

                                                                        <p><strong>Why we are asking you to complete this form:</strong></p>
                                                                        <p>Foreign Account Tax Compliance Act (FATCA) and Common Reporting Standard (CRS) regulations require financial institutions like us to collect and report information about their customers who are tax residents. Under these regulations, we have to ask you to provide the information requested in this form. Under CRS, the UK adopted the Wider Approach, and though Alltrust investment products are exempt from reporting, we still need to collect tax resident information where necessary or appropriate to confirm.</p>

                                                                        <p><strong>About tax residence:</strong></p>
                                                                        <p>Each country/jurisdiction has its own rules for defining tax residence. In general, you are tax resident in the country/jurisdiction where you live. You can be tax resident in more than one country/jurisdiction. If you do not know how to determine your tax residence status, please check the OECD website or speak to a professional tax advisor.</p>

                                                                        <p><strong>What you need to do:</strong></p>
                                                                        <p>You need to complete this form, even if you have given us information about your tax status in the past. Each investment, beneficiary receiving benefit payments, and account holder is required to fill in a certification (account holder) and may need to complete more than one form (for example, if they have multiple accounts).</p>

                                                                        <p><strong>Completing this form on behalf of someone else:</strong></p>
                                                                        <p>If you are completing this form on behalf of someone else, make sure you tell them what you have done and in what capacity you are signing on their behalf (e.g., as an attorney). You will also need to fill in Part 3 if you are acting on behalf of someone else. You will be asked to confirm your authority, and the type of authority you have (such as a court-appointed representative, power of attorney, etc.).</p>

                                                                        <p><strong>What we will do with this information:</strong></p>
                                                                        <p>We will keep a record of this form and the information it contains. If you are the account holder, completing this form on their behalf will mean you are required to keep this information updated and submit any necessary updates to us if your tax residency changes. This may require submitting an updated form to the relevant authority.</p>

                                                                        <p><strong>Before you begin:</strong></p>
                                                                        <p>You will need your Tax Identification Number (TIN) or equivalent for each country/jurisdiction where you are tax resident.</p>
                                                                        <p>A TIN is a unique combination of letters or numbers assigned to you by your country/jurisdiction’s tax authority and is used to identify you for tax purposes. It will usually be found in any letters or correspondence you receive from your tax authority. Some countries/jurisdictions do not issue TINs, and in those cases, you will need to provide another form of tax identification such as a social security number or a resident registration number.</p>

                                                                        <p><strong>Where to go for help:</strong></p>
                                                                        <p>If you have any questions about this form or the information requested in it, please contact us. You can also find more information about CRS and the government’s tax rules on the OECD website.</p>

                                                                        <p>If you are not sure what your tax residence status is, please speak to a professional tax advisor. You can also find a list of definitions in the Appendix.</p>


                                                                        <h3>Individual Tax Residence Self-Certification Form</h3>
                                                                        <p>Please complete Parts 1–4 in BLOCK CAPITALS</p>

                                                                        <h4>Part 1: Identifying who you are</h4>

                                                                        <h4 class="mt-4">Part 2: Tax Information</h4>

                                                                        <h4 class="mt-4">Part 3: Completing this form on behalf of someone else</h4>
                                                                        <p>If you are completing this form on behalf of someone else, please provide your details below:</p>

                                                                        <h4 class="mt-4">Part 4: Declaration and Signature</h4>
                                                                        <p>I declare that the information provided in this form is accurate and complete. I will notify the relevant authorities of any changes in my information.</p>

                                                                        <!-- Section: Part 1 - Personal Information -->
                                                                        <h4>Part 1: Personal Information</h4>

                                                                        <!-- Surname, First Name, and Middle Name Fields -->
                                                                        <div class="row">
    <div class="col-md-4">
        <label for="surname">Surname</label>
        <input type="text" class="form-control" name="part_one_surname" placeholder="Enter Surname" 
            value="{{ $editMember->part_one_surname ?? '' }}">
    </div>
    <div class="col-md-4">
        <label for="given_name">Given Name</label>
        <input type="text" class="form-control" name="given_name" placeholder="Enter Given Name" 
            value="{{ $editMember->given_name ?? '' }}">
    </div>
    <div class="col-md-4">
        <label for="additional_name">Additional Name</label>
        <input type="text" class="form-control" name="additional_name" placeholder="Enter Additional Name" 
            value="{{ $editMember->additional_name ?? '' }}">
    </div>
</div>

<!-- Title and Gender Fields -->
<div class="row mt-2">
    <div class="col-md-4">
        <label for="honorific_title">Title</label>
        <select class="form-control" name="honorific_title">
            <option value="Mr" {{ ($editMember->honorific_title ?? '') == 'Mr' ? 'selected' : '' }}>Mr</option>
            <option value="Mrs" {{ ($editMember->honorific_title ?? '') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
            <option value="Miss" {{ ($editMember->honorific_title ?? '') == 'Miss' ? 'selected' : '' }}>Miss</option>
            <option value="Ms" {{ ($editMember->honorific_title ?? '') == 'Ms' ? 'selected' : '' }}>Ms</option>
            <option value="Other" {{ ($editMember->honorific_title ?? '') == 'Other' ? 'selected' : '' }}>Other (specify)</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="gender">Gender</label>
        <select class="form-control" name="part_one_gender">
            <option value="Male" {{ ($editMember->part_one_gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ ($editMember->part_one_gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ ($editMember->part_one_gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>
</div>

<!-- Address Fields -->
<div class="row mt-2">
    <div class="col-md-12">
        <label for="home_address">Home Address</label>
        <input type="text" class="form-control" name="home_address" placeholder="Enter Home Address" 
            value="{{ $editMember->home_address ?? '' }}">
    </div>
    <div class="col-md-6">
        <label for="locality">Locality</label>
        <input type="text" class="form-control" name="locality" placeholder="Enter Locality" 
            value="{{ $editMember->locality ?? '' }}">
    </div>
    <div class="col-md-6">
        <label for="zip_code">ZIP Code</label>
        <input type="text" class="form-control" name="zip_code" placeholder="Enter ZIP Code" 
            value="{{ $editMember->zip_code ?? '' }}">
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <label for="region">Region/State/Province</label>
        <input type="text" class="form-control" name="region" placeholder="Enter Region" 
            value="{{ $editMember->region ?? '' }}">
    </div>
    <div class="col-md-6">
        <label for="nation">Country of Residence</label>
        <input type="text" class="form-control" name="nation" placeholder="Enter Country" 
            value="{{ $editMember->nation ?? '' }}">
    </div>
</div>

<!-- Date of Birth Field -->
<div class="row mt-2">
    <div class="col-md-12">
        <label for="birth_date">Date of Birth</label>
        <input type="date" class="form-control" name="birth_date" 
            value="{{ $editMember->birth_date ?? '' }}">
    </div>
</div>

<!-- Birthplace Fields -->
<div class="row mt-2">
    <div class="col-md-6">
        <label for="birthplace_city">City of Birth</label>
        <input type="text" class="form-control" name="birthplace_city" placeholder="Enter City of Birth" 
            value="{{ $editMember->birthplace_city ?? '' }}">
    </div>
    <div class="col-md-6">
        <label for="birthplace_nation">Country of Birth</label>
        <input type="text" class="form-control" name="birthplace_nation" placeholder="Enter Country of Birth" 
            value="{{ $editMember->birthplace_nation ?? '' }}">
    </div>
</div>



                                                                        <!-- ===================  part 1 end ============= !-->
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-wizard btn-label-secondary waves-effect" disabled>
                                                                                <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-wizard btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="arrow-right-icon ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 2: Adviser Details -->
                                                                <div id="adviserStep" class="wizard-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Part 2</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <!-- ========================= part 2 start ======================= !-->

                                                                        <h4>Tax Residency and TIN Information</h4>

                                                                        <p>Your country/jurisdiction of residence for tax purposes and related Taxpayer Identification Number or functional equivalent ("TIN"). Please complete the table below by telling us:</p>
                                                                        <ul>
                                                                            <li>Which country(ies)/jurisdiction(s) you are tax resident in; and</li>
                                                                            <li>Your TIN for each country/jurisdiction indicated.</li>
                                                                        </ul>
                                                                        <p>If you do not have a TIN, please provide the appropriate reason A, B, or C:</p>
                                                                        <ul>
                                                                            <li><strong>Reason A</strong>: The country/jurisdiction where I am liable to pay tax does not issue TINs to its residents.</li>
                                                                            <li><strong>Reason B</strong>: I am otherwise unable to obtain a TIN or equivalent number. (Please explain why below if you have selected this reason).</li>
                                                                            <li><strong>Reason C</strong>: The laws of my country/jurisdiction do not require me to provide a TIN.</li>
                                                                        </ul>

                                                                        <!-- TIN Information Table -->
                                                                        <div class="row g-10">
                                                                            <div class="col-md-4">
                                                                                <label for="tax_residence_country">Country/Jurisdiction of Tax Residence</label>
                                                                                <input type="text" class="form-control" name="tax_residence_country[]" placeholder="Enter Country of Residence"value="{{ $editMember->tax_residence_country ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="tax_identification_number">Taxpayer Identification Number (TIN)</label>
                                                                                <input type="text" class="form-control" name="tin_number[]" placeholder="Enter TIN"value="{{ $editMember->tin_number ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="tin_reason">If no TIN available, enter Reason A, B, or C</label>
                                                                                <input type="text" class="form-control" name="tin_reason[]" placeholder="Enter Reason (A, B, or C)"value="{{ $editMember->tin_reason ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <input type="text" class="form-control" name="tax_residence_country[]" placeholder="Enter Country of Residence"value="{{ $editMember->tax_residence_country ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="text" class="form-control" name="tax_identification_number[]" placeholder="Enter TIN"value="{{ $editMember->tax_identification_number ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="text" class="form-control" name="tin_reason[]" placeholder="Enter Reason (A, B, or C)"value="{{ $editMember->tin_reason ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <input type="text" class="form-control" name="tax_residence_country[]" placeholder="Enter Country of Residence"value="{{ $editMember->tax_residence_country ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">

                                                                                <input type="text" class="form-control" name="tax_identification_number[]" placeholder="Enter TIN"value="{{ $editMember->tax_identification_number ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">

                                                                                <input type="text" class="form-control" name="tin_reason[]" placeholder="Enter Reason (A, B, or C)"value="{{ $editMember->tin_reason ?? '' }}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Reason B Explanation -->
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-12">
                                                                                <label for="reason_b_explanation">If you selected Reason B, please explain why you are unable to obtain a TIN:</label>
                                                                                <textarea class="form-control" name="reason_b_explanation" rows="3" placeholder="Enter explanation for Reason B">{{ $editMember->reason_b_explanation ?? '' }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Additional confirmation -->
                                                                        <div class="form-group mt-4">
    <label>
        <input type="checkbox" name="tax_residence_more_than_three" value="yes"
            {{ isset($editMember) && $editMember->tax_residence_more_than_three == 'yes' ? 'checked' : '' }}>
        If you are tax resident in more than three countries/jurisdictions, please use a separate sheet and confirm by placing an 'X' in the box.
    </label>
</div>

<div class="form-group">
    <label>
        <input type="checkbox" name="confirm_all_residences" value="yes"
            {{ isset($editMember) && $editMember->confirm_all_residences == 'yes' ? 'checked' : '' }}>
        Please confirm by placing an 'X' in this box that you have included ALL of the countries/jurisdictions in which you are tax resident.
    </label>
</div>

<!-- US Person Section -->
<div class="form-group">
    <label>Are you a US Person?</label><br>
    <label>
        <input type="radio" name="us_person" value="No"
            {{ isset($editMember) && $editMember->us_person == 'No' ? 'checked' : '' }}> No
    </label>
    <label>
        <input type="radio" name="us_person" value="Yes"
            {{ isset($editMember) && $editMember->us_person == 'Yes' ? 'checked' : '' }}> 
        Yes (Please ensure your US TIN is included above)
    </label>
</div>


                                                                        <p><strong>Note:</strong> US Person for FATCA purposes includes US tax residents, US citizens (even if residing outside the USA), and resident aliens of the USA.</p>


                                                                        <!-- ========================= part 2 end ======================= !-->

                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-wizard btn-label-secondary waves-effect">
                                                                                <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-wizard btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="arrow-right-icon ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="adviserStep" class="wizard-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Part 3</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <!-- ========================= part 3 start ======================= !-->
                                                                        <!-- ========================= part 3 start ======================= !-->


                                                                        <h4>Part 3: Address and Tax Residency Mismatch</h4>

                                                                        <p>If the address in Part 1 is different from the country(ies)/jurisdiction(s) where you are tax resident in Part 2, you need to tell us why.</p>

                                                                        <p><strong>The country/jurisdiction you live in (Part 1.B) is different from the country(ies)/jurisdiction(s) where you are tax resident (Part 2).</strong></p>
                                                                        <p><strong>Please place an 'X' against one of the following options:</strong></p>

                                                                        <!-- Option 1 -->
                                                                        <div class="form-check">
    <input class="form-check-input" type="radio" name="residency_mismatch_reason" id="option_student" value="student"
        {{ isset($editMember) && $editMember->residency_mismatch_reason == 'student' ? 'checked' : '' }}>
    <label class="form-check-label" for="option_student">
        I am a student studying in the country/jurisdiction in Part 1.B and have not yet lived there long enough to become tax resident.
    </label>
</div>

<!-- Option 2 -->
<div class="form-check">
    <input class="form-check-input" type="radio" name="residency_mismatch_reason" id="option_working" value="working"
        {{ isset($editMember) && $editMember->residency_mismatch_reason == 'working' ? 'checked' : '' }}>
    <label class="form-check-label" for="option_working">
        I am working in the country/jurisdiction in Part 1.B and have not yet lived there long enough to become tax resident. I am a diplomat or a member of the armed forces posted to the country/jurisdiction in Part 1.B.
    </label>
</div>

<!-- Option 3 -->
<div class="form-check">
    <input class="form-check-input" type="radio" name="residency_mismatch_reason" id="option_moving" value="moving"
        {{ isset($editMember) && $editMember->residency_mismatch_reason == 'moving' ? 'checked' : '' }}>
    <label class="form-check-label" for="option_moving">
        I have recently moved to the country/jurisdiction that I am opening a bank account in and I am not yet tax resident in this country/jurisdiction. I am still tax resident in the country(ies)/jurisdiction(s) in Part 2.
    </label>
</div>

<!-- Option 4 -->
<div class="form-check">
    <input class="form-check-input" type="radio" name="residency_mismatch_reason" id="option_other" value="other"
        {{ isset($editMember) && $editMember->residency_mismatch_reason == 'other' ? 'checked' : '' }}>
    <label class="form-check-label" for="option_other">
        None of the above - please provide details in the space below.
    </label>
</div>

<!-- Textarea for additional details if Option 4 is selected -->
<div class="form-group mt-3">
    <label for="additional_details">Please provide details here (if applicable):</label>
    <textarea class="form-control" id="additional_details" name="additional_details" rows="3" placeholder="Enter additional details if none of the above options apply">{{ isset($editMember) ? $editMember->additional_details : '' }}</textarea>
</div>

                                                                        <!-- ========================= part 3 end ======================= !-->

                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-wizard btn-label-secondary waves-effect">
                                                                                <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-wizard btn-label-primary waves-effect">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="arrow-right-icon ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="adviserStep" class="wizard-step" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Part 4</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <!-- ========================= part 4 start ======================= !-->

                                                                        <h4>Declarations and Signature</h4>

                                                                        <p>I certify that I am the account holder (or am authorized to sign for the account holder) of all the account(s) to which this form relates.</p>
                                                                        <p>I understand that the information I have provided is covered by the Privacy Notice and the terms and conditions of my account(s), in particular how Alltrust may use and share it.</p>

                                                                        <p>I acknowledge that Alltrust may share this information with the tax authorities of the country(ies)/jurisdiction(s) where I hold my account(s), and that those tax authorities may exchange this information between themselves as part of the intergovernmental agreements to exchange Financial Account information. If I have completed this form on behalf of the account holder, I certify that I have their authority and that all relevant individuals have been made aware of the Privacy Notice, and the individual rights and information it sets out. I will notify the account holder within 30 days of signing this form, that I have provided this information to Alltrust and that it may be passed to the tax authorities of all countries/jurisdictions where the account holder maintains accounts.</p>

                                                                        <p><strong>I declare that all statements made in this declaration are, to the best of my knowledge and belief, correct and complete.</strong></p>

                                                                        <p>I agree to tell Alltrust within 30 days of any change in circumstance that affects the tax residence status of the person named in Part 1 of this form, or means that the information contained within the form becomes out of date. I agree to provide an updated self-certification form to Alltrust within 90 days of any such changes.</p>

                                                                        <!-- Signature Field -->
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label for="signature">Signature</label>
                                                                                <textarea class="form-control" name="part_four_signature" id="signature" placeholder="Signature" rows="3">
                                                                                    {{ $editMember->part_four_signature ?? '' }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Print Name Field -->
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                <label for="print_name">Print Name</label>
                                                                                <input type="text" class="form-control" name="signature_print_name" id="print_name" placeholder="Enter Print Name" value="{{ $editMember->signature_print_name ?? '' }}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Date Fields -->
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-4">
                                                                                <label for="sign_day">Day</label>
                                                                                <input type="number" class="form-control" name="sign_day" id="sign_day" placeholder="Day" value="{{ $editMember->sign_day ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="sign_month">Month</label>
                                                                                <input type="number" class="form-control" name="sign_month" id="sign_month" placeholder="Month" value="{{ $editMember->sign_month ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="sign_year">Year</label>
                                                                                <input type="number" class="form-control" name="sign_year" id="sign_year" placeholder="Year" value="{{ $editMember->sign_year ?? '' }}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Capacity Field -->
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                <label for="capacity">Capacity</label>
                                                                                <input type="text" class="form-control" name="capacity" id="capacity" placeholder="Enter Capacity" value="{{ $editMember->capacity ?? '' }}">
                                                                            </div>
                                                                        </div>


                                                                        <h4>Appendix - Definitions</h4>

                                                                        <p>These are selected definitions provided to assist you with the completion of this form. Further details can be found within the OECD Common Reporting Standard for Automatic Exchange of Financial Account Information (the CRS), the associated Commentary to the CRS, and domestic guidance. This can be found at the following link: <a href="http://www.oecd.org/tax/automatic-exchange">OECD CRS Website</a></p>

                                                                        <p>If you have any questions, please contact your tax adviser or domestic tax authority.</p>

                                                                        <!-- Definitions List -->
                                                                        <ul>
                                                                            <li><strong>Account Holder</strong>: The term "Account Holder" means the person listed or identified as the holder of a Financial Account. A person, other than a Financial Institution, holding a Financial Account for the benefit of another person as an agent, a custodian, a nominee, a signatory, an investment advisor, or intermediary, or as a legal guardian, is not treated as the Account Holder. In these circumstances, that other person is the Account Holder.</li>

                                                                            <li><strong>Controlling Person</strong>: This is a natural person who exercises control over an entity. Where an entity is a Passive Non-Financial Entity (NFE), the Financial Institution must determine whether such Controlling Persons are Reportable Persons.</li>

                                                                            <li><strong>Entity</strong>: The term "Entity" means a legal person or a legal arrangement, such as a corporation, organisation, partnership, trust, or foundation.</li>

                                                                            <li><strong>Financial Account</strong>: A Financial Account is an account maintained by a Financial Institution and includes: Depository Accounts; Custodial Accounts; Equity and Debt interest in certain Investment Entities; Cash Value Insurance Contracts; and Annuity Contracts.</li>

                                                                            <li><strong>Participating Jurisdiction</strong>: A Participating Jurisdiction is a jurisdiction with an agreement in place pursuant to which it will provide the information set out in the Common Reporting Standard.</li>

                                                                            <li><strong>Reportable Account</strong>: The term "Reportable Account" means an account held by one or more Reportable Persons or by a Passive NFE with one or more Controlling Persons that is a Reportable Person.</li>

                                                                            <li><strong>Reportable Jurisdiction</strong>: A Reportable Jurisdiction is a jurisdiction with an obligation to provide financial account information in place.</li>

                                                                            <li><strong>Reportable Person</strong>: A Reportable Person is an individual that is tax resident in a Reportable Jurisdiction under the laws of that jurisdiction.</li>

                                                                            <li><strong>TIN</strong> (including "functional equivalent"): The term "TIN" means Taxpayer Identification Number or a functional equivalent in the absence of a TIN. A TIN is a unique combination of letters or numbers assigned by a jurisdiction to an individual or an entity and used to identify the individual or entity for tax purposes.</li>
                                                                        </ul>

                                                                        <p>Some jurisdictions do not issue a TIN. However, these jurisdictions often use other high integrity numbers, which can be used for identification purposes. Examples of the types of number include: a social security/insurance number, citizen/personal identification service code/number, and resident registration number.</p>


                                                                        <!-- ========================= part 4 end ======================= !-->

                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-wizard btn-label-secondary waves-effect">
                                                                                <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
{{--                                                                            <button type="button" class="btn-next-wizard btn-label-primary waves-effect">--}}
{{--                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>--}}
{{--                                                                                <i class="arrow-right-icon ti-xs"></i>--}}
{{--                                                                            </button>--}}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / Multi Steps Registration -->
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const nextButtons = document.querySelectorAll('.btn-next-wizard');
                                                const prevButtons = document.querySelectorAll('.btn-prev-wizard');
                                                const steps = document.querySelectorAll('.wizard-step');
                                                let currentStep = 0;

                                                // Show next step
                                                nextButtons.forEach((button) => {
                                                    button.addEventListener('click', () => {
                                                        if (currentStep < steps.length - 1) {
                                                            steps[currentStep].style.display = 'none'; // Hide current step
                                                            currentStep++; // Increment to next step
                                                            steps[currentStep].style.display = 'block'; // Show next step
                                                        }
                                                        togglePrevButton();
                                                    });
                                                });

                                                // Show previous step
                                                prevButtons.forEach((button) => {
                                                    button.addEventListener('click', () => {
                                                        if (currentStep > 0) {
                                                            steps[currentStep].style.display = 'none'; // Hide current step
                                                            currentStep--; // Decrement to previous step
                                                            steps[currentStep].style.display = 'block'; // Show previous step
                                                        }
                                                        togglePrevButton();
                                                    });
                                                });

                                                // Enable/Disable previous button
                                                function togglePrevButton() {
                                                    prevButtons.forEach((button) => {
                                                        button.disabled = currentStep === 0;
                                                    });
                                                }
                                            });

                                        </script>
                                        <!-- =========================== Self Certification form further details card end =========================== !-->

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                 <!-- Users -->
                                <div id="non_standard_assets" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">User </h4>
                                    </div>
                                    <div class="row g-6">
                                        <!-- =========================== Self Certification form further details card start =========================== !-->
                                        <div class="registration-container registration-overlay bg-pattern">
                                            <div class="registration-content row">
                                                <!-- Multi Steps Registration -->
                                                <div class="d-flex col-12 align-items-center justify-content-center bg-pattern p-5">
                                                    <div class="col-10">
                                                        <div id="multiStepWizard" class="form-wizard border-none shadow-none mt-5">
                                                            <div class="form-wizard-content px-0">
 
                                                                    <div class="row g-6">
                                                                        <!-- ========================= part 4 start ======================= !-->

                                                                        <!--<h4>User Details</h4>-->


                                                                        <!-- Print Name Field -->
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                <label for="print_name">Name</label>
                                                                                <input type="text" class="form-control" name="user_name" id="print_name" placeholder="Enter Print Name" value="{{ $editMember->user_name ?? '' }}">
                                                                                @error('user_name')
                                                                                    <div class="text-danger">{{ $message }}</div>
                                                                                @enderror()
                                                                            </div>
                                                                             <div class="col-md-6">
                                                                                <label for="print_name">Email</label>
                                                                                <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter Print Email" value="{{ $editMember->user_email ?? '' }}">
                                                                                 <span class="text-danger" id="user_email_error"></span>
                                                                            </div>
                                                                        </div>
                                                                         
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                 
                                                                                <input type="hidden" class="form-control" value="" name="role_member" id="print_name" placeholder="Enter Print Name" >
                                                                            </div>
                                                                        </div>

                                                                        <!-- Date Fields -->
                                                                     
 
                                                                        <!-- ========================= part 4 end ======================= !-->

                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-wizard btn-label-secondary waves-effect">
                                                                                <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
{{--                                                                            <button type="button" class="btn-next-wizard btn-label-primary waves-effect">--}}
{{--                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>--}}
{{--                                                                                <i class="arrow-right-icon ti-xs"></i>--}}
{{--                                                                            </button>--}}
                                                                        </div>
                                                                    </div>
                                                               

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / Multi Steps Registration -->
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const nextButtons = document.querySelectorAll('.btn-next-wizard');
                                                const prevButtons = document.querySelectorAll('.btn-prev-wizard');
                                                const steps = document.querySelectorAll('.wizard-step');
                                                let currentStep = 0;

                                                // Show next step
                                                nextButtons.forEach((button) => {
                                                    button.addEventListener('click', () => {
                                                        if (currentStep < steps.length - 1) {
                                                            steps[currentStep].style.display = 'none'; // Hide current step
                                                            currentStep++; // Increment to next step
                                                            steps[currentStep].style.display = 'block'; // Show next step
                                                        }
                                                        togglePrevButton();
                                                    });
                                                });

                                                // Show previous step
                                                prevButtons.forEach((button) => {
                                                    button.addEventListener('click', () => {
                                                        if (currentStep > 0) {
                                                            steps[currentStep].style.display = 'none'; // Hide current step
                                                            currentStep--; // Decrement to previous step
                                                            steps[currentStep].style.display = 'block'; // Show previous step
                                                        }
                                                        togglePrevButton();
                                                    });
                                                });

                                                // Enable/Disable previous button
                                                function togglePrevButton() {
                                                    prevButtons.forEach((button) => {
                                                        button.disabled = currentStep === 0;
                                                    });
                                                }
                                            });

                                        </script>
                                        <!-- =========================== Self Certification form further details card end =========================== !-->

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-next">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                <i class="ti ti-arrow-right ti-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <!-- Final Step -->
                                <div id="finalstep" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Save</h4>
                                    </div>
                                    <div class="row g-6" id="finalstep">
                                        <div class="adviser-form">
                                           <!-- ==================== part 4 start ================================== !-->

                                            <div class="form-group d-flex justify-content-center text-center">
                                               <div class="col-8">
                                                   <div class="card-body shadow-sm p-4">
                                                       <h4>Submit Confirmation</h4>

                                                       <p>Before proceeding, please take a moment to review your decision. Submitting this form means that all the information you've provided is final and will be processed accordingly.</p>

                                                       <p><strong><a href="#" style="color: blue;">Are you sure you want to submit?</a></strong></p>

                                                   </div>
                                               </div>
                                                <!-- Submit Button -->
{{--                                                <button type="submit" class="btn btn-primary">Submit</button>--}}
                                            </div>


                                            <!-- ==================== part 4 end ================================== !-->

                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between mt-5">

                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button type="submit" id="sub" class="btn btn-success btn-submit">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Submit</span>
                                            <i class="ti ti-arrow-right ti-xs"></i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Multi Steps Registration -->
        </div>
    </div>

    <!-- JS -->
    <script>
    
    
    document.addEventListener("DOMContentLoaded", function () {
  
    const existingEmails = {!! json_encode(\App\Models\User::pluck('email')->toArray()) !!};
    const userEmailInput = document.getElementById('user_email');
    const submitButton = document.getElementById('sub');
    const errorSpan = document.getElementById('user_email_error'); 
    submitButton.disabled = true;

    userEmailInput.addEventListener('input', function () {
        const email = this.value.trim(); 
        if (userEmailInput.length === 0) {
            userEmailInput.classList.add('input-error');  
            errorSpan.textContent = "Email is required.";
            submitButton.disabled = true;  
        } else {
            userEmailInput.classList.remove('input-error'); 
            errorSpan.textContent = ""; 
            if (existingEmails.includes(email)) {
                errorSpan.textContent = "This email is already registered.";
                submitButton.disabled = true;  
            } else {
                submitButton.disabled = false;  
            }
        }
    });
});


    
    
    // ===============
      document.addEventListener('DOMContentLoaded', function () {
    const nextBtns = document.querySelectorAll('.btn-next');
    const prevBtns = document.querySelectorAll('.btn-prev');
    const contents = document.querySelectorAll('.content');
    let currentStep = 0;

    nextBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); 
            if (currentStep < contents.length - 1) {
                contents[currentStep].style.display = 'none';  
                currentStep++; // Go to next step
                contents[currentStep].style.display = 'block';  
            }
            toggleButtonState();
        });
    });

    prevBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); 
            if (currentStep > 0) {
                contents[currentStep].style.display = 'none';  
                currentStep--;  
                contents[currentStep].style.display = 'block';  
            }
            toggleButtonState();
        });
    });

    function toggleButtonState() {
        prevBtns.forEach((btn) => {
            btn.disabled = currentStep === 0;
        });
    } 
    const addAdviserBtn = document.querySelector('.btn-add-adviser');
    const adviserFormsContainer = document.getElementById('adviserFormsContainer');

    addAdviserBtn.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default behavior (if inside a form)
        const newAdviserForm = document.createElement('div');
        newAdviserForm.classList.add('adviser-form');
        newAdviserForm.innerHTML = `
            <div class="col-md-12 mb-3">
                <label class="form-label" for="adviserName">Adviser Name</label>
                <input type="text" name="adviser_name[]" class="form-control" >
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="adviserFCAReference">Adviser FCA Reference</label>
                <input type="text" name="adviser_fca_reference[]" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                <label>
                    <input type="checkbox" name="approved_for_transfer_db[]" value="yes">
                    Approved for transfer of DB
                </label>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="adviserEmail">Adviser Email</label>
                <input type="email" name="adviser_email[]" class="form-control" >
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="branch">Branch</label>
                <input type="text" name="branch[]" class="form-control" >
            </div>
            <div class="col-md-12 mb-3">
                <label>
                    <input type="checkbox" class="toggle-online-access" name="requires_online_access[]" value="yes">
                    Requires online access
                </label>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <button type="button" class="btn btn-danger btn-remove">Remove</button>
            </div>
        `;
        adviserFormsContainer.appendChild(newAdviserForm);
    });

    // Remove Adviser Form Functionality
    adviserFormsContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('btn-remove')) {
            const adviserForm = event.target.closest('.adviser-form');
            adviserFormsContainer.removeChild(adviserForm);
        }
    });
});





        // Add new Beneficiary row
        document.getElementById('add-beneficiary').addEventListener('click', function() {
            const row = `
            <tr>
                <td><input type="text" class="form-control" name="beneficiary_name[]"></td>
                <td><input type="text" class="form-control" name="beneficiary_relationship[]"></td>
                <td><input type="number" class="form-control" name="beneficiary_percentage[]"></td>
                <td><button type="button" class="btn btn-danger remove-beneficiary">Remove</button></td>
            </tr>
        `;
            document.getElementById('beneficiary-list').insertAdjacentHTML('beforeend', row);
        });

        // Add new Charity row
        document.getElementById('add-charity').addEventListener('click', function() {
            const row = `
            <tr>
                <td><input type="text" class="form-control" name="charity_name[]"></td>
                <td><input type="number" class="form-control" name="charity_percentage[]"></td>
                <td><button type="button" class="btn btn-danger remove-charity">Remove</button></td>
            </tr>
        `;
            document.getElementById('charity-list').insertAdjacentHTML('beforeend', row);
        });

        // Remove Beneficiary row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-beneficiary')) {
                e.target.closest('tr').remove();
            }
        });

        // Remove Charity row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-charity')) {
                e.target.closest('tr').remove();
            }
        });

    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const formSections = document.querySelectorAll(".content");
    const nextButtons = document.querySelectorAll(".btn-next");
    const prevButtons = document.querySelectorAll(".btn-prev");
    const steps = document.querySelectorAll(".step");
    let currentStep = 0;

    function showStep(step) {
        formSections.forEach((section, index) => {
            section.classList.toggle("active", index === step);
        });
        steps.forEach((stepElem, index) => {
            stepElem.classList.toggle("active", index === step);
        });

        checkNextButtonState(); // Check validation on step change
    }

    function validateForm(step) {
        const inputs = formSections[step].querySelectorAll("input[required], select[required], textarea[required]");
        let allFilled = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                allFilled = false;
                input.classList.add("error"); // Add error class
            } else {
                input.classList.remove("error"); // Remove error if filled
            }
        });

        return allFilled;
    }

    function checkNextButtonState() {
        if (validateForm(currentStep)) {
            nextButtons[currentStep].removeAttribute("disabled"); // Enable button
        } else {
            nextButtons[currentStep].setAttribute("disabled", "true"); // Disable button
        }
    }

    nextButtons.forEach((button) => {
        button.addEventListener("click", function () {
            if (validateForm(currentStep)) {
                if (currentStep < formSections.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        });
    });

    prevButtons.forEach((button) => {
        button.addEventListener("click", function () {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    // Event listener for input changes
    document.querySelectorAll("input[required], select[required], textarea[required]").forEach(input => {
        input.addEventListener("input", checkNextButtonState);
    });

    showStep(currentStep);
});

    </script>
    
@endsection