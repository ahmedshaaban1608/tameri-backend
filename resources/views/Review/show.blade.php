<!DOCTYPE html>
<html>
<head>
    <title>Show review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            width: 40%;
            margin: auto;
            overflow: hidden;
        }
        .tourguide-details {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .tourguide-details h2 {
            font-size: 24px;
            color: #333;
        }
        .tourguide-details p {
            color: #555;
            margin-bottom: 10px;
        }
        .tourguide-details img {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
        }
        .image-container {
            display: inline-block;
            vertical-align: top;
            margin-right: 20px; /* Adjust margin as needed */
        }
    </style>
</head>
<body>
    <header>
        <h1>Review Details</h1>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <div class="tourguide-details">
                <h2>ID: {{ $review['id'] }}</h2>
                <p><strong>title:</strong> {{ $review['title'] }}</p>
                <p><strong>comment:</strong> {{ $review['comment'] }}</p>
                <p><strong>stars: </strong>{{ $review['stars'] }}</p>
                <p><strong>status: </strong>{{ $review['status'] }}</p>
               
               
            </div>
        </div>
    </div>
</body>
</html>
