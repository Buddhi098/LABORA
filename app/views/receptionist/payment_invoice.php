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
      <img src="logo.png" alt="LABORA">
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
          <td>$50.00</td>
        </tr>
        <tr class="total">
          <td>Total</td>
          <td>$55.00</td>
        </tr>
      </table>
      <p>Thank you for your payment. We look forward to seeing you at your appointment.</p>
      <div class="customer-details">
        <h3>Customer Details</h3>
        <table>
          <tr>
            <th>Name</th>
            <td>John Doe</td>
          </tr>
          <tr>
            <th>Email</th>
            <td>johndoe@example.com</td>
          </tr>
          <tr>
            <th>Phone</th>
            <td>123-456-7890</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="print-btn">
      <button onclick="window.print()">Print</button>
    </div>
  </div>
</div>
</body>
</html>