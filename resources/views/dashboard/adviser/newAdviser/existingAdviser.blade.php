@extends('dashboard.dashboard')

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
                const alertElement = document.getElementById('successAlert') || document.getElementById('errorAlert');
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
                        <th>Company Name</th>
                        <th>Trading Names</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($existingAdviser as $index => $advisor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="fw-medium">{{ $advisor->company_name }}</span></td>
                            <td>{{ $advisor->trading_name }}</td>
                            <td>{{ $advisor->country }}</td>
                            <td>
                                @if ($advisor->deleted_at)
                                    <span class="badge bg-danger">Deleted</span>
                                @else
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle {{ $advisor->status === 'active' ? 'bg-success text-white' : ($advisor->status === 'declined' ? 'bg-danger text-white' : 'bg-warning text-dark') }}" type="button" id="statusDropdown{{ $advisor->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ ucfirst($advisor->status) }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $advisor->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('adviser-pending', ['id' => $advisor->id, 'status' => 'pending']) }}">
                                                    Pending
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('adviser-pending', ['id' => $advisor->id, 'status' => 'active']) }}">
                                                    Active
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('adviser-pending', ['id' => $advisor->id, 'status' => 'decline']) }}">
                                                    Decline
                                                </a>

                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item waves-effect" href="{{ route('newAdviser-edit', ['id' => $advisor->id]) }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('newAdviser-show', ['id' => $advisor->id]) }}"><i class="ti ti-eye me-1"></i> Show</a>
                                        
                                         <a class="dropdown-item waves-effect" href="{{ route('comment.index', ['id' => $advisor->id]) }}"><i class="ti ti-message-2"></i> message</a>

                                        @if (!$advisor->deleted_at)
                                            <form action="{{ route('newAdviser-delete', ['id' => $advisor->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this adviser?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item waves-effect"><i class="ti ti-trash me-1"></i> Delete</button>
                                            </form>
                                        @else
                                            <span class="dropdown-item disabled"><i class="ti ti-trash me-1"></i> Deleted</span>
                                        @endif
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
    <script src="{{ asset('assets/js/tables-datatables-advanced.js') }}"></script>
@endsection
