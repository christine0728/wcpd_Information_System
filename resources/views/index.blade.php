<!DOCTYPE html>
<html>
<head>
<title>WCPD Welcome Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    *{
        font-family: 'Arial';
    }
    body,h1,h2,h3,h4,h5 {font-family: "Arial", sans-serif}

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
    height: 400px;
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
            <p style="font-size:17px; color: #F3E600">Republic of the Philippines<br>National Police Commision <br> Police Regional Office 1<br><hr>
            </p><h1 style="font-size:48px; color: #F3E600"><b>Woman And Child Protection Center <br></b></h1>
            <p style="font-size:33px; color: #F3E600">Philippine National Police Urdaneta City Pangasinan</p>
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
            Establishment: The WCPC traces its origins back to 1993 when it was established as the first women's desk within the Directorate for Police Community Relations (DPCR) of the PNP. Over the years, it has evolved and undergone various transformations to adapt to changing needs and circumstances.
            <br><br>
            Mandate: The primary mandate of WCPC is to provide assistance and support to women and children who are victims of abuse, violence, exploitation, and other forms of gender-based crimes. It plays a crucial role in ensuring the protection of their rights and well-being.
            <br><br>
            Functions:
            Investigation: WCPC conducts investigations into cases involving violence against women and children, including domestic violence, sexual assault, human trafficking, and online exploitation.
            <br><br>
            Victim Support: The center provides support services to victims, including counseling, legal assistance, medical referrals, and shelter placement.
            <br><br>
            Prevention and Advocacy: WCPC is actively involved in advocacy and awareness-raising campaigns to prevent violence against women and children. It collaborates with government agencies, NGOs, and other stakeholders to promote gender equality and human rights.
            <br><br>
            Organizational Structure: WCPC operates under the supervision of the Directorate for Investigation and Detective Management (DIDM) of the PNP. It is staffed by specially trained police officers and personnel with expertise in handling cases involving women and children.
            <br><br>
            Collaboration: WCPC works closely with various government agencies, non-governmental organizations (NGOs), civil society groups, and international organizations involved in promoting the rights and welfare of women and children. It also collaborates with local communities to address issues at the grassroots level.
            <br><br>
            Training and Capacity Building: WCPC conducts training programs and capacity-building initiatives for PNP personnel and other stakeholders involved in responding to cases of violence against women and children. These initiatives aim to enhance skills, knowledge, and sensitivity in handling such cases.
            <br><br>
            Community Outreach: WCPC engages in community outreach activities to raise awareness about gender-based violence, child protection, and related issues. It conducts seminars, workshops, and information campaigns to empower communities and encourage reporting of cases.
        </p>
        <br>
        </div>
        </div>
        <hr>
    <br>
    <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30683.624680511228!2d120.55108198063611!3d15.989912574944626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33913f5cb2e26b2d%3A0xdadccf9cdce8a355!2sUrdaneta%20City%20Police%20Station!5e0!3m2!1sen!2suk!4v1707358278286!5m2!1sen!2suk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <br>
    <div class="w3-card-4 w3-margin " style="background-color:#9947B6">
        <div class="w3-container">
    <center><img src="{{ asset('images/ucps_hm.jpg') }}" alt="PNP Human Trafficking" style="height:50%; width: 50%;"></center>
        <div class="w3-row">
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
    <div class="w3-card w3-margin">
        <div class="w3-container w3-padding">
        <h4 style="color: white">Clickable Links</h4>
        </div>
        <ul class="w3-ul w3-hoverable w3-white">
        <li class="w3-padding-16">
            <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fwcpdurdaneta.ereklamo%2Fvideos%2F171009934659071%2F&show_text=false&width=560&t=0" width="445" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </li>
        <li class="w3-padding-16">
            <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fwcpdurdaneta.ereklamo%2Fvideos%2F2893787514216277%2F&show_text=false&width=560&t=0" width="445" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </li>
        <li class="w3-padding-16">
            <iframe src="https://www.facebook.com/plugins/video.php?height=373&href=https%3A%2F%2Fwww.facebook.com%2Fwcpdurdaneta.ereklamo%2Fvideos%2F120090439751021%2F&show_text=false&width=560&t=0" width="445" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </li>
        <li class="w3-padding-16">
        <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fwcpdurdaneta.ereklamo%2Fvideos%2F306198654473531%2F&show_text=false&width=560&t=0" width="445" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </li>
        </ul>
    </div>
    <hr>
    <div class="w3-card w3-margin">
    </div>
        </div>
    </div><br>
</div>
    <footer class="w3-container w3-padding-32 w3-margin-top" style="background-color:white">
    <a href="/team/login" class="w3-button w3-black w3-padding-large w3-margin-bottom login-button" alt="Login" target=”_blank”>Login</a>

    <p>Copyright © 2024 WCPC Information Management System. All rights reserved. Developed by: PSU UC - IT OJT 2024</p>
    </footer>
</body>
</html>
