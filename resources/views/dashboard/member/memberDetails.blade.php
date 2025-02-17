@extends('.dashboard.dashboard')

@section('content')
    <!-- Modal -->

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

    <div class="modal fade" id="usercreate" tabindex="-1" aria-hidden="true">

    </div>

    <div class="row">
        <div class="card">
            <!--<div class="text-left my-3">-->
            <!--    <a class="btn btn-primary" href="{{route('add-member-detail')}}">Add New</a>-->
            <!--</div>-->
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member Name</th>
                        <th>Tax Information Number</th>
                        <th>National Insurance Number</th>
                        <th>Date of Birth</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($memberDetails as $index => $details)
                    @php
                    $user = app\Models\User::find($details->role);
                    @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="fw-medium">{{ $user->name }}</span></td>
                            <td>{{ $details->tax_information_number }}</td>
                            <td>{{ $details->national_insurance_number }}</td>
                            <td>{{ $details->dob }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!--<a class="dropdown-item waves-effect" href="{{ route('members-details-edit', ['id' => $details->id]) }}" ><i class="ti ti-pencil me-1"></i> Edit</a>-->
                                        <a class="dropdown-item waves-effect" href="{{ route('members-details-view', ['id' => $details->id]) }}" ><i class="fas fa-eye me-1"></i> View</a>
                                      
                                        <!--<a class="dropdown-item waves-effect" href="{{ route('member-details-delete', ['id' => $details->id]) }}" onclick="return confirm('Are you sure you want to delete this Members Details?');"><i class="ti ti-trash me-1"></i> Delete</a>-->
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Update Modal -->

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="card">
            <!--<div class="text-left my-3">-->
            <!--    <a class="btn btn-primary" href="{{route('add-member-detail')}}">Add New</a>-->
            <!--</div>-->
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member Name</th>
                        <th>Tax Information Number</th>
                        <th>National Insurance Number</th>
                        <th>Date of Birth</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ftpmemberDetails as $index => $details)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="fw-medium">{{ $details->forename }}, {{ $details->surname }}</span></td>
                            <td>{{ $details->tax_information_number }}</td>
                            <td>{{ $details->national_insurance_number }}</td>
                            <td>{{ $details->dob }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!--<a class="dropdown-item waves-effect" href="{{ route('members-details-edit', ['id' => $details->id]) }}" ><i class="ti ti-pencil me-1"></i> Edit</a>-->
                                        <a class="dropdown-item waves-effect" href="{{ route('members-details-view-ftp', ['id' => $details->id]) }}" ><i class="fas fa-eye me-1"></i> View</a>
                                      
                                        <!--<a class="dropdown-item waves-effect" href="{{ route('member-details-delete', ['id' => $details->id]) }}" onclick="return confirm('Are you sure you want to delete this Members Details?');"><i class="ti ti-trash me-1"></i> Delete</a>-->
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Update Modal -->

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="public/assets/js/tables-datatables-advanced.js"></script>
@endsection
