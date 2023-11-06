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

