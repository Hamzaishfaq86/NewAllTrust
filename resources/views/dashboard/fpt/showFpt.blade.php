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
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Member</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fptView as $index => $show)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="fw-medium">{{ $show->surname }}</span></td>
                            <td>{{ $show->role }}</td>
                            <td>{{ $show->country }}</td>
{{--                            <td>--}}
{{--                                @if ($member->status === 'active')--}}
{{--                                    <span class="badge bg-success">{{ $member->status }}</span>--}}
{{--                                @elseif ($member->status === 'pending')--}}
{{--                                    <span class="badge bg-warning text-dark">{{ $member->status }}</span>--}}


{{--                                @endif--}}
{{--                            </td>--}}

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                                                                <a class="dropdown-item waves-effect" href="{{ route('fpt-view', ['id' => $show->id]) }}" ><i class="ti ti-pencil me-1"></i> Edit</a>
                                       {{--  @if (!$adviser->deleted_at)
                                            <form action="{{ route('newAdviser-delete', ['id' => $adviser->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this adviser?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item waves-effect"><i class="ti ti-trash me-1"></i> Delete</button>
                                            </form>
                                        @else
                                            <span class="dropdown-item disabled"><i class="ti ti-trash me-1"></i> Deleted</span>
                                        @endif --}}
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
