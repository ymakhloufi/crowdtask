<nav class="top-nav">
    <div class="row">
        <span class="hide-xs">
            <a href="{{ url('/') }}">
                <span class="title">
                    <span style="color:#93c">Crowd</span><span style="color:#ccc">Task</span>
                </span>
        </a>
        </span>
        <div class="show-xs icons-left">
            <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
            <a href="{{ url('/') }}"><i class="fa fa-tasks"></i></a>
            <a href="{{ url('/') }}"><i class="fa fa-list"></i></a>
            <a href="{{ url('/') }}"><i class="fa fa-bell"></i></a>
        </div>
        <div class="show-lg" style="margin-top:3px;">
            <ul>
                <a href="{{ url('/') }}"><i class="fa fa-tasks"></i> {{ __('Assignments') }}</a>
                <a href="{{ url('/') }}"><i class="fa fa-list"></i> {{ __('Library') }}</a>
                <a href="{{ url('/') }}"><i class="fa fa-bell"></i> {{ __('Events') }}</a>
            </ul>

        </div>
        <div class="links-right">
            <!-- Right Side Of Navbar -->
            <ul>
                <!-- Authentication Links -->
                <a href="{{ url("/users/".\Auth::user()->id) }}">
                    <img src="{{\Auth::user()->avatar}}" class="fa avatar" style="max-height: 25px;"/>
                    <span class="hide-sm"> {{\Auth::user()->points}} Points</span>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">
                    <i class="fa fa-power-off"></i>
                    <span class="hide-sm">{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>

<nav class="hide-lg hide-xs second-nav">
    <!-- Left Side Of Navbar -->
    <div style="padding: 5px;" align="center">
        <a href="{{ route('logout') }}"><i class="fa fa-tasks"></i> {{ __('Assignments') }}</a>
        <a href="{{ route('logout') }}"><i class="fa fa-list"></i> {{ __('Library') }}</a>
        <a href="{{ route('logout') }}"><i class="fa fa-bell"></i> {{ __('Events') }}</a>
    </div>
</nav>
