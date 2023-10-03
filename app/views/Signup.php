<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/signup.css'?>">
    <title>Patient Registration</title>
</head>
<body>
    <?php require_once 'components/home.php'?>
    <div class="registration-container">
        <h2>Patient Registration</h2>
        <form action="<?php echo URLROOT?>User/register" method="post" autocomplete="off">
            <div class="form-group">
                <label for="patient_name">Full Name</label>
                <input type="text" pattern="[A-Za-z. ]+" oninvalid="this.setCustomValidity('Please enter a valid name with English characters only.')" oninput="setCustomValidity('')" id="patient_name" name="patient_name" value="" required>
            </div>
            <div class="form-group">
                <label for="patient_email">Email</label>
                <input type="email" id="patient_email" name="patient_email" value="" required><br>
                <span class="formerr"><?php echo $data['emailerr'];?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" minlength="8" id="password" name="password" value="" required><br>
                <span class="formerr"><?php echo $data['passworderr'];?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" value="" required><br>
            </div>
            <div class="form-group">
                <label for="patient_phone">Phone</label>
                <input type="tel" pattern="[0-9]+" maxlength="14"oninvalid="this.setCustomValidity('Accept only numbers')" oninput="setCustomValidity('')" id="patient_phone" name="patient_phone" value="" required>
            </div>
            <div class="form-group">
                <label for="patient_dob">Date of Birth</label>
                <input type="date" id="patient_dob" name="patient_dob" value="" required>
            </div>
            <div class="form-group">
                <label for="patient_address">Address</label>
                <textarea id="patient_address" pattern="[A-Za-z0-9,. -&@:/]+" oninvalid="this.setCustomValidity('Enter valid address')" oninput="setCustomValidity('')" name="patient_address" rows="1" value="" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn-register button">Register</button>
        </form>
    </div>
</body>
</html>
