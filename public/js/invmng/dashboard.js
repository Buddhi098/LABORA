// Sample data for demonstration
var inventoryData = {
    labels: ['Chemicals', 'Equipments'],
    datasets: [{
        label: 'Inventory Levels',
        data: [100, 50], // Replace with actual inventory data
        backgroundColor: [
            'rgba(54, 162, 235, 0.6)', // Dark blue for chemicals
            'rgba(255, 99, 132, 0.6)'  // Red for equipments
        ],
        borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)'
        ],
        borderWidth: 1
    }]
};

// Configuration options
var chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
};

// Get the canvas element
var ctx = document.getElementById('inventory-chart').getContext('2d');

// Create the chart
var inventoryChart = new Chart(ctx, {
    type: 'bar',
    data: inventoryData,
    options: chartOptions
});
