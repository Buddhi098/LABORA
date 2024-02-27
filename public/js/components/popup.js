function showSuccessMessage() {
    var message = document.getElementById('successMessage');
    message.classList.add('show-message');

    // Hide message after 3 seconds
    setTimeout(function() {
      hideSuccessMessage();
    }, 3000);
  }

  function showErrorMessage() {
    var message = document.getElementById('ErrorMessage');
    message.classList.add('show-message');

    // Hide message after 3 seconds
    setTimeout(function() {
      hideErrorMessage();
    }, 3000);
  }

  function hideSuccessMessage() {
    var message = document.getElementById('successMessage');
    message.classList.remove('show-message');
  }

  function hideErrorMessage() {
    var message = document.getElementById('ErrorMessage');
    message.classList.remove('show-message');
  }