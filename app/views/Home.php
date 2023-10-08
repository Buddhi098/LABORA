<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo APPROOT.'\public\css\styles.css';?>">
    <script src="<?php echo APPROOT.'\public\js\home.js';?>"></script>
</head>
<body>
    <div class="container">
        <div class="header">
        <nav>
            <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="" class="logo">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#aboutUs">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
            
        <nav>
            <a href="<?php echo URLROOT?>user/login" class="signin-button button">Sign In</a>
        </div>
        <div class="hero">
        <h1>Welcome to <span class="SAHANYA Labs">SAHANYA Labs</span></h1>
        <h4>Setting the Standard in Healthcare Excellence</h4>
        <p>Welcome to SAHANYA Labs, your trusted partner in precision medical testing and healthcare excellence. With a legacy of accuracy and a commitment to your well-being, we provide reliable results. Explore advanced diagnostics and personalized care for your health.</p><br>
        <a href="<?php echo URLROOT?>user/register" class="signup-button button">Get Started</a>
        </div>
        
    </div>
    <div class="services" id="services">
        <h1>Our Comprehensive Services</h1>
        <div class="horizontal-line"></div>
        <h3>Advanced Medical Testing Tailored to Your Needs</h3>
        <p>At SAHANYA Labs, we offer a wide range of medical tests and diagnostics to cater to your healthcare needs. Our dedicated team of professionals ensures accurate and timely results. Below are some of the key tests we provide, along with important pre-preparation information.</p>
        <h4>Available Medical Test</h4>
        <div class="test-list">
            <div>
                <ul>
                <li><a onclick="CBC();" id="first">Complete Blood Count (CBC)</a></li>
                <li><a onclick="Lipid();">Lipid Profile</a></li>
                <li><a onclick="Glucose();">Blood Glucose Test</a></li>
                <li><a onclick="Urinalysis();">Urinalysis</a></li>
                <li><a onclick="Density();">Bone Density Scan (DXA)</a></li>
                <li><a onclick="XRay();">X-Ray (Radiography)</a></li>
                <li><a onclick="ECG();">Electrocardiogram (ECG or EKG)</a></li>
                <li><a onclick="BPM();">Blood Pressure Measurement</a></li>
                <li><a onclick="MRI();">MRI (Magnetic Resonance Imaging)</a></li>
                <li><a onclick="Pap();">Pap Smear</a></li>
            </ul>
            </div>
            <div class="vertical-line"></div>
            <div class="discription">
                <p id="dis">    
                    
                </p>
            </div>
        </div>
    </div>
    <div class="aboutus" id="aboutUs">
        <div class="bimg"><br>
        <h1>About <span>SAHANYA Labs</span></h1>
        <div class="horizontal-line"></div>
        <p>SAHANYA Labs holds a prominent position within the medical SAHANYA Labstory landscape, earning recognition for its unwavering dedication to the utmost precision, unparalleled reliability, and a relentless pursuit of excellence in diagnostics. With a history dating back to our establishment in 2010, we have remained steadfast in our mission to consistently establish and maintain the highest standards in quality healthcare services. Over the years, our commitment to excellence has evolved into a legacy, setting a benchmark that inspires trust among our patients and partners in the healthcare community</p>
        </div>
        <div class="award">
            <h1>Our Awards and Recognitions</h1>
            <div class="horizontal-line"></div>
            <div class="awards">
                <div class="award1 aw">
                    <img src="<?php echo APPROOT.'/public/img/award1.png';?>" alt="image not found">
                    <h3>Clinical Excellence Award of the year</h3>
                    <p>Recognizing outstanding accuracy and quality in diagnostic testing.</p>
                </div>
                <div class="award2 aw">
                    <img src="<?php echo APPROOT.'/public/img/award2.png';?>" alt="image not found">
                    <h3>Innovation in SAHANYA Labstory Technology Award</h3>
                    <p>Celebrating SAHANYA Labstories driving advancements in diagnostic.</p>
                </div>
                <div class="award3 aw">
                    <img src="<?php echo APPROOT.'/public/img/award3.png';?>" alt="image not found">
                    <h3>Patient-Centric SAHANYA Labstory of the Year</h3>
                    <p>Honoring labs prioritizing patient care and satisfaction.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="contact" id="contact">
        <div class="contact-section"><h1><br>Contact <span>SAHANYA Labs</h1></span><br><div class="horizontal-line"></div></div>
        <div class="contact-form">
        <form action="submit.php" method="post">
            <fieldset class="getintouch">
                <legend><h2>Get In Touch</h2></legend>
                <input type="text" id="name" name="name" placeholder="Name" required>

                <input type="email" id="email" name="email" placeholder="Email" required><br>

                <input type="text" id="subject" name="subject" placeholder="Subject" required><br>

                <textarea id="message" name="message" rows="4" placeholder="Message" required></textarea><br>

                <input type="submit" value="Submit" class="submit button">
            </fieldset>
            
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
        
        <li class="nav__item">
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
</body>
</html>