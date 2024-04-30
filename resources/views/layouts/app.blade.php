<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<link rel="icon" href="{{ url('asset/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=10">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
    }

    .main-sidebar {
        width: 270px;
        overflow-y: auto;  
        height: calc(100vh - 40px);  
    }

    .content-wrapper {
        overflow-x: hidden; 
        overflow-y: auto; 
    }

    .content-wrapper {
        padding-left: 10px; 
    }

    .main-footer {
        position: fixed;
        bottom: 0;
        width: calc(100% - 250px);  
        background-color: #192440;
        color: white;
        font-size: 12px;
    } 
</style> 
</head>
<body class="hold-transition " style="font-family: 'Poppins', sans-serif;">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-light ">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 20px; color: #9947B6">
            <i class="fas fa-align-justify fa-5x glow-icon"></i> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WOMAN AND CHILDREN PROTECTION DESK</a> 
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="link-buttons" href="{{ route('logout') }}" style="float: left; background-color: #48145B">Logout&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-right-from-bracket"></i> </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-light-primary elevation-4" style="position:fixed; background-color:#9947B6; overflow-y: auto; height: 100vh;">  
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
                <li class="nav-item">
                    <a href="#" class="nav-link" style="display: flex">
                        <i class="nav-icon">
                            <img src="{{ asset('images/wcpd_logo.png') }}" alt="WCPD Logo" class="brand-image img-circle elevation-3 img-fluid" style="opacity: .8; max-width: 40px;">
                        </i> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="brand-text font-weight-light"><strong style="color: white; font-weight: bold; font-size: 25px">WCPD</strong></span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon">
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-thumbnail" style="max-width: 40px; max-height: 40px;">
                        </i>
                        <p>
                            <span class="" style="color:white; text-transform: capitalize;">{{ Auth::guard('account')->user()->firstname }} {{ Auth::guard('account')->user()->lastname }}</span>
                        </p>
                    </a>
                </li>

                <hr style="border-top: 5px solid #ccc; margin: 10px 0; color: black">

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.dashboard') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item" >
                    <a href="{{ route('investigator.dashboard') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th"style="color:white"></i>
                        <p style="color:white">
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.allrecords')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon far fa-folder-open" style="color:white"></i>
                        <p style="color:white">
                            {{ __('All Records') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item" style="color:white">
                    <a href="{{ route('investigator.allrecords') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon far fa-folder-open" style="color:white"></i>
                        <p style="color:white">
                            {{ __('All Records') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-file-invoice" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Complaint Report Management') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-file-invoice" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Complaint Report Management') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-gavel" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Update Types of Offenses') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-gavel" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Update Types of Offenses') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-user" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Victims Management') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-user" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Victims Management') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-user" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Offenders Management') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-user" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Offenders Management') }}
                        </p>
                    </a>
                </li>
                @endif 

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li id="account-management" class="nav-item">
                    <a href="#" class="nav-link" onclick="toggleSubMenu()">
                        <i class="nav-icon fas fa-circle-user" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Account Management') }}
                            &nbsp;<i id="account-management-toggle" class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul id="account-management-submenu" class="nav nav-treeview collapse show-submenu" > 
                        <li class="nav-item">
                            <a href="{{ route('superadmin.inv_account_mngt') }}"  >
                                <i class="nav-icon fas fa-user" style="color: white;"></i>
                                <p style="color:white">Investigator Account Mngt.</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('superadmin.superadmin_account_mngt', Auth::guard('account')->user()->id) }}"  >
                                <i class="nav-icon fas fa-user" style="color: white;"></i>
                                <p style="color:white">Super Admin Account Mngt.</p>
                            </a>
                        </li>  
                    </ul>
                </li>

                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.accountmngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-circle-user" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Account Management') }}
                            @if (Auth::guard('account')->user()->change_password_req == 'accepted')
                            <i class="fas fa-circle ico" style="color: green"></i>
                            @elseif (Auth::guard('account')->user()->change_password_req == 'denied')
                            <i class="fas fa-circle ico" style="color: red"></i>
                            @endif
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.logs') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-rectangle-list" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Logs') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.logs') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-rectangle-list" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Logs') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.password_requests')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-unlock-keyhole" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Password Requests') }} - <b>{{ $notifs }}</b>
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.trash') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-trash-can" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Trash') }}
                        </p>
                    </a>
                </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.trash') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-trash-can" style="color:white"></i>
                        <p style="color:white">
                            {{ __('Trash') }}
                        </p>
                    </a>
                </li>
                @endif
            </ul>

        </nav> 
        {{-- <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            </ul>
        </nav>  --}}
    </aside> 
    <div class="content-wrapper" >
        @yield('content')
    </div>
    <footer class="main-footer" style="position: fixed; bottom: 0; width: 100%;background-color:#192440; color:white; font-size: 15px">
        &nbsp;&nbsp;&nbsp;Copyright &copy; 2024 WCPD Information Management System. All rights reserved. Developed by PSU UC - IT 0JT 2024. 
    </footer>
</div>

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

    });

    let newtable = new DataTable('#degrees',{
        responsive: true,
        "language": {
            "emptyTable": "No Record Found",
            "ordering": false
        },
        scrollCollapse: true,

    });
</script>
<script>
function toggleSubMenu() {
    var submenu = document.getElementById("account-management-submenu");
    var icon = document.getElementById("account-management-toggle");
 
    submenu.classList.toggle("show-submenu");
 
    icon.classList.toggle("fa-angle-down");
    icon.classList.toggle("fa-angle-left");
}

</script>

@yield('scripts')
</body>
</html>
