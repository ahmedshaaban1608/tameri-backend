<!DOCTYPE html>
<html>
<head>
    <title>Tourists Data</title>
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
        <!-- Your other includes and content here -->
    
        @if(isset($tourists))
            <div id="displayTouristDetails"></div> 
            <h2>Tourists Data</h2>
            <table>
                <thead>
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
                                    <a class="action-button show-button" href="javascript:void(0);" onclick="showTouristDetails({{ $tourist['id'] }})">
                                        Show
                                    </a>
                                <td>
                                    <a  href="javascript:void(0);" class="action-button update-button" onclick="editTourist({{ $tourist['id'] }})">Update</a>
                                </td>
                                
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop" onclick="setDeleteUrl('{{ route('tourists.destroy', $tourist->id) }}')"> Delete</button>
                                </td>
                                
                                <tr>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
