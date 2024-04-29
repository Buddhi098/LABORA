<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/patientdashboard/appointment_form.css' ?>">
</head>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container_2">
            <h1 class="title">Appointment Form</h1>
            <h4 class="sub_title">To schedule an appointment, please fill out the information below.</h4>
            <div class="item_2">
                <form action="" id="test_form">
                    <div class="section_1">
                        <div class="name">
                            <label for="test-type">Medical Test</label>
                            <select id="test-type" name="test-type" required>
                                <?php
                                foreach ($data['test_types'] as $test) {
                                    echo '<option value="' . $test['id'] . '">' . $test['Test_type'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="email">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="" value="<?php echo $_SESSION['useremail'];?>" disabled>
                        </div>
                    </div>
                    <div class="section_2">
                        <div class="note">
                            <label for="appointment-notes">Appointment Notes</label>
                            <textarea id="appointment-notes" name="appointment-notes" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="section_3">
                        <div class="note">
                            <label for="prescription">Upload prescription </label><br>
                            <input type="file" id="prescription" name="prescription"></input>
                        </div>
                        <div id="img_error" style="color:red;font-size:12px; margin-bottom:12px;"></div>
                    </div>
                    <button type="submit" class="submit_button">Next</button>
                </form>
            </div>
            <p class="date">Please select an appointment date & time</p>
            <div class="item_1 submitted" id="item1">
                <div class="calenderr">
                    <div class="container">
                        <div class="calendar">
                            <div class="header">
                                <div class="month"></div>
                                <div class="btns">
                                    <div class="btn today-btn">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="btn prev-btn">
                                        <i class="fas fa-chevron-left"></i>
                                    </div>
                                    <div class="btn next-btn">
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
                <div class="time_slots" id="time_slots" style="text-align:center;">
                    <h3 style="color:rgba(255 , 255 , 255 , 0.8);margin-top:50px;">Please Select date first</h3>
                </div>
            </div>
            <a class="submit_button submitted" id="nextBtn" style="text-decoration:none;"
                onclick="openModal()">Submit</a>
        </div>

    </div>

    <!-- loading modal -->
    <div id="loading-modal" class="loading_modal">
        <div class="loading_modal-content">
            <div class="loader">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
            <p>Sending Email...</p>
        </div>
    </div>



    <!-- Modal -->

    <div id="customModal" class="paymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color: #422CA7; margin: 0;">Select Payment Method</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="payment-options">
                <button id="onsitePaymentBtn" onclick="onsitePayment()">Onsite Payment</button>
                <button id="onlinePaymentBtn" onclick="onlinePayment()">Online Payment</button>
            </div>
        </div>
    </div>

    <!-- loading modal -->
    <div id="loading-modal" class="loading_modal">
        <div class="loading_modal-content">
            <div class="loader">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
            <p>Sending Email...</p>
        </div>
    </div>


    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p> Success! Appointment Scheduled.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/akqsdstj.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="error_msg">Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <script src="<?php echo APPROOT . '/public/js/patientdashboard/appointment_form.js'; ?>"></script>

    <script>
        function getTime(date) {

        }
    </script>

</body>

</html>