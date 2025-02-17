@extends('dashboard.dashboard')

@section('content')
<div class="content-header mb-6">
    <h4 class="mb-0">Declined Advisers</h4>
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
                @foreach($declinedAdvisers as $index => $adviser)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="fw-medium">{{ $adviser->company_name }}</span></td>
                        <td>{{ $adviser->trading_name }}</td>
                        <td>{{ $adviser->country }}</td>
                        <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle {{ $adviser->status === 'active' ? 'bg-success text-white' : 'bg-danger text-white' }}" type="button" id="statusDropdown{{ $adviser->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ ucfirst($adviser->status) }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $adviser->id }}">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('adviser-pending', ['id' => $adviser->id, 'status' => 'pending']) }}">
                                                Pending
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('adviser-pending', ['id' => $adviser->id, 'status' => 'active']) }}">
                                                Active
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('adviser-pending', ['id' => $adviser->id, 'status' => 'decline']) }}">
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
                                        <a class="dropdown-item waves-effect" href="{{ route('newAdviser-edit', ['id' => $adviser->id]) }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('newAdviser-show', ['id' => $adviser->id]) }}"><i class="ti ti-eye me-1"></i> Show</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('comment.index', ['id' => $adviser->id]) }}"><i class="ti ti-message-2"></i> message</a>
                                        @if (!$adviser->deleted_at)
                                            <form action="{{ route('newoffshore-delete', ['id' => $adviser->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this adviser?');">
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
