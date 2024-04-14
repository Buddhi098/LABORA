<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/valid_qrcode.css'?>">
  <title>Appointment Verified</title>
</head>
<body>
  <div class="success-container">
    <div class="success-message">
      <i class="fas fa-check-circle success-icon"></i>
      <h2>Appointment Confirmed</h2>
      <div class="appointment-details">
        <div class="detail-row">
          <span class="detail-label">Ref. No.:</span>
          <span class="detail-value"><?php echo $data['appointment']['Ref_No']?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Appointment Date:</span>
          <span class="detail-value"><?php echo $data['appointment']['Ref_No']?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Appointment Time:</span>
          <span class="detail-value"><?php echo $data['appointment']['Appointment_Time']?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Medical Test:</span>
          <span class="detail-value"><?php echo $data['appointment']['Appointment_Date']?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Patient Email:</span>
          <span class="detail-value"><?php echo $data['appointment']['patient_email']?></span>
        </div>
      </div>
    </div>
  </div>
</body>
</html>