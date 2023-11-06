

<!DOCTYPE html>
<html>

<head>
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container w-50">
        <h2 class="text-center mb-4">Edit Order</h2>

        <form class="card p-4" action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="comment" class="form-label">Comment:</label>
                <input type="text" id="comment" name="comment" value="{{ $order['comment'] }}" class="form-control">
            </div>
    
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" id="cite" name="city" value="{{ $order['city'] }}" class="form-control">

            <button type="submit" class="btn btn-success w-100 mt-3">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
