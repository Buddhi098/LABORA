const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
    labels: ['Blood', 'Xray', 'CT', 'ECG'],
    datasets: [{
        label: '# Medical tests',
        data: [12, 19, 4, 15,],
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

// Second Chart
const ctx2 = document.getElementById('myChart2').getContext('2d');
new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Revenue',
            data: [7655, 5595, 6680, 8001, 5064, 5555, 4660],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
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

const button = document.getElementById("download-button");

function generatePDF() {
const element = document.getElementById("invoice");
html2pdf().from(element).save();
}

button.addEventListener("click", generatePDF);

