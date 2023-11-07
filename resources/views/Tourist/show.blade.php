<!DOCTYPE html>
<html>

<head>
    <title>Show Tourist</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>

<body>
  
    <header class="bg-light text-dark text-center">
        <h1 class="display-4">Tourist Details</h1>
    </header>
    <div class="container mt-4">
        <div class="card p-4">
            <h2>ID: {{ $tourist['id'] }}</h2>
            <p class="lead">Name: {{ $user['name'] }}</p>
            <p class="lead">Country: {{ $tourist['country'] }}</p>
            <p class="lead">Gender: {{ $tourist['gender'] }}</p>
            <p class="lead">Phone: {{ $tourist['phone'] }}</p>
            <p class="lead">Avatar:</p>
            @if (Str::startsWith($tourist['avatar'], 'http'))
            <img src="{{ $tourist['avatar'] }}" class="img-fluid w-25" alt="Avatar">
            @else
            <img src="{{ asset('img/' . $tourist['avatar']) }}" class="img-fluid w-25" alt="Avatar">

            @endif
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
