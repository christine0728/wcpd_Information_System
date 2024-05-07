<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WCPD | Inactive</title>
  <link rel="icon" href="{{ url('asset/favicon.ico') }}">
  <link rel="icon" href="{{ url('asset/favicon.ico') }}">
  <link rel="icon" href="images/favicon.png" sizes="32x32" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .login-container {
      display: flex;
      max-width:900px;
      width: 100%;
    }

    .login-form {
      flex: 1;
      padding: 40px;
      background-color: rgba(233, 217, 247, 0.8);
      border-radius: 0 8px 8px 0;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .alert {
      padding:6px;
    }

    .alert-warning {
      background-color:#D6143B;
      border-color: black;
      color: white;
      font-size: 14px;
      text-align:center;
    }

    .login-left {
      flex: 1;
      padding: 20px;
      background-color: white;
      border-radius: 8px 0 0 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 515px;
    }

    .login-left img {
      display: block;
      margin: 0 auto;
      max-height: 100px;
    }

    .login-left p {
      margin-bottom: 10px;
    }

    .login-form {
      flex: 1;
      padding: 40px;
      background-color: white;
      border-radius: 0 8px 8px 0;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); 
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-form .form-label {
      display: flex;
      align-items: center;
    }

    .login-form .form-label i {
      margin-right: 10px;
    }

    .btn-primary:hover {
      background-color: #C89AF7 !important;
      color:black;
    }

    img{
      border-radius: 50px;
    }

    p{
      color:white;
    }

    body {
      background-color: #192440;
      background-image: url(images/pnp.png);
      background-size: cover;
      background-position: center;
      font-family: 'Poppins', sans-serif;
      backdrop-filter: blur(7px);
      -webkit-backdrop-filter: blur(7px);
    }

    .btn-outline-secondary {
      background-color: white;  
    }

    .btn-outline-secondary:focus,
    .btn-outline-secondary:hover {
      background-color: #9947B6; 
    }

    .btn-outline-secondary i {
      border: none;  
    }

    .white-eye {
      color: white !important;  
    } 
  </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-left" style="background-color:#9947B6">
                <b><p style="font-size: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">Woman And Children Protection Desk</p></b>
                <b><p style="font-size: 30px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">WCPD Information Management System</p></b>
                <b><p style="margin-bottom: 0; font-size: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">Philippine National Police<br><b style="font-size:12px">Urdaneta City Police Station</b></p></b>
            </div>

            <div class="login-form" style="background-color:#E7D9F7">
                <center><img src="{{ asset('images/wcpd_logo.png') }}" alt="Login Image" height="100px" width="100px"></center><br>

                <div class="col-12" style="background-color: white; border-radius: 0.5rem; padding: 1.5rem; height: auto">
                    Your account's status is <b style="color:darkred; font-size: large">INACTIVE</b>.

                    <br><br><span>Click <a href="/login">HERE</a> to login again.</span>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
            window.location.href = data.redirect;
            } else {
            document.getElementById('flash-message').innerHTML = '<div class="alert alert-danger" role="alert">Incorrect username or password.</div>';
            document.getElementById('flash-message').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
        });
    </script>
    <script>$(document).ready(function() {
        $('#togglePassword').click(function() {
            $('#eyeIcon').toggleClass('white-eye'); // Toggle the class to change the color
        });
        });
    </script> 
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    });
</script>
