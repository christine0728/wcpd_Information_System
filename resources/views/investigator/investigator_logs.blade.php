<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Investigator | Logs</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
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
                            <h1 class="m-0" style="font-weight: bold;">&nbsp;{{ __('Logs') }}</h1>
                        </div> 
                    </div>
                </div>
            </div>
 
            <div class="content" style="margin-top: -2rem">
                <div class="container-fluid">
                    {{-- <div class="col-12">
                        <a class="link-buttons" href="" style="float: left; background-color: #48145B" target="_blank">Add Investigator&nbsp;&nbsp;<i class="fa-solid fa-plus"></i> </a> 
                    </div>  --}}

                    <div class="col-12" style="margin-top: 1rem">
                        <div class="filter">
                            <form action="filter-logs-inv" method="GET">
                                <div class="date-filter">
                                    <label for="start_date">From:</label>&nbsp;&nbsp;
                                    <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $start_date ?? old('start_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                    <label for="end_date">To:</label>&nbsp;&nbsp;
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date ?? old('end_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                    <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                    <a href="{{ route('investigator.logs') }}"><button type="button" class="link-buttons" style="background-color: #48145B"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 3rem; margin-bottom: 5rem">
                        <div class="card-body p-1"> 
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr>  
                                        <th style="display: none"></th>
                                        <th>Author Type</th>
                                        <th>Fullname</th>  
                                        <th>Action</th> 
                                        <th>Details</th> 
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    @foreach ($logs as $log) 
                                    <tr>   
                                        <td style="display: none">{{ $log->lid }}</td> 
                                        <td>{{ $log->author_type }}</td>
                                        <td>{{ $log->firstname }} {{ $log->lastname }}</td>    
                                        <td><center>
                                        @if ($log->action == 'Add')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="ADD" style="background-color: palegreen; font-weight: bold; color: darkgreen; width: 3.5rem; border: none; font-size: medium" readonly>
                                        @elseif ($log->action == 'Edit')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="EDIT" style="background-color: #fff3cd; font-weight: bold; color: #856404; width: 3.5rem; border: none; font-size: medium" readonly>
                                        @elseif ($log->action == 'Delete')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="DELETE" style="background-color: pink; font-weight: bold; color: darkred; width: 5rem; border: none; font-size: medium" readonly>
                                        @elseif ($log->action == 'Restore')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="RESTORE" style="background-color: #b5e8ff; font-weight: bold; color: rgb(0, 0, 78); width: 5.5rem; border: none; font-size: medium" readonly>

                                        @elseif ($log->action == 'Update')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="UPDATE" style="background-color: #b5e8ff; font-weight: bold; color: rgb(0, 0, 78); width: 5.1rem; border: none; font-size: medium" readonly>
                                        @endif


                                        </td>  
                                        <td>{{ $log->details }}</td>
                                        <td>{{ $log->created_at }}</td>
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

@if(session('updatemessage'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Successfuly updated!',
        text: '{{ session('success') }}'
    });
</script>
@endif
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