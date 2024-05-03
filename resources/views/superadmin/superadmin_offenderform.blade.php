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

    <title>Superadmin | Offender Form</title>
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
    </div> 

    <div class="container row" style="margin-top: -1rem">
        <div class="header" style="background-color: white;">  
            <div class="col-12">
                <form action="{{ route('superadmin.insert_offender', [$comp_id]) }}" class="employee-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row"> 
                        <div class="form-section">
                            <div class="header">  
                                <p style="font-size: medium;"><b style="font-size: medium;">Offender's Data</b></p>
                            </div> 
                            <hr style="margin-top: -1rem">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Family name:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_familyname" oninput="toUpper(this)" value="{{ old('off_familyname') }}">

                                        @if ($errors->has('off_familyname')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_familyname') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First name:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_firstname" oninput="toUpper(this)" value="{{ old('off_firstname') }}">

                                        @if ($errors->has('off_firstname')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_firstname') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Middle name:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_middlename" oninput="toUpper(this)" value="{{ old('off_middlename') }}">

                                        @if ($errors->has('off_middlename')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_middlename') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Aliases:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases" oninput="toUpper(this)" value="{{ old('off_aliases') }}">

                                        @if ($errors->has('off_aliases')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_aliases') }}</span>
                                        @endif
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sex: </label>
                                        <select class="form-control" name="off_gender">
                                            <option value="">Select sex</option>
                                            <option value="FEMALE">Female</option>
                                            <option value="MALE">Male</option>
                                        </select>

                                        @if ($errors->has('off_gender')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_gender') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date of birth:</label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth" value="{{ old('off_date_birth') }}" max="{{ date('Y-m-d') }}">

                                        @if ($errors->has('off_date_birth')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_date_birth') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Civil Status: </label>
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
                            </div>
                            
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                        <select class="form-control" name="off_educ_attainment" onchange="showfield(this.options[this.selectedIndex].value)">
                                            <option value="">Select highest educational attainment</option>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nationality: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_nationality" oninput="toUpper(this)" value="{{ old('off_nationality') }}">

                                        @if ($errors->has('off_nationality')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_nationality') }}</span>
                                        @endif
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-5">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Previous Criminal Record:
                                    </label> 
                                    <div style="display: flex">
                                        <div class="form-check" style="margin-right: 2rem; margin-left: 2rem">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="enableDisableTextBox()">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked onclick="enableDisableTextBox()">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                No
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pls. specify:</label>
                                        <input type="text" class="form-control" id="crimspec" aria-describedby="emailHelp" name="crim_rec_specify" oninput="toUpper(this)" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Employment Information - Occupation:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_occupation" oninput="toUpper(this)" value="{{ old('off_occupation') }}">

                                        @if ($errors->has('off_occupation')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_occupation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Known Address:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_last_addr" oninput="toUpper(this)" value="{{ old('off_last_addr') }}">

                                        @if ($errors->has('off_last_addr')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_last_addr') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Place of birth:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_place_birth" oninput="toUpper(this)" value="{{ old('off_place_birth') }}">

                                        @if ($errors->has('off_place_birth')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('off_place_birth') }}</span>
                                        @endif
                                    </div>
                                </div> 
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Relationship to Victim:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim" oninput="toUpper(this)" value="{{ old('rel_to_victim') }}">

                                        @if ($errors->has('rel_to_victim')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('rel_to_victim') }}</span>
                                        @endif
                                    </div>
                                </div> 
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="image">Upload Offender's Image:</label>
                                        <input type="file" class="form-control-file" id="file" name="off_image" accept="image/*" onchange="previewImage2(this)">
                                    </div>

                                    <div id="imagePreview2"></div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-12 ">   
                           <a class="link-buttons" href="#" onclick="window.history.back();" style="float: left; background-color: #48145B; margin-right: 0.5rem">Cancel&nbsp;<i class="fa-solid fa-xmark icons"></i> </a> 

                           <input type="hidden" name="adding" value="adding">
                           <button type="submit" class="form-buttons" style="float: right;">Add Offender <i class="fa-solid fa-check icons"></i></button>

                           <a class="link-buttons" href="#" onclick="window.history.back();" style="float: right; background-color: #48145B; margin-right: 0.5rem">Back <i class="fa-solid fa-xmark icons"></i> </a>  
                        </div>
                    </div>
                </form>
            </div> 
        </div> 
    </div>

    <script>   

        function enableDisableTextBox() {
            var yesRadio = document.getElementById("flexRadioDefault1");
            var textBox = document.getElementById("crimspec"); 
            
            textBox.disabled = !yesRadio.checked;
             
            if (yesRadio.checked) {
                textBox.focus();
            }
        }

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
