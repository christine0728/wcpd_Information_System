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
                                    <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $start_date ?? old('start_date') }}">&nbsp;&nbsp;
                                    <label for="end_date">To:</label>&nbsp;&nbsp;
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date ?? old('end_date') }}">&nbsp;&nbsp;
                                    <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                    <a href="{{ route('investigator.logs') }}"><button type="button" class="link-buttons" style="background-color: #48145B">All</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 3rem; margin-bottom: 5rem">
                        <div class="card-body p-1"> 
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr>  
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
                                        <td>{{ $log->author_type }}</td>
                                        <td>{{ $log->firstname }} {{ $log->lastname }}</td>    
                                        <td><center>
                                        @if ($log->action == 'Add')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="ADD" style="background-color: palegreen; font-weight: bold; color: darkgreen; width: 3.5rem; border: none; font-size: medium" readonly>
                                        @elseif ($log->action == 'Edit')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="EDIT" style="background-color: #fff3cd; font-weight: bold; color: #856404;; width: 3.5rem; border: none; font-size: medium" readonly>
                                        @elseif ($log->action == 'Delete')
                                            <input name="" type="text" class="form-control" id="inputFname" aria-describedby="emailHelp" value="DELETE" style="background-color: pink; font-weight: bold; color: darkred; width: 5rem; border: none; font-size: medium" readonly>
                                        @endif</center>
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