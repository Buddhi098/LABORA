// let ctx1 = document.getElementById('myChart').getContext('2d');
// let chart1 = new Chart(ctx1, {
//     type: 'bar',
//     data: {
//         labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4'],
//         datasets: [{
//             label: 'Dataset 1',
//             data: data1,
//             backgroundColor: 'blue'
//         }]
//     }
// });


// console.log('-----------------', data1)

//   // Chart 2
//   let ctx2 = document.getElementById('myChart2').getContext('2d');
//   let chart2 = new Chart(ctx2, {
//       type: 'line',
//       data: {
//           labels: ['Label A', 'Label B', 'Label C', 'Label D'],
//           datasets: [{
//               label: 'Dataset 2',
//               data: [100, 80, 120, 90],
//               borderColor: 'red',
//               fill: false
//           }]
//       }
//   });

console.log(graph_data);

let labels_data = [];
for(let i = 0; i < graph_data.length; i++){
    labels_data.push(graph_data[i].Appointment_Date);
}

let data_ = []
for(let i=0 ; i<graph_data.length ; i++){
    data_.push(graph_data[i].Appointment_Count);
}

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels_data ,
    datasets: [{
      label: 'Appointments',
      data: data_ ,
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(50, 205, 50, 0.2)'
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
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Appointments'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Day of the Week'
        }
      }
    },
  }
});