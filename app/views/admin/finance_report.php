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
    <!-- charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Admin dashboard</title>
</head>
<body>
    <?php require_once 'components/report_nevbar.php' ?>
    <div class="container_1">
        <!-- Top Boxes -->
        <div class="top-box">
            <!-- First Top Box -->
            <div class="box">
                <!-- Content for First Top Box -->
                <h1>ssssss</h1>
                <canvas id="myChart"></canvas>
            </div>
            <!-- Second Top Box -->
            <div class="box">
                <!-- Content for Second Top Box -->
                <h1>ssssss</h1>
                <canvas id="myChart2"></canvas>
            </div>
        </div>

        <!-- Centered Bottom Box -->
        <div class="center-box">
            <!-- Content for Centered Bottom Box -->
            <div class="box">
                <!-- Content for Centered Bottom Box -->
                <h1>ssssss</h1>
            </div>
        </div>
    </div>
    <script>
        // var data1 = <?php echo json_encode($data['graph_data'], JSON_HEX_TAG); ?>; // Don't forget the extra semicolon!
        let graph_data = <?php echo json_encode($data['graph_data'])?>;
    </script>
    <script src="<?php echo APPROOT.'/public/js/admin/finance_report.js';?>"></script>
</body>
</html>