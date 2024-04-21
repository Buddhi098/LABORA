<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/invmng/dashboard.css'?>">
    <script src="<?php echo APPROOT.'/public/js/invmng/dashboard.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Inventory Manager dashboard</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <div class="container_1">
    <div class="dashboard-container">
  <!-- Dashboard Header -->
  <!-- <div class="dashboard-header">
    <h2>Inventory Dashboard</h2>
    <div class="date-range">
      <input type="date" id="start-date" placeholder="Start Date">
      <input type="date" id="end-date" placeholder="End Date">
    </div>
  </div> -->

  <!-- Dashboard Cards -->
  <div class="dashboard-cards">
    <div class="card">
      <div class="card-icon"> <i class="fa-solid fa-boxes-stacked"></i></div>
      <div class="card-content">
        <h3>Total Items</h3>
        <p>1,234</p>
      </div>
    </div>
    <div class="card">
      <div class="card-icon"><i class="fa-solid fa-exclamation-triangle"></i></div>
      <div class="card-content">
        <h3>Low Stock</h3>
        <p>24</p>
      </div>
    </div>
    <div class="card">
      <div class="card-icon"><i class="fa-solid fa-truck-moving"></i></div>
      <div class="card-content">
        <h3>Top Selling</h3>
        <p>Product XYZ</p>
      </div>
    </div>
  </div>

  <!-- Chart Section -->
  <div class="chart-section">
    <div class="chart-container">
      <h3>Inventory Levels</h3>
      <canvas id="inventory-chart"></canvas>
    </div>
    <div class="chart-container">
      <h3>Sales Performance</h3>
      <canvas id="sales-chart"></canvas>
    </div>
  </div>

  <!-- Table Section -->
  <div class="table-section">
    <h3>Recent Transactions</h3>
    <table>
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Date</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Product A</td>
          <td>10</td>
          <td>2023-04-20</td>
          <td>Sale</td>
        </tr>
        <tr>
          <td>Product B</td>
          <td>5</td>
          <td>2023-04-19</td>
          <td>Purchase</td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
</div>
</div>
    <script src="<?php echo APPROOT.'/public/js/invmng/dashboard.js';?>"></script>


</body>

</html>