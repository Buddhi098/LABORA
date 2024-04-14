


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
  const link = `${baseLink}/labora/receptionist/getHolidaysCalendar/${currentYear}/${currentMonth + 1}`;
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


// end clendar script



// set holidays

const holidayDate = document.getElementById('holiday-date');
const holidayReason = document.getElementById('holiday-reason');
const saveHolidayButton = document.getElementById('save-holiday');
const holidayList = document.querySelector('.holiday-list');

saveHolidayButton.addEventListener('click' , saveHoliday);

function saveHoliday() {
  if(holidayDate.value === ''){
    console.log('input fields are empty');
    return
  }
  const baseLink = window.location.origin;
  const link = `${baseLink}/labora/receptionist/setHoliday`
  const formData = new FormData();
  formData.append('date', holidayDate.value);
  formData.append('reason' , holidayReason.value);

  fetch(link , {
    method:'POST',
    body: formData
  }).then(res=>{
    if(!res.ok){
      throw new Error('Network Error Occur');
    }
    return res.json();
  }).then(data => {
      console.log(data);
  }).catch(error => {
    console.error(error);
  })

  getHolidays();

};

function getHolidays() {
  const baseLink = window.location.origin;
  const link = `${baseLink}/labora/receptionist/getHolidays`
  fetch(link , {
    method: "GET"
  }).then(res => {
    if(!res.ok){
      throw new Error("Error fetching data");
    }
    return res.json();
  }).then(data => {
    console.log(data);
    holidays = data['holidays'];
    renderHolidays(holidays);
  }).catch(err => {
    console.log(err);
  })
}

function renderHolidays(holidays) {
  holidayList.innerHTML = '';
  holidays.forEach(holiday => {
    const holidayElement = document.createElement('div');
    holidayElement.classList.add('holiday-item-saved');
    holidayElement.innerHTML = `<span class="holiday-date">${holiday['holiday']}</span>
    <span class="holiday-reason">${holiday['reason']}</span>
    <button class="btn" onclick="deleteHoliday('${holiday['id']}')">Delete</button>`;
    holidayList.appendChild(holidayElement);
  })
}

function deleteHoliday(id){
    console.log(id);

    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/receptionist/deleteHoliday/${id}`;

    fetch(link)
    .then(res=>{
      if(!res.ok){
        throw new Error('Network Error Occur')
      }

      return res.json();
    }).then(data => {
      console.log(data);
    }).catch(error => {
      console.error(error);
    })

    getHolidays();
}