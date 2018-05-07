<div class="col-md-6">
    <h5 style="text-align: center">I Am New Here</h5>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group">
            <span class="input-group-addon"><label for="_name"><i class="fa fa-user"></i></label></span>
            <input id="_name"
                   class="form-control {{$errors->has('_name') ? 'is-invalid' : ''}}"
                   type="text"
                   name="_name"
                   value="{{ old('_name') }}"
                   placeholder="Your Name"
                   required/>
        </div>
        @if ($errors->has('_name'))
            <span class="text-danger">{{ $errors->first('_name') }}</span>
        @endif
        <div class="input-group mt-2">
            <span class="input-group-addon"><label for="_email"><i class="fa fa-envelope"></i></label></span>
            <input id="_email"
                   class="form-control {{$errors->has('_email') ? 'is-invalid' : ''}}"
                   type="email"
                   name="_email"
                   value="{{ old('_email') }}"
                   placeholder="Email"
                   required/>
        </div>
        @if ($errors->has('_email'))
            <span class="text-danger">{{ $errors->first('_email') }}</span>
        @endif
        <div class="input-group mt-2">
            <span class="input-group-addon" style=""><label for="_password"><i class="fa fa-key"></i></label></span>
            <input id="_password"
                   class="form-control {{$errors->has('_password') ? 'is-invalid' : ''}}"
                   type="password"
                   name="_password"
                   value="{{ old('_password') }}"
                   placeholder="Password"
                   required/>
        </div>
        @if ($errors->has('_password'))
            <span class="text-danger">{{ $errors->first('_password') }}</span>
        @endif

        <div align="center">
            <button type="submit" class="btn btn-primary mt-3">
                {{ __('Sign Up') }}
            </button>
        </div>
    </form>
</div>
