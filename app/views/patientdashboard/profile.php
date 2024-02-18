<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/profile.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Patient dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="boxset-1">
            <div class="text-1"><h2>Edit profile</h2></div>
            <div class="img-1"><img src="/labora/public/img/patientdashboard/user1.jpg" alt=""></div>
        </div>
        <div class="boxset-2">
            <form action="" method="post">
                <div class="input">
                    <label for="fullname">Fullname:</label><br>
                    <input type="text" id="fullname" name="fullname" placeholder="<?php echo $data['fullname']?>" required>
                </div>

                <div class="input">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" placeholder="<?php echo $data['email']?>" disabled>
                </div>

                <div class="input">
                    <div class="input-3-1">
                        <label for="phone">Phone:</label><br>
                        <input type="tel" id="phone" name="phone" placeholder="<?php echo $data['phone']?>" required>
                    </div>
                    <div class="input-3-1">
                        <label for="dob">Date of Birth:</label><br>
                        <input type="date" id="dob" name="dob" placeholder="<?php echo $data['dob']?>" required>
                    </div>
                </div>
                <div class="input">
                    <label for="address">Address:</label><br>
                    <textarea id="address" name="address" placeholder="<?php echo $data['address']?>" cols="5" required></textarea>
                </div>
                <div class="input">
                    <a href="http://localhost/labora/PatientDashboard/dashboard">Cancel</a>
                    <button type="submit" name="submit">Save</button>
                </div>
                
            </form>
            
        </div>
    </div>
</body>
</html>