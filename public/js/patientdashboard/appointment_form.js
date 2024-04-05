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
    let date_var = `${currentYear}-${currentMonth+1}-${x}`
    console.log(date)
    days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDayDate; i++) {
    let date_var = `${currentYear}-${currentMonth+1}-${i}`
    if (
      i === new Date().getDate() &&
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day today" onclick="getTimes('${date_var}' ,this)">${i}</div>`;
    }else if(currentYear < new Date().getFullYear()){
      days += `<div class="day" style="opacity: 0.7;cursor: not-allowed;">${i}</div>`;
    }else if(currentYear === new Date().getFullYear() && currentMonth < new Date().getMonth()){
      days += `<div class="day" style="opacity: 0.7;cursor: not-allowed;">${i}</div>`;
    }else if(currentYear === new Date().getFullYear() && currentMonth === new Date().getMonth() && i < new Date().getDate()){
      days += `<div class="day" style="opacity: 0.7;cursor: not-allowed;">${i}</div>`;
    }else {
      days += `<div class="day" onclick="getTimes('${date_var}' , this)">${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    date_var = `${currentYear}-${currentMonth+1}-${j}`
    days += `<div class="day next">${j}</div>`;
  }

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



// for getting avalable time slots
function getTimes(date , day){
  const baseLink = window.location.origin
  var link = baseLink+'/labora/PatientDashboard/get_available_times/'+date
  console.log(link)

  fetch(link)
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    console.log(data);
    mockup = ''

    for(let i = 0 ; i < data['time_slots'].length ; i++){
      mockup += `<div><p onclick="setTime('${data['time_slots_value'][i]}' , this)">${data['time_slots'][i]}</p></div>`
    }
    console.log(mockup)
    document.getElementById('time_slots').innerHTML = mockup
  })
  .catch(error => {
    console.error('Fetch error:', error);
  });

  // day style set
  let day_list = document.querySelectorAll('.day');
  console.log(day_list)
  day_list.forEach(element => {
    element.classList.remove('clicked')
  });

  day.classList.add('clicked')

}



// for setting time

function setTime(time , slot){
    const baseLink = window.location.origin
    var link = baseLink+'/labora/PatientDashboard/set_available_times/'+time
    console.log(link)

    fetch(link)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      console.log(data);
    })
    .catch(error => {
      console.error('Fetch error:', error);
    });

  let time_list = document.querySelectorAll('.time_slots div p');
  console.log(time_list)
  time_list.forEach(element => {
    element.classList.remove('clicked')
  });

  slot.classList.add('clicked')

  let nextBtn = document.getElementById('nextBtn')
  nextBtn.classList.remove('submitted')

}



// for submitting form

const form = document.getElementById('test_form'); 

form.addEventListener('submit', function(event) {

  event.preventDefault(); 

  const formData = new FormData(form); 
  const jsonData = {};
  formData.forEach((value, key) => {
      jsonData[key] = sanitizeInput(value);
  });
        
  const jsonString = JSON.stringify(jsonData);
  console.log(jsonString)

  baseLink = window.location.origin

  fetch(baseLink+'/labora/PatientDashboard/appointment_form', {
    method: 'POST',
    headers:{
      'Content-Type' : 'application/json'
    },
    body: jsonString
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json(); 
  })
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error('Fetch error:', error);
  });

  const formElements = form.elements;
  for (let i = 0; i < formElements.length; i++) {
    formElements[i].disabled = true;
  }

  
  form.classList.add('submitted');

  let item1 = document.getElementById('item1')

  item1.classList.remove('submitted');
});



// for sanitize inputs
function sanitizeInput(input) {
  return input.replace(/<[^>]*>?/gm, '');
}




// select payment methods
function onlinePayment(){

  let baseLink = window.location.origin;
  let method = "online"
  let link = `${baseLink}/labora/PatientDashboard/storeAppointment/${method}`
  console.log(link);
  fetch(link)
    .then(response => {
      if(!response.ok){
        throw new Error('Network response was not ok')
      }
      return response.json()
    })
    .then(data =>{
      console.log(data);

      if(data['success_msg']){
        let Url = `${baseLink}/labora/PatientDashboard/getPaymentPage`
        window.location.replace(Url)
      }else if(data['error_msg']){
        showErrorMessage()
      }

      closeModal();


      document.getElementById('nextBtn').disabled = true;
      document.getElementById('nextBtn').style.opacity = '0.8';
      document.getElementById('nextBtn').style.cursor = 'not-allowed';
    })
    .catch(error => {
      console.error('There wa a problem with the fetch operation: ' , error)
    })


  
}

function onsitePayment(){
  let baseLink = window.location.origin;
  let method = "onsite"
  let link = `${baseLink}/labora/PatientDashboard/storeAppointment/${method}`
  console.log(link);
  fetch(link)
    .then(response => {
      if(!response.ok){
        throw new Error('Network response was not ok')
      }
      return response.json()
    })
    .then(data =>{
      console.log(data);

      if(data['success_msg']){
        let Url = `${baseLink}/labora/PatientDashboard/thankYouPage`
        window.location.replace(Url)
      }else if(data['error_msg']){
        showErrorMessage()
      }

      closeModal();


      document.getElementById('nextBtn').disabled = true;
      document.getElementById('nextBtn').style.opacity = '0.8';
      document.getElementById('nextBtn').style.cursor = 'not-allowed';
    })
    .catch(error => {
      console.error('There wa a problem with the fetch operation: ' , error)
    })


}
