<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>WCPD Index Page</title>
    <link rel="icon" href="images/favicon.png" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="css/wcpdindex.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Mug+b8NKMIGj9PdQk+iOrNkDoz72NTb0ghlDh6e6vXuBj+qBfJgVgQ0LRjYXCBi7VqTiFzocXNQYOXM4wFwq8g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/aos.css">
    <style>
 @keyframes move {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(100px); /* Adjust the distance the letters move */
    }
}

@keyframes glow {
    0% {
        text-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
    }
    50% {
        text-shadow: 0 0 20px rgba(0, 0, 255, 0.5);
    }
    100% {
        text-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
    }
}

.letter {
    animation: move 2s linear infinite, glow 2s infinite alternate;
}



    </style>
</head>
<body style="background-color:#9947B6; font-family: 'Poppins', sans-serif;">
    <div class="jumbotron jumbotron-fluid" id="banner" style="background-image: url(images/pnp.png);">
        <div class="container text-center text-md-left">
            <header class="header-logos">
                <div class="row justify-content-start align-items-center">
                    <div class="col-auto">
                        <img src="{{ asset('images/pnp_logo.png') }}" alt="PNP Logo" style="width: 300px; height: auto; border-radius: 50%; margin-left: 15px;">
                    </div>
                    <div class="col-auto">
                        <img src="{{ asset('images/wcpd_logo.png') }}" alt="WCPD Logo" style="width: 300px; height: auto; border-radius: 50%;">
                    </div>
                    <div class="col-auto">
                        <img src="{{ asset('images/ucps_logo.png') }}" alt="UCPS Logo" style="width: 300px; height: auto; border-radius: 50%;">
                    </div>
                </div>
            </header>
            <h1 data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true" class="display-3 text-white font-weight-bold my-5 animated glow-effect" style="font-size: 85px; text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.5); letter-spacing: 2px; line-height: 1.2; position: relative;">
                <span class="letter" style="animation-delay: 0.2s;">W</span>
                <span class="letter" style="animation-delay: 0.4s;">I</span>
                <span class="letter" style="animation-delay: 0.6s;">I</span>
                <span class="letter" style="animation-delay: 0.8s;">M</span>
                <span class="letter" style="animation-delay: 0.10s;">S</span>
            </h1>



            <p data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true" class="lead text-white my-4 custom-paragraph" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                <span style="font-size: 35px; font-weight: bold;">WCPD & Investigation Information Management System </span><br>
                <span style="font-size: 20px; font-weight: bold;">Women and Children Protection Desk / General Investigation </span><br>
                <span style="font-size: 18px; font-weight: bold;">Philippine National Police</span><br>
                <span style="font-size: 16px; font-weight: bold;">Urdaneta City Police Station Urdaneta City</span>
            </p><br>
        <a href="/login"  class="btn my-4 font-weight-bold atlas-cta cta-purple" style="box-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Login</a>
    </div>
</div>
<div class="container my-5 py-2" style="color:white" >
<h2 class="text-center font-weight-bold my-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
    "Women and Children Protection Desk / General Investigation: Safeguarding Rights and Dignity"
</h2>
    <div class="row">
            <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
                <i class="fa fa-balance-scale fa-5x" aria-hidden="true"></i>
                <h4 style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><br>Legal Aid</h4>
                <p style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Providing legal assistance and representation for women and children in need.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
                <i class="fa fa-handshake-o fa-5x"></i>
                <h4 style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><br>Counseling</h4>
                <p style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Offering confidential counseling services to support individuals affected by abuse or trauma.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
                <i class="fa fa-medium fa-5x" aria-hidden="true"></i>
                <h4 style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><br>Emergency Assistance</h4>
                <p style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Providing immediate support and assistance to women and children facing emergencies or crises.</p>
            </div>
        </div>
        <br>
        <!-- Content for Investigation Unit in PNP -->
<div class="row">
    <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4 style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><br>Case Investigation</h4>
        <p style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Thoroughly investigating reported cases of crimes against women and children to ensure justice is served.</p>
    </div>
    <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
        <i class="fa fa-gavel fa-5x"></i>
        <h4 style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><br>Legal Proceedings</h4>
        <p style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Facilitating legal proceedings and offering support to victims and witnesses throughout the legal process.</p>
    </div>
    <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
        <i class="fa fa-shield fa-5x" aria-hidden="true"></i>
        <h4 style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><br>Victim Protection</h4>
        <p style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Ensuring the safety and protection of victims and their families during and after the investigation process.</p>
    </div>
</div>

    </div>



    <div class="jumbotron jumbotron-fluid text-center" id="copyright" style="display: flex; justify-content: center;">
    <div class="col-md-8 text-white  my-2" style="font-size: 17px;">
    <a href="{{ route('profile') }}" target="_blank" style="color:white; text-decoration:none">Copyright &copy; 2024 Women & Investigation Management System. All rights reserved.  Developed by PSU UC - IT OJT 2024.
 </a>
    </div>
</div>
<script src="js/aos.js"></script>
    <script>
      AOS.init({
      });
    </script>

    <script>
    //     window.onload = function() {
    //     if (window.history && window.history.pushState) {
    //         window.history.pushState('forward', null, './#');
    //         $(window).on('popstate', function() {
    //             if (window.location.hash === '#') {
    //                 window.history.pushState('forward', null, './#');
    //                 // Here you can redirect the user to the index page again if needed
    //                 window.location.replace("/");
    //             }
    //         });
    //     }
    // }

    history.replaceState(null, document.title, "/");
    </script>
</body>
</html>
