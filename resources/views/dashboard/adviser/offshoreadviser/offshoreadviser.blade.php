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
<style>
    .progress-container {
        display: flex;
        flex-wrap: wrap;  /* Allow steps to wrap */
        justify-content: center; /* Center align */
        align-items: center;
        gap: 10px; /* Space between steps */
        margin-bottom: 20px;
    }
    .step {
        text-align: center;
        padding: 10px;
        /*flex: 1 1 calc(100% / 6 - 15px);*/
        opacity: 0.5;
        transition: all 0.3s ease-in-out;
    }
    .step.active {
        opacity: 1;
        font-weight: bold;
        color: #000;
    }
    .step.active .step-icon i {
        color: green; /* Active icon color */
    }
    .step-icon i {
        /*font-size: 24px;*/
        display: block;
        margin-bottom: 5px;
    }
    .arrow {
        font-size: 20px;
        color: #999;
    }
    .step-subtitle {
        font-size: 10px;
    }
    @media (max-width: 768px) {
        .step {
            flex: 1 1 calc(100% / 3 - 15px); /* 3 steps per row on tablet */
        }
    }
    @media (max-width: 480px) {
        .step {
            flex: 1 1 calc(100% / 2 - 15px); /* 2 steps per row on mobile */
        }
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
      <div class="progress-container">
         <div class="step active" data-step="0">
            <div class="step-icon"><i class="fas fa-file-alt"></i></div>
            <div class="step-subtitle">Introducer Details</div>
         </div>
         <div class="arrow">→</div>
         <div class="step disabled" data-step="1">
            <div class="step-icon"><i class="fas fa-user"></i></div>
            <div class="step-subtitle">Company Profile</div>
         </div>
         <div class="arrow">→</div>
         <div class="step disabled" data-step="2">
            <div class="step-icon"><i class="fas fa-university"></i></div>
            <div class="step-subtitle">Suitable Certifiers</div>
         </div>
         <div class="arrow">→</div>
         <div class="step disabled" data-step="3">
            <div class="step-icon"><i class="fas fa-sync-alt"></i></div>
            <div class="step-subtitle">CDD Uploads</div>
         </div>
         <div class="arrow">→</div>
         <div class="step disabled" data-step="4">
            <div class="step-icon"><i class="fas fa-balance-scale"></i></div>
            <div class="step-subtitle">Acceptance</div>
         </div>
         <div class="arrow">→</div>
         <div class="step disabled" data-step="5">
            <div class="step-icon"><i class="fas fa-credit-card"></i></div>
            <div class="step-subtitle">Signed on behalf of Alltrust</div>
         </div>
         <div class="arrow">→</div>
         <div class="step disabled" data-step="11">
            <div class="step-icon"><i class="fas fa-check"></i></div>
            <div class="step-subtitle">User Details</div>
         </div>
      </div>
      <!-- Multi Steps Registration -->
      <div class="d-flex col-12 align-items-center justify-content-center authentication-bg p-5">
         <div class="col-10">
            <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
               <div class="bs-stepper-content px-0">
                  <form id="multiStepsForm" method="POST" action="{{ route('newOffshore-store') }}" enctype="multipart/form-data">
                     @csrf
                     <!-- Adviser Details -->
                     <div id="adviserDetails" class="content" style="display: block;">
                        <h3>Introducer Details</h3>
                        <div class="mb-3">
                           <label for="company-name" class="form-label">Company Name</label>
                           <input type="text" id="company-name" name="company_name" value="" class="form-control" >
                        </div>
                        <!-- Trading As -->
                        <div class="mb-3">
                           <label for="trading-as" class="form-label">Trading As</label>
                           <input type="text" id="trading-as" name="trading_as" value="" class="form-control" >
                        </div>
                        <!-- Type -->
                        <div class="mb-3">
                           <label class="form-label">Type</label>
                           <div class="  ">
                              <input class=" " type="radio" id="company" name="type" value="Company">
                              <label for="company" class="  ">Company</label>
                           </div>
                           <div class="  ">
                              <input class=" " type="radio" id="partnership" name="type" value="Partnership">
                              <label for="partnership" class="  ">Partnership</label>
                           </div>
                           <div class="  ">
                              <input class=" " type="radio" id="other" name="type" value="Other">
                              <label for="other" class="  ">Other</label>
                           </div>
                        </div>
                        <!-- If Other -->
                        <div class="mb-3">
                           <label for="other-details" class="form-label">If Other, please specify</label>
                           <input type="text" id="other-details" name="other_details" value="" class="form-control" >
                        </div>
                        <!-- Main Contact -->
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <label for="main-contact" class="form-label">Main Contact</label>
                              <select id="main-contact" name="main_contact" class="form-select">
                                 <option value="">Select</option>
                                 <option value="Mr">Mr</option>
                                 <option value="Mrs">Mrs</option>
                                 <option value="Miss">Miss</option>
                                 <option value="Dr">Dr</option>
                                 <option value="Other">Other</option>
                              </select>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="additional-details" class="form-label">If other, please provide details</label>
                              <input type="text" id="additional-details" name="additional_details" value="" class="form-control" >
                           </div>
                        </div>
                        <!-- Surname -->
                        <div class="mb-3">
                           <label for="surname" class="form-label">Surname</label>
                           <input type="text" id="surname" name="surname_surname" value="" class="form-control" >
                        </div>
                        <!-- Forenames -->
                        <div class="mb-3">
                           <label for="forenames" class="form-label">Forenames</label>
                           <input type="text" id="forenames" name="forename" value="" class="form-control" >
                        </div>
                        <!-- Previous Names -->
                        <div class="mb-3">
                           <label for="previous-names" class="form-label">Previous Name(s)</label>
                           <input type="text" id="previous-names" name="previous_names" value="" class="form-control" >
                        </div>
                        <!-- Registered Address -->
                        <div class="mb-3">
                           <label for="registered-address" class="form-label">Registered Address</label>
                           <textarea id="registered-address" name="registered_address" rows="3" class="form-control" ></textarea>
                        </div>
                        <div class="form-section row">
                           <div class="col-md-6 mb-3">
                              <label for="registered_country" class="form-label">Registered Country</label>
                              <input type="text" class="form-control"  id="registered_country" name="registered_country" value="">
                           </div>
                           <div class="col-md-6">
                              <label for="website" class="form-label">Registered Post Code</label>
                              <input type="text" class="form-control"  id="website" name="registered_post_code" value="">
                           </div>
                        </div>
                        <!-- Physical Address -->
                        <div class="mb-3">
                           <label for="physical-address" class="form-label">Physical Address (if different)</label>
                           <textarea id="physical-address" name="physical_address" rows="3" class="form-control" ></textarea>
                        </div>
                        <div class="form-section row">
                           <div class="col-md-6 mb-3">
                              <label for="physical_country" class="form-label">Physical Country</label>
                              <input type="text" class="form-control"  id="physical_country" name="physical_country" value="">
                           </div>
                           <div class="col-md-6">
                              <label for="website" class="form-label">Physical Post Code</label>
                              <input type="text" class="form-control"  id="website" name="physical_post_code" value="">
                           </div>
                        </div>
                        <!-- Office and Direct Line -->
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <label for="office-number" class="form-label">Main Office Number</label>
                              <input type="text" id="office-number" name="office_number" value="" class="form-control" >
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="direct-line" class="form-label">Direct Line</label>
                              <input type="text" id="direct-line" name="direct_line" value="" class="form-control" >
                           </div>
                        </div>
                        <!-- Mobile Number -->
                        <div class="mb-3">
                           <label for="mobile-number" class="form-label">Mobile Number</label>
                           <input type="text" id="mobile-number" name="mobile_number" value="" class="form-control" >
                        </div>
                        <div class="form-section row">
                           <div class="col-md-6 mb-3">
                              <label for="email" class="form-label">Email Address</label>
                              <input type="email" class="form-control"  id="email" name="email_address" value="">
                           </div>
                           <div class="col-md-6">
                              <label for="website" class="form-label">Website</label>
                              <input type="text" class="form-control"  id="website" name="website" value="">
                           </div>
                        </div>
                        <!-- Business Activity -->
                        <div class="form-section">
                           <label class="form-label">Business Activity (Tick all that are relevant)</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="financial-adviser" value="yes" name="financial_adviser">
                                    <label class="  " for="financial-adviser">Financial Adviser</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="insurance-broker" value="yes" name="insurance_broker">
                                    <label class="  " for="insurance-broker">Insurance Broker</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="asset-manager" value="yes" name="asset_manager">
                                    <label class="  " for="asset-manager">Asset Manager</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="accountant" value="yes" name="accountant">
                                    <label class="  " for="accountant">Accountant</label>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="tax-adviser" value="yes" name="tax_adviser">
                                    <label class="  " for="tax-adviser">Tax Adviser</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="lawyer" value="yes" name="lawyer">
                                    <label class="  " for="lawyer">Lawyer</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="other" value="yes" name="other_business_activity">
                                    <label class="  " for="other">Other</label>
                                 </div>
                                 <input type="text" class="form-control mt-2" id="other-specify" name="other_business_specify" value="">
                              </div>
                           </div>
                        </div>
                        <!-- Regulatory Details -->
                        <div class="form-section">
                           <label for="reg-body" class="form-label">Regulatory/Licensing Body</label>
                           <input type="text" class="form-control mb-3" id="reg-body" name="licensing_body" >
                           <label for="reg-number" class="form-label">Registration/Licensing Reference</label>
                           <input type="text" class="form-control" name="licensing_reference" >
                        </div>
                        <!-- Restrictions -->
                        <div class="form-section">
                           <label class="form-label">Any restrictions imposed?</label>
                           <div class="  ">
                              <input class=" " type="radio" name="restrictions" id="restrictions-yes">
                              <label class="  " for="restrictions-yes">Yes</label>
                           </div>
                           <div class="  ">
                              <input class=" " type="radio" name="restrictions" id="restrictions-no">
                              <label class="  " for="restrictions-no">No</label>
                           </div>
                           <textarea class="form-control mt-2" rows="3" name="restrictions_imposed" placeholder="If yes, please provide details" ></textarea>
                        </div>
                        <!-- Regulatory Permissions -->
                        <div class="form-section">
                           <label class="form-label">Regulatory Permissions</label>
                           <div class="  ">
                              <input class=" " type="checkbox" id="permissions-insurance" value="yes" name="insurance">
                              <label class="  " for="permissions-insurance">Insurance</label>
                           </div>
                           <div class="  ">
                              <input class=" " type="checkbox" id="permissions-investment" value="yes" name="investment">
                              <label class="  " for="permissions-investment">Investment</label>
                           </div>
                        </div>
                        <!-- Visit Details -->
                        <div class="form-section row">
                           <div class="col-md-6 mb-3">
                              <label for="last-visit" class="form-label">Date of Last Regulatory Visit</label>
                              <input type="date" class="form-control"  id="last-visit" name="regulatory_visit">
                           </div>
                           <div class="col-md-6">
                              <label for="follow-up" class="form-label">Date of Follow-Up (if applicable)</label>
                              <input type="date" class="form-control"  id="follow-up" name="date_follow">
                           </div>
                        </div>
                        <!-- Areas Highlighted -->
                        <div class="form-section">
                           <label class="form-label">Any areas highlighted for review?</label>
                           <div class="  ">
                              <input class=" " type="radio" name="areas_review" id="areas-yes">
                              <label class="  " for="areas-yes">Yes</label>
                           </div>
                           <div class="  ">
                              <input class=" " type="radio" name="areas_review" id="areas-no">
                              <label class="  " for="areas-no">No</label>
                           </div>
                           <textarea class="form-control mt-2" rows="3" name="highlighted_review" placeholder="If yes, please provide details" ></textarea>
                        </div>
                        <!-- Geographical Cover -->
                        <div class="form-section">
                           <label for="geo-cover" class="form-label">Geographical Cover & Percentage Breakdown</label>
                           <textarea class="form-control"  id="geo-cover" name="percentage_breakdown" rows="3"></textarea>
                        </div>
                        <!-- Insurance Details -->
                        <div class="form-section row">
                           <div class="col-md-6 mb-3">
                              <label for="insurance-level" class="form-label">What level of professional indemnity insurance do you hold?</label>
                              <input type="text" class="form-control"  id="insurance-level" name="professional_indemnity">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Do you have separate Cyber Security Insurance?</label>
                              <div class="  ">
                                 <input class=" " type="radio" name="cyber_insurance" id="cyber-yes">
                                 <label class="  " for="cyber-yes">Yes</label>
                              </div>
                              <div class="  ">
                                 <input class=" " type="radio" name="cyber_insurance" id="cyber-no">
                                 <label class="  " for="cyber-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                           <button class="btn btn-label-secondary btn-prev" type="button">
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
                     <div id="personalInfoValidation1" class="content" style="display: none;">
                        <h3>Company Profile, Policies and Procedures</h3>
                        <div class="mb-3">
                           <label class="form-label">Do you meet all clients face to face?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="face-to-face-yes" name="face_to_face" value="Yes">
                                 <label class="  " for="face-to-face-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="face-to-face-no" name="face_to_face" value="No">
                                 <label class="  " for="face-to-face-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you have a non-face-to-face policy?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="non-face-policy-yes" name="non_face_policy" value="Yes">
                                 <label class="  " for="non-face-policy-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="non-face-policy-no" name="non_face_policy" value="No">
                                 <label class="  " for="non-face-policy-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-4">
                           <label class="form-label">Client risk category percentage</label>
                           <div class="row">
                              <div class="col-md-4">
                                 <label for="high-risk" class="form-label">High</label>
                                 <input type="number" id="high-risk" name="high_risk" class="form-control"  placeholder="%" >
                              </div>
                              <div class="col-md-4">
                                 <label for="standard-risk" class="form-label">Standard</label>
                                 <input type="number" id="standard-risk" name="standard_risk" class="form-control"  placeholder="%" >
                              </div>
                              <div class="col-md-4">
                                 <label for="low-risk" class="form-label">Low</label>
                                 <input type="number" id="low-risk" name="low_risk" class="form-control"  placeholder="%" >
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you have relationships with sanctioned or sensitive jurisdictions?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="sanctioned-yes" name="sanctioned" value="Yes">
                                 <label class="  " for="sanctioned-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="sanctioned-no" name="sanctioned" value="No">
                                 <label class="  " for="sanctioned-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Will you refer these relationships to Altruist?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="refer-yes" name="refer" value="Yes">
                                 <label class="  " for="refer-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="refer-no" name="refer" value="No">
                                 <label class="  " for="refer-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you have a Client Risk Policy?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="client-risk-yes" name="client_risk" value="Yes">
                                 <label class="  " for="client-risk-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="client-risk-no" name="client_risk" value="No">
                                 <label class="  " for="client-risk-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="kyc-revisit" class="form-label">How often do you revisit Client KYC/CDD?</label>
                           <input type="text" id="kyc-revisit" name="kyc_revisit" class="form-control" >
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you accept clients classed, in any form, as PEPs?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="accept-peps-yes" name="accept_peps" value="Yes">
                                 <label class="  " for="accept-peps-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="accept-peps-no" name="accept_peps" value="No">
                                 <label class="  " for="accept-peps-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you have a PEP policy?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="pep-policy-yes" name="pep_policy" value="Yes">
                                 <label class="  " for="pep-policy-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="pep-policy-no" name="pep_policy" value="No">
                                 <label class="  " for="pep-policy-no">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Is enhanced due diligence requested for all high risk and/or PEP relationships?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="due-diligence-yes" name="due_diligence" value="Yes">
                                 <label class="  " for="due-diligence-yes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="due-diligence-no" name="due_diligence" value="No">
                                 <label class="  " for="due-diligence-no">No</label>
                              </div>
                           </div>
                        </div>
                        <!-- Additional Details Section -->
                        <div class="mb-3">
                           <label for="additional-details" class="form-label">If yes, please provide details</label>
                           <textarea id="additional-details" name="provide_details" class="form-control"  rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you collect and maintain details for clients?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="collectYes" name="collectDetails" value="Yes">
                                 <label class="  " for="collectYes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="collectNo" name="collectDetails" value="No">
                                 <label class="  " for="collectNo">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you have written policies covering this?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="policiesYes" name="writtenPolicies" value="yes">
                                 <label for="policiesYes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="policiesNo" name="writtenPolicies" value="no">
                                 <label for="policiesNo">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="reviewDocuments" class="form-label">How often do you revisit & review documents?</label>
                           <input type="text" id="reviewDocuments" name="reviewDocuments" class="form-control" >
                        </div>
                        <!-- Section 2 -->
                        <div class="mb-3">
                           <label class="form-label">Do you provide updated documents to providers?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="updateYes" name="updatedDocuments" value="yes">
                                 <label for="updateYes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="updateNo" name="updatedDocuments" value="no">
                                 <label for="updateNo">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you have AML & CTF policies in place?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="amlYes" name="amlPolicies" value="yes">
                                 <label for="amlYes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="amlNo" name="amlPolicies" value="no">
                                 <label for="amlNo">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="trainingFrequency" class="form-label">How often is AML & CTF training issued?</label>
                           <input type="text" id="trainingFrequency" name="trainingFrequency" class="form-control" >
                        </div>
                        <!-- Section 3 -->
                        <div class="mb-3">
                           <label class="form-label">Do you have an internal compliance function?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="complianceYes" name="internalCompliance" value="yes">
                                 <label for="complianceYes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="complianceNo" name="internalCompliance" value="no">
                                 <label for="complianceNo">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="complianceApproval" class="form-label">When does compliance approve business cases?</label>
                           <input type="text" id="complianceApproval" name="complianceApproval" class="form-control" >
                        </div>
                        <div class="mb-3">
                           <label for="complianceComments" class="form-label">Compliance function comments (if applicable)</label>
                           <textarea id="complianceComments" name="complianceComments" class="form-control" ></textarea>
                        </div>
                        <!-- Section 4 -->
                        <div class="mb-3">
                           <label class="form-label">Do you maintain country lists for any of the following (tick all that apply):</label>
                           <div>
                              <input type="checkbox" id="highRisk" name="countryLists_highRisk" value="highRisk"> <label for="highRisk">High Risk</label><br>
                              <input type="checkbox" id="fatf" name="countryLists_fatf" value="fatf"> <label for="fatf">FATF Blacklisted</label><br>
                              <input type="checkbox" id="sanctioned" name="countryLists_sanctioned" value="sanctioned"> <label for="sanctioned">Sanctioned Countries</label><br>
                              <input type="checkbox" id="corruption" name="countryLists_corruption" value="corruption"> <label for="corruption">Risk of Corruption</label><br>
                              <input type="checkbox" id="complianceAlert" name="countryLists_complianceAlert" value="complianceAlert"> <label for="complianceAlert">Compliance Alert</label><br>
                              <input type="checkbox" id="drugTrafficking" name="countryLists_drugTrafficking" value="drugTrafficking"> <label for="drugTrafficking">Major Drug Trafficking</label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="additionalComments" class="form-label">Any additional comments on country lists</label>
                           <textarea id="additionalComments" name="additionalComments" class="form-control" ></textarea>
                        </div>
                        <!-- Section 5 -->
                        <div class="mb-3">
                           <label class="form-label">Do you have systems & controls in place to screen transactions?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="systemsYes" name="screenSystems" value="yes">
                                 <label for="systemsYes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="systemsNo" name="screenSystems" value="no">
                                 <label for="systemsNo">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Are you able to identify transactions deemed to be high risk?</label>
                           <div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="highRiskYes" name="identifyHighRisk" value="yes">
                                 <label for="highRiskYes">Yes</label>
                              </div>
                              <div class="     -inline">
                                 <input class=" " type="radio" id="highRiskNo" name="identifyHighRisk" value="no">
                                 <label for="highRiskNo">No</label>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Do you record details of:</label>
                           <div>
                              <input type="checkbox" id="intendedTransactions" name="recordDetails_intended" value="intended"> <label for="intendedTransactions">Intended Client Transactions</label><br>
                              <input type="checkbox" id="expectedAmounts" name="recordDetails_expected" value="expected"> <label for="expectedAmounts">Expected Volume Amounts</label><br>
                              <input type="checkbox" id="perTransaction" name="recordDetails_perTransaction" value="perTransaction"> <label for="perTransaction">Per Transaction</label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="details" class="form-label">If yes, please provide details</label>
                           <textarea id="details" name="yes_details" class="form-control" ></textarea>
                        </div>
                        <!-- Risk Assessment Section -->
                        <div class="mb-3">
                           <label class="form-label">Do you undertake & record risk assessments for each new relationship?</label>
                           <div class="  ">
                              <input class=" " type="radio" id="risk-yes" name="risk_assessment" value="Yes">
                              <label for="risk-yes" class="  ">Yes</label>
                           </div>
                           <div class="  ">
                              <input class=" " type="radio" id="risk-no" name="risk_assessment" value="No">
                              <label for="risk-no" class="  ">No</label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="risk-details" class="form-label">If yes, please provide details</label>
                           <textarea id="risk-details" name="risk_details" rows="3" class="form-control" ></textarea>
                        </div>
                        <!-- Client Fee Structure Section -->
                        <div class="mb-3">
                           <label for="client-fee-structure" class="form-label">Please provide details of the client fee structure, indicating whether it is deemed industry standard</label>
                           <textarea id="client-fee-structure" name="client_fee_structure" rows="3" class="form-control" ></textarea>
                        </div>
                        <!-- In-House Investment Products Section -->
                        <div class="mb-3">
                           <label class="form-label">Do you have in-house investment products & offset fees against annual management fees?</label>
                           <div class="  ">
                              <input class=" " type="radio" id="products-yes" name="investment_products" value="Yes">
                              <label for="products-yes" class="  ">Yes</label>
                           </div>
                           <div class="  ">
                              <input class=" " type="radio" id="products-no" name="investment_products" value="No">
                              <label for="products-no" class="  ">No</label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="products-details" class="form-label">If yes, please provide details</label>
                           <textarea id="products-details" name="products_details" rows="3" class="form-control" ></textarea>
                        </div>
                        <!-- Investment Options Section -->
                        <div class="mb-3">
                           <label class="form-label mb-3">Please tick the boxes below to confirm which investments you will be selecting in respect of your Clients:</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="platform-wrap" name="platform_WRAP" value="Platform / WRAP">
                                    <label for="platform-wrap" class="  ">Platform / WRAP</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="funds" name="funds_platform" value="Funds (direct not via a Platform)">
                                    <label for="funds" class="  ">Funds (direct not via a Platform)</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="non-mass-market" name="market_investments" value="Non Mass Market Investments">
                                    <label for="non-mass-market" class="  ">Non Mass Market Investments</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="restricted-mass-market" name="restricted_mass" value="Restricted Mass Market Investments">
                                    <label for="restricted-mass-market" class="  ">Restricted Mass Market Investments</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="deposit-accounts" name="deposit_accounts" value="Deposit Accounts">
                                    <label for="deposit-accounts" class="  ">Deposit Accounts</label>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="advisory-stockbroker" name="advisory_stockbroker" value="Advisory Stockbroker">
                                    <label for="advisory-stockbroker" class="  ">Advisory Stockbroker</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="dfm-model-portfolios" name="model_portfolios" value="DFM / Model Portfolios">
                                    <label for="dfm-model-portfolios" class="  ">DFM / Model Portfolios</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="high-risk-investments" name="investments_defined" value="High Risk Investments as defined by FCA">
                                    <label for="high-risk-investments" class="  ">High Risk Investments as defined by FCA</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="structured-deposits" name="structured_deposits" value="Structured Deposits">
                                    <label for="structured-deposits" class="  ">Structured Deposits</label>
                                 </div>
                                 <div class="  ">
                                    <input class=" " type="checkbox" id="commercial-property" name="commercial_property" value="Commercial Property">
                                    <label for="commercial-property" class="  ">Commercial Property</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                           <button class="btn btn-label-secondary btn-prev" type="button">
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
                     <div id="personalInfoValidation2" class="content" style="display: none;">
                        <!-- Certifier Details Section -->
                        <h3>Suitable Certifiers</h3>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label for="title" class="form-label">Title (Mr/Mrs/Miss/Dr/Other)</label>
                              <input type="text" id="title" name="title" class="form-control" >
                           </div>
                           <div class="col-md-6">
                              <label for="other-details" class="form-label">If other, please provide details</label>
                              <input type="text" id="other-details" name="please_details" class="form-control" >
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="surname" class="form-label">Surname</label>
                           <input type="text" id="surname" name="surname" class="form-control" >
                        </div>
                        <div class="mb-3">
                           <label for="forenames" class="form-label">Forename(s)</label>
                           <input type="text" id="forenames" name="forenames" class="form-control" >
                        </div>
                        <div class="mb-3">
                           <label for="profession" class="form-label">Profession and name of professional body with registration no.</label>
                           <input type="text" id="profession" name="profession" class="form-control" >
                        </div>
                        <div class="mb-3">
                           <label for="qualifications" class="form-label">Qualifications</label>
                           <input type="text" id="qualifications" name="qualifications" class="form-control" >
                        </div>
                        <div class="mb-3">
                           <label for="certifiers-address" class="form-label">Certifier's Address</label>
                           <textarea id="certifiers-address" name="certifiers_address" rows="3" class="form-control" ></textarea>
                        </div>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label for="country" class="form-label">Country</label>
                              <input type="text" id="country" name="country" class="form-control" >
                           </div>
                           <div class="col-md-6">
                              <label for="post-code" class="form-label">Post Code</label>
                              <input type="text" id="post-code" name="post_code" class="form-control" >
                           </div>
                        </div>
                        <div class="mt-5">
                           <h4 class="fw-bold">Certification Wording</h4>
                           <p>Where the document bears a photograph, the following is :</p>
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
                        <div class="col-12 d-flex justify-content-between">
                           <button class="btn btn-label-secondary btn-prev" type="button">
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
                     <div id="consumer_duty1" class="content" style="display: none;">
                        <h4 class="mb-4">CDD Uploads</h4>
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-6 mb-3 ">
                                 <label  for="company_structure_chart">Company structure chart</label>
                                 <input type="file" name="company_structure_chart" id="company_structure_chart" class="form-control"  />
                              </div>
                              <div class="col-md-6 mb-3">
                                 <label  for="company_register_shareholder">Register of directors and shareholders</label>
                                 <input type="file" name="company_register_shareholder" id="company_register_shareholder" class="form-control"  />
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-6 mb-3">
                                 <label  for="company_authorised_signatory">Authorised signatory list</label>
                                 <input type="file" name="company_authorised_signatory" id="company_authorised_signatory" class="form-control"  />
                              </div>
                              <div class="col-md-12 mb-3">
                                 <label  for="appointed_text">If you are an appointed representative of another firm, we also require the following:</label>
                                 <input type="text" name="appointed_text" id="appointed_text" placeholder="Contact email address for directors and shareholders over 25%" class="form-control"  />
                              </div>
                              <div class="col-md-12 mb-3">
                                 <label  for="">Multiple File Uplode</label>
                                 <input type="file" multiple  name="adviser_multifiles[]" id="" class="form-control"  />
                              </div>
                           </div>
                        </div>
                        <div class="d-flex justify-content-between">
                           <button class="btn btn-label-secondary btn-prev" type="button">Previous</button>
                           <button class="btn btn-primary btn-next" type="button">
                           <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                           <i class="ti ti-arrow-right ti-xs"></i>
                           </button>
                        </div>
                     </div>
                     <!-- Bank Details -->
                     <div id="bank_details" class="content" style="display: none;">
                        <!-- Acceptance Section -->
                        <h3>Acceptance</h3>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label for="full-name-1" class="form-label">Full Name</label>
                              <input type="text" id="full-name-1" name="full_name_1" class="form-control" >
                           </div>
                           <div class="col-md-6">
                              <label for="position-1" class="form-label">Position</label>
                              <input type="text" id="position-1" name="position_1" class="form-control" >
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label for="signature_1" class="form-label">Financial Adviser's Signature</label>
                              <input type="file" id="signature_1" name="signature_1" class="form-control" >
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Date Signed</label>
                              <input type="date" class="form-control"  name="date_signed_1">
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label for="full-name-2" class="form-label">Full Name</label>
                              <input type="text" id="full-name-2" name="full_name_2" class="form-control" >
                           </div>
                           <div class="col-md-6">
                              <label for="position-2" class="form-label">Position</label>
                              <input type="text" id="position-2" name="position_2" class="form-control" >
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label for="signature-2" class="form-label">Financial Adviser's Signature</label>
                              <input type="file" id="signature-2" name="signature_2" class="form-control" >
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Date Signed</label>
                              <input type="date" class="form-control"  name="date_signed_2">
                           </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                           <button class="btn btn-label-secondary btn-prev" type="button">
                           <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                           <span class="align-middle d-sm-inline-block d-none">Previous</span>
                           </button>
                           <button type="button" class="btn btn-primary btn-next">
                           <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                           <i class="ti ti-arrow-right ti-xs"></i>
                           </button>
                        </div>
                     </div>
                     <!-- DB Transfer -->
                     <div id="BD_Transfer" class="content" style="display: none;">
                        <!-- Alltrust Section -->
                        <h3 class="my-5">Signed on behalf of Alltrust</h3>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label class="form-label">Date Received</label>
                              <input type="date" class="form-control"  name="date_received">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Date Approved</label>
                              <input type="date" class="form-control"  name="date_approved">
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-md-6">
                              <label for="approved-by" class="form-label">Approved by</label>
                              <input type="text" id="approved-by" name="approved_by" class="form-control" >
                           </div>
                           <div class="col-md-6">
                              <label for="approval-signature" class="form-label">Signature</label>
                              <input type="file" id="approval-signature" name="approval_signature" class="form-control" >
                           </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                           <button class="btn btn-label-secondary btn-prev" type="button">
                           <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                           <span class="align-middle d-sm-inline-block d-none">Previous</span>
                           </button>
                           <button type="button" class="btn btn-primary btn-next">
                           <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                           <i class="ti ti-arrow-right ti-xs"></i>
                           </button>
                        </div>
                     </div>
                     <div id="billingLinksValidation1" class="content" style="display: none;">
                        <div class="content-header mb-6">
                           <h3 class="mb-0">User Details</h3>
                        </div>
                        <div class="row g-6" id="adviserFormsContainer">
                           <div class="col-md-6">
                              <label for="user_name">Name</label>
                              <input type="text" class="form-control"  name="user_name" id="user_name" placeholder="Enter Name">
                              <span class="text-danger" id="user_name_error"></span>
                           </div>
                           <div class="col-md-6">
                              <label for="user_email">Email</label>
                              <input type="email" class="form-control"  name="user_email" id="user_email" placeholder="Enter Email">
                              <span class="text-danger" id="user_email_error"></span>
                           </div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-md-6">
                              <input type="hidden" class="form-control"  value="{{$ad_role_mem}}" name="role_member" id="role_member">
                              <span class="text-danger" id="role_member_error"></span>
                           </div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-md-12 mt-5 d-flex justify-content-between">
                              <button class="btn btn-label-secondary btn-prev" type="button">
                              <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                              <span class="align-middle d-sm-inline-block d-none">Previous</span>
                              </button>
                              <button type="submit" id="sub" class="btn btn-success btn-submit">
                              <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Submit</span>
                              <i class="ti ti-arrow-right ti-xs"></i>
                              </button>
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
   document.addEventListener("DOMContentLoaded", function () {
   
       const existingEmails = {!! json_encode(\App\Models\User::pluck('email')->toArray()) !!};
       const userEmailInput = document.getElementById('user_email');
       const submitButton = document.getElementById('sub');
       const errorSpan = document.getElementById('user_email_error');
   
       // Initially disable the submit button
       submitButton.disabled = true;
   
       userEmailInput.addEventListener('input', function () {
           const email = this.value.trim();
   
           if (userEmailInput.length === 0) {
               userEmailInput.classList.add('input-error');
               errorSpan.textContent = "Email is .";
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
   
   
   
       // ======
   
       document.addEventListener('DOMContentLoaded', function () {
           const nextBtns = document.querySelectorAll('.btn-next');
           const prevBtns = document.querySelectorAll('.btn-prev');
           const contents = document.querySelectorAll('.content');
           let currentStep = 0;
   
           nextBtns.forEach((btn) => {
               btn.addEventListener('click', () => {
                   if (currentStep < contents.length - 1) {
                       contents[currentStep].style.display = 'none';
                       currentStep++; // Go to next step
                       contents[currentStep].style.display = 'block';
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
   
           let adviserCount = 1; // Counter for adviser forms
   
           addAdviserBtn.addEventListener('click', () => {
               adviserCount++; // Increment the counter for each new adviser form
   
               const newAdviserForm = document.createElement('div');
               newAdviserForm.classList.add('adviser-form');
               newAdviserForm.innerHTML = `
                   <div class="row">
                   <div class="col-md-6 mb-3">
                       <label class="form-label" for="adviserName${adviserCount}">Adviser Name</label>
                       <input type="text" name="adviser[${adviserCount}][adviser_name]" class="form-control"  >
                   </div>
                   <div class="col-md-6 mb-3">
                       <label class="form-label" for="adviserFCAReference${adviserCount}">Adviser FCA Reference</label>
                       <input type="text" name="adviser[${adviserCount}][adviser_fca_reference]" class="form-control"  >
                   </div>
                   <div class="col-md-6 mb-3">
                       <label>
                           <input type="checkbox" name="adviser[${adviserCount}][approved_for_transfer_db]" value="yes">
                           Approved for transfer of DB
                       </label>
                   </div>
                   <div class="col-md-6 mb-3">
                       <label class="form-label" for="adviserEmail${adviserCount}">Adviser Email</label>
                       <input type="email" name="adviser[${adviserCount}][adviser_email]" class="form-control"  >
                   </div>
                   <div class="col-md-6 mb-3">
                       <label class="form-label" for="branch${adviserCount}">Branch</label>
                       <input type="text" name="adviser[${adviserCount}][branch]" class="form-control"  >
                   </div>
                   <div class="col-md-6 mb-3">
                       <label>
                           <input type="checkbox" class="toggle-online-access" name="adviser[${adviserCount}][requires_online_access]" value="yes">
                           Requires online access
                       </label>
                   </div>
                   <div class="col-12 d-flex justify-content-between">
                       <button type="button" class="btn btn-danger btn-remove">Remove</button>
                   </div>
                   </div>
   
               `;
   
               // Append the new adviser form to the container
               adviserFormsContainer.appendChild(newAdviserForm);
   
               // Add event listener to remove button
               newAdviserForm.querySelector('.btn-remove').addEventListener('click', () => {
                   adviserFormsContainer.removeChild(newAdviserForm);
               });
           });
   
           // Remove Adviser Form Functionality
           adviserFormsContainer.addEventListener('click', (event) => {
               if (event.target.classList.contains('btn-remove')) {
                   const adviserForm = event.target.closest('.adviser-form');
                   adviserFormsContainer.removeChild(adviserForm);
               }
           });
       });
   
       document.getElementById('signatureAdviser').addEventListener('change', function(event) {
           const input = event.target;
   
           if (input.files && input.files[0]) {
               const reader = new FileReader();
   
               reader.onload = function(e) {
                   const imagePreview = document.getElementById('imagePreview2');
                   const imageLink = document.getElementById('imageLink2');
                   const lightgallery = document.getElementById('lightgallery2');
   
                   imagePreview.src = e.target.result;
   
                   imageLink.href = e.target.result;
                   imageLink.setAttribute('data-src', e.target.result);
   
                   lightgallery.style.display = 'block';
   
                   lightGallery(lightgallery);
               };
   
               reader.readAsDataURL(input.files[0]);
           }
       });
   
       document.getElementById('signatureAlltrust').addEventListener('change', function(event) {
           const input = event.target;
   
           if (input.files && input.files[0]) {
               const reader = new FileReader();
   
               reader.onload = function(e) {
                   const imagePreview = document.getElementById('imagePreview');
                   const imageLink = document.getElementById('imageLink');
                   const lightgallery = document.getElementById('lightgallery');
   
                   imagePreview.src = e.target.result;
   
                   // Update the href and data-src for lightGallery
                   imageLink.href = e.target.result;
                   imageLink.setAttribute('data-src', e.target.result);
   
                   // Show the gallery div
                   lightgallery.style.display = 'block';
   
                   // Re-initialize LightGallery (in case of multiple changes)
                   lightGallery(lightgallery);
               };
   
               reader.readAsDataURL(input.files[0]); // Read the file as a data URL
           }
       });
   
       document.addEventListener("DOMContentLoaded", function () {
       const submitButton = document.getElementById("submitForm");
   
       submitButton.addEventListener("click", function (e) {
           e.preventDefault();
   
           document.querySelectorAll('.text-danger').forEach((el) => el.textContent = '');
   
           // Get form data
           const formData = {
               user_name: document.getElementById("user_name").value,
               user_email: document.getElementById("user_email").value,
               role_member: document.getElementById("role_member").value,
           };
   
       });
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