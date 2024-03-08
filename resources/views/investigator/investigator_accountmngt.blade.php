<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Management</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24">
        <style>
            body {
                font-family: Arial, sans-serif;
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
        </style>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                            <h1 class="m-0">&nbsp;<b>{{ __('Account Management') }}</b></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid" >
                    <div class="row">
                        <div class="col-lg-12">  
                            <div class="card" style="overflow-x: auto; padding: 1rem">
                                <div class="card-body p-1"> 
                                    @foreach ($accs as $acc) 
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Firstname:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="{{ strtoupper($acc->firstname) }}" readonly style="font-weight: bold;">
                                            </div> 
                                        </div> 
    
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Lastname:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="{{ strtoupper($acc->lastname) }}" readonly style="font-weight: bold;">
                                            </div> 
                                        </div> 
    
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="{{ $acc->username }}" readonly style="font-weight: bold;">
                                            </div> 
                                        </div>
                                    </div>
                                     
                                    <div class="row" style="margin-top: -1rem">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Account type:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="{{ strtoupper($acc->acc_type) }}" readonly style="font-weight: bold;">
                                            </div> 
                                        </div> 
    
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Team:</label>
                                                @if ($acc->team == 'team_a')
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="TEAM A" readonly style="font-weight: bold;">
                                                @elseif ($acc->team == 'team_b')
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="TEAM B" readonly style="font-weight: bold;">
                                                @endif
                                            </div> 
                                        </div> 
    
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Status:</label>
                                                @if ($acc->status == 'active')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="ACTIVE" style="background-color: palegreen; font-weight: bold; color: darkgreen; width: 5rem; border: none; font-size: medium" readonly>

                                                @elseif ($acc->status == 'inactive')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="INACTIVE" style="background-color: pink; font-weight: bold; color: darkred; width: 5.5rem; border: none; font-size: medium" readonly>

                                                @endif
                                            </div> 
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-12">
                                            @if ($acc->change_password_req == 'none' || $acc->change_password_req == 'successful')
                                                <a class="link-buttons" href="{{ route('investigator.change_password_request') }}" style="float: left; background-color: #48145B">Request for Change Password&nbsp;&nbsp;<i class="fa-solid fa-key icons"></i> </a>
                                            @elseif ($acc->change_password_req == 'pending')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="REQUEST FOR CHANGE OF PASSWORD ALREADY SENT TO SUPERADMIN" style="background-color: yellow; font-weight: bold; color: black; width: 25rem; border: none; font-size: medium" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- /.content -->
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

<script>
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

<!-- Edit Organizational Structure Modal -->
{{-- <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Update Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('update_activity') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="edit_id" name="edit_id">
                    </div>
                    <div class="form-group">
                        <label for="barcode">Activity title:</label>
                        <input type="text" class="form-control" id="edit_activity_title" name="edit_activity_title" required placeholder="Enter the activity_title">
                    </div>
                    <div class="form-group">
                        <label for="barcode">Status:</label>
                        <input type="text" class="form-control" id="edit_status" name="edit_status" required placeholder="Enter the status">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

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

</script>