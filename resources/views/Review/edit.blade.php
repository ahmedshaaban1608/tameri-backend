{{-- <!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            color: #333;
        }
        
        .editt {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        
        input[type="text"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <h2>Edit Review</h2>

    <form class="editt" action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="title" id="title" name="title" value="{{ $review['title'] }}">

        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment" value="{{ $review['comment'] }}">
        
          <label for="status">Status:</label>
@if($review['status'] == 'pending')
    <input type="text" id="status" name="status" value="{{ $review['status'] }}" readonly>
    <button type="submit" name="status_action" value="confirmed">Confirm</button>
    <button type="submit" name="status_action" value="declined">Decline</button>
@else
    <input type="text" id="status" name="status" value="{{ $review['status'] }}" readonly>
@endif

        <button type="submit">Update</button>
    </form>
    
</body>
</html> --}}
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            color: #333;
        }
        
        .editt {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        
        input[type="text"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <h2>Edit Review</h2>

    <form class="editt" action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="title" id="title" name="title" value="{{ $review['title'] }}">

        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment" value="{{ $review['comment'] }}">

        <label for="status">Status:</label>
        @if($review['status'] == 'pending')
            <input type="text" id="status" name="status" value="{{ $review['status'] }}" readonly>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">Confirm</button>
            <button type="submit" name="status_action" value="declined" class="btn btn-danger">Decline</button>
        @else
            <input type="text" id="status" name="status" value="{{ $review['status'] }}" readonly>
        @endif
        
        <input type="hidden" id="status_action" name="status_action">

        <button type="submit" class="btn btn-success">Update</button>
    </form>

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
                    <button type="button" id="confirmReview" class="btn btn-primary" onclick="submitForm()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            document.getElementById('status_action').value = 'confirmed';
            document.querySelector('.editt').submit();
        }
    </script>
    <!-- Bootstrap and jQuery scripts -->
    <script src="path/to/bootstrap.min.js"></script>
    <script src="path/to/jquery.min.js"></script>
</body>
</html>