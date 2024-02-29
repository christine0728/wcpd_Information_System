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
        <title>SuperAdmin | Account Management</title>
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
                            <h1 class="m-0" style="font-weight: bold;">&nbsp;{{ __('Investigator Account Management') }}</h1>
                        </div> 
                    </div>
                </div>
            </div>
 
            <div class="content" style="margin-top: -2rem">
                <div class="container-fluid">
                    <div class="col-12">
                        <a class="link-buttons" href="{{ route('superadmin.add_investigator_acc') }}" style="float: left; background-color: #48145B" target="_blank" >Add Investigator&nbsp;&nbsp;<i class="fa-solid fa-plus"></i> </a> 
                    </div> 
                    
                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 5rem">
                        <div class="card-body p-1">
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr>  
                                        <th>Fullname</th>
                                        <th>Username</th> 
                                        <th>Team</th>
                                        <th>Change Team</th> 
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
                                            <form action="{{ route('superadmin.change_team', $inv->id) }}" method="post">
                                                @csrf
                                                <select class="form-control" name="team" style="border-radius: 0.3125rem; border: 2.5px solid #48145B; background: #FFF; width: 8rem; padding: 0.4rem; font-size: medium; margin-bottom: 1rem;">
                                                    <option>Select team:</option>
                                                    <option value="team_a">Team A</option>
                                                    <option value="team_b">Team B</option> 
                                                </select>
                                                <button type="submit" class="form-buttons" > Change status </button>
                                            </form>
                                        </td> 
                                        <td>
                                            @if ($inv->status == 'active')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="ACTIVE" style="background-color: palegreen; font-weight: bold; color: darkgreen; width: 5rem; border: none; font-size: medium" readonly>
                                            @elseif ($inv->status == 'inactive')
                                                <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="INACTIVE" style="background-color: pink; font-weight: bold; color: darkred; width: 5.5rem; border: none; font-size: medium" readonly>
                                            @endif
                                        </td> 
                                        <td> 
                                            <form action="{{ route('superadmin.change_status', $inv->id) }}" method="post">
                                                @csrf
                                                <select class="form-control" name="status" style="border-radius: 0.3125rem; border: 2.5px solid #48145B; background: #FFF; width: 8rem; padding: 0.4rem; font-size: medium; margin-bottom: 1rem">
                                                    <option>Select status:</option>
                                                    <option value="active">ACTIVE</option>
                                                    <option value="inactive">INACTIVE</option> 
                                                </select>
                                                <button type="submit" class="form-buttons" > Change status </button>
                                            </form>
                                        </td> 
                                        <td>{{ $inv->created_at }}</td>
                                        <td>
                                            <center>  
                                                <a class="view-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href=" ">&nbsp;&nbsp;&nbsp;Change Password <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a> 
                                                <a class="edit-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href="{{ route('superadmin.edit_investigator_acc', $inv->id) }}">&nbsp;&nbsp;&nbsp;Edit <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a> 
                                                <a class="delete-btn" onclick="return confirm('Are you sure you want to DELETE this record?')" href=" ">&nbsp;&nbsp;&nbsp;Delete <i class="fa fa-trash" style="font-size: large; padding: 0.5rem"></i></a>
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