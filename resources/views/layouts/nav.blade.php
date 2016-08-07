<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
	    
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
	    
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Note-Taker
            </a>
        </div>
	
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
	    @if (Auth::user())
                <ul class="nav navbar-nav">
		    <li><a href="{{ url('/notebooks') }}">Notebooks</a></li>
		    <li><a href="{{ url('/notebooks/create') }}">New Notebook <i class="fa fa-plus"></i></a></li>
                </ul>
	    @endif
	    
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->email }} <span class="caret"></span>
                        </a>
			
                        <ul class="dropdown-menu" role="menu">
			    @if (Auth::user()->admin)
				<li><a href="{{ url('/admin/users') }}"><i class="fa fa-shield"></i> Admin</a></li>
			    @endif
			    <li><a href="{{ url('/settings') }}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
