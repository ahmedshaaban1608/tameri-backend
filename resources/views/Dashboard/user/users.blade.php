

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
                            <form id="delete-form-{{ $user['id'] }}" action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="btn btn-danger" href="#" onclick="showConfirmation({{ $user['id'] }})">Delete</a>
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
{{-- @else
    <p>No users found.</p>
@endif --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        function showConfirmation(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.querySelector(`form[action$="/users/${id}"]`).submit();
            } else {
                return false;
            }
        }

</script>


</body>

</html>
