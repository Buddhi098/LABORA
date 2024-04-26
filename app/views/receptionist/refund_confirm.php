<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/refund_confirm.css'?>">
  <title>Refund Confirmation</title>
  
</head>
<body>
  <div class="container" id="main-container">
    <div class="message-title"><i class="fas fa-question-circle"></i> Do you have a refund from the laboratory?</div>
    <div class="message-text">Please confirm if you have received a refund from the laboratory.</div>
    <div class="button-container">
      <button class="button" onclick="confirmRefund(true)">Yes</button>
      <button class="button" onclick="confirmRefund(false)">No</button>
    </div>
  </div>
  <div class="container success-message" id="success-message">
    <i class="fas fa-check-circle"></i> Thank you for confirming the refund.
  </div>
  <div class="container error-message" id="error-message">
    <i class="fas fa-exclamation-circle"></i> Sorry, we couldn't confirm the refund. Please contact customer support.
  </div>

  <script>
    function confirmRefund(confirmed) {
      const mainContainer = document.getElementById('main-container');
      const successMessage = document.getElementById('success-message');
      const errorMessage = document.getElementById('error-message');

      if (confirmed) {
        mainContainer.style.display = 'none';
        successMessage.style.display = 'block';
        errorMessage.style.display = 'none';
        const baselink = window.location.origin;
        const key = <?php echo json_encode($data['key']) ?>;
        const confirm = 'yes';
        const link = `${baselink}/labora/RefundConfirm/confirmRefund/${key}/${confirm}`
        window.location.href = link;
      } else {
        mainContainer.style.display = 'none';
        successMessage.style.display = 'none';
        errorMessage.style.display = 'block';
      }
    }
  </script>
</body>
</html>