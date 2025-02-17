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
            setTimeout(() => {
                const alertElement = document.querySelector('.alert');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    setTimeout(() => alertElement.remove(), 200);
                }
            }, 6000);
        </script>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Country</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deletedMembers as $index => $Fpt)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="fw-medium">{{ $Fpt->name }}</span></td>
                                <td>{{ $Fpt->role }}</td>
                                <td>{{ $Fpt->country }}</td>
                                <td>{{ $Fpt->created_at }}</td>
                                <td>
                                    @if($Fpt->status === 'active')
                                        <span class="badge bg-success">{{ $Fpt->status }}</span>
                                    @elseif($Fpt->status === 'pending')
                                        <span class="badge bg-warning text-dark">{{ $Fpt->status }}</span>
                                    @else
                                        <span class="badge bg-danger">Deleted</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- Uncomment and use these routes as needed --}}
                                            {{-- <a class="dropdown-item waves-effect" href="{{ route('members-details-edit', ['id' => $Fpt->id]) }}"><i class="ti ti-pencil me-1"></i> Edit</a> --}}
                                            {{-- <a class="dropdown-item waves-effect" href="{{ route('members-details-view', ['id' => $Fpt->id]) }}"><i class="ti ti-eye me-1"></i> View</a> --}}
                                            <a class="dropdown-item waves-effect" href="#" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $Fpt->id }}').submit();">
                                                <i class="ti ti-arrow-circle-left me-1"></i> Restore
                                            </a>
                                            <form id="restore-form-{{ $Fpt->id }}" method="POST" action="{{ route('member-restore', $Fpt->id) }}" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            <a class="dropdown-item waves-effect" href="{{ route('member-details-delete', ['id' => $Fpt->id]) }}" onclick="return confirm('Are you sure you want to delete this Member permanently?');">
                                                <i class="ti ti-trash me-1"></i> Delete Permanently
                                            </a>
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
    <script src="{{ asset('public/assets/js/tables-datatables-advanced.js') }}"></script>
@endsection
