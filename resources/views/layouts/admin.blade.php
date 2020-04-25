<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('global.site_title') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
     <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body {{ Session::has('notification') ? 'data-notification' : '' }}
data-notification-type="{{  Session::has('notification') ? Session::get('notification')['alert_type'] : '' }}"
data-notification-message="{{ Session::has('notification') ? json_encode(Session::get('notification')['message']) : '' }}" class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <span class="navbar-brand-full">Project</span>
            <span class="navbar-brand-minimized">P</span>
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">


            <li class="nav-item dropdown">
                      <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img class="img-avatar" src="{{ asset('img/user.png') }}" alt="{{ Auth::user()->name }}">
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center">
                          <strong>{{ Auth::user()->name }}</strong>
                        </div>

                        <a class="dropdown-item" href="{{ route('admin.users.password', Auth::user()->id) }}">
                             <span class="fa-passwd-reset fa-stack">
                              <i class="fa fa-undo fa-stack-2x"></i>
                              <i class="fa fa-lock fa-stack-1x"></i>
                            </span> {{ trans('global.change_password') }}
                        </a>

                        <a class="dropdown-item" href="#"  onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                          <i class="nav-icon fa fa-sign-out fa-2x"></i>  {{ trans('global.logout') }}
                           <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">@csrf</form>
                       </a>


                      </div>
                    </li>
        </ul>
    </header>

    <div class="app-body">
        @include('partials.menu')
        <main class="main">


            <div style="padding-top: 20px" class="container-fluid">

                @yield('content')

            </div>


        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
   <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>


    @yield('scripts')
</body>

</html>
