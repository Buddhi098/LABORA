<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thank You</title>
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/thank_you.css'?>">
  </head>
  <body>
    <div class="container">
      <div class="content">
        <h1>Thank You</h1>
        <p>We appreciate you taking the time to contact us.</p>
        <p>
          We will review your message and get back to you as soon as possible.
        </p>
        <button id="homeBtn">Back to Home</button>
      </div>
    </div>

  </body>
</html>

<script>
  const homeBtn = document.getElementById("homeBtn");

  homeBtn.addEventListener("click", () => {
    const baseLocation = window.location.origin;
    const link = `${baseLocation}/labora`;
    window.location.href = link; 
  });
</script>
