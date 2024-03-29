<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <script src="https://kit.fontawesome.com/7528702e77.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ url('images/favicon.ico') }}"> 

    <title>Team | Complaint Report PDF</title>
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


        /* For mobile phones: */
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

        @page { 
            margin: 0px; 
        }
        body { 
            margin: 0px; 
        }
 
        html {
            margin: 0px;
        }

        table, th, td {
            border: 1px solid;
        }
    </style>
</head>
<body> 

    <div style="margin-top: 2rem; margin-left: 2rem; margin-right: 2rem">
        <b style="font-size: x-large; ">Complaint Standard Report Form</b>
    </div>

    <div style="margin-top: 2rem; margin-left: 2rem; margin-right: 2rem; margin-bottom: 7rem"> 
        @foreach ($comps as $comp)
            
        
        <table style="border-collapse: collapse;">  
            <tr>
                <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    1. Person/Unit Reporting:
                    <br>{{ $comp->firstname }} {{ $comp->middlename }} {{ $comp->lastname }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    2. Date Accomplished:
                    <br>{{ $comp->date_reported }}
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    3. Referring Party and Contact Numbers:
                    <br>&nbsp;
                </td> 
            </tr>
            <tr>
                <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    4. Investigation/Case No.:
                    <br>&nbsp;
                </td>
                <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    5. Name of Investigator:
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
                    6. Time/Day/Month/Year of Commission
                    <br>{{ $comp->date_reported }}
                </td>
                <td colspan="3" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    7. Place of Commission
                    <br>{{ $comp->place_of_commission }}
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    8. Offense/s Committed:
                    <br>{{ $comp->offenses }}
                </td> 
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>B. VICTIM'S DATA</b>
                </td>
            </tr>
            <tr>
                <td rowspan="2":colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                    @if($comp->victim_image)
                    <img src="{{ asset('images/victims/' . $comp->victim_image) }}" alt="{{ $comp->victim_firstname }}" class="img-thumbnail" style="max-width: 180px; max-height: 180px;">
                    @else
                    No Image
                    @endif
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                    <strong>9. Name:</strong> {{ $comp->victim_firstname }} {{ $comp->victim_middlename }} {{ $comp->victim_family_name }} 
                    <br><strong>Aliases:</strong> {{ $comp->victim_aliases }} 
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                    <strong>10. Gender/Sex:</strong> 
                    <br>{{ $comp->victim_sex }} 
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                    <strong>11. Age and Date of Birth:</strong>
                    <br>{{ $comp->victim_age }} y/o, {{ $comp->victim_date_of_birth }}  
                </td> 
            </tr>  
            <tr>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                    <strong>12. Place of Birth:</strong> 
                    <br>{{ $comp->victim_place_of_birth }} 
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;">
                    <strong>13. Highest Educational Attainment:</strong>
                    <br>{{ $comp->victim_highest_educ_attainment }}  
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;">
                    <strong>14. Civil Status:</strong>
                    <br>{{ $comp->victim_civil_status }}  
                </td>
            </tr> 
            <tr>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top">
                    15. Nationality/Citizenship:
                    <br>{{ $comp->victim_nationality }}  
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top">
                    16. Present Address:
                    <br>{{ $comp->victim_present_address }}   
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    17. Provincial Address:
                    <br>{{ $comp->victim_provincial_address }}   
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    18. Parents/Guardian Name:
                    <br>{{ $comp->victim_parents_guardian_name }} 
                </td> 
            </tr>
            <tr>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    19. Employment Information - Occupation:
                    <br>{{ $comp->victim_employment_info_occupation }} 
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    20. Identifying Documents Presented:
                    <br>{{ $comp->victim_docs_presented }}
                </td>
                <td colspan="2" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    21. Contact Person, Address, and Contact Number:
                    <br>{{ $comp->victim_contactperson_addr_con_num }}
                </td> 
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>C. OFFENDER'S DATA</b>
                </td>
            </tr>
            <tr>
                <td rowspan="2":colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem; vertical-align: top;"> 
                    @if($comp->offender_image)
                    <img src="{{ asset('images/offenders/' . $comp->offender_image) }}" alt="{{ $comp->offender_firstname }}" class="img-thumbnail" style="max-width: 180px; max-height: 180px;">
                    @else
                    No Image
                    @endif
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    22. Name: {{ $comp->offender_firstname }} {{ $comp->offender_middlename }} {{ $comp->offender_family_name }} 
                    <br>Aliases: {{ $comp->offender_aliases }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    23. Gender/Sex:
                    <br> {{ $comp->offender_gender }}
                </td>  
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    24. Age and Date of Birth:
                    <br>{{ $comp->offender_age }} y/o,  {{ $comp->offender_date_of_birth }}
                </td>
            </tr>
            <tr> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    25. Civil Status:
                    <br>{{ $comp->offender_civil_status }}
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    26. Highest Educational Attainment:
                    <br>{{ $comp->offender_highest_educ_attainment }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    27. Nationality:
                    <br>{{ $comp->offender_nationality }} 
                </td> 
            </tr>
            <tr>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    28. Previous Criminal Record
                    <br>Pls. specify: {{ $comp->offender_prev_criminal_rec }}
                </td>  
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    29. Employment Information
                    <br>Occupation: {{ $comp->offender_employment_info_occupation }}
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    30. Last Known Address:
                    <br>{{ $comp->offender_last_known_addr }}
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    31. Relationship to Victim:
                    <br>{{ $comp->offender_relationship_victim }}
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    32. Identifying documents presented (company ID, Driver's license, etc.): 
                    <br>
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>D. EVIDENCE DATA</b>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    33. Weapons/Means Used:
                    <br>
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    34. Motive/Cause:
                    <br>{{ $comp->evidence_motive_cause }}
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    35. Suspect under the influence of:
                    <br>{{ $comp->evidence_influence_of }}
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    36. Medico Legal Examination:
                    <br>
                </td>  
            </tr> 

            <tr>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem"> 
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem"> 
                </td>
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem"> 
                </td> 
                <td colspan="1" style="padding: 0rem 0.5rem 0rem 0.5rem"> 
                </td>
            </tr> 
            <br><br>
            <tr>
                <td colspan="4" style="text-align: center; padding: 0rem 0.5rem 0rem 0.5rem">
                    <b>E. ADDITIONAL INFORMATION RELATING TO TRAFFICKING IN PERSON'S CASES</b>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center; padding: 0rem 0.5rem 0rem 0.5rem">
                    <b>F. CASE DISPOSITION</b>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    47. Disposition:
                    <br>{{ $comp->case_disposition }}
                </td>  
            </tr>
            <tr style="margin-top: 5rem">
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem;">
                    48. Victim in custody of:
                    <br>
                </td>  
            </tr>
            <tr>
                <td colspan="4" style="padding: 0rem 0.5rem 0rem 0.5rem">
                    49. Suspect:
                    <br>{{ $comp->suspect_disposition }}
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
        @endforeach
    </div>  
     

    {{-- <div style="padding-top: 2rem; margin-left: 2rem; "> 
        <table style="border-collapse: collapse;"> 
            <tr>
                <td style="text-align: center; padding: 0rem 0.5rem 0rem 0.5rem">
                    <b>E. ADDITIONAL INFORMATION RELATING TO TRAFFICKING IN PERSON'S CASES</b>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 0rem 0.5rem 0rem 0.5rem">
                    <b>F. CASE DISPOSITION</b>
                </td>
            </tr>
            <tr>
                <td style="padding: 0rem 0.5rem 0rem 0.5rem">
                    47. Disposition
                    <br>
                </td>  
            </tr>
            <tr style="margin-top: 5rem">
                <td style="padding: 0rem 0.5rem 0rem 0.5rem;">
                    48. Victim in custody of
                    <br>
                </td>  
            </tr>
            <tr>
                <td style="padding: 0rem 0.5rem 0rem 0.5rem">
                    49. Suspect
                    <br>
                </td>  
            </tr>
            <tr>
                <td style="padding: 0rem 0.5rem 0rem 0.5rem">
                    Signature of Investigator:
                    <br>
                </td>  
            </tr>
        </table>
    </div>   --}}
</body>
</html>
