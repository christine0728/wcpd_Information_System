<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Records</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
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
                            <h1 class="m-0">&nbsp;<b>{{ __('All Records') }}</b></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="filter">
                            <form action="filter-allrecords" method="GET">
                            <div class="date-filter">
                                <label for="start_date">From:</label>&nbsp;&nbsp;
                                <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $start_date ?? old('start_date') }}" max="{{ date('Y-m-d') }}" required>&nbsp;&nbsp;
                                <label for="end_date">To:</label>&nbsp;&nbsp;
                                <input type="date" class="form-control" name="end_date" id="end_date" max="{{ date('Y-m-d') }}" value="{{ $end_date ?? old('end_date') }}" required>&nbsp;&nbsp;
                                <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                <a href="{{ route('investigator.allrecords') }}"><button type="button" class="link-buttons" style="background-color: #48145B"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 5rem">
                        <div class="card-body p-1">
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr> 
                                        <th>View</th>
                                        <th>Complaint Report Author</th>
                                        <th>Case Details</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($comps as $comp)  
                                    <tr>  
                                        <td style="vertical-align: top;">
                                            <center>
                                                <a class="view-btn" href="{{ route('investigator.readonly_complaintreport', $comp->id) }}" target="_blank">&nbsp;&nbsp;&nbsp;View <i class="fa-regular fa-eye" style="font-size: large; padding: 0.5rem"></i></a>
                                            </center>
                                        </td>
                                        <td style="vertical-align: top;">{{ $comp->username }} ({{ $comp->team }})</td>
                                        <td>
                                            <b>Date Reported:</b> {{ $comp->date_reported }}
                                            <br><b>Investigation/Case No.:</b> {{ $comp->inv_case_no }}
                                            <br><b>Place of Commission:</b> {{ $comp->place_of_commission }}
                                            <br><b>Offenses Committed:</b> {{ $comp->offenses }}
                                            <br><b>Motive/Cause:</b> {{ $comp->evidence_motive_cause }}
                                            <br><b>Case Disposition:</b> {{ $comp->case_disposition }}
                                            <br><b>Suspect Disposition:</b> {{ $comp->suspect_disposition }}
                                            <br><b>Case Update:</b> 
                                                @if ($comp->case_update == null) 
                                                    Case not updated yet.
                                                @else
                                                    {{ $comp->case_update }}
                                                @endif
                                            <br><b>Date of Case Updated:</b>
                                                @if ($comp->case_update == null) 
                                                    Case not updated yet.
                                                @else
                                                    {{ $comp->date_case_updated }}
                                                @endif
                                        </td>
                                        {{-- <td>
                                            <b>Victim Overview</b>
                                            <br>Fullname: {{ $comp->victim_firstname }} {{ strtoupper(substr($comp->victim_middlename, 0, 1)) }}. {{ $comp->victim_family_name }}
                                            <br>Sex: {{ $comp->victim_sex }}
                                            <br>Age: {{ $comp->victim_age }}

                                            <br><b>Offender Overview</b>
                                            <br>Fullname: {{ $comp->offender_firstname }} {{ strtoupper(substr($comp->offender_middlename, 0, 1)) }}. {{ $comp->offender_family_name }}
                                            <br>Sex: {{ $comp->offender_sex }}
                                            <br>Age: {{ $comp->offender_age }}
                                        </td> --}}
                                        {{-- <td>{{ $comp->date_reported }}</td> --}}
                                        {{-- <td>{{ $comp->place_of_commission }}</td>
                                        <td>{{ $comp->offenses }}</td> 
                                        <td>{{ $comp->victim_firstname }} {{ strtoupper(substr($comp->victim_middlename, 0, 1)) }}. {{ $comp->victim_family_name }}</td>
                                        <td>{{ $comp->victim_sex }}</td>
                                        <td>{{ $comp->victim_age }}</td>
                                        <td>{{ $comp->offender_firstname }} {{ strtoupper(substr($comp->offender_middlename, 0, 1)) }}. {{ $comp->offender_family_name }}</td>
                                        <td>{{ $comp->offender_age }}</td>
                                        <td>{{ $comp->offender_sex }}</td>
                                        <td>{{ $comp->offender_relationship_victim }}</td>
                                        <td>{{ $comp->evidence_motive_cause }}</td>
                                        <td>{{ $comp->case_disposition }}</td>
                                        <td>{{ $comp->suspect_disposition }}</td>
                                        <td> 
                                            @if ($comp->case_update == null) 
                                                Case not updated yet.
                                            @else
                                                {{ $comp->case_update }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($comp->case_update == null) 
                                                Case not updated yet.
                                            @else
                                                {{ $comp->date_case_updated }}
                                            @endif
                                        </td> --}}
                                        {{-- <td>
                                        <center> 
                                            <a class="case-btn" href=" ">&nbsp;&nbsp;&nbsp;Update Case <i class="fa-regular fa-file" style="font-size: large; padding: 0.5rem"></i></a>  
                                            <a class="edit-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href="{{ route('investigator.edit_complaintreport', $comp->id) }}">&nbsp;&nbsp;&nbsp;Edit <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a> 
                                            <a class="delete-btn" onclick="return confirm('Are you sure you want to DELETE this record?')" href="{{ route('investigator.delete_form', $comp->id) }}">&nbsp;&nbsp;&nbsp;Delete <i class="fa fa-trash" style="font-size: large; padding: 0.5rem"></i></a>
                                        </center>
                                        </td> --}}
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
    var myInput1 = document.getElementById("myInput1");

    var storedValue1 = localStorage.getItem("myInputValue1");

    if (storedValue1) {
        myInput1.value = storedValue1;
    }

    myInput1.addEventListener("input", function() {
        localStorage.setItem("myInputValue1", myInput1.value);
    });

    document.addEventListener('DOMContentLoaded', function() {
    var inputElement = document.getElementById('myInput1');
    inputElement.value = '';  
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
