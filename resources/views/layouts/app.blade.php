<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      <div class="navbar-fixed">
        <nav class="orange" role="navigation">
          <div class="nav-wrapper container">
            <a id="logo-container" href="{{ route('dashboard') }}" class="brand-logo center">{{ config('app.name') }}</a>
            @if (Auth::check())
              <ul class="left hide-on-med-and-down">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
              </ul>
            @endif
            @if (Auth::check())
              <!-- Authentication Links -->
              <ul id="dropdown_navbar_auth" class="dropdown-content" role="menu">
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li>
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                    Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            @endif
            <ul class="right hide-on-med-and-down">
              @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
              @else
                <li><a class="dropdown-button" href="#!" data-activates="dropdown_navbar_auth">{{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a></li>
              @endif
            </ul>

            <ul id="nav-mobile" class="side-nav">
              <li><a href{{ url('/') }}">Dashboard</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          </div>
        </nav>
      </div>

      @yield('content')

      <footer class="page-footer orange">
        <div class="container">
{{--           <div class="row">
            <div class="col l6 s12">
              <h5 class="white-text">Company Bio</h5>
              <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Settings</h5>
              <ul>
                <li><a class="white-text" href="#!">Link 1</a></li>
                <li><a class="white-text" href="#!">Link 2</a></li>
                <li><a class="white-text" href="#!">Link 3</a></li>
                <li><a class="white-text" href="#!">Link 4</a></li>
              </ul>
            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Connect</h5>
              <ul>
                <li><a class="white-text" href="#!">Link 1</a></li>
                <li><a class="white-text" href="#!">Link 2</a></li>
                <li><a class="white-text" href="#!">Link 3</a></li>
                <li><a class="white-text" href="#!">Link 4</a></li>
              </ul>
            </div>
          </div> --}}
        </div>
        <div class="footer-copyright">
          <div class="container">
            &copy; {{ date('Y') }} - <a class="orange-text text-lighten-3" href="#">{{ config('app.name') }}</a>
          </div>
        </div>
      </footer>
    </div>

    <!-- Scripts -->
    @yield('js-pre')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js-post')
</body>
</html>
