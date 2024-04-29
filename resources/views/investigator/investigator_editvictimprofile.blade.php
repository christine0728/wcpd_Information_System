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
    <title>Investigator | Edit Victim's Profile</title>
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
                        <h1 class="m-0" style="font-weight: bold">&nbsp;{{ __("Edit Victim's Profile") }}</h1> 
                    </div> 

                    <div class="col-12">
                        &nbsp;&nbsp;<a class="link-buttons" href="#" onclick="window.history.back();" style="background-color: #48145B; margin-right: 0.1rem" ><i class="fa-solid fa-arrow-left icons"></i>&nbsp;&nbsp;Go Back</a>
                    </div>
                </div>
            </div>
        </div> 

        <div class="content" style="margin-top: -2rem;">
            <div class="container-fluid" style="margin-top: 1rem">  
                <div class="card col-12" style="overflow-x:auto; background-color: white; border-radius: 0.5rem; margin-bottom: 5rem; padding: 1rem 2rem 1rem 2rem;">
                    <form action="{{ route('investigator.update_victim', [$vid]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach ($comps as $comp) 
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                @if($comp->victim_image)
                                    <img src="{{ asset('images/victims/' . $comp->victim_image) }}" alt="{{ $comp->vic_firstname }}" class="img-thumbnail" style="max-width: 100%; max-height: 100%;">

                                    <input type="hidden" name="vic_image_inp" value="{{ $comp->victim_image }}">

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
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_familyname" oninput="toUpper(this)" value="{{ $comp->victim_family_name }}"  >

                                            @if ($errors->has('vic_familyname')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_familyname') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_firstname" oninput="toUpper(this)" value="{{ $comp->victim_firstname }}"  >

                                            @if ($errors->has('vic_firstname')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_firstname') }}</span>
                                            @endif
                                        </div> 
                                    </div> 
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Middle name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_middlename" oninput="toUpper(this)" value="{{ $comp->victim_middlename }}"  >

                                            @if ($errors->has('vic_middlename')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_middlename') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                </div>

                                <div class="row" style="margin-top: -1.5rem">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Aliases: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ $comp->victim_aliases }}"  >

                                            @if ($errors->has('vic_aliases')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_aliases') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-3" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">10. Sex: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_sex" value="{{ $comp->victim_sex }}"  >

                                            @if ($errors->has('vic_gender')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_gender') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_age" oninput="toUpper(this)" value="{{ $comp->victim_age }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-3" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date of birth: </label>
                                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" value="{{ $comp->victim_date_of_birth }}"  >

                                            @if ($errors->has('vic_date_birth')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_date_birth') }}</span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div> 

                                <div class="row">
                                    <div class="col-12" style="margin-top: -1.5rem">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Place of birth: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_place_birth" value="{{ $comp->victim_place_of_birth }}"  >

                                            @if ($errors->has('vic_place_birth')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_place_birth') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                                
                        </div> 
                        <div class="row" style="margin-top: -3rem">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                    {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_educ_attainment" value="{{ $comp->victim_highest_educ_attainment }}"  >  --}}

                                    <select class="form-control" name="vic_educ_attainment" onchange="showfield(this.options[this.selectedIndex].value)" value="{{ old('vic_educ_attainment') }}">
                                        <option value="{{ $comp->victim_highest_educ_attainment }}">Select highest educational attainment</option>
                                        <option value="ELEMENTARY">Elementary</option>
                                        <option value="HS GRADUATE">HS Graduate</option>
                                        <option value="COLLEGE GRAD">College Graduate</option>
                                        <option value="POST GRADUATE">Post Graduate</option>
                                        <option value="Others">Others  </option> 
                                    </select>
                                    @if ($errors->has('vic_educ_attainment')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_educ_attainment') }}</span>
                                    @endif
                                    <div id="div1" style="margin-top: 1rem"></div>
                                </div> 
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Civil Status: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_civil_stat" value="{{ $comp->victim_civil_status }}"  >  

                                    @if ($errors->has('vic_civil_stat')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_civil_stat') }}</span>
                                    @endif
                                </div> 
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Citizenship: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_citizenship" value="{{ $comp->victim_nationality }}"  >

                                    @if ($errors->has('vic_citizenship')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_citizenship') }}</span>
                                    @endif
                                </div> 
                            </div> 
                        </div>
                        
                        <div class="row" style="margin-top: -1rem">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Present Address: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_present_addr" value="{{ $comp->victim_present_address }}"  >

                                    @if ($errors->has('vic_present_addr')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_present_addr') }}</span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Provincial Address: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_prov_addr" value="{{ $comp->victim_provincial_address }}"  >

                                    @if ($errors->has('vic_prov_addr')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_prov_addr') }}</span>
                                    @endif
                                </div> 
                            </div>
                        </div> 
                        <div class="row" style="margin-top: -1rem">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Parents/Guardian Name: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_parentsname" value="{{ $comp->victim_parents_guardian_name }}"  >

                                    @if ($errors->has('vic_parentsname')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_parentsname') }}</span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employment Information - Occupation: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_occupation" value="{{ $comp->victim_employment_info_occupation }}"  >

                                    @if ($errors->has('vic_occupation')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_occupation') }}</span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="row" style="margin-top: -1rem"> 
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Identifying Documents Presented: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="docs_presented" value="{{ $comp->victim_docs_presented }}"  >

                                    @if ($errors->has('docs_presented')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('docs_presented') }}</span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact Person, Address, and Contact Number:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_contactperson" value="{{ $comp->victim_contactperson_addr_con_num }}"  >

                                    @if ($errors->has('vic_contactperson')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_contactperson') }}</span>
                                    @endif
                                </div> 
                            </div> 

                            <div class="col-4" style="margin-top: -1rem">
                                <div class="form-group">
                                    <label for="image">Update Victim's Image:</label>
                                    <input type="file" class="form-control" id="file" name="vic_image" accept="image/*" onchange="previewImage(this)">
                                </div>

                                <div id="imagePreview"></div>
                            </div>
                        </div> 

                        <div class="col-12">
                            <button type="submit" class="form-buttons" style="width: 9rem">Save Changes</button>
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