

// JavaScript to initialize the charts
document.addEventListener("DOMContentLoaded", function () {
    // Initialize Sales Chart (Pie Chart)
    // var pieChartCtx = document.getElementById('pieChart').getContext('2d');
    // var pieChart = new Chart(pieChartCtx, {
    //     type: 'pie', // Pie chart type
    //     data: {
    //         labels: ['Electronics', 'Clothing', 'Groceries'],
    //         datasets: [{
    //             data: [300, 50, 100], // Sample data
    //             backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
    //         }]
    //     },
    //     options: {
    //         responsive: true, // Makes the chart responsive
    //         maintainAspectRatio: false, // Allows resizing based on parent container
    //     }
    // });

    // // Initialize Orders Chart (Bar Chart)
    // var ordersChartCtx = document.getElementById('ordersChart').getContext('2d');
    // var ordersChart = new Chart(ordersChartCtx, {
    //     type: 'bar', // Bar chart type
    //     data: {
    //         labels: ['January', 'February', 'March'],
    //         datasets: [{
    //             label: 'Orders',
    //             data: [65, 59, 80], // Sample data
    //             backgroundColor: '#4BC0C0',
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //     }
    // });
    const totalOrders = 1500;
    const dailySales = 3200;
    const stockLevels = 120;

    document.getElementById('totalOrders').innerText = totalOrders;
    document.getElementById('dailySales').innerText = `$${dailySales}`;
    document.getElementById('stockLevels').innerText = stockLevels;

    // Sales Chart (Line chart)
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // months
            datasets: [{
                label: 'Sales ($)',
                data: [3000, 4000, 3500, 4200, 5000, 4600],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
        }
    });

    // Traffic Chart (Bar chart)
    const trafficCtx = document.getElementById('trafficChart').getContext('2d');
    const trafficChart = new Chart(trafficCtx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], // days of the week
            datasets: [{
                label: 'Traffic (Visits)',
                data: [200, 250, 300, 400, 500, 600, 550],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
            }],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        }
    });
});

