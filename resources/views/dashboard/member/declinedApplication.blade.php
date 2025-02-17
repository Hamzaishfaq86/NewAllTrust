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
                        <th>Action</th>
                    </tr>
                    </thead>
                  <tbody>
    @foreach($declinedMember as $index => $member)
        @php
            // Fetch the user based on the member's role field
            $user = \App\Models\User::find($member->role); // Fetch the user by 'role'
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td><span class="fw-medium">{{ $member->surname }}</span></td>
            <td>{{ $user->role ?? 'No Role Assigned' }}</td> <!-- Safely access the user's role -->
            <td>{{ $member->country }}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle {{ $member->status === 'active' ? 'bg-success text-white' : 'bg-danger text-white' }}" type="button" id="statusDropdown{{ $member->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ ucfirst($member->status) }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $member->id }}">
                        <li>
                            <a class="dropdown-item" href="{{ route('member-pending', ['id' => $member->id, 'status' => 'pending']) }}">
                                Pending
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('member-pending', ['id' => $member->id, 'status' => 'active']) }}">
                                Active
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('member-pending', ['id' => $member->id, 'status' => 'decline']) }}">
                                Decline
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item waves-effect" href="{{ route('members-oasis-edit', ['id' => $member->id]) }}">
                            <i class="ti ti-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('members-delete', $member->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item waves-effect" onclick="return confirm('Are you sure you want to delete this member?');">
                                                    <i class="ti ti-trash me-1"></i> Delete
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

        <div class="card my-5">
    <h5 class="py-4">FPT Table</h5>
    <div class="card-datatable table-responsive">
        <table class="dt-responsive table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                      @foreach($declinedFpt as $index => $member)
                            @php
                                // Fetch the user based on the member's role field
                                $user = \App\Models\User::find($member->name); // Fetch the user by 'role'
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $member->scheme_name }}</td>
                                <td>{{ $member->user->role_member ?? 'No Role Assigned' }}</td> <!-- Safely access the user's role -->
                                <td>{{ $member->country }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle {{ $member->status === 'active' ? 'bg-success text-white' : 'bg-danger text-white' }}" type="button" id="statusDropdown{{ $member->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ ucfirst($member->status) }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $member->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('fpt-pending', ['id' => $member->id, 'status' => 'pending']) }}">
                                                    Pending
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('fpt-pending', ['id' => $member->id, 'status' => 'active']) }}">
                                                    Active
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('fpt-pending', ['id' => $member->id, 'status' => 'decline']) }}">
                                                    Decline
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="{{ route('fptt-edit', ['id' => $member->id]) }}">
                                                <i class="ti ti-pencil me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('fpt-delete', $member->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item waves-effect" onclick="return confirm('Are you sure you want to delete this member?');">
                                                    <i class="ti ti-trash me-1"></i> Delete
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
    <script src="public/assets/js/tables-datatables-advanced.js"></script>
@endsection
