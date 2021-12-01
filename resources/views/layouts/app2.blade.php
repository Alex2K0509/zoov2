<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> zoo-control</title>

        <script src="{{ asset('assets/firebase/firebase.js') }}"></script>
        <!-- Firebase App is always required and must be first -->
        <script src="{{ asset('assets/firebase/firebase-app.js') }}"></script>

        <!-- Add addit ional services that you want to use -->
        <script src="{{ asset('assets/firebase/firebase-auth.js') }}"></script>
        <script src="{{ asset('assets/firebase/firebase-database.js') }}"></script>
        <script src="{{ asset('assets/firebase/firebase-firestore.js') }}"></script>
        <script src="{{ asset('assets/firebase/firebase-messaging.js') }}"></script>
        <script src="{{ asset('assets/firebase/firebase-functions.js') }}"></script>

        <!-- firebase integration end -->

        <!-- Comment out (or don't include) services that you don't want to use -->
        <script src="{{ asset('assets/firebase/firebase-analytics.js') }}"></script>


        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/white.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <script src="{{ asset('assets/jquery/sweetalert2@10.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/jquery/all.min.css') }}" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

        <!---estilos para datatables---->
        <link href="{{ asset('assets/jquery/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/jquery/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

        <!--estilos cdn data tables-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/jquery/responsive.bootstrap4.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/jquery/jquery.webui-popover.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/jquery/buttons.bootstrap4.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/jquery/select.bootstrap4.min.css') }}"/>


        <!---js cdn data tables para datatables---->
        <script type="text/javascript" src="{{ asset('assets/jquery/jquery-3.5.1.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/jquery/jquery.dataTables.min.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('assets/jquery/dataTables.bootstrap4.min.js') }}" defer></script>

        <!--estilos para responsive-->
        <script type="text/javascript" src="{{ asset('assets/jquery/dataTables.responsive.min.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('assets/jquery/responsive.bootstrap4.min.js') }}" defer></script>

        <!---js para select2-->
        <link href="{{ asset('assets/jquery/select2.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('assets/jquery/select2.min.js') }}" defer></script>


        <style>
    .page-item .page-link, .page-item span {
        font-size: .875rem;
        display: flex;
        width: 60px !important;
        height: 36px;
        margin: 0 3px;
        padding: 0;
        border-radius: 0% !important;
        align-items: center;
        justify-content: center;
    }
    .contenido-tablas-descripcion{
        max-width: 300px !important;
    }
    .contenido-tablas-descripcion > div {
        overflow: hidden !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
    }
    .page-item.active .page-link {
        box-shadow: 0 7px 14px rgb(50 50 93 / 10%), 0 3px 6px rgb(0 0 0 / 8%);
        width: 30px;
    }
    .modal-body {
        max-height: calc(100vh - 143px);
        overflow-y: auto;
    }
</style>



    </head>

    @include('flash-message')
    <body class="bg-default" style="background-color: white">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="main-content">
            @include('layouts.navbars.navbar')

            @yield('content')
        </div>

        <!------->


        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>
