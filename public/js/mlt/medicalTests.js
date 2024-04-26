// function toggleAvailability(testId) {
//   var availabilitySpan = document.getElementById('availability_' + testId);
//   var availabilityButton = availabilitySpan.querySelector('button');
//   var currentAvailability = availabilityButton.textContent.trim();
//   var newAvailability = (currentAvailability === 'Available') ? 'Not Available' : 'Available';
//   availabilityButton.textContent = newAvailability;
//   availabilityButton.classList.remove('available', 'not-available');
//   availabilityButton.classList.add(newAvailability.toLowerCase().replace(' ', '-'));
//   // Here you can perform an AJAX request to update the availability in your database
//   console.log('Test ID:', testId, 'New Availability:', newAvailability);
//   // You can replace the console.log with an AJAX request to your server
// }

// above code work properly without updating DB


function toggleAvailability(testId) {

  var availabilitySpan = document.getElementById('availability_' + testId);
  var availabilityButton = availabilitySpan.querySelector('button');
  var currentAvailability = availabilityButton.textContent.trim();
  var newAvailability = (currentAvailability === 'Available') ? 'Not Available' : 'Available';

  // Update button text and class
  availabilityButton.textContent = newAvailability;
  availabilityButton.classList.remove('available', 'not-available');
  availabilityButton.classList.add(newAvailability.toLowerCase().replace(/\s+/g, '-'));

  // AJAX request to update database
  var url = 'http://localhost/LABORA/MLT/updateAvailability';
  var data = {
      testId: testId,
      newAvailability: newAvailability
  };

  fetch(url, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Failed to update availability');
      }
      console.log('Availability updated successfully');
      // You can handle success response if needed
  })
  .catch(error => {
      console.error('Error updating availability:', error);
  });
}

