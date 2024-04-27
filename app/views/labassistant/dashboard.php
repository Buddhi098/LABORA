<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/labassistant/dashboard.css' ?>">
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>labassistant dashboard</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">

        <div class="grid-container">
            <div class="grid-item box box-1">
                <div class="icon"><i class="fa-solid fa-clock"></i></div>
                <div class="text">
                    <h2><?php echo $data['review_report_count']?></h2>
                    <p>Pending Reports</p>
                </div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="grid-item box box-2">
                <div class="icon"><i class="fa-solid fa-file"></i></div>
                <div class="text">
                    <h2><?php echo $data['pending_appointment_count']?></h2>
                    <p>Pending Appointment</p>
                </div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="grid-item box box-3">
                <div class="icon"><i class="fa-solid fa-suitcase-medical"></i></div>
                <div class="text">
                    <h2><?php echo $data['patient_count']?></h2>
                    <p>Patients</p>
                </div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="grid-item box box-4">
                <div class="icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                <div class="text">
                    <h2><?php echo $data['item_request']?></h2>
                    <p>Item Request</p>
                </div>
                <div class="dot"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="grid-item big-item big-box">
                <div class="graph-text">
                    <div class="graph_icon"><i class="fa-solid fa-layer-group"></i></div>
                    <h4>Reports for Creating</h4>
                </div>
                <p>You can easily view all Reports for Reviewing right here</p>

                <div class="data-box">
                    <?php
                    if ($data['pending_medical_reports']) {
                        foreach ($data['pending_medical_reports'] as $report) {
                            echo '<div class="data">
                                    <div class="item"><div class="icon"><i class="fa-solid fa-file-invoice"></i></div></div>
                                    <div class="item name">' . $report['ref_no'] . '</div>
                                    <div class="item test_data">
                                        <h3>' . $report['test_type'] . '</h3>
                                        <p>Health Check Category</p>
                                    </div>
                                    <div class="item test_data">
                                        <h3>' . $report['date'] . '</h3>
                                        <p>Date</p>
                                    </div>
                                </div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="grid-item big-item calendar">
                <div class="graph-text">
                    <div class="graph_icon"><i class="fa-regular fa-calendar-days"></i></div>
                    <h4>Calendar</h4>
                </div>
                <p>You can indicate days off or holidays on this calendar.</p>
                <div class="calendar_1">
                    <div class="header">
                        <div class="month"></div>
                        <div class="btns">
                            <div class="c-btn today-btn">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="c-btn prev-btn">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="c-btn next-btn">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="weekdays">
                        <div class="day">Sun</div>
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                    </div>
                    <div class="days">
                        <!-- lets add days using js -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function getTime(date) {

        }
    </script>

    <script>

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
                } else {
                    days += `<div id="${i}" class="day ">${i}</div>`;
                }
            }

            for (let j = 1; j <= nextDays; j++) {
                days += `<div class="day next">${j}</div>`;
            }

            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/labassistant/getHolidaysCalendar/${currentYear}/${currentMonth + 1}`;
            console.log(link);
            fetch(link, {
                method: "GET"
            }).then(res => {
                if (!res.ok) {
                    throw new Error("Error fetching data");
                }
                return res.json();
            }).then(data => {
                console.log(data);
                for (let i = 0; i < data.length; i++) {
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
    </script>
</body>

</html>
