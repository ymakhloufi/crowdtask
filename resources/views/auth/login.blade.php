@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 guest-welcome-box">
                <h5 class="mb-0" style="text-align: center">Login</h5>
                @include('auth.login-form')
            </div>
        </div>
    </div>
@endsection
