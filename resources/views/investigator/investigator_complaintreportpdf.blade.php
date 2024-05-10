<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ url('images/favicon.ico') }}"> 

    <title>Investigator | Complaint Report PDF</title>
    <style> 
        body {
            font-family: Arial, sans-serif;
        }
        
        * {
            box-sizing: border-box;
        }
        
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        
        [class*="col-"] {
            float: left;
            padding: 15px;
        }
 
        [class*="col-"] {
            width: 100%;
        }

        @media only screen and (min-width: 768px) {
            /* For desktop: */
            .col-1 {width: 8.33%;}
            .col-2 {width: 16.66%;}
            .col-3 {width: 25%;}
            .col-4 {width: 33.33%;}
            .col-5 {width: 41.66%;}
            .col-6 {width: 50%;}
            .col-7 {width: 58.33%;}
            .col-8 {width: 66.66%;}
            .col-9 {width: 75%;}
            .col-10 {width: 83.33%;}
            .col-11 {width: 91.66%;}
            .col-12 {width: 100%;}
        } 

        table, th, td {
            border: 1px solid;
        }

        @page {
            margin: 10mm; /* top right bottom left */
        }
    </style>
</head>
<body> 

    <div style="margin-bottom: 1rem">
        <b style="font-size: x-large; ">Complaint Standard Report Form</b>
    </div>

    <div style=""> 
        <table style="border-collapse: collapse;">  
            @foreach ($comps as $comp) 
            <tr>
                <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Person/Unit Reporting:
                    <br>{{ $comp->firstname }} {{ $comp->middlename }} {{ $comp->lastname }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Date Accomplished:
                    <br>{{ $comp->date_reported }}
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Referring Party and Contact Numbers:
                    <br>&nbsp;
                </td> 
            </tr>
            <tr>
                <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Investigation/Case No.:
                    <br>{{ $comp->inv_case_no }}
                </td>
                <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Name of Investigator:
                    <br>{{ $comp->firstname }} {{ $comp->middlename }} {{ $comp->lastname }}
                </td> 
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>A. OFFENSE DATA</b>
                </td>
            </tr> 
            <tr>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Time/Day/Month/Year of Commission
                    <br>{{ $comp->date_reported }}
                </td>
                <td colspan="3" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Place of Commission
                    <br>{{ $comp->place_of_commission }}
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Offense/s Committed:
                    <br>{{ $comp->offenses }}
                </td> 
            </tr>

            <tr>
                <td colspan="4" style="text-align: center">
                    <b>D. EVIDENCE DATA</b>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Motive/Cause:
                    <br>{{ $comp->evidence_motive_cause }}
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Suspect under the influence of:
                    <br>{{ $comp->evidence_influence_of }}
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="text-align: center; padding: 0rem 0.5rem 0rem 0.5rem">
                    <b>F. CASE DISPOSITION</b>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Disposition:
                    <br>{{ $comp->case_disposition }}
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Suspect:
                    <br>{{ $comp->suspect_disposition }}
                </td>  
            </tr> 
        @endforeach

            <tr>
                <td colspan="4" style="text-align: center">
                    <b>B. VICTIM'S DATA</b>
                </td>
            </tr>
            @foreach ($vics as $vic) 
                <tr>
                    <td rowspan="2" colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                        @if($vic->victim_image)
                            <img src="{{ asset('images/victims/' . $vic->victim_image) }}" alt="{{ $vic->victim_firstname }}" class="img-thumbnail" style="max-width: 70%; max-height: 70%;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                        Name: {{ $vic->victim_firstname }} {{ $vic->victim_middlename }} {{ $vic->victim_family_name }} 
                        <br>Aliases: {{ $vic->victim_aliases }} 
                    </td>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                        Gender/Sex:
                        <br>{{ $vic->victim_sex }} 
                    </td>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                        Age and Date of Birth:
                        <br>{{ $vic->victim_age }} y/o, {{ $vic->victim_date_of_birth }}  
                    </td> 
                </tr>  
                <tr>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                        Place of Birth:
                        <br>{{ $vic->victim_place_of_birth }} 
                    </td>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;">
                        Highest Educational Attainment:
                        <br>{{ $vic->victim_highest_educ_attainment }}  
                    </td> 
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;">
                        Civil Status:
                        <br>{{ $vic->victim_civil_status }}  
                    </td>
                </tr> 
                <tr>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top">
                        Nationality/Citizenship:
                        <br>{{ $vic->victim_nationality }}  
                    </td>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top">
                        Present Address:
                        <br>{{ $vic->victim_present_address }}   
                    </td> 
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                        Provincial Address:
                        <br>{{ $vic->victim_provincial_address }}   
                    </td>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                        Parents/Guardian Name:
                        <br>{{ $vic->victim_parents_guardian_name }} 
                    </td> 
                </tr>
                <tr>
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                        Employment Information - Occupation:
                        <br>{{ $vic->victim_employment_info_occupation }} 
                    </td> 
                    <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                        Identifying Documents Presented:
                        <br>{{ $vic->victim_docs_presented }}
                    </td>
                    <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                        Contact Person, Address, and Contact Number:
                        <br>{{ $vic->victim_contactperson_addr_con_num }}
                    </td> 
                </tr>  
            @endforeach  

            <tr>
                <td colspan="4" style="text-align: center">
                    <b>C. OFFENDER'S DATA</b>
                </td>
            </tr>
            @foreach ($offs as $off)  
            <tr>
                <td rowspan="2" colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                    @if($off->offender_image)
                    <img src="{{ asset('images/offenders/' . $off->offender_image) }}" alt="{{ $off->offender_firstname }}" class="img-thumbnail" style="max-width: 70%; max-height: 70%;">
                    @else
                    No Image
                    @endif
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Name: {{ $off->offender_firstname }} {{ $off->offender_middlename }} {{ $off->offender_family_name }} 
                    <br>Aliases: {{ $off->offender_aliases }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Gender/Sex:
                    <br> {{ $off->offender_sex}}
                </td>  
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Age and Date of Birth:
                    <br>{{ $off->offender_age }} y/o,  {{ $off->offender_date_of_birth }}
                </td>
            </tr>
            <tr> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Civil Status:
                    <br>{{ $off->offender_civil_status }}
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Highest Educational Attainment:
                    <br>{{ $off->offender_highest_educ_attainment }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Nationality:
                    <br>{{ $off->offender_nationality }} 
                </td> 
            </tr>
            <tr>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Previous Criminal Record
                    <br>Pls. specify: {{ $off->offender_prev_criminal_rec }}
                </td>  
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Employment Information
                    <br>Occupation: {{ $off->offender_employment_info_occupation }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Last Known Address:
                    <br>{{ $off->offender_last_known_addr }}
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Relationship to Victim:
                    <br>{{ $off->offender_relationship_victim }}
                </td>  
            </tr>
            @endforeach 
            <tr>
                <td colspan="4" style="text-align: center; padding: 0rem 0.5rem 0rem 0.5rem">
                    <b>E. ADDITIONAL INFORMATION RELATING TO TRAFFICKING IN PERSON'S CASES</b>
                </td>
            </tr>
            
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Signature of Investigator:
                    <br>
                    <br>
                </td>  
            </tr>
        </table> 
    </div> 
</body>
</html>
