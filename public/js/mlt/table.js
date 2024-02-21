// Filter by date
function filterTableByDate() {
    var filterDate = document.getElementById('filterDate').value;
    var table = document.getElementById('myTable');
    var rows = table.querySelectorAll('tbody tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        // Date is in the 4th column
        var appointmentDate = cells[3].innerText || cells[3].textContent; 

        // Compare the date 
        if (appointmentDate.trim() === filterDate.trim()) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

// Attach event listener
document.getElementById('filterButton').addEventListener('click', filterTableByDate);
