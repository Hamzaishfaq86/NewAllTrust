@extends('dashboard.dashboard')

@section('content')
<div class="position-relative">
    @if(session('success'))
        <div class="alert alert-success position-absolute w-75 z-5 right-0 alert-dismissible fade show" style="top: 20px;" role="alert" id="successAlert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger position-absolute w-75 z-5 right-0 alert-dismissible fade show" style="top: 20px;" role="alert" id="errorAlert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <script>
        setTimeout(() => {
            const alertElement = document.getElementById('successAlert') || document.getElementById('errorAlert');
            if (alertElement) {
                alertElement.classList.remove('show');
                setTimeout(() => alertElement.remove(), 200);
            }
        }, 6000);
    </script>
</div>

<div class="container mt-5">
        <ul class="nav nav-tabs" id="crmTabs" role="tablist"  style="flex-wrap: wrap !important;">
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab">Personal Information</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="beneficiaries-tab" data-bs-toggle="tab" data-bs-target="#beneficiaries" type="button" role="tab">Beneficiaries</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="adviser-fees-tab" data-bs-toggle="tab" data-bs-target="#adviser-fees" type="button" role="tab">Adviser Fees</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="transfers-tab" data-bs-toggle="tab" data-bs-target="#transfers" type="button" role="tab">Transfers</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="contributions-tab" data-bs-toggle="tab" data-bs-target="#contributions" type="button" role="tab">Contributions</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="bank-accounts-tab" data-bs-toggle="tab" data-bs-target="#bank-accounts" type="button" role="tab">Bank Accounts</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="assets-tab" data-bs-toggle="tab" data-bs-target="#assets" type="button" role="tab">Assets</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="benefit-events-tab" data-bs-toggle="tab" data-bs-target="#benefit-events" type="button" role="tab">Benefit Events</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="crystallisations-tab" data-bs-toggle="tab" data-bs-target="#crystallisations" type="button" role="tab">Crystallisations</button>
            </li>
            <li class="nav-item" role="presentation" style="margin-bottom: 20px;">
                <button class="nav-link" id="pension-payments-tab" data-bs-toggle="tab" data-bs-target="#pension-payments" type="button" role="tab">Pension Payments</button>
            </li>
        </ul>

        <div class="tab-content" id="crmTabsContent">
            <div class="tab-pane fade show active" id="personal-info" role="tabpanel">
                <form id="multiStepsForm">
                   
                    @csrf
                    <div class="mb-3">
                        <label for="memberName" class="form-label">Member Name</label>
                        <input type="text" class="form-control" id="memberName" name="member_name" placeholder="Full member name" value="{{ $member->surname }}">
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="{{ $member->dob }}">
                    </div>
                    <div class="mb-3">
                        <label for="nationalInsurance" class="form-label">National Insurance Number</label>
                        <input type="text" class="form-control" id="nationalInsurance" name="national_insurance_number" placeholder="National Insurance Number" value="{{ $member->national_insurance_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="taxInformation" class="form-label">Tax Information Number</label>
                        <input type="text" class="form-control" id="taxInformation" name="tax_information_number" placeholder="Tax ID Number" value="{{ $member->tax_information_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Member address" value="{{ $member->address }}" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Member email address" value="{{ $member->email }}">
                    </div>
            </div>
            <div class="tab-pane fade" id="beneficiaries" role="tabpanel">
    <?php 
    $beneficiaries = json_decode($member->beneficiary_name, true); 
    $relationships = json_decode($member->relationship, true);
    $percentages = json_decode($member->percentage, true);

    if (!empty($beneficiaries)) {
        foreach ($beneficiaries as $index => $name) {
    ?>
            <div style="margin-bottom: 50px;">
                <div class="mb-3">
                    <label for="beneficiaryName<?php echo $index; ?>" class="form-label">Beneficiary Name</label>
                    <input type="text" class="form-control" id="beneficiaryName<?php echo $index; ?>" name="beneficiary_name[]" placeholder="List of beneficiaries" value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="mb-3">
                    <label for="beneficiaryRelationship<?php echo $index; ?>" class="form-label">Beneficiary Relationship</label>
                    <input type="text" class="form-control" id="beneficiaryRelationship<?php echo $index; ?>" name="beneficiary_relationship[]" placeholder="Relationship to member" value="<?php echo htmlspecialchars($relationships[$index] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="beneficiaryPercentage<?php echo $index; ?>" class="form-label">Beneficiary Percentage</label>
                    <input type="number" class="form-control" id="beneficiaryPercentage<?php echo $index; ?>" name="beneficiary_percentage[]" placeholder="Percentage allocation" value="<?php echo htmlspecialchars($percentages[$index] ?? ''); ?>">
                </div>
            </div>
    <?php 
        } 
    } else {
        echo "<p>No beneficiaries found.</p>";
    }
    ?>
