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

    <title>Investigator | Complaint Report Form</title>
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
        <div class="nav nav-fill" style="background-color: white;">
            {{-- <label class="nav-link shadow-sm step0 border ml-2 active">Offense Data</label> --}}
            {{-- <label class="nav-link shadow-sm step1 border ml-2 ">Section B<br>Victim's Data</label>
            <label class="nav-link shadow-sm step2 border ml-2 ">Section C<br>Offender's Data</label> --}}
            {{-- <label class="nav-link shadow-sm step3 border ml-2 ">Evidence Data</label>
            <label class="nav-link shadow-sm step4 border ml-2 ">Case Disposition</label> --}}
        </div>
    </div> 

    <div class="container row" style="margin-top: -1rem">
        <div class="header" style="background-color: white;">  
            <div class="col-12">
                <form action="{{ route('investigator.add_complaint') }}" class="employee-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="" style="margin-bottom: 2rem">  
                            <div class="header" >  
                                <p style="font-size: medium;"><b style="font-size: medium; color: black">OFFENSE DATA</b></p>
                            </div> 
                            <hr style="margin-top: -1rem">

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">6. Day/Month/Year of Commission:</label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="datetime_commission" value="{{ old('datetime_commission') }}" max="{{ date('Y-m-d') }}">
                                        @if ($errors->has('datetime_commission')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('datetime_commission') }}</span>
                                        @endif 
                                    </div>  
                                </div>
                               
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Investigation/Case No.:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="inv_case_no" oninput="toUpper(this)" value="{{ old('inv_case_no') }}">
                                        @if ($errors->has('inv_case_no')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('inv_case_no') }}</span>
                                        @endif
                                    </div> 
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">7. Place of Commission: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" oninput="toUpper(this)" value="{{ old('place_commission') }}">
                                        @if ($errors->has('place_commission')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('place_commission') }}</span>
                                        @endif
                                    </div> 
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">8. Offenses Committed: (press CTRL to select multiple offenses) </label>
                                        <select class="form-control" name="offenses[]" multiple>  
                                            <option value="">Select:</option>
                                            @foreach ($offenses as $offense) 
                                            <option value="{{ $offense->offense_name }}">{{ $offense->offense_name }}</option>
                                            @endforeach 
                                        </select>
                                        @if ($errors->has('offenses')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('offenses') }}</span>
                                        @endif
                                    </div> 
                                </div>
                            </div>
                        </div> 
                        <div class="" style="margin-bottom: 2rem">
                            <p style="font-size: medium;"><b style="font-size: medium; color: black">EVIDENCE DATA<br></b></p>
                            <hr style="margin-top: -1rem">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Motive/Cause: </label>
                                        <select class="form-control" name="evi_motive" >
                                            <option value="">Select motive/cause</option>
                                            <option value="sex_lust">Sex/Lust</option>
                                            <option value="passion_jealousy">Passion/Jealousy</option>
                                            <option value="misunderstanding">Misunderstanding</option>
                                            <option value="revenge">Revenge</option>
                                            <option value="family_trouble">Family trouble</option>
                                            <option value="poverty">Poverty</option>
                                        </select>
                                        @if ($errors->has('offenses')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('evi_motive') }}</span>
                                        @endif
                                    </div> 
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">35. Suspect under the influence of: </label>
                                        <select class="form-control" name="influences" onchange="showfield(this.options[this.selectedIndex].value)">
                                            <option value="">Select influence</option>
                                            <option value="drugs">Drugs</option>
                                            <option value="alcohol">Alcohol</option>
                                            <option value="both">Both</option>
                                            <option value="none">None</option>
                                            <option value="Others3">Others </option>
                                        </select>
                                        @if ($errors->has('influences')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('influences') }}</span>
                                        @endif
                                        <div id="div3" style="margin-top: 1rem"></div> 
                                    </div> 
                                </div>
                            </div>
                        </div>

                        {{-- CASE DISPOSITION --}} 
                        <div class="">
                            <div class="">  
                                <p style="font-size: medium;"><b style="font-size: medium;">CASE DISPOSITION<br></b></p>
                            </div> 
                            <hr style="margin-top: -1rem">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">47. Disposition: </label>
                                        <select class="form-control" name="disposition" onchange="showfield(this.options[this.selectedIndex].value)">
                                            <option value="">Select disposition of case</option>
                                            <option value="settled_at_barangay">Settled at barangay</option>
                                            <option value="settled_by_parties">Settled by parties</option>
                                            <option value="under_police_investigation">Under police investigation</option>
                                            <option value="before_prosecution_office">Before Prosecution Office</option>
                                            <option value="filed_in_court">Filed in court</option>
                                            <option value="dismissed">Dismissed</option>
                                            <option value="referred_to_other_gov_agencies">Referred to other government agencies</option>
                                            <option value="Others4">Others </option>
                                        </select>
                                        @if ($errors->has('disposition')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('disposition') }}</span>
                                        @endif
                                        <div id="div4" style="margin-top: 1rem"></div> 
                                    </div> 
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">48. Suspect disposition: </label>
                                        <select class="form-control" name="sus_disposition" onchange="showfield2(this.options[this.selectedIndex].value)">
                                            <option value="">Select disposition of case</option>
                                            <option value="arrested">Arrested</option>
                                            <option value="at_large">At large</option>
                                            <option value="detained">Detained</option> 
                                            <option value="Others5">Others </option>
                                        </select>
                                        @if ($errors->has('sus_disposition')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('sus_disposition') }}</span>
                                        @endif
                                        <div id="div5" style="margin-top: 1rem"></div> 
                                    </div> 
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Investigator on case:</label>
                                        {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="investigator" oninput="toUpper(this)" value="{{ old('investigator') }}"> --}}

                                        <select class="form-control" name="investigator" onchange="showfield2(this.options[this.selectedIndex].value)" value="{{ old('investigator') }}">
                                            <option value="">Select investigator:</option> 
                                            @foreach ($accs as $acc) 
                                            <option value="{{ $acc->firstname }} {{ $acc->lastname }}">{{ $acc->firstname }} {{ $acc->lastname }}</option> 
                                            @endforeach
                                        </select>

                                        @if ($errors->has('investigator')) 
                                            <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('investigator') }}</span>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        </div> 


                        <div class="col-12 form-navigation">
                            <a class="link-buttons" href=" " style="float: left;">Cancel <i class="fa-solid fa-xmark icons"></i> </a> 
                            {{-- <a class="link-buttons" href=" " style="float: right;">Next</a>  --}}

                           {{-- <button type="button" class="next form-buttons" style="float: right; width: 5rem">Next <i class="fa-solid fa-arrow-right icons"></i></button>  --}}
                           <button type="submit" class="form-buttons" style="float: right;">Save <i class="fa-solid fa-check icons"></i></button>
                           <a href="/investigator/complaintreportmanagement">
                           <button type="button" class="previous form-buttons" style="float: right; margin-right: 0.5rem; width: 5rem"><i class="fa-solid fa-arrow-left icons"></i> Back</button> 
                            </a>
                        </div>
                    </div>
                </form>
            </div> 
        </div> 
    </div>

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

    <script> 
        // $(function(){
        //     var $sections = $('.'); 
        //     var $navLinks = $('.nav-link');
            
        //     function navigateTo(index){ 
        //         $sections.removeClass('current').eq(index).addClass('current'); 
                
        //         $navLinks.removeClass('active');
        //         $navLinks.eq(index).addClass('active');
                
        //         $('.form-navigation .previous').toggle(index > 0);
        //         var atTheEnd = index >= $sections.length - 1;
        //         $('.form-navigation .next').toggle(!atTheEnd);
        //         $('.form-navigation [type=submit]').toggle(atTheEnd); 

        //         $('html, body').scrollTop(0);
        //     }

        //     function curIndex(){ 
        //         return $sections.index($sections.filter('.current'));
        //     }
 
        //     $('.form-navigation .previous').click(function(){
        //         var currentIndex = curIndex();
        //         if (currentIndex > 0) {
        //             navigateTo(currentIndex - 1);
        //         }
        //     });

        //     $('.form-navigation .next').click(function(){
        //         var currentIndex = curIndex();
        //         $('.employee-form').parsley().whenValidate({
        //             group:'block-'+currentIndex
        //         }).done(function(){
        //             navigateTo(currentIndex + 1);
        //         });
        //     });

        //     $sections.each(function(index, section){
        //         $(section).find(':input').attr('data-parsley-group', 'block-'+index);
        //     });

        //     navigateTo(0); 
        // }); 

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
</html>
