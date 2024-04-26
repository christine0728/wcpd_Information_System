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
        <title>SuperAdmin | Edit Investigator</title>
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
                            <h1 class="m-0" style="font-weight: bold;">&nbsp;{{ __('Edit Investigator Account') }}</h1>
                        </div>
                        
                        <div class="col-12">
                            &nbsp;&nbsp;<a class="link-buttons" href="#" onclick="window.history.back();" style="background-color: #48145B; margin-right: 0.1rem" ><i class="fa-solid fa-arrow-left icons"></i>&nbsp;&nbsp;Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="content" style="margin-top: -1.5rem;">
                <div class="container-fluid">   
                    <div class="row justify-content-center"> <!-- Centering the row -->
                        <div class="col-12 col-md-6"> <!-- Adjust the column size as needed -->
                            <div class="card shadow p-3 mb-5 bg-white rounded mx-auto" style="overflow-x:auto; background-color: white; border-radius: 0.5rem;"> 
                                @if(Session::has('error')) 
                                    <center><b style="color: red">{{ session::get('error') }}</b> </center>
                                @endif
        
                                <div class="card-body p-1"> 
                                    @foreach ($invs as $inv) 
                                        <form action="{{ route('superadmin.edit_investigator_details', $inv->id) }}" method="post">
                                            @csrf
                                            <div class="card-body p-1">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Firstname: </label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="firstname" value="{{ $inv->firstname }}">
                                                        </div>
                                                    </div>
        
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Lastname: </label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lastname"  value="{{ $inv->lastname }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6" style="margin-top: -1.5rem">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Username: </label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username"  value="{{ $inv->username }}">
                                                        </div>
                                                    </div>
        
                                                    <div class="col-6" style="margin-top: -1.5rem">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Team: </label>
                                                            @if ($inv->team == 'team_a')
                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="TEAM A">
                                                            @elseif ($inv->team == 'team_b')
                                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="TEAM B">
                                                            @endif  
                                                        </div> 
                                                    </div>

                                                    <div class="col-12"> 
                                                        <div style="display: flex; align-items: flex-end;">
                                                            <label for="teamSelect" class="mr-2">Change Team:</label>
                                                            <select class="form-control" id="teamSelect" name="team" style="border-radius: 0.3125rem; border: 2.5px solid #48145B; background: #FFF; width: 75%; font-size: medium; margin-right: 0.5rem;" required>
                                                                <option value="">Select here:</option>
                                                                <option value="team_a">TEAM A</option>
                                                                <option value="team_b">TEAM B</option> 
                                                            </select> 
                                                        </div>  
                                                    </div>
                                                </div> 
                                            </div> 
                                            <div class="col-12">
                                                <button type="submit" class="form-buttons" style="width: 100%">Save Changes</button>
                                            </div>
                                        </form>
                                    @endforeach
                                </div>  
                            </div> 
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

    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure to delete this book?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/admin/activity_destroy/' + id, 
                data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
                },
                success: function (response) {
                Swal.fire(
                    'Deleted!',
                    'The record has been deleted.',
                    'success'
                ).then(function () {
                    location.reload();
                });
                },
                error: function (error) {
                    console.log(error);
                Swal.fire(
                    'Error!',
                    'An error occurred while deleting the record.',
                    'error'
                );
                }
            });
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const modal = document.getElementById('modalEdit');
                const editId = this.getAttribute('data-id');
                const editactivity_title = this.getAttribute('data-activity_title');
                const editstatus = this.getAttribute('data-status'); 

                document.getElementById('edit_id').value = editId;
                document.getElementById('edit_activity_title').value = editactivity_title;
                document.getElementById('edit_status').value = editstatus; 

                document.getElementById('edit_id').value = editId;

                $(modal).modal('show');
            });
        });
    });


</script> 