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
                {{ Auth::guard('team')->user()->username }}
            </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
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
            </li>

            <li class="nav-item">
                <a href="{{ route('team.complaintreport')}}" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Complaint Report Management') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('team.offensesmanagement')}}"  class="nav-link {{ request()->is('librarymanpower') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('Update Types of Offenses') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Victims Management') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Suspects Management') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link {{ request()->is('home') ? 'text-primary' : 'text-dark' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Team Account Management') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i> <!-- Updated icon for Administration -->
                    <p>
                        {{ __('Collection Development') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview" style="display: none;">

                    <li class="nav-item">
                        <a href=""  class="nav-link {{ request()->is('filipiniana') ? 'text-primary' : 'text-dark' }}">
                            <p>Books</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#"  class="nav-link {{ request()->is('filipiniana') ? 'text-primary' : 'text-dark' }}">
                            <p>Thesis and Dissertion</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href=""  class="nav-link {{ request()->is('subscribed_educ_dbase') ? 'text-primary' : 'text-dark' }}">
                            <p>Subscribed Educational Databases</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href=""  class="nav-link {{ request()->is('open_educ_resources') ? 'text-primary' : 'text-dark' }}">
                            <p>Open Educational Resources</p>
                        </a>
                    </li>
                </ul>
            </li>


        </ul> 
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
