@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address and Code') }}</div>

                    <div class="card-body">
                        <!-- If email has been verified and code is not verified -->
                        @if (!Auth::user()->hasVerifiedEmail() && !Auth::user()->verification_code)
                            {{ __('Before proceeding, please check your email for a verification link to verify your email address.') }}
                            {{ __('If you did not receive the email') }},
{{--                            <form class="d-inline" method="POST" action="{{ route('verification.notice') }}">--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.--}}
{{--                            </form>--}}

                            <!-- If email is verified, but code is not yet verified -->
                        @elseif (Auth::user()->hasVerifiedEmail() && !Auth::user()->verification_code)
                            <h5 class="mb-3">{{ __('Please enter the 2FA verification code sent to your email') }}</h5>
                            <!-- Form to submit 2FA code -->
                            <form method="POST" action="{{ route('verify.code') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="verification_code">Verification Code</label>
                                    <input type="text" id="verification_code" name="verification_code" class="form-control" required>

                                    @error('verification_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Verify Code</button>
                            </form>

                            <!-- If both email and code are verified -->
                        @elseif (Auth::user()->hasVerifiedEmail() && Auth::user()->verification_code_verified)
                            <div class="alert alert-success">
                                {{ __('Your email and verification code have been successfully verified.') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
