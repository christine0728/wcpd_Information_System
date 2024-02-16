<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">WCPD</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Dashboard</a></li>
        </ul>
      </li> 
      <li>
        <a href="{{ route('investigator.dashboard') }}">
          <i class='bx bx-data'></i> 
          <span class="link_name">All records</span>
        </a>
        {{-- <ul class="sub-menu blank">
          <li><a class="link_name" href="#">All records</a></li>
        </ul> --}}
      </li>

      <li>
        <a href="{{ route('investigator.complaintreport') }}">
          <i class='bx bx-file'></i> 
          <span class="link_name">Complaint Report Management</span>
        </a>
        {{-- <ul class="sub-menu blank">
          <li><a class="link_name" href="{{ route('investigator.complaintreport') }}">Complaint Report Management</a></li>
        </ul> --}}
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
          <i class='bx bx-error'></i>

            <span class="link_name">Update Types of Offenses </span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Update Types of Offenses</a></li>
          <li><a href="#">HTML & CSS</a></li>
          <li><a href="#">JavaScript</a></li>
          <li><a href="#">PHP & MySQL</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
          <i class='bx bx-user'></i>

            <span class="link_name">Victim </span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Victim </a></li>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Login Form</a></li>
          <li><a href="#">Card Design</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
          <i class='bx bx-user-pin'></i>
            <span class="link_name">Suspects </span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Suspects </a></li>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Login Form</a></li>
          <li><a href="#">Card Design</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
        <i class='bx bx-group'></i>

          <span class="link_name">Team Account </span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Team Account </a></li>
        </ul>
      </li>
    </ul>
  </div>