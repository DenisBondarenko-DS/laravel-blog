<header class="market-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="{{ route('home') }}">
                <img style="width: 50px" src="{{ asset('assets/front/images/version/logo.png') }}" alt="">
            </a>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                </ul>

                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login_form') }}">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register_form') }}">Register</a>
                        </li>
                    </ul>

                @endguest

                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show') }}">{{ auth()->user()->name }}</a>
                        </li>

                        @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Admin Page</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>

                @endguest

                <style>
                    .market-header .form-inline .form-control.is-invalid {
                        border: 2px solid red;
                    }
                </style>

            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->
