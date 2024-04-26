// Filter by date

function filterTableByDate() {
    var filterDate = new Date(document.getElementById('filterDate').value);
    var table = document.getElementById('myTable');
    var rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        // Date is in the 5th column
        var dateCellText = row.cells[4].innerText || row.cells[4].textContent; 
        var tableDate = new Date(dateCellText);
        
        if (isSameDate(filterDate, tableDate)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function isSameDate(date1, date2) {
    return date1.getFullYear() === date2.getFullYear() &&
           date1.getMonth() === date2.getMonth() &&
           date1.getDate() === date2.getDate();
}

// document.getElementById('filterButton').addEventListener('click', filterTableByDate);
