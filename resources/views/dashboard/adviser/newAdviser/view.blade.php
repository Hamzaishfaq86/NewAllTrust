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
                            <form id="multiStepsForm">
                                @csrf
                                <!-- Adviser Details -->
                                <div id="adviserDetails" class="content" style="display: block;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Adviser Details</h4>
                                    </div>
                                    <div class="row g-6">
                                        {{-- <div class="col-md-12">
                                            <label class="form-label" for="selected_adviser">Select Adviser</label>
                                            <select name="selected_adviser_id" id="selected_adviser" class="form-control" style="background-color: #2F3349; color: white;" disabled>
                                                @foreach($advisers as $adviser)
                                                    <option value="{{ $adviser->id }}" {{ $adviser->id == $selectedAdviserId ? 'selected' : '' }}>{{ $adviser->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}

                                        <div class="col-md-12">
                                            <label class="form-label" for="company_name">Company Name</label>
                                            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $companyName }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="trading_names">Trading Name</label>
                                            <input type="text" name="trading_name" id="trading_name" class="form-control" value="{{ $tradingName }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3" readonly>{{ $address }}</textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" for="country">Country</label>
                                            <input type="text" name="country" id="country" class="form-control" value="{{ $country }}" readonly />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" for="postCode">Post Code</label>
                                            <input type="text" name="post_code" id="postCode" class="form-control" value="{{ $postCode }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="shareholderDetails">Details of Primary Shareholder/Owner</label>
                                            <input type="text" name="share_holder_details" id="shareholderDetails" class="form-control" value="{{ $shareHolderDetails }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="regulated_adviser">Number of Regulated Advisers</label>
                                            <input type="number" name="regulated_adviser" id="regulated_adviser" class="form-control" value="{{ $regulatedAdvisers }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="contactEmail">Company Contact Email Address</label>
                                            <input type="email" name="contact_email" id="contactEmail" class="form-control" value="{{ $contactEmail }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="website">Website</label>
                                            <input type="url" name="website" id="website" class="form-control" value="{{ $website }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="telephone">Telephone Number</label>
                                            <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ $telephone }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <p>We will use the above email address to send you notifications about our online system, as well as literature changes and other important company announcements.</p>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="fca_firms_reference">FCA Firms Reference Number:</label>
                                            <input type="tel" name="fca_firms_reference" id="fca_firms_reference" class="form-control" value="{{ $fcaFirmsReference }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <label class="form-label" for="directly_Authorised">
                                                    <input type="checkbox" name="directly_authorised_checked" id="directly_Authorised" {{ $directlyAuthorised ? 'checked' : '' }} disabled />
                                                    Directly Authorised
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="appointed_representative">
                                                    <input type="checkbox" name="appointed_representative_checked" id="appointed_representative" {{ $appointedRepresentative ? 'checked' : '' }} disabled />
                                                    Appointed Representative
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <p>We will use the above email address to send you notifications about our online system, as well as literature changes and other important company announcements.</p>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="principal_comapny_name">Principal Company Name</label>
                                                    <input type="text" name="principal_comapny_name" id="principal_comapny_name" class="form-control" value="{{ $principalCompanyName }}" readonly />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="their_frn">Their FRN</label>
                                                    <input type="text" name="their_frn" id="their_frn" class="form-control" value="{{ $theirFRN }}" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Do you advise clients that have overseas connections?</p>
                                            <label>
                                                <input type="radio" value="yes" name="advice" id="yes" {{ $advice == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="advice" id="no" {{ $advice == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="provide_countries">If yes, please provide countries:</label>
                                            <textarea name="provide_countries" id="provide_countries" class="form-control" readonly>{{ $provideCountries }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="hear_about_us">Where did you hear about us?</label>
                                            <input type="text" name="hear_about_us" id="hear_about_us" class="form-control" value="{{ $hearAboutUs }}" readonly />
                                        </div>

                                        <p>How do you generate new business? (Please feel free to tick more than one)</p>
                                        <div class="col-md-12">
                                            <label class="form-label" for="word_of_referrals">
                                                <input type="checkbox" name="word_of_referrals_checked" {{ $wordOfReferralsChecked ? 'checked' : '' }} disabled>
                                                Word of mouth / referrals
                                            </label>
                                            <div class="col-md-12">
                                                <label class="form-label" for="lead_generation">
                                                    <input type="checkbox" name="lead_generation_checked" {{ $leadGenerationChecked ? 'checked' : '' }} disabled>
                                                    Lead generation company, if yes, please specify
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="marketing">
                                                    <input type="checkbox" name="marketing_checked" {{ $marketingChecked ? 'checked' : '' }} disabled>
                                                    Marketing
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="other_specify">
                                                    <input type="checkbox" name="other_specify_checked" {{ $otherSpecifyChecked ? 'checked' : '' }} disabled>
                                                    Other, if yes, please specify
                                                </label>
                                                <input type="text" name="other_specify" id="other_specify" class="form-control" value="{{ $otherSpecify }}" readonly />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <p>Do you have restrictions on your permission?</p>
                                            <label>
                                                <input type="radio" value="yes" name="restrictions_yes_permission" id="yes" {{ $restrictionsYesPermission == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="restrictions_yes_permission" id="no" {{ $restrictionsYesPermission == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>

                                            <p>If yes, please provide details:</p>
                                            <input type="text" name="restrictions_yes_permission_answer" id="restrictions_yes_permission_answer" class="form-control" value="{{ $restrictionsYesPermissionAnswer }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <p>Have any sanctions been made against the company historically by any regulatory or official body e.g., HMRC/FCA?</p>
                                            <label>
                                                <input type="radio" value="yes" name="sanctions" id="yes" {{ $sanctions == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="sanctions" id="no" {{ $sanctions == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                            <label>If yes, please provide details:</label>
                                            <input type="text" name="sanctions_yes_answer" id="sanctions_yes_answer" class="form-control" value="{{ $sanctionsYesAnswer }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <p>Do you have any connection via people, corporate structures, or premises to any investment firm, product/fund provider, or introducer of business?</p>
                                            <label>
                                                <input type="radio" value="yes" name="connection_connection" id="yes" {{ $connectionConnection == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="connection_connection" id="no" {{ $connectionConnection == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                            <p>If yes, please provide details:</p>
                                            <input type="text" name="connection_connection_yes_answer" id="connection_connection_yes_answer" class="form-control" value="{{ $connectionConnectionYesAnswer }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="professional_indemnity_insurance">What level of professional indemnity insurance do you hold?</label>
                                            <input type="text" name="professional_indemnity_insurance" id="professional_indemnity_insurance" class="form-control" value="{{ $professionalIndemnityInsurance }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="policy_excess_DB">Policy excess DB transfer £</label>
                                            <input type="text" name="policy_excess_DB" id="policy_excess_DB" class="form-control" value="{{ $policyExcessDB }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <p>Do you have separate Cyber Security insurance?</p>
                                            <label>
                                                <input type="radio" value="yes" name="separate_cyber_security" id="yes" {{ $separateCyberSecurity == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="separate_cyber_security" id="no" {{ $separateCyberSecurity == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12">
                                            <p>Do you hold permissions for advising on defined benefit (DB) transfers?</p>
                                            <label>
                                                <input type="radio" value="yes" name="permissions_for_advising" id="yes" {{ $permissionsForAdvising == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="permissions_for_advising" id="no" {{ $permissionsForAdvising == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
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

                                <!-- Fee & Commission Section -->
                                <div id="feeCommission" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Fee & Commission</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label class="form-label" for="initial_advice_fee">Initial Advice Fee</label>
                                            <input type="text" name="initial_advice_fee" id="initial_advice_fee" class="form-control" value="{{ $initialAdviceFee }}" readonly />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="going_annual_fee">Ongoing Annual Management Fee</label>
                                            <input type="text" name="going_annual_fee" id="going_annual_fee" class="form-control" value="{{ $goingAnnualFee }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="house_portfolio_solutions">In-House Model Portfolio Solutions</label>
                                            <input type="text" name="house_portfolio_solutions" id="house_portfolio_solutions" class="form-control" value="{{ $housePortfolioSolutions }}" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="receive_provider_commission">Do you receive any provider commissions?</label>
                                            <input type="text" name="receive_provider_commission" id="receive_provider_commission" class="form-control" value="{{ $receiveProviderCommission }}" readonly />
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
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

                                <!-- Investment Strategy -->
                                <div id="investmentStrategy" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Investment Strategy</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                            <label class="form-label" for="investment_strategy">What is your investment strategy?</label>
                                            <textarea name="investment_strategy" id="investment_strategy" class="form-control" rows="3" readonly>{{ $investmentStrategy }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="invest_in_ethical">Do you invest in ethical products?</label>
                                            <input type="text" name="invest_in_ethical" id="invest_in_ethical" class="form-control" value="{{ $investInEthical }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <p>Do you use a discretionary investment manager?</p>
                                            <label>
                                                <input type="radio" value="yes" name="use_investment_manager" id="yes" {{ $useInvestmentManager == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="use_investment_manager" id="no" {{ $useInvestmentManager == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="external_dangerous_assets">Do you have any external dangerous assets?</label>
                                            <input type="text" name="external_dangerous_assets" id="external_dangerous_assets" class="form-control" value="{{ $externalDangerousAssets }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <p>Do you invest in retail clients? (FCA definition)</p>
                                            <label>
                                                <input type="radio" value="yes" name="invest_in_retail_clients" id="yes" {{ $investInRetailClients == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="invest_in_retail_clients" id="no" {{ $investInRetailClients == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
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
                                <div id="bankDetails" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Bank Details</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                            <label class="form-label" for="bank_account_name">Bank Account Name</label>
                                            <input type="text" name="bank_account_name" id="bank_account_name" class="form-control" value="{{ $bankAccountName }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="bank_sort_code">Bank Sort Code</label>
                                            <input type="text" name="bank_sort_code" id="bank_sort_code" class="form-control" value="{{ $bankSortCode }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="bank_account_number">Bank Account Number</label>
                                            <input type="text" name="bank_account_number" id="bank_account_number" class="form-control" value="{{ $bankAccountNumber }}" readonly />
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
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

                                <!-- DB Transfer Section -->
                                <div id="dbTransfer" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">DB Transfers</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                            <label class="form-label" for="db_transfer_experience">Do you have experience in DB transfers?</label>
                                            <input type="text" name="db_transfer_experience" id="db_transfer_experience" class="form-control" value="{{ $dbTransferExperience }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <p>Have you ever recommended a DB transfer?</p>
                                            <label>
                                                <input type="radio" value="yes" name="recommended_db_transfer" id="yes" {{ $recommendedDbTransfer == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="recommended_db_transfer" id="no" {{ $recommendedDbTransfer == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="years_of_experience">Years of experience:</label>
                                            <input type="text" name="years_of_experience" id="years_of_experience" class="form-control" value="{{ $yearsOfExperience }}" readonly />
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
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

                                <!-- Policies & Financial Crime Section -->
                                <div id="policiesFinancialCrime" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Policies & Financial Crime</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                            <p>Do you have a policy in place for Financial Crime Prevention?</p>
                                            <label>
                                                <input type="radio" value="yes" name="policy_financial_crime" id="yes" {{ $policyFinancialCrime == 'yes' ? 'checked' : '' }} disabled />
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="no" name="policy_financial_crime" id="no" {{ $policyFinancialCrime == 'no' ? 'checked' : '' }} disabled />
                                                No
                                            </label>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="policy_anti_money_laundering">Do you have a policy in place for Anti-Money Laundering (AML)?</label>
                                            <input type="text" name="policy_anti_money_laundering" id="policy_anti_money_laundering" class="form-control" value="{{ $policyAntiMoneyLaundering }}" readonly />
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
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

                                <!-- Non-Standard Assets Section -->
                                <div id="nonStandardAssets" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Non-Standard Assets</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                            <label class="form-label" for="non_standard_assets_investment">Have you invested in non-standard assets?</label>
                                            <input type="text" name="non_standard_assets_investment" id="non_standard_assets_investment" class="form-control" value="{{ $nonStandardAssetsInvestment }}" readonly />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="description_of_assets">Description of assets:</label>
                                            <textarea name="description_of_assets" id="description_of_assets" class="form-control" rows="3" readonly>{{ $descriptionOfAssets }}</textarea>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
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

                                <!-- Agreement Section -->
                                <div id="agreement" class="content" style="display: none;">
                                    <div class="content-header mb-6">
                                        <h4 class="mb-0">Agreement</h4>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col-md-12">
                                            <p>By submitting this form, you are agreeing to the terms and conditions as outlined above.</p>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="signature">Signature:</label>
                                            <input type="text" name="signature" id="signature" class="form-control" value="{{ $signature }}" readonly />
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" type="button" disabled>
                                                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary">
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

    <!-- JS for managing the steps and read-only display -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nextBtns = document.querySelectorAll('.btn-next');
            const prevBtns = document.querySelectorAll('.btn-prev');
            const sections = document.querySelectorAll('.content');

            nextBtns.forEach((nextBtn, idx) => {
                nextBtn.addEventListener('click', () => {
                    sections[idx].style.display = 'none';
                    sections[idx + 1].style.display = 'block';
                });
            });

            prevBtns.forEach((prevBtn, idx) => {
                prevBtn.addEventListener('click', () => {
                    sections[idx + 1].style.display = 'none';
                    sections[idx].style.display = 'block';
                });
            });
        });
    </script>
@endsection
