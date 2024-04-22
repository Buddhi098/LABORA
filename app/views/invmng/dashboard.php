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
  
  <div class="top-cards">
  <div class="card">
    <div class="card-icon">
      <i class="fas fa-clipboard-list"></i>
    </div>
    <div class="card-content">
      <h3>Pending Orders</h3>
      <p>25</p>
    </div>
  </div>

  <div class="card">
    <div class="card-icon">
      <i class="fas fa-box-open"></i>
    </div>
    <div class="card-content">
      <h3>Total Stock Value</h3>
      <p>$120,000</p>
    </div>
  </div>

  <div class="card">
    <div class="card-icon">
      <i class="fas fa-trash"></i>
    </div>
    <div class="card-content">
      <h3>Total Wastage Value</h3>
      <p>$5,000</p>
    </div>
  </div>
</div>

<!-- <div class="urgent-actions">
  <h2>Urgent Actions</h2>
  <div class="action-item">
    <div class="action-icon">
      <i class="fas fa-exclamation-triangle"></i>
    </div>
    <div class="action-content">
      <h3>Below Alert Quantity</h3>
      <p>15 items</p>
    </div>
  </div>
  <div class="action-item">
    <div class="action-icon">
      <i class="fas fa-clock"></i>
    </div>
    <div class="action-content">
      <h3>New Expiry (21 Days)</h3>
      <p>8 items</p>
    </div>
  </div>
</div> -->

<!-- <div class="dashboard-row">
  <div class="urgent-actions">
    <h2>Urgent Actions</h2>
    <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="action-content">
        <h3>Below Alert Quantity</h3>
        <p>15 items</p>
      </div>
    </div>
    <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-clock"></i>
      </div>
      <div class="action-content">
        <h3>New Expiry (21 Days)</h3>
        <p>8 items</p>
      </div>
    </div>
  </div>

  <div class="invoice-details">
    <div class="invoice-card">
      <div class="invoice-icon">
        <i class="fas fa-file-invoice"></i>
      </div>
      <div class="invoice-content">
        <h3>Pending Invoices</h3>
        <p>25</p>
      </div>
    </div>
    <div class="invoice-card">
      <div class="invoice-icon">
        <i class="fas fa-clipboard-check"></i>
      </div>
      <div class="invoice-content">
        <h3>Invoices to Check</h3>
        <p>12</p>
      </div>
    </div>
  </div>
</div> -->

<!-- <div class="dashboard-row">
  <div class="urgent-actions">
    <h2>Urgent Actions</h2>
    <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="action-content">
        <h3>Below Alert Quantity</h3>
        <p>15 items</p>
      </div>
    </div>
    <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-clock"></i>
      </div>
      <div class="action-content">
        <h3>New Expiry (21 Days)</h3>
        <p>8 items</p>
      </div>
    </div>
  </div>

  <div class="invoice-details">
    <div class="invoice-card">
      <h3>Pending Invoices</h3>
      <div class="invoice-list">
        <div class="invoice-item">
          <span class="invoice-number">INV-00123</span>
          <span class="invoice-date">Expected: 06/15/2023</span>
        </div>
        <div class="invoice-item">
          <span class="invoice-number">INV-00456</span>
          <span class="invoice-date">Expected: 06/20/2023</span>
        </div>
     
      </div>
    </div>
    <div class="invoice-card">
      <h3>Invoices to Check</h3>
      <div class="invoice-list">
        <div class="invoice-item">
          <span class="invoice-number">INV-00789</span>
          <span class="invoice-date">Received: 06/10/2023</span>
        </div>
        <div class="invoice-item">
          <span class="invoice-number">INV-00012</span>
          <span class="invoice-date">Received: 06/12/2023</span>
        </div>
     
      </div>
    </div>
  </div>
</div> -->

<div class="dashboard-row">
  <div class="urgent-actions">
    <h2>Urgent Actions</h2>
    <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="action-content">
        <h3>Below Alert Quantity</h3>
        <p>15 items</p>
      </div>
    </div>
    <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-clock"></i>
      </div>
      <div class="action-content">
        <h3>New Expiry (21 Days)</h3>
        <p>8 items</p>
      </div>
    </div>
  </div>

  <div class="urgent-actions">
  <h2>Invoice Details</h2>
  <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-file-invoice"></i>
      </div>
      <div class="action-content">
        <h3>Pending Invoices</h3>
        <p>25</p>
      </div>
    </div>
    <div class="action-item">
      <div class="action-icon">
        <i class="fas fa-clipboard-check"></i>
      </div>
      <div class="action-content">
        <h3>Invoices to Check</h3>
        <p>12</p>
      </div>
    </div>
  </div>
</div>

  <!-- Chart Section -->
  <div class="chart-section">
    <div class="chart-container">
      <h3>Inventory Status</h3>
      <canvas id="multipleBarChart"></canvas>
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

    <script> // Assuming you have fetched the inventory data from your PHP backend
const inventoryData = [
    { date: '2023-04-15', received: 50, used: 20, stock: 100 },
    { date: '2023-04-16', received: 30, used: 15, stock: 115 },
    { date: '2023-04-17', received: 40, used: 25, stock: 130 },
    { date: '2023-04-18', received: 0, used: 10, stock: 120 },
    { date: '2023-04-19', received: 20, used: 30, stock: 110 },
    { date: '2023-04-20', received: 60, used: 15, stock: 155 },
    { date: '2023-04-21', received: 10, used: 5, stock: 160 },
];

// Extract labels and data for the chart
const labels = inventoryData.map(data => data.date);
const receivedData = inventoryData.map(data => data.received);
const usedData = inventoryData.map(data => data.used);
const stockData = inventoryData.map(data => data.stock);

// Create the multiple bar chart
const ctx = document.getElementById('multipleBarChart').getContext('2d');
const multipleBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Chemical Received',
                data: receivedData,
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Bar color
                borderColor: 'rgba(54, 162, 235, 1)', // Bar border color
                borderWidth: 1
            },
            {
                label: 'Chemical Used',
                data: usedData,
                backgroundColor: 'rgba(255, 99, 132, 0.5)', // Bar color
                borderColor: 'rgba(255, 99, 132, 1)', // Bar border color
                borderWidth: 1
            },
            {
                label: 'Chemical in Stock',
                data: stockData,
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Bar color
                borderColor: 'rgba(75, 192, 192, 1)', // Bar border color
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantity'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Date'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Chemical Inventory'
            }
        }
    }
}); </script>

</body>

</html>