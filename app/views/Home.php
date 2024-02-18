<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo APPROOT.'\public\css\styles.css';?>">
    hi
</head>
<body onload="service()">
    <div class="container">
        <nav>
            <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="" class="logo">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#aboutUs">About Us</a></li>
                <li><a href="#contact-section">Contact Us</a></li>
                <li><a href="<?php echo URLROOT?>user/login" class="signin-button button">Sign In</a></li>
            </ul>
        </nav>
        <div class="hero">
            <div>
                <h1>Welcome to <span class="SAHANYA Labs">SAHANYA Labs</span></h1>
                <h4>Setting the Standard in Healthcare Excellence</h4>
                <p>Welcome to SAHANYA Labs, your trusted partner in precision medical testing and healthcare excellence. With a legacy of accuracy and a commitment to your well-being, we provide reliable results. Explore advanced diagnostics and personalized care for your health.</p><br>
                <a href="<?php echo URLROOT?>user/register" class="signup-button button">Get Started</a>
            </div>
            <div>
            <img src="<?php echo APPROOT.'/public/';?>img/DNA.png" alt="" class="logo">
            </div>
            
        </div>
    </div>
    <div class="services" id="services">
        <div class="service-title">
            <div>
                <img src="<?php echo APPROOT.'/public/';?>img/Services.png" alt="" class="logo">
            </div>
            <div class="title-text">
                <h3>Advanced Medical Testing Tailored to Your Needs</h3>
                <h1>Our Comprehensive Services</h1>
                <p>At SAHANYA Labs, we offer a wide range of medical tests and diagnostics to cater to your healthcare needs. Our dedicated team of professionals ensures accurate and timely results. Below are some of the key tests we provide, along with important pre-preparation information.</p>
            </div>
        </div>
        <div class="test-type">
            <div class="test-search">
                <input id="search1" type="search" placeholder="Search here" data-search>
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="test-list">
                    <ul id="service-list">
                    </ul>
                </div>
                <div>
                    <img src="<?php echo APPROOT.'/public/';?>img/Science.png" alt="" class="logo">
                </div>
            </div>
            <div class="test-description">
                <h4><i class="fa-solid fa-file-prescription"></i></i> Description</h4>
                <p id="dis" class="dis"></p>
                <h4><i class="fa-solid fa-user-doctor"></i> Preparation</h4>
                <p id="pre" class="pre"></p>
            </div>
        </div>
    </div>
    <div class="aboutus" id="aboutUs">
        <div class="aboutus-title"><br>
            <h1>About <span>SAHANYA Labs</span></h1>
        </div>
        <div class="description">
            <h2>
            Sahanya Labs is a leading medical laboratory committed to providing precise diagnostics through advanced technology and expertise. Our focus on quality and innovation empowers healthcare providers and patients.
            </h2>
        </div>
        <div class="short-description">
            <p>SAHANYA Labs holds a prominent position within the medical SAHANYA Labstory landscape, earning recognition for its unwavering dedication to the utmost precision, unparalleled reliability, and a relentless pursuit of excellence in diagnostics. With a history dating back to our establishment in 2010, we have remained steadfast in our mission to consistently establish and maintain the highest standards in quality healthcare services. Over the years, our commitment to excellence has evolved into a legacy, setting a benchmark that inspires trust among our patients and partners in the healthcare community</p>
        </div>
        <div class="imgs">
            <img src="<?php echo APPROOT.'/public/img/award1.png';?>" alt="image not found">
            <img src="<?php echo APPROOT.'/public/img/award2.png';?>" alt="image not found">
            <img src="<?php echo APPROOT.'/public/img/award3.png';?>" alt="image not found">
        </div>
        <div class="award">
            <div class="award1 aw">
                <h3>Clinical Excellence Award of the year</h3>
                <p>Acknowledging exceptional precision and excellence in the field of diagnostic testing, we recognize and commend the noteworthy standards achieved in terms of accuracy and quality within this vital aspect of healthcare services. </p>
            </div>
            <div class="award2 aw">
                <h3>SAHANYA Labstory Technology Award</h3>
                <p>In joyous commemoration, we take a moment to celebrate the impactful narrative of SAHANYA Labstories, a narrative that unfolds as a compelling saga of driving substantial advancements in the realm of diagnostics.</p>
            </div>
            <div class="award3 aw">
                <h3>SAHANYA Labstory of the Year</h3>
                <p>In an earnest tribute, we extend our heartfelt appreciation to laboratories that place an unwavering emphasis on the paramount values of patient care and satisfaction.</p>
            </div>
        </div>
    </div>

    <div class="contact-section" id="contact-section"><h1>Contact <span>SAHANYA Labs</span></h1></div>
    <div class="contact" id="contact">
        <div class="background">
            <h2>Get In Touch</h2>
            <p>We’re here to help and answer any questions you might have. We will answer your inquiries in a maximum of 48 hours.</p>
            <p><i class="fa-solid fa-location-dot"></i> 123, Galle Road,Colombo 00500.</p>
            <p><i class="fa-solid fa-envelope"></i> Sahanyalabs@gmail.com</p>
            <p><i class="fa-brands fa-facebook"></i> SahanyaLabs</p>
        </div> 

        <div class="contact-form">
                <form action="submit.php" method="post">
                    <label for="name">Name*</label><br>
                    <input type="text" id="name" pattern="[A-Za-z. ]+" required><br>
                    <label for="email">Email*</label><br>
                    <input type="email" id="email" name="email"  required><br>
                    <label for="tel">Phone Number*</label><br>
                    <input type="text" id="tel" name="tel"  minlength="10" required><br>
                    <label for="subject">Subject*</label><br>
                    <input type="text" id="subject" name="subject" required><br>
                    <label for="message">Message*</label><br>
                    <input id="message" name="message" rows="1" placeholder="Write your message here..." required></input><br>
                    <input type="submit" value="Submit" class="submit button">
                </form>
        </div>   
    </div>
    <footer class="footer">
    <div class="footer__addr">
        <h1 class="footer__logo">LABORA</h1>
            
        <h2>Contact</h2>
        
        <address>
            42B Galle Road, Colombo 00300, Sri Lanka<br>
            Tel : 0783476123
            
        <a class="footer__btn" onclick="copyEmail()">Email Us</a>
        </address>
    </div>
    
    <ul class="footer__nav">
        <li class="nav__item">
        <h2 class="nav__title">Menu</h2>
    
        <ul class="nav__ul">
            <li>
            <a href="#home">Home</a>
            </li>
    
            <li>
            <a href="#services">Services</a>
            </li>
                
            <li>
            <a href="#aboutUs">About Us</a>
            </li>

            <li>
                <a href="#contact">Contact Us</a>
                </li>
        </ul>
        </li>
        
        <li class="nav__item nav__item--extra">
        <h2 class="nav__title">Services</h2>
        
        <ul class="nav__ul nav__ul--extra">
            <li>
            <a href="#">Complete Blood Count (CBC)</a>
            </li>
            
            <li>
            <a href="#">Lipid Profile</a>
            </li>
            
            <li>
            <a href="#">Blood Glucose Test</a>
            </li>
        </ul>
        </li>
        
        <li class="nav__item li3">
        <h2 class="nav__title">Legal</h2>
        
        <ul class="nav__ul">
            <li>
            <a href="#">Privacy Policy</a>
            </li>
            
            <li>
            <a href="#">Terms of Use</a>
            </li>
            
            <li>
            <a href="#">Sitemap</a>
            </li>
        </ul>
        </li>
    </ul>
    
    <div class="legal">
        <p>&copy; 2023 Labs. All rights reserved.</p>
    </div>
    </footer>

    <!-- java script -->
    <script src="<?php echo APPROOT.'\public\js\Home.js';?>"></script>


</body>
</html>