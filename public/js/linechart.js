
$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/dashboard/line-chart", // Update the URL to match your Laravel route
        dataType: "json",
        success: function (data) {
            console.log(data); // Check if the data is correct
            
            var ctx = document.getElementById('lineChart').getContext('2d'); // Update with your canvas ID
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total Sales per Month',
                        data: data.data,
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function (error) {
            console.log(error); // Check for errors in the AJAX call
        }
    });
});
