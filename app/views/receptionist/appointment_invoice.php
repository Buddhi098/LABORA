<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/appointment_invoice.css'?>">
  <title>Appointment Invoice</title>
</head>
<body>
    <?php require_once 'components/patient_details_nevbar.php' ?>
  <div class="container_1">
    <div class="invoice-container">
        <header>
        <div class="company-info">
            <img src="<?php echo APPROOT.'/public/';?>img/Health_Care__2_-removebg-preview.png" alt="Labora Logo" class="logo">
            <h1>Labora</h1>
        </div>
        <div class="invoice-info">
            <h2>Appointment Invoice</h2>
            <p><i class="fas fa-file-invoice"></i> Invoice #: <span id="invoice-number"><?php echo $data['refNo']?></span></p>
            <p><i class="fas fa-calendar-alt"></i> Date: <span id="invoice-date"><?php echo date("Y-m-d");?></span></p>
        </div>
        </header>
        <section class="client-info">
        <h3> Client Information</h3>
        <p><i class="fas fa-user"></i> Name: <span id="client-name"><?php echo $data['name']?></span></p>
        <p><i class="fas fa-envelope"></i> Email: <span id="client-email"><?php echo $data['email']?></span></p>
        <p><i class="fas fa-phone"></i> Phone: <span id="client-phone"><?php echo $data['phone']?></span></p>
        </section>
        <section class="service-info">
        <h3><i class="fas fa-briefcase"></i> Service Details</h3>
        <table>
            <thead>
            <tr>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Duration</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span id="name"><?php echo $data['test_type']?></span></td>
                <td><span id="date"><?php echo $data['appointment_date']?></span></td>
                <td><span id="time"><?php echo $data['appointment_time']?></span></td>
                <td><span id="duration"><?php echo $data['appointment_duration']?></span></td>
                <td><span id="price"><?php echo $data['price']?></span></td>
            </tr>
            </tbody>
        </table>
        </section>
        <section class="total-info">
        <h3><i class="fas fa-dollar-sign"></i> Total</h3>
        <p>Total: <span id="total-amount"><?php echo $data['price']?></span></p>
        </section>
    </div>
    <button id="print-btn" class="print-btn" style="margin:0 auto;">Print</button>
  </div>
</body>
</html>

<!-- for print acount details -->
<script>
        document.getElementById('print-btn').addEventListener('click', () => {
            window.print();
        });
</script>