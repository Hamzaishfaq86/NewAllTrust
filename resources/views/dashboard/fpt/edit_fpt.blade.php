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
        <div class="authentication-inner row">

            <!-- Multi Steps Registration -->
            <div class="d-flex col-12 align-items-center justify-content-center authentication-bg p-5">
                <div class="col-12">
                    <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
                        <div class="bs-stepper-content px-0">
                            <form id="multiStepsForm" method="POST" enctype="multipart/form-data" action="{{ url('admin/update-fpt', $fpt->id ) }}">
                                @csrf
                                <!-- Adviser Details -->
                                <div id="adviserDetails" class="content" style="display: block;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Edit Applications</h4>
                                    </div>
                                    <div class="row g-6">
                                        
                                        @if(auth()->user()->role == 'admin')
                                        
                                        @php
$creators = \App\Models\User::whereNotIn('role', ['oasis_sipp', 'sipp_property', 'full_sipp_property', 'fpt'])->get();
@endphp

                                        
                                         <div class="row">
                                            <!--<div class="form-group col-md-12 mb-3 mt-5">-->
                                            <!--    <label for="role">Change Creater</label>-->
                                            <!--    <select class="form-control" name="creater_id">-->
                                            <!--        @foreach($creators as $cr)-->
                                            <!--            <option @if($fpt->creater_id == $cr->id) selected @endif value="{{ $cr->id }}">{{ $cr->name }}</option>-->
                                            <!--        @endforeach-->
                                            <!--    </select>-->
                                            <!--</div>-->
                                        </div>
                                        @endif
                                        <!--<div class="row">-->
                                        <!--    <div class="form-group col-md-12 mb-3 mt-5">-->
                                        <!--        <label for="role">Selected Member</label>-->
                                        <!--        <select class="form-control" id="title" name="user_id">-->
                                        <!--            @foreach($fptUser as $user)-->
                                        <!--                <option value="{{ $user->id }}">{{ $user->name }}</option>-->
                                        <!--            @endforeach-->
                                        <!--        </select>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <div class="row g-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="scheme_name" class="form-label">Name of Scheme</label>
                                                    <input type="text" class="form-control" id="scheme_name" name="scheme_name" value="{{$fpt->scheme_name}}" >
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="contact_name" class="form-label">Contact Name</label>
                                                    <input type="text" class="form-control" id="contact_name" name="contact_name"  value="{{$fpt->contact_name}}" >
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for="company_name" class="form-label">Company Name</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name"  value="{{$fpt->company_name}}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3"  >{{$fpt->address}} </textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="country" class="form-label">Country</label>
                                                    <input type="text" class="form-control" id="country" name="country"  value="{{$fpt->country}}" >
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="post_code" class="form-label">Post Code</label>
                                                    <input type="text" class="form-control" id="post_code" name="post_code"value="{{$fpt->post_code}}" >
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telephone" class="form-label">Telephone Number</label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" id="dial_code" name="dial_code"
                                                               placeholder="Dial Code"value="{{$fpt->dial_code}}" >
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                                               placeholder="Phone Number" value="{{$fpt->phone_number}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{$fpt->email}}" >
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="regulated_by" class="form-label">Regulated by</label>
                                                    <input type="text" class="form-control" id="regulated_by" name="regulated_by" value="{{$fpt->regulated_by}}" >
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="auth_number" class="form-label">Authorisation Number</label>
                                                    <input type="text" class="form-control" id="auth_number" name="auth_number"value="{{$fpt->auth_number}}" >
                                                </div>
                                                <div class="col-md-6">

                                                    <label for="initial_fee" class="form-label">Initial fee for arranging the scheme: £</label>

                                                    <input type="text" class="form-control" id="initial_fee" name="initial_fee" value="{{$fpt->initial_fee}}" >

                                                </div>
                                            </div>
                                            <div class="mb-3">

                                                <input class="form-check-input" type="checkbox" id="scheme_establishment"
                                                       name="scheme_establishment"  value="following_establishment" {{ $fpt->scheme_establishment ? 'checked' : '' }} >
                                                <label class="form-check-label" for="scheme_establishment">
                                                    To be paid following scheme establishment
                                                </label>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <input class="form-check-input" type="checkbox" id="date_option" value="specific_date" name="date_option"
                                                                {{ $fpt->date_option ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="date_option">or date</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="d-flex">
                                                            <input type="text" class="form-control date-input" name="date_day" placeholder="Day"
                                                                  value="{{$fpt->date_day}}" >
                                                            <input type="text" class="form-control date-input" name="date_month" placeholder="Month"
                                                                  value="{{$fpt->date_month}}" >
                                                            <input type="text" class="form-control date-input" name="date_year" placeholder="Year"
                                                                  value="{{$fpt->date_year}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="annual_fee" class="form-label">Annual Fee: £</label>
                                                <input type="text" class="form-control" id="annual_fee" name="annual_fee" value="{{$fpt->annual_fee}}" >
                                            </div>
                                            <div class="mb-3">
                                                <div class="mb-2">
                                                    <input class="form-check-input" type="checkbox" id="scheme_anniversary"
                                                           name="scheme_anniversary"  value="on_anniversary" {{$fpt->scheme_anniversary ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="scheme_anniversary">
                                                        To be paid on the scheme anniversary
                                                    </label>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <input class="form-check-input" type="checkbox" id="date_option2" name="date_option2"
                                                               {{$fpt->date_option2 ? 'checked' : '' }}  value="specific_date" >
                                                        <label class="form-check-label" for="date_option2">or date</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="d-flex">
                                                            <input type="text" class="form-control date-input" name="date2_day" placeholder="Day"
                                                                  value="{{$fpt->date2_day}}" >
                                                            <input type="text" class="form-control date-input" name="date2_month"
                                                                   placeholder="Month" value="{{$fpt->date2_month}}" >
                                                            <input type="text" class="form-control date-input" name="date2_year" placeholder="Year"
                                                                   value="{{$fpt->date2_year}}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span>and annually thereafter</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="percentage" class="form-label">Annual Fee:</label>
                                                <div class="custom-input">
                                                    <input type="checkbox" id="percentage_checkbox" name="percentage_checkbox"
                                                    value="percentage_of_fund"   {{$fpt->percentage_checkbox ? 'checked' : '' }} >
                                                    <label for="percentage_checkbox" class="ms-2">Percentage of total fund</label>
                                                    <input type="text" class="form-control" id="percentage" name="percentage" placeholder="%"
                                                           aria-label="Percentage"  value="{{$fpt->percentage}}" >
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <div class="custom-input">
                                                    <input type="checkbox" id="specific_investments_checkbox" name="specific_investments_checkbox"
                                                    value="specific_investments"  {{$fpt->specific_investments_checkbox ? 'checked' : '' }} >
                                                    <label for="specific_investments_checkbox" class="ms-2">or specific investments</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="specific_investments_list" class="form-label">
                                                    Please list the specific investments (if applicable):
                                                </label>
                                                <textarea class="form-control" id="specific_investments_list" name="specific_investments_list"
                                                          rows="3">{{$fpt->specific_investments_list}}</textarea>
                                            </div>


                                            <div class="mb-3">
                                                <label for="initial_fee_alternative1" class="form-label">
                                                    Initial fee for arranging the scheme
                                                </label>
                                                <div class="d-flex justify-content-between">
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="initial_fee_amount1" placeholder="£" value="{{$fpt->initial_fee_amount1}}" >
                                                    </div>
                                                    <div class="col-md-2 text-center">
                                                        <label class="form-label">or</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="initial_fee_percentage1" placeholder="%"
                                                               value="{{$fpt->initial_fee_percentage1}}" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="mb-2">
                                                    <input type="checkbox" id="scheme_establishment_alternative1"
                                                           name="scheme_establishment_alternative1"   value="following_establishment1"{{$fpt->scheme_establishment_alternative1 ? 'checked' : '' }}>
                                                    <label for="scheme_establishment_alternative1" class="ms-2">
                                                        To be paid following scheme establishment
                                                    </label>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <input type="checkbox" id="date_alternative1" name="date_alternative1"  value="specific_date1"
                                                                {{$fpt->date_alternative1 ? 'checked' : '' }} >
                                                        <label for="date_alternative1" class="ms-2">or date:</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="d-flex">
                                                            <input type="text" class="form-control" name="date_alt_day1" placeholder="Day" value="{{$fpt->date_alt_day1}}">
                                                            <input type="text" class="form-control" name="date_alt_month1" placeholder="Month"
                                                                   value="{{$fpt->date_alt_month1}}">
                                                            <input type="text" class="form-control" name="date_alt_year1" placeholder="Year"
                                                                   value="{{$fpt->date_alt_year1}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="annual_fee_alternative" class="form-label">
                                                    Annual Fee:
                                                </label>
                                                <div class="custom-input mt-2">
                                                    <input type="checkbox" id="anniversary_fee1" name="anniversary_fee1"
                                                            {{$fpt->anniversary_fee1 ? 'checked' : '' }}  value="paid_annually_percentage" >
                                                    <label for="anniversary_fee1" class="ms-2">
                                                        Paid annually on the anniversary of the initial fee, where the initial fee has been
                                                        expressed as a percentage of the gross initial contribution
                                                    </label>
                                                </div>
                                                <div class="custom-input mt-2">
                                                    <input type="checkbox" id="scheme_anniversary_alternative1"
                                                           name="scheme_anniversary_alternative1"  {{$fpt->scheme_anniversary_alternative1 ? 'checked' : '' }} value="paid_on_anniversary" >
                                                    <label for="scheme_anniversary_alternative1" class="ms-2">
                                                        or Paid on the scheme anniversary
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="transfer_fees" class="form-label">
                                                    Transfer related fees
                                                </label>
                                                <p class="form-label">
                                                    Fees for the advice and involvement of the financial adviser in facilitating transfer(s) to the
                                                    scheme:
                                                </p>
                                                <div class="amount-section row">
                                                    <div class="inline-checkbox col-md-6">
                                                        <input type="checkbox" id="amount_checkbox" name="transfer_amount_checkbox1"  {{$fpt->transfer_amount_checkbox1 ? 'checked' : '' }} value="amount" >
                                                        <label for="amount_checkbox">Amount</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control small-input" name="transfer_amount_value1"
                                                               placeholder="£" value="{{$fpt->transfer_amount_value1}}">
                                                    </div>
                                                </div>
                                                <div class="percentage-section row mt-2">
                                                    <div class="inline-checkbox col-md-6">
                                                        <input type="checkbox" id="percentage_checkbox_transfer1"
                                                               name="percentage_checkbox_transfer1"  {{$fpt->percentage_checkbox_transfer1 ? 'checked' : '' }}   value="percentage" >
                                                        <label for="percentage_checkbox_transfer1"><b>or Percentage</b></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control small-input" name="transfer_percentage_value1"
                                                               placeholder="%" value="{{$fpt->transfer_percentage_value1}}">
                                                        <label class="ms-2">of transfer payment(s) received</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="transfer_payment1" class="form-label">
                                                    The transfer payment is the value of transfer(s) from the following arrangement(s):
                                                </label>
                                                <textarea class="form-control" id="transfer_payment1" name="transfer_payment1" rows="3">{{$fpt->transfer_payment1}}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Will the same terms apply for future transfers paid into the scheme?
                                                </label>
                                                <div class="custom-input">
                                                    <div class="inline-checkbox">
                                                        <input type="radio" id="future_terms_yes" name="future_terms1"  {{$fpt->future_terms1 ? 'checked' : '' }}  value="yes" >
                                                        <label for="future_terms_yes">Yes</label>
                                                    </div>
                                                    <div class="inline-checkbox">
                                                        <input type="radio" id="future_terms_no" name="future_terms1" {{$fpt->future_terms1 ? 'checked' : '' }}  value="no" >
                                                        <label for="future_terms_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="mb-3">
                                                    <label for="declarations" class="form-label"><b>Declarations - Signing</b></label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="print_name_left1" class="form-label">Print Name</label>
                                                            <input type="text" class="form-control" id="print_name_left1" name="print_name_left1"
                                                                   value="{{$fpt->print_name_left1}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="signature_left1" class="form-label">Signature</label>
                                                            <input type="text" class="form-control" id="signature_left1" name="signature_left1"
                                                                    value="{{$fpt->signature_left1}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date_signed_left" class="form-label">Date Signed</label>
                                                            <div class="date-inputs row">
                                                                <div class="col-md-9">
                                                                    <div class="d-flex">
                                                                        <input type="text" class="form-control" name="date_signed_left_day1"
                                                                               placeholder="Day"  value="{{$fpt->date_signed_left_day1}}" >
                                                                        <input type="text" class="form-control mx-2" name="date_signed_left_month1"
                                                                               placeholder="Month"  value="{{$fpt->date_signed_left_month1}}" >
                                                                        <input type="text" class="form-control" name="date_signed_left_year1"
                                                                               placeholder="Year"  value="{{$fpt->date_signed_left_year1}}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="print_name_right1" class="form-label">Print Name</label>
                                                            <input type="text" class="form-control" id="print_name_right1" name="print_name_right1"
                                                                   value="{{$fpt->print_name_right1}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="signature_right1" class="form-label">Signature</label>
                                                            <input type="text" class="form-control" id="signature_right1" name="signature_right1"
                                                                   value="{{$fpt->signature_right1}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date_signed_right" class="form-label">Date Signed</label>
                                                            <div class="date-inputs row">
                                                                <div class="col-md-9">
                                                                    <div class="d-flex">
                                                                        <input type="text" class="form-control" name="date_signed_right_day1"
                                                                               placeholder="Day" value="{{$fpt->date_signed_right_day1}}">
                                                                        <input type="text" class="form-control mx-2" name="date_signed_right_month1"
                                                                               placeholder="Month" value="{{$fpt->date_signed_right_month1}}">
                                                                        <input type="text" class="form-control" name="date_signed_right_year1"
                                                                               placeholder="Year" value="{{$fpt->date_signed_right_year1}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="initial_fee_alternative2" class="form-label">
                                                    Initial fee for arranging the scheme
                                                </label>
                                                <div class="d-flex justify-content-between">
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="initial_fee_amount2" placeholder="£" value="{{$fpt->initial_fee_amount2}}">
                                                    </div>
                                                    <div class="col-md-2 text-center">
                                                        <label class="form-label">or</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="initial_fee_percentage2" placeholder="%"
                                                               value="{{$fpt->initial_fee_percentage2}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="mb-2">
                                                    <input type="checkbox" id="scheme_establishment_alternative2"
                                                           name="scheme_establishment_alternative2" {{$fpt->scheme_establishment_alternative2 ? 'checked' : '' }} value="following_establishment2" >
                                                    <label for="scheme_establishment_alternative2" class="ms-2">
                                                        To be paid following scheme establishment
                                                    </label>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <input type="checkbox" id="date_alternative2" name="date_alternative2"
                                                               {{$fpt->date_alternative2 ? 'checked' : '' }}  value="specific_date2" >
                                                        <label for="date_alternative2" class="ms-2">or date:</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="d-flex">
                                                            <input type="text" class="form-control" name="date_alt_day" placeholder="Day" value="{{$fpt->date_alt_day}}">
                                                            <input type="text" class="form-control" name="date_alt_month" placeholder="Month"
                                                                    value="{{$fpt->date_alt_month}}">
                                                            <input type="text" class="form-control" name="date_alt_year" placeholder="Year"
                                                                   value="{{$fpt->date_alt_year}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="annual_fee_alternative" class="form-label">
                                                    Annual Fee:
                                                </label>
                                                <div class="custom-input mt-2">
                                                    <input type="checkbox" id="anniversary_fee2" name="anniversary_fee2"
                                                           value="paid_annually_percentage" {{$fpt->paid_annually_percentage  ? 'checked' : '' }} >
                                                    <label for="anniversary_fee2" class="ms-2">
                                                        Paid annually on the anniversary of the initial fee, where the initial fee has been
                                                        expressed as a percentage of the gross initial contribution
                                                    </label>
                                                </div>
                                                <div class="custom-input mt-2">
                                                    <input type="checkbox" id="scheme_anniversary_alternative2"
                                                           name="scheme_anniversary_alternative2" value="paid_on_anniversary" {{$fpt->scheme_anniversary_alternative2 ? 'checked' : '' }}>
                                                    <label for="scheme_anniversary_alternative2" class="ms-2">
                                                        or Paid on the scheme anniversary
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="transfer_fees" class="form-label">
                                                    Transfer related fees
                                                </label>
                                                <p class="form-label">
                                                    Fees for the advice and involvement of the financial adviser in facilitating transfer(s) to the
                                                    scheme:
                                                </p>
                                                <div class="amount-section row">
                                                    <div class="inline-checkbox col-md-6">
                                                        <input type="checkbox" id="amount_checkbox" name="transfer_amount_checkbox" value="amount" {{$fpt->transfer_amount_checkbox ? 'checked' : '' }} >
                                                        <label for="amount_checkbox">Amount</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control small-input" name="transfer_amount_value"
                                                               placeholder="£" value="">
                                                    </div>
                                                </div>
                                                <div class="percentage-section row mt-2">
                                                    <div class="inline-checkbox col-md-6">
                                                        <input type="checkbox" id="percentage_checkbox_transfer" name="percentage_checkbox_transfer"
                                                               value="percentage" {{$fpt->percentage_checkbox_transfer ? 'checked' : '' }} >
                                                        <label for="percentage_checkbox_transfer"><b>or Percentage</b></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control small-input" name="transfer_percentage_value"
                                                               placeholder="%" value="{{$fpt->transfer_percentage_value}}">
                                                        <label class="ms-2">of transfer payment(s) received</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="transfer_payment2" class="form-label">
                                                    The transfer payment is the value of transfer(s) from the following arrangement(s):
                                                </label>
                                                <textarea class="form-control" id="transfer_payment2" name="transfer_payment2" rows="3">{{$fpt->transfer_payment2}}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Will the same terms apply for future transfers paid into the scheme?
                                                </label>
                                                <div class="custom-input">
                                                    <div class="inline-checkbox">
                                                        <input type="checkbox" id="future_terms_yes" name="future_terms2" value="yes" {{$fpt->future_terms2 ? 'checked' : '' }}>
                                                        <label for="future_terms_yes">Yes</label>
                                                    </div>
                                                    <div class="inline-checkbox">
                                                        <input type="checkbox" id="future_terms_no" name="future_terms2" value="no" {{$fpt->future_terms2 ? 'checked' : '' }}>
                                                        <label for="future_terms_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="print_name_left2" class="form-label">Print Name</label>
                                                        <input type="text" class="form-control" id="print_name_left2" name="print_name_left2"
                                                               value="{{$fpt->print_name_left2}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="signature_left2" class="form-label">Signature</label>
                                                        <input type="text" class="form-control" id="signature_left2" name="signature_left2"
                                                                value="{{$fpt->signature_left2}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_signed_left" class="form-label">Date Signed</label>
                                                        <div class="date-inputs row">
                                                            <div class="col-md-9">
                                                                <div class="d-flex">
                                                                    <input type="text" class="form-control" name="date_signed_left_day2"
                                                                           placeholder="Day"  value="{{$fpt->date_signed_left_day2}}">
                                                                    <input type="text" class="form-control mx-2" name="date_signed_left_month2"
                                                                           placeholder="Month" value="{{$fpt->date_signed_left_month2}}">
                                                                    <input type="text" class="form-control" name="date_signed_left_year2"
                                                                           placeholder="Year"  value="{{$fpt->date_signed_left_year2}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="print_name_right2" class="form-label">Print Name</label>
                                                        <input type="text" class="form-control" id="print_name_right2" name="print_name_right2"
                                                               value="{{$fpt->print_name_right2}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="signature_right2" class="form-label">Signature</label>
                                                        <input type="text" class="form-control" id="signature_right2" name="signature_right2"
                                                               value="{{$fpt->signature_right2}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_signed_right" class="form-label">Date Signed</label>
                                                        <div class="date-inputs row">
                                                            <div class="col-md-9">
                                                                <div class="d-flex">
                                                                    <input type="text" class="form-control" name="date_signed_right_day2"
                                                                           placeholder="Day" value="{{$fpt->date_signed_right_day2}}">
                                                                    <input type="text" class="form-control mx-2" name="date_signed_right_month2"
                                                                           placeholder="Month" value="{{$fpt->date_signed_right_month2}}">
                                                                    <input type="text" class="form-control" name="date_signed_right_year2"
                                                                           placeholder="Year" value="{{$fpt->date_signed_right_year2}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="print_name_left_additional1" class="form-label">Print Name</label>
                                                    <input type="text" class="form-control" id="print_name_left_additional1"
                                                           name="print_name_left_additional1" value="{{$fpt->print_name_left_additional1}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="print_name_right_additional" class="form-label">Print Name</label>
                                                    <input type="text" class="form-control" id="print_name_right_additional"
                                                           name="print_name_right_additional" value="{{$fpt->print_name_right_additional}}">
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label for="signature_left_additional" class="form-label">Signature</label>
                                                    <input type="text" class="form-control" id="signature_left_additional"
                                                           name="signature_left_additional" value="{{$fpt->signature_left_additional}}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="date_signed_left_additional" class="form-label">Date Signed</label>
                                                    <div class="date-inputs row">
                                                        <div class="col-md-9">
                                                            <div class="d-flex">
                                                                <input type="text" class="form-control"
                                                                       name="date_signed_left_additional_day3" placeholder="Day" value="{{$fpt->date_signed_left_additional_day3}}">
                                                                <input type="text" class="form-control mx-2"
                                                                       name="date_signed_left_additional_month3" placeholder="Month" value="{{$fpt->date_signed_left_additional_month3}}">
                                                                <input type="text" class="form-control"
                                                                       name="date_signed_left_additional_year3" placeholder="Year" value="{{$fpt->date_signed_left_additional_year3}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        {{--              ============================  ====================== ==============================--}}
                                        {{--              ============================   Application multiform  start    ====================--}}



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


                                <!-- Policies & Financial Crime -->
                                <div id="polocoesCrime" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Installation Questionnaire</h4>
                                    </div>
                                    <div class="row g-6">
                                        <!-- =========================== bank account further details card start =========================== !-->
                                        <div class="auth-container auth-overlay auth-bg-pattern">
                                            <div class="auth-content row">
                                                <!-- Multi Steps Registration -->
                                                <div class="d-flex col-12 align-items-center justify-content-center auth-bg-pattern p-5">
                                                    <div class="col-8">
                                                        <div id="multiFormStepper" class="form-stepper border-none shadow-none mt-5">
                                                            <div class="form-stepper-content px-0">

                                                                <!-- Step 1: chairman Details -->
                                                                <div id="stepFirst" class="step-content" style="display: block;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Chairman</h4>
                                                                    </div>
                                                                    <div class="row g-6">

                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="contact_name">Contact Name</label>
                                                                                <input type="text" class="form-control" id="contact_name" name="chairman_contact_name" placeholder="Enter Contact Name" 
                                                                                value="{{ old('chairman_contact_name', $fpt->chairman_contact_name ?? '') }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="firm_name">Firm Name (If Applicable)</label>
                                                                                <input type="text" class="form-control" id="firm_name" name="chairman_firm_name" placeholder="Enter Firm Name" 
                                                                                value="{{ old('chairman_firm_name', $fpt->chairman_firm_name ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6 form-group">
                                                                                <label for="address_line_1">Address Line 1</label>
                                                                                <input type="text" class="form-control" id="address_line_1" name="chairman_address_line_1" placeholder="Enter Address Line 1" 
                                                                                value="{{ old('chairman_address_line_1', $fpt->chairman_address_line_1 ?? '') }}">
                                                                            </div>
                                                                        
                                                                            <div class="col-md-6 form-group">
                                                                                <label for="address_line_2">Address Line 2</label>
                                                                                <input type="text" class="form-control" id="address_line_2" name="chairman_address_line_2" placeholder="Enter Address Line 2" 
                                                                                value="{{ old('chairman_address_line_2', $fpt->chairman_address_line_2 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="city">City</label>
                                                                                <input type="text" class="form-control" id="city" name="chairman_city" placeholder="Enter City" 
                                                                                value="{{ old('chairman_city', $fpt->chairman_city ?? '') }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="postcode">Post Code</label>
                                                                                <input type="text" class="form-control" id="postcode" name="chairman_postcode" placeholder="Enter Post Code" 
                                                                                value="{{ old('chairman_postcode', $fpt->chairman_postcode ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="telephone">Telephone Number</label>
                                                                                <input type="text" class="form-control" id="telephone" name="chairman_telephone" placeholder="Enter Telephone Number" 
                                                                                value="{{ old('chairman_telephone', $fpt->chairman_telephone ?? '') }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="email">Email Address</label>
                                                                                <input type="email" class="form-control" id="email" name="chairman_email" placeholder="Enter Email Address" 
                                                                                value="{{ old('chairman_email', $fpt->chairman_email ?? '') }}">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button class="btn-prev-step btn-outline-secondary" disabled>
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 2: member trustee Details -->
                                                                <div id="stepSecond" class="step-content" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Member Trustees </h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                       <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="print_name_1">Print Name 1</label>
                                                                                <input type="text" class="form-control" id="print_name_1" name="member_true_print_name_1" placeholder="Enter Print Name 1" 
                                                                                value="{{ old('member_true_print_name_1', $fpt->member_true_print_name_1 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="print_name_2">Print Name 2</label>
                                                                                <input type="text" class="form-control" id="print_name_2" name="member_true_print_name_2" placeholder="Enter Print Name 2" 
                                                                                value="{{ old('member_true_print_name_2', $fpt->member_true_print_name_2 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="print_name_3">Print Name 3</label>
                                                                                <input type="text" class="form-control" id="print_name_3" name="member_true_print_name_3" placeholder="Enter Print Name 3" 
                                                                                value="{{ old('member_true_print_name_3', $fpt->member_true_print_name_3 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="print_name_4">Print Name 4</label>
                                                                                <input type="text" class="form-control" id="print_name_4" name="member_true_print_name_4" placeholder="Enter Print Name 4" 
                                                                                value="{{ old('member_true_print_name_4', $fpt->member_true_print_name_4 ?? '') }}">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button  class="btn-prev-step btn-outline-secondary" disabled>
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 3: Reaso For cheme Details -->
                                                                <div id="stepSecond" class="step-content" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Reason For The Sceme</h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="principal_reason_family">Principal reason for the Family Pension Trust</label>
                                                                                <textarea type="text" class="form-control" id="principal_reason_family" name="principal_reason_family" placeholder="Enter Reason">{{ old('principal_reason_family', $fpt->principal_reason_family ?? '') }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button type="button" class="btn-prev-step btn-outline-secondary" disabled>
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step 3: Common Details -->
                                                                <div id="stepSecond" class="step-content" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Common Investment Funds </h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                      <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="common_funds_number">Number Of Common Investment Funds</label>
                                                                                <input type="number" class="form-control" id="common_funds_number" name="common_funds_number" placeholder="Enter Number Of Common Investment Funds" 
                                                                                value="{{ old('common_funds_number', $fpt->common_funds_number ?? '') }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="investment_fund_1">Name Of Investment Fund 1</label>
                                                                                <input type="text" class="form-control" id="investment_fund_1" name="common_funds_investment_fund_1" placeholder="Enter Name Of Investment Fund 1" 
                                                                                value="{{ old('common_funds_investment_fund_1', $fpt->common_funds_investment_fund_1 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <h4>Participating Members</h4>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_1_1">Print Name 1</label>
                                                                                <input type="text" class="form-control" id="print_name_1_1" name="common_funds_print_name_1_1" placeholder="Enter Print Name 1" 
                                                                                value="{{ old('common_funds_print_name_1_1', $fpt->common_funds_print_name_1_1 ?? '') }}">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_1_2">Print Name 2</label>
                                                                                <input type="text" class="form-control" id="print_name_1_2" name="common_funds_print_name_1_2" placeholder="Enter Print Name 2" 
                                                                                value="{{ old('common_funds_print_name_1_2', $fpt->common_funds_print_name_1_2 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_1_3">Print Name 3</label>
                                                                                <input type="text" class="form-control" id="print_name_1_3" name="common_funds_print_name_1_3" placeholder="Enter Print Name 3" 
                                                                                value="{{ old('common_funds_print_name_1_3', $fpt->common_funds_print_name_1_3 ?? '') }}">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_1_4">Print Name 4</label>
                                                                                <input type="text" class="form-control" id="print_name_1_4" name="common_funds_print_name_1_4" placeholder="Enter Print Name 4" 
                                                                                value="{{ old('common_funds_print_name_1_4', $fpt->common_funds_print_name_1_4 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="reason_for_fund_1">Reason For This Fund</label>
                                                                            <textarea class="form-control" id="reason_for_fund_1" name="common_funds_reason_for_fund_1" rows="3" placeholder="Enter Reason">{{ old('common_funds_reason_for_fund_1', $fpt->common_funds_reason_for_fund_1 ?? '') }}</textarea>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="investment_fund_2">Name Of Investment Fund 2</label>
                                                                            <input type="text" class="form-control" id="investment_fund_2" name="common_funds_investment_fund_2" placeholder="Enter Name Of Investment Fund 2" 
                                                                            value="{{ old('common_funds_investment_fund_2', $fpt->common_funds_investment_fund_2 ?? '') }}">
                                                                        </div>
                                                                        
                                                                        <h4>Participating Members For Second Fund</h4>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_2_1">Print Name 1</label>
                                                                                <input type="text" class="form-control" id="print_name_2_1" name="common_funds_print_name_2_1" placeholder="Enter Print Name 1" 
                                                                                value="{{ old('common_funds_print_name_2_1', $fpt->common_funds_print_name_2_1 ?? '') }}">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_2_2">Print Name 2</label>
                                                                                <input type="text" class="form-control" id="print_name_2_2" name="common_funds_print_name_2_2" placeholder="Enter Print Name 2" 
                                                                                value="{{ old('common_funds_print_name_2_2', $fpt->common_funds_print_name_2_2 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_2_3">Print Name 3</label>
                                                                                <input type="text" class="form-control" id="print_name_2_3" name="common_funds_print_name_2_3" placeholder="Enter Print Name 3" 
                                                                                value="{{ old('common_funds_print_name_2_3', $fpt->common_funds_print_name_2_3 ?? '') }}">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_2_4">Print Name 4</label>
                                                                                <input type="text" class="form-control" id="print_name_2_4" name="common_funds_print_name_2_4" placeholder="Enter Print Name 4" 
                                                                                value="{{ old('common_funds_print_name_2_4', $fpt->common_funds_print_name_2_4 ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="reason_for_fund_2">Reason For This Fund</label>
                                                                            <textarea class="form-control" id="reason_for_fund_2" name="common_funds_reason_for_fund_2" rows="3" placeholder="Enter Reason">{{ old('common_funds_reason_for_fund_2', $fpt->common_funds_reason_for_fund_2 ?? '') }}</textarea>
                                                                        </div>
                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button type="button" class="btn-prev-step btn-outline-secondary">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Step : Sceme Adviser Details -->
                                                                <div id="stepSecond" class="step-content" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Scheme Adviser </h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="contact_name">Contact Name</label>
                                                                                <input type="text" class="form-control" id="contact_name" name="scheme_adviser_contact_name" 
                                                                                       value="{{ old('scheme_adviser_contact_name', $fpt->scheme_adviser_contact_name ?? '') }}" 
                                                                                       placeholder="Enter Contact Name">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="company_name">Company Name</label>
                                                                                <input type="text" class="form-control" id="company_name" name="scheme_adviser_company_name" 
                                                                                       value="{{ old('scheme_adviser_company_name', $fpt->scheme_adviser_company_name ?? '') }}" 
                                                                                       placeholder="Enter Company Name">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="address">Address</label>
                                                                                <input type="text" class="form-control" id="address" name="scheme_adviser_address" 
                                                                                       value="{{ old('scheme_adviser_address', $fpt->scheme_adviser_address ?? '') }}" 
                                                                                       placeholder="Enter Address">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="address_line_2">Additional Address Line</label>
                                                                                <input type="text" class="form-control" id="address_line_2" name="scheme_adviser_address_line_2" 
                                                                                       value="{{ old('scheme_adviser_address_line_2', $fpt->scheme_adviser_address_line_2 ?? '') }}" 
                                                                                       placeholder="Enter Additional Address Line">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="city">City</label>
                                                                                <input type="text" class="form-control" id="city" name="scheme_adviser_city" 
                                                                                       value="{{ old('scheme_adviser_city', $fpt->scheme_adviser_city ?? '') }}" 
                                                                                       placeholder="Enter City">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="postcode">Post Code</label>
                                                                                <input type="text" class="form-control" id="postcode" name="scheme_adviser_postcode" 
                                                                                       value="{{ old('scheme_adviser_postcode', $fpt->scheme_adviser_postcode ?? '') }}" 
                                                                                       placeholder="Enter Post Code">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="telephone_number">Telephone Number</label>
                                                                                <input type="text" class="form-control" id="telephone_number" name="scheme_adviser_telephone_number" 
                                                                                       value="{{ old('scheme_adviser_telephone_number', $fpt->scheme_adviser_telephone_number ?? '') }}" 
                                                                                       placeholder="Enter Telephone Number">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="email_address">Email Address</label>
                                                                                <input type="email" class="form-control" id="email_address" name="scheme_adviser_email_address" 
                                                                                       value="{{ old('scheme_adviser_email_address', $fpt->scheme_adviser_email_address ?? '') }}" 
                                                                                       placeholder="Enter Email Address">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="regulated_by">Regulated By</label>
                                                                                <input type="text" class="form-control" id="regulated_by" name="scheme_adviser_regulated_by" 
                                                                                       value="{{ old('scheme_adviser_regulated_by', $fpt->scheme_adviser_regulated_by ?? '') }}" 
                                                                                       placeholder="Enter Regulated By">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="authorization_number">Authorization Number</label>
                                                                                <input type="text" class="form-control" id="authorization_number" name="scheme_adviser_authorization_number" 
                                                                                       value="{{ old('scheme_adviser_authorization_number', $fpt->scheme_adviser_authorization_number ?? '') }}" 
                                                                                       placeholder="Enter Authorization Number">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="is_part_of_network">Is The Financial Advisor An Appointed Representative Or Part Of A Network?</label>
                                                                            <div>
                                                                                <input type="radio" id="yes" name="scheme_adviser_is_part_of_network" value="yes" 
                                                                                       {{ old('scheme_adviser_is_part_of_network', $fpt->scheme_adviser_is_part_of_network ?? '') == 'yes' ? 'checked' : '' }}>
                                                                                <label for="yes">Yes</label>
                                                                        
                                                                                <input type="radio" id="no" name="scheme_adviser_is_part_of_network" value="no" 
                                                                                       {{ old('scheme_adviser_is_part_of_network', $fpt->scheme_adviser_is_part_of_network ?? '') == 'no' ? 'checked' : '' }}>
                                                                                <label for="no">No</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="network_name">Name Of Network Or Principal</label>
                                                                                <input type="text" class="form-control" id="network_name" name="scheme_adviser_network_name" 
                                                                                       value="{{ old('scheme_adviser_network_name', $fpt->scheme_adviser_network_name ?? '') }}" 
                                                                                       placeholder="Enter Network Or Principal Name">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="regulated_by_2">Regulated By (For Network)</label>
                                                                                <input type="text" class="form-control" id="regulated_by_2" name="scheme_adviser_regulated_by_2" 
                                                                                       value="{{ old('scheme_adviser_regulated_by_2', $fpt->scheme_adviser_regulated_by_2 ?? '') }}" 
                                                                                       placeholder="Enter Regulated By (For Network)">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-md-6">
                                                                            <label for="company_authorization_number">Company Authorization Number</label>
                                                                            <input type="text" class="form-control" id="company_authorization_number" name="scheme_adviser_company_authorization_number" 
                                                                                   value="{{ old('scheme_adviser_company_authorization_number', $fpt->scheme_adviser_company_authorization_number ?? '') }}" 
                                                                                   placeholder="Enter Company Authorization Number">
                                                                        </div>


                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button type="button" class="btn-prev-step btn-outline-secondary">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- Step : Accountant Details -->
                                                                <div id="stepSecond" class="step-content" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Accountant Details </h4>
                                                                    </div>
                                                                    <div class="row g-6">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="contact_name">Contact Name</label>
                                                                            <input type="text" class="form-control" id="contact_name" name="accountant_details_contact_name" 
                                                                                   value="{{ old('accountant_details_contact_name', $fpt->accountant_details_contact_name ?? '') }}" 
                                                                                   placeholder="Enter Contact Name">
                                                                        </div>
                                                                    
                                                                        <div class="form-group col-md-6">
                                                                            <label for="firm_name">Accountancy Firm's Name</label>
                                                                            <input type="text" class="form-control" id="firm_name" name="accountant_details_firm_name" 
                                                                                   value="{{ old('accountant_details_firm_name', $fpt->accountant_details_firm_name ?? '') }}" 
                                                                                   placeholder="Enter Firm Name">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="address_line_1">Firm's Address Line 1</label>
                                                                            <input type="text" class="form-control" id="address_line_1" name="accountant_details_address_line_1" 
                                                                                   value="{{ old('accountant_details_address_line_1', $fpt->accountant_details_address_line_1 ?? '') }}" 
                                                                                   placeholder="Enter Address Line 1">
                                                                        </div>
                                                                    
                                                                        <div class="form-group col-md-12">
                                                                            <label for="address_line_2">Firm's Address Line 2</label>
                                                                            <input type="text" class="form-control" id="address_line_2" name="accountant_details_address_line_2" 
                                                                                   value="{{ old('accountant_details_address_line_2', $fpt->accountant_details_address_line_2 ?? '') }}" 
                                                                                   placeholder="Enter Address Line 2">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="city">City</label>
                                                                            <input type="text" class="form-control" id="city" name="accountant_details_city" 
                                                                                   value="{{ old('accountant_details_city', $fpt->accountant_details_city ?? '') }}" 
                                                                                   placeholder="Enter City">
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-md-6">
                                                                            <label for="postcode">Post Code</label>
                                                                            <input type="text" class="form-control" id="postcode" name="accountant_details_postcode" 
                                                                                   value="{{ old('accountant_details_postcode', $fpt->accountant_details_postcode ?? '') }}" 
                                                                                   placeholder="Enter Post Code">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="telephone_number">Telephone Number</label>
                                                                            <input type="text" class="form-control" id="telephone_number" name="accountant_details_telephone_number" 
                                                                                   value="{{ old('accountant_details_telephone_number', $fpt->accountant_details_telephone_number ?? '') }}" 
                                                                                   placeholder="Enter Telephone Number">
                                                                        </div>
                                                                    
                                                                        <div class="form-group col-md-6">
                                                                            <label for="email_address">Email Address</label>
                                                                            <input type="email" class="form-control" id="email_address" name="accountant_details_email_address" 
                                                                                   value="{{ old('accountant_details_email_address', $fpt->accountant_details_email_address ?? '') }}" 
                                                                                   placeholder="Enter Email Address">
                                                                        </div>

                                                                        <div class="col-12 d-flex justify-content-between">
                                                                            <button type="button" class="btn-prev-step btn-outline-secondary">
                                                                                <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </button>
                                                                            <button type="button" class="btn-next-step btn-outline-primary">
                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                                <i class="icon-right-arrow ti-xs"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Step : Decelarationt  -->
                                                                <div id="stepSecond" class="step-content" style="display: none;">
                                                                    <div class="content-header mb-6">
                                                                        <h4 class="mb-0">Declaration</h4>
                                                                    </div>
                                                                    <div class="row g-6">


                                                                        <div class="row g-6">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="signature_1">Signature 1</label>
                                                                                <input type="text" class="form-control" id="signature_1" name="declaration_signature_1" 
                                                                                       value="{{ old('declaration_signature_1', $fpt->declaration_signature_1 ?? '') }}" 
                                                                                       placeholder="Enter Signature 1">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_1">Print Name 1</label>
                                                                                <input type="text" class="form-control" id="print_name_1" name="declaration_print_name_1" 
                                                                                       value="{{ old('declaration_print_name_1', $fpt->declaration_print_name_1 ?? '') }}" 
                                                                                       placeholder="Enter Print Name 1">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="position_1">Position 1</label>
                                                                            <input type="text" class="form-control" id="position_1" name="declaration_position_1" 
                                                                                   value="{{ old('declaration_position_1', $fpt->declaration_position_1 ?? '') }}" 
                                                                                   placeholder="Enter Position 1">
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="date_1">Date 1</label>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <input type="number" class="form-control" id="day_1" name="declaration_day_1" 
                                                                                           value="{{ old('declaration_day_1', $fpt->declaration_day_1 ?? '') }}" 
                                                                                           placeholder="Day">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <input type="number" class="form-control" id="month_1" name="declaration_month_1" 
                                                                                           value="{{ old('declaration_month_1', $fpt->declaration_month_1 ?? '') }}" 
                                                                                           placeholder="Month">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <input type="number" class="form-control" id="year_1" name="declaration_year_1" 
                                                                                           value="{{ old('declaration_year_1', $fpt->declaration_year_1 ?? '') }}" 
                                                                                           placeholder="Year">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="signature_2">Signature 2</label>
                                                                                <input type="text" class="form-control" id="signature_2" name="declaration_signature_2" 
                                                                                       value="{{ old('declaration_signature_2', $fpt->declaration_signature_2 ?? '') }}" 
                                                                                       placeholder="Enter Signature 2">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name_2">Print Name 2</label>
                                                                                <input type="text" class="form-control" id="print_name_2" name="declaration_print_name_2" 
                                                                                       value="{{ old('declaration_print_name_2', $fpt->declaration_print_name_2 ?? '') }}" 
                                                                                       placeholder="Enter Print Name 2">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="position_2">Position 2</label>
                                                                            <input type="text" class="form-control" id="position_2" name="declaration_position_2" 
                                                                                   value="{{ old('declaration_position_2', $fpt->declaration_position_2 ?? '') }}" 
                                                                                   placeholder="Enter Position 2">
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="date_2">Date 2</label>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <input type="number" class="form-control" id="day_2" name="declaration_day_2" 
                                                                                           value="{{ old('declaration_day_2', $fpt->declaration_day_2 ?? '') }}" 
                                                                                           placeholder="Day">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <input type="number" class="form-control" id="month_2" name="declaration_month_2" 
                                                                                           value="{{ old('declaration_month_2', $fpt->declaration_month_2 ?? '') }}" 
                                                                                           placeholder="Month">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <input type="number" class="form-control" id="year_2" name="declaration_year_2" 
                                                                                           value="{{ old('declaration_year_2', $fpt->declaration_year_2 ?? '') }}" 
                                                                                           placeholder="Year">
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    <div class="col-12 d-flex justify-content-between">
                                                                        <button type="button" class="btn-prev-step btn-outline-secondary">
                                                                            <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                        </button>
                                                                        <button type="button" class="btn-next-step btn-outline-primary">
                                                                            <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                            <i class="icon-right-arrow ti-xs"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Step : Adviser Fee Agreement  -->
                                                            <div id="stepSecond" class="step-content" style="display: none;">
                                                                <div class="content-header mb-6">
                                                                    <h4 class="mb-0">Adviser Fee Agreement</h4>
                                                                </div>
                                                                <div class="row g-6">
                                                                    <h5>A. Defined Fee</h5>
                                                                    <div class="form-group">
                                                                        <label for="initial_fee">Initial Fee For Arranging The Scheme</label>
                                                                        <input type="text" class="form-control" id="initial_fee" name="adviser_agrement_initial_fee1" placeholder="Enter Initial Fee" value="{{ $fpt['adviser_agrement_initial_fee1'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group">
                                                                        <label>To Be Paid Following Scheme Establishment</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="pay_following_establishment" name="adviser_agrement_pay_following_establishment" value="yes" {{ isset($fpt['adviser_agrement_pay_following_establishment']) && $fpt['adviser_agrement_pay_following_establishment'] == 'yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="pay_following_establishment">To Be Paid Following Scheme Establishment</label>
                                                                        </div>
                                                                
                                                                        <div class="row mt-2">
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="day_1" name="adviser_agrement_day_1" placeholder="Day" value="{{ $fpt['adviser_agrement_day_1'] ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="month_1" name="adviser_agrement_month_1" placeholder="Month" value="{{ $fpt['adviser_agrement_month_1'] ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="year_1" name="adviser_agrement_year_1" placeholder="Year" value="{{ $fpt['adviser_agrement_year_1'] ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <div class="form-group mt-2">
                                                                            <label for="annual_fee">Annual Fee</label>
                                                                            <input type="text" class="form-control" id="annual_fee" name="adviser_agrement_annual_fee" placeholder="Enter Annual Fee" value="{{ $fpt['adviser_agrement_annual_fee'] ?? '' }}">
                                                                        </div>
                                                                
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="pay_anniversary" name="adviser_agrement_pay_anniversary" value="yes" {{ isset($fpt['adviser_agrement_pay_anniversary']) && $fpt['adviser_agrement_pay_anniversary'] == 'yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="pay_anniversary">To Be Paid On The Scheme Anniversary</label>
                                                                        </div>
                                                                
                                                                        <div class="row mt-2">
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="day_2" name="adviser_agrement_day_2" placeholder="Day" value="{{ $fpt['adviser_agrement_day_2'] ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="month_2" name="adviser_agrement_month_2" placeholder="Month" value="{{ $fpt['adviser_agrement_month_2'] ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="year_2" name="adviser_agrement_year_2" placeholder="Year" value="{{ $fpt['adviser_agrement_year_2'] ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <h5>B. Percentage Of Fund Or Specific Investments</h5>
                                                                    <div class="form-group">
                                                                        <label for="initial_fee_percentage">Initial Fee For Arranging The Scheme</label>
                                                                        <input type="text" class="form-control" id="initial_fee_percentage" name="adviser_agrement_initial_fee_percentage1" placeholder="Enter Initial Fee Percentage" value="{{ $fpt['adviser_agrement_initial_fee_percentage1'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="pay_following_establishment_2" name="adviser_agrement_pay_following_establishment_2" value="yes" {{ isset($fpt['adviser_agrement_pay_following_establishment_2']) && $fpt['adviser_agrement_pay_following_establishment_2'] == 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="pay_following_establishment_2">To Be Paid Following Scheme Establishment</label>
                                                                    </div>
                                                                
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="day_3" name="adviser_agrement_day_3" placeholder="Day" value="{{ $fpt['adviser_agrement_day_3'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="month_3" name="adviser_agrement_month_3" placeholder="Month" value="{{ $fpt['adviser_agrement_month_3'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="year_3" name="adviser_agrement_year_3" placeholder="Year" value="{{ $fpt['adviser_agrement_year_3'] ?? '' }}">
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="form-group mt-2">
                                                                        <label>Annual Fee</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="percentage_total_fund" name="adviser_agrement_percentage_total_fund" value="yes" {{ isset($fpt['adviser_agrement_percentage_total_fund']) && $fpt['adviser_agrement_percentage_total_fund'] == 'yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="percentage_total_fund">Percentage Of Total Fund</label>
                                                                        </div>
                                                                
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="specific_investments" name="adviser_agrement_specific_investments" value="yes" {{ isset($fpt['adviser_agrement_specific_investments']) && $fpt['adviser_agrement_specific_investments'] == 'yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="specific_investments">Or Specific Investments</label>
                                                                        </div>
                                                                
                                                                        <div class="form-group mt-2">
                                                                            <label for="specific_investments_list">Please List The Specific Investments (If Applicable)</label>
                                                                            <textarea class="form-control" id="specific_investments_list" name="adviser_agrement_specific_investments_list" rows="3" placeholder="List Specific Investments">{{ $fpt['adviser_agrement_specific_investments_list'] ?? '' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <h5>C. Percentage Of Gross Contributions</h5>
                                                                
                                                                    <div class="form-group">
                                                                        <label for="initial_fee_percentage">Initial Fee For Arranging The Scheme</label>
                                                                        <input type="text" class="form-control" id="initial_fee_percentage" name="adviser_agrement_initial_fee_percentage" placeholder="Enter Initial Fee" value="{{ $fpt['adviser_agrement_initial_fee_percentage'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="pay_following_establishment" name="adviser_agrement_pay_following_establishment11" value="yes" {{ isset($fpt['adviser_agrement_pay_following_establishment11']) && $fpt['adviser_agrement_pay_following_establishment11'] == 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="pay_following_establishment">To Be Paid Following Scheme Establishment</label>
                                                                    </div>
                                                                
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="day_1" name="adviser_agrement_day_11" placeholder="Day" value="{{ $fpt['adviser_agrement_day_11'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="month_1" name="adviser_agrement_month_11" placeholder="Month" value="{{ $fpt['adviser_agrement_month_11'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="year_1" name="adviser_agrement_year_11" placeholder="Year" value="{{ $fpt['adviser_agrement_year_11'] ?? '' }}">
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="form-group mt-2">
                                                                        <label for="annual_fee">Annual Fee</label>
                                                                        <input type="text" class="form-control" id="annual_fee" name="adviser_agrement_annual_fee" placeholder="Enter Annual Fee" value="{{ $fpt['adviser_agrement_annual_fee'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="pay_anniversary" name="adviser_agrement_pay_anniversary11" value="yes" {{ isset($fpt['adviser_agrement_pay_anniversary11']) && $fpt['adviser_agrement_pay_anniversary11'] == 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="pay_anniversary">To Be Paid On The Scheme Anniversary</label>
                                                                    </div>
                                                                
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="day_2" name="adviser_agrement_day_2" placeholder="Day" value="{{ $fpt['adviser_agrement_day_2'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="month_2" name="adviser_agrement_month_2" placeholder="Month" value="{{ $fpt['adviser_agrement_month_2'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="year_2" name="adviser_agrement_year_2" placeholder="Year" value="{{ $fpt['adviser_agrement_year_2'] ?? '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                    <div class="col-12 d-flex justify-content-between">
                                                                        <button type="button" class="btn-prev-step btn-outline-secondary">
                                                                            <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                        </button>
                                                                        <button type="button" class="btn-next-step btn-outline-primary">
                                                                            <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                            <i class="icon-right-arrow ti-xs"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Step : InterRim Deed -->
                                                            <div id="stepSecond" class="step-content" style="display: none;">
                                                                <div class="content-header mb-6">
                                                                    <h4 class="mb-0">Interim Deed</h4>
                                                                </div>
                                                                <div class="row g-6">


                                                                    <div class="form-group">
                                                                            <label>Are You An Appointed Representative, Or Part Of An Online Network?</label>
                                                                            <div class="form-check">
                                                                                <label class="form-check-label" for="appointed_yes">Yes
                                                                                <input class="form-check-input" type="radio" id="appointed_yes" name="interim_deed_appointed" value="yes" {{ isset($fpt['interim_deed_appointed']) && $fpt['interim_deed_appointed'] == 'yes' ? 'checked' : '' }}>
                                                                                </label>
                                                                                <br>
                                                                                
                                                                                <label class="form-check-label" for="appointed_no">
                                                                                <input class="form-check-input" type="radio" id="appointed_no" name="interim_deed_appointed" value="no" {{ isset($fpt['interim_deed_appointed']) && $fpt['interim_deed_appointed'] == 'no' ? 'checked' : '' }}>
                                                                                No</label
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="network_name">If Yes, Please Provide The Name Of The Network</label>
                                                                            <input type="text" class="form-control" id="network_name" name="interim_deed_network_name" placeholder="Enter Network Name" value="{{ $fpt['interim_deed_network_name'] ?? '' }}">
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Is Payment To Be Made To Your Network?</label>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" id="payment_to_network_yes" name="interim_deed_payment_to_network" value="yes" {{ isset($fpt['interim_deed_payment_to_network']) && $fpt['interim_deed_payment_to_network'] == 'yes' ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="payment_to_network_yes">Yes</label>
                                                                                
                                                                                <br>
                                                                                <input class="form-check-input" type="radio" id="payment_to_network_no" name="interim_deed_payment_to_network" value="no" {{ isset($fpt['interim_deed_payment_to_network']) && $fpt['interim_deed_payment_to_network'] == 'no' ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="payment_to_network_no">No</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="fees_to_be_paid_by">Fees To Be Paid By</label>
                                                                                <select class="form-control" id="fees_to_be_paid_by" name="interim_deed_fees_to_be_paid_by">
                                                                                    <option value="chargeback" {{ (isset($fpt['interim_deed_fees_to_be_paid_by']) && $fpt['interim_deed_fees_to_be_paid_by'] == 'chargeback') ? 'selected' : '' }}>Chargeback</option>
                                                                                    <option value="other" {{ (isset($fpt['interim_deed_fees_to_be_paid_by']) && $fpt['interim_deed_fees_to_be_paid_by'] == 'other') ? 'selected' : '' }}>Other</option>
                                                                                </select>
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="bank_name">Name Of Bank</label>
                                                                                <input type="text" class="form-control" id="bank_name" name="interim_deed_bank_name" placeholder="Enter Bank Name" value="{{ $fpt['interim_deed_bank_name'] ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="branch">Branch</label>
                                                                                <input type="text" class="form-control" id="branch" name="interim_deed_branch" placeholder="Enter Branch" value="{{ $fpt['interim_deed_branch'] ?? '' }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="account_number">Account Number</label>
                                                                                <input type="text" class="form-control" id="account_number" name="interim_deed_account_number" placeholder="Enter Account Number" value="{{ $fpt['interim_deed_account_number'] ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="sort_code">Sort Code</label>
                                                                                <input type="text" class="form-control" id="sort_code" name="interim_deed_sort_code" placeholder="Enter Sort Code" value="{{ $fpt['interim_deed_sort_code'] ?? '' }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="payment_ref">Payment Ref</label>
                                                                                <input type="text" class="form-control" id="payment_ref" name="interim_deed_payment_ref" placeholder="Enter Payment Reference" value="{{ $fpt['interim_deed_payment_ref'] ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <h6>Declarations - Signing</h6>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="print_name">Print Name</label>
                                                                                <input type="text" class="form-control" id="print_name" name="interim_deed_print_name" placeholder="Enter Print Name" value="{{ $fpt['interim_deed_print_name'] ?? '' }}">
                                                                            </div>
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <label for="signature">Signature</label>
                                                                                <input type="text" class="form-control" id="signature" name="interim_deed_signature" placeholder="Enter Signature" value="{{ $fpt['interim_deed_signature'] ?? '' }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-md-6">
                                                                            <label for="position">Position</label>
                                                                            <input type="text" class="form-control" id="position" name="interim_deed_position" placeholder="Enter Position" value="{{ $fpt['interim_deed_position'] ?? '' }}">
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="company_stamp">Company Stamp</label>
                                                                            <textarea class="form-control" id="company_stamp" name="interim_deed_company_stamp" rows="3" placeholder="Enter Company Stamp">{{ $fpt['interim_deed_company_stamp'] ?? '' }}</textarea>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="date_signed">Date Signed</label>
                                                                            <input type="date" class="form-control" id="date_signed" name="interim_deed_date_signed" value="{{ $fpt['interim_deed_date_signed'] ?? '' }}">
                                                                        </div>

                                                                    {{--=========================                                           end infirm      ===========================                      ===========================================--}}
                                                                    <div class="col-12 d-flex justify-content-between">
                                                                        <button type="button" class="btn-prev-step btn-outline-secondary">
                                                                            <i class="icon-left-arrow ti-xs me-sm-2 me-0"></i>
                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                        </button>
                                                                        {{--                                                                            <button type="button" class="btn-next-step btn-outline-primary">--}}
                                                                        {{--                                                                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>--}}
                                                                        {{--                                                                                <i class="icon-right-arrow ti-xs"></i>--}}
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
                                            const nextButtons = document.querySelectorAll('.btn-next-step');
                                            const prevButtons = document.querySelectorAll('.btn-prev-step');
                                            const steps = document.querySelectorAll('.step-content');
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
                                    <!-- =========================== bank account further details card end =========================== !-->

                                    <div class="col-12 d-flex justify-content-between">
                                        <button type="button" class="btn btn-label-secondary btn-prev">
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
                                            <div class="col-8">
                                                <div id="multiStepWizard" class="form-wizard border-none shadow-none mt-5">
                                                    <div class="form-wizard-content px-0">

                                                        <!-- Step 1: Member Details -->
                                                        <div id="personalStep" class="wizard-step" style="display: block;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Member Details</h4>
                                                            </div>
                                                            <div class="row g-6">

                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="title">Title</label>
                                                                        <input type="text" class="form-control" id="title" name="member_questionaire_title" 
                                                                               placeholder="Enter Title" value="{{ $fpt['member_questionaire_title'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="forenames">Forename(s)</label>
                                                                        <input type="text" class="form-control" id="forenames" name="member_questionaire_forenames" 
                                                                               placeholder="Enter Forenames" value="{{ $fpt['member_questionaire_forenames'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="surname">Surname</label>
                                                                        <input type="text" class="form-control" id="surname" name="member_questionaire_surname" 
                                                                               placeholder="Enter Surname" value="{{ $fpt['member_questionaire_surname'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="previous_names">Previous Name(s)</label>
                                                                        <input type="text" class="form-control" id="previous_names" name="member_questionaire_previous_names" 
                                                                               placeholder="Enter Previous Name(s)" value="{{ $fpt['member_questionaire_previous_names'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="address">Permanent Residential Address</label>
                                                                        <input type="text" class="form-control" id="address" name="member_questionaire_address" 
                                                                               placeholder="Enter Address" value="{{ $fpt['member_questionaire_address'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="county">County</label>
                                                                        <input type="text" class="form-control" id="county" name="member_questionaire_county" 
                                                                               placeholder="Enter County" value="{{ $fpt['member_questionaire_county'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="postcode">Post Code</label>
                                                                        <input type="text" class="form-control" id="postcode" name="member_questionaire_postcode" 
                                                                               placeholder="Enter Post Code" value="{{ $fpt['member_questionaire_postcode'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="time_at_address_years">Time Spent At Address (Years)</label>
                                                                        <input type="number" class="form-control" id="time_at_address_years" name="member_questionaire_time_at_address_years" 
                                                                               placeholder="Years" value="{{ $fpt['member_questionaire_time_at_address_years'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="time_at_address_months">Time Spent At Address (Months)</label>
                                                                        <input type="number" class="form-control" id="time_at_address_months" name="member_questionaire_time_at_address_months" 
                                                                               placeholder="Months" value="{{ $fpt['member_questionaire_time_at_address_months'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="previous_address">Previous Residential Address</label>
                                                                        <input type="text" class="form-control" id="previous_address" name="member_questionaire_previous_address" 
                                                                               placeholder="Enter Previous Address" value="{{ $fpt['member_questionaire_previous_address'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="previous_county">Previous County</label>
                                                                        <input type="text" class="form-control" id="previous_county" name="member_questionaire_previous_county" 
                                                                               placeholder="Enter Previous County" value="{{ $fpt['member_questionaire_previous_county'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="previous_postcode">Previous Post Code</label>
                                                                        <input type="text" class="form-control" id="previous_postcode" name="member_questionaire_previous_postcode" 
                                                                               placeholder="Enter Previous Post Code" value="{{ $fpt['member_questionaire_previous_postcode'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="telephone_number">Telephone Number</label>
                                                                        <input type="text" class="form-control" id="telephone_number" name="member_questionaire_telephone_number" 
                                                                               placeholder="Enter Telephone Number" value="{{ $fpt['member_questionaire_telephone_number'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="email_address">Email Address</label>
                                                                        <input type="email" class="form-control" id="email_address" name="member_questionaire_email_address" 
                                                                               placeholder="Enter Email Address" value="{{ $fpt['member_questionaire_email_address'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="national_insurance_number">National Insurance Number</label>
                                                                        <input type="text" class="form-control" id="national_insurance_number" name="member_questionaire_national_insurance_number" 
                                                                               placeholder="Enter National Insurance Number" value="{{ $fpt['member_questionaire_national_insurance_number'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="taxpayer_reference">Unique Taxpayer Reference</label>
                                                                        <input type="text" class="form-control" id="taxpayer_reference" name="member_questionaire_taxpayer_reference" 
                                                                               placeholder="Enter Taxpayer Reference" value="{{ $fpt['member_questionaire_taxpayer_reference'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="occupation">Occupation</label>
                                                                        <input type="text" class="form-control" id="occupation" name="member_questionaire_occupation" 
                                                                               placeholder="Enter Occupation" value="{{ $fpt['member_questionaire_occupation'] ?? '' }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="employer_name">Employer Name</label>
                                                                        <input type="text" class="form-control" id="employer_name" name="member_questionaire_employer_name" 
                                                                               placeholder="Enter Employer Name" value="{{ $fpt['member_questionaire_employer_name'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                                                                                <div class="form-group">
                                                                    <label for="dob">Date Of Birth</label>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="dob_day" name="member_questionaire_dob_day" placeholder="Day" value="{{ old('member_questionaire_dob_day', $fpt->member_questionaire_dob_day ?? '') }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="dob_month" name="member_questionaire_dob_month" placeholder="Month" value="{{ old('member_questionaire_dob_month', $fpt->member_questionaire_dob_month ?? '') }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="dob_year" name="member_questionaire_dob_year" placeholder="Year" value="{{ old('member_questionaire_dob_year', $fpt->member_questionaire_dob_year ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="gender">Gender</label>
                                                                        <select class="form-control" id="gender" name="member_questionaire_gender">
                                                                            <option value="male" {{ (old('member_questionaire_gender', $fpt->member_questionaire_gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
                                                                            <option value="female" {{ (old('member_questionaire_gender', $fpt->member_questionaire_gender ?? '') == 'female') ? 'selected' : '' }}>Female</option>
                                                                        </select>
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="nationality">Nationality/Citizenship</label>
                                                                        <input type="text" class="form-control" id="nationality" name="member_questionaire_nationality" placeholder="Enter Nationality" value="{{ old('member_questionaire_nationality', $fpt->member_questionaire_nationality ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="marital_status">Marital Status</label>
                                                                        <select class="form-control" id="marital_status" name="member_questionaire_marital_status">
                                                                            <option value="single" {{ (old('member_questionaire_marital_status', $fpt->member_questionaire_marital_status ?? '') == 'single') ? 'selected' : '' }}>Single</option>
                                                                            <option value="married" {{ (old('member_questionaire_marital_status', $fpt->member_questionaire_marital_status ?? '') == 'married') ? 'selected' : '' }}>Married/Civil Partnership</option>
                                                                            <option value="divorced" {{ (old('member_questionaire_marital_status', $fpt->member_questionaire_marital_status ?? '') == 'divorced') ? 'selected' : '' }}>Divorced</option>
                                                                            <option value="separated" {{ (old('member_questionaire_marital_status', $fpt->member_questionaire_marital_status ?? '') == 'separated') ? 'selected' : '' }}>Separated</option>
                                                                            <option value="widowed" {{ (old('member_questionaire_marital_status', $fpt->member_questionaire_marital_status ?? '') == 'widowed') ? 'selected' : '' }}>Widowed</option>
                                                                        </select>
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="employment_status">What Is Your Employment Status?</label>
                                                                        <select class="form-control" id="employment_status" name="member_questionaire_employment_status">
                                                                            <option value="employed" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'employed') ? 'selected' : '' }}>Employed</option>
                                                                            <option value="self_employed" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'self_employed') ? 'selected' : '' }}>Self-Employed</option>
                                                                            <option value="unemployed" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'unemployed') ? 'selected' : '' }}>Unemployed</option>
                                                                            <option value="retired" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'retired') ? 'selected' : '' }}>Retired</option>
                                                                            <option value="student" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'student') ? 'selected' : '' }}>In Full-Time Education</option>
                                                                            <option value="carer_over_16" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'carer_over_16') ? 'selected' : '' }}>Caring For Person Over 16</option>
                                                                            <option value="carer_under_16" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'carer_under_16') ? 'selected' : '' }}>Caring For Child Under 16</option>
                                                                            <option value="child_under_16" {{ (old('member_questionaire_employment_status', $fpt->member_questionaire_employment_status ?? '') == 'child_under_16') ? 'selected' : '' }}>Child Under 16</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="current_occupation">Current/Previous Occupation</label>
                                                                        <input type="text" class="form-control" id="current_occupation" name="member_questionaire_current_occupation" placeholder="Enter Current/Previous Occupation" value="{{ old('member_questionaire_current_occupation', $fpt->member_questionaire_current_occupation ?? '') }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="job_title">Job Title</label>
                                                                        <input type="text" class="form-control" id="job_title" name="member_questionaire_job_title" placeholder="Enter Job Title" value="{{ old('member_questionaire_job_title', $fpt->member_questionaire_job_title ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Have You Opted Out Of Any Pension Arrangement?</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="opted_out_yes" name="member_questionaire_opted_out" value="yes" {{ (old('member_questionaire_opted_out', $fpt->member_questionaire_opted_out ?? '') == 'yes') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="opted_out_yes">Yes</label>
                                                                        <br>
                                                                        <input class="form-check-input" type="radio" id="opted_out_no" name="member_questionaire_opted_out" value="no" {{ (old('member_questionaire_opted_out', $fpt->member_questionaire_opted_out ?? '') == 'no') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="opted_out_no">No</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>Do You Have Protection Of Existing Pension Rights?</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="protection_yes" name="member_questionaire_protection" value="yes" {{ (old('member_questionaire_protection', $fpt->member_questionaire_protection ?? '') == 'yes') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="protection_yes">Yes</label>
                                                                        <br>
                                                                        <input class="form-check-input" type="radio" id="protection_no" name="member_questionaire_protection" value="no" {{ (old('member_questionaire_protection', $fpt->member_questionaire_protection ?? '') == 'no') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="protection_no">No</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                                                                                <div class="form-group">
                                                                    <label>If Yes, Please Confirm Which Protections Apply</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="primary_protection" name="member_questionaire_primary_protection" value="yes" {{ (old('member_questionaire_primary_protection', $fpt->member_questionaire_primary_protection ?? '') == 'yes') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="primary_protection">Primary Protection</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="lump_sum_protection" name="member_questionaire_lump_sum_protection" value="yes" {{ (old('member_questionaire_lump_sum_protection', $fpt->member_questionaire_lump_sum_protection ?? '') == 'yes') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="lump_sum_protection">Primary Protection With Lump Sum Protection</label>
                                                                    </div>
                                                                
                                                                </div>
                                                                
                                                                                                                                    <!-- Add other checkboxes similarly for other protections -->
                                                                                                                                </div>
                                                                
                                                                                                                               <div class="form-group">
                                                                    <label>Are You Subject To The Money Purchase Annual Allowance?</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="mpaa_yes" name="member_questionaire_mpaa" value="yes" {{ (old('member_questionaire_mpaa', $fpt->member_questionaire_mpaa ?? '') == 'yes') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="mpaa_yes">Yes</label>
                                                                        <br>
                                                                        <input class="form-check-input" type="radio" id="mpaa_no" name="member_questionaire_mpaa" value="no" {{ (old('member_questionaire_mpaa', $fpt->member_questionaire_mpaa ?? '') == 'no') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="mpaa_no">No</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="mpaa_date">If Yes, Please Confirm The Date The First Payment Occurred</label>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="mpaa_day" name="member_questionaire_mpaa_day" placeholder="Day" value="{{ old('member_questionaire_mpaa_day', $fpt->member_questionaire_mpaa_day ?? '') }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="mpaa_month" name="member_questionaire_mpaa_month" placeholder="Month" value="{{ old('member_questionaire_mpaa_month', $fpt->member_questionaire_mpaa_month ?? '') }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="mpaa_year" name="member_questionaire_mpaa_year" placeholder="Year" value="{{ old('member_questionaire_mpaa_year', $fpt->member_questionaire_mpaa_year ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- ===================  part 1 end ============= !-->
                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button class="btn-prev-wizard btn-secondary" disabled>
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Entitliment To Tax Relief  -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Entitliment To Tax Relief</h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Entitliment To Tax Relief  start ======================= !-->
                                                                <h4>2. Entitlement To Tax Relief</h4>

                                                               <div class="form-group">
                                                                    <label>Please Tick One Box Only:</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_1" name="entitlement_tax_relief_option" value="1" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '1') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_1">I Have Relevant UK Earnings Chargeable To UK Income Tax, And I Have Been Resident In The UK Some Time During The Current Tax Year.</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_2" name="entitlement_tax_relief_option" value="2" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '2') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_2">I Have General Earnings From Overseas Crown Employment Subject To UK Tax In The Current Tax Year.</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_3" name="entitlement_tax_relief_option" value="3" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '3') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_3">My Spouse/Civil Partner Has General Earnings From Overseas Crown Employment Subject To UK Tax In The Current Tax Year.</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_4" name="entitlement_tax_relief_option" value="4" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '4') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_4">I Am Not Resident In The UK In The Current Tax Year, But:</label>
                                                                        <ul>
                                                                            <li>I Was Resident In The UK At Some Time During The Five Tax Years Immediately Before The Tax Year In Question, And</li>
                                                                            <li>I Was Resident In The UK When I Joined The Pension Scheme, And</li>
                                                                            <li>I Have Relevant UK Earnings Chargeable To UK Income Tax.</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_5" name="entitlement_tax_relief_option" value="5" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '5') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_5">I Have No Relevant UK Earnings Chargeable To Income Tax, But I Have Been Resident In The UK Some Time During The Current Tax Year.</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_6" name="entitlement_tax_relief_option" value="6" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '6') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_6">I Or My Spouse/Civil Partner Are In Overseas Crown Employment But Do Not Have General Earnings Subject To UK Tax In The Current Tax Year.</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_7" name="entitlement_tax_relief_option" value="7" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '7') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_7">I Cannot Tick Any Of The Above, But:</label>
                                                                        <ul>
                                                                            <li>I Was Resident In The UK, Or Had Earnings Chargeable To UK Income Tax, At Some Time During The Five Years Immediately Before The Tax Year In Question, And</li>
                                                                            <li>I Was Resident In The UK When I Joined The Pension Scheme.</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="option_8" name="entitlement_tax_relief_option" value="8" {{ (old('entitlement_tax_relief_option', $fpt->entitlement_tax_relief_option ?? '') == '8') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="option_8">I Cannot Tick Any Of The Above.</label>
                                                                    </div>
                                                                </div>

                                                                <!-- ========================= Entitliment To Tax Relief end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Financial Adviser  -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Financial Adviser</h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Financial Adviserstart ======================= !-->


                                                                <h4>3. Financial Adviser</h4>

                                                               <div class="form-group">
                                                                    <label>Is Your Personal Financial Adviser The Same As The Scheme Adviser?</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="adviser_same_yes" name="financial_que_adviser_same" value="yes" 
                                                                            <?php echo isset($fpt->financial_que_adviser_same) && $fpt->financial_que_adviser_same === 'yes' ? 'checked' : ''; ?>>
                                                                        <label class="form-check-label" for="adviser_same_yes">Yes</label>
                                                                        <br>
                                                                        <input class="form-check-input" type="radio" id="adviser_same_no" name="financial_que_adviser_same" value="no" 
                                                                            <?php echo isset($fpt->financial_que_adviser_same) && $fpt->financial_que_adviser_same === 'no' ? 'checked' : ''; ?>>
                                                                        <label class="form-check-label" for="adviser_same_no">No</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <h5>If No, Please Provide Your Personal Financial Adviser's Details:</h5>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="contact_name">Contact Name</label>
                                                                        <input type="text" class="form-control" id="contact_name" name="financial_que_contact_name" 
                                                                            value="<?php echo isset($fpt->financial_que_contact_name) ? htmlspecialchars($fpt->financial_que_contact_name) : ''; ?>" 
                                                                            placeholder="Enter Contact Name">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="company_name">Company Name</label>
                                                                        <input type="text" class="form-control" id="company_name" name="financial_que_company_name" 
                                                                            value="<?php echo isset($fpt->financial_que_company_name) ? htmlspecialchars($fpt->financial_que_company_name) : ''; ?>" 
                                                                            placeholder="Enter Company Name">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" class="form-control" id="address" name="financial_que_address" 
                                                                            value="<?php echo isset($fpt->financial_que_address) ? htmlspecialchars($fpt->financial_que_address) : ''; ?>" 
                                                                            placeholder="Enter Address">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="country">Country</label>
                                                                        <input type="text" class="form-control" id="country" name="financial_que_country" 
                                                                            value="<?php echo isset($fpt->financial_que_country) ? htmlspecialchars($fpt->financial_que_country) : ''; ?>" 
                                                                            placeholder="Enter Country">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="postcode">Post Code</label>
                                                                        <input type="text" class="form-control" id="postcode" name="financial_que_postcode" 
                                                                            value="<?php echo isset($fpt->financial_que_postcode) ? htmlspecialchars($fpt->financial_que_postcode) : ''; ?>" 
                                                                            placeholder="Enter Post Code">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="telephone_number">Telephone Number</label>
                                                                        <input type="text" class="form-control" id="telephone_number" name="financial_que_telephone_number" 
                                                                            value="<?php echo isset($fpt->financial_que_telephone_number) ? htmlspecialchars($fpt->financial_que_telephone_number) : ''; ?>" 
                                                                            placeholder="Enter Telephone Number">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="email_address">Email Address</label>
                                                                        <input type="email" class="form-control" id="email_address" name="financial_que_email_address" 
                                                                            value="<?php echo isset($fpt->financial_que_email_address) ? htmlspecialchars($fpt->financial_que_email_address) : ''; ?>" 
                                                                            placeholder="Enter Email Address">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="regulated_by">Regulated By</label>
                                                                        <input type="text" class="form-control" id="regulated_by" name="financial_que_regulated_by" 
                                                                            value="<?php echo isset($fpt->financial_que_regulated_by) ? htmlspecialchars($fpt->financial_que_regulated_by) : ''; ?>" 
                                                                            placeholder="Enter Regulated By">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="authorisation_number">Authorisation Number</label>
                                                                    <input type="text" class="form-control" id="authorisation_number" name="financial_que_authorisation_number" 
                                                                        value="<?php echo isset($fpt->financial_que_authorisation_number) ? htmlspecialchars($fpt->financial_que_authorisation_number) : ''; ?>" 
                                                                        placeholder="Enter Authorisation Number">
                                                                </div>
                                                                
                                                                <h5>If You Have Ticked 'YES' Above, Please Complete The Details Below:</h5>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="network_name">Name Of Network Or Principal</label>
                                                                        <input type="text" class="form-control" id="network_name" name="financial_que_network_name" 
                                                                            value="<?php echo isset($fpt->financial_que_network_name) ? htmlspecialchars($fpt->financial_que_network_name) : ''; ?>" 
                                                                            placeholder="Enter Network Name">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="network_regulated_by">Regulated By</label>
                                                                        <input type="text" class="form-control" id="network_regulated_by" name="financial_que_network_regulated_by" 
                                                                            value="<?php echo isset($fpt->financial_que_network_regulated_by) ? htmlspecialchars($fpt->financial_que_network_regulated_by) : ''; ?>" 
                                                                            placeholder="Enter Regulated By">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="company_authorisation_number">Company Authorisation Number</label>
                                                                    <input type="text" class="form-control" id="company_authorisation_number" name="financial_que_company_authorisation_number" 
                                                                        value="<?php echo isset($fpt->financial_que_company_authorisation_number) ? htmlspecialchars($fpt->financial_que_company_authorisation_number) : ''; ?>" 
                                                                        placeholder="Enter Company Authorisation Number">
                                                                </div>

                                                                <!-- ========================= Financial Adviser end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Common Investment Funds   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Common Investment Funds </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Common Investment Funds start ======================= !-->
                                                                <h4>4. Common Investment Funds</h4>

                                                                <p>Please Tell Us Which Of The Scheme’s Common Investment Funds You Will Be Participating In (If Any).</p>
                                                                <p>We Require A Minimum Of £3,000 In Cash, Or Other Easily Realizable Assets, To Be Held Within The Family Pension Trust At All Times To Meet Ongoing Charges.</p>
                                                                <p>Decisions Relating To Investments Held In A Common Investment Fund Must Be Agreed Unanimously By All Members Participating Within That Fund.</p>
                                                                <p>A Bank Account For Each Common Investment Fund Is Opened With Alltrust SIPP Limited’s Designated Bank. Alltrust SIPP Limited Will Act As Sole Signatory To The Account, Under The Direction Of The Chairperson.</p>
                                                               <div class="form-group">
                                                                    <label>Is Your Personal Financial Adviser The Same As The Scheme Adviser?</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="adviser_same_yes" name="financial_que_adviser_same" value="yes" {{ $fpt->financial_que_adviser_same == 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="adviser_same_yes">Yes</label>
                                                                        <br>
                                                                        <input class="form-check-input" type="radio" id="adviser_same_no" name="financial_que_adviser_same" value="no" {{ $fpt->financial_que_adviser_same == 'no' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="adviser_same_no">No</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <h5>If No, Please Provide Your Personal Financial Adviser's Details:</h5>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="contact_name">Contact Name</label>
                                                                        <input type="text" class="form-control" id="contact_name" name="financial_que_contact_name" placeholder="Enter Contact Name" value="{{ $fpt->financial_que_contact_name }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="company_name">Company Name</label>
                                                                        <input type="text" class="form-control" id="company_name" name="financial_que_company_name" placeholder="Enter Company Name" value="{{ $fpt->financial_que_company_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" class="form-control" id="address" name="financial_que_address" placeholder="Enter Address" value="{{ $fpt->financial_que_address }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="country">Country</label>
                                                                        <input type="text" class="form-control" id="country" name="financial_que_country" placeholder="Enter Country" value="{{ $fpt->financial_que_country }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="postcode">Post Code</label>
                                                                        <input type="text" class="form-control" id="postcode" name="financial_que_postcode" placeholder="Enter Post Code" value="{{ $fpt->financial_que_postcode }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="telephone_number">Telephone Number</label>
                                                                        <input type="text" class="form-control" id="telephone_number" name="financial_que_telephone_number" placeholder="Enter Telephone Number" value="{{ $fpt->financial_que_telephone_number }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="email_address">Email Address</label>
                                                                        <input type="email" class="form-control" id="email_address" name="financial_que_email_address" placeholder="Enter Email Address" value="{{ $fpt->financial_que_email_address }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="regulated_by">Regulated By</label>
                                                                        <input type="text" class="form-control" id="regulated_by" name="financial_que_regulated_by" placeholder="Enter Regulated By" value="{{ $fpt->financial_que_regulated_by }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="authorisation_number">Authorisation Number</label>
                                                                    <input type="text" class="form-control" id="authorisation_number" name="financial_que_authorisation_number" placeholder="Enter Authorisation Number" value="{{ $fpt->financial_que_authorisation_number }}">
                                                                </div>
                                                                
                                                                <h5>If You Have Ticked 'YES' Above, Please Complete The Details Below:</h5>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="network_name">Name Of Network Or Principal</label>
                                                                        <input type="text" class="form-control" id="network_name" name="financial_que_network_name" placeholder="Enter Network Name" value="{{ $fpt->financial_que_network_name }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="network_regulated_by">Regulated By</label>
                                                                        <input type="text" class="form-control" id="network_regulated_by" name="financial_que_network_regulated_by" placeholder="Enter Regulated By" value="{{ $fpt->financial_que_network_regulated_by }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="company_authorisation_number">Company Authorisation Number</label>
                                                                    <input type="text" class="form-control" id="company_authorisation_number" name="financial_que_company_authorisation_number" placeholder="Enter Company Authorisation Number" value="{{ $fpt->financial_que_company_authorisation_number }}">
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="common_investment_1">Name Of Common Investment (1)</label>
                                                                        <input type="text" class="form-control" id="common_investment_1" name="fund_common_investment_1" placeholder="Enter Name Of Common Investment" value="{{ $fpt->fund_common_investment_1 }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="investment_1">Name Of Investment (1)</label>
                                                                        <input type="text" class="form-control" id="investment_1" name="fund_investment_1" placeholder="Enter Name Of Investment" value="{{ $fpt->fund_investment_1 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="common_investment_2">Name Of Common Investment (2)</label>
                                                                        <input type="text" class="form-control" id="common_investment_2" name="fund_common_investment_2" placeholder="Enter Name Of Common Investment" value="{{ $fpt->fund_common_investment_2 }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="investment_2">Name Of Investment (2)</label>
                                                                        <input type="text" class="form-control" id="investment_2" name="fund_investment_2" placeholder="Enter Name Of Investment" value="{{ $fpt->fund_investment_2 }}">
                                                                    </div>
                                                                </div>
                                                                <!-- Add additional fields for more investments -->
                                                                
                                                                <div class="form-group">
                                                                    <label for="additional_details">Additional Details</label>
                                                                    <textarea class="form-control" id="additional_details" name="fund_additional_details" rows="4" placeholder="Provide Additional Details">{{ $fpt->fund_additional_details }}</textarea>
                                                                </div>

                                                                <!-- ========================= Common Investment Funds end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Member's Investment Funds   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Member Investment Funds </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Common Investment Funds start ======================= !-->


                                                                <h4>5. Member's Investment Funds</h4>

                                                                <p>Please Also Tell Us Which Investments You Will Be Making Yourself.</p>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="investment_1">Investment 1</label>
                                                                        <input type="text" class="form-control" id="investment_1" name="members_fund_investment_1" placeholder="Enter Investment 1" value="{{ $fpt->members_fund_investment_1 }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="investment_2">Investment 2</label>
                                                                        <input type="text" class="form-control" id="investment_2" name="members_fund_investment_2" placeholder="Enter Investment 2" value="{{ $fpt->members_fund_investment_2 }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="investment_3">Investment 3</label>
                                                                        <input type="text" class="form-control" id="investment_3" name="members_fund_investment_3" placeholder="Enter Investment 3" value="{{ $fpt->members_fund_investment_3 }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="investment_4">Investment 4</label>
                                                                        <input type="text" class="form-control" id="investment_4" name="members_fund_investment_4" placeholder="Enter Investment 4" value="{{ $fpt->members_fund_investment_4 }}">
                                                                    </div>
                                                                </div>

                                                                <!-- ========================= Common Investment Funds end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Step : Nomination of beneficires   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Nominations Of Beneficries </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Common Investment Funds start ======================= !-->
                                                                <h4>6. Nomination of Beneficiaries</h4>
                                                                <p>Please Confirm The Percentage Split Of Any Benefits You Wish To Be Paid To Your Nominated Beneficiaries.</p>
                                                                <div class="row">

                                                                   <div class="col-md-6">
                                                                            <label for="beneficiary_1_name">Name Of Dependant/Beneficiary 1</label>
                                                                            <input type="text" class="form-control" id="beneficiary_1_name" name="nomination_beneficiary_1_name" placeholder="Enter Name" value="{{ $fpt->nomination_beneficiary_1_name }}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="beneficiary_1_relationship">Relationship</label>
                                                                            <input type="text" class="form-control" id="beneficiary_1_relationship" name="nomination_beneficiary_1_relationship" placeholder="Enter Relationship" value="{{ $fpt->nomination_beneficiary_1_relationship }}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="beneficiary_1_percentage">Percentage (%)</label>
                                                                            <input type="number" class="form-control" id="beneficiary_1_percentage" name="nomination_beneficiary_1_percentage" placeholder="Enter Percentage" value="{{ $fpt->nomination_beneficiary_1_percentage }}">
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="beneficiary_2_name">Name Of Dependant/Beneficiary 2</label>
                                                                                <input type="text" class="form-control" id="beneficiary_2_name" name="nomination_beneficiary_2_name" placeholder="Enter Name" value="{{ $fpt->nomination_beneficiary_2_name }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="beneficiary_2_relationship">Relationship</label>
                                                                                <input type="text" class="form-control" id="beneficiary_2_relationship" name="nomination_beneficiary_2_relationship" placeholder="Enter Relationship" value="{{ $fpt->nomination_beneficiary_2_relationship }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="beneficiary_2_percentage">Percentage (%)</label>
                                                                                <input type="number" class="form-control" id="beneficiary_2_percentage" name="nomination_beneficiary_2_percentage" placeholder="Enter Percentage" value="{{ $fpt->nomination_beneficiary_2_percentage }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="beneficiary_3_name">Name Of Dependant/Beneficiary 3</label>
                                                                                <input type="text" class="form-control" id="beneficiary_3_name" name="nomination_beneficiary_3_name" placeholder="Enter Name" value="{{ $fpt->nomination_beneficiary_3_name }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="beneficiary_3_relationship">Relationship</label>
                                                                                <input type="text" class="form-control" id="beneficiary_3_relationship" name="nomination_beneficiary_3_relationship" placeholder="Enter Relationship" value="{{ $fpt->nomination_beneficiary_3_relationship }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="beneficiary_3_percentage">Percentage (%)</label>
                                                                                <input type="number" class="form-control" id="beneficiary_3_percentage" name="nomination_beneficiary_3_percentage" placeholder="Enter Percentage" value="{{ $fpt->nomination_beneficiary_3_percentage }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <h5>If You Wish To Nominate A Charity/Charities</h5>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="charity_1_name">Name Of Charity 1</label>
                                                                                <input type="text" class="form-control" id="charity_1_name" name="nomination_charity_1_name" placeholder="Enter Charity Name" value="{{ $fpt->nomination_charity_1_name }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="charity_1_percentage">Percentage (%)</label>
                                                                                <input type="number" class="form-control" id="charity_1_percentage" name="nomination_charity_1_percentage" placeholder="Enter Percentage" value="{{ $fpt->nomination_charity_1_percentage }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="charity_2_name">Name Of Charity 2</label>
                                                                                <input type="text" class="form-control" id="charity_2_name" name="nomination_charity_2_name" placeholder="Enter Charity Name" value="{{ $fpt->nomination_charity_2_name }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="charity_2_percentage">Percentage (%)</label>
                                                                                <input type="number" class="form-control" id="charity_2_percentage" name="nomination_charity_2_percentage" placeholder="Enter Percentage" value="{{ $fpt->nomination_charity_2_percentage }}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="charity_3_name">Name Of Charity 3</label>
                                                                                <input type="text" class="form-control" id="charity_3_name" name="nomination_charity_3_name" placeholder="Enter Charity Name" value="{{ $fpt->nomination_charity_3_name }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="charity_3_percentage">Percentage (%)</label>
                                                                                <input type="number" class="form-control" id="charity_3_percentage" name="nomination_charity_3_percentage" placeholder="Enter Percentage" value="{{ $fpt->nomination_charity_3_percentage }}">
                                                                            </div>
                                                                        </div>

                                                                    <!-- ========================= Common Investment Funds end ======================= !-->

                                                                    <div class="col-12 d-flex justify-content-between">
                                                                        <button type="button" class="btn-prev-wizard btn-secondary">
                                                                            <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                        </button>
                                                                        <button type="button" class="btn-next-wizard btn-primary">
                                                                            <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                            <i class="arrow-right-icon ti-xs"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <!-- Step : Personal Contribution   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Personal Contribution </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Personal Contribution start ======================= !-->

                                                                <h4>7. Personal Contributions</h4>

                                                                <p>Please complete this section if you will be paying personal contributions into the scheme. Do not include details of any employer contributions or benefits transferring from other pension arrangements in this section. If you have benefits which are subject to enhanced protection, or fixed protection, the protection will be lost if a contribution is paid by/for you.</p>
                                                                <p>Tax relief can only be claimed on contributions made before age 75.</p>
                                                                <p>Please note that payment of any basic rate tax relief due can take up to 11 weeks on claims for tax relief of more than £50. Claims for tax relief of less than £50 can only be submitted to HMRC annually after the end of the tax year. The payment will only be available for investment once it has been received in your bank account. Tax relief above the basic rate of tax should be reclaimed via your annual self-assessment tax return.</p>
                                                                <p>Please ensure you seek advice from a suitably qualified professional before paying contributions into the scheme. Please DO NOT attach any contribution cheques, as they cannot be accepted until the scheme has been registered with HMRC.</p>
                                                                <p>Once the scheme has been registered we will provide you with bank account details to enable any contributions to be made. To comply with Anti Money Laundering regulations, if personal contributions are to be made by a third party, we will need to verify their identity.</p>

                                                                <div class="form-group">
                                                                    <label for="regular_contribution">Regular Contribution (Net)</label>
                                                                    <input type="number" class="form-control" id="regular_contribution" name="personal_regular_contribution" placeholder="Enter Regular Contribution Amount" value="{{ $fpt['personal_regular_contribution'] ?? '' }}">
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="single_contribution">Single Contribution (Net)</label>
                                                                    <input type="number" class="form-control" id="single_contribution" name="personal_single_contribution" placeholder="Enter Single Contribution Amount" value="{{ $fpt['personal_single_contribution'] ?? '' }}">
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="source_of_funds">Source Of Funds (Remitting Bank Details, Beneficial Owner Of The Funds, And The Origin Of The Funds)</label>
                                                                    <textarea class="form-control" id="source_of_funds" name="personal_source_of_funds" rows="3" placeholder="Enter Source Of Funds">{{ $fpt['personal_source_of_funds'] ?? '' }}</textarea>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="contribution_frequency">Regular Contribution Payment Frequency</label>
                                                                    <select class="form-control" id="contribution_frequency" name="personal_contribution_frequency">
                                                                        <option value="monthly" {{ (isset($fpt['personal_contribution_frequency']) && $fpt['personal_contribution_frequency'] === 'monthly') ? 'selected' : '' }}>Monthly</option>
                                                                        <option value="quarterly" {{ (isset($fpt['personal_contribution_frequency']) && $fpt['personal_contribution_frequency'] === 'quarterly') ? 'selected' : '' }}>Quarterly</option>
                                                                        <option value="half_yearly" {{ (isset($fpt['personal_contribution_frequency']) && $fpt['personal_contribution_frequency'] === 'half_yearly') ? 'selected' : '' }}>Half Yearly</option>
                                                                        <option value="yearly" {{ (isset($fpt['personal_contribution_frequency']) && $fpt['personal_contribution_frequency'] === 'yearly') ? 'selected' : '' }}>Yearly</option>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="start_date_day">Start Date For Regular Contributions</label>
                                                                    <div class="form-row">
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="start_date_day" name="personal_start_date_day" placeholder="Day" value="{{ $fpt['personal_start_date_day'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="start_date_month" name="personal_start_date_month" placeholder="Month" value="{{ $fpt['personal_start_date_month'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" id="start_date_year" name="personal_start_date_year" placeholder="Year" value="{{ $fpt['personal_start_date_year'] ?? '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>Will Your Employer Pay Your Personal Contributions On Your Behalf?</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="employer_pay_yes" name="personal_employer_pay" value="yes" {{ (isset($fpt['personal_employer_pay']) && $fpt['personal_employer_pay'] === 'yes') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="employer_pay_yes">Yes</label>
                                                                        <br>
                                                                        
                                                                        <input class="form-check-input" type="radio" id="employer_pay_no" name="personal_employer_pay" value="no" {{ (isset($fpt['personal_employer_pay']) && $fpt['personal_employer_pay'] === 'no') ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="employer_pay_no">No</label>
                                                                    </div>
                                                                </div>



                                                                <!-- ========================= Personal Contribution end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Employee Details   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Employee Details </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= employee detailss start ======================= !-->


                                                                <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="employer_name">Name</label>
                                                                            <input type="text" class="form-control" id="employer_name" name="questionaries_employer_name" placeholder="Enter Employer Name" value="<?= htmlspecialchars($fpt['questionaries_employer_name'] ?? '') ?>">
                                                                        </div>
                                                                    
                                                                        <div class="form-group col-md-6">
                                                                            <label for="registered_address">Registered Address (If Applicable)</label>
                                                                            <input type="text" class="form-control" id="registered_address" name="questionaries_registered_address" placeholder="Enter Address" value="<?= htmlspecialchars($fpt['questionaries_registered_address'] ?? '') ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="country">Country</label>
                                                                            <input type="text" class="form-control" id="country" name="questionaries_country" placeholder="Enter Country" value="<?= htmlspecialchars($fpt['questionaries_country'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="postcode">Post Code</label>
                                                                            <input type="text" class="form-control" id="postcode" name="questionaries_postcode" placeholder="Enter Post Code" value="<?= htmlspecialchars($fpt['questionaries_postcode'] ?? '') ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="telephone_number">Telephone Number</label>
                                                                            <input type="text" class="form-control" id="telephone_number" name="questionaries_telephone_number" placeholder="Enter Telephone Number" value="<?= htmlspecialchars($fpt['questionaries_telephone_number'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="email_address">Email Address</label>
                                                                            <input type="email" class="form-control" id="email_address" name="questionaries_email_address" placeholder="Enter Email Address" value="<?= htmlspecialchars($fpt['questionaries_email_address'] ?? '') ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="trading_address">Trading Address (If Different From Above)</label>
                                                                            <input type="text" class="form-control" id="trading_address" name="questionaries_trading_address" placeholder="Enter Trading Address" value="<?= htmlspecialchars($fpt['questionaries_trading_address'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="trading_country">Trading Address Country</label>
                                                                            <input type="text" class="form-control" id="trading_country" name="questionaries_trading_country" placeholder="Enter Country" value="<?= htmlspecialchars($fpt['questionaries_trading_country'] ?? '') ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="trading_postcode">Trading Address Post Code</label>
                                                                            <input type="text" class="form-control" id="trading_postcode" name="questionaries_trading_postcode" placeholder="Enter Post Code" value="<?= htmlspecialchars($fpt['questionaries_trading_postcode'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="employer_status">Employer Status (e.g., Limited by Guarantee, Partnership)</label>
                                                                            <input type="text" class="form-control" id="employer_status" name="questionaries_employer_status" placeholder="Enter Employer Status" value="<?= htmlspecialchars($fpt['questionaries_employer_status'] ?? '') ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="nature_of_business">Nature Of Business</label>
                                                                            <input type="text" class="form-control" id="nature_of_business" name="questionaries_nature_of_business" placeholder="Enter Nature Of Business" value="<?= htmlspecialchars($fpt['questionaries_nature_of_business'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label for="employer_year_end">Employer Year End</label>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <input type="text" class="form-control" id="employer_year_end_day" name="questionaries_employer_year_end_day" placeholder="Day" value="<?= htmlspecialchars($fpt['questionaries_employer_year_end_day'] ?? '') ?>">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <input type="text" class="form-control" id="employer_year_end_month" name="questionaries_employer_year_end_month" placeholder="Month" value="<?= htmlspecialchars($fpt['questionaries_employer_year_end_month'] ?? '') ?>">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <input type="text" class="form-control" id="employer_year_end_year" name="questionaries_employer_year_end_year" placeholder="Year" value="<?= htmlspecialchars($fpt['questionaries_employer_year_end_year'] ?? '') ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                                                                                      <div class="form-group col-md-12">
                                                                        <label for="registration_number">Registration Number (If Applicable)</label>
                                                                        <input type="text" class="form-control" id="registration_number" name="questionaries_registration_number" placeholder="Enter Registration Number" value="<?= htmlspecialchars($fpt['questionaries_registration_number'] ?? '') ?>">
                                                                    </div>
                                                                    
                                                                    <div class="form-group col-md-12">
                                                                        <label for="employed_since_day">Date Joined Employer</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="employed_since_day" name="questionaries_employed_since_day" placeholder="Day" value="<?= htmlspecialchars($fpt['questionaries_employed_since_day'] ?? '') ?>">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="employed_since_month" name="questionaries_employed_since_month" placeholder="Month" value="<?= htmlspecialchars($fpt['questionaries_employed_since_month'] ?? '') ?>">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <input type="number" class="form-control" id="employed_since_year" name="questionaries_employed_since_year" placeholder="Year" value="<?= htmlspecialchars($fpt['questionaries_employed_since_year'] ?? '') ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                              <div class="form-group">
                                                                        <label for="director_status">Are You A Director?</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="director_yes" name="questionaries_director_status" value="yes" 
                                                                                   <?= (isset($fpt['questionaries_director_status']) && $fpt['questionaries_director_status'] === 'yes') ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="director_yes">Yes</label>
                                                                            <br>
                                                                            
                                                                            <input class="form-check-input" type="radio" id="director_no" name="questionaries_director_status" value="no" 
                                                                                   <?= (isset($fpt['questionaries_director_status']) && $fpt['questionaries_director_status'] === 'no') ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="director_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="shareholdings">Please Provide Details Of Your Shareholdings In The Employer (If Any)</label>
                                                                        <textarea class="form-control" id="shareholdings" name="questionaries_shareholdings" rows="3" placeholder="Enter Shareholdings Details"><?= htmlspecialchars($fpt['questionaries_shareholdings'] ?? '') ?></textarea>
                                                                    </div>



                                                                <!-- ========================= employee details Funds end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Employer Controbutions   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Employer Controbutions </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Employer Controbutionsstart ======================= !-->

                                                                <p>This Section Is To Be Completed By The Employer.</p>
                                                                <p>Please Confirm The Level Of Contributions You Propose To Pay For This Member.</p>
                                                                <p>If The Member Has Benefits Which Are Subject To Enhanced Protection Or Fixed Protection, The Protection Will Be Lost If A Contribution Is Paid.</p>
                                                                <p>The Pensions Regulator's Code Of Practice Requires Us To Report Late Payment Of Contributions Made By An Employer On Behalf Of An Employee, Under A Direct Payment Arrangement.</p>
                                                                <p>Please DO NOT Attach Any Contribution Cheques, As They Cannot Be Accepted Until The Scheme Has Been Registered With HMRC.</p>
                                                                <p>Once We Have Registered The Scheme We Will Provide You With Bank Account Details To Enable Any Contributions To Be Made.</p>


                                                                                                                               <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="regular_contribution">Regular Contribution (£)</label>
                                                                        <input type="text" class="form-control" id="regular_contribution" name="emp_contr_emp_contr_regular_contribution" 
                                                                               placeholder="£" value="<?= htmlspecialchars($fpt['emp_contr_emp_contr_regular_contribution'] ?? '') ?>">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="single_contribution">Single Contribution (£)</label>
                                                                        <input type="text" class="form-control" id="single_contribution" name="emp_contr_single_contribution" 
                                                                               placeholder="£" value="<?= htmlspecialchars($fpt['emp_contr_single_contribution'] ?? '') ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="frequency">Regular Contribution Payment Frequency</label><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="emp_contr_frequency" id="monthly" value="monthly" 
                                                                               <?= (isset($fpt['emp_contr_frequency']) && $fpt['emp_contr_frequency'] === 'monthly') ? 'checked' : '' ?>>
                                                                        <label class="form-check-label" for="monthly">Monthly</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="emp_contr_frequency" id="quarterly" value="quarterly" 
                                                                               <?= (isset($fpt['emp_contr_frequency']) && $fpt['emp_contr_frequency'] === 'quarterly') ? 'checked' : '' ?>>
                                                                        <label class="form-check-label" for="quarterly">Quarterly</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="emp_contr_frequency" id="half_yearly" value="half-yearly" 
                                                                               <?= (isset($fpt['emp_contr_frequency']) && $fpt['emp_contr_frequency'] === 'half-yearly') ? 'checked' : '' ?>>
                                                                        <label class="form-check-label" for="half_yearly">Half-Yearly</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="emp_contr_frequency" id="yearly" value="yearly" 
                                                                               <?= (isset($fpt['emp_contr_frequency']) && $fpt['emp_contr_frequency'] === 'yearly') ? 'checked' : '' ?>>
                                                                        <label class="form-check-label" for="yearly">Yearly</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="start_date">Proposed Start Date For Regular Contributions</label>
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="emp_contr_day" placeholder="Day" 
                                                                                   value="<?= htmlspecialchars($fpt['emp_contr_day'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="emp_contr_month" placeholder="Month" 
                                                                                   value="<?= htmlspecialchars($fpt['emp_contr_month'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="emp_contr_year" placeholder="Year" 
                                                                                   value="<?= htmlspecialchars($fpt['emp_contr_year'] ?? '') ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                                <!-- ========================= Employer Controbutions end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Step : Employer Declaration   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Employer Declaration  </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Employer Declaration ======================= !-->


                                                                <p>To Be Signed By An Authorised Signatory Of The Employer Other Than The Member, Unless The Member Is The Only Authorised Signatory Or Self-Employed.</p>
                                                                <p>The Information Provided On This Form Is Correct To The Best Of My Knowledge. I Confirm I Understand That Once A Contribution Has Been Made To A Scheme, It Cannot Be Returned.</p>

                                                               <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="signature">Signature</label>
                                                                        <input type="text" class="form-control" id="signature" name="empl_dec_signature" 
                                                                               placeholder="Enter Signature" value="<?= htmlspecialchars($fpt['empl_dec_signature'] ?? '') ?>">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="print_name">Print Name</label>
                                                                        <input type="text" class="form-control" id="print_name" name="empl_dec_print_name" 
                                                                               placeholder="Enter Print Name" value="<?= htmlspecialchars($fpt['empl_dec_print_name'] ?? '') ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group col-md-6">
                                                                    <label for="position">Position</label>
                                                                    <input type="text" class="form-control" id="position" name="empl_dec_position" 
                                                                           placeholder="Enter Position" value="<?= htmlspecialchars($fpt['empl_dec_position'] ?? '') ?>">
                                                                </div>
                                                                
                                                                <div class="form-group col-md-6">
                                                                    <label for="date">Date</label>
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <input type="number" class="form-control" name="empl_dec_day" placeholder="Day" 
                                                                                   value="<?= htmlspecialchars($fpt['empl_dec_day'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="number" class="form-control" name="empl_dec_month" placeholder="Month" 
                                                                                   value="<?= htmlspecialchars($fpt['empl_dec_month'] ?? '') ?>">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="number" class="form-control" name="empl_dec_year" placeholder="Year" 
                                                                                   value="<?= htmlspecialchars($fpt['empl_dec_year'] ?? '') ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                                <!-- ========================= Employer Declaration end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <!-- Step : Transfer To Be Made into plan   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Transfer To Be Made into plan </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Transfer To Be Made into plan start ======================= !-->



                                                               <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="member_name">Member Name</label>
                                                                        <input type="text" class="form-control" id="member_name" name="trans_plan_member_name" 
                                                                               placeholder="Enter Member Name" value="<?= htmlspecialchars($fpt['trans_plan_member_name'] ?? '') ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="telephone_number">Telephone Number</label>
                                                                        <input type="text" class="form-control" id="telephone_number" name="trans_plan_telephone_number" 
                                                                               placeholder="Enter Telephone Number" value="<?= htmlspecialchars($fpt['trans_plan_telephone_number'] ?? '') ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="email_address">Email Address</label>
                                                                        <input type="email" class="form-control" id="email_address" name="trans_plan_email_address" 
                                                                               placeholder="Enter Email Address" value="<?= htmlspecialchars($fpt['trans_plan_email_address'] ?? '') ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="transfer_scheme_type">Transfer Scheme Type</label>
                                                                        <input type="text" class="form-control" id="transfer_scheme_type" name="trans_plan_transfer_scheme_type" 
                                                                               placeholder="Enter Transfer Scheme Type" value="<?= htmlspecialchars($fpt['trans_plan_transfer_scheme_type'] ?? '') ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <h5>Transfers To Be Made Into This Plan</h5>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" class="form-control" id="address" name="trans_plan_address" 
                                                                               placeholder="Enter Address" value="<?= htmlspecialchars($fpt['trans_plan_address'] ?? '') ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="postcode">Post Code</label>
                                                                        <input type="text" class="form-control" id="postcode" name="trans_plan_postcode" 
                                                                               placeholder="Enter Post Code" value="<?= htmlspecialchars($fpt['trans_plan_postcode'] ?? '') ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="country">Country</label>
                                                                        <input type="text" class="form-control" id="country" name="trans_plan_country" 
                                                                               placeholder="Enter Country" value="<?= htmlspecialchars($fpt['trans_plan_country'] ?? '') ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="scheme_type">Is this an Occupational Scheme?</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="scheme_type_yes" name="trans_plan_scheme_type" value="yes" 
                                                                                   <?= isset($fpt['trans_plan_scheme_type']) && $fpt['trans_plan_scheme_type'] === 'yes' ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="scheme_type_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="scheme_type_no" name="trans_plan_scheme_type" value="no" 
                                                                                   <?= isset($fpt['trans_plan_scheme_type']) && $fpt['trans_plan_scheme_type'] === 'no' ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="scheme_type_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="plan_scheme_name">Plan/Scheme Name</label>
                                                                        <input type="text" class="form-control" id="plan_scheme_name" name="trans_plan_plan_scheme_name" 
                                                                               placeholder="Enter Plan/Scheme Name" value="<?= htmlspecialchars($fpt['trans_plan_plan_scheme_name'] ?? '') ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="scheme_number">Plan/Scheme Number</label>
                                                                        <input type="text" class="form-control" id="scheme_number" name="trans_plan_scheme_number" 
                                                                               placeholder="Enter Plan/Scheme Number" value="<?= htmlspecialchars($fpt['trans_plan_scheme_number'] ?? '') ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="reference">Pension Scheme Tax Reference</label>
                                                                        <input type="text" class="form-control" id="reference" name="trans_plan_reference" 
                                                                               placeholder="Enter Pension Scheme Tax Reference" value="<?= htmlspecialchars($fpt['trans_plan_reference'] ?? '') ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="value_of_fund">Value of Fund</label>
                                                                        <input type="text" class="form-control" id="value_of_fund" name="trans_plan_value_of_fund" 
                                                                               placeholder="Enter Value of Fund" value="<?= htmlspecialchars($fpt['trans_plan_value_of_fund'] ?? '') ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="wish_transfer">Do You Wish to Transfer into This Pension Arrangement?</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="wish_transfer_yes" name="trans_plan_wish_transfer" value="yes" 
                                                                                   <?= isset($fpt['trans_plan_wish_transfer']) && $fpt['trans_plan_wish_transfer'] === 'yes' ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="wish_transfer_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="wish_transfer_no" name="trans_plan_wish_transfer" value="no" 
                                                                                   <?= isset($fpt['trans_plan_wish_transfer']) && $fpt['trans_plan_wish_transfer'] === 'no' ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="wish_transfer_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="important_to_transfer">Does the Important Value of the Current Pension Benefit?</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="important_transfer_yes" name="trans_plan_important_to_transfer" value="yes" 
                                                                                   <?= isset($fpt['trans_plan_important_to_transfer']) && $fpt['trans_plan_important_to_transfer'] === 'yes' ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="important_transfer_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="important_transfer_no" name="trans_plan_important_to_transfer" value="no" 
                                                                                   <?= isset($fpt['trans_plan_important_to_transfer']) && $fpt['trans_plan_important_to_transfer'] === 'no' ? 'checked' : '' ?>>
                                                                            <label class="form-check-label" for="important_transfer_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="existing_scheme">Is This Arrangement in Crystallisation?</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="existing_scheme_yes" name="trans_plan_existing_scheme" value="yes" 
                                                                                @if($fpt->trans_plan_existing_scheme == 'yes') checked @endif>
                                                                            <label class="form-check-label" for="existing_scheme_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="existing_scheme_no" name="trans_plan_existing_scheme" value="no" 
                                                                                @if($fpt->trans_plan_existing_scheme == 'no') checked @endif>
                                                                            <label class="form-check-label" for="existing_scheme_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="block_transfer">Is the Transfer Part of a Block Transfer?</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="block_transfer_yes" name="trans_plan_block_transfer" value="yes" 
                                                                                @if($fpt->trans_plan_block_transfer == 'yes') checked @endif>
                                                                            <label class="form-check-label" for="block_transfer_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="block_transfer_no" name="trans_plan_block_transfer" value="no" 
                                                                                @if($fpt->trans_plan_block_transfer == 'no') checked @endif>
                                                                            <label class="form-check-label" for="block_transfer_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- ========================= Transfer To Be Made into plan end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Step : Transfer Authority   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Transfer Authority </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Transfer Authority start ======================= !-->


                                                                <h4>12. TRANSFERS AUTHORITY</h4>
                                                                <p>I Authorise, Instruct, And Apply To You To Transfer Sums And Assets From The Plan/Scheme As Listed Directly To Alltrust Services Limited...</p>
                                                                <p>I Accept Responsibility In Respect Of Any Claims, Losses, Expenses, Additional Tax Charges, Or Any Penalties That Alltrust Services Limited...</p>


                                                               <div class="row">
                                                                    <div class="form-group col-md-6 ">
                                                                        <label for="signature">Signature</label>
                                                                        <input type="text" class="form-control" id="signature" name="transf_auth_signature" 
                                                                               placeholder="Enter Signature" 
                                                                               value="{{ old('transf_auth_signature', $fpt->transf_auth_signature ?? '') }}">
                                                                    </div>
                                                                
                                                                    <div class="form-group col-md-6">
                                                                        <label for="print_name">Print Name</label>
                                                                        <input type="text" class="form-control" id="print_name" name="transf_auth_print_name" 
                                                                               placeholder="Enter Print Name" 
                                                                               value="{{ old('transf_auth_print_name', $fpt->transf_auth_print_name ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group ">
                                                                    <label for="plan_scheme_no">Plan/Scheme No</label>
                                                                    <input type="text" class="form-control" id="plan_scheme_no" name="transf_auth_plan_scheme_no" 
                                                                           placeholder="Enter Plan/Scheme Number" 
                                                                           value="{{ old('transf_auth_plan_scheme_no', $fpt->transf_auth_plan_scheme_no ?? '') }}">
                                                                </div>
                                                                
                                                                <div class="form-group ">
                                                                    <label for="date">Date</label>
                                                                    <div class="form-row">
                                                                        <div class="col">
                                                                            <input type="number" class="form-control" name="transf_auth_day" 
                                                                                   placeholder="Day" 
                                                                                   value="{{ old('transf_auth_day', $fpt->transf_auth_day ?? '') }}">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="number" class="form-control" name="transf_auth_month" 
                                                                                   placeholder="Month" 
                                                                                   value="{{ old('transf_auth_month', $fpt->transf_auth_month ?? '') }}">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="number" class="form-control" name="transf_auth_year" 
                                                                                   placeholder="Year" 
                                                                                   value="{{ old('transf_auth_year', $fpt->transf_auth_year ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <!-- ========================= Transfer Authority end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Member Consent   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Member Consent </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Member Consent start ======================= !-->

                                                                <h4>13. Member Consent</h4>

                                                                <p>Alltrust Services Limited may want to contact you occasionally by post or email to let you know about other products and services available from us, or to forward your contact details to another firm associated with Alltrust. Please indicate your preferences by ticking the relevant boxes.</p>

                                                               <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label>I Consent To Alltrust Services Limited Contacting Me About Other Products And Services</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="contact_me_yes" name="member_consent_contact_me" value="yes"
                                                                                   {{ (old('member_consent_contact_me', $fpt->member_consent_contact_me ?? '') == 'yes') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="contact_me_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="contact_me_no" name="member_consent_contact_me" value="no"
                                                                                   {{ (old('member_consent_contact_me', $fpt->member_consent_contact_me ?? '') == 'no') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="contact_me_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label>I Consent To Alltrust Passing My Contact Details To Other Subsidiaries</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="pass_contact_yes" name="member_consent_pass_contact" value="yes"
                                                                                   {{ (old('member_consent_pass_contact', $fpt->member_consent_pass_contact ?? '') == 'yes') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="pass_contact_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="pass_contact_no" name="member_consent_pass_contact" value="no"
                                                                                   {{ (old('member_consent_pass_contact', $fpt->member_consent_pass_contact ?? '') == 'no') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="pass_contact_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <p>If you have answered 'Yes' to any of the above, please confirm how you would prefer to be contacted.</p>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="prefer_email">I Would Prefer To Be Contacted By Email</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="prefer_email_yes" name="member_consent_prefer_email" value="yes"
                                                                                   {{ (old('member_consent_prefer_email', $fpt->member_consent_prefer_email ?? '') == 'yes') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="prefer_email_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="prefer_email_no" name="member_consent_prefer_email" value="no"
                                                                                   {{ (old('member_consent_prefer_email', $fpt->member_consent_prefer_email ?? '') == 'no') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="prefer_email_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="prefer_post">I Would Prefer To Be Contacted By Post</label>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="prefer_post_yes" name="member_consent_prefer_post" value="yes"
                                                                                   {{ (old('member_consent_prefer_post', $fpt->member_consent_prefer_post ?? '') == 'yes') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="prefer_post_yes">Yes</label>
                                                                            <br>
                                                                            <input class="form-check-input" type="radio" id="prefer_post_no" name="member_consent_prefer_post" value="no"
                                                                                   {{ (old('member_consent_prefer_post', $fpt->member_consent_prefer_post ?? '') == 'no') ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="prefer_post_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="signature">Signature</label>
                                                                        <input type="text" class="form-control" id="signature" name="member_consent_signature" 
                                                                               placeholder="Enter Signature" 
                                                                               value="{{ old('member_consent_signature', $fpt->member_consent_signature ?? '') }}">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="print_name">Print Name</label>
                                                                        <input type="text" class="form-control" id="print_name" name="member_consent_print_name" 
                                                                               placeholder="Enter Print Name" 
                                                                               value="{{ old('member_consent_print_name', $fpt->member_consent_print_name ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="date_day">Date</label>
                                                                        <input type="number" class="form-control" id="date_day" name="member_consent_date_day" 
                                                                               placeholder="Day" 
                                                                               value="{{ old('member_consent_date_day', $fpt->member_consent_date_day ?? '') }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="date_month">Month</label>
                                                                        <input type="number" class="form-control" id="date_month" name="member_consent_date_month" 
                                                                               placeholder="Month" 
                                                                               value="{{ old('member_consent_date_month', $fpt->member_consent_date_month ?? '') }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="date_year">Year</label>
                                                                        <input type="number" class="form-control" id="date_year" name="member_consent_date_year" 
                                                                               placeholder="Year" 
                                                                               value="{{ old('member_consent_date_year', $fpt->member_consent_date_year ?? '') }}">
                                                                    </div>
                                                                </div>


                                                                <!-- ========================= Member Consent end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Member Declaration   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Member Declaration</h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- ========================= Transfer Authority start ======================= !-->
                                                                <h4>15. Member Declaration</h4>
                                                                <p><strong>This is our standard Member Questionnaire upon which we intend to rely. For your own benefit and protection, you should read this declaration carefully before signing. If you do not understand any point, please ask for further information or seek advice from a suitably qualified professional.</strong></p>
                                                                <p><strong>Please tick if applicable:</strong></p>
                                                                <div class="form-group">
                                                                    <label for="waive_cancellation_rights"><strong>I Am Aware Of My Cancellation Rights As Detailed In The Family Pension Trust Key Features Document And Agree To Waive My Cancellation Rights To Become A Member Of The Family Pension Trust:</label></strong>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="waive_yes" name="member_declra_waive_cancellation_rights" value="yes" {{ isset($fpt['member_declra_waive_cancellation_rights']) && $fpt['member_declra_waive_cancellation_rights'] === 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="waive_yes">Yes</label>
                                                                        <br
                                                                        <input class="form-check-input" type="radio" id="waive_no" name="member_declra_waive_cancellation_rights" value="no" {{ isset($fpt['member_declra_waive_cancellation_rights']) && $fpt['member_declra_waive_cancellation_rights'] === 'no' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="waive_no">No</label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="parental_responsibility"><strong> Have Parental Responsibility For The Child Named On This Application Form:</strong></label>
                                                                   <div class="form-check">
                                                                        <input class="form-check-input" type="radio" id="responsibility_yes" name="member_declra_parental_responsibility" value="yes" {{ isset($fpt['member_declra_parental_responsibility']) && $fpt['member_declra_parental_responsibility'] === 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="responsibility_yes">Yes</label>
                                                                        <input class="form-check-input" type="radio" id="responsibility_no" name="member_declra_parental_responsibility" value="no" {{ isset($fpt['member_declra_parental_responsibility']) && $fpt['member_declra_parental_responsibility'] === 'no' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="responsibility_no">No</label>
                                                                    </div>
                                                                </div>

                                                                <p>I confirm that by completing this application, I agree to become a member of the Family Pension Trust and agree to be bound by the Trust Deed and Rules.</p>
                                                                <p>I have read and agree to the charges as outlined in the Family Pension Trust Fee Schedule and I am aware that fees will be deducted from my fund.</p>
                                                                <p>I understand that Alltrust SIPP Limited is the independent trustee and Alltrust Services Limited will be the scheme Administrator.</p>
                                                                <p>I confirm the information provided in this application is true and correct to the best of my knowledge. I undertake to inform Alltrust Services Limited of any event that would result in my no longer being entitled to tax relief on my contributions under section 188 of the Finance Act 2004. I will inform Alltrust Services Limited by the later of:</p>
                                                                <ul>
                                                                    <li>5 April in the year of assessment in which the event occurred, and</li>
                                                                    <li>the date 30 days after the occurrence of that event.</li>

                                                                </ul>
                                                                <p>I will also inform Alltrust Services Limited within 30 days if I change my name or permanent residential address or I start to receive pension benefits from any other scheme.</p>
                                                                <p>My employer may be paying contributions to this scheme and I give Alltrust Services Limited authority to correspond directly with them. I agree that my total contributions to any registered pension scheme in respect of which I am entitled to receive tax relief, under section 188 of the Finance Act 2004, will not exceed the higher of the basic amount, currently £3,600 as at the date of this application, or my relevant UK earnings, within the meaning of Section 189 of the Finance Act 2004, in that year, subject to HMRC limits.</p>
                                                                <p>I authorise any insurer or other pension provider and HMRC to disclose to Alltrust Services Limited any details they request about the benefits provided for me.</p>
                                                                <p>I agree to Alltrust Services Limited opening a member bank account with Alltrust SIPP Limited’s designated bank, to which all payments into my arrangement will be made. I understand Alltrust SIPP Limited will be sole signatory to the account. I understand that once a tax relievable contribution has been made to a scheme, it cannot be returned.</p>
                                                                <p>I hereby give authority for Alltrust Services Limited to accept investment and disinvestment instructions from my appointed financial adviser and fully understand and agree:</p>

                                                                <ul>
                                                                    <li>that I am solely responsible for all decisions relating to the purchase, retention, and sale of the investments forming my personal arrangement under the scheme;</li>
                                                                    <li>decisions and correspondence relating to any common investment funds will be communicated via the scheme chairperson;</li>
                                                                    <li>not to hold Alltrust Services Limited, Alltrust SIPP Limited, or the designated bank liable for any claim in respect of the decisions made by myself or any appointed adviser;</li>
                                                                    <li>that I will be responsible for any losses and/or expenses which are the result of any untrue, misleading, or inaccurate information given by me or on my behalf either in this form or with respect to the benefits under the scheme;</li>
                                                                    <li>that Alltrust Services Limited and Alltrust SIPP Limited have not carried out and shall not carry out any review of the nominated investment manager’s financial status or their investment and/or risk strategies.</li>

                                                                </ul>

                                                                <p>I understand that to comply with Money Laundering Regulations, Alltrust Services Limited may verify my identity through the use of an electronic identity verification system. Where a check is carried out, the system will also check whether I have a credit history, but it will not disclose any details. The system will add a note to my credit file to show that an identity check was made, but this information will not be available to third parties for credit assessment purposes. If the check does not confirm my identity, Alltrust Services Limited will need to carry out a manual check and may need to contact me for further information. Acceptance of my application is subject to satisfactory completion of identity verification checks.</p>

                                                                <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label>Please Tick If Applicable:</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="waive_rights" name="member_declra_waive_rights" {{ isset($fpt['member_declra_waive_rights']) && $fpt['member_declra_waive_rights'] ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="waive_rights">I am aware of my cancellation rights...</label>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                              <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="responsibility_declaration">Parental Responsibility Declaration:</label>
                                                                    <textarea class="form-control" id="responsibility_declaration" name="member_declra_responsibility_declaration" rows="3">{{ isset($fpt['member_declra_responsibility_declaration']) ? $fpt['member_declra_responsibility_declaration'] : 'I have parental responsibility...' }}</textarea>
                                                                </div>
                                                            </div>


                                                              <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                            <label for="confirm_information">Information Confirmation:</label>
                                                                            <textarea class="form-control" id="confirm_information" name="member_declra_confirm_information" rows="4">{{ isset($fpt['member_declra_confirm_information']) ? $fpt['member_declra_confirm_information'] : 'I confirm the information provided is true...' }}</textarea>
                                                                        </div>
                                                                    </div>


                                                               <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                            <label for="notify_information">Notify Information Change:</label>
                                                                            <textarea class="form-control" id="notify_information" name="member_declra_notify_information" rows="4">{{ isset($fpt['member_declra_notify_information']) ? $fpt['member_declra_notify_information'] : 'I will notify Alltrust of any information changes...' }}</textarea>
                                                                        </div>
                                                                    </div>


                                                              <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="consent_declaration">Consent Declaration:</label>
                                                                            <textarea class="form-control" id="consent_declaration" name="member_declra_consent_declaration" rows="4">{{ isset($fpt['member_declra_consent_declaration']) ? $fpt['member_declra_consent_declaration'] : 'I consent to Alltrust contacting me...' }}</textarea>
                                                                        </div>
                                                                    </div>


                                                             <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="signature">Signature</label>
                                                                    <input type="text" class="form-control" id="signature" name="member_declra_signature" placeholder="Enter Signature" value="{{ isset($fpt['member_declra_signature']) ? $fpt['member_declra_signature'] : '' }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="print_name">Print Name</label>
                                                                    <input type="text" class="form-control" id="print_name" name="member_declra_print_name" placeholder="Enter Print Name" value="{{ isset($fpt['member_declra_print_name']) ? $fpt['member_declra_print_name'] : '' }}">
                                                                </div>
                                                            </div>


                                                              <div class="row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="date_day">Date</label>
                                                                    <input type="number" class="form-control" id="date_day" name="member_declra_date_day" placeholder="Day" value="{{ isset($fpt['member_declra_date_day']) ? $fpt['member_declra_date_day'] : '' }}">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="date_month">Month</label>
                                                                    <input type="number" class="form-control" id="date_month" name="member_declra_date_month" placeholder="Month" value="{{ isset($fpt['member_declra_date_month']) ? $fpt['member_declra_date_month'] : '' }}">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="date_year">Year</label>
                                                                    <input type="number" class="form-control" id="date_year" name="member_declra_date_year" placeholder="Year" value="{{ isset($fpt['member_declra_date_year']) ? $fpt['member_declra_date_year'] : '' }}">
                                                                </div>
                                                            </div>


                                                                <!-- ========================= Transfer Authority end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button type="button" class="btn-next-wizard btn-primary">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                                                        <i class="arrow-right-icon ti-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step : Notes   -->
                                                        <div id="adviserStep" class="wizard-step" style="display: none;">
                                                            <div class="content-header mb-6">
                                                                <h4 class="mb-0">Note </h4>
                                                            </div>
                                                            <div class="row g-6">
                                                                <!-- =========================Notes start ======================= !-->
                                                               <div class="form-group">
                                                                        <label for="notes">Enter Your Notes Here</label>
                                                                        <textarea class="form-control" id="notes" name="notes" rows="5" placeholder="Enter Your Notes Here...">{{ isset($fpt['notes']) ? $fpt['notes'] : '' }}</textarea>
                                                                    </div>

                                                                <!-- ========================= Notes end ======================= !-->

                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button" class="btn-prev-wizard btn-secondary">
                                                                        <i class="arrow-left-icon ti-xs me-sm-2 me-0"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    {{--                                                                            <button type="button" class="btn-next-wizard btn-primary">--}}
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
                                        <button type="button" class="btn btn-label-secondary btn-prev">
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


 <!-- ==========================================================================                ===================================== -->
 
 <div id="non_standard_assets" class="content" style="display: none;">
                            <div class="content-header mb-6">
                                <h4 class="mb-0">User </h4>
                            </div>
                            <div class="row g-6">
                                <!-- =========================== User start =========================== !-->
                                <div class=" row registration-container registration-overlay bg-pattern">
                                    
                               
        <div class="col-md-6">
            <label for="user_name">Name</label>
            <input type="text" class="form-control" 
                   value="{{ old('user_name', $user->name ?? '') }}" 
                   name="user_name" 
                   placeholder="Enter Name">
        </div>

        <div class="col-md-6">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" 
                   value="{{ old('user_email', $user->email ?? '') }}" 
                   name="user_email" 
                   placeholder="Enter Email">
        </div>

        <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">
   
                                 
                                 
                                    <!-- =========================== User end =========================== !-->

                                    <div class="col-12 d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-label-secondary btn-prev">
                                            <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button type="submit" id="submitForm" class="btn btn-success  btn-submit">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Update</span>
                                            <i class="ti ti-arrow-right ti-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
 
  <!-- ==========================================================================                ===================================== -->
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


  /*             document.addEventListener("DOMContentLoaded", function() {

            const fpt = {{--@json($fptShow)--}};

            let inputs = document.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                let name = input.getAttribute('name');
console.log(fpt['country']);
                if(fpt[name] !== undefined && fpt[name] !== null) {
                input.value = fpt[name];
                }
            });
        });*/




        document.addEventListener('DOMContentLoaded', function () {
            const nextBtns = document.querySelectorAll('.btn-next');
            const prevBtns = document.querySelectorAll('.btn-prev');
            const contents = document.querySelectorAll('.content');
            let currentStep = 0;

            nextBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    if (currentStep < contents.length - 1) {
                        contents[currentStep].style.display = 'none'; // Hide current step
                        currentStep++; // Go to next step
                        contents[currentStep].style.display = 'block'; // Show next step
                    }
                    toggleButtonState();
                });
            });

            prevBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    if (currentStep > 0) {
                        contents[currentStep].style.display = 'none'; // Hide current step
                        currentStep--; // Go to previous step
                        contents[currentStep].style.display = 'block'; // Show previous step
                    }
                    toggleButtonState();
                });
            });

            function toggleButtonState() {
                prevBtns.forEach((btn) => {
                    btn.disabled = currentStep === 0;
                });
            }

            // Add Adviser Functionality
            const addAdviserBtn = document.querySelector('.btn-add-adviser');
            const adviserFormsContainer = document.getElementById('adviserFormsContainer');

            addAdviserBtn.addEventListener('click', () => {
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
    // Handle form submission only when the specific button is clicked
    document.getElementById('submitForm').addEventListener('click', function() {
        document.getElementById('multiStepsForm').submit();
    });

</script>

@endsection