</div>


            <div class="tab-pane fade" id="adviser-fees" role="tabpanel">
                    <div class="mb-3">
                        <label for="adviserFeeAgreement" class="form-label">Adviser Fee Agreement</label>
                        <select class="form-select" id="adviserFeeAgreement" name="adviser_fee_agreement">
                            <option value="yes" {{ $member->adviser_fee_agreement == 'yes' ? 'checked' : '' }}>>Yes</option>
                            <option value="no" {{ $member->adviser_fee_agreement == 'no' ? 'checked' : '' }}>>No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="adviserFeeDetails" class="form-label">Adviser Fee Details</label>
                        <textarea class="form-control" id="adviserFeeDetails" name="adviser_fee_details" rows="3" placeholder="Adviser Fee Agreement Details" value="{{ $member->adviser_fee_details }}"></textarea>
                    </div>
            </div>
            <div class="tab-pane fade" id="transfers" role="tabpanel">
                    <div class="mb-3">
                        <label for="transferRequestDate" class="form-label">Transfer Request Received Date</label>
                        <input type="date" class="form-control" id="transferRequestDate" name="transfer_request_received_date" value="{{ $member->transfer_request_received_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="cedingSchemeName" class="form-label">Ceding Scheme Name</label>
                        <input type="text" class="form-control" id="cedingSchemeName" name="ceding_scheme_name" placeholder="Name of ceding scheme" value="{{ $member->ceding_scheme_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="cedingSchemeReference" class="form-label">Ceding Scheme Reference</label>
                        <input type="text" class="form-control" id="cedingSchemeReference" name="ceding_scheme_reference" placeholder="Reference for the scheme" value="{{ $member->ceding_scheme_reference }}">
                    </div>
                    <div class="mb-3">
                        <label for="transferStatus" class="form-label">Transfer Status</label>
                        <select class="form-select" id="transferStatus" name="transfer_status">
                            <option value="Expected" {{ $member->transfer_status == 'Expected' ? 'checked' : '' }}>Expected</option>
                            <option value="Completed" {{ $member->transfer_status == 'Completed' ? 'checked' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="transferAmount" class="form-label">Transfer Amount</label>
                        <input type="number" class="form-control" id="transferAmount" name="transfer_amount" placeholder="Amount transferred" value="{{ $member->transfer_amount }}">
                    </div>
                    <div class="mb-3">
                        <label for="transferCompletionDate" class="form-label">Transfer Completion Date</label>
                        <input type="date" class="form-control" id="transferCompletionDate" name="transfer_completion_date" value="{{ $member->transfer_completion_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="crystallisationStatus" class="form-label">Crystallisation Status</label>
                        <input type="text" class="form-control" id="crystallisationStatus" name="crystallisation_status" value="{{ $member->crystallisation_status }}">
                    </div>
            </div>

            <div class="tab-pane fade" id="contributions" role="tabpanel">
                    <div class="mb-3">
                        <label for="contributing_employer" class="form-label">Contributing Employer</label>
                        <select class="form-select" id="contributing_employer" name="contributing_employer" >
                            <option value="1" {{ $member->contributing_employer == '1' ? 'checked' : '' }}>Yes</option>
                            <option value="0" {{ $member->contributing_employer == '0' ? 'checked' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="employer_name" class="form-label">Employer Name</label>
                        <input type="text" class="form-control" id="employer_name" name="employer_name" placeholder="Enter employer name" >
                    </div>
                    <div class="mb-3">
                        <label for="mpaa_triggered" class="form-label">MPAA Triggered</label>
                        <select class="form-select" id="mpaa_triggered" name="mpaa_triggered" >
                            <option value="1" {{ $member->mpaa_triggered == '1' ? 'checked' : '' }}>Yes</option>
                            <option value="0" {{ $member->mpaa_triggered == '0' ? 'checked' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mpaa_trigger_date" class="form-label">MPAA Trigger Date</label>
                        <input type="date" class="form-control" id="mpaa_trigger_date" name="mpaa_trigger_date" value="{{ $member->mpaa_trigger_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="contributions_received" class="form-label">Contributions Received</label>
                        <textarea class="form-control" id="contributions_received" name="contributions_received" rows="4" value="{{ $member->contributions_received }}" placeholder='Enter contributions in JSON format, e.g., [{"amount": 1000, "date": "2023-01-01"}]'></textarea>
                    </div>
            </div>
            <div class="tab-pane fade" id="bank-accounts" role="tabpanel">
                    <div class="mb-3">
                        <label for="bank_provider" class="form-label">Bank Provider</label>
                        <input type="text" class="form-control" id="bank_provider" name="bank_provider" placeholder="Enter bank provider" value="{{ $member->bank_provider }}">
                    </div>
                    <div class="mb-3">
                        <label for="account_name" class="form-label">Account Name</label>
                        <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Enter account name" value="{{ $member->account_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="sort_code" class="form-label">Sort Code</label>
                        <input type="text" class="form-control" id="sort_code" name="sort_code" placeholder="Enter sort code"  title="Sort code must be 6 digits" value="{{ $member->sort_code }}">
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter account number"  title="Account number must be 8 digits" value="{{ $member->account_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="account_opened_date" class="form-label">Account Opened Date</label>
                        <input type="date" class="form-control" id="account_opened_date" name="account_opened_date" value="{{ $member->account_opened_date }}">
                    </div>
            </div>

            <div class="tab-pane fade" id="assets" role="tabpanel">
                    <div class="mb-3">
                        <label for="holding_type" class="form-label">Holding Type</label>
                        <input type="text" class="form-control" id="holding_type" name="holding_type" placeholder="Enter holding type (e.g., Property, Platform, Cash)" value="{{ $member->holding_type }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter asset description" value="{{ $member->description }}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="provider" class="form-label">Provider</label>
                        <input type="text" class="form-control" id="provider" name="provider" placeholder="Enter provider name" value="{{ $member->provider }}">
                    </div>
                    <div class="mb-3">
                        <label for="purchase_date" class="form-label">Purchase Date</label>
                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="{{ $member->purchase_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="latest_value" class="form-label">Latest Value</label>
                        <input type="number" class="form-control" id="latest_value" name="latest_value" placeholder="Enter latest value (e.g., 1000.00)" min="0" value="{{ $member->latest_value }}">
                    </div>
                    <div class="mb-3">
                        <label for="latest_value_date" class="form-label">Latest Value Date</label>
                        <input type="date" class="form-control" id="latest_value_date" name="latest_value_date" value="{{ $member->latest_value_date }}">
                    </div>
            </div>

            <div class="tab-pane fade" id="benefit-events" role="tabpanel">
                    <div class="mb-3">
                        <label for="protection_held" class="form-label">Protection Held</label>
                        <input type="text" class="form-control" id="protection_held" name="protection_held" placeholder="Enter protection type or 'N/A'" value="{{ $member->protection_held }}">
                    </div>
                    <div class="mb-3">
                        <label for="protection_details" class="form-label">Protection Details</label>
                        <textarea class="form-control" id="protection_details" name="protection_details" rows="3" placeholder="Enter details about protection" value="{{ $member->protection_details }}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lta_pre_06_04_24" class="form-label">Lifetime Allowance (Pre 06/04/24)</label>
                        <input type="number" class="form-control" id="lta_pre_06_04_24" name="lta_pre_06_04_24" placeholder="Enter Lifetime Allowance before 06/04/24 (e.g., 50000.00)" min="0" value="{{ $member->lta_pre_06_04_24 }}">
                    </div>
                    <div class="mb-3">
                        <label for="converted_lump_sum_allowance" class="form-label">Converted Lump Sum Allowance</label>
                        <input type="number" class="form-control" id="converted_lump_sum_allowance" name="converted_lump_sum_allowance" placeholder="Enter converted lump sum allowance (e.g., 20000.00)" min="0" value="{{ $member->converted_lump_sum_allowance }}">
                    </div>
                    <div class="mb-3">
                        <label for="total_lsa_consumed" class="form-label">Total LSA Consumed</label>
                        <input type="number" class="form-control" id="total_lsa_consumed" name="total_lsa_consumed" placeholder="Enter total lump sum allowance consumed (e.g., 10000.00)" min="0" value="{{ $member->total_lsa_consumed }}">
                    </div>
            </div>

            <div class="tab-pane fade" id="crystallisations" role="tabpanel">
                    <div class="mb-3">
                        <label for="crystallisation_date" class="form-label">Crystallisation Date</label>
                        <input type="date" class="form-control" id="crystallisation_date" name="crystallisation_date" value="{{ $member->crystallisation_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="crystallisation_type" class="form-label">Crystallisation Type</label>
                        <input type="text" class="form-control" id="crystallisation_type" name="crystallisation_type" placeholder="Enter crystallisation type (e.g., Lump Sum, Drawdown)" maxlength="255" value="{{ $member->crystallisation_type }}">
                    </div>
                    <div class="mb-3">
                        <label for="amount_crystallised" class="form-label">Amount Crystallised</label>
                        <input type="number" class="form-control" id="amount_crystallised" name="amount_crystallised" placeholder="Enter amount crystallised (e.g., 50000.00)" min="0" value="{{ $member->amount_crystallised }}">
                    </div>
                    <div class="mb-3">
                        <label for="tax_free_lump_sum" class="form-label">Tax-Free Lump Sum</label>
                        <input type="number" class="form-control" id="tax_free_lump_sum" name="tax_free_lump_sum" placeholder="Enter tax-free lump sum (e.g., 12500.00)" min="0" value="{{ $member->tax_free_lump_sum }}">
                    </div>
                    <div class="mb-3">
                        <label for="sla_consumed_pre_06_04_24" class="form-label">SLA Consumed (Pre 06/04/24)</label>
                        <input type="number" class="form-control" id="sla_consumed_pre_06_04_24" name="sla_consumed_pre_06_04_24" placeholder="Enter SLA % consumed before 06/04/24 (e.g., 25.00)" min="0" max="100" value="{{ $member->sla_consumed_pre_06_04_24 }}">
                    </div>         
            </div>

            <div class="tab-pane fade" id="pension-payments" role="tabpanel">
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Payment Date</label>
                        <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ $member->payment_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="net_payment" class="form-label">Net Payment</label>
                        <input type="number" class="form-control" id="net_payment" name="net_payment" placeholder="Enter net payment amount (e.g., 1200.50)" min="0" value="{{ $member->net_payment }}">
                    </div>
                    <div class="mb-3">
                        <label for="paye" class="form-label">PAYE Amount</label>
                        <input type="number" class="form-control" id="paye" name="paye" placeholder="Enter PAYE amount (e.g., 300.00)" min="0" value="{{ $member->paye }}">
                    </div>
                    <div class="mb-3">
                        <label for="net_in_tax_year" class="form-label">Net in Tax Year</label>
                        <input type="number" class="form-control" id="net_in_tax_year" name="net_in_tax_year" placeholder="Enter net payment in the tax year (e.g., 10000.00)" min="0" value="{{ $member->net_in_tax_year }}">
                    </div>
                    <div class="mb-3">
                        <label for="paye_in_tax_year" class="form-label">PAYE in Tax Year</label>
                        <input type="number" class="form-control" id="paye_in_tax_year" name="paye_in_tax_year" placeholder="Enter PAYE amount in the tax year (e.g., 2500.00)" min="0" value="{{ $member->paye_in_tax_year }}">
                    </div>
                    <div class="mb-3">
                        <label for="tax_code" class="form-label">Tax Code</label>
                        <input type="text" class="form-control" id="tax_code" name="tax_code" placeholder="Enter tax code applied (e.g., 1250L)" maxlength="10" value="{{ $member->tax_code }}">
                    </div>
                </form>          
            </div>
        </div>
    </div>

@endsection
