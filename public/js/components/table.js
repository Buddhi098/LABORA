
let currentPage = 1;

function showPage(page) {
    console.log('asda')
    const rows = document.querySelectorAll('tbody tr');
    const rowsPerPage = 5; 

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    if(end>=rows.length){
    end_str = rows.length
    }else{
    end_str = end
    }
    let str = `Showing ${start+1} to ${end_str} of ${rows.length} entries`
    document.getElementById("table_data").innerHTML = str

    rows.forEach((row, index) => {
    if (index >= start && index < end) {
        row.style.display = 'table-row';
    } else {
        row.style.display = 'none';
    }
    });
}

function nextPage() {
    const totalRows = document.querySelectorAll('tbody tr').length;
    const rowsPerPage = 5;
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    if (currentPage < totalPages) {
    currentPage++;
    showPage(currentPage);
    }
}

function previousPage() {
    if (currentPage > 1) {
    currentPage--;
    showPage(currentPage);
    }
}


showPage(currentPage);


function searchTable() {

    var input = document.getElementById('searchInput');
    var filter = input.value.toUpperCase();
    // console.log(filter)
    if(filter==''){
    showPage(currentPage);
        document.getElementById('prev').disabled = false;
        document.getElementById('prev').style.cursor = 'pointer'
        document.getElementById('prev').style.opacity = '1'
        document.getElementById('next').disabled = false;
        document.getElementById('next').style.cursor = 'pointer'
        document.getElementById('next').style.opacity = '1'
    return
    }else{
        document.getElementById('prev').disabled = true;
        document.getElementById('prev').style.cursor = 'not-allowed'
        document.getElementById('prev').style.opacity = '0.8'
        document.getElementById('next').disabled = true;
        document.getElementById('next').style.cursor = 'not-allowed'
        document.getElementById('next').style.opacity = '0.8'
    }

    var table = document.getElementById('myTable');
    var rows = table.querySelectorAll('tbody tr');

    for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName('td');
    var found = false;

    for (var j = 0; j < cells.length; j++) {
        var cellText = cells[j].innerText || cells[j].textContent;
        if (cellText.toUpperCase().indexOf(filter) > -1) {
        found = true;
        break;
        }
    }

    if (found) {
        rows[i].style.display = '';
    } else {
        rows[i].style.display = 'none';
    }
    }
}

document.getElementById('searchInput').addEventListener('input', searchTable);