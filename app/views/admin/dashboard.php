<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/dashboard.css'?>">
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin dashboard</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <div class="container_1">
    <div class="dashboard-container">
  <!-- Dashboard Header -->
  <!-- <div class="dashboard-header">
    <h2>Admin Dashboard</h2>
    <div class="date-range">
      <input type="date" id="start-date" placeholder="Start Date">
      <input type="date" id="end-date" placeholder="End Date">
    </div>
  </div> -->

  <!-- Dashboard Cards -->
  
    <div class="top-cards">
        <div class="card">
            <div class="card-icon">
            <!-- <i class="fas fa-clipboard-list"></i> -->
            <i class="ri-user-2-line card--icon--lg"></i>
            </div>
            <div class="card-content">
            <h3>User Accounts</h3>
            <p>6</p>
            </div>
        </div>

        <div class="card">
            <div class="card-icon">
            <i class="ri-user-line card--icon--lg"></i>
            </div>
            <div class="card-content">
            <h3>Total Patients</h3>
            <p>200</p>
            </div>
        </div>

        <div class="card">
            <div class="card-icon">
                <!-- <i class="fas fa-trash"></i> -->
                <ion-icon name="calendar-number-outline"></ion-icon>
            </div>
            <div class="card-content">
                <h3>Appointments</h3>
                <p>23</p>
            </div>
        </div>

        <div class="card">
            <div class="card-icon">
            <ion-icon name="cash-outline"></ion-icon>
            </div>
            <div class="card-content">
                <h3>Total Revenue</h3>
                <p>Rs 12 000</p>
            </div>
        </div>
    </div>

        <!-- Dashboard Rows Original-->

        <!-- <div class="dashboard-row">
        <div class="urgent-actions">
            <h2>Urgent Actions</h2>
            <div class="action-item">
            <div class="action-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="action-content">
                <h3>Below Alert Quantity</h3>
                <p>15 items</p>
            </div>
            </div>
            <div class="action-item">
            <div class="action-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="action-content">
                <h3>New Expiry (21 Days)</h3>
                <p>8 items</p>
            </div>
            </div>
        </div>

        <div class="urgent-actions">
        <h2>Invoice Details</h2>
        <div class="action-item">
            <div class="action-icon">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div class="action-content">
                <h3>Pending Invoices</h3>
                <p>25</p>
            </div>
            </div>
            <div class="action-item">
            <div class="action-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="action-content">
                <h3>Invoices to Check</h3>
                <p>12</p>
            </div>
            </div>
        </div>
        </div> -->

        <div class="dashboard-row">
            <div class="urgent-actions">
                <!-- <h2>Urgent Actions</h2> -->
                <div class="action-item">
                    <!-- <div class="action-icon"></div> -->
                    <div class="action-content">
                        <h3>Patients by Gender</h3>
                        <!-- <p>Chart Details</p> -->
                    </div>
                </div>
                <div><canvas id="myChart"></canvas></div>
            </div>
            <div class="urgent-actions">
                <div class="action-item">
                    <div class="action-content">
                        <h3>Appointment Schedule</h3>
                        <!-- <p>12</p> -->
                    </div>
                </div>
                <div><canvas id="myChart2"></canvas></div>
            </div>
            <div class="urgent-actions">
                <div class="action-item">
                    <div class="action-content">
                        <h3>Payment Status</h3>
                        <!-- <p>12</p> -->
                    </div>
                </div>
                <div><canvas id="myChart3"></canvas></div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-section">
            <div class="chart-container">
                <h3>Revenue</h3>
                <div><canvas id="myChart4"></canvas></div>
            </div>
            <div class="chart-container2">
                <!-- <h3>Calender</h3> -->
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

            <!-- Table Section -->
            <!-- <div class="table-section">
                <h3>Recent Orders</h3>
                <table>
                <thead>
                    <tr>
                    <th>Order ID</th>
                    <th>Supplier</th>
                    <th>Expected Date</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>56</td>
                    <td>Avindu</td>
                    <td>2023-04-20</td>
                    <td>Pending</td>
                    
                    </tr>
                    <tr>
                    <td>59</td>
                    <td>Avindu</td>
                    <td>2023-04-19</td>
                    <td>Recieved</td>
                    
                    </tr>
                </tbody>
                </table>
            </div> -->
        </div>
    </div>

    <script src="<?php echo APPROOT.'/public/js/admin/dashboard.js';?>"></script>

    <script>
        function getTime(date){
            
        }
    </script>

</body>

</html>