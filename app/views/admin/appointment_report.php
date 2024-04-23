<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/appointment_report.css'?>">
    <script src="<?php echo APPROOT.'/public/js/admin/admin.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>

    <!-- Download Button -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Admin dashboard</title>
</head>
<body>
    <?php require_once 'components/report_nevbar.php' ?>
    <!-- <div class="container_1" > This is Conatainer
    </div> -->
    <div class="container_1">
        <!-- Header Div -->
        <!-- <div class="header">
            <h1>Appointment Report</h1>
            <button onclick="downloadAsPDF()">Download as PDF</button>
        </div> -->

        <!-- Wrapper 1 Div -->
        <div class="wrapper1">
            <!-- Header 2 Div -->
            <div class="header2">
                <h1>Appointment Report</h1>
            </div>

            <!-- Wrapper 2 Div -->
            <div class="wrapper2">
                <!-- Header 3 as Full Width -->
                <!-- <div class="header3-full">
                    <h3>Add to Cart</h3>
                </div> -->

                <!-- Wrapper 3 Div (Moved inside Wrapper 2) -->
                <div class="wrapper3">
                    <!-- Small Box for Add to Cart -->
                    <div class="product-box small">
                        <div class="chart-container">
                            <!-- <h4>Revenue Distribution</h4> -->
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="filter-container">
                            <label for="Date">Enter Date:</label>
                            <input type="date" id="Date">
                            <button onclick="applyDateFilter()">Apply</button>
                        </div>
                    </div>
                    
                    <!-- Large Box for Add to Cart -->
                    <div class="product-box large">
                    <div class="chart-container">
                            <!-- <h4>Revenue Distribution</h4> -->
                            <canvas id="myChart2"></canvas>
                        </div>
                        <div class="filter-container">
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate">
                            <label for="endDate">End Date:</label>
                            <input type="date" id="endDate">
                            <button onclick="applyDateFilter()">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wrapper 2 second -->
            <div class="wrapper2">
                <!-- Header 3 as Full Width -->
                <!-- <div class="header3-full">
                    <h3>Add to Cart</h3>
                </div> -->

                <!-- Wrapper 3 Div (Moved inside Wrapper 2) -->
                <div class="wrapper3">
                    <!-- Small Box for Add to Cart -->
                    <!-- <div class="product-box small">
                        <p>Small Box - Add to Cart</p>
                    </div> -->
                    
                    <!-- Large Box for Add to Cart -->
                    <div class="product-box large " id="box2">
                        <div class="chart-container">
                            <h3>Appointment Summary</h3>
                            <canvas id="myChart3"></canvas>
                        </div>
                        <div class="filter-container">
                            <label for="Date">Enter Date:</label>
                            <input type="date" id="Date">
                            <button onclick="applyDateFilter()">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Boxes Below Wrapper2 -->
            <div class="additional-boxes">
                <!-- Header for Additional Charts -->
                <!-- <div class="header4">
                    <h3>Additional Charts</h3>
                </div> -->
                <!-- Wrapper for Additional Charts -->
                <div class="wrapper4">
                    <!-- Small Box for Additional Chart -->
                    <div class="product-box small">
                        <p></p>
                    </div>
                    
                    <!-- Large Box for Additional Chart -->
                    <div class="product-box large">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    <button onclick="downloadAsPDF()">Download as PDF</button>
    </div>




    <!-- JavaScript to handle PDF download -->
    <script>
        function downloadAsPDF() {
            const element = document.querySelector('.wrapper1');

            // Use html2pdf library to generate PDF
            html2pdf()
                .from(element)
                .save();
        }
    </script>
    <!-- data pass to the chart -->
    <script>
        let app_data = <?php echo json_encode($data['app_data']); ?>;
        console.log(app_data);
    </script>


    
    <script src="<?php echo APPROOT.'/public/js/admin/appointment_report.js';?>"></script>
</body>
</html>