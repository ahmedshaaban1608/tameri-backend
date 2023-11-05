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
        {{-- <td>
            @if ($review->tourist)
                {{ $review->tourist->id }}
            @else
                N/A
            @endif
        </td> --}}
        <td>
            @if ($review->tourguide)
                {{ $review->tourguide->id }}
            @else
                N/A
            @endif
        </td>
            {{-- <td>{{ $review->tourguide->id }}</td> --}}
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
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop" onclick="setDeleteUrl('{{ route('reviews.destroy', $review->id) }}')"> Delete</button>
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

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are your sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form id="deleteForm" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setDeleteUrl(url) {
        
            // Set the action URL for the delete form
            document.getElementById('deleteForm').action = url;
        }
    </script>

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

    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
</body>
</html>
