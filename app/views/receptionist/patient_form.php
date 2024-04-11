<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/patient_form.css'?>">

    <!-- account info CSS -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/account_info.css'?>">
    
    <title>Patient Registration</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1" id="container_1">
        <div class="container">
            <h2><i class="fa-regular fa-user"></i>  Patient Registration</h2>
            <p class="subtitle">Please fill out the form below to register as a patient</p>
            <form id="registrationForm">
                <div class="form-row">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" placeholder="Enter Your Name" pattern="[A-Za-z. ]+" oninvalid="this.setCustomValidity('Please enter a valid name with English characters only.')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group">
                    <label for="email" style="margin-bottom:-7.1px;">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required style="display: inline-block; width: 86%; margin-right: 10px;">
                    <button type="button" style="display: inline-block; width:10%" id="get_email"><i class="fa-solid fa-plus"></i></button>
                </div>
                </div>
                <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter Your Tel" pattern="[0-9]+" maxlength="10" oninvalid="this.setCustomValidity('Accept only numbers')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <?php
                        $maxDate = new DateTime();
                        $maxDateFormatted = $maxDate->format('Y-m-d');
                    ?>
                    <input type="date" id="dob" name="dob" max="<?php echo $maxDateFormatted?>" required>
                </div>
                </div>
                <div class="form-row">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" pattern="[A-Za-z0-9,. -&@:/]+" oninvalid="this.setCustomValidity('Enter valid address')" oninput="setCustomValidity('')" rows="4"required></textarea>
                </div>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>



    <!-- accounst information form -->

    <div class="container_2" id="container_2">
            <div class="container">
                <header>
                    <h1>LABORA</h1>
                    <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="LABORA Logo" class="logo">
                </header>
                <main>
                    <h2>User Account Details</h2>
                    <div class="account-details">
                        <p><strong>Full Name:</strong> <span id="fullname_info"></span></p>
                        <p><strong>Email:</strong> <span id="email_info"></span></p>
                        <p><strong>Password:</strong> <span id="password_info"></span></p>
                        <p><strong>Address:</strong> <span id="address_info"></span></p>
                        <p><strong>Phone Number:</strong> <span id="phone_info"></span></p>
                    </div>
                    <button id="print-btn">Print</button>
                    <div class="message">
                        <p>Please keep this document safely. This is a private document.</p>
                    </div>
                </main>
                <footer>
                    <p>&copy; 2023 LABORA. All rights reserved.</p>
                </footer>
            </div>
    </div>


    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon
            src="https://cdn.lordicon.com/guqkthkk.json"
            trigger="in"
            delay="15"
            state="in-reveal">
            </lord-icon>
        </div>
        <p> Success! Appointment Scheduled.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon
            src="https://cdn.lordicon.com/akqsdstj.json"
            trigger="in"
            delay="15"
            state="in-reveal">
            </lord-icon>
        </div>
        <p>Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>
    
</body>
</html>

<script>
    const btn = document.getElementById('get_email');
    btn.addEventListener('click' , e => {
        e.preventDefault();
        getEmail();
    
    });

    function getEmail(){
        const Baselink = window.location.origin;
        const link = `${Baselink}/labora/receptionist/generateTempMail`

        fetch(link, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(res => {
            if(!res.ok){
                throw new Error('Network Response was Not Ok');
            }

            return res.json();
        }).then(data => {
            console.log(data);
            document.getElementById('email').value = data.email;
        }).catch(err => {
            console.error(err);
        });
    }

    const form = document.getElementById('registrationForm');

    form.addEventListener('submit' , e => {
        e.preventDefault();

        const formData = new FormData(form);
        console.log(formData);
        const Baselink = window.location.origin;
        const link = `${Baselink}/labora/receptionist/register_patient`

        fetch(link , {
            method:'POST',
            body: formData
        }).then(res => {
            if(!res.ok){
                throw new Error('Network Response was Not Ok');
            }
            return res.json();
        }).then(data => {
            console.log(data);
            if(data['temp']) {

                document.getElementById('fullname_info').innerText = data['data_set']['name'];
                document.getElementById('email_info').innerText = data['data_set']['email'];
                document.getElementById('password_info').innerText = data['data_set']['password'];
                document.getElementById('address_info').innerText = data['data_set']['address'];
                document.getElementById('phone_info').innerText = data['data_set']['phone'];

                document.getElementById('container_1').style.display = 'none';
                document.getElementById('container_2').style.display = 'block';
            }else if(data['success']){
                sendEmail(data['data_set']['email'] ,data['data_set']['name'] , data['data_set']['password'])
                showSuccessMessage();
            }else{
                showErrorMessage();
            }
        }).catch(err => {
            showErrorMessage();
            console.error(err);
        })

    })

    function sendEmail(email , fullname , password){
        const Baselink = window.location.origin;
        const link = `${Baselink}/labora/receptionist/sendEmail?`
        var formData = new FormData();
        formData.append('email' , email);
        formData.append('fullname' , fullname);
        formData.append('password' , password)

        fetch(link , {
            method:'POST',
            body: formData
        }).then(res => {
            if(!res.ok){
                throw new Error('Network Response was Not Ok');
            }
            return res.json();
        }).then(data => {
            console.log(data);
        }).catch(err => {
            console.error(err);
        })
    
    }
</script>

<!-- for print acount details -->
<script>
        document.getElementById('print-btn').addEventListener('click', () => {
            window.print();
        });
</script>