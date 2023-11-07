<!DOCTYPE html>
<html>

<head>
    <title>Show Tourist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="bg-dark text-center py-4">
        <h1 class="display-4 text-white ">Tourist Details</h1>
    </header>

    <div class="container mt-4">
        <div class="card p-4">
            <h2>ID: {{ $tourist['id'] }}</h2>
            <p class="lead">Name: {{ $user['name'] }}</p>
            <p class="lead">Country: {{ $tourist['country'] }}</p>
            <p class="lead">Gender: {{ $tourist['gender'] }}</p>
            <p class="lead">Phone: {{ $tourist['phone'] }}</p>
            <p class="lead">Avatar:</p>
            <img src="{{ $tourist['avatar'] }}" class="img-fluid w-25" alt="Avatar">
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
