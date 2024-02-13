<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WCPC | Admin Login</title>
  <link rel="icon" href="{{ url('asset/favicon.ico') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>

<body class=" d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #9947B6; font-family: arial">

  <div class="container">
    <!-- <div class="row" > -->
<center>
      <!-- Login Container with Image and Label -->
      <div class="col-md-6">
        <div class="card border-0 shadow" style="width: 400px; height: 500px;"> <!-- Set your preferred width and height -->
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <img src="{{ asset('images/wcpc_logo.jpg') }}" alt="Login Image" class="img-fluid mb-2" style="max-height: 80px;">
              <p>Woman And Child Protection Center</p></p>
            </div>
            <h2 class="text-center mb-4">Sign In</h2>
            <form action="{{ route('logging_in') }}" method="post">
              @csrf
              <div class="mb-3"  style="text-align:left">
                <label for="email" class="form-label" ><i class="fa fa-envelope"></i> Email</label>
                <input type="text" class="form-control" class="form-input" name="username"placeholder="Username" required>
                <div class="error-message">
                  @error('email')
                    {{ $message }}
                  @enderror
                </div>
              </div><br>
              <div class="mb-3"  style="text-align:left">
                <label for="password" class="form-label"><i class="fa fa-lock"></i> Password</label>
                <input type="password" class="form-control"  name="password" placeholder="Password" required>
                <div class="error-message">
                  @error('password')
                    {{ $message }}
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100" style="background-color:#9947B6"><i class="fa fa-arrow-right"></i> Login</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  <!-- </div> -->
  </center>

  <!-- Bootstrap JS and Popper.js (for Bootstrap modal, dropdown, etc.) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
