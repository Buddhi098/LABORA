const stockData = {
  labels: ['In Stock', 'Low Stock'],
  datasets: [
    {
      label: 'Number of Items',
      data: [125, 10], // Replace with actual data
      backgroundColor: [
        '#4caf50', // Green for In Stock
        '#f44336', // Red for Low Stock
      ],
      borderColor: [
        'transparent',
        'transparent',
      ],
      borderWidth: 0,
    },
  ],
};

// Get the container for the bar chart
const barChartContainer = document.querySelector('.bar-chart-container');

// Create the bar chart
const barChart = new Chart(barChartContainer, {
  type: 'bar',
  data: stockData,
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});