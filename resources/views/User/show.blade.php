<!DOCTYPE html>
<html>

<head>
    <title>Show users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   </head>

<body>

    <header class="bg-light text-dark text-center">
        <h1 class="display-4">Users Details</h1>
    </header>
    <div class="container mt-4">
        <div class="card p-4">
            <p class="font-weight-bold">ID: {{ $user['id'] }}</p>
            <p class="font-weight-bold">Type: {{ $user['type'] }}</p>
            <p class="font-weight-bold">Name: {{ $user['name'] }}</p>
            <p class="font-weight-bold">Email: {{ $user['email'] }}</p>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
