function toggleAvailability(testId) {
    var availabilitySpan = document.getElementById('availability_' + testId);
    var availabilityButton = availabilitySpan.querySelector('button');
    var currentAvailability = availabilityButton.textContent;
    var newAvailability = (currentAvailability === 'yes') ? 'no' : 'yes';
    availabilityButton.textContent = newAvailability;
    availabilityButton.classList.remove('yes', 'no');
    availabilityButton.classList.add(newAvailability.toLowerCase());
    // Here you can perform an AJAX request to update the availability in your database
    console.log('Test ID:', testId, 'New Availability:', newAvailability);
    // You can replace the console.log with an AJAX request to your server
  }