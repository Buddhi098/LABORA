<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form Messages</title>
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/receptionist/message.css' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container8">
            <h1>Contact Form Messages</h1>
            <div class="message-list">

            </div>
            <div class="message-details">
                <h2>Message Details</h2>
                <div class="message-header">
                    <div class="user-info">
                        <i class="fas fa-user-circle"></i>
                        <span class="user-name"></span>
                        <span class="user-email"></span>
                        <input type="hidden" id='hidden_id2' value=''>
                    </div>
                </div>
                <div class="message-content">
                    
                </div>
                <textarea placeholder="Type your reply here..." class="reply-input"></textarea>
                <button class="send-btn" onclick="openModal('1')">
                    <i class="fas fa-paper-plane"></i> Send Reply
                </button>
            </div>
        </div>
    </div>

    <!-- delete waring message -->
    <div id="deleteModal" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to Send Message?</p>
            <div class="btn-container">
                <button id="yesBtn">Yes</button>
                <button id="noBtn">No</button>
                <input type="hidden" value="" id="hidden_id">
            </div>
        </div>
    </div>

    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id='success_msg'> Success! Message Send.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/akqsdstj.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="error_msg">Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <!-- loading modal -->
    <div id="loading-modal" class="loading_modal">
        <div class="loading_modal-content">
            <div class="loader">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
            <p>Sending Email...</p>
        </div>
    </div>

    
    <!-- waring modal -->
    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>

</body>

</html>

<script>

    const messages = JSON.parse(`<?php echo json_encode($data['messages']); ?>`);

    const messageList = document.querySelector(".message-list");
    const messageContent = document.querySelector(".message-content");
    const userNameElement = document.querySelector(".user-name");
    const userEmailElement = document.querySelector(".user-email");
    const replyInput = document.querySelector(".reply-input");
    const sendBtn = document.querySelector(".send-btn");


    function displayMessages() {
        messageList.innerHTML = "";
        messages.forEach((message) => {
            const messageItem = document.createElement("div");
            messageItem.classList.add("message-item");
            messageItem.textContent = `${message.name} (${message.email})`;
            messageItem.addEventListener("click", () =>
                displayMessageDetails(message)
            );
            messageList.appendChild(messageItem);
        });
    }


    function displayMessageDetails(message) {
        messageContent.innerHTML = `<p>${message.message}</p>`;
        userNameElement.textContent = message.name;
        userEmailElement.textContent = message.email;
        document.getElementById('hidden_id2').value = message.id;
        showReplyInput();
    }


    function showReplyInput() {
        replyInput.style.display = "block";
        sendBtn.style.display = "block";
    }

    function sendReply() {
        const reply = replyInput.value.trim();
        const id = document.getElementById('hidden_id2').value;
        const name =userNameElement.textContent;
        const email = userEmailElement.textContent;
        if (reply) {
            closeModal();
            showLoadingModal();
            console.log(`Reply sent: ${reply}`);
            console.log(`Message ID: ${id}`);
            replyInput.value = "";
            replyInput.style.display = "none";
            sendBtn.style.display = "none";

            let formData = new FormData();
            formData.append('id', id);
            formData.append('reply', reply);
            formData.append('name', name);
            formData.append('email', email);

            fetch('/labora/receptionist/sendReply', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessMessage();
                    } else {
                        showErrorMessage();
                    }
                    hideLoadingModal();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }


    document.getElementById('yesBtn').addEventListener("click", sendReply);

    displayMessages();
</script>