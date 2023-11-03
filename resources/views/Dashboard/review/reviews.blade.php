<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #383737;
        }

        .action-button {
            text-align: center;
            padding: 6px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .show-button {
            background-color: #4CAF50;
            color: white;
        }

        .update-button {
            background-color: #007bff;
            color: white;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }
       
    </style>
</head>
<body>
    <div class="content-wrapper">
            
        @if(isset($reviews))
            <div id="displayReviewDetails"></div> 
   
    <h1>Reviews</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                {{-- <th>Tourist_ID</th> --}}
                <th>Tourguide_ID</th>
                <th>Title</th>
                {{-- <th>Comment</th> --}}
                <th>Stars</th>
                <th>Status</th>
                <th>Created_at </th>
                <th>Show</th>
                <th>update</th>
                <th>Delete</th>
              
               
               
            </tr>
        </thead>
        <tbody>
            @isset($reviews)
            @foreach ($reviews as $review)
    <tr>
        <td>{{ $review->id }}</td>
        {{-- <td>{{ $review->tourist->id }}</td> --}}
            <td>{{ $review->tourguide->id }}</td>
        <td>{{ $review->title }}</td>
        {{-- <td>{{ $review->comment }}</td> --}}
        <td>{{ $review->stars }}</td>
        <td>{{ $review->status }}</td>
        <td>{{ $review->created_at }}</td>
        
       
        <td>
            <a class="action-button show-button btn btn-primary" href="javascript:void(0);" onclick="showReviewDetails({{ $review->id }})">
                Show
            </a>
        </td>
        
            <td>
                <a  href="javascript:void(0);" class="action-button update-button" onclick="editReview({{ $review['id'] }})">Update</a>
            </td>
            
            <td>
                <form id="delete-form-{{ $review['id'] }}" action="{{ route('reviews.destroy', $review['id']) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <a class="btn btn-danger" href="#" onclick="showConfirmation({{ $review['id'] }})">Delete</a>
            </td>
            
            <tr>
                <td colspan="10">
                    <div class="details-div" id="details_{{ $review['id'] }}" style="display: none;"></div>
                </td>
            </tr>
    </tr>
@endforeach
@endisset

        </tbody>
    </table>
    @endif
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showReviewDetails(reviewId) {
            if ($('#details_' + reviewId).is(':visible')) {
                $('#details_' + reviewId).hide();
            } else {
                $.get(`/reviews/${reviewId}`, function (data) {
                    $('.details-div').hide();
                    $('#details_' + reviewId).html(data).show();
                });
            }
        }

        function editReview(id) {
            $.get(`/reviews/${id}/edit`, function (data) {
                $('.details-div').hide();
                $('#details_' + id).html(data).show();
            });
        }

        function showConfirmation(id) {
            if (confirm('Are you sure you want to delete this review?')) {
                document.querySelector(`form[action$="/reviews/${id}"]`).submit();
            } else {
                return false;
            }
        }
    </script>
</body>
</html>
