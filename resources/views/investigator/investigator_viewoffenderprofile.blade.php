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
        <title>Offender's Profile</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=24">

        <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

        <style> 

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
                            <h1 class="m-0" style="font-weight: bold">&nbsp;{{ __("Offender's Profile") }}</h1>
                        </div> 
                    </div>
                </div>
            </div> 

            <div class="content" style="margin-top: -2rem;">
                <div class="container-fluid" style="margin-top: 1rem">  
                    <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-bottom: 5rem; padding: 1rem 2rem 1rem 2rem;">
                        @foreach ($comps as $comp) 
                            <div class="row mb-4"> 
                                 
                                <div class="col-md-9">  
                                    <div class="row" style="margin-top: -1.5rem">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Family name:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_familyname" oninput="toUpper(this)" value="{{ $comp->offender_family_name }}" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">First name:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_firstname" oninput="toUpper(this)" value="{{ $comp->offender_firstname }}" readonly>
                                            </div> 
                                        </div> 
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Middle name:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_middlename" oninput="toUpper(this)" value="{{ $comp->offender_middlename }}" readonly>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: -1.5rem">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Aliases: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ $comp->offender_aliases }}" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-3" >
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">10. Sex: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" value="{{ $comp->offender_sex }}" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Age: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ $comp->offender_age }}" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-3" >
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Date of birth: </label>
                                                <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" value="{{ $comp->offender_date_of_birth }}" readonly>
                                            </div> 
                                        </div> 
                                    </div>  
                                    <div class="row" style="margin-top: -1.5rem">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ $comp->offender_highest_educ_attainment }}" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-4" >
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nationality: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" value="{{ $comp->offender_nationality }}" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Previous Criminal Record/s</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ $comp->offender_prev_criminal_rec }}" readonly>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                                 
                                <div class="col-md-3 text-center">
                                    @if($comp->offender_image)
                                        <img src="{{ asset('images/offenders/' . $comp->offender_image) }}" alt="{{ $comp->vic_firstname }}" class="img-thumbnail" style="max-width: 100%; max-height: 100%;">
                                    @else
                                        <p>No Image</p>
                                    @endif
                                </div>
                            </div> 
                            <div class="row" style="margin-top: -3rem">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Employment Information - Occupation: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" value="{{ $comp->offender_employment_info_occupation }}" readonly> 
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Known Address: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" value="{{ $comp->offender_civil_status }}" readonly>  
                                    </div> 
                                </div> 
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Relationship to Victim: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_citizenship" value="{{ $comp->offender_relationship_victim }}" readonly>
                                    </div> 
                                </div> 
                                <div class="col-12">
                                    <a class="link-buttons" href="{{ route('investigator.edit_offender', $comp->id) }}" style="background-color: #48145B">Edit Profile&nbsp;&nbsp;<i class="fa fa-edit"></i></a>
                                </div>
                            </div> 
                        @endforeach 
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