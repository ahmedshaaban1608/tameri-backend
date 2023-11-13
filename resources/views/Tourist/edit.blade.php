<!DOCTYPE html>
<html>
<head>
    <title>Edit Tourist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
<body class="p-2">
    <header class=" bg-light text-dark text-center">
        <h1 class="display-4 ">Edit Tourist</h1>
    </header>
    <div class="container">
        <form class="border p-4 bg-light" action="{{ route('tourists.update', $tourist->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="country" class="text-dark">Country:</label>
                <input type="text" id="country" name="country" value="{{ $tourist['country'] }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="gender" class="text-dark">Gender:</label>
                <input type="text" id="gender" name="gender" value="{{ $tourist['gender'] }}" class="form-control">
            </div>

            {{-- <div class="form-group">
                <label for="avatar" class="text-dark">Avatar:</label>
                <input type="text" id="avatar" name="avatar" value="{{ $tourist['avatar'] }}" class="form-control">
            </div> --}}

            <div class="form-group">
                <label for="phone" class="text-dark">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ $tourist['phone'] }}" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-success w-100 mt-3">Update</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
