
$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/dashboard/pie-chart", // Update the URL to match your Laravel route
        dataType: "json",
        success: function (data) {
            console.log(data); // Check if the data is correct

            var ctx = document.getElementById('pieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'doughnut', // Change type to doughnut
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.data,
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
                    responsive: true,
                    cutoutPercentage: 70, // Adjust this value to control the size of the hole in the middle (0 for pie, 50-60 for a thin donut, up to 80 for a very large hole)
                    circumference: 2 * Math.PI,
                    rotation: -Math.PI,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        },
        error: function (error) {
            console.log(error); // Check for errors in the AJAX call
        }
    });
});
