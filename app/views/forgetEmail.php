<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password Recovery</title>
    <link rel="stylesheet" href="<?php echo APPROOT . '\public\css\forgetEmail.css'; ?>">
    </style>
</head>

<body>
    <main>
        <div class="container">
            <h1>Forgot Password</h1>
            <div id="emailForm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required />
                </div>
                <button type="button" class="btn" id="sendOTPBtn">Send OTP</button>
            </div>
            <div id="otpForm" style="display: none">
                <div class="form-group">
                    <label for="otp">OTP Code</label>
                    <input type="text" id="otp" name="otp" placeholder="Enter OTP code" required />
                </div>
                <button type="button" class="btn" id="verifyOTPBtn">
                    Verify OTP
                </button>
            </div>
            <div id="newPasswordForm" style="display: none">
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" minlength="8" id="newPassword" name="newPassword" placeholder="Enter new password"
                        required />
                </div>
                <button type="button" class="btn" id="changePasswordBtn">
                    Change Password
                </button>
            </div>
            <div class="message-container">
                <p id="message"></p>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>

</html>

<script>
    const emailForm = document.getElementById("emailForm");
    const otpForm = document.getElementById("otpForm");
    const newPasswordForm = document.getElementById("newPasswordForm");
    const messageContainer = document.getElementById("message");

    const sendOTPBtn = document.getElementById("sendOTPBtn");
    const verifyOTPBtn = document.getElementById("verifyOTPBtn");
    const changePasswordBtn = document.getElementById("changePasswordBtn");

    let email;

    sendOTPBtn.addEventListener("click", () => {
        email = document.getElementById("email").value;
        if (email) {

            emailForm.style.display = "none";
            otpForm.style.display = "block";

            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/user/generateForgetOTPCode/${email}`

            fetch(link)
                .then(res => {
                    if (!res.ok) {
                        throw new Error("Failed to send OTP code.");
                    }

                    return res.json();
                }).then(data => {
                    if (data.msg == 'success') {
                        messageContainer.textContent = "OTP code has been sent to your email.";
                    } else {
                        messageContainer.textContent = "Please enter a valid email address.";
                    }
                }).catch(err => {
                    console.error(err);
                });

        } else {
            messageContainer.textContent = "Please enter a valid email address.";
        }

    });

    verifyOTPBtn.addEventListener("click", () => {
        const otp = document.getElementById("otp").value;

        // Replace this with your actual logic for verifying the OTP
        if (otp) {

            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/user/checkOTPCode/${otp}`

            fetch(link)
                .then(res => {
                    if (!res.ok) {
                        throw new Error("Failed to send OTP code.");
                    }

                    return res.json();
                }).then(data => {
                    if (data.msg == 'success') {
                        otpForm.style.display = "none";
                        newPasswordForm.style.display = "block";
                        messageContainer.textContent = "OTP verified successfully.";
                    } else {
                        messageContainer.textContent = "Please enter a valid OTP code.";
                    }
                }).catch(err => {
                    console.error(err);
                });


        } else {
            messageContainer.textContent = "Please enter a valid OTP code.";
        }
    });




    changePasswordBtn.addEventListener("click", () => {
        const newPassword = document.getElementById("newPassword").value;

        // Replace this with your actual logic for changing the password
        if (newPassword) {
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/user/changePassword/${newPassword}`

            fetch(link)
                .then(res => {
                    if (!res.ok) {
                        throw new Error("Failed to send OTP code.");
                    }

                    return res.json();
                }).then(data => {
                    if (data.msg == 'success') {
                        messageContainer.textContent = "Password changed successfully.";
                    } else {
                        messageContainer.textContent = "Please enter Valid Password";
                    }
                }).catch(err => {
                    console.error(err);
                });
        } else {
            messageContainer.textContent = "Please enter a new password.";
        }
    });
</script>