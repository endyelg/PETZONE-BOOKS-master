$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/dashboard/bar-chart", // Update the URL to match your Laravel route
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = $("#barChart"); // Update with your canvas ID
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total Sales per Category',
                        data: data.data,
                        backgroundColor: () => {
                            var colors = [];
                            for (var i = 0; i < data.data.length; i++) {
                                var letters = '0123456789ABCDEF'.split('');
                                var color = '#';
                                for (var x = 0; x < 6; x++) {
                                    color += letters[Math.floor(Math.random() * 16)];
                                }
                                colors.push(color);
                            }
                            return colors;
                        },
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
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
            console.log(error);
        }
    });
});
