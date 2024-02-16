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

    <title>Team | View Complaint Report</title>
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
            <label class="nav-link shadow-sm step0 border ml-2 active">Section A</label>
            <label class="nav-link shadow-sm step1 border ml-2 ">Section B</label>
            <label class="nav-link shadow-sm step2 border ml-2 ">Section C</label>
            <label class="nav-link shadow-sm step3 border ml-2 ">Section D</label>
            <label class="nav-link shadow-sm step4 border ml-2 ">Section F</label>
        </div>
    </div> 

    <div class="container row" style="margin-top: -1rem">
        <div class="header" style="background-color: white;">  
            <div class="col-12"> 
                <form>
                @foreach ($comps as $comp) 
                <div class="row">
                    <div class="form-section">  
                        <div class="header" >  
                            <p style="font-size: medium;">Section A: <b style="font-size: medium; color: black">Offense Data</b></p>
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
                                    <select class="form-control" name="offenses" multiple value="{{ $comp->offenses }}" readonly>
                                        <option>Select offense</option>
                                        <option>Offense 1</option>
                                        <option>Offense 2</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="header">  
                            <p style="font-size: medium;">Section B: <b style="font-size: medium;">Victim's Data</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">9. Family name:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_familyname" value="{{ $comp->victim_family_name }}" readonly>
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First name:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_firstname" value="{{ $comp->victim_firstname }}" readonly>
                                </div> 
                            </div> 
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Middle name:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_middlename" value="{{ $comp->victim_middlename }}" readonly>
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Aliases: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_aliases" value="{{ $comp->victim_aliases }}" readonly>
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-2" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">10. Sex: </label>
                                    <select class="form-control" name="vic_gender">
                                        <option>Select sex</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                    </select>
                                </div> 
                            </div> 
                            <div class="col-2" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">11. Date of birth: </label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_date_birth">
                                </div> 
                            </div> 
                            <div class="col-8" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">12. Place of birth: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_place_birth">
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">13. Highest Educational Attainment: </label>
                                    <select class="form-control" name="vic_educ_attainment" onchange="showfield(this.options[this.selectedIndex].value)">
                                        <option>Select highest educational attainment</option>
                                        <option value="elementary">Elementary</option>
                                        <option value="hsgrad">HS Graduate</option>
                                        <option value="collegegrad">College Graduate</option>
                                        <option value="postgrad">Post Graduate</option>
                                        <option value="Others">Others  </option> 
                                    </select>
                                    <div id="div1" style="margin-top: 1rem"></div>
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">14. Civil Status: </label>
                                    <select class="form-control" name="vic_civil_stat">
                                        <option>Select civil status</option>
                                        <option value="single">Single</option>
                                        <option value="live-in">Live-in</option>
                                        <option value="married">Married</option>
                                        <option value="widow/er">Widow/er</option>
                                        <option value="separated">Separated</option>
                                    </select>
                                </div> 
                            </div> 
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">15. Citizenship: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_citizenship">
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">16. Present Address: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_present_addr">
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">17. Provincial Address: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_prov_addr">
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">18. Parents/Guardian Name: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_parentsname">
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">19. Employment Information - Occupation: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_occupation">
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">20. Identifying Documents Presented: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="docs_presented">
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">21.Contact Person, Address, and Contact Number:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="vic_contactperson">
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="header">  
                            <p style="font-size: medium;">Section C: <b style="font-size: medium;">Offender's Data</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">22. Family name:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_familyname">
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First name:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_firstname">
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Middle name:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_middlename">
                                </div> 
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Aliases:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_aliases">
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">23. Sex: </label>
                                    <select class="form-control" name="off_gender">
                                        <option>Select sex</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">24. Date of birth:</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_date_birth">
                                </div> 
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">25. Civil Status: </label>
                                    <select class="form-control" name="off_civil_stat">
                                        <option>Select civil status</option>
                                        <option value="single">Single</option>
                                        <option value="live-in">Live-in</option>
                                        <option value="married">Married</option>
                                        <option value="widow/er">Widow/er</option>
                                        <option value="separated">Separated</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">26. Highest Educational Attainment: </label>
                                    <select class="form-control" name="off_educ_attainment" onchange="showfield(this.options[this.selectedIndex].value)">
                                        <option>Select highest educational attainment</option>
                                        <option value="elementary">Elementary</option>
                                        <option value="hsgrad">HS Graduate</option>
                                        <option value="collegegrad">College Graduate</option>
                                        <option value="postgrad">Post Graduate</option>
                                        <option value="Others2">Others  </option> 
                                    </select>
                                    <div id="div2" style="margin-top: 1rem"></div>
                                </div> 
                            </div> 
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">27. Nationality: </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_nationality">
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
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="crim_rec_specify">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">29. Employment Information - Occupation:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_occupation">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">30. Last Known Address:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="off_last_addr">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">31. Relationship to Victim:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="rel_to_victim">
                                </div>
                            </div> 
                        </div>
                    </div>

                    {{-- EVIDENCE DATA --}}
                    <div class="form-section">
                        <div class="header">  
                            <p style="font-size: medium;">Section D: <b style="font-size: medium;">Evidence Data</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">34. Motive/Cause: </label>
                                    <select class="form-control" name="evi_motive">
                                        <option>Select motive/cause</option>
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
                                    <label for="exampleInputEmail1">35. Suspect under the influence of: </label>
                                    <select class="form-control" name="influences" onchange="showfield(this.options[this.selectedIndex].value)">
                                        <option>Select influence</option>
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
                    <div class="form-section">
                        <div class="f">  
                            <p style="font-size: medium;">Section F: <b style="font-size: medium;">Case Disposition</b></p>
                        </div> 
                        <hr style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">47. Disposition: </label>
                                    <select class="form-control" name="disposition" onchange="showfield(this.options[this.selectedIndex].value)">
                                        <option>Select disposition of case</option>
                                        <option value="settled_at_barangay">Settled at barangay</option>
                                        <option value="settled_by_parties">Settled by parties</option>
                                        <option value="under_police_investigation">Under police investigation</option>
                                        <option value="before_prosecution_office">Before Prosecution Office</option>
                                        <option value="filed_in_court">Filed in court</option>
                                        <option value="dismissed">Dismissed</option>
                                        <option value="referred_to_other_gov_agencies">Referred to other government agencies</option>
                                        <option value="Others4">Others </option>
                                    </select>
                                    <div id="div4" style="margin-top: 1rem"></div>
                                </div> 
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">48. Suspect disposition: </label>
                                    <select class="form-control" name="sus_disposition" onchange="showfield2(this.options[this.selectedIndex].value)">
                                        <option>Select disposition of case</option>
                                        <option value="arrested">Arrested</option>
                                        <option value="at_large">At large</option>
                                        <option value="detained">Detained</option> 
                                        <option value="Others5">Others </option>
                                    </select>
                                    <div id="div5" style="margin-top: 1rem"></div>
                                </div> 
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Investigator on case:</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="investigator">
                                </div>
                            </div> 
                        </div>
                    </div> 


                    <div class="col-12 form-navigation">
                        <a class="link-buttons" href=" " style="float: left;">Cancel <i class="fa-solid fa-xmark icons"></i> </a> 
                        {{-- <a class="link-buttons" href=" " style="float: right;">Next</a>  --}}

                        <button type="button" class="next form-buttons" style="float: right; width: 5rem">Next <i class="fa-solid fa-arrow-right icons"></i></button> 
                        <button type="submit" class="form-buttons" style="float: right;">Submit <i class="fa-solid fa-check icons"></i></button>
                        <button type="button" class="previous form-buttons" style="float: right; margin-right: 0.5rem; width: 5rem"><i class="fa-solid fa-arrow-left icons"></i> Back</button> 
                    </div>
                </div>
                @endforeach 
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
    </script>
    
    
</body>
</html>
