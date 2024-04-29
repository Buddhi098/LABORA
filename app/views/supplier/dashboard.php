<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/supplier/dashboard.css' ?>">
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Supplier dashboard</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <div class="container_1">
        <div class="dashboard-container">
            <div class="top-cards">
                <div class="card">
                    <div class="card-icon">
                        <!-- <i class="fas fa-clipboard-list"></i> -->
                        <i class="ri-user-2-line card--icon--lg"></i>
                    </div>
                    <div class="card-content">
                        <p><?php echo $data['pending_orders']; ?></p>
                        <h3>Pending Orders</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="ri-user-line card--icon--lg"></i>
                    </div>
                    <div class="card-content">
                        <p><?php echo $data['cancelled_orders']; ?></p>
                        <h3>Cancelled Orders</h3>

                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <!-- <i class="fas fa-trash"></i> -->
                        <ion-icon name="calendar-number-outline"></ion-icon>
                    </div>
                    <div class="card-content">
                        <p><?php echo $data['Send_inovice']; ?></p>
                        <h3>Send Invoice</h3>

                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                    <div class="card-content">
                        <p><?php echo $data['supplier_count']; ?></p>
                        <h3>Suppliers</h3>

                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-section">
                <div class="chart-container">
                    <h3><i class="fa-solid fa-money-bill"></i> Monthly Revenue</h3>
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
            </div>
        </div>

        <script src="<?php echo APPROOT . '/public/js/supplier/dashboard.js'; ?>"></script>
        <script>
            function getTime(date) {

            }
        </script>

</body>

</html>

<script>
    //second row charts
    // chart4

    let chartData = <?php echo json_encode($data['chart_data']); ?>;
    console.log(chartData);
    // const chartData = [
    //     { date: '2023-01-01', value: 10000 },
    //     { date: '2023-02-01', value: 12000 },
    //     { date: '2023-03-01', value: 11000 },
    //     { date: '2023-04-01', value: 14000 },
    //     { date: '2023-05-01', value: 11000 },
    //     // { date: '2023-06-01', value: 130 },
    //     // { date: '2023-07-01', value: 150 },
    //     // { date: '2023-08-01', value: 160 },
    //     // { date: '2023-09-01', value: 174 },
    //     // { date: '2023-10-01', value: 180 },
    //     // { date: '2023-11-01', value: 190 },
    //     // { date: '2023-12-01', value: 200 }
    // ];

    // Create the line chart
    const ctx4 = document.getElementById('myChart4').getContext('2d');
    const myChart = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: chartData.map(data => data.month.toLocaleString('default', { month: 'long' })),
            datasets: [{
                label: 'Value',
                data: chartData.map(data => data.order_count),
                borderColor: '#5E2BB8',
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Value'
                    }
                }
            }
        }
    });
</script>