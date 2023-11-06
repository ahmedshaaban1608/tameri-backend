


<!DOCTYPE html>
<html>

<head>
    <title>Edit Tourguide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container w-50">
        <h2 class="text-center mb-4">Edit Tourguide</h2>

        <form class="card p-4" action="{{ route('tourguides.update', $tourguide->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="bio" class="form-label text-dark">Bio:</label>
                <input type="text" id="bio" name="bio" value="{{ $tourguide['bio'] }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-dark">Description:</label>
                <input type="text" id="description" name="description" value="{{ $tourguide['description'] }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
