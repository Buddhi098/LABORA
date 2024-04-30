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
    <div class="contact" id="contact">
        <div class="background">
            <h2>Create New Account</h2>
            <h5>Already Registerd? <a href="http://localhost/labora/user/login">Login</a></h5>
            <p>Discover a healthier you with Sahanya Labs! Sign up now for exclusive access to our guides, podcasts, and videos. Take control of your well-being today</p>
            <img src="<?php echo APPROOT.'/public/';?>img/Signup.png" alt="image not found">
        </div> 

        <div class="contact-form">
                <form action="<?php echo URLROOT?>User/register" method="post" autocomplete="off">
                    <div>
                        <div class="double">
                            <label for="patient_name">Full Name*</label><br>
                            <input type="text" pattern="[A-Za-z. ]+" oninvalid="this.setCustomValidity('Please enter a valid name with English characters only.')" oninput="setCustomValidity('')" id="patient_name" name="patient_name" value="<?php echo $data['username'];?>" required><br>
                        </div>
                        <div class="double">
                            <label for="patient_email">Email*</label><br>
                            <input type="email" id="patient_email" name="patient_email" value="<?php echo $data['email'];?>" required><br>
                            <span class="formerr"><?php echo $data['emailerr'];?></span>
                        </div>
                    </div>

                    <div>
                        <div class="double">
                            <label for="password">Password*</label><br>
                            <input type="password" minlength="8" id="password" name="password" value="<?php echo $data['password'];?>" required><br>
                            <span class="formerr"><?php echo $data['passworderr'];?></span>
                        </div class="double">
                        <div class="double">
                            <label for="confirm_password">Confirm Password*</label><br>
                            <input type="password" id="confirm_password" name="confirm_password" value="<?php echo $data['confirmpassword'];?>" required><br>
                        </div>
                    </div>

                    <div>
                        <div class="double">
                            <label for="patient_phone">Phone</label><br>
                            <input type="text" pattern="[0-9]+" maxlength="10" oninvalid="this.setCustomValidity('Accept only numbers')" oninput="setCustomValidity('')" id="patient_phone" name="patient_phone" value="<?php echo $data['phone'];?>" required><br>
                        </div>
                        <div class="double">
                            <label for="patient_dob">Date of Birth</label><br>
                            <?php
                                $maxDate = new DateTime();
                                $maxDateFormatted = $maxDate->format('Y-m-d');
                            ?>
                            <input type="date" id="patient_dob" name="patient_dob" max="<?php echo $maxDateFormatted?>" value="<?php echo $data['dob'];?>" required> <br>
                        </div>
                    </div>
                    
                    <label class="gender1">Gender</label>
                      <input class="gender" type="radio" id="gender" name="gender" value="Male" required>
                      <label class="gender" for="gender">Male</label>
                      <input type="radio" id="gender" name="gender" value="Female" required>
                      <label class="gender" for="gender">Female</label>
                      <input type="radio" id="gender" name="gender" value="Other" required>
                      <label class="gender" for="javascript">Other</label><br>

                    <label for="patient_address">Address</label><br>
                    <input type="text" id="patient_address" pattern="[A-Za-z0-9,. -&@:/]+" oninvalid="this.setCustomValidity('Enter valid address')" oninput="setCustomValidity('')" name="patient_address" value="<?php echo $data['address'];?>" required></input><br>
                    
                    <input type="submit" value="Submit" class="submit button">
                </form>
        </div>   
    </div>
</body>
</html>
