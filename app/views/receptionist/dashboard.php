<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/receptionist/recept.js';?>"></script>
    
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Receptionist dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="grid-container">


            <div class="grid-item box box-1">
                <div class="icon"><i class="fa-solid fa-hospital-user"></i></div>
                <div class="text"><h2>2500</h2><p>Total Patients</p></div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="grid-item box box-2">
                <div class="icon"><i class="fa-solid fa-money-bill"></i></div>
                <div class="text"><h2>Rs.2500</h2><p>Today Revenue</p></div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="grid-item box box-3">
                <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="text"><h2>2500</h2><p>Today Appointment</p></div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="grid-item box box-4">
                <div class="icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <div class="text"><h2>2500</h2><p>Total Refund</p></div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>


            <div class="grid-item big-item graph-1">
                    <div class="graph-text">
                        <div class="graph_icon"><i class="fa-solid fa-chart-column"></i></div>
                        <h4> Appointment Count</h4>
                    </div>
                    <p>You can check daily appointment counts here.</p>
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
            </div>


            <div class="grid-item big-item big-box">
                    <div class="graph-text">
                        <div class="graph_icon"><i class="fa-regular fa-calendar-check"></i></div>
                        <h4>Appointments for Today</h4>
                    </div>
                    <p>You can easily view all appointments scheduled for today right here</p>

                    <div class="data-box">
                        <div class="data">
                            <div class="item"><div class="icon"><i class="fa-solid fa-user"></i></div></div>
                            <div class="item name">RH-001</div>
                            <div class="item test_data">
                                <h3>Blood</h3>
                                <p>Health Check Category</p>
                            </div>
                            <div class="item test_data">
                                <h3>10.30</h3>
                                <p>Time</p>
                            </div>
                        </div>
                        <div class="data">
                            <div class="item"><div class="icon"><i class="fa-solid fa-user"></i></div></div>
                            <div class="item name">RH-001</div>
                            <div class="item test_data">
                                <h3>Blood</h3>
                                <p>Health Check Category</p>
                            </div>
                            <div class="item test_data">
                                <h3>10.30</h3>
                                <p>Time</p>
                            </div>
                        </div>
                        <div class="data">
                            <div class="item"><div class="icon"><i class="fa-solid fa-user"></i></div></div>
                            <div class="item name">RH-001</div>
                            <div class="item test_data">
                                <h3>Blood</h3>
                                <p>Health Check Category</p>
                            </div>
                            <div class="item test_data">
                                <h3>10.30</h3>
                                <p>Time</p>
                            </div>
                        </div>
                        <div class="data">
                            <div class="item"><div class="icon"><i class="fa-solid fa-user"></i></div></div>
                            <div class="item name">RH-001</div>
                            <div class="item test_data">
                                <h3>Blood</h3>
                                <p>Health Check Category</p>
                            </div>
                            <div class="item test_data">
                                <h3>10.30</h3>
                                <p>Time</p>
                            </div>
                        </div>
                        <div class="data">
                            <div class="item"><div class="icon"><i class="fa-solid fa-user"></i></div></div>
                            <div class="item name">RH-001</div>
                            <div class="item test_data">
                                <h3>Blood</h3>
                                <p>Health Check Category</p>
                            </div>
                            <div class="item test_data">
                                <h3>10.30</h3>
                                <p>Time</p>
                            </div>
                        </div>
                        <div class="data">
                            <div class="item"><div class="icon"><i class="fa-solid fa-user"></i></div></div>
                            <div class="item name">LB-0026</div>
                            <div class="item test_data">
                                <h3>Thyroid Function Test (TFT)</h3>
                                <p>Health Check Category</p>
                            </div>
                            <div class="item test_data">
                                <h3>10.30</h3>
                                <p>Time</p>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="grid-item big-item calendar">
                    <div class="graph-text">
                        <div class="graph_icon"><i class="fa-regular fa-calendar-days"></i></div>
                        <h4>Calendar</h4>
                    </div>
                    <p>You can indicate days off or holidays on this calendar.</p>
                  <div class="calendar_1">
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
            <div class="grid-item big-item holiday">
                <div class="graph-text">
                    <div class="graph_icon"><i class="fa-solid fa-mug-hot"></i></div>
                    <h4>Mark Holiday</h4>
                </div>
                <p>You can indicate days off or holidays on this calendar.</p>
                <div class="holiday-item">
                <input type="date" id="holiday-date" placeholder="Select holiday date" required>
                <input type="text" id="holiday-reason" placeholder="Add reason">
                <button class="btn" id="save-holiday">Save</button>
                </div>
                <div class="container">
                    <div class="holiday-list">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getTime(date){
            
        }
    </script>
    
    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- for grahp script -->
    <script src="<?php echo APPROOT . '/public/js/receptionist/dashboard.js'; ?>"></script>
</body>
</html>

