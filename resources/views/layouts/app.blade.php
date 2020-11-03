<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-secondary">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item form-inline dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbardrop" data-toggle="dropdown">
                              <i class="fa fa-crosshairs" style="font-size: 15px; color:white"></i>
                              <b style="color: white">Jogos</b>
                            </a>
                            <div class="dropdown-menu">
                                {{-- <a class="dropdown-item" href="#"><b>Explorar</b></a> --}}
                                <a class="dropdown-item" href="{{route('rank')}}"><b>Top Jogos</b></a>
                                {{-- <a class="dropdown-item" href="#"><b>Lançamentos</b></a>
                                <a class="dropdown-item" href="#"><b>Análises</b></a> --}}
                            </div>
                        </li>
                        <li style="width: 5ch;"></li>
                    </ul>

                    {{-- <input id="search" type="text" placeholder="Search" style="width: 65ch;"> --}}
                    <form class="form-inline" action="{{route('search')}}">
                        @csrf
                        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" style="width: 65ch;"
                        @if (isset($pesquisa))
                            value="{{$pesquisa}}"
                        @endif
                        >
                        <button class="btn btn-dark" type="submit"><i class="fa fa-search" style="font-size:20px"></i></button>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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
                        @php
                            $image = Auth::user()->img_perfil;
                        @endphp
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{-- <img src="storage/{{Auth::user()->img_perfil}}" height="35"> --}}
                                    <img src="{{url ("storage/".auth()->user()->img_perfil)}}" height="35">
                                    {{ Auth::user()->name }} <span class="caret"></span> 
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route ('perfil',Auth::user()->id)}}"><b>Meu Perfil</b></a>
                                    <a class="dropdown-item" href="{{route ('list',Auth::user()->id)}}"><b>Game List</b></a>
                                    {{-- <a class="dropdown-item" href="#"><b>Coleção</b></a> --}}
                                    <a class="dropdown-item" href="{{route('userForm',Auth::user()->id)}}"><b>Configurações</b></a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
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

        <div class="search"></div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
