<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=10">
    <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
    <link rel="stylesheet" href="https://cdn.mobiscroll.com/4.9.0/css/mobiscroll.jquery.min.css">

    <title>Investigator | Victim Form</title>
    <style>
        body {
            background-color: #D9D9D9;
            font-family: Arial, sans-serif;
            color: black !important;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem;
        }

        .header {
            /* background-color: #9947B6; */
            border-radius: 0.5rem;
            /* padding: 1rem; */
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .header img {
            width: 80%;
            max-width: 100px;
            margin-right: 1rem;
            margin-left: 6rem;
            
        }

        .header b {
            /* color: white; */
            /* font-size: clamp(1rem, 2.304rem + 3.4783vw, 2rem); */
            font-size:clamp(1rem, 2.304rem + 3.4783vw, 2rem);
        }

        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            [class*="col-"] {
            width: 100%;
            }

            .header b{
                font-size: 1.5rem;
            } 

            .header img {
                width: 40% !important;
                max-width: 100px;
                margin-right: 1rem;
                margin-left: 1rem;
            }
        }

        .form-section{
            display: none;
        }

        .form-section.current{
            display: inline;
        }

        .parsley-errors-list{
            color:red;
        }

        /* Added style for active navigation link */
        .nav-link.active {
            background-color: #9947B6;
            color: white !important;
            font-weight: bold !important;
        }

        .form-navigation {
        text-align: right;
    }

    .form-navigation .previous {
        float: left;
    }

    .form-navigation .next {
        float: right;
    } 
    </style>
