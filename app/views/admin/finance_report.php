<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/finance_report.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/admin.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>

    <!-- Download Button -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    
    <!-- charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Admin dashboard</title>
</head>
<body>
    <?php require_once 'components/report_nevbar.php' ?>
    <div class="container_1" >
    <div class="header">
        <div class="ChartTitle">Finance Report</div>
        <div class="actions">
            <button class="download-btn" onclick="getPDF()">Download as PDF</button>
        </div>
    </div>
    <div class="content">
        <div class="top-boxes">
            <div class="box box-small">
                <!-- Chart 1 pie chart-->
                <div><canvas id="myChart" class="chart"></canvas></div>
            </div>
            <div class="box box-large">
                <!-- Chart 2  -->
                <div><canvas id="myChart2" class="chart"></canvas></div>
            </div>
        </div>
        <div class="bottom-box" id="abc">
            <!-- Date Range Filter -->
            <div class="filter-container">
                <div class="filter-item">
                    <label for="startMonth">Start Month:</label>
                    <select id="startMonth">
                        <option value="">Select Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="filter-item">
                    <label for="endMonth">End Month:</label>
                    <select id="endMonth">
                        <option value="">Select Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <button onclick="filterChart()">Apply Filter</button>
            </div>
            <!-- Chart 3 -->
            <div><canvas id="myChart3" class="chart"></canvas></div>
        </div>
    </div>
    </div>
    <script>
        let graph_data = <?php echo json_encode($data['graph_data'])?>;
        let graph_data2 = <?php echo json_encode($data['revenue_data'])?>;
        let graph_data3 = <?php echo json_encode($data['revenue_month'])?>;

    </script>
    <script src="<?php echo APPROOT.'/public/js/admin/finance_report.js';?>"></script>
</body>
</html>