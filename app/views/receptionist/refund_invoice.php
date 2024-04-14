<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Refunding Invoice</title>
  <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/refund_invoice.css'?>">
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Refunding Invoice</h1>
    </div>
    <div class="laboratory-info">
      <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="Laboratory Logo">
      <h2>LABORA</h2>
    </div>
    <div class="invoice-details">
      <p>Ref No #: <span><?php echo $data['appointment']['Ref_No'];?></span></p>
      <p>Date: <span><?php echo date("Y-m-d"); ?></span></p>
    </div>
    <div class="patient-details">
      <p>Patient Name: <span><?php echo $data['user']['patient_name'];?></span></p>
      <p>Patient Email: <span><?php echo $data['user']['patient_email'];?></span></p>
      <p>Patient Phone: <span><?php echo $data['user']['patient_phone'];?></span></p>
      <p>Test Category: <span><?php echo $data['appointment']['Test_Type'];?></span></p>
    </div>
    <div class="refund-amount">
      <h2>Refund Amount:</h2>
      <p class="amount">   Rs.<?php echo $data['appointment']['cost'];?>.00</p>
    </div>
    <button class="refund-button" onclick="window.print()">Print</button>
  </div>

  <script>

  </script>
</body>
</html>