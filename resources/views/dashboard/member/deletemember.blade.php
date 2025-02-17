@extends('.dashboard.dashboard')

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

    <div class="row">
        <h3>Deleted Members</h3>
        <div class="card mb-4">
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deletedMembers as $index => $member)
                            @php
                                // Fetch the user based on the member's role field
                                $user = \App\Models\User::find($member->role); // Fetch the user by 'role'
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }} </td>
                                <td><span class="fw-medium">{{ $member->surname }}</span></td>
                                <td>{{ $user->role ?? 'No Role Assigned' }}</td>
                                <td>{{ $member->country }}</td>
                                <td><span class="badge bg-danger">Deleted</span></td>
                                <td>{{ $member->deleted_at->format('Y-m-d H:i:s') }}</td> <!-- Format the deleted_at timestamp -->
                                <td>
                                    <!-- Dropdown for Restore Action -->
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Restore option for Members -->
                                            <form action="{{ route('member-restore', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to restore this member?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="dropdown-item waves-effect"><i class="ti ti-restore me-1"></i> Restore</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h4>FPT Deleted Members</h4>
        <div class="card mb-4">
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deletedFpt as $index => $Fpt)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="fw-medium">{{ $Fpt->scheme_name }}</span></td>
                                <td>{{ $Fpt->email }}</td>
                                <td>{{ $Fpt->country }} </td>
                                <td>{{ $Fpt->created_at }}</td>
                                <td>
                                    <span class="badge bg-danger">Deleted</span>
                                </td>
                                <td>
                                    <!-- Dropdown for Restore Action for FPT -->
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Restore option for FPT -->
                                            <form action="{{ route('fpt-restore', $Fpt->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="dropdown-item waves-effect">
                                                    <i class="ti ti-restore me-1"></i> Restore
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Include any specific scripts needed for this page -->
@endsection
