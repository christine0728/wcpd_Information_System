<!-- Sidebar -->
<style> 
.sideber{
    position: fixed;
}
</style>
<div class="sidebar" style="position:fixed">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
        <div class="info">
            <a class="d-block">
                <img src="{{ asset('images/default.png') }}" alt="Default Image" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                {{ Auth::guard('account')->user()->firstname }} {{ Auth::guard('account')->user()->lastname }}
            </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
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
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('All Records') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.allrecords') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('All Records') }}
                    </p>
                </a>
            </li> 
            @endif
            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i> <!-- Updated icon for Administration -->
                    <p>
                        {{ __('All Records') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="" class="nav-link {{ request()->is('universityofficial') ? 'text-primary' : 'text-dark' }}">
                            <p>University Official</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="" class="nav-link {{ request()->is('organizationalstructure') ? 'text-primary' : 'text-dark' }}">
                            <p>Organizational Structure of Library</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="" class="nav-link {{ request()->is('libraryproceduralmanual') ? 'text-primary' : 'text-dark' }}">
                            <p>Library Procedural Manual</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href=""  class="nav-link {{ request()->is('librarygoalmissionandobjective') ? 'text-primary' : 'text-dark' }}">
                            <p>Library Goal Mission and Objective</p>
                        </a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li class="nav-item">
                <a href="{{ route('investigator.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Complaint Report Management') }}
                    </p>
                </a>
            </li> --}}

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item"> 
                    <a href="{{ route('superadmin.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('Complaint Report Management') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Complaint Report Management') }}
                    </p>
                </a>
            </li> 
            @endif

            {{-- <li class="nav-item">
                <a href="{{ route('investigator.offensesmanagement')}}"  class="nav-link {{ request()->is('librarymanpower') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('Update Types of Offenses') }}
                    </p>
                </a>
            </li> --}}

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item"> 
                    <a href="{{ route('superadmin.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('Update Types of Offenses') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.offensesmanagement') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Update Types of Offenses') }}
                    </p>
                </a>
            </li> 
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item"> 
                    <a href="{{ route('superadmin.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('Victims Management') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.victims_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Victims Management') }}
                    </p>
                </a>
            </li> 
            @endif

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item"> 
                    <a href="{{ route('superadmin.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('Offenders Management') }}
                        </p>
                    </a>
                </li>

            @elseif (Auth::guard('account')->user()->acc_type == 'investigator' )<li class="nav-item">
                <a href="{{ route('investigator.suspects_mngt') }}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Offenders Management') }}
                    </p>
                </a>
            </li> 
            @endif 

            @if (Auth::guard('account')->user()->acc_type == 'superadmin')
                <li class="nav-item">
                    <a href="" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                        <i class="nav-icon fas fa-th"></i>
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
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('Account Management') }}
                        </p>
                    </a>
                </li>
            @endif 
        </ul> 
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
