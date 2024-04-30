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

    <a href="{{ route('investigator.complaintreport_form') }}">Add Complaint Report (diretso sa Complaint Report Form)</a>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Superadmin | Victims Management</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24">

        <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>
        <style>
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
                            <h1 class="m-0" style="font-weight: bold">&nbsp;{{ __('Victims Management') }}</h1>
                        </div>  
                    </div>
                </div>
            </div>
 
            <div class="content" style="margin-top: -2rem">
                <div class="container-fluid"> 
                    
                    <div class="col-12">
                        <div class="filter">
                            <form action="filter-victimsmngt" method="GET">
                                <div class="date-filter">
                                    <label for="start_date">From:</label>&nbsp;&nbsp;
                                    <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $start_date ?? old('start_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                    <label for="end_date">To:</label>&nbsp;&nbsp;
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date ?? old('end_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                    <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                    <a href="{{ route('superadmin.victims_mngt') }}"><button type="button" class="link-buttons" style="background-color: #48145B"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 5rem">
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
                            
                        <div class="card-body p-1">
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr> 
                                        <th style="display: none"></th>
                                        <th>Image</th>
                                        <th>Fullname</th>
                                        <th>Sex</th>
                                        <th>Age</th> 
                                        <th>Present Address</th> 
                                        <th>Date Reported</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($comps as $comp)  
                                    <tr>   
                                        <td style="display: none">{{$comp->vid}}</td>
                                        <td> 
                                            @if($comp->victim_image)
                                            <img src="{{ asset('images/victims/' . $comp->victim_image) }}" alt="{{ $comp->victim_firstname }}" class="img-thumbnail" style="max-width: 110px; max-height: 110px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $comp->victim_firstname }} {{ strtoupper(substr($comp->victim_middlename, 0, 1)) }}. {{ $comp->victim_family_name }}</td>
                                        <td>{{ $comp->victim_sex }}</td> 
                                        <td>{{ $comp->victim_age }}</td> 
                                        <td>{{ $comp->victim_present_address }}</td> 
                                        <td>{{ $comp->date_reported }}</td> 
                                        <td>
                                        <center> 
                                            <a class="view-btn" href="{{ route('superadmin.view_complaintreport', $comp->compid) }}" style="margin-bottom: 0.5rem">&nbsp;&nbsp;&nbsp;View Case<i class="fa-regular fa-eye" style="font-size: large; padding: 0.5rem;"></i></a>
                                                
                                            <br><a class="view-btn" href="{{ route('superadmin.victim_profile', $comp->vid) }}">&nbsp;&nbsp;&nbsp;View Profile<i class="fa-regular fa-user" style="font-size: large; padding: 0.5rem"></i></a>  
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
        $('#compsTbl').DataTable({
        "order": [[0, "desc"]]
        });
    });  
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