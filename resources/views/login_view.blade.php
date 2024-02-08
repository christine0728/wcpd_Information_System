<!DOCTYPE html>
<html lang="en">
<head>
    <title>WCPD Login</title>
    <style>
     *{
         margin:0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Poppins', sans-serif;
      }
      html{
      	height: 100%;
      }
      body{
      	background: #fafafa;
	    font-family: 'Segoe UI', sans-serif;;
      	font-size: 1rem;
      	height: 100%;
      	line-height: 1.6;
          background: #9947B6;
      }
      .wrap {
      	width: 350px;
      	margin: 50px auto;
      	background: #fafafa;

     }

    .login-form{
        width: 350px;
        margin: 0 auto;
        border: 1px solid #ddd;
        padding: 2rem;
        background: #ffffff;
    }
    .form-input{
        background: #fafafa;
        border: 1px solid #eeeeee;
        padding: 12px;
        width: 100%;
    }

    .form-group{
        margin-bottom: 1rem;
    }
    .form-button {
    background: #9947B6;
    border: 1px solid #ddd;
    color: #ffffff;
    padding: 10px;
    width: 100%;
    text-transform: uppercase;
    transition: background 0.3s, color 0.3s, transform 0.3s; /* Added transform property */
    }

    .form-button:hover {
        background: #ffff;
        color: #9947B6;
        transform: translateY(-5px); /* Move the button upward by 5 pixels on hover */
    }

   .form-header{
     text-align: center;
     margin-bottom : 2rem;
   }
   .form-footer{
     text-align: center;
    }
   .flipcard{
     background-color: transparent;
     width : 350px;
     perspective: 1000px;
   }
  .flipcard-inner{
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
   }
  .flipcard-front, .flipcard-back{
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
   }
  .flipcard-front{
    color: black;
   }
  .flipcard-back{
    background-color: dodgerblue;
    transform: rotateY(180deg);
  }
  input[type="checkbox"]:checked + .flipcard .flipcard-inner{
    transform: rotateY(180deg);
  }
  .form-button-register{
     background: #2c91d8;
   }
   .form-button-register:hover{
     background: #2c91a8;
   }
.switch_form:before{
    content: " ";
    display: block;
    background:red;
}
.label-highlight {
    background: linear-gradient(90deg, #000000, #9947B6);
    -webkit-background-clip: text;
    color: transparent; /* Hide the text color */

    text-decoration: none; /* Remove underline by default */
    padding: 2px 0; /* Optional: Add padding to separate the text from the background */
}

.label-highlight:hover {
    color: linear-gradient(90deg, #9947B6, #000000);
    color: #ffffff; /* Change the text color on hover */
    font-weight: bold;
}

.box {
    box-shadow: 0 2px 1px rgba(0,0,0,0.09), 0 4px 2px rgba(0,0,0,0.09), 0 8px 4px rgba(0,0,0,0.09), 0 16px 8px rgba(0,0,0,0.09), 0 32px 16px rgba(0,0,0,0.09);
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            background-color:white;
}
</style>
</head>
<body>

    <div class="wrap">
        <input type="checkbox" id="form_switch" style="display: none;">
	<div class="flipcard">
	    <div class="flipcard-inner">
		<div class="flipcard-front">


                <div class="box">
                <div class="form-header">
                	    <h3>Login Form</h3>
                	    <p>Login to access your dashboard</p>
            		</div>
                <form action="{{ route('logging_in') }}" method="post">
                     @csrf
                    <div class="form-group">
		            <input type="text" class="form-input" name="username" placeholder="Username">
            		</div>
            		<div class="form-group">
                	    <input type="password" class="form-input" name="password" placeholder="Password">
            		</div>
            		<div class="form-group">
                	  <button class="form-button" type="submit">Login</button>
            		</div>
            		<div class="form-footer">
            		 Add team account? <label class="label-highlight" for="form_switch"> Register </label>
            		</div>
        	</form>
            </div>
	</div>
	<div class="flipcard-back">


		    <div class="form-group">
            <div class="box">

            	<div class="form-header">
             	    <h3>Team Account</h3>
                    <p>Add team account</p>
            	</div>
                <form action="{{ route('superadmin.add_teamaccount') }}" method="post">
                    @csrf
                    <div class="form-group">
                    <input type="text" class="form-input" name="username"placeholder="Username"  >
                    </div>
                    <div class="form-group">
                    <input type="password" class="form-input" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                    <input type="submit" class="form-button" name="add" value="Add">
                    </div>
                </form>
                <div class="form-footer">
                        Already have an account? <label class="label-highlight" for="form_switch">Login</label>
                    </div>
                </div>

            </div>
    </div>
</div>
</div>


</body>
</html>
