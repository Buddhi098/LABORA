<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/receptionist/account_info.css'?>">
    <title>Receptionist dashboard</title>
</head>

<body>
    <?php require_once 'components/patient_details_nevbar.php' ?>
        <div class="container_1">
            <div class="container">
                <header>
                    <h1>LABORA</h1>
                    <img src="labora-icon.png" alt="LABORA Logo" class="logo">
                </header>
                <main>
                    <h2>User Account Details</h2>
                    <div class="account-details">
                        <p><strong>Full Name:</strong> <span id="fullname"><?php echo $data['name']?></span></p>
                        <p><strong>Email:</strong> <span id="email"><?php echo $data['email']?></span></p>
                        <p><strong>Password:</strong> <span id="password"><?php echo $data['password']?></span></p>
                        <p><strong>Address:</strong> <span id="address"><?php echo $data['address']?></span></p>
                        <p><strong>Phone Number:</strong> <span id="phone"><?php echo $data['phone']?></span></p>
                    </div>
                    <button id="print-btn">Print</button>
                    <div class="message">
                        <p>Please keep this document safely. This is a private document.</p>
                    </div>
                </main>
                <footer>
                    <p>&copy; 2023 LABORA. All rights reserved.</p>
                </footer>
            </div>
        </div>
</body>