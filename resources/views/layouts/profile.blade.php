<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU OJT PROFILE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Poppins, sans-serif;
            margin-top: 80%;
            padding-top: 800px;
            background: #180835;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        .card {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            border-radius: 30px;
            padding: 10px;
            width: 90%;
            height: 500px;
            background: #0a0e25;
            background: -webkit-linear-gradient(to right, #0a0e25, #061539, #08236f);
            background: linear-gradient(to right, #0a0e25, #061539, #08236f);
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            animation: glowEffect 2s infinite alternate ease-in-out;
        }

   @keyframes glowEffect {
    0% {
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }
    100% {
        box-shadow: 0px 0px 20px rgba(0, 0, 255, 0.8), 0px 0px 40px rgba(0, 0, 255, 0.6), 0px 0px 60px rgba(0, 0, 0, 0.4);
    }
}

        .left-container {
            background: #000000;
            background: -webkit-linear-gradient(to right, #434343, #000000);
            background: linear-gradient(to right, #434343, #000000);
            flex: 1;
            max-width: 30%;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 430px;
            padding: 10px;
            margin: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            animation: bounceEffect 1s ease-out;
        }

        .right-container {
            background: #000000;
            background: -webkit-linear-gradient(to left, #434343, #000000);
            background: linear-gradient(to left, #434343, #000000);
            flex: 1;
            max-width: 70%;
            height: 430px;
            padding: 10px;
            margin: 20px;
            border-radius: 30px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            animation: bounceEffect 1s ease-out;
        }

        @keyframes bounceEffect {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        img {
            width: 200px;
            height: 200px;
            max-width: 200px;
            border-radius: 50%;
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        h2 {
            font-size: 25px;
            margin-bottom: 5px;
            color: white;
        }

        h3 {
            text-align: center;
            font-size: 25px;
            margin-bottom: 5px;
            color: white;
        }

        .gradienttext {
            background-image: linear-gradient(to right, #ee00ff 0%, #fbff00 100%);
            color: transparent;
            -webkit-background-clip: text;
        }

        p {
            font-size: 15px;
            margin-bottom: 20px;
            color: aliceblue;
            text-align: center;
        }

        table {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 250px;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            border: none;
            border-radius: 20px;
            color: white;
        }

        td:first-child {
            font-weight: bold;
        }

        .credit a {
            text-decoration: none;
            color: #fff;
            font-weight: 800;
        }

        .credit {
            color: #fff;
            text-align: center;
            margin-top: 10px;
            font-family: Poppins, sans-serif;
            font-size: 17px;
        }

        .icon {
            margin-right: 10px;
        }


        .card:hover {
            background: #112446;
        }

        .card:hover .gradienttext {
            background-image: linear-gradient(to right, #6363F7, #0BB5B5, #B6EDF1);
        }


    </style>
</head>
<body>


<div class="card" style="margin-top:50%">
    <div class="left-container">
        <img src="{{ asset('images/angeles.jpg') }}" alt="Angeles Image"><br>
        <h2 class="gradienttext">Cybelle Mae V. Angeles</h2><br>
        <p>On The Job Trainee <br> Batch 2024<br>Contact us for any inquiries or system issues.</p>
    </div>
    <div class="right-container" id="profile-details">
        <h3 class="gradienttext">Profile Details</h3><br><br>

        <table>
            <tr>
                <td><i class="fas fa-user icon"></i>Name:</td>
                <td>Cybelle Mae V. Angeles</td>
            </tr>
            <tr>
                <td><i class="fas fa-school icon"></i><span style="vertical-align: middle;"> School:</span></td>
                <td>Pangasinan State University-Urdaneta City Campus</td>
            </tr>
            <tr>
                <td><i class="fas fa-book-open icon"></i><span style="vertical-align: middle;"> Course:</span></td>
                <td>Bachelor Of Science In Information Technology-Major In Web And Mobile Technologies</td>
            </tr>
            <tr>
                <td><i class="fas fa-phone-alt icon"></i>Mobile:</td>
                <td>09394623248</td>
            </tr>
            <tr>
                <td><i class="fas fa-envelope icon"></i>Email:</td>
                <td><a href="mailto:angelescybelle140806@gmail.com" target="_blank" style="color:white"
                       title="Click To Message">angelescybelle140806@gmail.com</a></td>
            </tr>
            <tr>
                <td><i class="fab fa-facebook-f icon"></i>FB:</td>
                <td><a href="https://www.facebook.com/CYBELLE.Angeles8814" target="_blank" style="color:white"
                       title="Click To Message">Cybelle Mae Angeles</a></td>
            </tr>
        </table>
    </div>
</div>
<br><br><br>






<div class="card">
    <div class="left-container">
        <img src="{{ asset('images/balbin.png') }}" alt="Angeles Image"><br>
        <h2 class="gradienttext">Christine M. Balbin</h2><br>
        <p>On The Job Trainee <br> Batch 2024<br>Contact us for any inquiries or system issues.</p>
    </div>
    <div class="right-container" id="profile-details">
        <h3 class="gradienttext">Profile Details</h3><br><br>

        <table>
            <tr>
                <td><i class="fas fa-user icon"></i>Name:</td>
                <td>Christine M. Balbin</td></td>
            </tr>
            <tr>
                <td><i class="fas fa-school icon"></i><span style="vertical-align: middle;"> School:</span></td>
                <td>Pangasinan State University-Urdaneta City Campus</td>
            </tr>
            <tr>
                <td><i class="fas fa-book-open icon"></i><span style="vertical-align: middle;"> Course:</span></td>
                <td>Bachelor Of Science In Information Technology-Major In Web And Mobile Technologies</td>
            </tr>
            <tr>
                <td><i class="fas fa-phone-alt icon"></i>Mobile:</td>
                <td>09956537143</td>
            </tr>
            <tr>
                <td><i class="fas fa-envelope icon"></i>Email:</td>
                <td><a href="mailto:christinebalbin28@gmail.com" target="_blank" style="color:white"
                       title="Click To Message">christinebalbin28@gmail.com</a></td>
            </tr>
            <tr>
                <td><i class="fab fa-facebook-f icon"></i>FB:</td>
                <td><a href="https://www.facebook.com/christinembalbin?mibextid=ZbWKwL" target="_blank" style="color:white"
                       title="Click To Message">Christine Balbin</a></td>
            </tr>
        </table>
    </div>
</div>
<br><br><br>





<div class="card">
    <div class="left-container">
        <img src="{{ asset('images/basa.jpg') }}" alt="Angeles Image"><br>
        <h2 class="gradienttext">Beatriz S. Basa</h2><br>
        <p>On The Job Trainee <br> Batch 2024<br>Contact us for any inquiries or system issues.</p>
    </div>
    <div class="right-container" id="profile-details">
        <h3 class="gradienttext">Profile Details</h3><br><br>

        <table>
            <tr>
                <td><i class="fas fa-user icon"></i>Name:</td>
                <td>Beatriz S. Basa</td>
            </tr>
            <tr>
                <td><i class="fas fa-school icon"></i><span style="vertical-align: middle;"> School:</span></td>
                <td>Pangasinan State University-Urdaneta City Campus</td>
            </tr>
            <tr>
                <td><i class="fas fa-book-open icon"></i><span style="vertical-align: middle;"> Course:</span></td>
                <td>Bachelor Of Science In Information Technology-Major In Web And Mobile Technologies</td>
            </tr>
            <tr>
                <td><i class="fas fa-phone-alt icon"></i>Mobile:</td>
                <td>09395503418</td>
            </tr>
            <tr>
                <td><i class="fas fa-envelope icon"></i>Email:</td>
                <td><a href="mailto:beatrizbasa918gmail.com" target="_blank" style="color:white"
                       title="Click To Message">beatrizbasa918gmail.com</a></td>
            </tr>
            <tr>
                <td><i class="fab fa-facebook-f icon"></i>FB</td>
                <td><a href="https://www.facebook.com/beaaaa.18" target="_blank" style="color:white"
                       title="Click To Message">Beatriz Basa</a></td>
            </tr>
        </table>
    </div>
</div>
<br><br><br>





<div class="card">
    <div class="left-container">
        <img src="{{ asset('images/gavina.jpg') }}" alt="Angeles Image"><br>
        <h2 class="gradienttext">Vince Kaizer C. Gavina</h2><br>
        <p>On The Job Trainee <br> Batch 2024<br>Contact us for any inquiries or system issues.</p>
    </div>
    <div class="right-container" id="profile-details">
        <h3 class="gradienttext">Profile Details</h3><br><br>

        <table>
            <tr>
                <td><i class="fas fa-user icon"></i>Name:</td>
                <td>Vince Kaizer C. Gavina</td>
            </tr>
            <tr>
                <td><i class="fas fa-school icon"></i><span style="vertical-align: middle;"> School:</span></td>
                <td>Pangasinan State University-Urdaneta City Campus</td>
            </tr>
            <tr>
                <td><i class="fas fa-book-open icon"></i><span style="vertical-align: middle;"> Course:</span></td>
                <td>Bachelor Of Science In Information Technology-Major In Web And Mobile Technologies</td>
            </tr>
            <tr>
                <td><i class="fas fa-phone-alt icon"></i>Mobile:</td>
                <td>09451255397</td>
            </tr>
            <tr>
                <td><i class="fas fa-envelope icon"></i>Email:</td>
                <td><a href="mailto:vincekaizer13@gmail.com" target="_blank" style="color:white"
                       title="Click To Message">vincekaizer13@gmail.com</a></td>
            </tr>
            <tr>
                <td><i class="fab fa-facebook-f icon"></i>FB:</td>
                <td><a href="https://www.facebook.com/SIRBEANS.13?mibextid=ZbWKwL" target="_blank" style="color:white"
                       title="Click To Message">Vince Kaizer Gavina</a></td>
            </tr>
        </table>
    </div>
</div>
<br><br><br>







<div class="card">
    <div class="left-container">
        <img src="{{ asset('images/juan.jpg') }}" alt="Angeles Image"><br>
        <h2 class="gradienttext">Aaron Justin Juan</h2><br>
        <p>On The Job Trainee <br> Batch 2024<br>Contact us for any inquiries or system issues.</p>
    </div>
    <div class="right-container" id="profile-details">
        <h3 class="gradienttext">Profile Details</h3><br><br>

        <table>
            <tr>
                <td><i class="fas fa-user icon"></i>Name:</td>
                <td>Aaron Justin Juan</td>
            </tr>
            <tr>
                <td><i class="fas fa-school icon"></i><span style="vertical-align: middle;"> School:</span></td>
                <td>Pangasinan State University-Urdaneta City Campus</td>
            </tr>
            <tr>
                <td><i class="fas fa-book-open icon"></i><span style="vertical-align: middle;"> Course:</span></td>
                <td>Bachelor Of Science In Information Technology-Major In Web And Mobile Technologies</td>
            </tr>
            <tr>
                <td><i class="fas fa-phone-alt icon"></i>Mobile:</td>
                <td>09398578725</td>
            </tr>
            <tr>
                <td><i class="fas fa-envelope icon"></i>Email:</td>
                <td><a href="mailto:aaronjustinjuan@gmail.com " target="_blank" style="color:white"
                       title="Click To Message">aaronjustinjuan@gmail.com </a></td>
            </tr>
            <tr>
                <td><i class="fab fa-facebook-f icon"></i>FB</td>
                <td><a href="https://www.facebook.com/aaronjustinjuan1810?mibextid=ZbWKwL" target="_blank" style="color:white"
                       title="Click To Message">Aaron Justin Juan</a></td>
            </tr>
        </table>
    </div>
</div><br><br><br>




</body>
</html>
