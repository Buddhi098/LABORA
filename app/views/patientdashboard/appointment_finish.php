<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/appointment_finish.css'?>">
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
        <div class="container_1">
            <div class="content">
                <h1>Thank You!</h1>
                <p>Your appointment has been scheduled successfully.</p>
                <div class="appointment-details">
                    <h2>Appointment Details</h2>
                    <p>Date: <span id="appointmentDate"><?php echo $data['appointment_date']?></span></p>
                    <p>Time: <span id="appointmentTime"><?php echo $data['appointment_time']?></span></p>
                </div>
                <button onclick="goHome()">Back to Home</button>
            </div>
        </div>
</body>
</html>

<script>
    function goHome(){
        window.location.href = "<?php echo URLROOT.'patientdashboard/appointment'?>";
    }
</script>