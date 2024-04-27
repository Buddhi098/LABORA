// chart_script.js

// Function to fetch data from requested_items table
function fetchDataAndDrawChart() {
    // Here you'll fetch the data using AJAX or another method
    // For now, let's assume you have a variable graphData that holds the fetched data

    const labels = graphData.map(item => item.item_name);
    const quantities = graphData.map(item => item.quantity);

    const ctx = document.getElementById('firstChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Quantity',
                data: quantities,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Call the function to fetch data and draw the chart
fetchDataAndDrawChart();
