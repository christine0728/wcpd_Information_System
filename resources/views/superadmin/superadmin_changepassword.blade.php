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
        <title>SuperAdmin | Change Password</title>
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
                            <h1 class="m-0" style="font-weight: bold;">{{ __('Change Own Password') }}</h1>
                        </div> 

                        <div class="col-12">
                            &nbsp;&nbsp;<a class="link-buttons" href="#" onclick="window.history.back();" style="background-color: #48145B; margin-right: 0.1rem" ><i class="fa-solid fa-arrow-left icons"></i>&nbsp;&nbsp;Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
  

            <div class="content" style="margin-top: -2rem; margin-bottom: 2rem">
                <div class="container-fluid" >   
                    <div class="card col-5 shadow p-3 mb-5 bg-white rounded" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-left: 25%;"> 
                        @if(Session::has('error')) 
                            <b style="color: red">{{ session::get('error') }}</b> 
                        @endif

                        <div class="card-body p-1"> 
                            <form action="{{ route('superadmin.changing_password') }}" method="post">
                                @csrf
                                <div class="card-body p-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" oninput="toUpper(this)" value="{{ old('username') }}">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="curr_password">Current password:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="curr_password" name="curr_password" value="{{ old('curr_password') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="toggleCurrPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="new_password">New password:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password" name="new_password" value="{{ old('new_password') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                </div> 
                                <div class="col-12">
                                    <button type="submit" class="form-buttons" style="width: 100%">Change Password</button>
                                </div>
                            </form>
                        </div>  
                    </div> 
                </div>
            </div> 
        @endsection
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleCurrPassword = document.querySelector('#toggleCurrPassword');
        const currPasswordInput = document.querySelector('#curr_password');

        toggleCurrPassword.addEventListener('click', function() {
            const type = currPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            currPasswordInput.setAttribute('type', type);

            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#new_password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    });
</script>
<script>
    // let inactiveTime = 0;
    // const logoutTime = 2 * 60 * 1000;
    // // 5 * 60 * 1000; // 5 minutes in milliseconds
    
    // function resetInactiveTime() {
    //     inactiveTime = 0;
    // }
    
    // function handleUserActivity() {
    //     resetInactiveTime();
    // }
    
    // document.addEventListener('mousemove', handleUserActivity);
    // document.addEventListener('keydown', handleUserActivity);
    
    // function checkInactiveTime() {
    //     inactiveTime += 1000; 
    //     if (inactiveTime >= logoutTime) { 
    //         window.location.href = "/inactive_screen"; 
    //     } else { 
    //         setTimeout(checkInactiveTime, 1000); 
    //     }
    // }
    
    // setTimeout(checkInactiveTime, 1000); // Check every 1 second initially

</script>