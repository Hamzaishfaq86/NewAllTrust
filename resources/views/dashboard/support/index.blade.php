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

    <div class="modal fade" id="usercreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add Support</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('support-store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" required />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="technical_support">Technical Support</option>
                                    <option value="billing">Billing</option>
                                    <option value="account_management">Account Management</option>
                                    <option value="general_inquiries">General Inquiries</option>
                                </select>
                            </div>
                        </div>
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="details" class="form-label">Details</label>
                                <textarea name="details" id="details" class="form-control" placeholder="Enter Details" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Support</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="dt-action-buttons text-end pt-6 pt-md-0">
                    <div class="dt-buttons btn-group">
                        <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#usercreate" type="button">
                            <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Record</span></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supports as $index => $support)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="fw-medium">{{ $support->title }}</span></td>
                                <td>{{ $support->category }}</td>
                                <td>{{ $support->details }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" data-bs-toggle="modal" data-bs-target="#useredit{{ $support->id }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                            <a class="dropdown-item waves-effect" href="{{ route('support-delete', ['id' => $support->id]) }}"><i class="ti ti-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Update Modal -->
                            <div class="modal fade" id="useredit{{ $support->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Edit Support</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('support-update', ['id' => $support->id]) }}" method="post">
                                            @csrf
                                            <!-- Add hidden field to specify PUT method -->
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="modal-body">
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" name="title" value="{{ $support->title }}" id="title" class="form-control" placeholder="Enter Title" required />
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label for="category" class="form-label">Category</label>
                                                        <select name="category" id="category" class="form-control" required>
                                                            <option value="technical_support" {{ $support->category == 'technical_support' ? 'selected' : '' }}>Technical Support</option>
                                                            <option value="billing" {{ $support->category == 'billing' ? 'selected' : '' }}>Billing</option>
                                                            <option value="account_management" {{ $support->category == 'account_management' ? 'selected' : '' }}>Account Management</option>
                                                            <option value="general_inquiries" {{ $support->category == 'general_inquiries' ? 'selected' : '' }}>General Inquiries</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label for="details" class="form-label">Details</label>
                                                        <textarea name="details" id="details" class="form-control" placeholder="Enter Details" required>{{ $support->details }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Support</button>
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

@section('script')
    <script src="public/assets/js/tables-datatables-advanced.js"></script>
@endsection
