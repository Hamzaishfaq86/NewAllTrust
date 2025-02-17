@extends('dashboard.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/css/lightgallery.min.css" rel="stylesheet">
<style>
    .lg-backdrop {
    z-index: 1000000;
}
.lg-outer {

    z-index: 010000000000000;
 }
</style>
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
            // Function to remove alert after 6 seconds
            setTimeout(() => {
                const alertElement = document.getElementById('successAlert') || document.getElementById('errorAlert');
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
            <div class="card-header flex-column flex-md-row">
                <!--<div class="dt-action-buttons text-end pt-6 pt-md-0">-->
                <!--    <div class="dt-buttons btn-group">-->
                <!--        <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#usercreate" type="button">-->
                <!--            <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">View Adviser</span></span>-->
                <!--        </button>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <!-- Multi Steps Registration -->
            <div class="d-flex col-12 align-items-center justify-content-center authentication-bg p-5">
                <div class="col-10">
                    <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
                        <div class="bs-stepper-content px-0">
                            <form id="multiStepsForm" method="POST">
                                @csrf
                                <!-- Adviser Details -->
                                <div id="adviserDetails" class="content" style="display: block;">
                                    
                                     <h3>Introducer Details</h3>
        <!-- Company Name -->
      <div class="mb-3">
        <label for="company-name" class="form-label">Company Name</label>
        <input type="text" id="company-name" name="company_name" readonly value="{{ $display->company_name }}" class="form-control">
      </div>

      <!-- Trading As -->
      <div class="mb-3">
        <label for="trading-as" class="form-label">Trading As</label>
        <input type="text" id="trading-as" name="trading_as" readonly value="{{ $display->trading_as }}" class="form-control">
      </div>

      <!-- Type -->
      <div class="mb-3">
        <label class="form-label">Type</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" id="company" name="type" readonly value="Company" {{ $display->type == 'Company' ? 'checked' : '' }}>
          <label for="company" class="form-check-label">Company</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" id="partnership" name="type" readonly value="Partnership" {{ $display->type == 'Partnership' ? 'checked' : '' }}>
          <label for="partnership" class="form-check-label">Partnership</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" id="other" name="type" readonly value="Other" {{ $display->type == 'Other' ? 'checked' : '' }}>
          <label for="other" class="form-check-label">Other</label>
        </div>
      </div>

      <!-- If Other -->
      <div class="mb-3">
        <label for="other-details" class="form-label">If Other, please specify</label>
        <input type="text" id="other-details" name="other_details" readonly value="{{ $display->other_details }}" class="form-control">
      </div>

      <!-- Main Contact -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="main-contact" class="form-label">Main Contact</label>
          <select id="main-contact" name="main_contact" class="form-select">
            <option readonly value="">Select</option>
            <option readonly value="Mr" {{ $display->main_contact == 'Mr' ? 'selected' : '' }}>Mr</option>
            <option readonly value="Mrs" {{ $display->main_contact == 'Mrs' ? 'selected' : '' }}>Mrs</option>
            <option readonly value="Miss" {{ $display->main_contact == 'Miss' ? 'selected' : '' }}>Miss</option>
            <option readonly value="Dr" {{ $display->main_contact == 'Dr' ? 'selected' : '' }}>Dr</option>
            <option readonly value="Other" {{ $display->main_contact == 'Other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="additional-details" class="form-label">If other, please provide details</label>
          <input type="text" id="additional-details" name="additional_details" readonly value="{{ $display->additional_details }}" class="form-control">
        </div>
      </div>

      <!-- Surname -->
      <div class="mb-3">
        <label for="surname" class="form-label">Surname</label>
        <input type="text" id="surname" name="surname" readonly value="{{ $display->surname }}" class="form-control">
      </div>

      <!-- Forenames -->
      <div class="mb-3">
        <label for="forenames" class="form-label">Forenames</label>
        <input type="text" id="forenames" name="forename" readonly value="{{ $display->forename }}" class="form-control">
      </div>
          
          <!-- Previous Names -->
<div class="mb-3">
  <label for="previous-names" class="form-label">Previous Name(s)</label>
  <input 
    type="text" 
    id="previous-names" 
    name="previous_names" 
    readonly value="{{ $display->previous_names }}" 
    class="form-control">
</div>

<!-- Registered Address -->
<div class="mb-3">
  <label for="registered-address" class="form-label">Registered Address</label>
  <textarea 
    id="registered-address" 
    name="registered_address" 
    rows="3" 
    class="form-control">{{ $display->registered_address }}</textarea>
</div>

<div class="form-section row">
  <div class="col-md-6 mb-3">
    <label for="registered_country" class="form-label">Registered Country</label>
    <input 
      type="text" 
      class="form-control" 
      id="registered_country" 
      name="registered_country" 
      readonly value="{{ $display->registered_country }}">
  </div>
  <div class="col-md-6">
    <label for="website" class="form-label">Registered Post Code</label>
    <input 
      type="text" 
      class="form-control" 
      id="website" 
      name="registered_post_code" 
      readonly value="{{ $display->registered_post_code }}">
  </div>
</div>

<!-- Physical Address -->
<div class="mb-3">
  <label for="physical-address" class="form-label">Physical Address (if different)</label>
  <textarea 
    id="physical-address" 
    name="physical_address" 
    rows="3" 
    class="form-control">{{ $display->physical_address }}</textarea>
</div>

<div class="form-section row">
  <div class="col-md-6 mb-3">
    <label for="physical_country" class="form-label">Physical Country</label>
    <input 
      type="text" 
      class="form-control" 
      id="physical_country" 
      name="physical_country" 
      readonly value="{{ $display->physical_country }}">
  </div>
  <div class="col-md-6">
    <label for="website" class="form-label">Physical Post Code</label>
    <input 
      type="text" 
      class="form-control" 
      id="website" 
      name="physical_post_code" 
      readonly value="{{ $display->physical_post_code }}">
  </div>
</div>

          
          <!-- Office and Direct Line -->
<div class="row">
  <div class="col-md-6 mb-3">
    <label for="office-number" class="form-label">Main Office Number</label>
    <input 
      type="text" 
      id="office-number" 
      name="office_number" 
      readonly value="{{ $display->office_number }}" 
      class="form-control">
  </div>
  <div class="col-md-6 mb-3">
    <label for="direct-line" class="form-label">Direct Line</label>
    <input 
      type="text" 
      id="direct-line" 
      name="direct_line" 
      readonly value="{{ $display->direct_line }}" 
      class="form-control">
  </div>
</div>

<!-- Mobile Number -->
<div class="mb-3">
  <label for="mobile-number" class="form-label">Mobile Number</label>
  <input 
    type="text" 
    id="mobile-number" 
    name="mobile_number" 
    readonly value="{{ $display->mobile_number }}" 
    class="form-control">
</div>

<div class="form-section row">
  <div class="col-md-6 mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input 
      type="email" 
      class="form-control" 
      id="email" 
      name="email_address" 
      readonly value="{{ $display->email_address }}">
  </div>
  <div class="col-md-6">
    <label for="website" class="form-label">Website</label>
    <input 
      type="text" 
      class="form-control" 
      id="website" 
      name="website" 
      readonly value="{{ $display->website }}">
  </div>
</div>

          
          <!-- Business Activity -->
          <div class="form-section">
            <label class="form-label">Business Activity (Tick all that are relevant)</label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-check">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="financial-adviser" 
                    readonly value="yes" 
                    name="financial_adviser" 
                    {{ $display->financial_adviser == 'yes' ? 'checked' : '' }}>
                  <label class="form-check-label" for="financial-adviser">Financial Adviser</label>
                </div>
                <div class="form-check">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="insurance-broker" 
                    readonly value="yes" 
                    name="insurance_broker" 
                    {{ $display->insurance_broker == 'yes' ? 'checked' : '' }}>
                  <label class="form-check-label" for="insurance-broker">Insurance Broker</label>
                </div>
                <div class="form-check">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="asset-manager" 
                    readonly value="yes" 
                    name="asset_manager" 
                    {{ $display->asset_manager == 'yes' ? 'checked' : '' }}>
                  <label class="form-check-label" for="asset-manager">Asset Manager</label>
                </div>
                <div class="form-check">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="accountant" 
                    readonly value="yes" 
                    name="accountant" 
                    {{ $display->accountant == 'yes' ? 'checked' : '' }}>
                  <label class="form-check-label" for="accountant">Accountant</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="tax-adviser" 
                    readonly value="yes" 
                    name="tax_adviser" 
                    {{ $display->tax_adviser == 'yes' ? 'checked' : '' }}>
                  <label class="form-check-label" for="tax-adviser">Tax Adviser</label>
                </div>
                <div class="form-check">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="lawyer" 
                    readonly value="yes" 
                    name="lawyer" 
                    {{ $display->lawyer == 'yes' ? 'checked' : '' }}>
                  <label class="form-check-label" for="lawyer">Lawyer</label>
                </div>
                <div class="form-check">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="other" 
                    readonly value="yes" 
                    name="other_business_activity" 
                    {{ $display->other_business_activity == 'yes' ? 'checked' : '' }}>
                  <label class="form-check-label" for="other">Other</label>
                </div>
                <input 
                  type="text" 
                  class="form-control mt-2" 
                  id="other-specify" 
                  name="other_business_specify" 
                  readonly value="{{ $display->other_business_specify }}">
              </div>
            </div>
          </div>
          
          
    
        <!-- Regulatory Details -->
<div class="form-section">
  <label for="reg-body" class="form-label">Regulatory/Licensing Body</label>
  <input 
      type="text" 
      class="form-control mb-3" 
      id="reg-body" 
      name="licensing_body" 
      readonly value="{{ $display->licensing_body }}">

  <label for="reg-number" class="form-label">Registration/Licensing Reference</label>
  <input 
      type="text" 
      class="form-control" 
      name="licensing_reference" 
      readonly value="{{ $display->licensing_reference }}">
</div>

<!-- Restrictions -->
<div class="form-section">
  <label class="form-label">Any restrictions imposed?</label>
  <div class="form-check">
      <input 
          class="form-check-input" 
          type="radio" 
          name="restrictions" 
          id="restrictions-yes" 
          readonly value="yes" 
          {{ $display->restrictions == 'yes' ? 'checked' : '' }}>
      <label class="form-check-label" for="restrictions-yes">Yes</label>
  </div>
  <div class="form-check">
      <input 
          class="form-check-input" 
          type="radio" 
          name="restrictions" 
          id="restrictions-no" 
          readonly value="no" 
          {{ $display->restrictions == 'no' ? 'checked' : '' }}>
      <label class="form-check-label" for="restrictions-no">No</label>
  </div>
  <textarea 
      class="form-control mt-2" 
      rows="3" 
      name="restrictions_imposed" 
      placeholder="If yes, please provide details">{{ $display->restrictions_imposed }}</textarea>
</div>

<!-- Regulatory Permissions -->
<div class="form-section">
  <label class="form-label">Regulatory Permissions</label>
  <div class="form-check">
      <input 
          class="form-check-input" 
          type="checkbox" 
          id="permissions-insurance" 
          readonly value="yes" 
          name="insurance" 
          {{ $display->insurance == 'yes' ? 'checked' : '' }}>
      <label class="form-check-label" for="permissions-insurance">Insurance</label>
  </div>
  <div class="form-check">
      <input 
          class="form-check-input" 
          type="checkbox" 
          id="permissions-investment" 
          readonly value="yes" 
          name="investment" 
          {{ $display->investment == 'yes' ? 'checked' : '' }}>
      <label class="form-check-label" for="permissions-investment">Investment</label>
  </div>
</div>


<!-- Visit Details -->
<div class="form-section row">
  <div class="col-md-6 mb-3">
      <label for="last-visit" class="form-label">Date of Last Regulatory Visit</label>
      <input 
          type="date" 
          class="form-control" 
          id="last-visit" 
          name="regulatory_visit" 
          readonly value="{{ $display->regulatory_visit }}">
  </div>
  <div class="col-md-6">
      <label for="follow-up" class="form-label">Date of Follow-Up (if applicable)</label>
      <input 
          type="date" 
          class="form-control" 
          id="follow-up" 
          name="date_follow" 
          readonly value="{{ $display->date_follow }}">
  </div>
</div>

<!-- Areas Highlighted -->
<div class="form-section">
  <label class="form-label">Any areas highlighted for review?</label>
  <div class="form-check">
      <input 
          class="form-check-input" 
          type="radio" 
          name="areas_review" 
          id="areas-yes" 
          readonly value="yes" 
          {{ $display->areas_review == 'yes' ? 'checked' : '' }}>
      <label class="form-check-label" for="areas-yes">Yes</label>
  </div>
  <div class="form-check">
      <input 
          class="form-check-input" 
          type="radio" 
          name="areas_review" 
          id="areas-no" 
          readonly value="no" 
          {{ $display->areas_review == 'no' ? 'checked' : '' }}>
      <label class="form-check-label" for="areas-no">No</label>
  </div>
  <textarea 
      class="form-control mt-2" 
      rows="3" 
      name="highlighted_review" 
      placeholder="If yes, please provide details">{{ $display->highlighted_review }}</textarea>
</div>

<!-- Geographical Cover -->
<div class="form-section">
  <label for="geo-cover" class="form-label">Geographical Cover & Percentage Breakdown</label>
  <textarea 
      class="form-control" 
      id="geo-cover" 
      name="percentage_breakdown" 
      rows="3">{{ $display->percentage_breakdown }}</textarea>
</div>

<!-- Insurance Details -->
<div class="form-section row">
  <div class="col-md-6 mb-3">
      <label for="insurance-level" class="form-label">Level of Professional Indemnity Insurance</label>
      <input 
          type="text" 
          class="form-control" 
          id="insurance-level" 
          name="professional_indemnity" 
          readonly value="{{ $display->professional_indemnity }}">
  </div>
  <div class="col-md-6">
      <label class="form-label">Do you have separate Cyber Security Insurance?</label>
      <div class="form-check">
          <input 
              class="form-check-input" 
              type="radio" 
              name="cyber_insurance" 
              id="cyber-yes" 
              readonly value="yes" 
              {{ $display->cyber_insurance == 'yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="cyber-yes">Yes</label>
      </div>
      <div class="form-check">
          <input 
              class="form-check-input" 
              type="radio" 
              name="cyber_insurance" 
              id="cyber-no" 
              readonly value="no" 
              {{ $display->cyber_insurance == 'no' ? 'checked' : '' }}>
          <label class="form-check-label" for="cyber-no">No</label>
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

                                <!-- Fee & Commission -->
                                <div id="personalInfoValidation" class="content" style="display: none;">
                                  
                                  
<h3>Company Profile, Policies and Procedures</h3>

<div class="mb-3">
  <label class="form-label">Do you meet all clients face to face?</label>
  <div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="face-to-face-yes" 
              name="face_to_face" 
              readonly value="Yes" 
              {{ $display->face_to_face === 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="face-to-face-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="face-to-face-no" 
              name="face_to_face" 
              readonly value="No" 
              {{ $display->face_to_face === 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="face-to-face-no">No</label>
      </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Do you have a non-face-to-face policy?</label>
  <div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="non-face-policy-yes" 
              name="non_face_policy" 
              readonly value="Yes" 
              {{ $display->non_face_policy === 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="non-face-policy-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="non-face-policy-no" 
              name="non_face_policy" 
              readonly value="No" 
              {{ $display->non_face_policy === 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="non-face-policy-no">No</label>
      </div>
  </div>
</div>

<div class="mb-4">
  <label class="form-label">Client risk category percentage</label>
  <div class="row">
      <div class="col-md-4">
          <label for="high-risk" class="form-label">High</label>
          <input 
              type="number" 
              id="high-risk" 
              name="high_risk" 
              class="form-control" 
              placeholder="%" 
              readonly value="{{ $display->high_risk }}">
      </div>
      <div class="col-md-4">
          <label for="standard-risk" class="form-label">Standard</label>
          <input 
              type="number" 
              id="standard-risk" 
              name="standard_risk" 
              class="form-control" 
              placeholder="%" 
              readonly value="{{ $display->standard_risk }}">
      </div>
      <div class="col-md-4">
          <label for="low-risk" class="form-label">Low</label>
          <input 
              type="number" 
              id="low-risk" 
              name="low_risk" 
              class="form-control" 
              placeholder="%" 
              readonly value="{{ $display->low_risk }}">
      </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Do you have relationships with sanctioned or sensitive jurisdictions?</label>
  <div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="sanctioned-yes" 
              name="sanctioned" 
              readonly value="Yes" 
              {{ $display->sanctioned === 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="sanctioned-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="sanctioned-no" 
              name="sanctioned" 
              readonly value="No" 
              {{ $display->sanctioned === 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="sanctioned-no">No</label>
      </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Will you refer these relationships to Altruist?</label>
  <div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="refer-yes" 
              name="refer" 
              readonly value="Yes" 
              {{ $display->refer === 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="refer-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input 
              class="form-check-input" 
              type="radio" 
              id="refer-no" 
              name="refer" 
              readonly value="No" 
              {{ $display->refer === 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="refer-no">No</label>
      </div>
  </div>
</div>


<!-- Client Risk Policy -->
<div class="mb-3">
  <label class="form-label">Do you have a Client Risk Policy?</label>
  <div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="client-risk-yes" name="client_risk" readonly value="Yes" {{ $display->client_risk == 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="client-risk-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="client-risk-no" name="client_risk" readonly value="No" {{ $display->client_risk == 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="client-risk-no">No</label>
      </div>
  </div>
</div>

<!-- KYC Revisit Frequency -->
<div class="mb-3">
  <label for="kyc-revisit" class="form-label">How often do you revisit Client KYC/CDD?</label>
  <input type="text" id="kyc-revisit" name="kyc_revisit" class="form-control" readonly value="{{ $display->kyc_revisit }}">
</div>

<!-- Accept PEPs -->
<div class="mb-3">
  <label class="form-label">Do you accept clients classed, in any form, as PEPs?</label>
  <div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="accept-peps-yes" name="accept_peps" readonly value="Yes" {{ $display->accept_peps == 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="accept-peps-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="accept-peps-no" name="accept_peps" readonly value="No" {{ $display->accept_peps == 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="accept-peps-no">No</label>
      </div>
  </div>
</div>

<!-- PEP Policy -->
<div class="mb-3">
  <label class="form-label">Do you have a PEP policy?</label>
  <div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="pep-policy-yes" name="pep_policy" readonly value="Yes" {{ $display->pep_policy == 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="pep-policy-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="pep-policy-no" name="pep_policy" readonly value="No" {{ $display->pep_policy == 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="pep-policy-no">No</label>
      </div>
  </div>
</div>

<!-- Due Diligence -->
<div class="mb-3">
  <label class="form-label">Is enhanced due diligence requested for all high risk and/or PEP relationships?</label>
  <div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="due-diligence-yes" name="due_diligence" readonly value="Yes" {{ $display->due_diligence == 'Yes' ? 'checked' : '' }}>
          <label class="form-check-label" for="due-diligence-yes">Yes</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="due-diligence-no" name="due_diligence" readonly value="No" {{ $display->due_diligence == 'No' ? 'checked' : '' }}>
          <label class="form-check-label" for="due-diligence-no">No</label>
      </div>
  </div>
</div>

<!-- Provide Details -->
<div class="mb-3">
  <label for="additional-details" class="form-label">If yes, please provide details</label>
  <textarea id="additional-details" name="provide_details" class="form-control" rows="3">{{ $display->provide_details }}</textarea>
</div>

<!-- Risk Assessment -->
<div class="mb-3">
  <label class="form-label">Do you undertake & record risk assessments for each new relationship?</label>
  <div class="form-check">
      <input class="form-check-input" type="radio" id="risk-yes" name="risk_assessment" readonly value="Yes" {{ $display->risk_assessment == 'Yes' ? 'checked' : '' }}>
      <label for="risk-yes" class="form-check-label">Yes</label>
  </div>
  <div class="form-check">
      <input class="form-check-input" type="radio" id="risk-no" name="risk_assessment" readonly value="No" {{ $display->risk_assessment == 'No' ? 'checked' : '' }}>
      <label for="risk-no" class="form-check-label">No</label>
  </div>
</div>

<div class="mb-3">
  <label for="risk-details" class="form-label">If yes, please provide details</label>
  <textarea id="risk-details" name="risk_details" rows="3" class="form-control">{{ $display->risk_details }}</textarea>
</div>
  
  <!-- Client Fee Structure Section -->
<div class="mb-3">
  <label for="client-fee-structure" class="form-label">Please provide details of the client fee structure, indicating whether it is deemed industry standard</label>
  <textarea id="client-fee-structure" name="client_fee_structure" rows="3" class="form-control">{{ $display->client_fee_structure }}</textarea>
</div>

<!-- In-House Investment Products Section -->
<div class="mb-3">
  <label class="form-label">Do you have in-house investment products & offset fees against annual management fees?</label>
  <div class="form-check">
    <input class="form-check-input" type="radio" id="products-yes" name="investment_products" readonly value="Yes" {{ $display->investment_products == 'Yes' ? 'checked' : '' }}>
    <label for="products-yes" class="form-check-label">Yes</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" id="products-no" name="investment_products" readonly value="No" {{ $display->investment_products == 'No' ? 'checked' : '' }}>
    <label for="products-no" class="form-check-label">No</label>
  </div>
</div>
<div class="mb-3">
  <label for="products-details" class="form-label">If yes, please provide details</label>
  <textarea id="products-details" name="products_details" rows="3" class="form-control">{{ $display->products_details }}</textarea>
</div>

<!-- Investment Options Section -->
<div class="mb-3">
  <label class="form-label">Please tick the boxes below to confirm which investments you will be selecting in respect of your Clients:</label>
  <div class="row">
    <div class="col-md-6">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="platform-wrap" name="platform_WRAP" readonly value="Platform / WRAP" {{ $display->platform_WRAP ? 'checked' : '' }}>
        <label for="platform-wrap" class="form-check-label">Platform / WRAP</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="funds" name="funds_platform" readonly value="Funds (direct not via a Platform)" {{ $display->funds_platform ? 'checked' : '' }}>
        <label for="funds" class="form-check-label">Funds (direct not via a Platform)</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="non-mass-market" name="market_investments" readonly value="Non Mass Market Investments" {{ $display->market_investments ? 'checked' : '' }}>
        <label for="non-mass-market" class="form-check-label">Non Mass Market Investments</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="restricted-mass-market" name="restricted_mass" readonly value="Restricted Mass Market Investments" {{ $display->restricted_mass ? 'checked' : '' }}>
        <label for="restricted-mass-market" class="form-check-label">Restricted Mass Market Investments</label>
      </div>
      <div class="form-check">
         <input class="form-check-input" type="checkbox" id="deposit-accounts" name="deposit_accounts" readonly value="Deposit Accounts"{{ $display->deposit_accounts ? 'checked' : '' }}>
         <label for="deposit-accounts" class="form-check-label">Deposit Accounts</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="advisory-stockbroker" name="advisory_stockbroker" readonly value="Advisory Stockbroker" {{ $display->advisory_stockbroker ? 'checked' : '' }}>
        <label for="advisory-stockbroker" class="form-check-label">Advisory Stockbroker</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="dfm-model-portfolios" name="model_portfolios" readonly value="DFM / Model Portfolios" {{ $display->model_portfolios ? 'checked' : '' }}>
        <label for="dfm-model-portfolios" class="form-check-label">DFM / Model Portfolios</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="high-risk-investments" name="investments_defined" readonly value="High Risk Investments as defined by FCA" {{ $display->investments_defined ? 'checked' : '' }}>
        <label for="high-risk-investments" class="form-check-label">High Risk Investments as defined by FCA</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="structured-deposits" name="structured_deposits" readonly value="Structured Deposits" {{ $display->structured_deposits ? 'checked' : '' }}>
        <label for="structured-deposits" class="form-check-label">Structured Deposits</label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="checkbox" id="commercial-property" name="commercial_property" readonly value="Commercial Property" {{ $display->commercial_property ? 'checked' : '' }}>
          <label for="commercial-property" class="form-check-label">Commercial Property</label>
        </div>
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

                                <!-- Investment -->
                                <div id="investmentStrategy" class="content" style="display: none;">
                                   
                                   <!-- Certifier Details Section -->
<h3>Suitable Certifiers</h3>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="title" class="form-label">Title (Mr/Mrs/Miss/Dr/Other)</label>
    <input type="text" id="title" name="title" class="form-control" readonly value="{{ $display->title }}">
  </div>
  <div class="col-md-6">
    <label for="other-details" class="form-label">If other, please provide details</label>
    <input type="text" id="other-details" name="please_details" class="form-control" readonly value="{{ $display->please_details }}">
  </div>
</div>
<div class="mb-3">
  <label for="surname" class="form-label">Surname</label>
  <input type="text" id="surname" name="surname" class="form-control" readonly value="{{ $display->surname }}">
</div>
<div class="mb-3">
  <label for="forenames" class="form-label">Forename(s)</label>
  <input type="text" id="forenames" name="forenames" class="form-control" readonly value="{{ $display->forenames }}">
</div>
<div class="mb-3">
  <label for="profession" class="form-label">Profession and name of professional body with registration no.</label>
  <input type="text" id="profession" name="profession" class="form-control" readonly value="{{ $display->profession }}">
</div>
<div class="mb-3">
  <label for="qualifications" class="form-label">Qualifications</label>
  <input type="text" id="qualifications" name="qualifications" class="form-control" readonly value="{{ $display->qualifications }}">
</div>
<div class="mb-3">
  <label for="certifiers-address" class="form-label">Certifier's Address</label>
  <textarea id="certifiers-address" name="certifiers_address" rows="3" class="form-control">{{ $display->certifiers_address }}</textarea>
</div>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="country" class="form-label">Country</label>
    <input type="text" id="country" name="country" class="form-control" readonly value="{{ $display->country }}">
  </div>
  <div class="col-md-6">
    <label for="post-code" class="form-label">Post Code</label>
    <input type="text" id="post-code" name="post_code" class="form-control" readonly value="{{ $display->post_code }}">
  </div>
    <div class="mt-5">
        <h4 class="fw-bold">Certification Wording</h4>
        <p>Where the document bears a photograph, the following is required:</p>
        <p>"Having met/seen the individual and the identification document at the same time, I certify that this is a true copy of the original document and that the photograph is a true likeness to the bearer."</p>
        <p>Non-photographic documents, must be worded:</p>
            <p>"Having seen the original document, I certify that this is a true copy of the original."</p>
            
        <p>Once certified, you must include the following information about the certifier:</p>
        <ul>
            <li>The certifier's name</li>
            <li>Position within the company and professional body with registration no.</li>
            <li>Date of the certification</li>
            <li>Email address</li>
        </ul>
        <p>If no company stamp is available, the following must also be included:</p>
        <ul>
            <li>Company name that the certifier represents</li>
            <li>Company business address</li>
            <li>Company telephone number</li>
        </ul>
    </div>
</div>

  
  <!-- Acceptance Section -->
<h3>Acceptance</h3>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="full-name-1" class="form-label">Full Name</label>
    <input type="text" id="full-name-1" name="full_name_1" class="form-control" readonly value="{{ $display->full_name_1 }}">
  </div>
  <div class="col-md-6">
    <label for="position-1" class="form-label">Position</label>
    <input type="text" id="position-1" name="position_1" class="form-control" readonly value="{{ $display->position_1 }}">
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="signature_1" class="form-label">Financial Adviser's Signature</label>
    <input type="file" id="signature_1" name="signature_1" class="form-control">
    @if($display->signature_1)
      <small>Current Signature: {{ $display->signature_1 }}</small>
    @endif
  </div>
  <div class="col-md-6">
    <label class="form-label">Date Signed</label>
    <input type="date" class="form-control" name="date_signed_1" readonly value="{{ $display->date_signed_1 }}">
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="full-name-2" class="form-label">Full Name</label>
    <input type="text" id="full-name-2" name="full_name_2" class="form-control" readonly value="{{ $display->full_name_2 }}">
  </div>
  <div class="col-md-6">
    <label for="position-2" class="form-label">Position</label>
    <input type="text" id="position-2" name="position_2" class="form-control" readonly value="{{ $display->position_2 }}">
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="signature-2" class="form-label">Financial Adviser's Signature</label>
    <input type="file" id="signature-2" name="signature_2" class="form-control">
    @if($display->signature_2)
      <small>Current Signature: {{ $display->signature_2 }}</small>
    @endif
  </div>
  <div class="col-md-6">
    <label class="form-label">Date Signed</label>
    <input type="date" class="form-control" name="date_signed_2" readonly value="{{ $display->date_signed_2 }}">
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
                                
                                <!-- CDD Uploads -->
                            <div id="consumer_duty" class="content" style="display: none;">
                                <h4 class="mb-4">CDD Uploads</h4>
  
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="company_structure_chart">Company structure chart</label>

            <!-- Display existing image link if it exists -->
            @if(isset($display->company_structure_chart))
               <div class="mb-2">
                   <a href="https://newalltrust.ilcorpdev.com{{ $display->company_structure_chart }}" target="_blank">
                       View Company structure chart
                   </a>
               </div>
            @endif

            <input type="file" readonly name="company_structure_chart" id="company_structure_chart" class="form-control" style="display: none;" />
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label" for="company_register_shareholder">Register of directors and shareholders</label>

            <!-- Display existing image link if it exists -->
            @if(isset($display->company_register_shareholder))
               <div class="mb-2">
                   <a href="https://newalltrust.ilcorpdev.com{{ $display->company_register_shareholder }}" target="_blank">
                       View Register of directors and shareholders
                   </a>
               </div>
            @endif
            
            <input type="file" readonly name="company_register_shareholder" id="company_register_shareholder" class="form-control" style="display: none;" />
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="company_authorised_signatory">Authorised signatory list</label>
            <!-- Display existing image link if it exists -->
            @if(isset($display->company_authorised_signatory))
               <div class="mb-2">
                   <a href="https://newalltrust.ilcorpdev.com{{ $display->company_authorised_signatory }}" target="_blank">
                       View Authorised signatory list
                   </a>
               </div>
            @endif

            <input type="file" readonly name="company_authorised_signatory" id="company_authorised_signatory" class="form-control" style="display: none;" />
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label" for="appointed_text">If you are an appointed representative of another firm, we also require the following:</label>
            <input type="text" name="appointed_text" readonly id="appointed_text" value="{{ $display->appointed_text }}" placeholder="Contact email address for directors and shareholders over 25%" class="form-control" />
        </div>
      
      
      <div class="m-3">
          <h3>Multiple Files</h3>
          
          
          @php
    $data = $display->adviser_multifiles;
    $multiple = json_decode($data);
@endphp

@if($data) <!-- Check if $data is not null -->
    @foreach($multiple as $file)
        <a href="{{$file}}" class="m-5"><i class="ti ti-file" style="font-size:40px;"></i></a>
    @endforeach
@endif



         
          
      </div>
    </div>
</div>



                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" type="button">Previous</button>
                                    <button class="btn btn-primary btn-next" type="button">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                        Next</button>
                                </div>
                            </div>

                                <!-- Bank Details -->
                                <div id="bank_details" class="content" style="display: none;">
                                   
                                   
<!-- Alltrust Section -->
<h3 class="text-center my-5">Signed on behalf of Alltrust</h3>
<div class="row mb-3">
  <div class="col-md-6">
    <label class="form-label">Date Received</label>
    <input type="date" class="form-control" name="date_received" readonly value="{{ $display->date_received }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">Date Approved</label>
    <input type="date" class="form-control" name="date_approved" readonly value="{{ $display->date_approved }}">
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="approved-by" class="form-label">Approved by</label>
    <input type="text" id="approved-by" name="approved_by" class="form-control" readonly value="{{ $display->approved_by }}">
  </div>
  <div class="col-md-6">
    <label for="approval-signature" class="form-label">Signature</label>
    <input type="file" id="approval-signature" name="approval_signature" class="form-control">
    @if($display->approval_signature)
      <small>Current Signature: {{ $display->approval_signature }}</small>
    @endif
  </div>
</div>


                                    <div class="col-12 d-flex justify-content-between mt-4">
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

                      

                             

                                  <!-- Final Step -->
                            <div id="billingLinksValidation" class="content" style="display: none;">
                                <div class="content-header mb-6">
                                    <h3 class="mb-0">User Details</h3>
                                </div>
                                <div class="row g-6" id="adviserFormsContainer">


                                                                            <div class="col-md-6">
                                                                                <label for="print_name">Name</label>
                                                                                <input type="text" class="form-control"
       readonly value="{{ $display->user ? $display->user->name : '' }}"
       name="user_name"
       id="print_name"
       readonly
       placeholder="Enter Print Name">
                                                                            </div>
                                                                            <input type="hidden" name="user_id" readonly value="{{$display->user->id}}">
                                                                             <div class="col-md-6">
                                                                                <label for="print_name">Email</label>
                                                                                <input type="email" class="form-control"
       readonly value="{{ $display->user ? $display->user->email : '' }}"
       name="user_email"
       id="user_email"
       readonly
       placeholder="Enter Email">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">


                                                                            </div>
                                                                        </div>


                                <div class="row mt-3">

                                    <div class="col-md-12 mt-5 d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" type="button">
                                        <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <!--<button type="submit" class="btn btn-success btn-submit">-->
                                    <!--    <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Submit</span>-->
                                    <!--    <i class="ti ti-arrow-right ti-xs"></i>-->
                                    <!--</button>-->
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>


    <!-- JS -->
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const nextBtns = document.querySelectorAll('.btn-next');
    const prevBtns = document.querySelectorAll('.btn-prev');
    const contents = document.querySelectorAll('.content');
    let currentStep = 0;

    nextBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default button behavior
            if (currentStep < contents.length - 1) {
                contents[currentStep].style.display = 'none'; // Hide current step
                currentStep++; // Go to next step
                contents[currentStep].style.display = 'block'; // Show next step
            }
            toggleButtonState();
        });
    });

    prevBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default button behavior
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


});



    </script>

@endsection
