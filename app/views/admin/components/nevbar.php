<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <script src="<?php echo APPROOT.'/public/js/admin/admin.js'?>"></script>
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/nevbar.css'?>">

    <!-- import table styles -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/components/table.css'?>">
    
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>

    <!--Modal -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/components/modal.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/components/modal.js' ?>"></script>

    <!-- popup messages -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/components/popup.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/components/popup.js' ?>"></script>

    <!-- delete warning message -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/components/warningModal.css' ?>">
    <!-- <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script> -->

    <!-- loading -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/components/loading.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/components/loading.js' ?>"></script>
    
    <title>Admin dashboard</title>
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
                    <a href="<?php echo URLROOT?>admin/dashboard">
                    <span class="icon"><ion-icon name="grid"></ion-icon></span>
                    <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo URLROOT?>admin/userAccount">
                    <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
                    <span class="title">User Accounts</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo URLROOT?>admin/medicaltest">
                    <span class="icon"><ion-icon name="thermometer"></ion-icon></span>
                    <span class="title">Medical Tests</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo URLROOT?>admin/payment">
                    <span class="icon"><ion-icon name="cash-outline"></ion-icon></span>
                    <span class="title">Payment</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo URLROOT?>report/test_report">
                    <span class="icon"><ion-icon name="document-attach-outline"></ion-icon></span>
                    <span class="title">Reports</span>
                    </a>
                </li>
            </ul>
            <div class="logout">
                <a href="<?php echo URLROOT?>Employee/logout" class="button">
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
                    <img src="/labora/public/img/patientdashboard/user1.jpg" alt="">
                    <h4><?php echo $_SESSION['username'];?><span></h4>
                </div>
            </div>
        </div>
    </div>

    <!--add hover effect to the table -->
    <script src="<?php echo APPROOT.'/public/js/components/navbar.js'?>"></script>
    
</body>
</html>

<script>
    // toggle function 

navigation = 

window.onload = function(){

    sessionStorage.setItem('toggle_flag', 0);
    toggle()
}

function toggle(){
    console.log(sessionStorage.getItem('toggle_flag'))
    if(sessionStorage.getItem('toggle_flag')==1){
        document.getElementById('nav_bar').style.width = '80px';

        document.querySelector('.navigation ul').style.marginLeft = '30px';
        document.querySelector('.logooo h2').style.display = 'none';
        titles = document.querySelectorAll('.navigation ul li a .title');
        list_items = document.querySelectorAll('.navigation ul li');
        titles.forEach(title => {
            title.style.display = 'none';
        });


        document.querySelector('.logout').style.display = 'none';

        document.querySelector('.main').style.width = 'calc(100% - 80px)'
        document.querySelector('.main').style.left = '80px'


        document.querySelector('.container_1').style.width = 'calc(100% - 80px)'
        document.querySelector('.container_1').style.left = '80px'

        sessionStorage.setItem('toggle_flag', 0);
        
    }else if(sessionStorage.getItem('toggle_flag')==0 || sessionStorage.getItem('toggle_flag')==undefined){
        document.getElementById('nav_bar').style.width = '300px';

        document.querySelector('.navigation ul').style.marginLeft = '40px';
        document.querySelector('.logooo h2').style.display = 'block';
        titles = document.querySelectorAll('.navigation ul li a .title');
        list_items = document.querySelectorAll('.navigation ul li');
        titles.forEach(title => {
            title.style.display = 'block';
        });


        document.querySelector('.logout').style.display = 'block';

        document.querySelector('.main').style.width = 'calc(100% - 300px)'
        document.querySelector('.main').style.left = '300px'


        document.querySelector('.container_1').style.width = 'calc(100% - 300px)'
        document.querySelector('.container_1').style.left = '300px'

        sessionStorage.setItem('toggle_flag', 1);
        
    }
}
</script>