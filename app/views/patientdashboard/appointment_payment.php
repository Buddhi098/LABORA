<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/appointment_payment.css'?>">
    <title>Document</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <section class="component">
            <div class="credit-card">
            <h2>Payment Details</h2>
            <form id="myForm">
                <div class="line">
                    <input class="litle" name="name" type="text" placeholder="NAME" required/>
                    <input class="tall" name="phone" type="tel" placeholder="PHONE" required/>
                    <div class="error-message" id="email-error"></div>
                </div>
                <input type="email" name="email" placeholder="EMAIL" required/>
                <input type="text" name="address" placeholder="ADDRESS" required/>
                <div class="bill">
                    <div class="test price"><?php echo $data['test_name']?> <span><?php echo $data['test_price']?></span></div>
                    <div class="total price">Sub Total <span><?php echo $data['test_price']?></span></div>
                </div>
                <button id=""type="submit" class="valid-button">PROCEED TO CHECKOUT</button>
            </form>
            </div>
        </section>
    </div>


    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon
            src="https://cdn.lordicon.com/guqkthkk.json"
            trigger="in"
            delay="15"
            state="in-reveal">
            </lord-icon>
        </div>
        <p> Success! Appointment Scheduled.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon
            src="https://cdn.lordicon.com/akqsdstj.json"
            trigger="in"
            delay="15"
            state="in-reveal">
            </lord-icon>
        </div>
        <p id="error_msg">Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>


</body>
</html>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<script>
        document.getElementById('myForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });
        
        const jsonString = JSON.stringify(jsonData);
        
        fetch('http://localhost/labora/PatientDashboard/payment', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body:jsonString
        })
        .then(response => {
            if(!response.ok){
                console.log('Response ERROR')
            }

            return response.json()
        })
        .then(data => {
            console.log('Success:', data);
            // Payment completed. It can be a successful failure.
            payhere.onCompleted =async function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);
                // showSuccessMessage();
                const baseLink = window.location.origin;
                const apiUrl = `${baseLink}/labora/PatientDashboard/doPayment`;
                fetch(apiUrl)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if(data.success_msg == 'payment_success'){
                            window.location.href = `${baseLink}/labora/PatientDashboard/appointment`;
                        }else{
                            showErrorMessage();
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });

                // redirectToHome()
                
                // Note: validate the payment and show success or failure page to the customer
            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
                // Note: Prompt user to pay again or show an error page
                console.log("Payment dismissed");
                showErrorMessage()
                // Redirect to a specific URL

            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                console.log("Error:"  + error);
                showErrorMessage()
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id":data['merchant_id'],    // Replace your Merchant ID
                "return_url": 'http://localhost/labora/PatientDashboard/appointment',     // Important
                "cancel_url": 'http://localhost/labora/PatientDashboard/appointment',     // Important
                "notify_url": "http://sample.com/notify",
                "order_id": data['order_id'],
                "items": "Door bell wireles",
                "amount": data['payhere_amount'],
                "currency": data['payhere_currency'],
                "hash": data['hash'], // *Replace with generated hash retrieved from backend
                "first_name": data['first_name'],
                "last_name": data['last_name'],
                "email": data['email'],
                "phone": data['phone'],
                "address": data['address'],
                "city": data['city'],
                "country": data['country'],
                "delivery_address": "No. 46, Galle road, Kalutara South",
                "delivery_city": "Kalutara",
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            // Show the payhere.js popup, when "PayHere Pay" is clicked
            payhere.startPayment(payment);
        })
        .catch(error => {
            console.error('Error:', error);
        });
        });

    </script>