
<!DOCTYPE html>
<html>
<head>
    <title>Show users</title>
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
        .user-details{
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .user-details h2 {
            font-size: 24px;
            color: #333;
        }
        .user-details p {
            color: #555;
            margin-bottom: 10px;
        }
       
    </style>
</head>
<body>
    <header>
        <h1>Users Details</h1>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <div class="user-details">
                <p>ID: {{ $user['id']}}</p>
                <p>Type: {{ $user['type'] }}</p>
                <p>Name: {{ $user['name'] }}</p>
                <p>Email: {{ $user['email'] }}</p>
                
        </div>
    </div>
    </div>
</body>
</html>

