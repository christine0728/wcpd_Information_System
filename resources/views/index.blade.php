<!DOCTYPE html>
<html>
<head>
<title>WCPD Welcome Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>

body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}

.w3-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.logo-container {
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-container img {
  width: 100px;
  height: 100px;
  margin-right: 10px;
  border-radius: 50%;
}

.map-container {
  width: 100%;
  height: 400px; /* Adjust the height as needed */
  margin-bottom: 20px;
}
.login-button {
  position: absolute;
  top: 10px;
  right: 10px;
}

</style>
</head>
<body style="background-color:#9947b6">
<div class="w3-content" style="max-width:1400px">
    <header class="w3-container w3-padding-32">
    <div class="header-background">
        <div class="login-logo-container">
        <div class="logo-container">
            <img src="{{ asset('images/pnp_logo.png') }}" alt="PNP Logo" >
            <img src="{{ asset('images/wcpc_logo.jpg') }}" alt="WCPC Logo">
            <img src="{{ asset('images/ucps_logo.jpg') }}" alt="UCPS Logo" >
        </div>
        </div>

        <center>
            <p style="font-size:20px; color: #F3E600">Republic of the Philippines<br><hr>
            </p><h1 style="font-size:48px; color: #F3E600"><b>Woman And Child Protection Center <br></b></h1>
            <p style="font-size:35px; color: #F3E600">Philippine National Police Urdaneta City Pangasinan</p>
        </center>
    </div>
    </header>
</div>


    <div class="w3-row">
    <div class="w3-col l8 s12">
    <div class="w3-card-4 w3-margin w3-white"><br>
   <center><img src="{{ asset('images/pnp_woman.jpg') }}" alt="PNP Woman" style="height:17%; width: 17%"></center>
        <div class="w3-container">
        <h3><b>WOMAN AND CHILD PROTECTION CENTER</b></h3>
        </div>

        <div class="w3-container">
        <p style=" text-align: justify">
The origins of the WCPC date back to 1993 when it was established as the first women’s desk within the DPCR division. Over its 23-year history, the WCPC has undergone significant evolution and transformation. Initially part of the DPCR, it later transitioned through various directorates, including the Health Service and the DIDM. However, it wasn't until December 2014, or early 2015, that the WCPC underwent a significant restructuring and enhancement through NAPOLCOM Resolution No. 2014-441. This resolution transformed the WCPC into a specialized and dedicated Anti-Trafficking Unit within the PNP, tasked with operating and investigating cases of Trafficking in Persons.</p><br>
        <!-- <div class="w3-row">
            <div class="w3-col m8 s12">
            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></p>
            </div>
            <div class="w3-col m4 w3-hide-small">
            <p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-tag">0</span></span></p>
            </div>
        </div> -->
        </div>
    </div>
    <hr>



<br>
    <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30683.624680511228!2d120.55108198063611!3d15.989912574944626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33913f5cb2e26b2d%3A0xdadccf9cdce8a355!2sUrdaneta%20City%20Police%20Station!5e0!3m2!1sen!2suk!4v1707358278286!5m2!1sen!2suk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
<br>


  <div class="w3-card-4 w3-margin w3-white">
  <img src="/w3images/bridge.jpg" alt="Norway" style="width:100%">
    <div class="w3-container">
      <h3><b>BLOG ENTRY</b></h3>
      <h5>Title description, <span class="w3-opacity">April 2, 2014</span></h5>
    </div>

    <div class="w3-container">
       <p style=" text-align: justify">WCPC stands for "Woman and Child Protection Center." It is a specialized unit within the Philippine National Police (PNP) that focuses on addressing issues related to the protection of women and children, particularly concerning cases of abuse, exploitation, trafficking, and other forms of violence. The WCPC works to investigate and prosecute offenders while providing support and assistance to victims of such crimes.</p>
      <div class="w3-row">
        <!-- <div class="w3-col m8 s12">
          <p><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-badge">2</span></span></p>
        </div> -->
      </div>
    </div>
  </div>
</div>


<div class="w3-col l4">
  <div class="w3-card w3-margin w3-margin-top"><br>
  <center>  <h2 style="color:white">Contact Us!</h2></center>
    <div class="w3-container " style="background-color: #2F8AFF">
    <center><img src="{{ asset('images/wcpc_contact.png') }}" alt="PNP Contact" style="height:100%; width: 100%"></center>
    </div>
  </div><hr>

  <!-- Posts -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-padding">
      <h4 style="color: white">Clickable Links</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">

    <li class="w3-padding-16">
    <a href="https://www.facebook.com/wcpdurdaneta.ereklamo" target="_blank">
      <i class="fab fa-facebook-square" style="font-size:50px; margin-left:10px;"></i>
    </a>
    <!-- <span class="w3-large">Facebook</span><br> -->

    <!-- Facebook logo linked to your Facebook page -->

</li>


      <li class="w3-padding-16">
      <a href="https://twitter.com/YourTwitterPage" target="_blank">
        <i class="fab fa-twitter" style="font-size: 50px; margin-left: 10px;"></i>
      </a>

      </li>


      <li class="w3-padding-16">
        <a href="mailto:youremail@example.com" target="_blank">
          <i class="fas fa-envelope" style="font-size: 50px; margin-left: 10px;"></i>
        </a>
   </li>

    </ul>
  </div>
  <hr>

  <!-- Labels / tags -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-padding">
      <h4>Tags</h4>
    </div>
    <div class="w3-container w3-white">
    <p><span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>
    </p>
    </div>
  </div>
</div>
</div><br>
</div>

<footer class="w3-container w3-padding-32 w3-margin-top" style="background-color:white">
<button class="w3-button w3-black w3-padding-large w3-margin-bottom login-button">Login</button>
  <p>Copyright © 2024 WCPC Information Management System. All rights reserved. Developed by: PSU UC - IT OJT 2024</p>
</footer>

</body>
</html>
