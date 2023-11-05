<!DOCTYPE html>
<html>
<head>
    <title>Order Tourist</title>
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
        .order-details {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .order-details h2 {
            font-size: 24px;
            color: #333;
        }
        .order-details p {
            color: #555;
            margin-bottom: 10px;
        }
        
       
    </style>
</head>
<body>
    <header>
        <h1>Order Details</h1>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <div class="order-details">
                <h2>ID: {{ $order['id'] }}</h2>
                <p><strong>comment:</strong> {{ $order['comment'] }}</p>
                <p><strong>city:</strong> {{ $order['city'] }}</p>
                <p><strong>status: </strong>{{ $order['status'] }}</p>
                <p><strong>total: </strong>{{ $order['total'] }}</p>
                <p><strong>Phone:</strong> {{ $order['phone'] }}</p>
                <p><strong>start Date: </strong>{{ $order['from'] }}</p>
                <p><strong>End Date:</strong> {{ $order['to'] }}</p>
              
            </div>
        </div>
    </div>
</body>
</html>