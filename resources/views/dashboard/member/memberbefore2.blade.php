@extends('dashboard.dashboard')
@section('content')
    
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-body text-center p-5">
                    <h3 class="">Thank You for Choosing Alltrust!</h2>
                    <p class="my-5">
                        It will take you approximately <strong>30 minutes</strong> to complete this application.
                        Please make sure that you have the following information ready:
                    </p>
                    <ul class="list-unstyled mt-3">
                        <li>🔹 <strong>NI Number</strong></li>
                        <li>🔹 <strong>Benefit Information</strong></li>
                        <li>🔹 <strong>Originating Scheme Information</strong> (if applicable)</li>
                        <li>🔹 <strong>Beneficiary(s)</strong></li>
                        <li>🔹 <strong>Underlying Investment Information</strong></li>
                    </ul>
                    <p class="my-5">
                        Upon submission, the applicant will receive an email with login details for the 
                        <strong>Member Area</strong>, including a temporary password and a link to our 
                        <strong>Alltrust ID Pal</strong>, where identification and address documents can be uploaded.
                    </p>
                    <p class="my-5">
                        If you have any questions, please contact us at  
                        <a href="mailto:newbusiness@alltrust.co.uk" class="text-primary font-weight-bold">
                            newbusiness@alltrust.co.uk
                        </a>
                    </p>
                    <!-- Start Application Button -->
                    <a href="{{ route('member-sipp-create') }}" class="btn btn-primary mt-4 px-4 py-2 font-weight-bold">
                        Start Application 🚀
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection