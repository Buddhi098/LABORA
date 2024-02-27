<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/receptionist/receptionist.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Receptionist</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">
            <div class="box box-1">
                <span>6</span><br>
                <h3>Register Patients</h3><br>
                <p>Number of patients registered in a day</p>
            </div>
            <div class="box box-2">
                <span>8</span><br>
                <h3>Appointments</h3><br>
                <p>Number of appointments in a day</p>
            </div>
            <div class="box box-3">
                <span>Rs 6000</span><br>
                <h3>Payment</h3><br>
                <p>Total amount of payments received in a day</p>
            </div>
        </div>
        <div class="boxset_2">
            <div class="bigbox bigbox_1">
                <div class="title">
                    <h3></h3>
                    <!-- <p class="sub_title"><i class="fa-solid fa-file-invoice-dollar"></i></p> -->
                </div>
            </div>
            <div class="bigbox bigbox_2">
                    <div class="calendar">
                        <div class="header">
                            <div class="month"></div>
                            <div class="btns">
                                <div class="btn today-btn">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="btn prev-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </div>
                                <div class="btn next-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="weekdays">
                            <div class="day">Sun</div>
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                        </div>
                        <div class="days">
                            <!-- lets add days using js -->
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="<?php echo APPROOT.'/public/js/receptionist/dashboard.js';?>"></script>

    <script>
        function getTime(date){
            
        }
    </script>
</body>
</html>