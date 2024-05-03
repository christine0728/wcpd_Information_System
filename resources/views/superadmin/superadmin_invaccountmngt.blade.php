{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team | Complaint Report Management</title>
</head>
<body>
    <h1>Complaint Report Management</h1>

    <a href="{{ route('inactestigator.complaintreport_form') }}">Add Complaint Report (diretso sa Complaint Report Form)</a>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SuperAdmin | Account Management</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
        <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>
        <style>
            /* Style the tab */
            .tab {
                overflow: hidden;
                border: 1px solid #ccc;
                background-color: #f1f1f1;
            }

            /* Style the buttons inside the tab */
            .tab button {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
                font-size: 17px;
            }
 
            .tab button:hover {
                background-color: #ddd;
            }
 
            .tab button.active {
                background-color: #9947B6;
                color: white !important; 
            }
 
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }

            .filter {
                display: flex;
                align-items: center;
            }

            .date-filter {
                display: flex;
                align-items: center;
                margin-right: 10px;
            }

            .date-filter label {
                margin-right: 5px;
            }

            @media only screen and (max-width: 768px) {
                /* For mobile phones: */
                [class*="col-"] {
                width: 100%;
                }
                
                div{
                    display: none !important;
                }
            }

            .success {
                background-color: #d4edda; /* Lighter shade of green */
                border-color: #c3e6cb; /* Adjust border color if needed */
                color: #155724; /* Adjust text color if needed */
            }

            .updated {
                color: #856404;
                background-color: #fff3cd;
                border-color: #ffeeba;
            }

            .delete {
                color: #721c24;
                background-color: #f8d7da;
                border-color: #f5c6cb;
            }
        </style>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2"> 
                         <div class="col-6">
                            <h1 class="m-0" style="font-weight: bold;">&nbsp;{{ __('Investigator Account Management') }}</h1>
                        </div> 
                    </div>
                </div>
            </div>
 
            <div class="content" style="margin-top: -2rem">
                <div class="container-fluid">
                    <div class="col-12" style="margin-bottom: 1rem">
                        <a class="link-buttons" href="{{ route('superadmin.add_investigator_acc') }}" style="float: left; background-color: #48145B" >Add Investigator&nbsp;&nbsp;<i class="fa-solid fa-plus"></i> </a> 
                    </div> 

                    <div class="tab">
                        <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'active')">Active Accounts</button>
                        <button class="tablinks" onclick="openCity(event, 'inactive')">Inactive Accounts</button> 
                    </div>
                    
                    <div id="active" class="active col-12 tabcontent" style="display:block;overflow-x:auto; background-color: white;  margin-bottom: 5rem">
                        <div class="card" style="padding: 1rem; margin: 1rem">
                            @if(Session::has('success')) 
                                <div class="alert success" role="alert">
                                    <b>{{ session::get('success') }}</b>
                                </div>
                            @endif

                            @if(Session::has('updated')) 
                                <div class="alert updated" role="alert">
                                    <b>{{ session::get('updated') }}</b>
                                </div>
                            @endif

                            @if(Session::has('delete')) 
                                <div class="alert delete" role="alert">
                                    <b>{{ session::get('delete') }}</b>
                                </div>
                            @endif
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr>  
                                        <th>Fullname</th>
                                        <th>Username</th> 
                                        <th>Team</th> 
                                        <th>Status</th>
                                        <th>Change Status</th> 
                                        <th>Created At</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    @foreach ($invs as $inv) 
                                    <tr>   
                                        <td>{{ $inv->firstname }} {{ $inv->lastname }}</td>
                                        <td>{{ $inv->username }}</td> 
                                        <td>
                                            @if ($inv->team == 'team_a')
                                                Team A
                                            @elseif ($inv->team == 'team_b')
                                                Team B
                                            @endif 
                                        </td>    
                                        <td>
                                            @if ($inv->status == 'active')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="ACTIVE" style="background-color: palegreen; font-weight: bold; color: darkgreen; width: 5.5rem; border: none; font-size: medium" readonly>
                                            @elseif ($inv->status == 'inactive')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="INACTIVE" style="background-color: pink; font-weight: bold; color: darkred; width: 6rem; border: none; font-size: medium" readonly>
                                            @endif
                                        </td> 
                                        <td> 
                                            <form action="{{ route('superadmin.change_status', $inv->id) }}" method="post">
                                                @csrf
                                                <select class="form-control" name="status" style="border-radius: 0.3125rem; border: 2.5px solid #48145B; background: #FFF; width: 8rem; padding: 0.4rem; font-size: medium; margin-bottom: 0.5rem" required>
                                                    <option value="">Select status:</option>
                                                    <option value="active">ACTIVE</option>
                                                    <option value="inactive">INACTIVE</option> 
                                                </select>
                                                <button type="submit" class="form-buttons" > Change status </button>
                                            </form>
                                        </td> 
                                        <td>{{ $inv->created_at }}</td>
                                        <td>
                                            <center>  
                                                {{-- <a class="view-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href=" ">&nbsp;&nbsp;&nbsp;Change Password <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a>  --}}
                                                <a class="edit-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href="{{ route('superadmin.edit_investigator_acc', $inv->id) }}">&nbsp;&nbsp;&nbsp;Edit <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a> 
                                                {{-- <a class="delete-btn" onclick="return confirm('Are you sure you want to DELETE this record?')" href=" ">&nbsp;&nbsp;&nbsp;Delete <i class="fa fa-trash" style="font-size: large; padding: 0.5rem"></i></a> --}}
                                            </center>
                                        </td>
                                    </tr>  
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                             
                        </div>
                    </div>

                    <div id="inactive" class=" col-12 tabcontent" style="display:block;overflow-x:auto; background-color: white;  margin-bottom: 5rem">
                        <div class="card" style="padding: 1rem; margin: 1rem">
                            @if(Session::has('success')) 
                                <div class="alert success" role="alert">
                                    <b>{{ session::get('success') }}</b>
                                </div>
                            @endif

                            @if(Session::has('updated')) 
                                <div class="alert updated" role="alert">
                                    <b>{{ session::get('updated') }}</b>
                                </div>
                            @endif

                            @if(Session::has('delete')) 
                                <div class="alert delete" role="alert">
                                    <b>{{ session::get('delete') }}</b>
                                </div>
                            @endif
                            <table id="example1" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr>  
                                        <th>Fullname</th>
                                        <th>Username</th> 
                                        <th>Team</th> 
                                        <th>Status</th>
                                        <th>Change Status</th> 
                                        <th>Created At</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    @foreach ($inacts as $inact) 
                                    <tr>   
                                        <td>{{ $inact->firstname }} {{ $inact->lastname }}</td>
                                        <td>{{ $inact->username }}</td> 
                                        <td>
                                            @if ($inact->team == 'team_a')
                                                Team A
                                            @elseif ($inact->team == 'team_b')
                                                Team B
                                            @endif 
                                        </td>    
                                        <td>
                                            @if ($inact->status == 'active')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="ACTIVE" style="background-color: palegreen; font-weight: bold; color: darkgreen; width: 5.5rem; border: none; font-size: medium" readonly>
                                            @elseif ($inact->status == 'inactive')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="INACTIVE" style="background-color: pink; font-weight: bold; color: darkred; width: 6.5rem; border: none; font-size: medium" readonly>
                                            @endif
                                        </td> 
                                        <td> 
                                            <form action="{{ route('superadmin.change_status', $inact->id) }}" method="post">
                                                @csrf
                                                <select class="form-control" name="status" style="border-radius: 0.3125rem; border: 2.5px solid #48145B; background: #FFF; width: 8rem; padding: 0.4rem; font-size: medium; margin-bottom: 0.5rem" required>
                                                    <option value="">Select status:</option>
                                                    <option value="active">ACTIVE</option>
                                                    <option value="inactive">INACTIVE</option> 
                                                </select>
                                                <button type="submit" class="form-buttons" > Change status </button>
                                            </form>
                                        </td> 
                                        <td>{{ $inact->created_at }}</td>
                                        <td>
                                            <center>  
                                                {{-- <a class="view-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href=" ">&nbsp;&nbsp;&nbsp;Change Password <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a>  --}}
                                                <a class="edit-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href="{{ route('superadmin.edit_investigator_acc', $inact->id) }}">&nbsp;&nbsp;&nbsp;Edit <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a> 
                                                {{-- <a class="delete-btn" onclick="return confirm('Are you sure you want to DELETE this record?')" href=" ">&nbsp;&nbsp;&nbsp;Delete <i class="fa fa-trash" style="font-size: large; padding: 0.5rem"></i></a> --}}
                                            </center>
                                        </td>
                                    </tr>  
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                             
                        </div>
                    </div>
                </div>
            </div> 
        @endsection
    </body>
</html>
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable({
        "order": [[0, "desc"]]
        });
    });  

    document.addEventListener("DOMContentLoaded", function() { 
      document.getElementById("defaultOpen").click();
    });

    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>

<script>
    let inactiveTime = 0;
    const logoutTime = 5 * 60 * 1000;
    // 5 * 60 * 1000; // 5 minutes in milliseconds
    
    function resetInactiveTime() {
        inactiveTime = 0;
    }
    
    function handleUserActivity() {
        resetInactiveTime();
    }
    
    document.addEventLisstener('mousemove', handleUserActivity);
    document.addEventListener('keydown', handleUserActivity);
    
    function checkInactiveTime() {
        inactiveTime += 1000; 
        if (inactiveTime >= logoutTime) { 
            window.location.href = "/inactive_screen"; 
        } else { 
            setTimeout(checkInactiveTime, 1000); 
        }
    }
    
    setTimeout(checkInactiveTime, 1000); // Check every 1 second initially

</script>
