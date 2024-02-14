<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WCPC | Admin Login</title>
  <link rel="icon" href="{{ url('asset/favicon.ico') }}">
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
      max-width: 800px;
      width: 100%;
    }
    .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-warning {
    background-color: #fcf8e3;
    border-color: #faebcc;
    color: #8a6d3b;
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
      height: 510px;
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
  </style>
</head>
<body>
  <div class="container">
    <div class="login-container">
      <div class="login-left" style="background-color:#9947B6">
      <b> <p style="font-size: 20px">Woman And Children Protection Center</p></b>
      <b> <p style="font-size: 30px">WCPC Information Management System</p></b>
      <b><p style="margin-bottom: 0;font-size: 20px">Philippine National Police<br><b style="font-size:12px">Urdaneta City Police Station</b></p></b>

      </div>
      <div class="login-form" style="background-color:#E7D9F7">
        <center><img src="{{ asset('images/wcpc_logo.jpg') }}" alt="Login Image" height="100px" width="100px"></center><br>
        @if(session('error'))
              <div class="alert alert-warning">
              {{ session('error') }}
              </div>
        @endif

        <form action="{{ route('logging_in') }}" method="post">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label"><i class="fa fa-envelope"></i> Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
            <div class="error-message">
              @error('email')
                {{ $message }}
              @enderror
            </div>
          </div><br>
          <div class="mb-3">
            <label for="password" class="form-label"><i class="fa fa-lock"></i> Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
            <div class="error-message">
              @error('password')
                {{ $message }}
              @enderror
            </div>
          </div><br>
          <button type="submit" class="btn btn-primary w-100" style="background-color:#9947B6"><i class="fa fa-arrow-right"></i> Login</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
