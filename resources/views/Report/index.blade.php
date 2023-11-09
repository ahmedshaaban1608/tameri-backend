{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card {
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .card h2 {
            margin-top: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }
        .card p {
            color: #555;
        }
    </style>
</head>
<body class="antialiased">
    <div class="content-wrapper">
        @if(isset($reports))
            <div class="row">
                <div class="col-md-6">
                    <canvas id="tourguideChart" width="400" height="400"></canvas>
                    <canvas id="touristChart" width="400" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="reviewChart" width="400" height="400"></canvas>
                    <canvas id="orderChart" width="400" height="400"></canvas>
                </div>
            </div>
        @endif
    </div>

    <script>
        const tourguideCtx = document.getElementById('tourguideChart').getContext('2d');
        const touristCtx = document.getElementById('touristChart').getContext('2d');
        const reviewCtx = document.getElementById('reviewChart').getContext('2d');
        const orderCtx = document.getElementById('orderChart').getContext('2d');

        const tourguideData = <?php echo json_encode($tourguidesCount); ?>;
        const touristData = <?php echo json_encode($touristsCount); ?>;
        const reviewData = <?php echo json_encode($reviewsCount); ?>;
        const orderData = <?php echo json_encode($ordersCount); ?>;

        const chartOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        new Chart(tourguideCtx, {
            type: 'bar',
            data: {
                labels: ['Tourguide'],
                datasets: [{
                    label: 'Number of Tourguides',
                    data: [tourguideData],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        new Chart(touristCtx, {
            type: 'bar',
            data: {
                labels: ['Tourist'],
                datasets: [{
                    label: 'Number of Tourists',
                    data: [touristData],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        new Chart(reviewCtx, {
            type: 'bar',
            data: {
                labels: ['Review'],
                datasets: [{
                    label: 'Number of Reviews',
                    data: [reviewData],
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });

        new Chart(orderCtx, {
            type: 'bar',
            data: {
                labels: ['Order'],
                datasets: [{
                    label: 'Number of Orders',
                    data: [orderData],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });
    </script>
</body>
</html>
 --}}
 {{-- //////////////////2///////////////////// --}}
{{-- 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card {
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .card h2 {
            margin-top: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }
        .card p {
            color: #555;
        }
    </style>
</head>
<body class="antialiased">
    <div class="content-wrapper">
        <canvas id="combinedChart" width="800" height="400"></canvas>
    </div>

    <script>
        const combinedCtx = document.getElementById('combinedChart').getContext('2d');

        const tourguideData = <?php echo json_encode($tourguidesCount); ?>;
        const touristData = <?php echo json_encode($touristsCount); ?>;
        const reviewData = <?php echo json_encode($reviewsCount); ?>;
        const orderData = <?php echo json_encode($ordersCount); ?>;

        const chartOptions = {
            indexAxis: 'x',
            elements: {
                bar: {
                    borderWidth: 2,
                }
            }
        };

        new Chart(combinedCtx, {
            type: 'bar',
            data: {
                labels: ['Tourguide', 'Tourist', 'Review', 'Order'],
                datasets: [
                    {
                        label: 'Number of Tourguides: ' + tourguideData,
                        data: [tourguideData, 0, 0, 0],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Number of Tourists: ' + touristData,
                        data: [0, touristData, 0, 0],
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Number of Reviews: ' + reviewData,
                        data: [0, 0, reviewData, 0],
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Number of Orders: ' + orderData,
                        data: [0, 0, 0, orderData],
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: chartOptions
        });
  

    </script>
</body>
</html> --}}
{{-- //////////////3//////////// --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
  
</style>
<body class="antialiased">
    
    <div class="container ">
        {{-- <div class="row mb-3" style="margin-top: -30px">
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <i class="fas fa-chart-pie fa-3x"></i>
                    <h3>Chart 1</h3>
                    <p>Data</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <i class="fas fa-user fa-3x"></i>
                    <h3>User Icon</h3>
                    <p>User Information</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <i class="fas fa-chart-line fa-3x"></i>
                    <h3>Chart 2</h3>
                    <p>Data</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <i class="fas fa-cog fa-3x"></i>
                    <h3>Settings</h3>
                    <p>Configuration</p>
                </div>
            </div>
        </div> --}}
        
        <div class="row" style="margin-top: -30px">
            <div class="col-md-8">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="card p-4" style="height: 39vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                            <h4 style="text-align: center; margin-top: -8px;">Tourguide</h4>
                            <canvas id="tourguideChart" class="pie-chart"></canvas>
                            <p class="text-center">Number of Tourguides: <?php echo $tourguidesCount; ?></p>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="card p-4" style="height: 39vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <h4 style="text-align: center; margin-top: -8px;">Tourist</h4>
                            <canvas id="touristChart" class="pie-chart"></canvas>
                            <p class="text-center">Number of Tourists: <?php echo $touristsCount; ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card p-4" style="height: 39vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <h4 style="text-align: center; margin-top: -8px;">Review</h4>
                            <canvas id="reviewChart"  class="pie-chart"></canvas>
                            <p class="text-center">Number of Reviews: <?php echo $reviewsCount; ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card p-4" style="height: 39vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <h4 style="text-align: center; margin-top: -8px;">Order</h4>
                            <canvas id="orderChart" class="pie-chart"></canvas>
                            <p class="text-center">Number of Orders: <?php echo $ordersCount; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card text-center p-4" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;height: 80vh;">
                    <h2 style="text-align: left; margin: 0;">Users</h2>
                    <p>Number of Users: <?php echo $usersCount; ?></p>
                    <canvas id="userChart" width="300" height="300" class="pie-chart"></canvas>
                </div>
            </div>
            
            
        </div>
    </div>
   

    <script>
        const tourguideData = <?php echo json_encode($tourguidesCount); ?>;
        const touristData = <?php echo json_encode($touristsCount); ?>;
        const reviewData = <?php echo json_encode($reviewsCount); ?>;
        const orderData = <?php echo json_encode($ordersCount); ?>;
        const userData = <?php echo json_encode($usersCount); ?>;
        const pieChartOptions = {
            indexAxis: 'y',
            elements: {
                arc: {
                    borderWidth: 1
                }
            }
        };

        new Chart(document.getElementById('tourguideChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Tourguide', 'Others'],
                datasets: [{
                    label: 'Number of Tourguides',
                    data: [tourguideData, 100 - tourguideData],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(0, 0, 0, 0.1)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(0, 0, 0, 0)'
                    ],
                    borderWidth: 1
                }]
            },
            options: pieChartOptions
        });
    

        new Chart(document.getElementById('touristChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Tourist', 'Others'],
                datasets: [{
                    label: 'Number of Tourists',
                    data: [touristData, 100 - touristData],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(0, 0, 0, 0.1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(0, 0, 0, 0)'
                    ],
                    borderWidth: 1
                }]
            },
            options: pieChartOptions
        });

        new Chart(document.getElementById('reviewChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Review', 'Others'],
                datasets: [{
                    label: 'Number of Reviews',
                    data: [reviewData, 100 - reviewData],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(0, 0, 0, 0.1)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(0, 0, 0, 0)'
                    ],
                    borderWidth: 1
                }]
            },
            options: pieChartOptions
        });

        new Chart(document.getElementById('orderChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Order', 'Others'],
                datasets: [{
                    label: 'Number of Orders',
                    data: [orderData, 100 - orderData],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(0, 0, 0, 0.1)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(0, 0, 0, 0)'
                    ],
                    borderWidth: 1
                }]
            },
            options: pieChartOptions
        });

        new Chart(document.getElementById('userChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Active', 'Other'],
                datasets: [{
                    label: 'Number of Users',
                    data: [userData, 100 - userData],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.5)',  
                        'rgba(0, 0, 0, 0.1)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)', 
                        'rgba(0, 0, 0, 0)'
                    ],
                    borderWidth: 1
                }]
            },
            options: pieChartOptions
        });
    </script>
</body>
</html>
