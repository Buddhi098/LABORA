<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/supplier/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Supplier dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
        <div class="boxset_1">

            <!-- Existing boxes in code 1 -->
            <div class="box box_1">
            <div class="text">
                    <h5>Number of Orders</h5>
                    <h1>30</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>Total number of orders received form the inventory manager in previous month.</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-bars"></i>
                </div>
            </div>

            <div class="box box_2">
            <div class="text">
                    <h5>Number of Pending Orders</h5>
                    <h1>10</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>These orders are still pending check the availability on items and chemicals.</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-hourglass-start"></i>
                </div>
            </div>

            <div class="box box_3">
            <div class="text">
                    <h5>Number of Rejected Orders</h5>
                    <h1>5</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>Rejecting the orders because of unavailability of items or chemicals or lack of producers.</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="box box_4">
            <div class="text">
                    <h5>Number of sent out Invoices</h5>
                    <h1>15</h1>
                    <p><i class="fa-solid fa-arrow-right" style="color: #ff0000;"></i>Invoices are sent after confirmation of items or chemicals</p>
                </div>
                <div class="icon">
                <i class="fa-solid fa-file-import"></i>
                </div>
            </div>
        </div>

        <div class="chart">
            <div class="chartContainer" id="chart1">
        <canvas id="firstChart"></canvas>
    </div>

    
    <div class="chartContainer" id="chart2">
        <canvas id="secondChart"></canvas>
    </div>
       
 </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>let graph_data = <?php echo json_encode($data['graph_data'])?>;</script>


<script>
    // First chart
    console.log(graph_data);
    
    //for loop to fetch data
    let labels_data = [];
    for(let i = 0; i < graph_data.length; i++){
        labels_data.push(graph_data[i].item_name);
    }

    let data_ = []
    for(let i=0 ; i<graph_data.length ; i++){
        data_.push(graph_data[i].quantity);
    }
    const ctx = document.getElementById('firstChart').getContext('2d');
    new Chart(ctx, {
        
        type: 'bar',
        data: {
            labels: labels_data,
            datasets: [{
                label: 'Number of items send out',
                data: data_,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options:{
         plugins: {
             title: {
               display: false,
               text: 'Number of items',
               font: {
                   size: 35
               }
             },
        legend:{
            display:true,
        }
    }
}
    });

//     options: {
//         plugins: {
//             title: {
//                 display: false,
//                 text: 'Revenue By Test Type',
//                 font: {
//                     size: 35
//                 }
//             },
//             legend:{
//                 display:true,
//                 // position:'right',
//                 labels:{
//                     fontColor:'black'
//                 }
//             },
//         },
        
//         layout: {
//             padding: {
//                 left: 0,
//                 right: 0,
//                 top: 0,
//                 bottom: 10,
//             }
//         },
//         tooltips: {
//             enabled: true,
//         }
//     }
// });


    //Second chart
    const secondCtx = document.getElementById('secondChart').getContext('2d');
    new Chart(secondCtx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Number of invoices sent out',
                data: [20, 40, 35, 45, 30, 25, 20],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
</script>

</html>

