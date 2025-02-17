@extends('dashboard.dashboard')

@section('content')

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
                            <form id="multiStepsForm" method="POST" action="{{ route('newAdviser-update', $editAdviser->id) }}" enctype="multipart/form-data">
                                @csrf
                                <!-- Adviser Details -->
                                <div id="adviserDetails" class="content" style="display: block;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Adviser Details</h4>
                                    </div>
                                    <div class="row g-6">
                                        <!--<div class="col-md-12">-->
                                        <!--    <label for="selected_adviser">Select Adviser</label>-->
                                        <!--    <select name="selected_adviser_id" id="selected_adviser" class="form-control" required style="background-color: #2F3349; color: white;" >-->
                                        <!--        @foreach($advisers as $adviser)-->
                                        <!--            <option @if($editAdviser->selected_adviser_id == $adviser->id) selected @endif value="{{ $adviser->id }}">{{ $adviser->name }}</option>-->
                                        <!--        @endforeach-->
                                        <!--    </select>-->
                                        <!--</div> -->
                                        <div class="col-md-6">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" value="{{ $editAdviser->company_name }}" name="company_name" id="company_name" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="trading_names">Trading Name</label>
                                            <input type="text" value="{{ $editAdviser->trading_name }}" name="trading_name" id="trading_name" class="form-control" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" required rows="3">{{ $editAdviser->address }}</textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" value="{{ $editAdviser->country }}" id="country" class="form-control" required />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="postCode">Post Code</label>
                                            <input type="text" name="post_code" value="{{ $editAdviser->post_code }}" id="postCode" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="shareholderDetails">Details of Primary Shareholder/Owner</label>
                                            <input type="text" name="share_holder_details" value="{{ $editAdviser->share_holder_details }}" id="shareholderDetails" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="regulated_adviser">Number of Regulated Advisers</label>
                                            <input type="number" name="regulated_adviser" value="{{ $editAdviser->regulated_adviser }}" id="regulated_adviser" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="contactEmail">Company Contact Email Address</label>
                                            <input type="email" name="contact_email" value="{{ $editAdviser->contact_email }}" id="contactEmail" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="website">Website</label>
                                            <input type="text" name="website" value="{{ $editAdviser->website }}" id="website" class="form-control" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="telephone">Telephone Number</label>
                                            <input type="tel" name="telephone" value="{{ $editAdviser->telephone }}" id="telephone" class="form-control" required />
                                        </div>

                                        <div class="col-md-12">
                                            <p>We will use the above email address to send you notifications about our online system, as well as literature changes and other important company announcements.</p>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="fca_firms_reference">FCA Firms Reference Number:</label>
                                            <input type="tel" name="fca_firms_reference" value="{{ $editAdviser->fca_firms_reference }}" id="fca_firms_reference" class="form-control" required />
                                        </div>

                                        
                                            <div class="col-md-6">
                                                <label for="directly_Authorised">
                                                    <input type="checkbox" value="1" name="directly_authorised_checked" id="directly_Authorised" {{ $editAdviser->directly_authorised_checked ? 'checked' : '' }} />
                                                    Directly Authorised
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="appointed_representative">
                                                    <input type="checkbox" value="1" name="appointed_representative_checked" id="appointed_representative" {{ $editAdviser->appointed_representative_checked ? 'checked' : '' }} />
                                                    Appointed Representative
                                                </label>
                                            </div>
                                       

                                        <div class="col-md-12">
                                            <p>If you are an appointed representative of another firm, please provide the name of your principal company and their FRN:</p>
                                        </div>

                                        
                                                <div class="col-md-6">
                                                    <label for="principal_company_name">Principal Company Name</label>
                                                    <input type="text" name="principal_company_name" value="{{ $editAdviser->principal_company_name }}" id="principal_comapny_name" class="form-control" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="their_frn">Their FRN</label>
                                                    <input type="text" name="their_frn" value="{{ $editAdviser->their_frn }}" id="their_frn" class="form-control" required />
                                                </div>
                                           
                                        <div class="col-md-12">
                                            <p>Do you advise clients that have overseas connections?</p>
                                            <label>
                                                <input type="radio" value="yes" name="advice" id="yes" {{ $editAdviser->advice === 'yes' ? 'checked' : '' }} />
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="advice" id="no" {{ $editAdviser->advice === 'no' ? 'checked' : '' }} />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="provide_countries">If yes, please provide countries:</label>
                                            <textarea name="provide_countries" id="provide_countries" class="form-control" required>{{ $editAdviser->provide_countries }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="hear_about_us">Where did you hear about us?</label>
                                            <input type="text" name="hear_about_us" value="{{ $editAdviser->hear_about_us }}" id="hear_about_us" class="form-control" required />
                                        </div>

                                        <p>How do you generate new business? (Please feel free to tick more than one)</p>
                                        <div class="col-md-6">
                                            <label for="word_of_referrals">
                                                <input type="checkbox" name="word_of_referrals_checked" {{ $editAdviser->word_of_referrals_checked ? 'checked' : '' }}>
                                                Word of mouth / referrals
                                            </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lead_generation">
                                                    <input type="checkbox" name="lead_generation_checked" {{ $editAdviser->lead_generation_checked ? 'checked' : '' }}>
                                                    Lead generation company, if yes, please specify
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="marketing">
                                                    <input type="checkbox" name="marketing_checked" {{ $editAdviser->marketing_checked ? 'checked' : '' }}>
                                                    Marketing
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="other_specify">
                                                    <input type="checkbox" name="other_specify_checked" {{ $editAdviser->other_specify_checked ? 'checked' : '' }}>
                                                    Other, if yes, please specify
                                                </label>
                                                <input type="text" name="other_specify" id="other_specify" value="{{ $editAdviser->other_specify }}" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <p>Do you have restrictions on your permission?</p>
                                            <label>
                                                <input type="radio" value="yes" name="restrictions_yes_permission" id="restrictions_yes_permission_yes" {{ $editAdviser->restrictions_yes_permission === 'yes' ? 'checked' : '' }} />
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="restrictions_yes_permission" id="restrictions_yes_permission_no" {{ $editAdviser->restrictions_yes_permission === 'no' ? 'checked' : '' }} />
                                                No
                                            </label>

                                            <p>If yes, please provide details:</p>
                                            <input type="text" name="restrictions_yes_permission_answer" value="{{ $editAdviser->restrictions_yes_permission_answer }}" id="restrictions_yes_permission_answer" class="form-control" required />
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <p>Have any sanctions been made against the company historically by any regulatory or official body e.g., HMRC/FCA?</p>
                                            <label>
                                                <input type="radio" value="yes" name="sanctions" id="sanctions_yes" {{ $editAdviser->sanctions === 'yes' ? 'checked' : '' }} />
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="sanctions" id="sanctions_no" {{ $editAdviser->sanctions === 'no' ? 'checked' : '' }} />
                                                No
                                            </label>
                                            <label>If yes, please provide details:</label>
                                            <input type="text" name="sanctions_yes_answer" value="{{ $editAdviser->sanctions_yes_answer }}" id="sanctions_yes_answer" class="form-control" required />
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <p>Do you have any connection via people, corporate structures, or premises to any investment firm, product/fund provider, or introducer of business?</p>
                                            <label>
                                                <input type="radio" value="yes" name="connection_connection" id="connection_connection_yes" {{ $editAdviser->connection_connection === 'yes' ? 'checked' : '' }} />
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="connection_connection" id="connection_connection_no" {{ $editAdviser->connection_connection === 'no' ? 'checked' : '' }} />
                                                No
                                            </label>
                                            <p>If yes, please provide details:</p>
                                            <input type="text" name="connection_connection_yes_answer" value="{{ $editAdviser->connection_connection_yes_answer }}" id="connection_connection_yes_answer" class="form-control" required />
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="professional_indemnity_insurance">What level of professional indemnity insurance do you hold?</label>
                                            <input type="text" value="{{ $editAdviser->professional_indemnity_insurance }}" name="professional_indemnity_insurance" id="professional_indemnity_insurance" class="form-control" required />
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                            <label for="policy_excess_DB">Policy excess DB transfer £</label>
                                            <input type="text" value="{{ $editAdviser->policy_excess_DB }}" name="policy_excess_DB" id="policy_excess_DB" class="form-control" required />
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="other_money">Other £</label>
                                            <input type="text" value="{{ $editAdviser->other_money }}" name="other_money" id="other_money" class="form-control" required />
                                        </div>
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <p>Do you have separate Cyber Security insurance?</p>
                                            <label>
                                                <input type="radio" value="yes" name="separate_cyber_security" id="separate_cyber_security_yes" {{ $editAdviser->separate_cyber_security === 'yes' ? 'checked' : '' }} />
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="separate_cyber_security" id="separate_cyber_security_no" {{ $editAdviser->separate_cyber_security === 'no' ? 'checked' : '' }} />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <p>Do you hold permissions for advising on defined benefit (DB) transfers?</p>
                                            <label>
                                                <input type="radio" value="yes" name="permissions_for_advising" id="permissions_for_advising_yes" {{ $editAdviser->permissions_for_advising === 'yes' ? 'checked' : '' }} />
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="permissions_for_advising" id="permissions_for_advising_no" {{ $editAdviser->permissions_for_advising === 'no' ? 'checked' : '' }} />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-12 d-flex mt-3 justify-content-between">
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

                                <!-- Fee & Commission -->
                                <div id="personalInfoValidation" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Fee & Commission</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label for="initial_advice_fee">Initial Advice Fee</label>
                                            <input type="text" name="initial_advice_fee" value="{{ $editAdviser->initial_advice_fee }}" id="initial_advice_fee" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="going_Annual_fee">Ongoing Annual Management Fee</label>
                                            <input type="text" name="going_annual_fee" value="{{ $editAdviser->going_annual_fee }}" id="going_Annual_fee" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="house_portfolio_solutions">In-House Model Portfolio Solutions</label>
                                            <input type="text" name="house_portfolio_solutions" value="{{ $editAdviser->house_portfolio_solutions }}" id="house_portfolio_solutions" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="receive_provider_commission">Do you receive any provider commissions?</label>
                                            <input type="text" name="receive_provider_commission" value="{{ $editAdviser->receive_provider_commission }}" id="receive_provider_commission" class="form-control" required />
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

                                <!-- Investment -->
                                <div id="investmentStrategy" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Investment Strategy</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                          <div>
    <input type="checkbox" id="platformWrap" name="investmentStrategy[]" value="Platform / WRAP" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Platform / WRAP', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="platformWrap">Platform / WRAP</label>
</div>

                                          <div>
    <input type="checkbox" id="advisoryStockbroker" name="investmentStrategy[]" value="Advisory Stockbroker" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Advisory Stockbroker', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="advisoryStockbroker">Advisory Stockbroker</label>
</div>



                                           <div>
    <input type="checkbox" id="commercialProperty" name="investmentStrategy[]" value="Commercial Property" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Commercial Property', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="commercialProperty">Commercial Property</label>
</div>

                                          <div>
    <input type="checkbox" id="depositAccounts" name="investmentStrategy[]" value="Deposit Accounts" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Deposit Accounts', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="depositAccounts">Deposit Accounts</label>
</div>

                                           <div>
    <input type="checkbox" id="fundsDirectViaPlatform" name="investmentStrategy[]" value="Funds (direct via a Platform)" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Funds (direct via a Platform)', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="fundsDirectViaPlatform">Funds (direct not via a Platform)</label>
</div>

                                         <div>
    <input type="checkbox" id="dmvModelPortfolios" name="investmentStrategy[]" value="DMV / Model Portfolios" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('DMV / Model Portfolios', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="dmvModelPortfolios">DFM / Model Portfolios</label>
</div>

                                         <div>
    <input type="checkbox" id="nonMassMarketInvestments" name="investmentStrategy[]" value="Non Mass Market Investments" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Non Mass Market Investments', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="nonMassMarketInvestments">Non Mass Market Investments</label>
</div>

                                            <div>
    <input type="checkbox" id="highRiskInvestments" name="investmentStrategy[]" value="High Risk Investments as defined by FCA" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('High Risk Investments as defined by FCA', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="highRiskInvestments">High Risk Investments as defined by FCA</label>
</div>

                                          <div>
    <input type="checkbox" id="restrictedMassMarket" name="investmentStrategy[]" value="Restricted Mass Market Investments" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Restricted Mass Market Investments', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="restrictedMassMarket">Restricted Mass Market Investments</label>
</div>

                                           <div>
    <input type="checkbox" id="structureDeposit" name="investmentStrategy[]" value="Structure Deposit" 
        {{ is_array(json_decode($editAdviser->investment_strategy, true)) && in_array('Structure Deposit', json_decode($editAdviser->investment_strategy, true)) ? 'checked' : '' }} />
    <label for="structureDeposit">Structured Deposit</label>
</div>

                                        </div>
                                        <div class="col-md-12">
                                            <label>Will you be running / managing the portfolios on behalf of any Clients?</label>
                                            <div>
                                                <input type="radio" name="running_managing_portfolios" id="yesPortfolios" value="Yes" {{ $editAdviser->running_managing_portfolios === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesPortfolios">Yes</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="running_managing_portfolios" id="noPortfolios" value="No" {{ $editAdviser->running_managing_portfolios === 'No' ? 'checked' : '' }} />
                                                <label for="noPortfolios">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>If “Yes” this will be on an:</label>
                                            <div>
                                                <input type="radio" name="basis" id="advisoryBasis" value="Advisory basis" {{ $editAdviser->basis === 'Advisory basis' ? 'checked' : '' }} />
                                                <label for="advisoryBasis">Advisory basis</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="basis" id="discretionaryBasis" value="Discretionary basis" {{ $editAdviser->basis === 'Discretionary basis' ? 'checked' : '' }} />
                                                <label for="discretionaryBasis">Discretionary basis</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="mt-3">If you are running / managing portfolios, please send an example portfolio alongside our Adviser Registration form.</p>
                                        </div>
                                        <div class="col-md-12">
                                            <label>We appreciate financial advisers with a large amount of investment companies, however, please can you detail the top 4 companies your firm uses:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="principalCompanyName1">Principal Company Name</label>
                                            <input type="text" value="{{ $editAdviser->principal_company_name1 }}" name="principal_company_name1" id="principalCompanyName1" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="principalCompanyName2">Principal Company Name</label>
                                            <input type="text" value="{{ $editAdviser->principal_company_name2 }}" name="principal_company_name2" id="principalCompanyName2" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="principalCompanyName3">Principal Company Name</label>
                                            <input type="text" name="principal_company_name3" value="{{ $editAdviser->principal_company_name3 }}" id="principalCompanyName3" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="principalCompanyName4">Principal Company Name</label>
                                            <input type="text" name="principal_company_name4" value="{{ $editAdviser->principal_company_name4 }}" id="principalCompanyName4" class="form-control" required />
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
                                        <h4 class="mb-0">Bank Details</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label for="accountName">Account Name</label>
                                            <input type="text" name="account_name" value="{{ $editAdviser->account_name }}" id="accountName" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="bankName">Bank Name</label>
                                            <input type="text" name="bank_name" value="{{ $editAdviser->bank_name }}" id="bankName" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="accountNumber">Account Number</label>
                                            <input type="text" name="account_number" value="{{ $editAdviser->account_number }}" id="accountNumber" class="form-control" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sort_code">Sort Code</label>
                                            <input type="text" name="sort_code" value="{{ $editAdviser->sort_code }}" id="sort_code" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between mt-3">
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

                                <!-- DB Transfer -->
                                <div id="BD_Transfer" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Defined Benefit (DB) Transfer</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" name="not_applicable" id="not_applicable" {{ $editAdviser->not_applicable ? 'checked' : '' }}>
                                                Not Applicable
                                            </label>
                                        </div>

                                        <div class="col-md-6">
                                            <p>How many advisers within your business are permitted to advise on DB transfers?</p>
                                            <input type="text" value="{{ $editAdviser->advisers_permitted }}" name="advisers_permitted" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <p>How many members of staff provide a supervisory position in relation to DB transfers?</p>
                                            <input type="text" value="{{ $editAdviser->staff_supervisory_position }}" name="staff_supervisory_position" class="form-control" required>
                                        </div>

                                        <div class="col-md-12">
                                            <p>Are you a member of the Pension Transfer Gold Standard?</p>
                                            <label>
                                                <input type="radio" value="yes" name="gold_standard" id="gold_standard_yes" {{ $editAdviser->gold_standard === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="gold_standard" id="gold_standard_no" {{ $editAdviser->gold_standard === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                            <label>
                                                <input type="radio" value="in_progress" name="gold_standard" id="gold_standard_progress" {{ $editAdviser->gold_standard === 'in_progress' ? 'checked' : '' }}>
                                                In Progress
                                            </label>
                                        </div>

                                        <h5>Please confirm the number of DB transfers your firm has made in the previous 12, 24, and 36-month periods:</h5>
                                        <div class="col-md-4">
                                            <label>Number in previous 12 months:</label>
                                            <input type="text" name="db_transfers_12_months" value="{{ $editAdviser->db_transfers_12_months }}" class="form-control" required>
                                        </div>
                                           <div class="col-md-4">
                                                <label>Total value £:</label>
                                            <input type="text" name="total_value_12_months" value="{{ $editAdviser->total_value_12_months }}" class="form-control" required>
                                           </div>
                                           <div class="col-md-4">
                                                <label>DB transfers as a % of all transfers:</label>
                                            <input type="text" name="percentage_db_transfers_12_months" value="{{ $editAdviser->percentage_db_transfers_12_months }}" class="form-control" required>
                                           </div>
                                      

                                        <div class="col-md-4">
                                            <label>Number in previous 24 months:</label>
                                            <input type="text" name="db_transfers_24_months" value="{{ $editAdviser->db_transfers_24_months }}" class="form-control" required>
                                        </div>
                                           <div class="col-md-4">
                                                <label>Total value £:</label>
                                            <input type="text" name="total_value_24_months" value="{{ $editAdviser->total_value_24_months }}" class="form-control" required>
                                           </div>
                                           <div class="col-md-4">
                                                <label>DB transfers as a % of all transfers:</label>
                                            <input type="text" name="percentage_db_transfers_24_months" value="{{ $editAdviser->percentage_db_transfers_24_months }}" class="form-control" required>
                                           </div>
                                        
                                            <div class="col-md-4">
                                                <label>Number in previous 36 months:</label>
                                            <input type="text" name="db_transfers_36_months" value="{{ $editAdviser->db_transfers_36_months }}" class="form-control" required>
                                            </div>
                                           <div class="col-md-4">
                                                <label>Total value £:</label>
                                            <input type="text" name="total_value_36_months" value="{{ $editAdviser->total_value_36_months }}" class="form-control" required>
                                           </div>
                                            <div class="col-md-4">
                                                <label>DB transfers as a % of all transfers:</label>
                                            <input type="text" name="percentage_db_transfers_36_months" value="{{ $editAdviser->percentage_db_transfers_36_months }}" class="form-control" required>
                                            </div>
                                        

                                        <h5>Number of complaints in relation to the DB transfer advice in the previous 12, 24, and 36-month periods:</h5>
                                     
                                          <div class="col-md-6">
                                                <label>Number in previous 12 months:</label>
                                            <input type="text" value="{{ $editAdviser->complaints_12_months }}" name="complaints_12_months" class="form-control" required>
                                          </div>
                                         <div class="col-md-6">
                                                <label>Number of cases on which redress was offered:</label>
                                            <input type="text" value="{{ $editAdviser->redress_cases_12_months }}" name="redress_cases_12_months" class="form-control" required>
                                         </div>
                                         
                                           <div class="col-md-6">
                                                <label>Number in previous 24 months:</label>
                                            <input type="text" value="{{ $editAdviser->complaints_24_months }}" name="complaints_24_months" class="form-control" required>
                                           </div>
                                           <div class="col-md-6">
                                               <label>Number of cases on which redress was offered:</label>
                                            <input type="text" value="{{ $editAdviser->redress_cases_24_months }}" name="redress_cases_24_months" class="form-control" required> 
                                           </div>
                                       
                                        <div class="col-md-6">
                                              <label>Number in previous 36 months:</label>
                                            <input type="text" name="complaints_36_months" value="{{ $editAdviser->complaints_36_months }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Number of cases on which redress was offered:</label>
                                            <input type="text" name="redress_cases_36_months" value="{{ $editAdviser->redress_cases_36_months }}" class="form-control" required>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>What percentage of your DB transfers over the last 12 months were to allow members to immediately access their pension benefits via pension freedoms?</p>
                                            <input type="text" name="percentage_db_transfers" value="{{ $editAdviser->percentage_db_transfers }}" class="form-control" required>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Is your Pension Transfer Specialist internal or external?</p>
                                            <label>
                                                <input type="radio" value="{{ $editAdviser->internal }}" name="pension_specialist" id="pension_specialist_internal" {{ $editAdviser->pension_specialist === 'internal' ? 'checked' : '' }}>
                                                Internal
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="{{ $editAdviser->external }}" name="pension_specialist" id="pension_specialist_external" {{ $editAdviser->pension_specialist === 'external' ? 'checked' : '' }}>
                                                External
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>If internal, do you act as "Pension Transfer Specialist" for other FCA regulated firms?</p>
                                            <label>
                                                <input type="radio" value="{{ $editAdviser->act_as_specialist }}" name="act_as_specialist" id="act_as_specialist_yes" {{ $editAdviser->act_as_specialist === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="{{ $editAdviser->act_as_specialist }}" name="act_as_specialist" id="act_as_specialist_no" {{ $editAdviser->act_as_specialist === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 ">
                                            <p>If yes, please provide details of firms:</p>
                                            <textarea name="details_of_firms" class="form-control" required>{{ $editAdviser->details_of_firms }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <p>If external, please provide contact details for your Pension Transfer Specialist:</p>
                                            <label>Contact Name:</label>
                                             <input type="text" name="contact_name" value="{{ $editAdviser->contact_name }}" class="form-control" required>
                                        </div>
                                        <div  class="col-md-6">
                                            
                                            <label>Email Address:</label>
                                             <input type="email" name="email_address" value="{{ $editAdviser->email_address }}" class="form-control" required>
                                        </div>
                                        <div  class="col-md-6">
                                           <div class="row">
                                               <div class="col-md-8">
                                                    <label>Phone Number:</label>
                                            <input type="text" name="phone_number" value="{{ $editAdviser->phone_number }}" class="form-control" required>
                                               </div>
                                               <div class="col-md-4">
                                                    <label>Dial Code:</label>
                                            <input type="text" name="dial_code" value="{{ $editAdviser->dial_code }}" class="form-control" required>
                                               </div>
                                           </div>
                                        </div>
                                        <!--<div  class="col-md-6">-->
                                            
                                        <!--</div>-->

                                        <!-- New Investment Stwrategy Section -->
                                        <div class="col-md-12 mt-4">
                                            <p>What is a typical investment strategy for a DB transfer i.e. DFM / Platform and with whom?</p>
                                            <textarea name="typical_investment_strategy" class="form-control" required>{{ $editAdviser->typical_investment_strategy }}</textarea>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>What is the minimum CETV you would normally consider appropriate for a transfer into a Pension Scheme?</p>
                                            <input type="text" value="{{ $editAdviser->minimum_cetv }}" name="minimum_cetv" class="form-control" required>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you conduct DB transfers for self-invested clients making their own investment decisions?</p>
                                            <label>
                                                <input type="radio" value="yes" name="conduct_db_transfers" id="conduct_db_transfers_yes" {{ $editAdviser->conduct_db_transfers === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="conduct_db_transfers" id="conduct_db_transfers_no" {{ $editAdviser->conduct_db_transfers === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you accept insistent clients on DB transfers?</p>
                                            <label>
                                                <input type="radio" value="yes" name="accept_insistent_clients" id="accept_insistent_clients_yes" {{ $editAdviser->accept_insistent_clients === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="accept_insistent_clients" id="accept_insistent_clients_no" {{ $editAdviser->accept_insistent_clients === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you work with unregulated lead generation firms / websites for DB transfers?</p>
                                            <label>
                                                <input type="radio" value="yes" name="work_with_unregulated_firms" id="work_with_unregulated_firms_yes" {{ $editAdviser->work_with_unregulated_firms === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="work_with_unregulated_firms" id="work_with_unregulated_firms_no" {{ $editAdviser->work_with_unregulated_firms === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you receive referrals from other FCA regulated adviser firms that do not have permissions to advise on DB transfers?</p>
                                            <label>
                                                <input type="radio" value="yes" name="receive_referrals" id="receive_referrals_yes" {{ $editAdviser->receive_referrals === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="receive_referrals" id="receive_referrals_no" {{ $editAdviser->receive_referrals === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>If yes, please provide details:</p>
                                            <textarea name="referral_details" class="form-control" required>{{ $editAdviser->referral_details }}</textarea>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>What percentage of your DB transfer business does this make up?</p>
                                            <input type="text" value="{{ $editAdviser->db_transfer_percentage }}" name="db_transfer_percentage" class="form-control" required>
                                        </div>

                                        <!-- New Questions -->
                                        <div class="col-md-12 mt-4">
                                            <p>How do you source your DB clients?</p>
                                            <textarea name="db_client_source" class="form-control" required>{{ $editAdviser->db_client_source }}</textarea>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you have any relationships with final salary scheme trustees / sponsoring employers?</p>
                                            <label>
                                                <input type="radio" value="yes" name="relationships_with_trustees" id="relationships_with_trustees_yes" {{ $editAdviser->relationships_with_trustees === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="relationships_with_trustees" id="relationships_with_trustees_no" {{ $editAdviser->relationships_with_trustees === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>If yes, please provide details:</p>
                                            <textarea name="trustee_relationship_details" class="form-control" required>{{ $editAdviser->trustee_relationship_details }}</textarea>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you work on a contingent charging basis?</p>
                                            <label>
                                                <input type="radio" value="yes" name="contingent_charging" id="contingent_charging_yes" {{ $editAdviser->contingent_charging === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="contingent_charging" id="contingent_charging_no" {{ $editAdviser->contingent_charging === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>If yes, please specify what contingent charging is used:</p>
                                            <textarea name="contingent_charging_details" class="form-control" required>{{ $editAdviser->contingent_charging_details }}</textarea>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you offer a triage service?</p>
                                            <label>
                                                <input type="radio" value="yes" name="triage_service" id="triage_service_yes" {{ $editAdviser->triage_service === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="triage_service" id="triage_service_no" {{ $editAdviser->triage_service === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Do you have an advice fee and implementation fee?</p>
                                            <label>
                                                <input type="radio" value="yes" name="advice_fee" id="advice_fee_yes" {{ $editAdviser->advice_fee === 'yes' ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                            <br>
                                            <label>
                                                <input type="radio" value="no" name="advice_fee" id="advice_fee_no" {{ $editAdviser->advice_fee === 'no' ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <p>Please provide a breakdown of the typical charging structure of a personal recommendation to transfer out a DB Pension to either a SIPP or a SSAS (including the investment costs once transferred):</p>
                                            <textarea name="charging_structure_breakdown" class="form-control" required>{{ $editAdviser->charging_structure_breakdown }}</textarea>
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
                                <div id="policiesCrime" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Policies & Financial Crime</h4>
                                    </div>
                                    <div class="row g-6">
                                        <p>Do you have a suite of policies covering all regulatory requirements? Do these policies include Client Risk, PEPs, Non-Face-to-face Advice, Financial Crime, Anti Bribery, Anti Money Laundering and Countering Terrorist Financing, High Risk Transactions / Investments, Conflict of Interest, GDPR and the DPA 2018?</p>
                                        <div class="col-md-12">
                                            <div>
                                                <input type="radio" name="policies_coverage" id="yesPolicies" value="Yes" {{ $editAdviser->policies_coverage === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesPolicies">Yes</label><br>
                                                <input type="radio" name="policies_coverage" id="noPolicies" value="No" {{ $editAdviser->policies_coverage === 'No' ? 'checked' : '' }} />
                                                <label for="noPolicies">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="notCoveredDetails">Please provide details of what is not covered by your policies:</label>
                                            <textarea name="not_covered_details" id="notCoveredDetails" class="form-control" required rows="3">{{ $editAdviser->not_covered_details }}</textarea>
                                        </div>

                                        <div class="col-md-12 d-flex justify-content-between flex-wrap mt-3">
                                            <label>Client Risk Category Percentage</label>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <label for="highRisk">High %</label>
                                                    <input type="text" name="high_risk" value="{{ $editAdviser->high_risk }}" id="highRisk" class="form-control" required />
                                                </div>
                                                <div class="me-2">
                                                    <label for="standardRisk">Standard %</label>
                                                    <input type="text" name="standard_risk" value="{{ $editAdviser->standard_risk }}" id="standardRisk" class="form-control" required />
                                                </div>
                                                <div>
                                                    <label for="lowRisk">Low %</label>
                                                    <input type="text" id="low_risk" name="low_risk" value="{{ $editAdviser->low_risk }}" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Do you have a relationship with any sanctioned or sensitive jurisdictions?</label>
                                            <div>
                                                <input type="radio" name="sensitive_jurisdictions" id="yesJurisdictions" value="Yes" {{ $editAdviser->sensitive_jurisdictions === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesJurisdictions">Yes</label>
                                                <br>
                                                <input type="radio" name="sensitive_jurisdictions" id="noJurisdictions" value="No" {{ $editAdviser->sensitive_jurisdictions === 'No' ? 'checked' : '' }} />
                                                <label for="noJurisdictions">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Do you accept clients classified as PEPs in any form?</label>
                                            <div>
                                                <input type="radio" name="accept_PEPs" id="yesPEPs" value="Yes" {{ $editAdviser->accept_PEPs === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesPEPs">Yes</label><br>
                                                <input type="radio" name="accept_PEPs" id="noPEPs" value="No" {{ $editAdviser->accept_PEPs === 'No' ? 'checked' : '' }} />
                                                <label for="noPEPs">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Is enhanced due diligence (EDD) requested for all high risk and/or PEP relationships?</label>
                                            <div>
                                                <input type="radio" name="enhanced_due_diligence" id="yesEDD" value="Yes" {{ $editAdviser->enhanced_due_diligence === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesEDD">Yes</label><br>
                                                <input type="radio" name="enhanced_due_diligence" id="noEDD" value="No" {{ $editAdviser->enhanced_due_diligence === 'No' ? 'checked' : '' }} />
                                                <label for="noEDD">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>If yes, please provide details of what is collected:</label>
                                            <textarea name="add_details_text" id="add_details_text" class="form-control" required rows="3">{{ $editAdviser->add_details_text }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Where required, do you collect source of funds & wealth?</label>
                                            <div>
                                                <input type="radio" name="collect_source" id="yesSource" value="Yes" {{ $editAdviser->collect_source === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesSource">Yes</label><br>
                                                <input type="radio" name="collect_source" id="noSource" value="No" {{ $editAdviser->collect_source === 'No' ? 'checked' : '' }} />
                                                <label for="noSource">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="reviewFrequency">How often are these policies revisited and reviewed?</label>
                                            <input type="text" name="review_frequency" value="{{ $editAdviser->review_frequency }}" id="reviewFrequency" class="form-control" required />
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

                                <!-- Non Standard Assets -->
                                <div id="non_standard_assets" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Non Standard Assets</h4>
                                    </div>
                                    <div class="row g-6">
                                        <p>If you are recommending or plan to recommend an investment into a non-mass market investment, restricted mass market investment or high risk investment please answer the following questions:</p>
                                        <div class="col-md-12">
                                            <label>Do you work with unregulated firms / websites for these type of investment?</label>
                                            <div>
                                                <input type="radio" name="unregulated_firms" id="yesUnregulated" value="Yes" {{ $editAdviser->unregulated_firms === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesUnregulated">Yes</label><br>
                                                <input type="radio" name="unregulated_firms" id="noUnregulated" value="No" {{ $editAdviser->unregulated_firms === 'No' ? 'checked' : '' }} />
                                                <label for="noUnregulated">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="firmsDetails">If yes, please provide details of the firms:</label>
                                            <textarea name="firms_details" id="firms_details" class="form-control" required rows="3">{{ $editAdviser->firms_details }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="totalBusinessPercentage">What % of your total business is through unregulated firms?</label>
                                            <input type="text" name="total_business_percentage" id="totalBusinessPercentage" class="form-control" required value="{{ $editAdviser->total_business_percentage }}" />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="investmentsIntroduced">What investments are introduced this way (please include name, type, geographical location and whether the local tax authority/regulator is investigating):</label>
                                            <textarea name="investments_introduced" id="investmentsIntroduced" class="form-control" required rows="3">{{ $editAdviser->investments_introduced }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Have you or will you meet the client face-to-face or over a video link?</label>
                                            <div>
                                                <input type="radio" name="meet_client" id="yesMeetClient" value="Yes" {{ $editAdviser->meet_client === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesMeetClient">Yes</label><br>
                                                <input type="radio" name="meet_client" id="noMeetClient" value="No" {{ $editAdviser->meet_client === 'No' ? 'checked' : '' }} />
                                                <label for="noMeetClient">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="businessConducted">If not, how has or will the business be conducted (i.e., through a 3rd party, over distance marketing, etc.)?</label>
                                            <textarea name="business_conducted" id="businessConducted" class="form-control" required rows="3">{{ $editAdviser->business_conducted }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Will you only offer non-standard investments to knowledgeable investors which include high net wealth individuals, sophisticated investors or elective professional clients?</label>
                                            <div>
                                                <input type="radio" name="knowledgeable_investors" id="yesKnowledgeable" value="Yes" {{ $editAdviser->knowledgeable_investors === 'Yes' ? 'checked' : '' }} />
                                                <label for="yesKnowledgeable">Yes</label><br>
                                                <input type="radio" name="knowledgeable_investors" id="noKnowledgeable" value="No" {{ $editAdviser->knowledgeable_investors === 'No' ? 'checked' : '' }} />
                                                <label for="noKnowledgeable">No</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="criteriaDetails">If yes, how will you ensure that the client fits the required criteria?</label>
                                            <textarea name="criteria_details" id="criteriaDetails" class="form-control" required rows="3">{{ $editAdviser->criteria_details }}</textarea>
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
                                
                                 <!-- Consumer Duty -->
                                <div id="consumer_duty" class="content" style="display: none;">
                                <h4 class="mb-4">Consumer Duty</h4>
                                <p>Has your firm satisfied itself that its products and services are well designed to meet the needs and objectives of consumers in your target market both now and in the future, and that they perform as expected?</p>
        <div class="mb-3">
            <input type="radio" name="products_design" id="yesProductsDesign" value="Yes" {{ $editAdviser->products_design == 'Yes' ? 'checked' : '' }} />
            <label for="yesProductsDesign">Yes</label><br>
            <input type="radio" name="products_design" id="noProductsDesign" value="No" {{ $editAdviser->products_design == 'No' ? 'checked' : '' }} />
            <label for="noProductsDesign">No</label>
        </div>

        <p>If requested, can you demonstrate that your products and services are fair value for different groups of consumers and that the price charged correctly reflects the associated qualities and benefits?</p>
        <div class="mb-3">
            <input type="radio" name="fair_value" id="yesFairValue" value="Yes" {{ $editAdviser->fair_value == 'Yes' ? 'checked' : '' }} />
            <label for="yesFairValue">Yes</label><br>
            <input type="radio" name="fair_value" id="noFairValue" value="No" {{ $editAdviser->fair_value == 'No' ? 'checked' : '' }} />
            <label for="noFairValue">No</label>
        </div>

        <p>Has your firm ensured that all communications with your customers (including vulnerable) are clear, understandable, and sufficiently informative to enable your customers to achieve good outcomes?</p>
        <div class="mb-3">
            <input type="radio" name="clear_communications" id="yesClearCommunications" value="Yes" {{ $editAdviser->clear_communications == 'Yes' ? 'checked' : '' }} />
            <label for="yesClearCommunications">Yes</label><br>
            <input type="radio" name="clear_communications" id="noClearCommunications" value="No" {{ $editAdviser->clear_communications == 'No' ? 'checked' : '' }} />
            <label for="noClearCommunications">No</label>
        </div>

        <p>Again, if requested, can you evidence that your firm gives appropriate attention to the ongoing needs of your customers and are you satisfied that the quality of post-sales support is as good as pre-sales support?</p>
        <div class="mb-3">
            <input type="radio" name="post_sales_support" id="yesPostSalesSupport" value="Yes" {{ $editAdviser->post_sales_support == 'Yes' ? 'checked' : '' }} />
            <label for="yesPostSalesSupport">Yes</label><br>
            <input type="radio" name="post_sales_support" id="noPostSalesSupport" value="No" {{ $editAdviser->post_sales_support == 'No' ? 'checked' : '' }} />
            <label for="noPostSalesSupport">No</label>
        </div>

        <p>Can you evidence that your customers understand the products and services offered by your firm?</p>
        <div class="mb-3">
            <input type="radio" name="customer_understanding" id="yesCustomerUnderstanding" value="Yes" {{ $editAdviser->customer_understanding == 'Yes' ? 'checked' : '' }} />
            <label for="yesCustomerUnderstanding">Yes</label><br>
            <input type="radio" name="customer_understanding" id="noCustomerUnderstanding" value="No" {{ $editAdviser->customer_understanding == 'No' ? 'checked' : '' }} />
            <label for="noCustomerUnderstanding">No</label>
        </div>
        <p class="mt-5">Do you have adequate controls and checks in place to identify these individuals?</p>
        <div class="mb-3">
            <input type="radio" name="adequate_controls" id="yesCustomerUnderstanding" value="Yes" {{ $editAdviser->adequate_controls == 'Yes' ? 'checked' : '' }} />
            <label for="adequate_controls">Yes</label>
            <br>
            <input type="radio" name="adequate_controls" id="noCustomerUnderstanding" value="No" {{ $editAdviser->adequate_controls == 'no' ? 'checked' : '' }}/>
            <label for="adequate_controls">No</label>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" type="button">Previous</button>
            <button class="btn btn-primary btn-next" type="button">Next</button>
        </div>
    </div>

                                  <!-- CDD Uploads -->
                                <div id="consumer_duty" class="content" style="display: none;">
                                <h4 class="mb-4">CDD Uploads</h4>
  
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="company_structure_chart">Company structure chart</label>

            <!-- Display existing image link if it exists -->
            @if(isset($editAdviser->company_structure_chart))
               <div class="mb-2">
                   <a href="https://newalltrust.ilcorpdev.com{{ $editAdviser->company_structure_chart }}" target="_blank">
                       View Company structure chart
                   </a>
               </div>
            @endif

            <input type="file" name="company_structure_chart" id="company_structure_chart" class="form-control" required />
        </div>

        <div class="col-md-6 mb-3">
            <label for="company_register_shareholder">Register of directors and shareholders</label>

            <!-- Display existing image link if it exists -->
            @if(isset($editAdviser->company_register_shareholder))
               <div class="mb-2">
                   <a href="https://newalltrust.ilcorpdev.com{{ $editAdviser->company_register_shareholder }}" target="_blank">
                       View Register of directors and shareholders
                   </a>
               </div>
            @endif

            <input type="file" name="company_register_shareholder" id="company_register_shareholder" class="form-control" required />
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="company_authorised_signatory">Authorised signatory list</label>

            <!-- Display existing image link if it exists -->
            @if(isset($editAdviser->company_authorised_signatory))
               <div class="mb-2">
                   <a href="https://newalltrust.ilcorpdev.com{{ $editAdviser->company_authorised_signatory }}" target="_blank">
                       View Authorised signatory list
                   </a>
               </div>
            @endif

            <input type="file" name="company_authorised_signatory" id="company_authorised_signatory" class="form-control" required />
        </div>

        <div class="col-md-12 mb-3">
            <label for="appointed_text">If you are an appointed representative of another firm, we also require the following:</label>
            <input type="text" name="appointed_text" id="appointed_text" value="{{ $editAdviser->appointed_text }}" placeholder="Contact email address for directors and shareholders over 25%" class="form-control" required />
        </div>
        
        
         <div class="col-md-12 mb-3">
            <label  for="">Multiple File Uplode</label>
            
             @php
    $data = $editAdviser->adviser_multifiles;
    $multiple = json_decode($data);
@endphp

@if($data) <!-- Check if $data is not null -->
    @foreach($multiple as $file)
        <a href="{{$file}}" class="m-5"><i class="ti ti-file" style="font-size:40px;"></i></a>
    @endforeach
@endif

<input type="file" multiple name="adviser_multifiles[]" class="form-control" required />
<input type="hidden" name="old" value="{{$data}}">

        </div>
        
    </div>
</div>



                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" type="button">Previous</button>
                                    <button class="btn btn-primary btn-next" type="button">Next</button>
                                </div>
                            </div>


                                <!-- Agreement Section -->
                                <div id="agreement_section" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Agreement</h4>
                                        <p>Alltrust agrees that where appropriate instructions have been received from the scheme member(s) and until notification by the scheme member(s) to the contrary, any agreed fees to the above Financial Adviser will be paid electronically from the Scheme to the bank account detailed above. Initial fees will be paid once sufficient funds are available in the scheme member’s bank account and annual fees will be paid on or around the anniversary that the scheme member was admitted to the scheme. Unless VAT is payable, an invoice will not need to be received by us prior to the payment being made.</p>
                                        <p>The following are parties to this agreement:</p>
                                    </div>
                                    <div class="row g-6">
                                        <h5>Signed on behalf of Financial Adviser firm</h5>
                                        <div class="row g-6">
                                          


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="signatureAdviser">Signature</label>
                                                        <div class="input-group">
                                                            <!-- File input field for selecting new image -->
                                                            <input type="file" name="signature_adviser" id="signatureAdviser" class="form-control" required onchange="previewImage2(event)" />

                                                            <div class="input-group-append">
                                                                <span class="input-group-text p-0">
                                                                    <!-- Image preview area -->
                                                                    <div id="lightgallery2" style="display: {{ $editAdviser->signature_adviser ? 'block' : 'none' }};">
                                                                        <a id="imageLink2" target="_blank" href="{{ $editAdviser->signature_adviser ? url($editAdviser->signature_adviser) : '#' }}"
                                                                           data-src="{{ $editAdviser->signature_adviser ? url($editAdviser->signature_adviser) : '#' }}">
                                                                            <img id="imagePreview2" src="{{ $editAdviser->signature_adviser ? url($editAdviser->signature_adviser) : '' }}" alt="Image Preview"
                                                                                 style="height: 35px;">
                                                                        </a>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                              
                                            <input type="hidden" value="{{ $editAdviser->signature_adviser }}" name="old1">
                                            <div class="col-md-6">
                                                <label for="managementFunction">Senior Management Function Held</label>
                                                <input type="text" name="management_function" value="{{ $editAdviser->management_function}}" id="managementFunction" class="form-control" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="positionAdviser">Position</label>
                                                <input type="text" name="position_adviser" value="{{ $editAdviser->position_adviser }}" id="positionAdviser" class="form-control" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="financialAdviserNumber">Financial Adviser Number</label>
                                                <input type="text" name="financial_adviser_number"  value="{{ $editAdviser->financial_adviser_number}}" id="financialAdviserNumber" class="form-control" required />
                                            </div>
                                            <div class="col-md-12">
                                                <label>Date</label>
                                                <div class="d-flex">
                                                    @php
    $date = isset($editAdviser->date_column) ? explode('-', $editAdviser->date_column) : [null, null, null];
@endphp
                                                    <input type="number" value="{{ $date[2]; }}" placeholder="Day" name="day" class="form-control me-2" />
                                                    <input type="number" value="{{ $date[1]; }}" placeholder="Month" name="month" class="form-control me-2" />
                                                    <input type="number" value="{{ $date[0]; }}" placeholder="Year" name="year" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="mt-4">Signed on behalf of Alltrust</h5>
                                        <div class="row g-6">
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="signatureAlltrust">Signature</label>
                                                    <div class="input-group">
                                                        <!-- File input for selecting a new image -->
                                                        <input type="file" name="signature_alltrust" id="signatureAlltrust" class="form-control" required onchange="previewImage(event)" />

                                                        <div class="input-group-append">
                                                            <span class="input-group-text p-0">
                                                                <!-- Image preview area -->
                                                                <div id="lightgallery" style="display: {{ $editAdviser->signature_alltrust ? 'block' : 'none' }};">
                                                                    <a id="imageLink" target="_blank" href="{{ $editAdviser->signature_alltrust ? url($editAdviser->signature_alltrust) : '#' }}"
                                                                       data-src="{{ $editAdviser->signature_alltrust ? url($editAdviser->signature_alltrust) : '#' }}">
                                                                        <img id="imagePreview" src="{{ $editAdviser->signature_alltrust ? url($editAdviser->signature_alltrust) : '' }}" alt="Image Preview" style="height: 35px;">
                                                                    </a>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $editAdviser->signature_adviser }}" name="old1">
                                            <div class="col-md-6">
                                                <label for="positionAlltrust">Position</label>
                                                <input type="text" name="position_alltrust" value="{{ $editAdviser->position_alltrust }}" id="positionAlltrust" class="form-control" required />
                                            </div>
                                            <div class="col-md-12">
                                                <label>Date</label>
                                                <div class="d-flex">
                                                @php
    $date2 = isset($editAdviser->date_column) ? explode('-', $editAdviser->date_column2) : [null, null, null];
@endphp
                                                    <input type="number" value="{{ $date2[2]; }}" placeholder="Day" name="day2" class="form-control me-2" />
                                                    <input type="number" value="{{ $date2[1]; }}" placeholder="Month" name="month2" class="form-control me-2" />
                                                    <input type="number" value="{{ $date2[0]; }}" placeholder="Year" name="year2" class="form-control" required />
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

                                <!-- Final Step -->
                                <div id="billingLinksValidation" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Register Adviser</h4>
                                    </div>
                                    <div class="row g-6" id="adviserFormsContainer">
                                    @php
    // Decode the JSON into an associative array
    $advisersData = json_decode($editAdviser->advisers, true);
@endphp

@foreach ($advisersData as $index => $adviser)
    
        <div class="col-md-6 mb-3">
            <label for="adviserName{{ $index }}">Adviser Name</label>
            <input type="text" name="adviser[{{ $index }}][adviser_name]" class="form-control" required value="{{ $adviser['adviser_name'] ?? '' }}" >
        </div>

        <div class="col-md-6 mb-3">
            <label for="adviserFCAReference{{ $index }}">Adviser FCA Reference</label>
            <input type="text" name="adviser[{{ $index }}][adviser_fca_reference]" class="form-control" required value="{{ $adviser['adviser_fca_reference'] ?? '' }}" >
        </div>

        <div class="col-md-12 mb-3">
            <label>
                <input type="checkbox" name="adviser[{{ $index }}][approved_for_transfer_db]" value="yes" {{ isset($adviser['approved_for_transfer_db']) && $adviser['approved_for_transfer_db'] === 'yes' ? 'checked' : '' }}>
                Approved for transfer of DB
            </label>
        </div>

        <div class="col-md-6 mb-3">
            <label for="adviserEmail{{ $index }}">Adviser Email</label>
            <input type="email" name="adviser[{{ $index }}][adviser_email]" class="form-control" required value="{{ $adviser['adviser_email'] ?? '' }}" >
        </div>

        <div class="col-md-6 mb-3">
            <label for="branch{{ $index }}">Branch</label>
            <input type="text" name="adviser[{{ $index }}][branch]" class="form-control" required value="{{ $adviser['branch'] ?? '' }}" >
        </div>

        <div class="col-md-12 mb-3">
            <label>
                <input type="checkbox" class="toggle-online-access" name="adviser[{{ $index }}][requires_online_access]" value="yes" {{ isset($adviser['requires_online_access']) && $adviser['requires_online_access'] === 'yes' ? 'checked' : '' }}>
                Requires online access
            </label>
        </div>

        <div class="col-12 d-flex justify-content-between mb-5">
            <button type="button" class="btn btn-danger btn-remove">Remove</button>
        </div>

@endforeach

                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-primary btn-add-adviser">Add Adviser</button>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between mt-5">
                                        
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
                                    <h4 class="mb-0">User Details</h4>
                                </div>
                                <div class="row g-6" id="adviserFormsContainer">
                                    
                                     
                                                                            <div class="col-md-6">
                                                                                <label for="print_name">Name</label>
                                                                                <input type="text" class="form-control" required 
       value="{{ $editAdviser->user ? $editAdviser->user->name : '' }}" 
       name="user_name" 
       id="print_name" 
       placeholder="Enter Print Name">
                                                                            </div>
                                                                            <input type="hidden" name="user_id" value="{{$editAdviser->user->id}}">
                                                                             <div class="col-md-6">
                                                                                <label for="print_name">Email</label>
                                                                                <input type="email" class="form-control" required 
       value="{{ $editAdviser->user ? $editAdviser->user->email : '' }}" 
       name="user_email" 
       id="user_email" 
       placeholder="Enter Email">
                                                                            </div>
                                                                        </div>
                                                                         
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                 
                                                                                <input type="hidden" class="form-control" required value="{{$ad_role_mem}}" name="role_member" id="print_name" placeholder="Enter Print Name" >
                                                                            </div>
                                                                        </div>
                                     
                               
                                <div class="row mt-3">
                                    
                                    <div class="col-md-12 mt-5 d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" type="button">
                                        <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button type="submit" class="btn btn-success btn-submit">
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

    // Add Adviser Functionality
    const addAdviserBtn = document.querySelector('.btn-add-adviser');
    const adviserFormsContainer = document.getElementById('adviserFormsContainer');
    let adviserCount = {{$index}}; // Counter for adviser forms

    addAdviserBtn.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default button behavior
        adviserCount++; // Increment the counter for each new adviser form

        const newAdviserForm = document.createElement('div');
        newAdviserForm.classList.add('adviser-form');
        newAdviserForm.innerHTML = `
            <div class="col-md-12 mb-3">
                <label for="adviserName${adviserCount}">Adviser Name</label>
                <input type="text" name="adviser[${adviserCount}][adviser_name]" class="form-control" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="adviserFCAReference${adviserCount}">Adviser FCA Reference</label>
                <input type="text" name="adviser[${adviserCount}][adviser_fca_reference]" class="form-control" required>
            </div>
            <div class="col-md-12 mb-3">
                <label>
                    <input type="checkbox" name="adviser[${adviserCount}][approved_for_transfer_db]" value="yes">
                    Approved for transfer of DB
                </label>
            </div>
            <div class="col-md-12 mb-3">
                <label for="adviserEmail${adviserCount}">Adviser Email</label>
                <input type="email" name="adviser[${adviserCount}][adviser_email]" class="form-control" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="branch${adviserCount}">Branch</label>
                <input type="text" name="adviser[${adviserCount}][branch]" class="form-control" required>
            </div>
            <div class="col-md-12 mb-3">
                <label>
                    <input type="checkbox" class="toggle-online-access" name="adviser[${adviserCount}][requires_online_access]" value="yes">
                    Requires online access
                </label>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <button type="button" class="btn btn-danger btn-remove">Remove</button>
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


        document.getElementById('signatureAlltrust').addEventListener('change', function(event) {
    const input = event.target;

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            const imageLink = document.getElementById('imageLink');
            const lightgallery = document.getElementById('lightgallery');

            // Update the src of the img tag
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

document.getElementById('signatureAdviser').addEventListener('change', function(event) {
    const input = event.target;

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview2');
            const imageLink = document.getElementById('imageLink2');
            const lightgallery = document.getElementById('lightgallery2');

            // Update the src of the img tag
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
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const formSections = document.querySelectorAll(".form-section"); // Form ke sections
    const nextButtons = document.querySelectorAll(".next-btn"); // Next buttons

    nextButtons.forEach((button, index) => {
        button.addEventListener("click", function () {
            const inputs = formSections[index].querySelectorAll("input[required], select[required], textarea[required]");
            let allFilled = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    allFilled = false;
                    input.classList.add("error"); // Highlight empty fields
                } else {
                    input.classList.remove("error");
                }
            });

            if (allFilled) {
                formSections[index].classList.add("hidden"); // Hide current section
                formSections[index + 1]?.classList.remove("hidden"); // Show next section
            }
        });
    });
});
</script>
@endsection
