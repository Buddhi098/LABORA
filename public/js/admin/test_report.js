//Chart 1
const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ['Available', 'Not Available'],
    datasets: [{
      label: '',
      data: [12, 19],
      borderWidth: 1
    }]
  },
  options: {
    layout: {
        padding: {
            left: 0, // Adjust the left margin
            right: 0, // Adjust the right margin
            top: 0, // Adjust the top margin
            bottom: 10 // Adjust the bottom margin
        }
    }
  }
});



//Chart 2
const ctx2 = document.getElementById('myChart2');
new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Test 1', 'Test 2', 'Test 3', 'Test 4', 'Test 5', 'Test 6', 'Test 7', 'Test 8', 'Test 9', 'Test 10'],
        datasets: [{
            label: 'Number of Tests',
            data: [25, 45, 32, 18, 12, 37, 29, 41, 22, 36],
            borderWidth: 1,
            backgroundColor: [
                '#FF6384', // Red
                '#36A2EB', // Blue
                '#FFCE56', // Yellow
                '#9966FF', // Purple
                '#4BC0C0', // Teal
                '#FF9F40', // Orange
                '#8E44AD', // Violet
                '#2ECC71', // Green
                '#E74C3C', // Crimson
                '#F1C40F'  // Yellow-Orange
            ]
        }]
    },
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Revenue By Test Type',
                font: {
                    size: 35
                }
            },
            legend:{
                display:false,
                // position:'right',
                labels:{
                    fontColor:'black'
                }
            },
        },
        tooltips: {
            enabled: true,
        },
        scales: {
            y: {
                beginAtZero: true
            }
        },
        layout: {
            padding: {
                left: 5, // Adjust the left margin
                right: 0, // Adjust the right margin
                top: 30, // Adjust the top margin
                bottom: 0 // Adjust the bottom margin
            }
        }
    }
});




//Chart 3
const ctx3 = document.getElementById('myChart3');
new Chart(ctx3, {
    type: 'pie',
    data: {
        labels: ['Test 1', 'Test 2', 'Test 3', 'Test 4', 'Test 5', 'Test 6', 'Test 7'],
        datasets: [{
            label: 'Number of Tests',
            data: [25, 45, 32, 18, 12, 37, 29],
            borderWidth: 1,
            backgroundColor: [
                '#FF6384', // Red
                '#36A2EB', // Blue
                '#FFCE56', // Yellow
                '#9966FF', // Purple
                '#4BC0C0', // Teal
                '#FF9F40', // Orange
                '#8E44AD', // Violet
                '#2ECC71', // Green
                '#E74C3C', // Crimson
                '#F1C40F'  // Yellow-Orange
            ]
        }]
    },
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Revenue By Test Type',
                font: {
                    size: 35
                }
            },
            legend:{
                display:true,
                // position:'right',
                labels:{
                    fontColor:'black'
                }
            },
        },
        tooltips: {
            enabled: true,
        }
    }
});


//Chart 4
const ctx4 = document.getElementById('myChart4');
new Chart(ctx4, {
    type: 'line',
    data: {
        labels: ['Test 1', 'Test 2', 'Test 3', 'Test 4', 'Test 5', 'Test 6', 'Test 7', 'Test 8', 'Test 9', 'Test 10'],
        datasets: [{
            label: 'Number of Tests',
            data: [25, 45, 32, 18, 12, 37, 29, 41, 22, 36],
            borderWidth: 2,
            borderColor: '#FF6384',
            pointRadius: 7,
            backgroundColor: [
                '#FF6384', // Red
                '#36A2EB', // Blue
                '#FFCE56', // Yellow
                '#9966FF', // Purple
                '#4BC0C0', // Teal
                '#FF9F40', // Orange
                '#8E44AD', // Violet
                '#2ECC71', // Green
                '#E74C3C', // Crimson
                '#F1C40F'  // Yellow-Orange
            ]
        }]
    },
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Revenue By Test Type',
                font: {
                    size: 35
                }
            },
            legend:{
                display:false,
                // position:'right',
                labels:{
                    fontColor:'black'
                }
            },
        },
        tooltips: {
            enabled: true,
        },
        scales: {
            y: {
                beginAtZero: true
            }
        },
        layout: {
            padding: {
                left: 5, // Adjust the left margin
                right: 0, // Adjust the right margin
                top: 30, // Adjust the top margin
                bottom: 0 // Adjust the bottom margin
            }
        }
    }
});



// Function to create PDF from HTML content
function getPDF(){
    console.log("getPDF");

    var HTML_Width = $(".content").width();
    var HTML_Height = $(".content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width+(top_left_margin*2);
    var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


html2canvas($(".content")[0],{allowTaint:true}).then(function(canvas) {
    canvas.getContext('2d');
    
    console.log(canvas.height+"  "+canvas.width);
    
    
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
    
    
    for (var i = 1; i <= totalPDFPages; i++) { 
        pdf.addPage(PDF_Width, PDF_Height);
        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
    }
    
    pdf.save("Test Report.pdf");
});
};






// const inventoryData = [
//     { date: '2023-04-15', received: 50, used: 20, stock: 100 },
//     { date: '2023-04-16', received: 30, used: 15, stock: 115 },
//     { date: '2023-04-17', received: 40, used: 25, stock: 130 },
//     { date: '2023-04-18', received: 0, used: 10, stock: 120 },
//     { date: '2023-04-19', received: 20, used: 30, stock: 110 },
//     { date: '2023-04-20', received: 60, used: 15, stock: 155 },
//     { date: '2023-04-21', received: 10, used: 5, stock: 160 },
// ];

// // Extract labels and data for the chart
// const labels = inventoryData.map(data => data.date);
// const receivedData = inventoryData.map(data => data.received);
// const usedData = inventoryData.map(data => data.used);
// const stockData = inventoryData.map(data => data.stock);

// // Create the multiple bar chart
// const ctx = document.getElementById('multipleBarChart').getContext('2d');
// const multipleBarChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: labels,
//         datasets: [
//             {
//                 label: 'Chemical Received',
//                 data: receivedData,
//                 backgroundColor: 'rgba(54, 162, 235, 0.5)', // Bar color
//                 borderColor: 'rgba(54, 162, 235, 1)', // Bar border color
//                 borderWidth: 1
//             },
//             {
//                 label: 'Chemical Used',
//                 data: usedData,
//                 backgroundColor: 'rgba(255, 99, 132, 0.5)', // Bar color
//                 borderColor: 'rgba(255, 99, 132, 1)', // Bar border color
//                 borderWidth: 1
//             },
//             {
//                 label: 'Chemical in Stock',
//                 data: stockData,
//                 backgroundColor: 'rgba(75, 192, 192, 0.5)', // Bar color
//                 borderColor: 'rgba(75, 192, 192, 1)', // Bar border color
//                 borderWidth: 1
//             }
//         ]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true,
//                 title: {
//                     display: true,
//                     text: 'Quantity'
//                 }
//             },
//             x: {
//                 title: {
//                     display: true,
//                     text: 'Date'
//                 }
//             }
//         },
//         plugins: {
//             title: {
//                 display: true,
//                 text: 'Chemical Inventory'
//             }
//         }
//     }
// });