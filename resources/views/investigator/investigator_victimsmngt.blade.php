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
        <title>Victims Management</title>
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
                    {{-- <div class="col-12">
                        <a class="link-buttons" href="{{ route('investigator.complaintreport_form') }}" style="float: left;" target="_blank">Add a Complaint Report&nbsp;&nbsp;<i class="fa-solid fa-plus"></i> </a> 
                    </div> --}} 
                    
                    <div class="col-12">
                        <div class="filter">
                            <form action="filter-financialsupport" method="GET">
                            <div class="date-filter">
                                <label for="start_date">From:</label>&nbsp;&nbsp;
                                <input type="date" name="start_date" class="form-control" id="start_date" value=" ">&nbsp;&nbsp;
                                <label for="end_date">To:</label>&nbsp;&nbsp;
                                <input type="date" class="form-control" name="end_date" id="end_date" value=" ">&nbsp;&nbsp;
                                <button type="submit" class="form-buttons" style="width: 20rem">Apply Filter</button>&nbsp;&nbsp;
                                <a href=" "><button type="button" class="link-buttons">All</button></a>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 5rem">
                        <div class="card-body p-1">
                            <table id="example" class="display responsive nowrap mt-5 table-responsive-sm">
                                <thead>
                                    <tr> 
                                        {{-- <th>View</th> --}}
                                        <th>Image</th>
                                        <th>Fullname</th>
                                        <th>Sex</th>
                                        <th>Age</th>
                                        <th>Civil Status</th>
                                        <th>Present Address</th>
                                        <th>Guardian Name</th>
                                        <th>Contact Person</th> 
                                        <th>Date Reported</th>
                                        <th>Offenses</th> 
                                        <th>Case Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($comps as $comp)  
                                    <tr>  
                                        {{-- <td>
                                            <center>
                                                <a class="view-btn" href="{{ route('investigator.view_complaintreport', $comp->id) }}" target="_blank">&nbsp;&nbsp;&nbsp;View <i class="fa-regular fa-eye" style="font-size: large; padding: 0.5rem"></i></a>
                                            </center>
                                        </td> --}}  
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
                                        <td>{{ $comp->victim_civil_status }}</td>
                                        <td>{{ $comp->victim_present_address }}</td>
                                        <td>{{ $comp->victim_parents_guardian_name }}</td>
                                        <td>{{ $comp->victim_contactperson_addr_con_num }}</td>
                                        <td>{{ $comp->date_reported }}</td>
                                        <td>{{ $comp->offenses }}</td> 
                                        <td> 
                                            @if ($comp->case_update == null) 
                                                Case not updated yet.
                                            @else
                                                {{ $comp->case_update }}
                                            @endif
                                        </td> 
                                        <td>
                                        <center> 
                                            <a class="view-btn" href="{{ route('investigator.view_complaintreport', $comp->id) }}" target="_blank">&nbsp;&nbsp;&nbsp;View Case<i class="fa-regular fa-eye" style="font-size: large; padding: 0.5rem"></i></a>
                                                
                                            <a class="view-btn" href="{{ route('investigator.victim_profile', $comp->id) }}" target="_blank">&nbsp;&nbsp;&nbsp;View Profile<i class="fa-regular fa-user" style="font-size: large; padding: 0.5rem"></i></a> 

                                            <a class="edit-btn" onclick="return confirm('Are you sure you want to EDIT this record?')" href="{{ route('investigator.edit_complaintreport', $comp->id) }}">&nbsp;&nbsp;&nbsp;Edit <i class="fa fa-edit" style="font-size: large; padding: 0.5rem"></i></a>  
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

                document.getElementById('edit_id').value = editId; 

                document.getElementById('edit_id').value = editId;

                $('#modalEdit').modal('show');

            });
        });
    });

</script>

<!-- Edit Organizational Structure Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Update Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="edit_id" name="edit_id"> 
                    </div>
                    <div class="form-group">
                        <label for="barcode">Activity title:</label>
                        <input type="text" class="form-control" id="edit_id" name="edit_id" required placeholder="Enter the activity_title">
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
</div>