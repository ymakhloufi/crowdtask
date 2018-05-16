@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 guest-welcome-box">
                <div class="row">
                    @include('auth.login-form')
                    @include('auth.signup-form')
                </div>
            </div>
        </div>
    </div>
@endsection
