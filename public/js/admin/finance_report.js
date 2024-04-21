let labels_data = [];
for(let i = 0; i < graph_data.length; i++){
    labels_data.push(graph_data[i].Test_Type);
}

let data_ = []
for(let i=0 ; i<graph_data.length ; i++){
    data_.push(graph_data[i].TotalPaidAmount);
}


let ctx = document.getElementById('myChart').getContext('2d');
// Set global chart options
Chart.defaults.font.family = 'Lato';
Chart.defaults.font.size = 18;
Chart.defaults.color = 'black';

let pieChart = new Chart(ctx, {
    type: 'pie',// bar, horizontalBar, pie, Line, doughnut, radar, polarArea
    data: {
        labels: labels_data,
        datasets: [{
            label: 'Population',
            data: data_,
            backgroundColor: ['#d41e11', '#5fd411','yellow','black'],
            borderWidth: 1,
            borderColor: 'yellow',
            hoverBorderWidth: 2,
            hoverBorderColor: 'black'
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Chart Title',
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
        
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        tooltips: {
            enabled: true,
        }
    }
});

//chart 2
let labels_data2 = [];
for(let i = 0; i < graph_data2.length; i++){
    labels_data2.push(graph_data2[i].Date);
}

let data_2 = []
for(let i=0 ; i<graph_data2.length ; i++){
    data_2.push(graph_data2[i].TotalRevenue);
}
let ctx2 = document.getElementById('myChart2').getContext('2d');

let barChart = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: labels_data2 ,
    datasets: [{
      label: 'Revenue',
      data: data_2 ,
      backgroundColor: [
        '#d41e11', // Red
        '#A1B4E2', // Blue
        '#294994', // Navy
        '#23CD50', // Green
        '#FFA500', // Orange
        '#8A2BE2', // Blue Violet
        '#FFD700'  // Gold
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(50, 205, 50, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    plugins: {
      title: {
          display: true,
          text: 'Chart Title',
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
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Revenue'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Days'
        }
      }
    },
  }
  
});


// chart3
let labels_data3 = [];
for(let i = 0; i < graph_data3.length; i++){
    labels_data3.push(graph_data3[i].Month);
}

let data_3 = []
for(let i=0 ; i<graph_data3.length ; i++){
    data_3.push(graph_data3[i].TotalCost);
}

const ctx3 = document.getElementById('myChart3').getContext('2d');
const myChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: labels_data3,
        datasets: [{
            label: 'Value',
            data: data_3,
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
                    text: 'Revenue'
                }
            }
        }
    }
});



// Function to update myChart3 with filtered chart data
function filterChart() {
    const startMonth = document.getElementById('startMonth').value;
    const endMonth = document.getElementById('endMonth').value;

    const url = 'http://localhost/labora/Admin/fetchChartData';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ startMonth, endMonth })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Extract chartData from the nested array structure
        const chartData = data[0]; // Assuming chartData is wrapped in an extra array

        console.log('Received chart data:', chartData);

        // Update myChart3 with fetched chartData
        myChart3.data.labels = chartData.map(item => new Date(`${item.Year}-${item.Month}`).toLocaleString('default', { month: 'long' }));
        myChart3.data.datasets[0].data = chartData.map(item => item.TotalCost);
        myChart3.update(); // Update the chart
    })
    .catch(error => {
        console.error('Error fetching chart data:', error);
    });
}







// console.log(graph_data);

// let labels_data = [];
// for(let i = 0; i < graph_data.length; i++){
//     labels_data.push(graph_data[i].Appointment_Date);
// }

// let data_ = []
// for(let i=0 ; i<graph_data.length ; i++){
//     data_.push(graph_data[i].Appointment_Count);
// }

// const ctx = document.getElementById('myChart').getContext('2d');
// const myChart = new Chart(ctx, {
//   type: 'bar',
//   data: {
//     labels: labels_data ,
//     datasets: [{
//       label: 'Appointments',
//       data: data_ ,
//       backgroundColor: [
//         'rgba(54, 162, 235, 0.2)',
//         'rgba(255, 206, 86, 0.2)',
//         'rgba(75, 192, 192, 0.2)',
//         'rgba(153, 102, 255, 0.2)',
//         'rgba(255, 159, 64, 0.2)',
//         'rgba(255, 99, 132, 0.2)',
//         'rgba(50, 205, 50, 0.2)'
//       ],
//       borderColor: [
//         'rgba(54, 162, 235, 1)',
//         'rgba(255, 206, 86, 1)',
//         'rgba(75, 192, 192, 1)',
//         'rgba(153, 102, 255, 1)',
//         'rgba(255, 159, 64, 1)',
//         'rgba(255, 99, 132, 1)',
//         'rgba(50, 205, 50, 1)'
//       ],
//       borderWidth: 1
//     }]
//   },
//   options: {
//     scales: {
//       y: {
//         beginAtZero: true,
//         title: {
//           display: true,
//           text: 'Appointments'
//         }
//       },
//       x: {
//         title: {
//           display: true,
//           text: 'Day of the Week'
//         }
//       }
//     },
//   }
// });