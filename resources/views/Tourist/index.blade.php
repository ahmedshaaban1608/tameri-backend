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
                                    <form id="delete-form-{{ $tourist['id'] }}" action="{{ route('tourists.destroy', $tourist['id']) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a class="btn btn-danger" href="#" onclick="showConfirmation({{ $tourist['id'] }})">Delete</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        function showConfirmation(id) {
            if (confirm('Are you sure you want to delete this tourist?')) {
                document.querySelector(`form[action$="/tourists/${id}"]`).submit();
            } else {
                return false;
            }
        }
    </script>
