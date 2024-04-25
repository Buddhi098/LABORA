<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/appointment_pass.css'?>">
    <title>Appointment Pass - LABORA</title>
</head>
<body>
            <div class="pass-container">
                <div class="pass-header">
                    <div class="logo">
                        <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="LABORA Logo">
                        <h2>LABORA</h2>
                    </div>
                    <h3>Appointment Pass</h3>
                </div>
                <div class="pass-info">
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <p id="patient-name"><?php echo $data['appointment_data']['Ref_No']?></p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <p id="appointment-date"><?php echo $data['appointment_data']['Appointment_Date']?></p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <p id="appointment-time"><?php echo $data['appointment_data']['Appointment_Time']?></p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-flask"></i>
                        <p id="test-name"><?php echo $data['appointment_data']['Test_Type']?></p>
                    </div>
                </div>
                <div class="qr-code" id="qr-code">
                    
                </div>
                <div class="pass-description">
                    This appointment pass is your ticket to your scheduled medical test at LABORA. Please present this pass upon arrival to ensure a smooth check-in process.
                </div>
                <div class="print-btn">
                    <button onclick="window.print()">
                        <i class="fas fa-print"></i>
                        Print Pass
                    </button>
                </div>
            </div>
    
    



    <script src="<?php echo APPROOT . '/public/js/qrcode.min.js'; ?>"></script>

    <script src="https://kit.fontawesome.com/your-font-awesome-key.js" crossorigin="anonymous"></script>

    <script type="text/javascript">

        window.onload = function() {
            getQRcode();
        };

        function getQRcode() {
            const baseLink = window.location.origin;
            const passKey = "<?php echo $data['pass_key']; ?>"; // Print PHP variable into JavaScript
            const link = `${baseLink}/labora/CheckQRCode/checkPassValidity/${passKey}`; // Construct the link
            console.log(link);
            var qrCodeDiv = document.getElementById("qr-code");
            var data = new QRCode(qrCodeDiv, {
                text: link,
                width: 128,
                height: 128
            });
        }

    </script>
</body>
</html>