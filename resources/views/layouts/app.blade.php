<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('asset/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=10"> 
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> 
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}?version=10">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('styles')

    <style>
        @keyframes glow {
            0% {
                box-shadow: 0 0 10px blue;
            }
            50% {
                box-shadow: 0 0 10px violet;
            }
            100% {
                box-shadow: 0 0 10px #9947B6;
            }
        }

        .glow-icon {
            animation: glow 1.5s infinite alternate;
            font-size: 5em;
            padding: 3px;
            background-color: transparent;
            color: black !important;
        }
 
        .main-footer {
            position: fixed;
            bottom: 0;
            width: calc(100% - 250px);  
            background-color: #192440;
            color: white;
            font-size: 14px;
        } 
    </style>
</head>
<body class="hold-transition sidebar-mini" style="font-family: 'Poppins', sans-serif; ">
<div class="wrapper">  
    <nav class="main-header navbar navbar-expand navbar-light " style="width: auto"> 
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 20px; color: #9947B6">
                <i class="fas fa-align-justify fa-5x glow-icon" style="color: black"></i> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WOMAN AND CHILDREN PROTECTION DESK</a> 
            </li>
        </ul>
 
         <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="link-buttons" href="{{ route('logout') }}" style="float: left; background-color: #48145B">Logout&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-right-from-bracket"></i> </a> 
                {{-- <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a href="" class="dropdown-item">
                        <i class="mr-2 fas fa-file"></i>
                        {{ __('My profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="">
                        @csrf
                        <a href="" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>
                    </form>
                </div> --}}
            </li>
        </ul>
    </nav> 
    <aside class="main-sidebar sidebar-light-primary  " style="position:fixed; background-color:#9947B6; font-size: 15px; padding: 0px"> 
        <a href="/" class="brand-link"> 
            <img src="{{ asset('images/wcpd_logo.png') }}" alt="PSU Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light"><strong style="color: white; font-weight: bold;">WCPD</strong></span>
        </a>

        @include('layouts.navigation')
    </aside>
 
    <div class="content-wrapper" >
        @yield('content')
    </div> 
    <footer class="main-footer" style="position: fixed; bottom: 0; width: 100%;"> 
        <strong>Copyright &copy; 2024 WCPC Information Management System.</strong> All rights reserved.
        <div class=" d-none d-sm-inline"> 
            Developed by PSU UC - IT OJT 2024.
        </div> 
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
<script src="{{ asset('js/jquery-3.6.4.js') }}"></script>
<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#example',{
        responsive: true,
        "language": {
            "emptyTable": "No Record Found"
        },
        scrollCollapse: true,
        "order": [[0, 'desc']]
        // scrollY: '400px' 
    });

    let newtable = new DataTable('#degrees',{
        responsive: true,
        "language": {
            "emptyTable": "No Record Found",
            "ordering": false
        },
        scrollCollapse: true,
        // scrollY: '400px'
    });
</script>

@yield('scripts')
</body>
</html>