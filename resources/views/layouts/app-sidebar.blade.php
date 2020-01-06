<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Brackets</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <ion-icon name="code" class="lead"></ion-icon>
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link lead"><ion-icon name="notifications"></ion-icon></a>
                        </li>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}">Profile</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-3 col-sm-1 p-0" style="position: sticky;">
                        <!--
                        <a href="/" class="btn d-flex text-secondary pt-3">
                            <div>
                                <h3><ion-icon name="home"></ion-icon></h3>
                            </div>

                            <div class="lead ml-3">
                                Home
                            </div>
                        </a>

                        <a href="/" class="btn d-flex text-secondary pt-3">
                            <div>
                                <h3><ion-icon name="people"></ion-icon></h3>
                            </div>

                            <div class="lead ml-3">
                                Connect
                            </div>
                        </a>

                        <a href="/" class="btn d-flex text-secondary pt-3">
                            <div>
                                <h3><ion-icon name="business"></ion-icon></h3>
                            </div>

                            <div class="lead ml-3">
                                Community
                            </div>
                        </a>
                        -->
                    </div>
                
                    <div class="col-md-6 col-sm-10">
                        @yield('content')
                    </div>

                    <div class="col-md-3 col-sm-1">
                        <!--
                        <div class="d-block">
                            <p class="lead">Trending</p>
                        </div>
                    -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
