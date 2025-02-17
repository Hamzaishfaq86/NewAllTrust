 @extends('dashboard.dashboard')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<style>
    chatgpt-sidebar-popups {
        display:none;
    }
</style>

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

    <div class="row px-3">
        <div class="card">
            <div class="card-header">
                <h4>Dms Create</h4>
            </div>
          <div class="card-body">
    <form action="{{ route('dms.update', ['id' => $dms->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" value="{{ $dms->name }}" placeholder="Enter name" class="form-control" />
        </div>

        <!-- Reference Link Input -->
        <div class="mb-3">
            <label for="reference_link" class="form-label">Reference</label>
            <input type="text" id="reference_link" name="reference_link" value="{{ $dms->reference_link }}" placeholder="Enter reference" class="form-control" />
        </div>

        <!-- Image Upload (Dropzone) -->
        <div class="col-md-12 mb-3">
            <label  for="">Multiple File Uplode</label>
             @php
                $data = $dms->dropzone_multifiles;
                $multiple = json_decode($data);
            @endphp
            
            
           
            
            <input type="file" multiple name="dropzone_multifiles[]" class="form-control" required />
            
             @if($data)
                @foreach($multiple as $file)
                <span class="my-3">
                    <a href="{{$file}}" class="my-5"><i class="ti ti-file" style="font-size:25px;"></i></a> 
                </span>
                    
               
                    
                @endforeach
            @endif
            
            <input type="hidden" name="old" value="{{$data}}">
        </div>

        <!-- Hidden Input to Capture Uploaded File Paths -->
        <input type="hidden" name="file_paths" id="filePaths" value="" />

        <!-- Submit Button -->
        <div class="mt-4">
            <input type="submit" value="Submit" class="btn btn-success" />
        </div>
    </form>
</div>
        </div>
    </div>


@endsection
