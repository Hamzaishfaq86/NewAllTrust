@extends('dashboard.dashboard')

@section('content')
    <!-- Button to trigger the modal for adding a new advisor -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewAdvisorModal">
        Add New Lead
    </button>

    <!-- Modal for adding a new advisor -->
    <div class="modal fade" id="addNewAdvisorModal" tabindex="-1" aria-labelledby="addNewAdvisorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewAdvisorModalLabel">Add New Advisor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form starts here -->
                    <form id="multiStepsForm" method="POST" action="{{ route('leads.store') }}">
                        @csrf

                        <!-- Adviser Details Section -->
                        <div id="adviserDetails" class="content">
                            <div class="content-header mb-6">
                                <h4 class="mb-0">Lead Details</h4>
                            </div>
                            <div class="row g-6">
                                <!-- Adviser selection -->

                                <!-- Company Name -->
                                <div class="col-md-12">
                                    <label class="form-label" for="company_name">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" required />
                                </div>

                                <!-- Trading Name -->
                                <div class="col-md-12">
                                    <label class="form-label" for="trading_names">Trading Name</label>
                                    <input type="text" name="trading_name" id="trading_name" class="form-control" />
                                </div>

                                <!-- Address -->
                                <div class="col-md-12">
                                    <label class="form-label" for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                                </div>

                                <!-- Country -->
                                <div class="col-sm-6">
                                    <label class="form-label" for="country">Country</label>
                                    <input type="text" name="country" id="country" class="form-control" />
                                </div>

                                <!-- Postal Code -->
                                <div class="col-sm-6">
                                    <label class="form-label" for="postCode">Post Code</label>
                                    <input type="text" name="post_code" id="postCode" class="form-control" />
                                </div>

                                <!-- Shareholder Details -->
                                <div class="col-md-12">
                                    <label class="form-label" for="shareholderDetails">Details of Primary Shareholder/Owner</label>
                                    <input type="text" name="share_holder_details" id="shareholderDetails" class="form-control" />
                                </div>

                                <!-- Regulated Adviser -->
                                <div class="col-md-12">
                                    <label class="form-label" for="regulated_adviser">Number of Regulated Advisers</label>
                                    <input type="number" name="regulated_adviser" id="regulated_adviser" class="form-control" />
                                </div>

                                <!-- Contact Email -->
                                <div class="col-md-12">
                                    <label class="form-label" for="contactEmail">Company Contact Email Address</label>
                                    <input type="email" name="contact_email" id="contactEmail" class="form-control" required />
                                </div>

                                <!-- Website -->
                                <div class="col-md-12">
                                    <label class="form-label" for="website">Website</label>
                                    <input type="url" name="website" id="website" class="form-control" />
                                </div>

                                <!-- Telephone -->
                                <div class="col-md-12">
                                    <label class="form-label" for="telephone">Telephone Number</label>
                                    <input type="tel" name="telephone" id="telephone" class="form-control" />
                                </div>

                                <!-- FCA Firms Reference -->
                                <div class="col-md-12">
                                    <label class="form-label" for="fca_firms_reference">FCA Firms Reference Number:</label>
                                    <input type="tel" name="fca_firms_reference" id="fca_firms_reference" class="form-control" />
                                </div>

                                <!-- Authorisation Status -->
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="form-label" for="directly_Authorised">
                                            <input type="checkbox" name="directly_authorised_checked" id="directly_Authorised" />
                                            Directly Authorised
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="appointed_representative">
                                            <input type="checkbox" name="appointed_representative_checked" id="appointed_representative" />
                                            Appointed Representative
                                        </label>
                                    </div>
                                </div>

                                <!-- Principal Company Name -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="principal_comapny_name">Principal Company Name</label>
                                            <input type="text" name="principal_comapny_name" id="principal_comapny_name" class="form-control" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="their_frn">Their FRN</label>
                                            <input type="text" name="their_frn" id="their_frn" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Overseas Connections -->
                                <div class="col-md-12">
                                    <p>Do you advise clients that have overseas connections?</p>
                                    <label>
                                        <input type="radio" value="yes" name="advice" id="yes" />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="advice" id="no" />
                                        No
                                    </label>
                                </div>

                                <!-- Provide Countries -->
                                <div class="col-md-12">
                                    <label class="form-label" for="provide_countries">If yes, please provide countries:</label>
                                    <textarea name="provide_countries" id="provide_countries" class="form-control"></textarea>
                                </div>

                                <!-- Hear About Us -->
                                <div class="col-md-12">
                                    <label class="form-label" for="hear_about_us">Where did you hear about us?</label>
                                    <input type="text" name="hear_about_us" id="hear_about_us" class="form-control" />
                                </div>

                                <!-- Business Generation -->
                                <p>How do you generate new business? (Please feel free to tick more than one)</p>
                                <div class="col-md-12">
                                    <label class="form-label" for="word_of_referrals">
                                        <input type="checkbox" name="word_of_referrals_checked">
                                        Word of mouth / referrals
                                    </label>
                                    <div class="col-md-12">
                                        <label class="form-label" for="lead_generation">
                                            <input type="checkbox" name="lead_generation_checked">
                                            Lead generation company, if yes, please specify
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="marketing">
                                            <input type="checkbox" name="marketing_checked">
                                            Marketing
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="other_specify">
                                            <input type="checkbox" name="other_specify_checked">
                                            Other, if yes, please specify
                                        </label>
                                        <input type="text" name="other_specify" id="other_specify" class="form-control" />
                                    </div>
                                </div>

                                <!-- Restrictions on Permission -->
                                <div class="col-md-12">
                                    <p>Do you have restrictions on your permission?</p>
                                    <label>
                                        <input type="radio" value="yes" name="restrictions_yes_permission" id="yes" />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="restrictions_yes_permission" id="no" />
                                        No
                                    </label>

                                    <p>If yes, please provide details:</p>
                                    <input type="text" name="restrictions_yes_permission_answer" id="restrictions_yes_permission_answer" class="form-control" />
                                </div>

                                <!-- Sanctions -->
                                <div class="col-md-12">
                                    <p>Have any sanctions been made against the company historically by any regulatory or official body e.g., HMRC/FCA?</p>
                                    <label>
                                        <input type="radio" value="yes" name="sanctions" id="yes" />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="sanctions" id="no" />
                                        No
                                    </label>
                                    <label>If yes, please provide details:</label>
                                    <input type="text" name="sanctions_yes_answer" id="sanctions_yes_answer" class="form-control" />
                                </div>

                                <!-- Connections -->
                                <div class="col-md-12">
                                    <p>Do you have any connection via people, corporate structures, or premises to any investment firm, product/fund provider, or introducer of business?</p>
                                    <label>
                                        <input type="radio" value="yes" name="connection_connection" id="yes" />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="connection_connection" id="no" />
                                        No
                                    </label>
                                    <p>If yes, please provide details:</p>
                                    <input type="text" name="connection_connection_yes_answer" id="connection_connection_yes_answer" class="form-control" />
                                </div>

                                <!-- Professional Indemnity Insurance -->
                                <div class="col-md-12">
                                    <label class="form-label" for="professional_indemnity_insurance">What level of professional indemnity insurance do you hold?</label>
                                    <input type="text" name="professional_indemnity_insurance" id="professional_indemnity_insurance" class="form-control" />
                                </div>

                                <!-- Policy Excess DB -->
                                <div class="col-md-12">
                                    <label class="form-label" for="policy_excess_DB">Policy excess DB transfer £</label>
                                    <input type="text" name="policy_excess_DB" id="policy_excess_DB" class="form-control" />
                                </div>

                                <!-- Cyber Security Insurance -->
                                <div class="col-md-12">
                                    <p>Do you have separate Cyber Security insurance?</p>
                                    <label>
                                        <input type="radio" value="yes" name="separate_cyber_security" id="yes" />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="separate_cyber_security" id="no" />
                                        No
                                    </label>
                                </div>

                                <!-- DB Transfers Permission -->
                                <div class="col-md-12">
                                    <p>Do you hold permissions for advising on defined benefit (DB) transfers?</p>
                                    <label>
                                        <input type="radio" value="yes" name="permissions_for_advising" id="yes" />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="permissions_for_advising" id="no" />
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer with Buttons -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Lead</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for viewing advisor details -->
    @foreach($leads as $lead)
    <div class="modal fade" id="leadedit{{$lead->id}}" tabindex="-1" aria-labelledby="leadeditLabel{{$lead->id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leadeditLabel{{$lead->id}}">View Lead Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form starts here -->
                    <form id="viewAdvisorForm{{$lead->id}}">
                        <!-- Adviser Details Section -->
                        <div id="adviserDetails" class="content">
                            <div class="content-header mb-6">
                                <h4 class="mb-0">Lead Details</h4>
                            </div>
                            <div class="row g-6">
                                <!-- Company Name -->
                                <div class="col-md-12">
                                    <label class="form-label" for="company_name">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $lead->company_name }}" readonly />
                                </div>

                                <!-- Trading Name -->
                                <div class="col-md-12">
                                    <label class="form-label" for="trading_names">Trading Name</label>
                                    <input type="text" name="trading_name" id="trading_name" class="form-control" value="{{ $lead->trading_name }}" readonly />
                                </div>

                                <!-- Address -->
                                <div class="col-md-12">
                                    <label class="form-label" for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control" rows="3" readonly>{{ $lead->address }}</textarea>
                                </div>

                                <!-- Country -->
                                <div class="col-sm-6">
                                    <label class="form-label" for="country">Country</label>
                                    <input type="text" name="country" id="country" class="form-control" value="{{ $lead->country }}" readonly />
                                </div>

                                <!-- Postal Code -->
                                <div class="col-sm-6">
                                    <label class="form-label" for="postCode">Post Code</label>
                                    <input type="text" name="post_code" id="postCode" class="form-control" value="{{ $lead->post_code }}" readonly />
                                </div>

                                <!-- Shareholder Details -->
                                <div class="col-md-12">
                                    <label class="form-label" for="shareholderDetails">Details of Primary Shareholder/Owner</label>
                                    <input type="text" name="share_holder_details" id="shareholderDetails" class="form-control" value="{{ $lead->share_holder_details }}" readonly />
                                </div>

                                <!-- Regulated Adviser -->
                                <div class="col-md-12">
                                    <label class="form-label" for="regulated_adviser">Number of Regulated Advisers</label>
                                    <input type="number" name="regulated_adviser" id="regulated_adviser" class="form-control" value="{{ $lead->regulated_adviser }}" readonly />
                                </div>

                                <!-- Contact Email -->
                                <div class="col-md-12">
                                    <label class="form-label" for="contactEmail">Company Contact Email Address</label>
                                    <input type="email" name="contact_email" id="contactEmail" class="form-control" value="{{ $lead->contact_email }}" readonly />
                                </div>

                                <!-- Website -->
                                <div class="col-md-12">
                                    <label class="form-label" for="website">Website</label>
                                    <input type="url" name="website" id="website" class="form-control" value="{{ $lead->website }}" readonly />
                                </div>

                                <!-- Telephone -->
                                <div class="col-md-12">
                                    <label class="form-label" for="telephone">Telephone Number</label>
                                    <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ $lead->telephone }}" readonly />
                                </div>

                                <!-- FCA Firms Reference -->
                                <div class="col-md-12">
                                    <label class="form-label" for="fca_firms_reference">FCA Firms Reference Number:</label>
                                    <input type="tel" name="fca_firms_reference" id="fca_firms_reference" class="form-control" value="{{ $lead->fca_firms_reference }}" readonly />
                                </div>

                                <!-- Authorisation Status -->
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="form-label" for="directly_Authorised">
                                            <input type="checkbox" name="directly_authorised_checked" id="directly_Authorised" {{ $lead->directly_authorised_checked ? 'checked' : '' }} disabled />
                                            Directly Authorised
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="appointed_representative">
                                            <input type="checkbox" name="appointed_representative_checked" id="appointed_representative" {{ $lead->appointed_representative_checked ? 'checked' : '' }} disabled />
                                            Appointed Representative
                                        </label>
                                    </div>
                                </div>

                                <!-- Principal Company Name -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="principal_comapny_name">Principal Company Name</label>
                                            <input type="text" name="principal_comapny_name" id="principal_comapny_name" class="form-control" value="{{ $lead->principal_comapny_name }}" readonly />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="their_frn">Their FRN</label>
                                            <input type="text" name="their_frn" id="their_frn" class="form-control" value="{{ $lead->their_frn }}" readonly />
                                        </div>
                                    </div>
                                </div>

                                <!-- Overseas Connections -->
                                <div class="col-md-12">
                                    <p>Do you advise clients that have overseas connections?</p>
                                    <label>
                                        <input type="radio" value="yes" name="advice" id="yes" {{ $lead->advice == 'yes' ? 'checked' : '' }} disabled />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="advice" id="no" {{ $lead->advice == 'no' ? 'checked' : '' }} disabled />
                                        No
                                    </label>
                                </div>

                                <!-- Provide Countries -->
                                <div class="col-md-12">
                                    <label class="form-label" for="provide_countries">If yes, please provide countries:</label>
                                    <textarea name="provide_countries" id="provide_countries" class="form-control" readonly>{{ $lead->provide_countries }}</textarea>
                                </div>

                                <!-- Hear About Us -->
                                <div class="col-md-12">
                                    <label class="form-label" for="hear_about_us">Where did you hear about us?</label>
                                    <input type="text" name="hear_about_us" id="hear_about_us" class="form-control" value="{{ $lead->hear_about_us }}" readonly />
                                </div>

                                <!-- Business Generation -->
                                <p>How do you generate new business? (Please feel free to tick more than one)</p>
                                <div class="col-md-12">
                                    <label class="form-label" for="word_of_referrals">
                                        <input type="checkbox" name="word_of_referrals_checked" {{ $lead->word_of_referrals_checked ? 'checked' : '' }} disabled>
                                        Word of mouth / referrals
                                    </label>
                                    <div class="col-md-12">
                                        <label class="form-label" for="lead_generation">
                                            <input type="checkbox" name="lead_generation_checked" {{ $lead->lead_generation_checked ? 'checked' : '' }} disabled>
                                            Lead generation company, if yes, please specify
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="marketing">
                                            <input type="checkbox" name="marketing_checked" {{ $lead->marketing_checked ? 'checked' : '' }} disabled>
                                            Marketing
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="other_specify">
                                            <input type="checkbox" name="other_specify_checked" {{ $lead->other_specify_checked ? 'checked' : '' }} disabled>
                                            Other, if yes, please specify
                                        </label>
                                        <input type="text" name="other_specify" id="other_specify" class="form-control" value="{{ $lead->other_specify }}" readonly />
                                    </div>
                                </div>

                                <!-- Restrictions on Permission -->
                                <div class="col-md-12">
                                    <p>Do you have restrictions on your permission?</p>
                                    <label>
                                        <input type="radio" value="yes" name="restrictions_yes_permission" id="yes" {{ $lead->restrictions_yes_permission == 'yes' ? 'checked' : '' }} disabled />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="restrictions_yes_permission" id="no" {{ $lead->restrictions_yes_permission == 'no' ? 'checked' : '' }} disabled />
                                        No
                                    </label>

                                    <p>If yes, please provide details:</p>
                                    <input type="text" name="restrictions_yes_permission_answer" id="restrictions_yes_permission_answer" class="form-control" value="{{ $lead->restrictions_yes_permission_answer }}" readonly />
                                </div>

                                <!-- Sanctions -->
                                <div class="col-md-12">
                                    <p>Have any sanctions been made against the company historically by any regulatory or official body e.g., HMRC/FCA?</p>
                                    <label>
                                        <input type="radio" value="yes" name="sanctions" id="yes" {{ $lead->sanctions == 'yes' ? 'checked' : '' }} disabled />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="sanctions" id="no" {{ $lead->sanctions == 'no' ? 'checked' : '' }} disabled />
                                        No
                                    </label>
                                    <label>If yes, please provide details:</label>
                                    <input type="text" name="sanctions_yes_answer" id="sanctions_yes_answer" class="form-control" value="{{ $lead->sanctions_yes_answer }}" readonly />
                                </div>

                                <!-- Connections -->
                                <div class="col-md-12">
                                    <p>Do you have any connection via people, corporate structures, or premises to any investment firm, product/fund provider, or introducer of business?</p>
                                    <label>
                                        <input type="radio" value="yes" name="connection_connection" id="yes" {{ $lead->connection_connection == 'yes' ? 'checked' : '' }} disabled />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="connection_connection" id="no" {{ $lead->connection_connection == 'no' ? 'checked' : '' }} disabled />
                                        No
                                    </label>
                                    <p>If yes, please provide details:</p>
                                    <input type="text" name="connection_connection_yes_answer" id="connection_connection_yes_answer" class="form-control" value="{{ $lead->connection_connection_yes_answer }}" readonly />
                                </div>

                                <!-- Professional Indemnity Insurance -->
                                <div class="col-md-12">
                                    <label class="form-label" for="professional_indemnity_insurance">What level of professional indemnity insurance do you hold?</label>
                                    <input type="text" name="professional_indemnity_insurance" id="professional_indemnity_insurance" class="form-control" value="{{ $lead->professional_indemnity_insurance }}" readonly />
                                </div>

                                <!-- Policy Excess DB -->
                                <div class="col-md-12">
                                    <label class="form-label" for="policy_excess_DB">Policy excess DB transfer £</label>
                                    <input type="text" name="policy_excess_DB" id="policy_excess_DB" class="form-control" value="{{ $lead->policy_excess_DB }}" readonly />
                                </div>

                                <!-- Cyber Security Insurance -->
                                <div class="col-md-12">
                                    <p>Do you have separate Cyber Security insurance?</p>
                                    <label>
                                        <input type="radio" value="yes" name="separate_cyber_security" id="yes" {{ $lead->separate_cyber_security == 'yes' ? 'checked' : '' }} disabled />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="separate_cyber_security" id="no" {{ $lead->separate_cyber_security == 'no' ? 'checked' : '' }} disabled />
                                        No
                                    </label>
                                </div>

                                <!-- DB Transfers Permission -->
                                <div class="col-md-12">
                                    <p>Do you hold permissions for advising on defined benefit (DB) transfers?</p>
                                    <label>
                                        <input type="radio" value="yes" name="permissions_for_advising" id="yes" {{ $lead->permissions_for_advising == 'yes' ? 'checked' : '' }} disabled />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" value="no" name="permissions_for_advising" id="no" {{ $lead->permissions_for_advising == 'no' ? 'checked' : '' }} disabled />
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer with Buttons -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="row mt-3">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Trading Name</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $index => $lead)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->trading_name }}</td>
                            <td>{{ $lead->country }}</td>
                            <td> <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item waves-effect" data-bs-toggle="modal"
                                       data-bs-target="#leadedit{{$lead->id}}"><i class="ti ti-eye me-1"></i> View</a>
                                    <a class="dropdown-item waves-effect" href="{{ route('leads.destroy', ['id' => $lead->id]) }}"><i class="ti ti-trash me-1"></i> Delete</a>
                                </div>
                            </div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/js/tables-datatables-advanced.js') }}"></script>
@endsection
