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
                const alertElement = document.getElementById('successAlert') || document.getElementById('errorAlert');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    setTimeout(() => alertElement.remove(), 200);
                }
            }, 6000);
        </script>
    </div>

    <div class="row my-5">
        <div class="card">
            <h4 class="card-header">Onshore Advisors</h4>
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Trading Names</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($onshores as $index => $adviser)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="fw-medium">{{ $adviser->company_name }}</span></td>
                            <td>{{ $adviser->contact_email }}</td>
                            <td>{{ $adviser->country }}</td>
                            <td>{{ $adviser->trading_name }}</td>
                            <td>{{ $adviser->created_at }}</td>
                            <td>
                                <span class="badge bg-danger">Deleted</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Only show Restore option -->
                                        <form action="{{ route('adviser-restore', ['id' => $adviser->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to restore this adviser?');">
                                            @csrf
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
    </div>
    
    
    
    <div class="row my-5">
        <div class="card">
            <h4 class="card-header">Offshore Advisors</h4>
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Trading Names</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offshores as $index => $adviser)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="fw-medium">{{ $adviser->company_name }}</span></td>
                            <td>{{ $adviser->contact_email }}</td>
                            <td>{{ $adviser->country }}</td>
                            <td>{{ $adviser->trading_name }}</td>
                            <td>{{ $adviser->created_at }}</td>
                            <td>
                                <span class="badge bg-danger">Deleted</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Only show Restore option -->
                                        <form action="{{ route('adviser-restore', ['id' => $adviser->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to restore this adviser?');">
                                            @csrf
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
    </div>
@endsection

@section('script')
    <script src="public/assets/js/tables-datatables-advanced.js"></script>
@endsection
