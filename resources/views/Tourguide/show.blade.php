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
        <h1>Tourguide Details</h1>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <div class="tourguide-details">
                <h2>ID: {{ $tourguide['id'] }}</h2>
                <p><strong>Birth Date:</strong> {{ $tourguide['birth_date'] }}</p>
                <p><strong>Bio:</strong> {{ $tourguide['bio'] }}</p>
                <p><strong>Description: </strong>{{ $tourguide['description'] }}</p>
                <p><strong>Gender: </strong>{{ $tourguide['gender'] }}</p>
                <p><strong>Phone:</strong> {{ $tourguide['phone'] }}</p>
                <div class="image-container">
                    <p><strong>Avatar:</strong></p>
                    <img src="{{ $tourguide['avatar'] }}" alt="Avatar">
                </div>
                <div class="image-container">
                    <p><strong>Profile Image:</strong></p>
                    <img src="{{ $tourguide['profile_img'] }}" alt="profile_img">
                </div>
            </div>
        </div>
    </div>
</body>
</html>

