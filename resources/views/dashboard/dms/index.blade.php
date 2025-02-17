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
 
    <div class="card">
        <div class="card-header flex-column flex-md-row">
            <div class="dt-action-buttons text-end pt-6 pt-md-0">
                <div class="dt-buttons btn-group">
                    <a href="{{ route('dms.create')}}" class="btn btn-secondary create-new btn-primary waves-effect waves-light">
                        <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New DMS</span></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-datatable table-responsive">
            <table class="dt-responsive table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Reference</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dms as $index => $dm)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dm->name }}</td>
                            <td>{{ $dm->reference_link }}</td>
                            
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item waves-effect" href="{{ route('dms.edit', ['id' => $dm->id]) }}">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item waves-effect" data-bs-toggle="modal" data-bs-target="#viewcustomer{{$dm->id}}">
                                            <i class="ti ti-eye"></i> View
                                        </a>
                                        <a class="dropdown-item waves-effect" href="{{ route('dms.delete', ['id' => $dm->id]) }}">
                                            <i class="ti ti-trash me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
               <div class="modal fade" id="viewcustomer{{$dm->id}}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel1">View DMS</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body my-5" style="padding: 0px !important">
                            <div class="modal-body">
                                <h6>Basic Information</h6>
                                <p><strong>Company Name:</strong> {{ $dm->name }}</p>
                                <p><strong>Role:</strong> {{ $dm->reference_link }}</p>
                                <p>Uploaded Files:</p>
                                @php
                                    $data = $dm->dropzone_multifiles;
                                    $multiple = json_decode($data);
                                @endphp
                                
                                @if($data)
                                    @foreach($multiple as $file)
                                        <div class="my-3">
                                            <a href="{{ $file }}" class="d-block" target="_blank">
                                                <i class="ti ti-file" style="font-size: 40px;"></i>
                                            </a>
                                            <p>{{ basename($file) }}</p>
                                        </div>
                                    @endforeach
                                @endif
                                
                                <input type="hidden" name="old" value="{{ $data }}">
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
               {{-- End Customer Modal --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
