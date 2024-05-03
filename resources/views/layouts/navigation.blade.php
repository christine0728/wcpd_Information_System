<!-- Sidebar -->
<style>
    .sideber{
        position: fixed;
    }

    .ico.fa-solid.fa-circle {
        font-size: 0.7rem !important;
    }

    i {
        color: white !important;
    }
    </style>
    <div class="sidebar" style="position:fixed;  color: white; ">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
        <div class="info">
            <a class="d-block">
                <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                &nbsp; <b style="color: white; font-size: large">{{ ucfirst(Auth::guard('account')->user()->firstname) }} {{ ucfirst(Auth::guard('account')->user()->lastname) }}</b>
            </a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" style=" color: white;">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.dashboard') }}" class="nav-link">
                            <i class="fas fa-th" style="color: white"></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Dashboard') }}
                            </p>
                        </a>
                    </li>

                @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                    <a href="{{ route('investigator.dashboard') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="fas fa-th" style="color: white"></i>
                        <p style="color: white; margin-left: 0.5rem">
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.allrecords')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-regular fa-folder-open" style="color: white"></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('All Records') }}
                            </p>
                        </a>
                    </li>

                @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                    <a href="{{ route('investigator.allrecords') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="fa-regular fa-folder-open" style="color: white;  "></i>
                        <p style="color: white; margin-left: 0.5rem">
                            {{ __('All Records') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-file-invoice" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Complaint Report Management') }}
                            </p>
                        </a>
                    </li>

                @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                    <a href="{{ route('investigator.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="fa-solid fa-file-invoice" style="color: white;  "></i>
                        <p style="color: white; margin-left: 0.6rem">
                            {{ __('Complaint Report Management') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-gavel" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Offenses Management') }}
                            </p>
                        </a>
                    </li>

                @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                    <a href="{{ route('investigator.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="fa-solid fa-gavel" style="color: white; "></i>
                        <p style="color: white; margin-left: 0.5rem">
                            {{ __('Offenses Management') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-regular fa-user" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Victims Management') }}
                            </p>
                        </a>
                    </li>

                @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="fas fa-users" style="color: white;"></i>
                    <p style="color: white; margin-left: 0.5rem">
                        {{ __('Victims Management') }}
                    </p>
                </a>

                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-user" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Offenders Management') }}
                            </p>
                        </a>
                    </li>

                @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                    <a href="{{ route('investigator.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="fa-solid fa-user" style="color: white; "></i>
                        <p style="color: white; margin-left: 0.5rem">
                            {{ __('Offenders Management') }}
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-circle-user" style="color: white"></i>
                            <p  style="color: white; margin-left: 0.5rem">
                                {{ __('Account Mngt.') }}
                            </p>
                            <i class="fas fa-angle-left right" style="margin-left: 1rem"></i>
                        </a>

                        <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('superadmin.inv_account_mngt') }}" class="nav-link {{ request()->is('filipiniana') ? 'text-primary' : 'text-dark' }}">
                                <i class="fas fa-user-cog"></i>
                                <p style="color: white;">Investigator Account Mngt.</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('superadmin.superadmin_account_mngt', Auth::guard('account')->user()->id) }}" class="nav-link {{ request()->is('filipiniana') ? 'text-primary' : 'text-dark' }}">
                                <i class="fas fa-user-shield"></i>
                                <p style="color: white;">Superadmin Account Mngt.</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                    <li class="nav-item">
                        <a href="{{ route('investigator.accountmngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-circle-user" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Account Management') }}
                            </p>

                            @if (Auth::guard('account')->user()->change_password_req == 'accepted')
                                &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-circle ico" style="color: green"></i>
                            @elseif (Auth::guard('account')->user()->change_password_req == 'denied')
                                &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-circle ico" style="color: red"></i>
                            @endif
                        </a>

                    </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.logs') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-rectangle-list" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Logs') }}
                            </p>
                        </a>
                    </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                    <li class="nav-item">
                        <a href="{{ route('investigator.logs') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-rectangle-list" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Logs') }}
                            </p>
                        </a>

                    </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.password_requests')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="fa-solid fa-unlock-keyhole" style="color: white;  "></i>
                        <p style="color: white; margin-left: 0.5rem">
                            {{ __('Password Requests') }} - <b>{{ $notifs }}</b>
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.trash') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-trash-can" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Trash') }}
                            </p>
                        </a>
                    </li>
                @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                    <li class="nav-item">
                        <a href="{{ route('investigator.trash') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                            <i class="fa-solid fa-trash-can" style="color: white;  "></i>
                            <p style="color: white; margin-left: 0.5rem">
                                {{ __('Trash') }}
                            </p>
                        </a>

                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
