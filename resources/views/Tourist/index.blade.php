 <!DOCTYPE html>
<html>
<head>
    <title>Tourists Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="text-center mb-3">
        <input type="text" id="search-input" class="form-control" placeholder="Search by name">
       </div>
    <div class="container-fluid">
       
        <h2>Tourists Data</h2>
        <table id="data-table" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Country</th>
                    <th>Gender</th>
                    <th>Avatar</th>
                    <th>Phone</th>
                    <th>Show</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @isset($tourists)
                    @foreach($tourists as $tourist)
                        <tr>
                            <td>{{ $tourist['id'] }}</td>
                            <td>{{ $tourist['country'] }}</td>
                            <td>{{ $tourist['gender'] }}</td>
                            <td>
                                @if($tourist['avatar'])
                                    <img src="{{ $tourist['avatar'] }}" alt="Avatar" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No Avatar
                                @endif
                            </td>
                            <td>{{ $tourist['phone'] }}</td>
                            <td>
                                <a class="btn btn-success" href="javascript:void(0);" onclick="showTouristDetails({{ $tourist['id'] }})">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="javascript:void(0);" onclick="editTourist({{ $tourist['id'] }})">
                                    
                                    <i class="fas fa-edit"></i>
                                
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="showSweetAlert('{{ route('tourists.destroy', $tourist->id) }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <form id="deleteForm" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                            </td>
                            <tr class="showData">
                            <td colspan="8">
                                <div class="details-div" id="details_{{ $tourist['id'] }}" style="display: none;"></div>
                            </td>
                        </tr>
                        </tr>
                       
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">No tourists data available</td>
                    </tr>
                @endisset
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
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

    <div class="card-footer border-0 py-5">
        <span class="text-muted text-sm">
          Showing  items 
        </span>
        <nav aria-label="Page navigation example">
          {!! $tourists->links() !!}  
        </nav>    
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
                    const deleteForm = document.getElementById('deleteForm');
                    deleteForm.action = url;
                    deleteForm.style.display = 'block';
                    deleteForm.submit();
                }
            });}

        function showTouristDetails(touristId) {
            if ($('#details_' + touristId).is(':visible')) {
                $('#details_' + touristId).hide();
            } else {
                $.get(`/tourists/${touristId}`, function (data) {
                    $('.details-div').hide();
                    $('#details_' + touristId).html(data).show();
                });
            }
        }

        function editTourist(id) {
            $.get(`/tourists/${id}/edit`, function (data) {
                $('.details-div').hide();
                $('#details_' + id).html(data).show();
            });
        }
    </script>
<script>
    document.getElementById('search-input').addEventListener('keyup', function() {
        const searchQuery = this.value.toLowerCase();
        const table = document.getElementById('data-table');
        const rows = table.querySelectorAll('tbody > tr');

        for (let row of rows) {
            const isShowData = row.classList.contains('showData');

            if (!isShowData) {
                const cells = row.querySelectorAll('td');
                let shouldDisplay = false;

                for (let cell of cells) {
                    const text = cell.textContent || cell.innerText;
                    if (text.toLowerCase().indexOf(searchQuery) > -1) {
                        shouldDisplay = true;
                        break;
                    }
                }

                row.style.display = shouldDisplay ? '' : 'none';

                // If the parent row is hidden, hide the child showData row
                const showDataRow = row.nextElementSibling;
                if (showDataRow && showDataRow.classList.contains('showData')) {
                    showDataRow.style.display = shouldDisplay ? '' : 'none';
                }
            }
        }
    });
</script>
</body>
</html>

