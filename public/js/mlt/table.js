// Filter by date
function filterTableByDate() {
    var filterDate = document.getElementById('filterDate').value;
    var table = document.getElementById('myTable');
    var rows = table.querySelectorAll('tbody tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var appointmentDate = cells[3].innerText.trim(); // Assuming the date is in the 4th column

        // Compare the appointment date from the table with the selected date
        if (appointmentDate === filterDate) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

// document.getElementById('filterButton').addEventListener('click', filterTableByDate);
