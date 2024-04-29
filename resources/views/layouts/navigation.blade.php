<!-- Sidebar -->
<!-- <style>
.sidebar{
    position: fixed;
}

.ico.fa-solid.fa-circle {
    font-size: 0.7rem !important;
}
</style>

<div class="sidebar" style="position:fixed; background-color:pink; width: 250px">
<img src="{{ asset('images/wcpd_logo.png') }}" alt="WCPD Logo" class="brand-image img-circle elevation-3 img-fluid" style="opacity: .8; max-width: 50px;">
<span class="brand-text font-weight-light"><strong style="color: black; font-weight: bold;">WCPD</strong></span>

<br>

     <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
        <div class="info">
            <a class="d-block" style="color:black; font-weight:bold; ">
                <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                {{ Auth::guard('account')->user()->firstname }} {{ Auth::guard('account')->user()->lastname }}
            </a>
        </div>
    </div> -->

    <!-- Sidebar Menu -->
    <!-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.dashboard') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.dashboard') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.allrecords')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-regular fa-folder-open"></i>
                        <p>
                            {{ __('All Records') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.allrecords') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fa-regular fa-folder-open"></i>
                    <p>
                        {{ __('All Records') }}
                    </p>
                </a>
            </li>
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-file-invoice"></i>
                        <p>
                            {{ __('Complaint Report Management') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                    <p>
                        {{ __('Complaint Report Management') }}
                    </p>
                </a>
            </li>
            @endif -->

            <!-- @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-gavel"></i>
                        <p>
                            {{ __('Update Types of Offenses') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fa-solid fa-gavel"></i>
                    <p>
                        {{ __('Update Types of Offenses') }}
                    </p>
                </a>
            </li>
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            {{ __('Victims Management') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                <i class="fas fa-user"></i>
                    <p>
                        {{ __('Victims Management') }}
                    </p>
                </a>
            </li>
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            {{ __('Offenders Management') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fa-solid fa-user"></i>
                    <p>
                        {{ __('Offenders Management') }}
                    </p>
                </a>
            </li>
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-circle-user"></i>
                        <p>
                            {{ __('Account Management') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{ route('superadmin.inv_account_mngt') }}"  class="nav-link {{ request()->is('filipiniana') ? 'text-primary' : 'text-dark' }}">
                                <p>Investigator Account Mngt.</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('superadmin.superadmin_account_mngt', Auth::guard('account')->user()->id) }}"  class="nav-link {{ request()->is('filipiniana') ? 'text-primary' : 'text-dark' }}">
                                <p>Super Admin Account Mngt.</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.accountmngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-circle-user"></i>
                        <p>
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
                        <i class="nav-icon fa-solid fa-rectangle-list"></i>
                        <p>
                            {{ __('Logs') }}
                        </p>
                    </a>
                </li>
            @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.logs') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-rectangle-list"></i>
                        <p>
                            {{ __('Logs') }}
                        </p>
                    </a>

                </li>
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
            <li class="nav-item">
                <a href="{{ route('superadmin.password_requests')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fa-solid fa-unlock-keyhole"></i>
                    <p>
                        {{ __('Password Requests') }} - <b>{{ $notifs }}</b>
                    </p>
                </a>
            </li>
            @endif -->
<!--
            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.trash') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-trash-can"></i>
                        <p>
                            {{ __('Trash') }}
                        </p>
                    </a>
                </li>
            @elseif (Auth::guard('account')->user()->acc_type == 'investigator')
                <li class="nav-item">
                    <a href="{{ route('investigator.trash') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fa-solid fa-trash-can"></i>
                        <p>
                            {{ __('Trashs') }}
                        </p>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
 -->
