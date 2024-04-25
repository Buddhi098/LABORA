// chart1
const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'polarArea',
    data: {
      labels: ['Male', 'Female', 'Other'],
      datasets: [{
        label: 'Patients',
        data: [12, 19, 3],
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
  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Online', 'Onsite'],
      datasets: [{
        label: '',
        data: [12, 19],
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
  const ctx3 = document.getElementById('myChart3');
  new Chart(ctx3, {
    type: 'pie',
    data: {
      labels: ['Paid', 'Unpaid', 'Refunded'],
      datasets: [{
        label: 'Count',
        data: [14, 9, 3],
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
const chartData = [
  { date: '2023-01-01', value: 10000 },
  { date: '2023-02-01', value: 12000 },
  { date: '2023-03-01', value: 11000 },
  { date: '2023-04-01', value: 14000 },
  { date: '2023-05-01', value: 11000 },
  // { date: '2023-06-01', value: 130 },
  // { date: '2023-07-01', value: 150 },
  // { date: '2023-08-01', value: 160 },
  // { date: '2023-09-01', value: 174 },
  // { date: '2023-10-01', value: 180 },
  // { date: '2023-11-01', value: 190 },
  // { date: '2023-12-01', value: 200 }
];

// Create the line chart
const ctx4 = document.getElementById('myChart4').getContext('2d');
const myChart = new Chart(ctx4, {
  type: 'line',
  data: {
      labels: chartData.map(data => new Date(data.date).toLocaleString('default', { month: 'long' })),
      datasets: [{
          label: 'Value',
          data: chartData.map(data => data.value),
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