</head>
<body>

    <div class="container">
        <div class="header" style="background-color: #9947B6; padding: 1rem;">
            <img src="{{ asset('images/wcpd.png') }}" alt="">
            <b style="color: white;">Women and Children Protection Center</b>
        </div> 
    </div> 

    <div class="container" style="margin-top: -2rem">
        <div class="header" style="background-color: white;">  
            <b style="font-size: x-large; padding: 0.5rem">Complaint Standard Report Form</b>
        </div> 
    </div> 

    <div class="container" style="margin-top: -2rem;">
        {{-- <div class="nav nav-fill" style="background-color: white;">
            <label class="nav-link shadow-sm step0 border ml-2 active">Section A<br>Offense Data</label> 
            <label class="nav-link shadow-sm step3 border ml-2 ">Section D<br>Evidence Data</label>
            <label class="nav-link shadow-sm step4 border ml-2 ">Section F<br>Case Disposition</label>
        </div> --}}
    </div> 

    <div class="container row" style="margin-top: -1rem">
        <div class="header" style="background-color: white;">  
            <div class="col-12">
                <form action="{{ route('investigator.insert_victim', [$comp_id]) }}" class="employee-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- <div class="form-section">  
                            <div class="header" >  
                                <p style="font-size: medium;">Section A: <b style="font-size: medium; color: black">Offense Data</b></p>
                            </div> 
                            <hr style="margin-top: -1rem">

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">6. Time/Day/Month/Year of Commission:</label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="datetime_commission">
                                    </div> 
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">7. Place of Commission: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" oninput="toUpper(this)">
                                    </div> 
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">8. Offenses Committed: (press CTRL to select multiple offenses)</label>
                                        <select class="form-control" name="offenses[]" multiple>  
                                        </select>
                                    </div> 
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-section">
                            <div class="header">  
                                <p style="font-size: medium;"><b style="font-size: medium;">Victim's Data</b></p>
                            </div> 
                            <hr style="margin-top: -1rem">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Family name:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_familyname" oninput="toUpper(this)" value="{{ old('vic_familyname') }}">

                                        {{-- @error('vic_familyname')
                                            <span class="text-danger" style="color: black">{{ $message }}</span>
                                        @enderror --}}

                                        @if ($errors->has('vic_familyname')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_familyname') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First name:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_firstname" oninput="toUpper(this)" value="{{ old('vic_firstname') }}">

                                        @if ($errors->has('vic_firstname')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_firstname') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Middle name:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_middlename" oninput="toUpper(this)" value="{{ old('vic_middlename') }}">
                                        @if ($errors->has('vic_middlename')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_middlename') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Aliases: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ old('vic_aliases') }}">
                                        @if ($errors->has('vic_aliases')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_aliases') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                            </div>
 
                            <div class="row">
                                <div class="col-2" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sex: </label>
                                        <select class="form-control" name="vic_gender" value="{{ old('vic_gender') }}">
                                            <option value="">Select sex</option>
                                            <option value="FEMALE">Female</option>
                                            <option value="MALE">Male</option>
                                        </select>
                                        @if ($errors->has('vic_gender')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_gender') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                                <div class="col-2" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date of birth: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" oninput="toUpper(this)" value="{{ old('vic_date_birth') }}"  max="{{ date('Y-m-d') }}">
                                        @if ($errors->has('vic_date_birth')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_date_birth') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                                <div class="col-8" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Place of birth: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_place_birth" oninput="toUpper(this)" value="{{ old('vic_place_birth') }}">
                                        @if ($errors->has('vic_place_birth')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_place_birth') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                        <select class="form-control" name="vic_educ_attainment" onchange="showfield(this.options[this.selectedIndex].value)" value="{{ old('vic_educ_attainment') }}">
                                            <option value="">Select highest educational attainment</option>
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
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">14. Civil Status: </label>
                                        <select class="form-control" name="vic_civil_stat"  > 
                                            <option value="">Select civil status</option>
                                            <option value="SINGLE">Single</option>
                                            <option value="LIVE-IN">Live-in</option>
                                            <option value="MARRIED">Married</option>
                                            <option value="WIDOW/ER">Widow/er</option>
                                            <option value="SEPARATED">Separated</option>
                                        </select>
                                        @if ($errors->has('vic_civil_stat')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_civil_stat') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Citizenship: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_citizenship" oninput="toUpper(this)" value="{{ old('vic_citizenship') }}">
                                        @if ($errors->has('vic_citizenship')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_citizenship') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Present Address: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_present_addr" oninput="toUpper(this)" pattern="[a-zA-Z0-9\s\.,#-]+" value="{{ old('vic_present_addr') }}">
                                        @if ($errors->has('vic_present_addr')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_present_addr') }}</span>
                                        @endif
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Provincial Address: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_prov_addr" oninput="toUpper(this)" value="{{ old('vic_prov_addr') }}">
                                        @if ($errors->has('vic_prov_addr')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_prov_addr') }}</span>
                                        @endif
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Parents/Guardian Name: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_parentsname" oninput="toUpper(this)" value="{{ old('vic_parentsname') }}">
                                        @if ($errors->has('vic_parentsname')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_parentsname') }}</span>
                                        @endif
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Employment Information - Occupation: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_occupation" oninput="toUpper(this)" value="{{ old('vic_occupation') }}">
                                        @if ($errors->has('vic_occupation')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_occupation') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">20. Identifying Documents Presented: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="docs_presented" oninput="toUpper(this)" value="{{ old('docs_presented') }}">
                                        @if ($errors->has('docs_presented')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('docs_presented') }}</span>
                                        @endif
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">21.Contact Person, Address, and Contact Number:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_contactperson" oninput="toUpper(this)" value="{{ old('vic_contactperson') }}">
                                        @if ($errors->has('vic_contactperson')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('vic_contactperson') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="image">Upload Victim's Image:</label>
                                        <input type="file" class="form-control-file" id="file" name="vic_image" accept="image/*" onchange="previewImage(this)">
                                    </div>

                                    <div id="imagePreview"></div>
                                </div>
                            </div>
                        </div>
  

                        <div class="col-12 ">  
                            {{-- <a class="link-buttons" href=" " style="float: right;">Next</a>  --}}

                           {{-- <button type="button" class="next form-buttons" style="float: right; width: 5rem">Next <i class="fa-solid fa-arrow-right icons"></i></button>  --}}
                           {{-- <button type="submit" class="form-buttons" style="float: right; " formaction="{{ route('superadmin.offender_form', [$comp_id]) }}">Next (Add Offender) <i class="fa-solid fa-check icons"></i></button> --}}
                           {{-- <a class="link-buttons" href="{{ route('investigator.offender_form', [$comp_id]) }}" style="float: right; background-color: #48145B">Next (Add Offender) <i class="fa-solid fa-xmark"></i> </a> --}}

                           <a class="link-buttons" href="#" onclick="window.history.back();" style="float: left; background-color: #48145B">Back <i class="fa-solid fa-xmark icons"></i> </a> 

                           <button type="submit" class="form-buttons" style="float: right; margin-right: 0.5rem">Add Victim <i class="fa-solid fa-check icons"></i></button>

                           
                           {{-- <button type="button" class="previous form-buttons" style="float: right; margin-right: 0.5rem; width: 5rem"><i class="fa-solid fa-arrow-left icons"></i> Back</button>  --}}
                        </div>
                    </div>
                </form>
            </div> 
        </div> 
    </div>

    <script> 
        $(function(){
            var $sections = $('.form-section'); 
            var $navLinks = $('.nav-link');
            
            function navigateTo(index){ 
                $sections.removeClass('current').eq(index).addClass('current'); 
                
                $navLinks.removeClass('active');
                $navLinks.eq(index).addClass('active');
                
                $('.form-navigation .previous').toggle(index > 0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [type=submit]').toggle(atTheEnd); 

                $('html, body').scrollTop(0);
            }

            function curIndex(){ 
                return $sections.index($sections.filter('.current'));
            }

            // Function to handle navigation when nav-link is clicked
            $navLinks.click(function() {
                var index = $(this).index(); // Get the index of the clicked nav-link
                navigateTo(index);
            });

            $('.form-navigation .previous').click(function(){
                var currentIndex = curIndex();
                if (currentIndex > 0) {
                    navigateTo(currentIndex - 1);
                }
            });

            $('.form-navigation .next').click(function(){
                var currentIndex = curIndex();
                $('.employee-form').parsley().whenValidate({
                    group:'block-'+currentIndex
                }).done(function(){
                    navigateTo(currentIndex + 1);
                });
            });

            $sections.each(function(index, section){
                $(section).find(':input').attr('data-parsley-group', 'block-'+index);
            });

            navigateTo(0); 
        }); 

        function showfield(name){
            if(name=='Others')document.getElementById('div1').innerHTML='Pls. specify: <input type="text" name="others" class="form-control" />';
            else document.getElementById('div1').innerHTML='';

            if(name=='Others2')document.getElementById('div2').innerHTML='Pls. specify: <input type="text" name="others2" class="form-control" />';
            else document.getElementById('div2').innerHTML='';

            if(name=='Others3')document.getElementById('div3').innerHTML='Pls. specify: <input type="text" name="others3" class="form-control" />';
            else document.getElementById('div3').innerHTML='';

            if(name=='Others4')document.getElementById('div4').innerHTML='Pls. specify: <input type="text" name="others4" class="form-control" />';
            else document.getElementById('div4').innerHTML='';  
        }

        function showfield2(name){   
            if(name=='Others5')document.getElementById('div5').innerHTML='Pls. specify: <input type="text" name="others5" class="form-control" />';
            else document.getElementById('div5').innerHTML='';
        } 

        mobiscroll.select('#multiple-select', {
        inputElement: document.getElementById('my-input'),
        touchUi: false
    });
    </script>
    <script>
        function toUpper(input) { 
            let value = input.value; 
            value = value.toUpperCase(); 
            input.value = value;
        }

        function previewImage(input) {
            var previewContainer = document.getElementById('imagePreview');
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    previewContainer.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width:25%; max-height:25%;">';
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '';
            }
        }

        function previewImage2(input) {
            var previewContainer = document.getElementById('imagePreview2');
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    previewContainer.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width:25%; max-height:25%;">';
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '';
            }
        }
    </script>
    
</body>
<script>
    let inactiveTime = 0;
    const logoutTime = 2 * 60 * 1000;
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