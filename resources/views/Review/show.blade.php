<!DOCTYPE html>
<html>
<head>
    <title>Show review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-content {
            word-wrap: break-word;
        }
        .card-text p {
            margin-bottom: 5px;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }
    </style>
</head>
<body class="p-4">
    <header class="bg-dark text-white text-center p-3 mb-4">
        <h1>Review Details</h1>
    </header>
    <div class="container w-50">
        <div class="card p-4 shadow">
            <div class="card-content">
                <h2 class="mb-4">ID: {{ $review['id'] }}</h2>
                <div class="card-text">
                    <p><strong>Title:</strong> </p>
                    <?php
                    $title = $review['title'];
                    $words = explode(' ', $title);
                    $lineLength = 5;
                    $lines = array_chunk($words, $lineLength);
                    foreach ($lines as $line) {
                        echo '<p style="word-wrap: break-word;">' . implode(' ', $line) . '</p>';
                    }
                ?>
                    <p><strong>Comment:</strong></p>
                    <?php
                $comment = $review['comment'];
                $words = explode(' ', $comment);
                $lineLength = 6;
                $lines = array_chunk($words, $lineLength);
                foreach ($lines as $line) {
                    echo '<p style="word-wrap: break-word;">' . implode(' ', $line) . '</p>';
                }
            ?>
                    <p><strong>Stars:</strong> {{ $review['stars'] }}</p>
                    <p><strong>Status:</strong> {{ $review['status'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>





