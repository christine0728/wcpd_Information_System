<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?version=10">
    <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ url('images/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 

    <title>SuperAdmin | Complaint Report</title>
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
            font-size:clamp(1rem, 2.304rem + 3.4783vw, 2rem);
        }

        @media only screen and (max-width: 768px) { 
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

        .parsley-errors-list{
            color:red;
        }
 
        .nav-link.active {
            background-color: #9947B6;
            color: white !important;
            font-weight: bold !important;
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
            <div class="col-6">
                <b style="font-size: x-large; ">Complaint Standard Report Form</b>
            </div>  

            <div class="col-6">
                <a class="link-buttons" href="{{ route('superadmin.complaint_pdf', [$comp_id]) }}" style="float: right; margin-right: 0.5rem; background-color: #48145B" target="_blank">Download as PDF&nbsp;&nbsp;<i class="fa-regular fa-circle-down icons"></i> </a>
            </div>
        </div> 
    </div> 

    <div class="container row" style="margin-top: -2rem">
        <div class="header" style="background-color: white;">  
            <div class="col-12"> 
                <form>
                @foreach ($comps as $comp) 
                <div class="row">
                    <div class="form-section">  
                        <div class="header" >  
                            <p style="font-size: large;">Section A: <b style="font-size: large; color: black">Offense Data</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">6. Time/Day/Month/Year of Commission:</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="datetime_commission" value="{{ $comp->date_reported }}" readonly>
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">7. Place of Commission: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="{{ $comp->place_of_commission }}" readonly>
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">8. Offenses Committed: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="{{ $comp->offenses }}" readonly> 
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="form-section" style="margin-top: 3rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;">Section D: <b style="font-size: large;">Evidence Data</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">34. Motive/Cause: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim"value="{{ $comp->evidence_motive_cause }}" readonly> 
                                </div> 
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">35. Suspect under the influence of: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim"value="{{ $comp->evidence_influence_of }}" readonly> 
                                </div> 
                            </div>
                        </div>
                    </div>

                    {{-- CASE DISPOSITION --}}
                    <div class="form-section" style="margin-top: 3rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;">Section F: <b style="font-size: large;">Case Disposition</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">47. Disposition: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim"value="{{ $comp->case_disposition }}" readonly> 
                                </div> 
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">48. Suspect disposition: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim"value="{{ $comp->suspect_disposition }}" readonly> 
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Investigator on case:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="investigator" value="{{ $comp->investigator_on_case }}" readonly>
                                </div>
                            </div> 
                        </div>
                    </div>
                @endforeach

                    @foreach ($vics as $vic)
                    <div class="form-section" style="margin-top: 3rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;">Section B: <b style="font-size: large;">Victim's Data</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                @if($vic->victim_image)
                                    <img src="{{ asset('images/victims/' . $vic->victim_image) }}" alt="{{ $vic->vic_firstname }}" class="img-thumbnail" style="max-width: 100%; max-height: 100%; margin-left: 0rem">
                                @else
                                    <p>No Image</p>
                                @endif
                            </div>

                            <div class="col-md-9">  
                                <div class="row" style="margin-top: -1rem">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Family name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_familyname" oninput="toUpper(this)" value="{{ $vic->victim_family_name }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_firstname" oninput="toUpper(this)" value="{{ $vic->victim_firstname }}" readonly>
                                        </div> 
                                    </div> 
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Middle name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_middlename" oninput="toUpper(this)" value="{{ $vic->victim_middlename }}" readonly>
                                        </div> 
                                    </div>
                                </div>

                                <div class="row" >
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Aliases: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ $vic->victim_aliases }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-3" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">10. Sex: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" value="{{ $vic->victim_sex }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" oninput="toUpper(this)" value="{{ $vic->victim_age }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-3" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date of birth: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" value="{{ $vic->victim_date_of_birth }}" readonly>
                                        </div> 
                                    </div> 
                                </div>  
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="col-12" style="margin-top: -1.5rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Place of birth: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_place_birth" value="{{ $vic->victim_place_of_birth }}" readonly>
                                </div> 
                            </div>
                        </div> 
                        
                        <div class="row" >
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" value="{{ $vic->victim_highest_educ_attainment }}" readonly> 
                                </div> 
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Civil Status: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth" value="{{ $vic->victim_civil_status }}" readonly>  
                                </div> 
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Citizenship: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_citizenship" value="{{ $vic->victim_nationality }}" readonly>
                                </div> 
                            </div> 
                        </div>
                        
                        <div class="row" >
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Present Address: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_present_addr" value="{{ $vic->victim_present_address }}" readonly>
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Provincial Address: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_prov_addr" value="{{ $vic->victim_provincial_address }}" readonly>
                                </div> 
                            </div>
                        </div> 
                        <div class="row" >
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Parents/Guardian Name: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_parentsname" value="{{ $vic->victim_parents_guardian_name }}" readonly>
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employment Information - Occupation: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_occupation" value="{{ $vic->victim_employment_info_occupation }}" readonly>
                                </div> 
                            </div>
                        </div>

                        <div class="row" > 
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Identifying Documents Presented: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="docs_presented" value="{{ $vic->victim_docs_presented }}" readonly>
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact Person, Address, and Contact Number:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_contactperson" value="{{ $vic->victim_contactperson_addr_con_num }}" readonly>
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">21.Contact Person, Address, and Contact Number:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_contactperson" value="{{ $vic->victim_contactperson_addr_con_num }}" readonly>
                                </div> 
                            </div> 
                        </div>
                    </div>
                    @endforeach

                    @foreach ($offs as $off)
                    <div class="form-section" style="margin-top: 3rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;">Section C: <b style="font-size: large;">Offender's Data</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                @if($off->offender_image)
                                    <img src="{{ asset('images/offenders/' . $off->offender_image) }}" alt="{{ $off->off_firstname }}" class="img-thumbnail" style="max-width: 100%; max-height: 100%; margin-left: 0rem">
                                @else
                                    <p>No Image</p>
                                @endif
                            </div>

                            <div class="col-md-9">  
                                <div class="row" style="margin-top: -1rem">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">22. Family name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_familyname" value="{{ $off->offender_family_name }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_firstname"value="{{ $off->offender_firstname }}" readonly>
                                        </div> 
                                    </div> 
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Middle name:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_middlename"value="{{ $off->offender_middlename }}" readonly>
                                        </div> 
                                    </div>
                                </div>

                                <div class="row" >
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Aliases:</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases"value="{{ $off->offender_aliases }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-3" >
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">23. Sex: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases"value="{{ $off->offender_sex }}" readonly> 
                                        </div> 
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">24. Date of birth:</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth"value="{{ $off->offender_date_of_birth }}" readonly>
                                        </div> 
                                    </div> 
                                </div>  
                            </div> 
                        </div> 
                        
                        <div class="row">
                            <div class="col-4" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">25. Civil Status: </label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth"value="{{ $off->offender_civil_status }}" readonly>
                                </div> 
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">26. Highest Educational Attainment: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth"value="{{ $off->offender_highest_educ_attainment }}" readonly> 
                                    <div id="div2" style="margin-top: 1rem"></div>
                                </div> 
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">27. Nationality: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_nationality"value="{{ $off->offender_nationality }}" readonly>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    28. Previous Criminal Record:
                                </label>
                                
                                <div style="display: flex">
                                    <div class="form-check" style="margin-right: 2rem; margin-left: 2rem">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                        No
                                        </label>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pls. specify:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="crim_rec_specify"value="{{ $off->offender_prev_criminal_rec }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">29. Employment Information - Occupation:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_occupation"value="{{ $off->offender_employment_info_occupation }}" readonly>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">30. Last Known Address:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_last_addr"value="{{ $off->offender_last_known_addr }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">31. Relationship to Victim:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim"value="{{ $off->offender_relationship_victim }}" readonly>
                                </div>
                            </div>  
                        </div>
                    </div>
                @endforeach 


                    <div class="col-12 form-navigation">
                        <a class="link-buttons" href=" " style="float: left;">Cancel <i class="fa-solid fa-xmark icons"></i> </a> 
                        {{-- <a class="link-buttons" href=" " style="float: right;">Next</a>  --}} 
                        {{-- <button type="submit" class="form-buttons" style="float: right;">Submit <i class="fa-solid fa-check icons"></i></button>  --}}
                    </div>
                </div> 
                </form>
            </div> 
        </div> 
    </div>

    <script>  
        
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
    </script>
    
    
</body>
</html>
