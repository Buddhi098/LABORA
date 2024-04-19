<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/finance_report.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <!-- charts -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Admin dashboard</title>
</head>
<body>
    <?php require_once 'components/report_nevbar.php' ?>
    <div class="container_1">
    <button id="download-button" style="background-color: #5E2BB8;
        border: none;
        color: white;
        padding: 10px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 12px;
        border: 2px solid #2C2F32;">Download as PDF</button>

        <div id="invoice">
        <!-- <h1>Our Invoice</h1> -->
        <canvas id="myChart" style="width: 100%; max-width: 500px"></canvas>
        <canvas id="myChart2" style="width: 100%; max-width: 500px"></canvas>
        </div>
        <!-- New Chart -->
        <!-- <div id="invoice">
        <canvas id="myChart2" style="width: 100%; max-width: 500px"></canvas>
        </div> -->
    </div>
    <script src="<?php echo APPROOT.'/public/js/admin/chart.js';?>"></script>
    </body>
</html>