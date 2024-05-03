{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team | Complaint Report Management</title>
</head>
<body>
    <h1>COMPLAINT REPORT MANAGEMENT</h1>

    <a href="{{ route('investigator.complaintreport_form') }}">Add Complaint Report (diretso sa Complaint Report Form)</a>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Superadmin | Complaint Report Management</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24">

        <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                [class*="col-"] {
                width: 100%;
                }

                div{
                    display: none !important;
                }
            }

            .success {
                background-color: #d4edda;
                border-color: #c3e6cb;
                color: #155724;
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
                            <h1 class="m-0" style="font-weight: bold">&nbsp;{{ __('Complaint Report Management') }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content" style="margin-top: -2rem">
                <div class="container-fluid">
                    <div class="col-12">
                        <a class="link-buttons" href="{{ route('superadmin.complaintreport_form') }}" style="float: left; background-color: #48145B" >Add a Complaint Report&nbsp;&nbsp;<i class="fa-solid fa-plus"></i> </a>
                    </div>

                    <div class="col-12" style="margin-top: 1rem">
                        <div class="filter">
                            <form action="filter-compsmngt" method="GET">
                                <div class="date-filter">
                                    <label for="start_date">From:</label>&nbsp;&nbsp;
                                    <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $start_date ?? old('start_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                    <label for="end_date">To:</label>&nbsp;&nbsp;
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date ?? old('end_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                    <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                    <a href="{{ route('superadmin.complaintreport') }}"><button type="button" class="link-buttons" style="background-color: #48145B"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 5rem">
                        <div class="card-body p-1">
                            @if(Session::has('success'))
                                <div class="alert success" role="alert">
                                    <b>{{ session::get('success') }}</b>
                                </div>
                            @endif

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
                                        <th style="display: none">id</th>
                                        <th><center>CASE DETAILS</center></th>
                                        <th><center>CASE DISPOSITION</center></th>
                                        <th><center>ACTION</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comps as $comp)
                                    <tr>
                                        <td style="display: none">{{ $comp->id }}</td>
                                        <td>
                                            <b>Investigation/Case No.:</b> {{ $comp->inv_case_no }}
                                            <br><br><b>Date Reported:</b> {{ $comp->date_reported }}
                                            <br><br><b>Place of Commission:</b><br>{{ $comp->place_of_commission }}
                                            <br><br><b>Offenses Committed:</b><br>{{ $comp->offenses }}
                                        </td>
                                        <td style="vertical-align: top; width: 14rem">
                                            @if ($comp->case_update == 'not update yet')
                                                Current: {{ $comp->case_disposition }}
                                            @else
                                                Update: {{ $comp->case_update }}
                                            @endif
                                            <br>
                                            @if ($comp->case_update == null)
                                                Case not updated yet.
                                            @else
                                                {{ $comp->date_case_updated }}
                                            @endif

                                            <form action="{{ route('superadmin.change_case_status', $comp->id) }}" method="post">
                                                @csrf
                                                <select class="form-control" name="status" style="padding: 0.2rem; margin-right: 0.5rem; width: 100%; margin-top: 0.5rem" required>
                                                    <option value="">Update case:</option>
                                                    <option value="SETTLED">SETTLED</option>
                                                    <option value="CONVICTED">CONVICTED</option>
                                                    <option value="DISMISS">DISMISS</option>
                                                </select>
                                                <button type="submit" class="form-buttons" style="width: 60%; margin-top: 0.3rem; float: right"> Update Case </button>
                                            </form>
                                        </td>
                                        <td style="vertical-align: top;">
                                        <center>
                                            <a class="view-btn" href="{{ route('superadmin.view_complaintreport', $comp->id) }}" >&nbsp;&nbsp;&nbsp;View <i class="fa-regular fa-eye" style="font-size: large; padding: 0.5rem"></i></a>
                                            <br><a class="edit-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href="{{ route('superadmin.edit_complaintreport', $comp->id) }}" style="margin-top: 0.3rem">&nbsp;&nbsp;&nbsp;Edit <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a>

                                            <br><a class="delete-btn" onclick="return confirm('Are you sure you want to DELETE this record?')" href="{{ route('superadmin.delete_form', $comp->id) }}" style="margin-top: 0.3rem">&nbsp;&nbsp;&nbsp;Delete <i class="fa fa-trash" style="font-size: large; padding: 0.5rem"></i></a>
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
            <!-- /.content -->
        @endsection
    </body>

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
    // $(document).ready(function() {
    //       $('#example').DataTable({
    //         "order": [[0, "desc"]]
    //       });
    //   });

    // $(document).ready(function() {
    //     $('#comps').DataTable();
    // });

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
