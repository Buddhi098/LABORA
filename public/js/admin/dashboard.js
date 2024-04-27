// chart1
let labels_data = [];
for(let i = 0; i < graph_data.length; i++){
    labels_data.push(graph_data[i].patient_gender);
}

let data_ = []
for(let i=0 ; i<graph_data.length ; i++){
    data_.push(graph_data[i].gender_count);
}
const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'polarArea',
    data: {
      labels: labels_data,
      datasets: [{
        label: 'Patients',
        data: data_,
        borderWidth: 1
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

  // chart2
  let labels_data2 = [];
  for(let i = 0; i < graph_data2.length; i++){
      labels_data2.push(graph_data2[i].payment_method);
  }

  let data_2 = []
  for(let i=0 ; i<graph_data2.length ; i++){
      data_2.push(graph_data2[i].payment_status);
  }
  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: labels_data2,
      datasets: [{
        label: 'Appointments',
        data: data_2,
        borderWidth: 1
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


  // chart3
  let labels_data3 = [];
  for(let i = 0; i < graph_data3.length; i++){
      labels_data3.push(graph_data3[i].payment_status);
  }

  let data_3 = []
  for(let i=0 ; i<graph_data3.length ; i++){
      data_3.push(graph_data3[i].total_revenue);
  }
  const ctx3 = document.getElementById('myChart3');
  new Chart(ctx3, {
    type: 'pie',
    data: {
      labels: labels_data3,
      datasets: [{
        label: 'Rs',
        data: data_3,
        borderWidth: 1
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



//second row charts
// chart4
// Function to map numeric month values to month names
function mapMonthToName(monthNumber) {
  const months = [
      'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December'
  ];

  // Ensure monthNumber is a valid index (1 to 12)
  if (monthNumber >= 1 && monthNumber <= 12) {
      return months[monthNumber - 1]; // Subtract 1 to get the correct array index
  }

  return ''; // Return empty string for invalid monthNumber
}
// Example usage:
let labels_data4 = [];
for (let i = 0; i < graph_data4.length; i++) {
  const monthNumber = graph_data4[i].Month;
  const monthName = mapMonthToName(monthNumber);
  labels_data4.push(monthName);
}


let data_4 = []
for(let i=0 ; i<graph_data4.length ; i++){
  data_4.push(graph_data4[i].TotalCost);
}

const ctx4 = document.getElementById('myChart4').getContext('2d');
const myChart4 = new Chart(ctx4, {
  type: 'line',
  data: {
      labels: labels_data4,
      datasets: [{
          label: 'Revenue',
          data: data_4,
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



// start calendar script

const daysContainer = document.querySelector(".days"),
  nextBtn = document.querySelector(".next-btn"),
  prevBtn = document.querySelector(".prev-btn"),
  month = document.querySelector(".month"),
  todayBtn = document.querySelector(".today-btn");

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

const date = new Date();

let currentMonth = date.getMonth();

let currentYear = date.getFullYear();

function renderCalendar() {

  date.setDate(1);
  const firstDay = new Date(currentYear, currentMonth, 1);
  const lastDay = new Date(currentYear, currentMonth + 1, 0);
  const lastDayIndex = lastDay.getDay();
  const lastDayDate = lastDay.getDate();
  const prevLastDay = new Date(currentYear, currentMonth, 0);
  const prevLastDayDate = prevLastDay.getDate();
  const nextDays = 7 - lastDayIndex - 1;

  month.innerHTML = `${months[currentMonth]} ${currentYear}`;

  let days = "";

  for (let x = firstDay.getDay(); x > 0; x--) {
    days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDayDate; i++) {
    if (
      i === new Date().getDate() &&
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div id="${i}" class="day today">${i}</div>`;
    }else {
      days += `<div id="${i}" class="day ">${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next">${j}</div>`;
  }

  const baseLink = window.location.origin;
  const link = `${baseLink}/labora/admin/getHolidays/${currentYear}/${currentMonth + 1}`;
  console.log(link);
  fetch(link , {
    method: "GET"
  }).then(res => {
    if(!res.ok){
      throw new Error("Error fetching data");
    }
    return res.json();
  }).then(data => {
    console.log(data);
    for(let i=0 ; i<data.length ; i++){
      const day = document.getElementById(data[i]['Dates']);
      day.classList.add("holiday");
    }

  }).catch(err => {
    console.log(err);
  
  })

  hideTodayBtn();
  daysContainer.innerHTML = days;
}

renderCalendar();

nextBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar();
});

prevBtn.addEventListener("click", () => {

  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar();
});

todayBtn.addEventListener("click", () => {
  currentMonth = date.getMonth();
  currentYear = date.getFullYear();
  renderCalendar();
});


function hideTodayBtn() {
  if (
    currentMonth === new Date().getMonth() &&
    currentYear === new Date().getFullYear()
  ) {
    todayBtn.style.display = "none";
  } else {
    todayBtn.style.display = "flex";
  }
}