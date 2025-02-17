@extends('.dashboard.dashboard')

<style>
 
</style>

@section('content')

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                backdrop: true,
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Try Again',
                backdrop: true,
            });
        </script>
    @endif

    <div class="row" >
        <div class=" px-3 gx-4">
            <div class="col-12">
                <div class="row " >
                    <!-- Content wrapper -->
                    <div class="content-wrapper" >
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y"  > 
                            <div class="row overflow-hidden" >
                                <div class="col-12">
                                    <ul class="timeline timeline-center "  >
                                        @foreach($comments as $comment)
                                            <li class="timeline-item">
                                        <span class="timeline-indicator timeline-indicator-primary" data-aos="zoom-in" data-aos-delay="200">
                                            <i class="ti ti-brush"></i>
                                        </span>
                                                <div class="timeline-event card p-0" data-aos="fade-right">
                                                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                                                         
                                                        <div class="meta d-flex">
                                                             
                                                            <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="id" value="{{ $comment->id }}">
                                                                <button type="submit" class="border-0 badge rounded-pill bg-label-danger me-1">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-2">{{ $comment->comment }}</p>
                                                    </div>
                                                    <div class="timeline-event-time">{{ $comment->created_at }}</div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                 <div class="col-12">
                                   <div class="comment-ft"   >
                                        <div class="row  "  >
                                            <!-- Form to create or edit comment -->
    @if(isset($commentToEdit)) <!-- Check if a comment is being edited -->
    <form action="{{ route('comment.update', ['id' => $commentToEdit->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="comment_user_id" value="{{ $commentToEdit->comment_user_id }}">
        <textarea class="form-control w-100 p-3" name="comment" style="height: 95px;">{{ old('comment', $commentToEdit->comment) }}</textarea>
        <input type="submit" class="btn btn-success form-control mt-4" value="Update Comment">
    </form>
    @else
    <!-- Form to create a new comment -->
    <form action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="comment_user_id" value="{{ $comment_user_id }}" />
        <textarea class="form-control w-100 p-3" name="comment" placeholder="Write your comment here..." style="height: 95px;">{{ old('comment') }}</textarea>
        <input type="submit" class="btn btn-success form-control mt-4" value="Add Note">
    </form>
    @endif
                                    </div>
                                   </div>
                                 </div>

                            </div>

                        </div>
                        <!-- / Content -->

                        <!--<div class="content-backdrop fade"></div>-->
                    </div>
                    <!-- Content wrapper -->
                </div>
            </div>
        </div>
    </div>

@endsection
