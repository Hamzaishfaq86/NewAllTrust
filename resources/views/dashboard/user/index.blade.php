 @extends('.dashboard.dashboard')

@section('content')
    <!-- Modal -->

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

    <!-- Create User Modal -->
    <div class="modal fade" id="usercreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user-store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-4">
                                <label for="nameBasic" class="form-label">Name</label>
                                <input type="text" name="name" id="nameBasic" class="form-control" placeholder="Enter Name" required />
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label">Email</label>
                                <input type="email" name="email" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx" required />
                            </div>
                        
                            <div class="col mb-0">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control" style="background-color: #2F3349; color: white;" required>
                                    @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                                    <option value="admin">Admin</option>
                                    <option value="it_admin">IT Admin</option>
                                    <option value="pre_approved_adviser_firm">Pre-approved Adviser Firm</option>
                                    <option value="advisor_firm">Adviser Firm</option>
                                    @endif
                                    
                                    <option value="onshore_adviser">Onshore Adviser</option>
                                    <option value="offshore_adviser">Offshore Adviser</option>
                                    
                                    @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                                    <option value="oasis_sipp"> Oasis SIPP</option>
                                    <option value="sipp_property"> SIPP Property</option>
                                    <option value="full_sipp_property"> Full SIPP Property</option>
                                    <option value="fpt"> FPT</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                          <div class="row my-2">
                              <div class="col">
                                <label for="emailBasic" class="form-label">Firm Name</label>
                                <input type="text" name="firm_name" id="firm_name" class="form-control" />
                                </div>
                            </div>
                            
                            
                            <div class="">
                                <label for="email_notification" class="form-label">Email Notification</label>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="email_notification" id="email_notification_yes" checked value="yes">
                                  <label class="form-check-label" for="email_notification_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="email_notification" id="email_notification_no" value="no">
                                  <label class="form-check-label" for="email_notification_no">No</label>
                                </div>
                            </div>
                            
                            
                        <div class="row">
                            <div class="col">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter 8 digit password" required />
                            </div>
                        </div>
                        @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                        <p class="mt-2">Onshore Permissions</p>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="adviser_check" value="adviser_check" id="adviser_check" class="" placeholder=""  />
                                    Onshore Adviser Registration From
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="adviser_pending" class="form-label">
                                    <input type="checkbox" name="adviser_pending" value="adviser_pending" id="adviser_pending" class="" placeholder=""  />
                                    Pending Onshore
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="adviser_existing" class="form-label">
                                    <input type="checkbox" name="adviser_existing" value="adviser_existing" id="adviser_existing" class="" placeholder=""  />
                                    Existing Onshore
                                    </label>
                            </div>
                            
                             <div class="col-md-6">
                                <label for="adviser_declined" class="form-label">
                                    <input type="checkbox" name="adviser_declined" value="adviser_declined" id="adviser_declined" class="" placeholder=""  />
                                    Declined Onshore
                                    </label>
                            </div>
                            <br>
                            <br>
                            
                            <p class="mt-2">Offshore Permissions</p>
                            <div class="col-md-6">
                                <label for="offshore_check" class="form-label">
                                    <input type="checkbox" name="offshorer_check" value="offshore_check" id="offshore_check" class="" placeholder=""  />
                                    Offshore Adviser Registration From
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="offshore_pending" class="form-label">
                                    <input type="checkbox" name="offshore_pending" value="offshore_pending" id="offshore_pending" class="" placeholder=""  />
                                    Pending Offshore
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="offshore_existing" class="form-label">
                                    <input type="checkbox" name="offshore_existing" value="offshore_existing" id="offshore_existing" class="" placeholder=""  />
                                    Existing Offshore
                                    </label>
                            </div>
                            
                             <div class="col-md-6">
                                <label for="offshore_declined" class="form-label">
                                    <input type="checkbox" name="offshore_declined" value="offshore_declined" id="offshore_declined" class="" placeholder=""  />
                                    Declined Offshore
                                    </label>
                            </div>
                            <br>
                            <br>
                            
                            
                            @endif
                           
                              
                              <p class="mt-2">Member Application Permissions</p>
                              
                            <div class="col-md-6">
                                <label for="oasis_sipp__check" class="form-label">
                                    <input type="checkbox" name="oasis_sipp__check" value="oasis_sipp__check" id="oasis_sipp__check" class="" placeholder=""  />
                                    Oasis SIPP
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="sipp_property_check" class="form-label">
                                    <input type="checkbox" name="sipp_property_check" value="sipp_property_check" id="sipp_property_check" class="" placeholder=""  />
                                     SIPP Property
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="full_sipp_check" class="form-label">
                                    <input type="checkbox" name="full_sipp_check" value="full_sipp_check" id="full_sipp_check" class="" placeholder=""  />
                                     Full SIPP Property
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="ftp_check" class="form-label">
                                    <input type="checkbox" name="ftp_check" id="ftp_check" value="ftp_check" class="" placeholder=""  />
                                     FTP
                                    </label>
                            </div>
                           
                             @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                             <div class="col-md-6">
                                <label for="pending_applications" class="form-label">
                                    <input type="checkbox" name="pending_applications" id="pending_applications" value="pending_applications" class="" placeholder=""  />
                                     Pending Applications
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="existing_applications" class="form-label">
                                    <input type="checkbox" name="existing_applications" id="existing_applications" value="existing_applications" class="" placeholder=""  />
                                     Existing Applications
                                    </label>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <label for="decline_applications" class="form-label">
                                    <input type="checkbox" name="decline_applications" id="decline_applications" value="decline_applications" class="" placeholder=""  />
                                     Declined Applications
                                    </label>
                            </div>
                            
                            <br>
                            <br>
                            
                            <p class="mt-2">Members Permissions</p>
                            
                            <div class="col-md-6">
                                <label for="illustration_check" class="form-label">
                                    <input type="checkbox" name="illustration_check" value="illustration_check" id="illustration_check" class="" placeholder=""  />
                                     Illustration
                                    </label>
                            </div>
                            @endif
                             <div class="col-md-6">
                                <label for="member_details_check" class="form-label">
                                    <input type="checkbox" name="member_details_check" value="member_details_check" id="member_details_check" class="" placeholder=""  />
                                     Member Details
                                    </label>
                            </div>
                              @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                             <br>
                             <br>
                             
                              <p class="mt-2">Management Permissions</p>
                             
                            <div class="col-md-6">
                                <label for="leads_check" class="form-label">
                                    <input type="checkbox" name="leads_check" value="leads_check" id="leads_check" class="" placeholder=""  />
                                     Leads
                                    </label>
                            </div>
                             
                            <div class="col-md-6">
                                <label for="user_management_check" class="form-label">
                                    <input type="checkbox" name="user_management_check" value="user_management_check" id="user_management_check" class="" placeholder=""  />
                                     User Management
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="dms_check" class="form-label">
                                    <input type="checkbox" name="dms_check" id="dms_check" value="dms_check" class="" placeholder=""  />
                                     DMS
                                    </label>
                            </div>
                            
                             <div class="col-md-6">
                                <label for="reports_check" class="form-label">
                                    <input type="checkbox" name="reports_check" value="reports_check" id="reports_check" class="" placeholder=""  />
                                     Reports
                                    </label>
                            </div>
                            
                             <div class="col-md-12">
                                <label for="workflow_check" class="form-label">
                                    <input type="checkbox" name="workflow_check" value="workflow_check" id="workflow_check" class="" placeholder=""  />
                                     WorkFLow
                                    </label>
                            </div>
                            
                            <br>
                            <br>
                            @endif
                            
                            
                            <p class="mt-2">Support Permissions</p>
                            
                             <div class="col-md-6">
                                <label for="tickets_check" class="form-label">
                                    <input type="checkbox" name="tickets_check" value="tickets_check" id="tickets_check" class="" placeholder=""  />
                                     Tickets 
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="support_check" class="form-label">
                                    <input type="checkbox" name="support_check" value="support_check" id="support_check" class="" placeholder=""  />
                                     Supports
                                    </label>
                            </div>
                            <div class="col-md-12">
                                <label for="faq_check" class="form-label">
                                    <input type="checkbox" name="faq_check" value="faq_check" id="faq_check" class="" placeholder=""  />
                                     FAQ
                                    </label>
                            </div>
                          
                             @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                            <br>
                            <br>
                            
                             <p class="mt-2">Marketing Management Permissions</p>
                            
                              <div class="col-md-12">
                                <label for="communication_check" class="form-label">
                                    <input type="checkbox" name="communication_check" value="communication_check" id="communication_check" class="" placeholder=""  />
                                     Comunications
                                    </label>
                            </div>
                            <br>
                            <br>
                            <p class="mt-2">Archive Permissions</p>
                            
                              <div class="col-md-6">
                                <label for="adviser_applications_check" class="form-label">
                                    <input type="checkbox" name="adviser_applications_check"  value="adviser_applications_check"  id="adviser_applications_check" class="" placeholder=""  />
                                     Adviser Applications
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="member_applications_check" class="form-label">
                                    <input type="checkbox" name="member_applications_check"  value="member_applications_check"  id="member_applications_check" class="" placeholder=""  />
                                     Member Applications
                                    </label>
                            </div>

                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Display User Data in a Table -->
    <div class="row">
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="dt-action-buttons text-end pt-6 pt-md-0">
                    <div class="dt-buttons btn-group">
                        <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#usercreate" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Record</span></span></button>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td><i class="ti ti-user ti-md text-danger me-4"></i><span class="fw-medium">{{$user->name}}</span></td>
                            <td>{{$user->email}}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td><span class="badge bg-label-primary me-1">{{$user->role}}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item waves-effect" data-bs-toggle="modal"
                                           data-bs-target="#useredit{{$user->id}}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('user-delete', ['id' => $user->id]) }}"><i class="ti ti-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Update User Modal -->
                        <div class="modal fade" id="useredit{{ $user->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('user-update', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-4">
                                                    <label for="nameBasic" class="form-label">Name</label>
                                                    <input type="text" value="{{ $user->name }}" name="name" class="form-control" placeholder="Enter Name" required />
                                                </div>
                                            </div>
                                            <div class="row g-4">
                                                <div class="col mb-0">
                                                    <label for="emailBasic" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="xxxx@xxx.xx" required />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select name="role" class="form-control" style="background-color: #2F3349; color: white;" required>
                                                     
                                                        
                                                         @if(auth()->user()->role !== 'adviser')
                                                         <option value="admin"{{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="it_admin" {{ $user->role == 'it_admin' ? 'selected' : '' }}>IT Admin</option>
                                    <option value="pre_approved_adviser_firm" {{ $user->role == 'pre_approved_adviser_firm' ? 'selected' : '' }}>Pre-approved Adviser Firm</option>
                                    <option value="advisor_firm" {{ $user->role == 'advisor_firm' ? 'selected' : '' }}>Adviser Firm</option>
                                    @endif
                                    <option value="adviser" {{ $user->role == 'adviser' ? 'selected' : '' }}>Adviser</option>
                                     @if(auth()->user()->role !== 'adviser')
                                    <option value="oasis_sipp" {{ $user->role == 'oasis_sipp' ? 'selected' : '' }}> Oasis SIPP</option>
                                    <option value="sipp_property" {{ $user->role == 'sipp_property' ? 'selected' : '' }}> SIPP Property</option>
                                    <option value="full_sipp_property" {{ $user->role == 'full_sipp_property' ? 'selected' : '' }}> Full SIPP Property</option>
                                    <option value="fpt" {{ $user->role == 'fpt' ? 'selected' : '' }}> FPT</option>
                                    @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Leave empty to keep current password" />
                                                </div>
                                            </div>
                                             <div class="row my-2">
                              <div class="col">
                                <label for="emailBasic" class="form-label">Firm Name</label>
                                <input type="text" name="firm_name" value="{{$user->firm_name}}" id="firm_name" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="">
                                <label for="email_notification" class="form-label">Email Notification</label>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="email_notification" id="email_notification_yes" value="yes" {{ $user->email_notification == 'yes' ? 'checked' : '' }}>
                                  <label class="form-check-label" for="email_notification_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="email_notification" id="email_notification_no" value="no" {{ $user->email_notification == 'no' ? 'checked' : '' }}>
                                  <label class="form-check-label" for="email_notification_no">No</label>
                                </div>
                            </div>
                             @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                                            
                                               <p class="mt-4"> Onshore Permissions</p>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="adviser_check" value="adviser_check" {{ $user->adviser_check ? 'checked' : '' }} id="adviser_check" class="" placeholder=""  />
                                    Onshore Registration From
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="adviser_pending" value="adviser_pending" {{ $user->adviser_pending ? 'checked' : '' }} id="adviser_pending" class="" placeholder=""  />
                                    Pending Onshore
                                    </label>
                            </div>
                             <div class="col-md-12">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="adviser_existing" value="adviser_existing" {{ $user->adviser_existing ? 'checked' : '' }} id="adviser_existing" class="" placeholder=""  />
                                    Existing Onshore
                                    </label>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="adviser_declined" value="adviser_declined" {{ $user->adviser_declined ? 'checked' : '' }} id="adviser_declined" class="" placeholder=""  />
                                    Declined Onshore
                                    </label>
                            </div>
                            <br>
                            <br>
                            
                            <p class="mt-4"> Offshore Permissions</p>
                            
                                    <div class="col-md-6">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="offshore_check" value="offshore_check" {{ $user->offshore_check ? 'checked' : '' }} id="offshore_check" class="" placeholder=""  />
                                    Offshore Registration From
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="offshore_pending" value="offshore_pending" {{ $user->offshore_pending ? 'checked' : '' }} id="offshore_pending" class="" placeholder=""  />
                                    Pending Offshore
                                    </label>
                            </div>
                             <div class="col-md-12">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="offshore_existing" value="offshore_existing" {{ $user->offshore_existing ? 'checked' : '' }} id="offshore_existing" class="" placeholder=""  />
                                    Existing Offshore
                                    </label>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <label for="adviser_check" class="form-label">
                                    <input type="checkbox" name="offshore_declined" value="offshore_declined" {{ $user->offshore_declined ? 'checked' : '' }} id="offshore_declined" class="" placeholder=""  />
                                    Declined Offshore
                                    </label>
                            </div>
                            <br>
                            <br>
                              @endif
                              <p class="mt-2">Member Application Permissions</p>
                              
                            <div class="col-md-6">
                                <label for="oasis_sipp__check" class="form-label">
                                    <input type="checkbox" name="oasis_sipp__check" value="oasis_sipp__check" {{ $user->oasis_sipp__check ? 'checked' : '' }} id="oasis_sipp__check" class="" placeholder=""  />
                                    Oasis SIPP
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="sipp_property_check" class="form-label">
                                    <input type="checkbox" name="sipp_property_check" value="sipp_property_check" {{ $user->sipp_property_check ? 'checked' : '' }} id="sipp_property_check" class="" placeholder=""  />
                                     SIPP Property
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="full_sipp_check" class="form-label">
                                    <input type="checkbox" name="full_sipp_check" value="full_sipp_check" {{ $user->full_sipp_check ? 'checked' : '' }} id="full_sipp_check" class="" placeholder=""  />
                                     Full SIPP Property
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="ftp_check" class="form-label">
                                    <input type="checkbox" name="ftp_check" id="ftp_check" value="ftp_check" {{ $user->ftp_check ? 'checked' : '' }} class="" placeholder=""  />
                                     FTP
                                    </label>
                            </div>
                             @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                             <div class="col-md-6">
                                <label for="ftp_check" class="form-label">
                                    <input type="checkbox" name="pending_applications" id="pending_applications" value="pending_applications" {{ $user->pending_applications ? 'checked' : '' }} class="" placeholder=""  />
                                     Pending Applications
                                    </label>
                            </div>
                             <div class="col-md-6">
                                <label for="ftp_check" class="form-label">
                                    <input type="checkbox" name="existing_applications" id="existing_applications" value="existing_applications" {{ $user->existing_applications ? 'checked' : '' }} class="" placeholder=""  />
                                     Existing Applications
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="ftp_check" class="form-label">
                                    <input type="checkbox" name="decline_applications" id="decline_applications" value="decline_applications" {{ $user->decline_applications ? 'checked' : '' }} class="" placeholder=""  />
                                     Decline Applications
                                    </label>
                            </div>
                            
                            <br>
                            <br>
                            
                            <p class="mt-2">Members Permissions</p>
                            
                            <div class="col-md-6">
                                <label for="illustration_check" class="form-label">
                                    <input type="checkbox" name="illustration_check" value="illustration_check" {{ $user->illustration_check ? 'checked' : '' }} id="illustration_check" class="" placeholder=""  />
                                     Illustration
                                    </label>
                            </div>
                            @endif
                             <div class="col-md-6">
                                <label for="member_details_check" class="form-label">
                                    <input type="checkbox" name="member_details_check" value="member_details_check" {{ $user->member_details_check ? 'checked' : '' }} id="member_details_check" class="" placeholder=""  />
                                     Member Details
                                    </label>
                            </div>
                              @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                             <br>
                             <br>
                             
                              <p class="mt-2">Management Permissions</p>
                             
                            <div class="col-md-6">
                                <label for="leads_check" class="form-label">
                                    <input type="checkbox" name="leads_check" value="leads_check" {{ $user->leads_check ? 'checked' : '' }} id="leads_check" class="" placeholder=""  />
                                     Leads
                                    </label>
                            </div>
                             
                            <div class="col-md-6">
                                <label for="user_management_check" class="form-label">
                                    <input type="checkbox" name="user_management_check" value="user_management_check" {{ $user->user_management_check ? 'checked' : '' }} id="user_management_check" class="" placeholder=""  />
                                     User Management
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="dms_check" class="form-label">
                                    <input type="checkbox" name="dms_check" id="dms_check" value="dms_check" {{ $user->dms_check ? 'checked' : '' }} class="" placeholder=""  />
                                     DMS
                                    </label>
                            </div>
                            
                             <div class="col-md-6">
                                <label for="reports_check" class="form-label">
                                    <input type="checkbox" name="reports_check" value="reports_check" {{ $user->reports_check ? 'checked' : '' }} id="reports_check" class="" placeholder=""  />
                                     Reports
                                    </label>
                            </div>
                            
                             <div class="col-md-12">
                                <label for="workflow_check" class="form-label">
                                    <input type="checkbox" name="workflow_check" value="workflow_check" {{ $user->workflow_check ? 'checked' : '' }} id="workflow_check" class="" placeholder=""  />
                                     WorkFLow
                                    </label>
                            </div>
                            
                            <br>
                            <br>
                            @endif
                            
                            <p class="mt-2">Support Permissions</p>
                            
                             <div class="col-md-6">
                                <label for="tickets_check" class="form-label">
                                    <input type="checkbox" name="tickets_check" value="tickets_check" {{ $user->tickets_check ? 'checked' : '' }} id="tickets_check" class="" placeholder=""  />
                                     Tickets 
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="support_check" class="form-label">
                                    <input type="checkbox" name="support_check" value="support_check" {{ $user->support_check ? 'checked' : '' }} id="support_check" class="" placeholder=""  />
                                     Supports
                                    </label>
                            </div>
                            <div class="col-md-12">
                                <label for="faq_check" class="form-label">
                                    <input type="checkbox" name="faq_check" value="faq_check" {{ $user->faq_check ? 'checked' : '' }} id="faq_check" class="" placeholder=""  />
                                     FAQ
                                    </label>
                            </div>
                            
                            <br>
                            <br>
                             @if(auth()->user()->role !== 'pre_approved_adviser_firm')
                             <p class="mt-2">Marketing Management Permissions</p>
                            
                              <div class="col-md-12">
                                <label for="communication_check" class="form-label">
                                    <input type="checkbox" name="communication_check" value="communication_check" {{ $user->communication_check ? 'checked' : '' }} id="communication_check" class="" placeholder=""  />
                                     Comunications
                                    </label>
                            </div>
                            <br>
                            <br>
                            <p class="mt-2">Archive Permissions</p>
                            
                              <div class="col-md-6">
                                <label for="adviser_applications_check" class="form-label">
                                    <input type="checkbox" name="adviser_applications_check"  value="adviser_applications_check" {{ $user->adviser_applications_check ? 'checked' : '' }}  id="adviser_applications_check" class="" placeholder=""  />
                                     Adviser Applications
                                    </label>
                            </div>
                            <div class="col-md-6">
                                <label for="member_applications_check" class="form-label">
                                    <input type="checkbox" name="member_applications_check"  value="member_applications_check" {{ $user->member_applications_check ? 'checked' : '' }}  id="member_applications_check" class="" placeholder=""  />
                                     Member Applications
                                    </label>
                            </div>
                            @endif
                        </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {
    const roleSelect = document.getElementById("role");
    const checkboxes = document.querySelectorAll("input[type='checkbox']");

    roleSelect.addEventListener("change", function () {
        if (this.value === "admin") {
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });

        } else if (this.value === "pre_approved_adviser_firm") {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            document.getElementById("adviser_check").checked = true;
            document.getElementById("offshore_check").checked = true;
            document.getElementById("tickets_check").checked = true;
            document.getElementById("support_check").checked = true;
            document.getElementById("faq_check").checked = true;

        } else if (this.value === "advisor_firm") {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            document.getElementById("oasis_sipp__check").checked = true;
            document.getElementById("sipp_property_check").checked = true;
            document.getElementById("full_sipp_check").checked = true;
            document.getElementById("ftp_check").checked = true;
            document.getElementById("member_details_check").checked = true;
            document.getElementById("user_management_check").checked = true;
            document.getElementById("tickets_check").checked = true;
            document.getElementById("support_check").checked = true;
            document.getElementById("faq_check").checked = true;

        } else if (this.value === "onshore_adviser" || this.value === "offshore_adviser") {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            document.getElementById("oasis_sipp__check").checked = true;
            document.getElementById("sipp_property_check").checked = true;
            document.getElementById("full_sipp_check").checked = true;
            document.getElementById("ftp_check").checked = true;
            document.getElementById("member_details_check").checked = true;
            document.getElementById("tickets_check").checked = true;
            document.getElementById("support_check").checked = true;
            document.getElementById("faq_check").checked = true;

        } else if (this.value === "oasis_sipp" || this.value === "sipp_property" || this.value === "full_sipp_property" || this.value === "fpt") {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            document.getElementById("member_details_check").checked = true;
            document.getElementById("tickets_check").checked = true;
            document.getElementById("support_check").checked = true;
            document.getElementById("faq_check").checked = true;

        } else {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    });
});
</script>


@section('script')
    <script src="public/assets/js/tables-datatables-advanced.js"></script>
@endsection
