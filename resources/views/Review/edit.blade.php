<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
   </head>
<body class="p-4">
    <header class=" bg-light text-dark text-center">
        <h1 class="display-4 ">Edit Review</h1>
    </header>

    <div class="container-sm">
        <form class="border p-4 bg-light" action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="text-dark">Title:</label>
                <input type="text" id="title" name="title" value="{{ $review['title'] }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="comment" class="text-dark">Comment:</label>
                <input type="text" id="comment" name="comment" value="{{ $review['comment'] }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="status" class="text-dark">Status:</label>
                @if($review['status'] == 'pending')
                    <input type="text" id="status" name="status" value="{{ $review['status'] }}" class="form-control" readonly>
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#confirmationModal">Confirm</button>
                    <button type="submit" name="status_action" value="declined" class="btn btn-danger mt-3">Decline</button>
                @else
                    <input type="text" id="status" name="status" value="{{ $review['status'] }}" class="form-control" readonly>
                @endif
                <input type="hidden" id="status_action" name="status_action">
            </div>
            
            <button type="submit" class="btn btn-success w-100 mt-3">Update</button>
        </form>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to confirm this review?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function submitForm() {
            document.getElementById('status_action').value = 'confirmed';
            document.querySelector('.container-sm form').submit();
        }
    </script>
</body>
</html>
