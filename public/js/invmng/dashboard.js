// Assuming you have fetched the inventory data from your PHP backend
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
});