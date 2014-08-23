<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-batea-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{ link_to('/', 'Batea', ['class'=>'navbar-brand']) }}
        </div>
        <div class="collapse navbar-collapse" id="bs-batea-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if(Auth::check())
                    <li>{{ link_to('/dashboard', 'Dashboard', ['class'=>'active']) }}</li>
                    <li>{{ link_to('/activity', 'Activity') }}</li>
                    <li>{{ link_to('/analytics', 'Analytics') }}</li>
                    <li>{{ link_to('/keywords', 'Keywords') }}</li>
                @else
                    <li>{{ link_to('/about', 'About') }}</li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->email }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{{ link_to('/users/account', 'Edit Account') }}</li>
                            <li class="divider"></li>
                            <li>{{ link_to('/users/logout', 'Logout') }}</li>
                        </ul>
                   </li>
                @else
                    <li>{{ link_to('/users/register', 'Sign Up') }}</li>
                    <li>{{ link_to('/users/login', 'Login') }}</li>
                @endif
            </ul>
        </div> 
    </div>
</div>