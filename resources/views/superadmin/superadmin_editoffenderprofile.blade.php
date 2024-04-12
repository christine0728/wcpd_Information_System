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

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


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
                        <form action="{{ route('superadmin.update_offender', [$oid]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($comps as $comp) 
                            <div class="row mb-4">
                                <div class="col-md-3 text-center">
                                    @if($comp->offender_image)
                                        <img src="{{ asset('images/offenders/' . $comp->offender_image) }}" alt="{{ $comp->off_firstname }}" class="img-thumbnail" style="max-width: 100%; max-height: 100%;">
                                        <input type="hidden" name="off_image_inp" value="{{ $comp->offender_image }}">  

                                        <span style="font-size: small">Uploaded Image last: {{ \Carbon\Carbon::parse($comp->created_at)->format('Y-m-d, g:i a') }}</span>
                                    @else
                                        <p>No Image</p>
                                    @endif
                                </div>

                                <div class="col-md-9">  
                                    <div class="row" style="margin-top: -1.5rem">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Family name:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_familyname" oninput="toUpper(this)" value="{{ $comp->offender_family_name }}"   >
                                            </div> 
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">First name:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_firstname" oninput="toUpper(this)" value="{{ $comp->offender_firstname }}"   >
                                            </div> 
                                        </div> 
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Middle name:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_middlename" oninput="toUpper(this)" value="{{ $comp->offender_middlename }}"   >
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: -1.5rem">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Aliases: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases" oninput="toUpper(this)" value="{{ $comp->offender_aliases }}"   >
                                            </div> 
                                        </div>
                                        <div class="col-3" >
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">10. Sex: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_gender" value="{{ $comp->offender_sex }}"   >
                                            </div> 
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Age: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_age" oninput="toUpper(this)" value="{{ $comp->offender_age }}"   >
                                            </div> 
                                        </div>
                                        <div class="col-3" >
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Date of birth: </label>
                                                <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth" value="{{ $comp->offender_date_of_birth }}"   >
                                            </div> 
                                        </div> 
                                    </div>  
                                    <div class="row" style="margin-top: -1.5rem">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_educ_attainment" oninput="toUpper(this)" value="{{ $comp->offender_highest_educ_attainment }}"   >
                                            </div> 
                                        </div>
                                        <div class="col-4" >
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nationality: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_nationality" value="{{ $comp->offender_nationality }}"   >
                                            </div> 
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Previous Criminal Record/s</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="crim_rec_specify" oninput="toUpper(this)" value="{{ $comp->offender_prev_criminal_rec }}"   >
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                                 
                            </div> 
                            <div class="row" style="margin-top: -3rem">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Employment Information - Occupation: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_occupation" value="{{ $comp->offender_employment_info_occupation }}"> 
                                    </div> 
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Known Address: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_last_addr" value="{{ $comp->offender_last_known_addr }}">  
                                    </div> 
                                </div>  
                            </div> 

                            <div class="row" style="margin-top: -1.5rem">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Place of birth: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_place_birth" value="{{ $comp->offender_place_of_birth }}" >  
                                    </div> 
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Relationship to victim: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim" value="{{ $comp->offender_relationship_victim }}" > 
                                    </div> 
                                </div> 

                                <div class="col-4" style="margin-top: -1rem">
                                    <div class="form-group">
                                        <label for="image">Update Offender's Image:</label>
                                        <input type="file" class="form-control" id="file" name="off_image" accept="image/*" onchange="previewImage(this)">
                                    </div>

                                    <div id="imagePreview"></div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="form-buttons" style="width: 9rem">Save Changes</button>
                                </div>
                            </div> 
                        @endforeach 
                        </form>
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

    function previewImage(input) {
            var previewContainer = document.getElementById('imagePreview');
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    previewContainer.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width:50%; max-height:50%;">';
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '';
            }
        }
</script>