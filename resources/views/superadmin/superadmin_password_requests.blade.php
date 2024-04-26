<!-- superadmin/notifications.blade.php -->

{{-- <h1>Notifications</h1>

@foreach($notifications as $notification)
    <div>
        <strong>{{ $notification->description }}</strong>
        <p>{{ $notification->status }}</p>
        <small>{{ $notification->created_at->diffForHumans() }}</small>
    </div>
@endforeach --}}

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
        <title>SuperAdmin | Password Requests</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24"> 

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
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

            .notif div:hover{
                background-color: #f0f0f0 !important;
                border-radius: 0.5rem !important;
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
                            <h1 class="m-0" style="font-weight: bold;">&nbsp;{{ __('Password Requests') }}</h1>
                        </div> 
                    </div>
                </div>
            </div>
  

            <div class="content" style="margin-top: -1rem; ">
                <div class="container-fluid" >   
                    <div class=" col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: -1.5rem; margin-bottom: 2rem">
                        {{-- <div class="card-body p-1">  --}}
                            @foreach($notifications as $notification)
                                @if ($notification->status == 'unread')
                                    <a href="{{ route('superadmin.inv_changepass_req', [$notification->nid, $notification->iid]) }}" ><div class="card notif" style="margin: 1rem; ">   
                                        <div class="card-body row" > 
                                            {{-- <div class="col-2" style="padding: 0rem"> 
                                                <div class="col-12" style="border-radius: 5rem; background-color: white; width: 18%"> 
                                                </div>
                                            </div> --}}
                                            <div class="col-6" style="padding: 0rem"> 
                                                <b>{{ $notification->firstname }} {{ $notification->lastname }}</b> {{ $notification->description }}   
                                                <br><span style="font-size: 0.9rem; font-style: italic">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="col-6" style="padding: 0rem; margin-top: 0.3rem"> 
                                                {{-- {{ $notification->created_at->diffForHumans() }}  --}}
                                                @if ($notification->status == 'unread')
                                                    <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="Unread" style="background-color: lightgrey; font-weight: bold; color: black; width: 5rem; border: none; font-size: medium; float: right" readonly>
                                                @elseif ($notification->description == 'read')
                                                    <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="INACTIVE" style="background-color: lightblue; font-weight: bold; color: black; width: 5.5rem; border: none; font-size: medium; float: right" readonly>
                                                @endif
                                            </div> 
                                            {{-- <div class="col-12">
                                                <a href="#" class="card-link">Card link</a>
                                                <a href="#" class="card-link">Another link</a>
                                            </div> --}}

                                        </div>  
                                    </div></a>
                                @else
                                    <a href="{{ route('superadmin.inv_changepass_req', [$notification->nid, $notification->iid]) }}" class="notif"><div class="card" style="margin: 1rem; " >   
                                        <div class="card-body row" >  
                                            <div class="col-6" style="padding: 0rem"> 
                                                <b>{{ $notification->firstname }} {{ $notification->lastname }}</b> {{ $notification->description }}   
                                                <br><span style="font-size: 0.9rem; font-style: italic">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="col-6" style="padding: 0rem; margin-top: 0.3rem">  
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="Read" style="background-color:#b5e8ff; font-weight: bold; color: black; width: 4rem; border: none; font-size: medium; float: right" readonly> 
                                            </div>  

                                        </div>  
                                    </div></a>
                                @endif
                            @endforeach
                        {{-- </div> --}}
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
    function showAlert(event) {
      event.preventDefault();
      alert('Notification is already read.');
    }
  </script>
{{-- <script>
    let inactiveTime = 0;
    const logoutTime = 5 * 60 * 1000;
    // 5 * 60 * 1000; // 5 minutes in milliseconds
    
    function resetInactiveTime() {
        inactiveTime = 0;
    }
    
    function handleUserActivity() {
        resetInactiveTime();
    }
    
    document.addEventListener('mousemove', handleUserActivity);
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

</script> --}}
