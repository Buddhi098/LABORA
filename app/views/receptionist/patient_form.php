<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/patient_form.css'?>">
    <title>Patient Registration</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>

    <div class="container_1">
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
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
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
    
</body>
</html>
