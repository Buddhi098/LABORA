//Chart 1
// let labels_data = [];
// for(let i = 0; i < graph_data.length; i++){
//     labels_data.push(graph_data[i].availability);
// }

// let data_ = []
// for(let i=0 ; i<graph_data.length ; i++){
//     data_.push(graph_data[i].NumberOfTests);
// }
let labels_data = [];
let data_ = [];

// Assuming graph_data is your original data array
for (let i = 0; i < graph_data.length; i++) {
    let availability = graph_data[i].availability;
    let numberOfTests = graph_data[i].NumberOfTests;

    // Map availability to labels_data and data_
    if (availability === '1') {
        labels_data.unshift('Available'); // Insert "Available" at the beginning
    } else if (availability === '0') {
        labels_data.push('Not Available');
    }

    data_.push(numberOfTests); // Always push numberOfTests
}

// Reverse data_ to match the labels order
data_ = data_.reverse();

const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: labels_data,
    datasets: [{
      label: 'Number of Tests',
      data: data_,
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
let labels_data2 = [];
for(let i = 0; i < graph_data2.length; i++){
    labels_data2.push(graph_data2[i].Test_type);
}

let data_2 = []
for(let i=0 ; i<graph_data2.length ; i++){
    data_2.push(graph_data2[i].TotalTests);
}

const ctx2 = document.getElementById('myChart2');
new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: labels_data2,
        datasets: [{
            label: 'Number of Tests',
            data: data_2,
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
let labels_data3 = [];
for(let i = 0; i < graph_data3.length; i++){
    labels_data3.push(graph_data3[i].Test_type);
}

let data_3 = [];
for(let i=0 ; i<graph_data3.length ; i++){
    data_3.push(graph_data3[i].TotalTests);
}
const ctx3 = document.getElementById('myChart3');
new Chart(ctx3, {
    type: 'pie',
    data: {
        labels: labels_data3,
        datasets: [{
            label: 'Number of Tests',
            data: data_3,
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
let labels_data4 = [];
for(let i = 0; i < graph_data4.length; i++){
    labels_data4.push(graph_data4[i].Test_type);
}

let data_4 = [];
for(let i=0 ; i<graph_data4.length ; i++){
    data_4.push(graph_data4[i].TotalTests);
}
const ctx4 = document.getElementById('myChart4');
new Chart(ctx4, {
    type: 'line',
    data: {
        labels: labels_data4,
        datasets: [{
            label: 'Number of Tests',
            data: data_4,
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