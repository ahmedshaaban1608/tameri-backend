<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <style>
         .card-footer .page-item.active .page-link {
        background-color: blue !important;
        color: white !important;
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

<div class="content-wrapper">
    <div class="container">
        <div class="text-center mb-3">
     <input type="text" id="search-input" class="form-control" placeholder="Search by name">
    </div>
    
    @if(isset($users))
        <div id="displayUserDetails"></div>
        <div class="card">
            <div class="container-fluid">
                
                <h2 class="text-center">User Data</h2>
                <div class="table-responsive">
        <table id="data-table" class="table  shadow border-0">
           
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Show</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->type }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-success" href="javascript:void(0);" onclick="showUserDetails({{ $user->id }})">
                                {{-- Show --}}
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="javascript:void(0);" onclick="editUser({{ $user->id }})">
                                {{-- Update --}}
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="showSweetAlert('{{ route('users.destroy', $user->id) }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                            <form id="deleteForm" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                        
                        <tr class="showData">
                            <td colspan="7">
                                <div class="details-div" id="details_{{ $user->id }}" style="display: none;"></div>
                            </td>
                        </tr>
                    </tr>
                @endforeach
            </tbody>
        </table>
                </div>
            </div>
        </div>
    @endif
    
</div>

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


    function showUserDetails(userId) {
        if ($('#details_' + userId).is(':visible')) {
            $('#details_' + userId).hide();
        } else {
            $.get(`/users/${userId}`, function (data) {
                $('.details-div').hide();
                $('#details_' + userId).html(data).show();
            });
        }
    }

    function editUser(id) {
        $.get(`/users/${id}/edit`, function (data) {
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
      {!! $users->links() !!}  
    </nav>    
  </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

