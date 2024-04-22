<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blood Medical Report</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
</head>


<div style="text-align: right;">
  <button style="
    margin-top: 10px;
    width: 150px;
    padding: 13px;
    font-size: 14px;
    border: none;
    color: white;
    background: #008300;
    border-radius: 10px;
    box-shadow: 1px 1px 5px #0000003b;
    margin-bottom: 10px;
    transition: background-color 0.3s, box-shadow 0.3s;
    display: inline-block; /* Ensure button takes up only as much width as needed */
  " onmouseover="this.style.background='#006400'; this.style.boxShadow='2px 2px 10px #0000005b';"
    onmouseout="this.style.background='#008300'; this.style.boxShadow='1px 1px 5px #0000003b';" id='save-btn'>

    <i class="fa-solid fa-floppy-disk"></i> Save

  </button>
</div>

<body style="
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
      width: 65%;
      margin: 10px auto;
    " id='body'>
  <div id="container_00">
    <header style="background-color: #333; color: #fff; padding: 20px">
      <div class="header-content" style="
          display: flex;
          justify-content: space-between;
          align-items: center;
          max-width: 1200px;
          margin: 0 auto;
        ">
        <div class="header-left" style="display: flex; align-items: center" >
          <img src="<?php echo APPROOT . '/public/'; ?>img/Health_Care__2_-removebg-preview.png" alt="Laboratory Logo"
            class="logo" style="max-width: 60px; margin-right: 10px" />
          <h1 style="margin: 0">LABORA</h1>
        </div>
        <div class="header-right" style="margin-left: auto" >
          <p style="margin: 5px 0"><i class="fas fa-envelope"></i>LABORA</p>
          <p style="margin: 5px 0">
            <i class="fas fa-map-marker-alt"></i> 123 Main Street, City, State
          </p>
          <p style="margin: 5px 0">
            <i class="fas fa-phone"></i> +94-777-123-456
          </p>
        </div>
      </div>
    </header>

    <section class="patient-details" style="
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px;
      ">
      <h2 style="color: #333; margin-top: 0 ; margin-right: 10px;">
        <i class="fas fa-user-circle"></i> Patient Details
      </h2>
      <div class="patient-info" style="
          display: flex;
          align-items: center;
          justify-content: space-between;
        ">
        <div class="patient-data" style="display: flex ; font-size: 14px;" >
          <div class="patient-row" style="display: flex; margin-bottom: 10px">
            <div class="patient-col" style="margin: 10px">
              <p style="margin: 5px 0"><strong>Name:</strong></p>
              <p style="margin: 5px 0"><strong>Age:</strong></p>
              <p style="margin: 5px 0"><strong>Gender:</strong></p>
            </div>
            <?php
            $birthday = $data['patient']['patient_dob'];

            $birthdate = new DateTime($birthday);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthdate)->y;

            ?>
            <div class="patient-col" style="margin: 10px" >
              <p style="margin: 5px 0"><?php echo $data['patient']['patient_name'] ?></p>
              <p style="margin: 5px 0"><?php echo $age ?></p>
              <p style="margin: 5px 0"><?php echo $data['patient']['patient_gender'] ?></p>
            </div>
          </div>
          <div class="patient-row" style="display: flex; margin-bottom: 10px">
            <div class="patient-col" style="margin: 10px">
              <p style="margin: 5px 0"><strong>Email:</strong></p>
              <p style="margin: 5px 0"><strong>Patient ID:</strong></p>
            </div>
            <div class="patient-col" style="margin: 10px">
              <p style="margin: 5px 0"><?php echo $data['patient']['patient_email'] ?></p>
              <p style="margin: 5px 0">PT-<?php echo $data['patient']['patient_id'] ?></p>
            </div>
          </div>
        </div>
        <div class="patient-photo-container" style="
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
            margin-left: 93px;
          ">
          <div id="qr-code" class="patient-photo" style="width: 100%; height: 100%; object-fit: cover"></div>
        </div>
      </div>
    </section>

    <section class="test-details" style="
        margin: 0 auto;
        background-color: #fff;
        border-top: 1px solid rgb(163, 163, 163);
        padding: 20px;
        min-height: 80vh;
      ">
      <h2 style="color: #333; margin-top: 0">
        <i class="fas fa-flask"></i> Medical Test Details
      </h2>
      <div class="data"
        style="display: grid; grid-template-columns: auto auto auto auto;padding-bottom: 10px; border-bottom: 1px solid rgb(175, 175, 175);">
        <p style="margin: 5px 0"><strong>Investigation</strong></p>
        <p style="margin: 5px 0">
          <strong>Result</strong>
        </p>
        <p style="margin: 5px 0"><strong>Refference Value</strong></p>
        <p style="margin: 5px 0"><strong>Unit</strong></p>
      </div>

      <div class="data"
        style="display: grid; grid-template-columns: auto auto auto auto;margin-top: 16px;font-size: 15px;">
        <?php
        for ($i = 0; $i < count($data['test_data']['label']); $i++) {
          echo '<p style="margin: 10px 0">' . $data['test_data']['label'][$i] . '</p>
            <p style="margin: 10px 0">' . $data['test_data']['value'][$i] . '</p>
            <p style="margin: 10px 0">' . $data['test_data']['refval'][$i] . '</p>
            <p style="margin: 10px 0">' . $data['test_data']['unit'][$i] . '</p>';
        }
        ?>

      </div>
    </section>

    <footer style="
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
      ">
      <div class="footer-content" style="
          display: flex;
          justify-content: space-around;
          align-items: center;
          max-width: 1200px;
          margin: 0 auto;
          height: 80px;
        ">
        <div class="manager-signature" style="margin-right: auto">
          <img src="" id='sign' alt="Manager Signature" style="max-width: 50px;" />
          <p style="margin: 0">Signature of Laboratory Manager</p>
        </div>
        <p style="margin: 0;font-size: 14px;color:#8e8e8e">&copy; 2024 HealthLab. All rights reserved.</p>
      </div>
    </footer>
  </div>




  <script src="script.js"></script>
</body>


<script src="<?php echo APPROOT . '/public/js/qrcode.min.js'; ?>"></script>
<script src="https://kit.fontawesome.com/your-font-awesome-key.js" crossorigin="anonymous"></script>

<script type="text/javascript">

  window.onload = function () {
    getQRcode();
    fetchImage();
  };

  function getQRcode() {

    baseLink = window.location.origin;
    const link = `${baseLink}/labora/login`
    var qrCodeDiv = document.getElementById("qr-code");
    var data = new QRCode(qrCodeDiv, {
      text: link,
      width: 128,
      height: 128
    });
  }

</script>


<script>
  // Function to fetch image data from the server
  function fetchImage() {
    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/labassistant/getSign`
    fetch(link)
      .then(response => response.json())
      .then(data => {

        const imgElement = document.getElementById('sign');

        imgElement.src = 'data:image/jpeg;base64,' + data.file;
      })
      .catch(error => console.error('Error fetching image:', error));
  }

</script>


<script>
  document.getElementById('save-btn').addEventListener('click', function () {

    const baseLink = window.location.origin;
    const link = `${baseLink}/labora/labassistant/saveReport`;
    console.log(link);

    fetch(link, {
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // Handle the response data here
        if(data.status == 'success'){
          window.location.href = `${baseLink}/labora/labassistant/report`;
        }
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
  });

</script>

</html>