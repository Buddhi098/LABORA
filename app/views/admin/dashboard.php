<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/admin.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Admin dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset-1">

            <div class="box box-1">
                <span>8</span><br>
                <h3>Number of User Accounts</h3><br>
            </div>

            <div class="box box-2">
                <span>16</span><br>
                <h3>Number of Medical Tests</h3><br>
            </div>

            <div class="box box-3">
                <span>Rs 16000</span><br>
                <h3>Total Revenue</h3><br>
            </div>

            <!-- <div class="box box_2">
                <div class="text">
                    <h5>Medical Test Expenses</h5>
                    <h1>Rs. 65</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> The total expenses will automatically update as new costs are incurred.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
            </div> -->

        </div>
        <div class="boxset_2">
            <div class="bigbox bigbox_1">
                <div class="title">
                    <h3>Reports</h3>
                    <p class="sub_title"><i class="fa-solid fa-file-invoice-dollar"></i></p>
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

    <script src="<?php echo APPROOT.'/public/js/admin/dashboard.js';?>"></script>

    <script>
        function getTime(date){
            
        }
    </script>
</body>
</html>