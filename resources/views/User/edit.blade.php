<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="p-4">
    <h2 class="text-center text-dark">Edit User</h2>

    <form class="col-md-6 mx-auto" action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type" class="text-dark">Type:</label>
            <input type="text" id="type" name="type" class="form-control" value="{{ $user['type'] }}">
        </div>

        <div class="form-group">
            <label for="name" class="text-dark">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user['name'] }}">
        </div>

        <div class="form-group">
            <label for="email" class="text-dark">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user['email'] }}">
        </div>

        <button type="submit" class="btn btn-success btn-block">Update</button>
    </form>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
