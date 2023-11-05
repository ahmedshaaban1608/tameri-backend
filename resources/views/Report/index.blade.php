<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection Data</title>
   
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
                    <div class="card">
                        <h2>Tourguide</h2>
                        <p>Number of Tourguide: <?php echo $tourguidesCount; ?></p>
                    </div>

                    <div class="card">
                        <h2>Tourist</h2>
                        <p>Number of Tourist: <?php echo $touristsCount; ?></p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h2>Review</h2>
                        <p>Number of Reviews: <?php echo $reviewsCount; ?></p>
                    </div>

                    <div class="card">
                        <h2>Order</h2>
                        <p>Number of Order: <?php echo $ordersCount; ?></p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>

