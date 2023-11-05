

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-color: #f4f4f4; */
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #3f3e3e;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #353434;
        }
        th {
            background-color: #363434;
        }
        tr:nth-child(even) {
            background-color: #2e2d2d;
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

{{-- @if(count($users) > 0) --}}
   
        <div class="content-wrapper">
            
            @if(isset($users))
                <div id="displayUserDetails"></div> 
        <table>
            <thead>
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
                        <a class="action-button show-button btn btn-primary" href="javascript:void(0);" onclick="showUserDetails({{ $user->id }})">
                            Show
                        </a>
                    </td>
                    
                    
                        <td>
                            <a  href="javascript:void(0);" class="action-button update-button" onclick="editUser({{ $user['id'] }})">Update</a>
                        </td>
                     
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop" onclick="setDeleteUrl('{{ route('users.destroy', $user->id) }}')"> Delete</button>
                        </td>
                        
                        
            <tr>
                <td colspan="7">
                    <div class="details-div" id="details_{{ $user['id'] }}" style="display: none;"></div>
                </td>
            </tr>
                    </tr>
                @endforeach
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>
