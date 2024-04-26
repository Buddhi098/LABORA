<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Receipt</title>
  <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/payment_invoice.css'?>">
</head>
<body>

<div class="container_1">
<div class="container">
    <div class="header">
      <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="LABORA">
      <h1>LABORA</h1>
    </div>
    <div class="receipt">
      <h2>Payment Receipt</h2>
      <table>
        <tr>
          <th>Medical Test Catergory</th>
          <th>Price</th>
        </tr>
        <tr>
          <td>Appointment Fee</td>
          <td><?php echo $data['appointment']['cost']?>.00</td>
        </tr>
        <tr class="total">
          <td>Total</td>
          <td><?php echo $data['appointment']['cost']?>.00</td>
        </tr>
      </table>
      <p>Thank you for your payment. We look forward to seeing you at your appointment.</p>
      <div class="customer-details">
        <h3>Customer Details</h3>
        <table>
          <tr>
            <th>Name</th>
            <td><?php echo $data['user']['patient_name']?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo $data['user']['patient_email']?></td>
          </tr>
          <tr>
            <th>Phone</th>
            <td><?php echo $data['user']['patient_phone']?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="print-btn">
      <button class="btn btn-2" onclick="window.print()">Print</button>
    </div>
  </div>

  <div class="pass-btn">
        <button class="btn btn-1" onclick="getPass('<?php echo $data['appointment']['Id']?>')">Get Pass</button>
  </div>
</div>


<script>
  function getPass(id){
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/receptionist/getAppointmentPass/${id}`;
            window.open(link , '_blank');
        }
</script>
</body>
</html>