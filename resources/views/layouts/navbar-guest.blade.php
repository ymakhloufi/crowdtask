<nav class="top-nav">
    <div class="row">
        <span>
            <a href="{{ url('/') }}">
                <span class="title">
                    <span style="color:#93c">Crowd</span><span style="color:#ccc">Task</span>
                </span>
        </a>
        </span>
        <div class="links-right">
            <!-- Right Side Of Navbar -->
            <ul style="border-left: 1px solid #333;">
                <!-- Authentication Links -->
                <a href="{{ route('login') }}">
                    <i class="fa fa-key"></i>
                    <span class="hide-xs">{{ __('Login') }}</span>
                </a>
                <a href="{{ route('register') }}">
                    <i class="fa fa-user-plus"></i>
                    <span class="hide-xs">{{ __('Sign Up') }}</span>
                </a>
            </ul>
        </div>
    </div>
</nav>
