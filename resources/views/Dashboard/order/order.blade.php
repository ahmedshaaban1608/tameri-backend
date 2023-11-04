

<!DOCTYPE html>
<html lang="en">

<head>
    <title>order Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-left: -50px
        }

        table, th, td {
            border: 1px solid #ddd;
            /* padding: 8px; */
            max-width: 130px;
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
                    <th>Start Date</th>
                    <th>End Date</th>
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
                        <td>{{ $order->from }}</td>
                        <td>{{ $order->to }}</td>
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
                                <form id="delete-form-{{ $order['id'] }}" action="{{ route('orders.destroy', $order['id']) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a class="btn btn-danger" href="#" onclick="showConfirmation({{ $order['id'] }})">Delete</a>
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
   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        function showConfirmation(id) {
            if (confirm('Are you sure you want to delete this order?')) {
                document.querySelector(`form[action$="/orders/${id}"]`).submit();
            } else {
                return false;
            }
        }
    </script>


</body>

</html>
