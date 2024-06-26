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

                    <div class="col-12">
                        &nbsp;&nbsp;<a class="link-buttons" href="#"  onclick="window.history.back();" style="background-color: #48145B; margin-right: 0.1rem" ><i class="fa-solid fa-arrow-left icons"></i>&nbsp;&nbsp;Go Back</a>
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

                                            @if ($errors->has('off_familyname')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_familyname') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_firstname" oninput="toUpper(this)" value="{{ $comp->offender_firstname }}"   >

                                            @if ($errors->has('off_firstname')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_firstname') }}</span>
                                            @endif
                                        </div> 
                                    </div> 
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Middle name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_middlename" oninput="toUpper(this)" value="{{ $comp->offender_middlename }}"   >

                                            @if ($errors->has('off_middlename')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_middlename') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                </div>

                                <div class="row" style="margin-top: -1.5rem">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Aliases: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases" oninput="toUpper(this)" value="{{ $comp->offender_aliases }}"   >

                                            @if ($errors->has('off_aliases')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_aliases') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-3" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">10. Sex: </label>
                                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_gender" value="{{ $comp->offender_sex }}"   > --}}

                                            <select class="form-control" name="off_gender">
                                                <option value="{{ $comp->offender_sex }}">Select sex</option>
                                                <option value="FEMALE">Female</option>
                                                <option value="MALE">Male</option>
                                            </select>
    
                                            @if ($errors->has('off_gender')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_gender') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_age" oninput="toUpper(this)" value="{{ $comp->offender_age }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-3" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date of birth: </label>
                                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth" value="{{ $comp->offender_date_of_birth }}"   >

                                            @if ($errors->has('off_date_birth')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_date_birth') }}</span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>  
                                <div class="row" style="margin-top: -1.5rem">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">25. Civil Status: </label>
                                            <select class="form-control" name="off_civil_stat">
                                                <option value="">Select civil status</option>
                                                <option value="SINGLE">Single</option>
                                                <option value="LIVE-IN">Live-in</option>
                                                <option value="MARRIED">Married</option>
                                                <option value="WIDOW/ER">Widow/er</option>
                                                <option value="SEPARATED">Separated</option>
                                            </select>
    
                                            @if ($errors->has('off_civil_stat')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_civil_stat') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_educ_attainment" oninput="toUpper(this)" value="{{ $comp->offender_highest_educ_attainment }}"   > --}}

                                            <select class="form-control" name="off_educ_attainment" onchange="showfield(this.options[this.selectedIndex].value)">
                                                <option value="{{ $comp->offender_highest_educ_attainment }}">Select highest educational attainment</option>
                                                <option value="ELEMENTARY">Elementary</option>
                                                <option value="HS GRADUATE">HS Graduate</option>
                                                <option value="COLLEGE GRAD">College Graduate</option>
                                                <option value="POST GRADUATE">Post Graduate</option>
                                                <option value="Others2">Others</option> 
                                            </select>
                                            @if ($errors->has('off_educ_attainment')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_educ_attainment') }}</span>
                                            @endif
                                            <div id="div2" style="margin-top: 1rem"></div>
                                        </div> 
                                    </div>
                                    <div class="col-4" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nationality: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_nationality" value="{{ $comp->offender_nationality }}"   >

                                            @if ($errors->has('off_nationality')) 
                                                <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_nationality') }}</span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div> 
                            </div>
                                
                        </div> 
                        <div class="row" style="margin-top: -3rem">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Previous Criminal Record/s</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="crim_rec_specify" oninput="toUpper(this)" value="{{ $comp->offender_prev_criminal_rec }}"   >
                                </div> 
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employment Information - Occupation: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_occupation" value="{{ $comp->offender_employment_info_occupation }}"> 

                                    @if ($errors->has('off_occupation')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_occupation') }}</span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Known Address: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_last_addr" value="{{ $comp->offender_last_known_addr }}">  

                                    @if ($errors->has('off_last_addr')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_last_addr') }}</span>
                                    @endif
                                </div> 
                            </div>  
                        </div> 

                        <div class="row" style="margin-top: -1.5rem">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Place of birth: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_place_birth" value="{{ $comp->offender_place_of_birth }}" >  

                                    @if ($errors->has('off_place_birth')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_place_birth') }}</span>
                                    @endif
                                </div> 
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Relationship to victim: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim" value="{{ $comp->offender_relationship_victim }}" > 

                                    @if ($errors->has('rel_to_victim')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('rel_to_victim') }}</span>
                                    @endif
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#compsTbl').DataTable({
        "order": [[0, "desc"]]
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
    
    document.addEventLisstener('mousemove', handleUserActivity);
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