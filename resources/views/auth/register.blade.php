@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 guest-welcome-box">
                <h5 class="mb-0" style="text-align: center">Sign Up</h5>
                <div class="mb-3" align="center">
                    <a style="font-size: 10pt;" href="{{ url('/login') }}">
                        {{ __('Already Have An Account?') }}
                    </a>
                </div>
                @include('auth.signup-form')
            </div>
        </div>
    </div>
@endsection
