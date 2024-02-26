<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('asset/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=10">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}?version=10">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light navbar-white">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WCPD -WOMEN AND CHILDREN'S PROTECTION CENTER</a>
            </li>
        </ul>

        <!-- Right navbar links -->
         <!-- Right navbar links -->
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
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4" style="position:fixed">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">

            <img src="{{ asset('images/wcpc_logo.jpg') }}" alt="PSU Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light"><strong style="color: blue; font-weight: bold;">WCPD</strong></span>
        </a>

        @include('layouts.navigation')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: 10rem">
        @yield('content')
    </div>
    <!-- /.content-wrapper --> 

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        
        <div class="float-right d-none d-sm-inline"> 
            Developed by &nbsp;&nbsp;
            PSU UC - IT 0JT 2024
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2024 WCPC Information Management System</strong> All rights reserved.

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
