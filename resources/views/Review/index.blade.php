<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
      <style>
         .td-title {
            max-width: 25px;
            padding: 5px 10px;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card {
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #eceef3;
            border-radius: 0.75rem;
        }
        table tbody tr:not(.showData) {
            border-bottom: 1px solid #e7eaf0;
           
        }
        tr.showData {
            border-bottom: 1px solid #e7eaf0;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="container-fluid">
        <h1 class="text-center">Reviews</h1>
        @if(isset($reviews))
        <div id="displayReviewDetails"></div>
        <div class="table-responsive">
        <table class="table shadow border-0">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Tourguide_ID</th>
                    <th>Title</th>
                    <th>Stars</th>
                    <th>Status</th>
                    <th>Created_at </th>
                    <th>Show</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @isset($reviews)
                @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>
                        @if ($review->tourguide)
                        {{ $review->tourguide->id }}
                        @else
                        N/A
                        @endif
                    </td>
                    <td class="td-title">{{ $review->title }}</td> 
                    <td>{{ $review->stars }}</td>
                    <td>{{ $review->status }}</td>
                    <td>{{ $review->created_at }}</td>
                    <td>
                        <a class="btn btn-success" href="javascript:void(0);" onclick="showReviewDetails({{ $review->id }})">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="javascript:void(0);" onclick="editReview({{ $review['id'] }})">
                            <i class="fas fa-edit"></i>  
                        </a>
                    </td>
                    <td>
                        <button type="button" onclick="showSweetAlert('{{ route('reviews.destroy', $review->id) }}')" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                        <form id="deleteForm" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div class="details-div" id="details_{{ $review['id'] }}" style="display: none;"></div>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
        </div>
        @endif
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function showSweetAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                preConfirm: () => {
                    // Submit the delete form
                    const deleteForm = document.getElementById('deleteForm');
                    deleteForm.action = url;
                    deleteForm.style.display = 'block';
                    deleteForm.submit();
                }
            });
        }

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
    <div class="card-footer border-0 py-5">
        <span class="text-muted text-sm">
          Showing  items 
        </span>
        <nav aria-label="Page navigation example">
          {!! $reviews->links() !!}  
        </nav>    
      </div>
</body>
</html>
