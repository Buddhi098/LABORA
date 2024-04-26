<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Refund Invoice Notification</title>
  <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/refund_info.css'?>">
</head>
<body>
  <div class="container">
    <div class="message-box">
      <button class="close-button" onclick="hideMessage()"><i class="fas fa-times"></i></button>
      <div class="message-title"><i class="fas fa-info-circle info-icon"></i>Refund Invoice Access</div>
      <div class="message-text">You can access the refund invoice after the patient confirms the refund email.</div>
    </div>
  </div>

  <script>
    function hideMessage() {
      document.querySelector('.message-box').style.display = 'none';
    }
  </script>
</body>
</html>