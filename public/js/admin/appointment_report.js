//chart 2
let labels_data1 = [];
for(let i = 0; i < appointment_status.length; i++){
    labels_data1.push(appointment_status[i].Status);
}

let data_1 = []
for(let i=0 ; i<appointment_status.length ; i++){
    data_1.push(appointment_status[i].Appointment_Count);
}

let ctx = document.getElementById('myChart').getContext('2d');
// Set global chart options
Chart.defaults.font.family = 'Lato';
Chart.defaults.font.size = 18;
Chart.defaults.color = 'black';

let pieChart = new Chart(ctx, {
    type: 'doughnut',// bar, horizontalBar, pie, Line, doughnut, radar, polarArea
    data: {
        labels: labels_data1,
        datasets: [{
            label: 'Appointments',
            data: data_1,
            backgroundColor: ['#C9473E', '#78C249', '#FFD700', '#45A2DC', '#DF71D6'],
            borderWidth: 1,
            borderColor: '#45A2DC',
            hoverBorderWidth: 1,
            hoverBorderColor: 'black'
        }]
    },
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Appointment Status',
                font: {
                    size: 25
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
                bottom: 10
            }
        },
        tooltips: {
            enabled: true,
        }
    }
});


//chart 2
let labels_data2 = [];
for(let i = 0; i < app_data.length; i++){
    labels_data2.push(app_data[i].Appointment_Date);
}

let data_2 = []
for(let i=0 ; i<app_data.length ; i++){
    data_2.push(app_data[i].Appointment_Count);
}
let ctx2 = document.getElementById('myChart2').getContext('2d');

let barChart = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: labels_data2 ,
    datasets: [{
      label: 'Appointments',
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
          text: '',
          font: {
              size: 25
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
          text: 'Number of Appointment'
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











// const appointmentData = [
//   { appointmentTime: '2023-01-01 08:00:00', value: 10 },
//   { appointmentTime: '2023-01-01 09:00:00', value: 20 },
//   { appointmentTime: '2023-01-01 10:30:00', value: 12 },
//   { appointmentTime: '2023-01-01 12:00:00', value: 9},
//   { appointmentTime: '2023-01-01 14:00:00', value: 14 },
//   { appointmentTime: '2023-01-01 15:30:00', value: 11 },
//   { appointmentTime: '2023-01-01 16:00:00', value: 13 },
//   { appointmentTime: '2023-01-01 17:30:00', value: 15 },
//   { appointmentTime: '2023-01-01 18:00:00', value: 6 },
//   { appointmentTime: '2023-01-01 19:30:00', value: 0 },
//   { appointmentTime: '2023-01-01 21:30:00', value: 0 },
//   { appointmentTime: '2023-01-01 22:00:00', value: 0 }
// ];


function mapTimeSlotLabel(label) {
  switch (label) {
      case '1':
          return '8-9am';
      case '2':
          return '9-10am';
      case '3':
          return '10-11am';
      case '4':
          return '11-12pm';
      case '5':
          return '12-1pm';
      case '6':
          return '1-2pm';
      case '7':
          return '2-3pm';
      case '8':
          return '3-4pm';
      case '9':
          return '4-5pm';
      case '10':
          return '5-6pm';
      default:
          return 'Other';
  }
}

// Prepare data for the chart
const labels_data3 = appointment_time.map(item => mapTimeSlotLabel(item.time_slot));
const data_3 = appointment_time.map(item => item.appointment_count);

// Create the line chart
const ctx3 = document.getElementById('myChart3').getContext('2d');
const myChart = new Chart(ctx3, {
  type: 'line',
  data: {
      labels: labels_data3,
      datasets: [{
          label: 'Number of Appointments',
          data: data_3,
          borderColor: '#5E2BB8',
          pointRadius: 5,
          fill: false
      }]
  },
  options: {
      responsive: true,
      scales: {
          x: {
              title: {
                  display: true,
                  text: 'Time'
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

function filterAppointmentsByTime(startTime, endTime) {
  const filteredData = appointmentData.filter(data => {
      const appointmentHour = new Date(data.appointmentTime).getHours();
      return appointmentHour >= startTime && appointmentHour <= endTime;
  });

  myChart3.data.labels = filteredData.map(data => new Date(data.appointmentTime).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }));
  myChart3.data.datasets[0].data = filteredData.map(data => data.value);
  myChart3.update();
}

// Example: Filter appointments between 12:00 PM and 6:00 PM
filterAppointmentsByTime(12, 18);



// Function to create PDF from HTML content
function getPDF(){

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
  
  pdf.save("Appointment Report.pdf");
});
};