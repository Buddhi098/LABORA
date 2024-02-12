<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Patient dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset_1">

            <div class="box box_1">
                <div class="text">
                    <h5>Number of Reports Received</h5>
                    <h1>14</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> patient are kept up to date with real-time updates to their medical history.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Number of Medical Test Types</h5>
                    <h1>3</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> This box provides a snapshot of the variety of medical test types the patient has undergone.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Total Refund</h5>
                    <h1>Rs. 6500</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> giving back all the money to a patient if they cancel their appointment in a lab system</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                </div>
            </div>

            <div class="box box_2">
                <div class="text">
                    <h5>Medical Test Expenses</h5>
                    <h1>Rs. 65</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i> The total expenses will automatically update as new costs are incurred.</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
            </div>

        </div>
        <div class="boxset_2">
            <div class="bigbox bigbox_1">
                <div class="title">
                    <h3>All Medical Tests</h3>
                    <p class="sub_title"><i class="fa-solid fa-file-invoice-dollar"></i> Cost of medical Test</p>
                </div>
                <div class="boxes">
                    <div class="test_box">
                        <div class="tbox tbox_1">
                            <h4><i class="fa-solid fa-heart-pulse" style="color: #8000ff;"></i>  Blood Test</h4>
                        </div>
                        <div class="tbox tbox_1">
                            <p>$1500</p>
                            <span>Cost</span>
                        </div>
                        <div class="tbox tbox_1">
                            <p>15 min</p>
                            <span>Time duration</span>
                        </div>
                    </div>
                    <div class="test_box">
                        <div class="tbox tbox_1">
                            <h4><i class="fa-solid fa-heart-pulse" style="color: #8000ff;"></i>  Blood Test</h4>
                        </div>
                        <div class="tbox tbox_1">
                            <p>$150</p>
                            <span>Cost</span>
                        </div>
                        <div class="tbox tbox_1">
                            <p>12 min</p>
                            <span>Time duration</span>
                        </div>
                    </div>
                    <div class="test_box">
                        <div class="tbox tbox_1">
                            <h4><i class="fa-solid fa-heart-pulse" style="color: #8000ff;"></i>  Blood Test</h4>
                        </div>
                        <div class="tbox tbox_1">
                            <p>$100</p>
                            <span>Cost</span>
                        </div>
                        <div class="tbox tbox_1">
                            <p>20 min</p>
                            <span>Time duration</span>
                        </div>
                    </div>
                    <div class="test_box">
                        <div class="tbox tbox_1">
                            <h4><i class="fa-solid fa-heart-pulse" style="color: #8000ff;"></i>  Blood Test</h4>
                        </div>
                        <div class="tbox tbox_1">
                            <p>$1500</p>
                            <span>Cost</span>
                        </div>
                        <div class="tbox tbox_1">
                            <p>15 min</p>
                            <span>Time duration</span>
                        </div>
                    </div>
                    <div class="test_box">
                        <div class="tbox tbox_1">
                            <h4><i class="fa-solid fa-heart-pulse" style="color: #8000ff;"></i>  Blood Test</h4>
                        </div>
                        <div class="tbox tbox_1">
                            <p>$1500</p>
                            <span>Cost</span>
                        </div>
                        <div class="tbox tbox_1">
                            <p>15 min</p>
                            <span>Time duration</span>
                        </div>
                    </div>
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

    <script src="<?php echo APPROOT.'/public/js/patientdashboard/dashboard.js';?>"></script>

    <script>
        function getTime(date){
            
        }
    </script>
</body>
</html>