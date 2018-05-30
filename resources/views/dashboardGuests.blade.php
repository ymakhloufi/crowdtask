@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 content-box">
                <div class="row">
                    <div class="col-md-6 login-left">
                        <h5 class="mb-0" style="text-align: center">I Have An Account</h5>
                        @include('auth.login-form')
                    </div>
                    <div class="col-md-6">
                        <h5 style="text-align: center">I Am New Here</h5>
                        @include('auth.signup-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
