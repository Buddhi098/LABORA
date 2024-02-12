<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/appointment.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Patient dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="table-container">
        <h2><i class="fa-solid fa-calendar-check"></i>Appointment</h2>
        <div class="add">
            <a href="http://localhost/labora/PatientDashboard/appointment_form" class="addbtn"><ion-icon name="add"></ion-icon> Schedule appointment</a>
         </div>
        <div class="search-container">
        <input type="text" class="search-box" id="searchInput" placeholder="Search...">
        <button class="search-button">Search</button>
        </div>

        <div class="filter-box">
            <div class="filter-section">
                <!-- Add your filter options here -->
                <select class="filter-box">
                <option value="all">All</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <!-- Add more filter options as needed -->
                </select>
                <button class="filter-button">Filter By ID</button>
            </div>
            <div class="filter-section">
                <!-- Add your filter options here -->
                <select class="filter-box">
                <option value="all">All</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <!-- Add more filter options as needed -->
                </select>
                <button class="filter-button">Filter By Email</button>
            </div>
        </div>
        <table id="myTable">
        <thead>
                <th>Index</th>
                <th>Ref No</th>
                <th>Test Type</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Appointment Duration</th>
                <th>Appointment Status</th>
                <th>Appointment Notes</th>
                <th>Action</th>
        </thead >
        <tbody>
                <div class='table_body'>
                        <?php
                        $reversedArray = array_reverse($data, true);
                        if(count($reversedArray)>1){
                            foreach ($reversedArray as $row) {
                              echo '<tr>
                              <td>'.$row['Id'].'</td>
                              <td>'.$row['Ref_No'].'</td>
                              <td>'.$row['Test_Type'].'</td>
                              <td>'.$row['Appointment_Date'].'</td>
                              <td>'.$row['Appointment_Time'].'</td>
                              <td>'.$row['Appointment_Duration'].'</td>
                              <td>'.$row['Appointment_Status'].'</td>
                              <td>'.$row['Appointment_Notes'].'</td>
                              <td><a href="http://localhost/labora/PatientDashboard/cancelAppointment/'.$row['Id'].'" class="cancel">Cancel</a></td>
                          </tr>';
                          }
                        }else{
                          echo '';
                        }
                        
                        ?>
                        
                        <!-- Add more rows as needed -->
                </div>
            </tbody>
        </table>
            <div class="pagination">
            <h5 id="table_data"></h5>
            <button onclick="previousPage()" >Previous</button>
            <button onclick="nextPage()" id="next">Next</button>
            </div>
        </div>
    </div>

    <script>
        let currentPage = 1;

        function showPage(page) {
          const rows = document.querySelectorAll('tbody tr');
          const rowsPerPage = 5; // Adjust as needed

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
          const rowsPerPage = 5; // Adjust as needed
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
          console.log(filter)
          if(filter==''){
            showPage(currentPage);
            return
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

        // Attach the search function to the input's 'input' event
        document.getElementById('searchInput').addEventListener('input', searchTable);
  </script>
</body>
</html>