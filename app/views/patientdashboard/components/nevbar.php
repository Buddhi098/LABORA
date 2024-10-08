<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js'?>"></script>
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/nevbar.css'?>">
    
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>

     <!-- import table styles -->
     <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/table.css'?>">

    <!-- common javascript functions -->
    <script src="<?php echo APPROOT.'/public/js/components/navbar.js'?>"></script>

    <!--Modal -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/modal.css'?>">
    <script src="<?php echo APPROOT.'/public/js/components/modal.js'?>"></script>

    <!-- popup messages -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/popup.css'?>">
    <script src="<?php echo APPROOT.'/public/js/components/popup.js'?>"></script>

    <!-- delete warning message -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/warningModal.css'?>">
    <!-- <script src="<?php echo APPROOT.'/public/js/components/warningModal.js'?>"></script> -->

    <!-- loading -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/loading.css'?>">
    <script src="<?php echo APPROOT.'/public/js/components/loading.js'?>"></script>
    
    <title>Patient dashboard</title>
</head>
<body>
    <div class="container">
        <div class="navigation" id="nav_bar">
            <div class="logooo">
                <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="">
                <h2>Sahanya Labs</h2>
            </div>
            <ul>
                <li>
                    <a href="http://localhost/labora/PatientDashboard/dashboard">
                    <span class="icon"><ion-icon name="grid"></ion-icon></span>
                    <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/labora/PatientDashboard/appointment">
                    <span class="icon"><ion-icon name="calendar-number"></ion-icon></ion-icon></span>
                    <span class="title">Appointment</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/labora/PatientDashboard/report">
                    <span class="icon"><ion-icon name="reader"></ion-icon></span>
                    <span class="title">Medical Reports</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/labora/PatientDashboard/medicaltest">
                    <span class="icon"><ion-icon name="thermometer"></ion-icon></span>
                    <span class="title">Medical Tests</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/labora/PatientDashboard/editProfile">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <span class="title">Profile</span>
                    </a>
                </li>
            </ul>
            <div class="logout" onclick="clearSession()">
                <a href="http://localhost/labora/user/logout" class="button">
                <span class="icon"><ion-icon name="log-out"></ion-icon></span>
                <span class="log">Log out</span>
                </a>
            </div>
            
        </div>


    <!-- Top bar -->
        <div class="main">
            <div class="topbar">
                <button class="toggle_button" onclick="toggle()">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>
                </button>
                <div class="user">
                    <img id="top_bar_pic" src=<?php echo APPROOT."/public/img/profile/". $_SESSION['profile_image']?> alt="">
                    <h4><?php echo $_SESSION['username'];?></h4>
                </div>
            </div>
        </div>
    </div>

    <!--add hover effect to the table -->
    <script src="<?php echo APPROOT.'/public/js/components/navbar.js'?>"></script>
    
</body>
</html>

<script>
    let list = document.querySelectorAll(".navigation ul li");


    if (sessionStorage.getItem('activeIndex')) {
        let activeIndex = parseInt(sessionStorage.getItem('activeIndex'));

        list[activeIndex].classList.add("hovered");
    }else{
        document.querySelector(".navigation ul li:nth-child(1)").classList.add("hovered");
    }

    function activeLink() {

        list.forEach((item) => {
            item.classList.remove("hovered");
        });

        let index = Array.from(list).indexOf(this);

        sessionStorage.setItem('activeIndex', index.toString());
    }

    list.forEach((item) => item.addEventListener('click', activeLink));

    function clearSession(){
        sessionStorage.clear();
    }

</script>