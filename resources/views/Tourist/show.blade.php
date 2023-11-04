<!DOCTYPE html>
<html>
<head>
    <title>Show Tourist</title>
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
        .tourist-details {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .tourist-details h2 {
            font-size: 24px;
            color: #333;
        }
        .tourist-details p {
            color: #555;
            margin-bottom: 10px;
        }
        .tourist-details img {
            max-width: 100px;
            max-height: 100px;
            /* border-radius: 50%; */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tourist Details</h1>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <div class="tourist-details">
                <h2>ID: {{ $tourist['id'] }}</h2>
                <p>Country: {{ $tourist['country'] }}</p>
            <p>Gender: {{ $tourist['gender'] }}</p>
            <p>Phone: {{ $tourist['phone'] }}</p>
            <p>Avatar:</p>
            <img src="{{ $tourist['avatar'] }}" alt="Avatar">
        </div>
    </div>
    </div>
</body>
</html>