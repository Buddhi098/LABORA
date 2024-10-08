<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/appointment_report.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Download as PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <title>Admin Dashboard</title>
</head>

<body>
    <?php require_once 'components/report_nevbar.php' ?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <div class="container_1">
        <div class="dashboard-container">
        <!-- Download section indicate -->
        <div class="content"> 
            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <h2>Appointment Report</h2>
                <!-- <div class="date-range">
                    <input type="date" id="start-date" placeholder="Start Date">
                    <input type="date" id="end-date" placeholder="End Date">
                </div> -->
            </div>

                <!-- Dashboard Cards -->           
                <!-- <div class="top-cards">
                <div class="card">
                    <div class="card-icon">
                    <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-content">
                    <h3>Pending Orders</h3>
                    <p>25</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                    <i class="fas fa-box-open"></i>
                    </div>
                    <div class="card-content">
                    <h3>Total Stock Value</h3>
                    <p>$120,000</p>
                    </div>
                </div>
                </div> -->

                    <!-- <div class="urgent-actions">
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
                    </div> -->

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

                    <div class="invoice-details">
                        <div class="invoice-card">
                        <div class="invoice-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="invoice-content">
                            <h3>Pending Invoices</h3>
                            <p>25</p>
                        </div>
                        </div>
                        <div class="invoice-card">
                        <div class="invoice-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="invoice-content">
                            <h3>Invoices to Check</h3>
                            <p>12</p>
                        </div>
                        </div>
                    </div>
                    </div> -->

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

                    <div class="invoice-details">
                        <div class="invoice-card">
                        <h3>Pending Invoices</h3>
                        <div class="invoice-list">
                            <div class="invoice-item">
                            <span class="invoice-number">INV-00123</span>
                            <span class="invoice-date">Expected: 06/15/2023</span>
                            </div>
                            <div class="invoice-item">
                            <span class="invoice-number">INV-00456</span>
                            <span class="invoice-date">Expected: 06/20/2023</span>
                            </div>
                        
                        </div>
                        </div>
                        <div class="invoice-card">
                        <h3>Invoices to Check</h3>
                        <div class="invoice-list">
                            <div class="invoice-item">
                            <span class="invoice-number">INV-00789</span>
                            <span class="invoice-date">Received: 06/10/2023</span>
                            </div>
                            <div class="invoice-item">
                            <span class="invoice-number">INV-00012</span>
                            <span class="invoice-date">Received: 06/12/2023</span>
                            </div>
                        
                        </div>
                        </div>
                    </div>
                    </div> -->

                <div class="dashboard-row">
                    <div class="urgent-actions">
                        <h2>Monthly Appointment Status</h2>
                        <!-- <div class="action-item">
                            <div class="action-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="action-content">
                                <h3>Below Alert Quantity</h3>
                                <p>15 items</p>
                            </div>
                        </div> -->
                        <div><canvas id="myChart"></canvas></div>
                        <!-- <div class="filter-container">
                            <label for="Date">Enter Date:</label>
                            <input type="date" id="Date">
                            <button onclick="applyDateFilter()">Apply</button>
                        </div> -->
                    </div>

                    <div class="urgent-actions2">
                        <h2>Weekly Appointment Schedule</h2>
                        <!-- <div class="action-item">
                            <div class="action-icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <div class="action-content">
                                <h3>Pending Invoices</h3>
                                <p>25</p>
                            </div>
                        </div> -->
                        <div><canvas id="myChart2"></canvas></div>
                        <!-- <div class="filter-container">
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate">
                            <label for="endDate">End Date:</label>
                            <input type="date" id="endDate">
                            <button onclick="applyDateFilter()">Apply</button>
                        </div> -->
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="chart-section">
                    <div class="chart-container">
                        <h3>Daily Appointments By Time</h3>
                        <div><canvas id="myChart3"></canvas></div>
                        <!-- <div class="filter-container">
                            <label for="Date">Enter Date:</label>
                            <input type="date" id="Date">
                            <button onclick="applyDateFilter()">Apply</button>
                        </div> -->
                    </div>
                    <!-- <div class="chart-container2">
                        <h3>Weekly Test Count by Test Types</h3>
                        <canvas id="myChart4"></canvas>
                    </div> -->
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
            <div class="download-container">
                <span class="download-text">Download the Report as PDF</span>
                <button class="download-btn" onclick="getPDF()">Download</button>
            </div>
        </div>
    </div>

    <!-- data pass to the chart -->
    <script>
        let appointment_status = <?php echo json_encode($data['appointment_status']); ?>;
        let app_data = <?php echo json_encode($data['app_data']); ?>;
        let appointment_time = <?php echo json_encode($data['appointment_time']); ?>;
        console.log(appointment_time);
    </script>
    <script src="<?php echo APPROOT.'/public/js/admin/appointment_report.js';?>"></script>

    <script>
    </script>

</body>

</html>