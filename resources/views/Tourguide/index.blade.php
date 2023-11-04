<!DOCTYPE html>
<html>
<head>
    <title>Tourguides</title>
    <style>
          table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 3px;
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
            
        @if(isset($tourguides))
            <div id="displayTourguideDetails"></div> 
    <table>
    <h1>Tourguides</h1>
    
        <thead>
            <tr>
                <th>ID</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Bio</th>
                {{-- <th>Description</th> --}}
                <th>Avatar</th>
                <th>Profile Image</th>
                <th>Day Price</th>
                <th>Phone</th>
                <th>Show</th>
                <th>Update</th>
                <th>Delete</th>
              
            </tr>
        </thead>
        <tbody>
         
            @foreach ($tourguides as $tourguide)
                <tr>
                    <td>{{ $tourguide['id'] }}</td>
                    <td>{{ $tourguide['gender'] }}</td>
                    <td>{{ $tourguide['birth_date'] }}</td>
                    <td>{{ $tourguide['bio'] }}</td>
                    {{-- <td>{{ $tourguide['description'] }}</td> --}}
                    <td><img src="{{ $tourguide->avatar }}" alt="Avatar" style="width: 50px; height: 50px;"></td>
<td><img src="{{ $tourguide->profile_img }}" alt="Profile Image" style="width: 50px; height: 50px;"></td>

                        <td>{{ $tourguide['day_price'] }}</td>
                    <td>{{ $tourguide['phone'] }}</td>

                    <td>
                        <a class="action-button show-button btn btn-primary" href="javascript:void(0);" onclick="showTourguideDetails({{ $tourguide->id }})">
                            Show
                        </a>
                    </td>
                  
                      
                    <td>
                        
                        <a  href="javascript:void(0);" class="action-button update-button" onclick="editTourguide({{ $tourguide['id'] }})">Update</a>
                    </td>
                    
                        <td>
                            <form id="delete-form-{{ $tourguide['id'] }}" action="{{ route('tourguides.destroy', $tourguide['id']) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="btn btn-danger" href="#" onclick="showConfirmation({{ $tourguide['id'] }})">Delete</a>
                        </td>
                        <tr>
                            <td colspan="12">
                                <div class="details-div" id="details_{{ $tourguide['id'] }}" style="display: none;"></div>
                            </td>
                        </tr>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showTourguideDetails(tourguideId) {
            if ($('#details_' + tourguideId).is(':visible')) {
                $('#details_' + tourguideId).hide();
            } else {
                $.get(`/tourguides/${tourguideId}`, function (data) {
                    $('.details-div').hide();
                    $('#details_' + tourguideId).html(data).show();
                });
            }
        }

        function editTourguide(id) {
            $.get(`/tourguides/${id}/edit`, function (data) {
                $('.details-div').hide();
                $('#details_' + id).html(data).show();
            });
        }

        function showConfirmation(id) {
            if (confirm('Are you sure you want to delete this tourguide?')) {
                document.querySelector(`form[action$="/tourguides/${id}"]`).submit();
            } else {
                return false;
            }
        }
</script>



</body>
</html>
