<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
     <style>
        .card p {
            margin-bottom: 6px;
        }
    </style>
</head>

<body class="p-4">
    <header class="bg-light text-dark text-center">
        <h1 class="display-4">Order Details</h1>
    </header>

    <div class="container my-4 w-50">
        <div class="card p-4 shadow">
            <h2 class="mb-4">ID: {{ $order['id'] }}</h2>
            <p><strong>Comment:</strong></p>
            <?php
                $comment = $order['comment'];
                $words = explode(' ', $comment);
                $lineLength = 7;
                $lines = array_chunk($words, $lineLength);
                foreach ($lines as $line) {
                    echo '<p style="word-wrap: break-word;">' . implode(' ', $line) . '</p>';
                }
            ?>
            <p><strong>City:</strong> {{ $order['city'] }}</p>
            <p><strong>Status:</strong> {{ $order['status'] }}</p>
            <p><strong>Total:</strong> {{ $order['total'] }}</p>
            <p><strong>Phone:</strong> {{ $order['phone'] }}</p>
            <p><strong>Start Date:</strong> {{ $order['from'] }}</p>
            <p><strong>End Date:</strong> {{ $order['to'] }}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

