<div class="col-md-6 login-left">
    <h5 class="mb-0" style="text-align: center">I Have An Account</h5>
    <div class="mb-3" align="center">
        <a style="font-size: 10pt;" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="remember" value="1">
        <div class="input-group">
            <span class="input-group-addon"><label for="email"><i class="fa fa-envelope"></i></label></span>
            <input id="email"
                   class="form-control {{$errors->has('email')  ? 'is-invalid' : ''}}"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Email"
                   required/>
        </div>
        <div class="input-group mt-2">
            <span class="input-group-addon" style=""><label for="password"><i class="fa fa-key"></i></label></span>
            <input id="password"
                   class="form-control {{($errors->has('email') or $errors->has('password')) ? 'is-invalid' : ''}}"
                   type="password"
                   name="password"
                   value="{{ old('password') }}"
                   placeholder="Password"
                   required>
        </div>
        @if ($errors->has('email'))
            <span class="text-danger">
                {{ $errors->first('email') }}
            </span>
        @endif
        @if ($errors->has('password'))
            <span class="text-danger">
                {{ $errors->first('password') }}
            </span>
        @endif

        <div align="center">
            <button type="submit" class="btn btn-primary mt-3">
                {{ __('Log In') }}
            </button>
        </div>
    </form>
</div>
