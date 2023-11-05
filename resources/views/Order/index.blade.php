

<!DOCTYPE html>
<html lang="en">

<head>
    <title>order Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
           
        }

        table, th, td {
            border: 1px solid #ddd;
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
            
        @if(isset($orders))
            <div id="displayOrderDetails"></div> 
    <table>
        <h1>Orders Data</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tourist_ID</th>
                    <th>Tourguide_ID</th>
                    <th>Status</th>
                    {{-- <th>Comment</th> --}}
                    <th>Phone</th>
                    {{-- <th>Start Date</th>
                    <th>End Date</th> --}}
                    <th>Total Price</th>
                    <th>City</th>
                    <th>Show</th>
                    <th>Update</th>
                    <th>Delete</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->tourist_id }}</td>
                        <td>{{ $order->tourguide_id }}</td>
                        <td>{{ $order->status }}</td>
                        {{-- <td>{{ $order->comment }}</td> --}}
                        <td>{{ $order->phone }}</td>
                        {{-- <td>{{ $order->from }}</td>
                        <td>{{ $order->to }}</td> --}}
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->city }}</td>
                       

                        <td>
                            <a class="action-button show-button btn btn-primary" href="javascript:void(0);" onclick="showOrderDetails({{ $order->id }})">
                                Show
                            </a>
                        </td>
                    
                            <td>
                                <a  href="javascript:void(0);" class="action-button update-button" onclick="editOrder({{ $order['id'] }})">Update</a>
                            </td>
                            
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop" onclick="setDeleteUrl('{{ route('orders.destroy', $order->id) }}')"> Delete</button>
                            </td>
                            
                            <tr>
                                <td colspan="13">
                                    <div class="details-div" id="details_{{ $order['id'] }}" style="display: none;"></div>
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
        function showOrderDetails(orderId) {
            if ($('#details_' + orderId).is(':visible')) {
                $('#details_' + orderId).hide();
            } else {
                $.get(`/orders/${orderId}`, function (data) {
                    $('.details-div').hide();
                    $('#details_' + orderId).html(data).show();
                });
            }
        }


        function editOrder(id) {
            $.get(`/orders/${id}/edit`, function (data) {
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
