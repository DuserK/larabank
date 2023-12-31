<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">


    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/6b553b78cb.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class = "content container">
        <div class="row justify-content-md-center">
            <div class="row">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm col-12">
                    <div class="container">
                        <div class="logo-box">
                            <div class="logo">
                                <span>Lara</span>bank
                            </div>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active onHoverNav" aria-current="page" href="{{ route('home') }}">
                                        Pagrindinis
                                    </a>
                                </li>
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active onHoverNav" aria-current="page" href="{{ route('clients-tax') }}">
                                            Mokestis
                                        </a>
                                    </li>
                                </ul>
                            <ul class="navbar-nav ms-auto">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active onHoverNav" aria-current="page" href="{{ route('transfers-index') }}">
                                            Pervedimai
                                        </a>
                                    </li>
                                </ul>
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle onHoverNav" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Klientai
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item onHoverNav" href="{{ route('clients-index') }}">
                                            Klientų sąrašas
                                        </a>
                                        <a class="dropdown-item onHoverNav" href="{{ route('clients-create') }}">
                                            Sukurti naują klientą
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle onHoverNav" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Sąskaitos
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item onHoverNav" href="{{ route('accounts-index') }}">
                                            Sąskaitų sąrašas
                                        </a>
                                        <a class="dropdown-item onHoverNav" href="{{ route('accounts-create') }}">
                                            Sukurti naują sąskaitą
                                        </a>
                                    </div>
                                </li>
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link onHoverNav" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle onHoverNav" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item onHoverNav" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
            @include('msg.messages')
            @include('msg.error')
        </main>
    </div>
</body>
</html>
