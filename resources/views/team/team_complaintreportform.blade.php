<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Team | Complaint Report Form</title>
    <style>
        body {
            background-color: #D9D9D9;
            font-family: Arial, sans-serif;
            color: black !important;
        }

        .container {
            max-width: 800px;
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
            margin-left: 1rem;
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
            background-color: purple;
            color: white;
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
            <label class="nav-link shadow-sm step0 border ml-2 active"><i style="font-size: medium;">Section A: <b style="font-size: medium;">Offense Data</b></i></label>
            <label class="nav-link shadow-sm step1 border ml-2 "><i style="font-size: medium;">Section B: <b style="font-size: medium;">Victim's Data</b></i></label>
            <label class="nav-link shadow-sm step2 border ml-2 "><i style="font-size: medium;">Section C: <b style="font-size: medium;">Offender's Data</b></i></label>
        </div>
    </div>

    {{-- <div class="container" style="margin-top: -1.5rem">
        <div class="header" style="background-color: white;">  
            <i style="font-size: medium; padding: 0.5rem">Section A: <b style="font-size: medium; padding: 0.5rem">Offense Data</b></i>
        </div> 
    </div>  --}}

    <div class="container" style="margin-top: -1rem">
        <div class="header" style="background-color: white;">  
            <div class="col-12">
                <form class="employee-form">
                    <div class="row">
                        <div class="form-section">
                            <div class="col-6" style="padding: 1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">6. Time/Day/Month/Year of Commission:</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                </div> 
                            </div>
                            <div class="col-6" style="padding: 1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">7. Place of Commission: </label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                </div> 
                            </div>
                            <div class="col-12" style="padding: 1rem; margin-top: -1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">8. Offenses Committed: </label>
                                    <select class="form-control" name="offenses">
                                        <option>Select offense</option>
                                        <option>Offense 1</option>
                                        <option>Offense 2</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="col-6" style="padding: 1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section B </label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                </div> 
                            </div>
                            <div class="col-6" style="padding: 1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">7. Place of Commission: </label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                </div> 
                            </div>
                            <div class="col-12" style="padding: 1rem; margin-top: -1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">8. Offenses Committed: </label>
                                    <select class="form-control" name="offenses">
                                        <option>Select offense</option>
                                        <option>Offense 1</option>
                                        <option>Offense 2</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="col-6" style="padding: 1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section C </label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                </div> 
                            </div>
                            <div class="col-6" style="padding: 1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">7. Place of Commission: </label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                </div> 
                            </div>
                            <div class="col-12" style="padding: 1rem; margin-top: -1rem">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">8. Offenses Committed: </label>
                                    <select class="form-control" name="offenses">
                                        <option>Select offense</option>
                                        <option>Offense 1</option>
                                        <option>Offense 2</option>
                                    </select>
                                </div> 
                            </div>
                        </div>

                        

                        {{-- <div class="form-section">
                            <label for="">Name:</label>
                            <input type="text" class="form-control mb-3" name="name" required>
                            <label for="">Last Name:</label>
                            <input type="text" class="form-control mb-3" name="last_name" required>
                        </div>
                        <div class="form-section">
                            <label for="">E-mail:</label>
                            <input type="email" class="form-control mb-3" name="email" required>
                            <label for="">Phone:</label>
                            <input type="tel" class="form-control mb-3" name="phone"  required>
                        </div>
                        <div class="form-section">
                            <label for="">Address:</label>
                            <textarea name="address" class="form-control mb-3" cols="30" rows="5" required></textarea>
                        </div> --}}
                        <div class="col-12 form-navigation">
                            <a class="link-buttons" href=" " style="float: left;">Cancel</a> 
                            {{-- <a class="link-buttons" href=" " style="float: right;">Next</a>  --}}

                           <button type="button" class="next form-buttons" style="float: right;">Next</button> 
                           <button type="submit" class="form-buttons" style="float: right;">Submit</button>
                           <button type="button" class="previous form-buttons" style="float: right; margin-right: 0.5rem">Back</button> 
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
                
                // Toggle active class on navigation links
                $navLinks.removeClass('active');
                $navLinks.eq(index).addClass('active');
                
                $('.form-navigation .previous').toggle(index > 0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [type=submit]').toggle(atTheEnd); 
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
    </script>
    
    
</body>
</html>
