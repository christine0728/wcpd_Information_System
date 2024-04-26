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

    <title>Superadmin | Edit Complaint Report</title>
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

        .parsley-errors-list{
            color:red;
        }

        /* Added style for active navigation link */
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
        </div> 
    </div> 

    <div class="container row" style="margin-top: -2rem">
        <div class="header" style="background-color: white;">  
            <div class="col-12">  
                @foreach ($comps as $comp) 

                <form action="{{ route('superadmin.update_form', [$comp->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-section">  
                        <div class="header" >  
                            <p style="font-size: large;"> <b style="font-size: large; color: black">OFFENSE DATA</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Time/Day/Month/Year of Commission:</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="datetime_commission" value="{{ $comp->date_reported }}" >
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Investigation/Case No.:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="inv_case_no" oninput="toUpper(this)" value="{{ $comp->inv_case_no }}">
                                    @if ($errors->has('inv_case_no')) 
                                        <span class="text-red text-sm" style="color:red; font-size: small; float: left">{{ $errors->first('inv_case_no') }}</span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Place of Commission: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="place_commission" value="{{ $comp->place_of_commission }}" >
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Offenses Committed: </label>
                                    <input type="hidden" name="offenses" value="max="{{ date('Y-m-d') }}>
                                    <select class="form-control" name="offenses[]" multiple>  
                                        <option value="{{ $comp->offenses }}" style="font-weight: bold">Selected: {{ $comp->offenses }}</option>
                                        @foreach ($offenses as $offense) 
                                            <option value="{{ $offense->offense_name }}">{{ $offense->offense_name }}</option>
                                        @endforeach 
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="form-section" style="margin-top: 3rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;"> <b style="font-size: large;">EVIDENCE DATA</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Motive/Cause: </label> 
                                    <select class="form-control" name="evi_motive">
                                        <option value="{{ $comp->evidence_motive_cause }}">Selected: {{ $comp->evidence_motive_cause }}</option>
                                        <option value="sex_lust">Sex/Lust</option>
                                        <option value="passion_jealousy">Passion/Jealousy</option>
                                        <option value="misunderstanding">Misunderstanding</option>
                                        <option value="revenge">Revenge</option>
                                        <option value="family_trouble">Family trouble</option>
                                        <option value="poverty">Poverty</option>
                                    </select>
                                </div> 
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Suspect under the influence of: </label> 
                                    <select class="form-control" name="influences" onchange="showfield(this.options[this.selectedIndex].value)">
                                        <option value="{{ $comp->evidence_influence_of }}">Selected: {{ $comp->evidence_influence_of }}</option>
                                        <option value="drugs">Drugs</option>
                                        <option value="alcohol">Alcohol</option>
                                        <option value="both">Both</option>
                                        <option value="none">None</option>
                                        <option value="Others3">Others </option>
                                    </select>
                                    <div id="div3" style="margin-top: 1rem"></div>
                                </div> 
                            </div>
                        </div>
                    </div>
                
                    {{-- CASE DISPOSITION --}}
                    <div class="form-section" style="margin-top: 2rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;"> <b style="font-size: large;">CASE DISPOSITION</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Disposition: </label> 

                                    <select class="form-control" name="disposition" onchange="showfield(this.options[this.selectedIndex].value)">
                                        <option value="{{ $comp->case_disposition }}">Select disposition of case</option>
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
                                    <label for="exampleInputEmail1">Suspect disposition: </label>
                                    {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim" value="{{ $comp->suspect_disposition }}" readonly>  --}}

                                    <select class="form-control" name="sus_disposition" onchange="showfield2(this.options[this.selectedIndex].value)">
                                        <option value="{{ $comp->suspect_disposition }}">Select disposition of case</option>
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
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="investigator" value="{{ $comp->investigator_on_case }}" readonly>
                                </div>
                            </div> 
                        </div>
                    </div>
                    @endforeach 
                    
                    <div class="form-section" style="margin-top: 3rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;"><b style="font-size: large;">LIST OF VICTIM'S DATA</b></p>
                        </div>
                        <hr style="margin-top: -1rem">
                    </div>

                    <div class="form-section" style="margin-top: 1rem">  
                        @foreach ($vics as $vic)   
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
                                                <label for="exampleInputEmail1">Sex: </label>
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
    
                            <div class="row" style="margin-bottom: 2rem">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Contact Person, Address, and Contact Number:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_contactperson" value="{{ $vic->victim_contactperson_addr_con_num }}" readonly>
                                    </div> 
                                </div> 
                            </div>  
                            <hr style="margin-top: -1rem">
                        @endforeach
                    </div>

                    <div class="form-section" style="margin-top: 3rem">
                        <hr style="margin-top: -1rem">
                        <div class="header">  
                            <p style="font-size: large;"><b style="font-size: large;">LIST OF OFFENDER'S DATA</b></p>
                        </div>
                        <hr style="margin-top: -1rem">
                    </div>

                    <div class="form-section" style="margin-top: 1rem"> 
                        @foreach ($offs as $off)  
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
                                                <label for="exampleInputEmail1">Family name:</label>
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
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Aliases:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases"value="{{ $off->offender_aliases }}" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-4" >
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Sex: </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases"value="{{ $off->offender_sex }}" readonly> 
                                            </div> 
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Date of birth:</label>
                                                <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth"value="{{ $off->offender_date_of_birth }}" readonly>
                                            </div> 
                                        </div> 
                                    </div>  
                                </div> 
                            </div> 
                            
                            <div class="row" style="margin-top: -1.5rem">
                                <div class="col-4" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Civil Status: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth"value="{{ $off->offender_civil_status }}" readonly>
                                    </div> 
                                </div> 
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Highest Educational Attainment: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth"value="{{ $off->offender_highest_educ_attainment }}" readonly> 
                                        <div id="div2" style="margin-top: 1rem"></div>
                                    </div> 
                                </div> 
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nationality: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_nationality"value="{{ $off->offender_nationality }}" readonly>
                                    </div> 
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-6"> 
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Previous Criminal Record:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="crim_rec_specify"value="{{ $off->offender_prev_criminal_rec }}" readonly>
                                    </div> 
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">29. Employment Information - Occupation:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_occupation"value="{{ $off->offender_employment_info_occupation }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">  
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">30. Last Known Address:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_last_addr"value="{{ $off->offender_last_known_addr }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-bottom: 2.1rem">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Place of birth:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_place_birth" value="{{ $off->offender_place_of_birth }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">31. Relationship to Victim:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim"value="{{ $off->offender_relationship_victim }}" readonly>
                                    </div>
                                </div>  
                            </div> 
                            <hr style="margin-top: -1rem">
                        @endforeach  
                    </div>
                    
                    <div class="col-12 form-navigation">
                        <a class="link-buttons" href="{{ route('superadmin.complaintreport') }}" style="float: left; background-color: #48145B">Cancel <i class="fa-solid fa-xmark icons"></i> </a> 
                        {{-- <a class="link-buttons" href=" " style="float: right;">Next</a>  --}} 

                        <button type="submit" class="form-buttons" style="float: right;">Submit Update <i class="fa-solid fa-check icons"></i></button> 

                        <a class="link-buttons" href="{{ route('superadmin.offender_form', [$comp->id]) }}" style="float: right; background-color: #48145B; margin-right: 0.5rem">Add an Offender&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></a>

                        <a class="link-buttons" href="{{ route('superadmin.victim_form', [$comp->id]) }}" style="float: right; background-color: #48145B; margin-right: 0.5rem">Add a Victim&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></a> 
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
    
    <script>
        function toUpper(input) { 
            let value = input.value; 
            value = value.toUpperCase(); 
            input.value = value;
        }
    </script>

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
</body>
</html>
