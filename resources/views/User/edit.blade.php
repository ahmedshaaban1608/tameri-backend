<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  </head>

<body class="p-4">
    <header class=" bg-light text-dark text-center">
        <h1 class="display-4 ">Edit User</h1>
    </header>

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
