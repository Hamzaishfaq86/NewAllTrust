@extends('.dashboard.dashboard')

@section('content')
    <!-- Modal for Success/Error Alerts -->
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

    <!-- Modal for Creating New Ticket -->
    <div class="modal fade" id="usercreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('ticket-store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" id="category" class="form-control" style="background-color: #2D324A; color: white;">
                                    <option value="technical_support">Technical Support</option>
                                    <option value="customer_service">Customer Service</option>
                                    <option value="billing_inquiries">Billing and Account Inquiries</option>
                                    <option value="product_feedback">Product Information or Feedback</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="details" class="form-label">Details</label>
                                <textarea name="details" id="details" class="form-control" placeholder="Enter Details"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Displaying All Tickets -->
    <div class="row">
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="dt-action-buttons text-end pt-6 pt-md-0">
                    <div class="dt-buttons btn-group">
                        <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#usercreate" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                            <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Record</span></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="dt-responsive table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $index => $ticket)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-medium">{{ $ticket->title }}</span>
                                </td>
                                <td>{{ $ticket->category }}</td>
                                <td>{{ $ticket->details }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" data-bs-toggle="modal" data-bs-target="#useredit{{ $ticket->id }}">
                                                <i class="ti ti-pencil me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item waves-effect" href="{{ route('ticket-delete', ['id' => $ticket->id]) }}" onclick="return confirm('Are you sure you want to delete this ticket?');">
                                                <i class="ti ti-trash me-1"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal for Editing Ticket -->
                            <div class="modal fade" id="useredit{{ $ticket->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Ticket</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('ticket-update', ['id' => $ticket->id]) }}" method="post">
                                            @csrf
                                            @method('PUT') <!-- Spoofing the PUT method for update -->
                                            <div class="modal-body">
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" name="title" value="{{ $ticket->title }}" id="title" class="form-control" placeholder="Enter Title" />
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label for="category" class="form-label">Category</label>
                                                        <select name="category" id="category" class="form-control" style="background-color: #2F3349; color: white;">
                                                            <option value="technical_support" {{ $ticket->category == 'technical_support' ? 'selected' : '' }}>Technical Support</option>
                                                            <option value="customer_service" {{ $ticket->category == 'customer_service' ? 'selected' : '' }}>Customer Service</option>
                                                            <option value="billing_inquiries" {{ $ticket->category == 'billing_inquiries' ? 'selected' : '' }}>Billing and Account Inquiries</option>
                                                            <option value="product_feedback" {{ $ticket->category == 'product_feedback' ? 'selected' : '' }}>Product Information or Feedback</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label for="details" class="form-label">Details</label>
                                                        <textarea name="details" id="details" class="form-control" placeholder="Enter Details">{{ $ticket->details }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Ticket</button>
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
