@extends('.dashboard.dashboard')

@section('content')

<style>
    .checkbox-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 30px;
    }
    .checkbox-container label {
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }
</style>

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
                    @foreach($advisers as $index => $adviser)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="fw-medium">{{ $adviser->company_name }}</span></td>
                            <td>{{ $adviser->trading_name }}</td>
                            <td>{{ $adviser->country }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle {{ $adviser->status === 'active' ? 'bg-success text-white' : 'bg-warning text-white' }}" type="button" id="statusDropdown{{ $adviser->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ ucfirst($adviser->status) }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $adviser->id }}">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('offshore-pending', ['id' => $adviser->id, 'status' => 'pending']) }}">
                                                Pending
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('offshore-pending', ['id' => $adviser->id, 'status' => 'active']) }}">
                                                Active
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('offshore-pending', ['id' => $adviser->id, 'status' => 'decline']) }}">
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
                                        <a class="dropdown-item waves-effect" href="{{ route('newoffshore-edit', ['id' => $adviser->id]) }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('newoffshore-show', ['id' => $adviser->id]) }}"><i class="ti ti-eye me-1"></i> Show</a>
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
                                        <a class="dropdown-item waves-effect" data-bs-toggle="modal" data-bs-target="#country{{$adviser->id}}"><i class="ti ti-message-2"></i>Country</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Update Modal -->
                        <div class="modal fade" id="country{{$adviser->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Add Country</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('offshore.countryStore') }}" method="POST">
                                        
                                        @php
                                            $selectedCountries = isset($adviser->admin_country) ? json_decode($adviser->admin_country, true) : [];
                                        @endphp
                                        
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="hidden" name="id" value="{{$adviser->id}}">
                                                <div class="checkbox-container">
                                                    <label><input type="checkbox" name="admin_country[]" value="AU" {{ in_array('AU', $selectedCountries) ? 'checked' : '' }}> Australia (AU)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="AT" {{ in_array('AT', $selectedCountries) ? 'checked' : '' }}> Austria (AT)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="BAHR" {{ in_array('BAHR', $selectedCountries) ? 'checked' : '' }}> Bahrain (BAHR)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="BE" {{ in_array('BE', $selectedCountries) ? 'checked' : '' }}> Belgium (BE)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="CA" {{ in_array('CA', $selectedCountries) ? 'checked' : '' }}> Canada (CA)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="CH" {{ in_array('CH', $selectedCountries) ? 'checked' : '' }}> Switzerland (CH)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="CN" {{ in_array('CN', $selectedCountries) ? 'checked' : '' }}> China (CN)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="CY" {{ in_array('CY', $selectedCountries) ? 'checked' : '' }}> Cyprus (CY)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="CZ" {{ in_array('CZ', $selectedCountries) ? 'checked' : '' }}> Czech Republic (CZ)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="DK" {{ in_array('DK', $selectedCountries) ? 'checked' : '' }}> Denmark (DK)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="FI" {{ in_array('FI', $selectedCountries) ? 'checked' : '' }}> Finland (FI)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="FR" {{ in_array('FR', $selectedCountries) ? 'checked' : '' }}> France (FR)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="DE" {{ in_array('DE', $selectedCountries) ? 'checked' : '' }}> Germany (DE)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="ER" {{ in_array('ER', $selectedCountries) ? 'checked' : '' }}> Eritrea (ER)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="ES" {{ in_array('ES', $selectedCountries) ? 'checked' : '' }}> Spain (ES)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="HK" {{ in_array('HK', $selectedCountries) ? 'checked' : '' }}> Hong Kong (HK)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="IND" {{ in_array('IND', $selectedCountries) ? 'checked' : '' }}> India (IND)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="IT" {{ in_array('IT', $selectedCountries) ? 'checked' : '' }}> Italy (IT)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="KW" {{ in_array('KW', $selectedCountries) ? 'checked' : '' }}> Kuwait (KW)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="LUX" {{ in_array('LUX', $selectedCountries) ? 'checked' : '' }}> Luxembourg (LUX)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="MY" {{ in_array('MY', $selectedCountries) ? 'checked' : '' }}> Malaysia (MY)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="MT" {{ in_array('MT', $selectedCountries) ? 'checked' : '' }}> Malta (MT)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="NL" {{ in_array('NL', $selectedCountries) ? 'checked' : '' }}> Netherlands (NL)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="NO" {{ in_array('NO', $selectedCountries) ? 'checked' : '' }}> Norway (NO)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="NZ" {{ in_array('NZ', $selectedCountries) ? 'checked' : '' }}> New Zealand (NZ)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="OM" {{ in_array('OM', $selectedCountries) ? 'checked' : '' }}> Oman (OM)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="PHL" {{ in_array('PHL', $selectedCountries) ? 'checked' : '' }}> Philippines (PHL)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="PT" {{ in_array('PT', $selectedCountries) ? 'checked' : '' }}> Portugal (PT)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="QT" {{ in_array('QT', $selectedCountries) ? 'checked' : '' }}> Qatar (QT)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="RO" {{ in_array('RO', $selectedCountries) ? 'checked' : '' }}> Romania (RO)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="SA" {{ in_array('SA', $selectedCountries) ? 'checked' : '' }}> Saudi Arabia (SA)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="SG" {{ in_array('SG', $selectedCountries) ? 'checked' : '' }}> Singapore (SG)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="SW" {{ in_array('SW', $selectedCountries) ? 'checked' : '' }}> Sweden (SW)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="TH" {{ in_array('TH', $selectedCountries) ? 'checked' : '' }}> Thailand (TH)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="UAE" {{ in_array('UAE', $selectedCountries) ? 'checked' : '' }}> United Arab Emirates (UAE)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="UK" {{ in_array('UK', $selectedCountries) ? 'checked' : '' }}> United Kingdom (UK)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="US" {{ in_array('US', $selectedCountries) ? 'checked' : '' }}> United States (US)</label>
                                                    <label><input type="checkbox" name="admin_country[]" value="ZA" {{ in_array('ZA', $selectedCountries) ? 'checked' : '' }}> South Africa (ZA)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create Country</button>
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
