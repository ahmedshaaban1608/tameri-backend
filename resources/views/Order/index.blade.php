<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <style>
    
        .table-container {
    overflow-x: auto;
    max-width: 100%;
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

    <title>Order Data</title>
</head>

<body>
    <div class="card">
    <div class="container-fluid">
        <h1 class="text-center">Orders Data</h1>
        @if(isset($orders))
        <div id="displayOrderDetails"></div>
        <div class="table-responsive table-container">
            <div class="table-responsive">
            <table class="table table-sm ">
                <thead  class="thead-light font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th>Tourist ID</th>
                        <th>Tourguide ID</th>
                        <th>Status</th>
                        <th>Phone</th>
                        <th>Total Price</th>
                        <th>City</th>
                        <th>Payment</th>
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
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->city }}</td>
                        {{-- <td>{{ $order->payment }}</td> --}}
                        <!-- ... -->
<td>
    @if($order->payment == 'paid')
        <span class="badge bg-success">Paid</span>
    @else
        <span class="badge bg-warning text-dark">Pending</span>
    @endif
</td>

                        <td>
                            <a class="btn btn-success" href="javascript:void(0);" onclick="showOrderDetails({{ $order->id }})">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="javascript:void(0);" onclick="editOrder({{ $order['id'] }})">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="showSweetAlert('{{ route('orders.destroy', $order->id) }}')">
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
                            <div class="details-div" id="details_{{ $order['id'] }}" style="display: none;"></div>
                            <div class="details-content"></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        @endif
    </div>
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
                    // Submit the delete form
                    const deleteForm = document.getElementById('deleteForm');
                    deleteForm.action = url;
                    deleteForm.style.display = 'block';
                    deleteForm.submit();
                }
            });
        }

        function showOrderDetails(orderId) {
            if ($('#details_' + orderId).is(':visible')) {
                $('#details_' + orderId).hide();
            } else {
                $.ajax({
                    url: `/orders/${orderId}`,
                    type: 'GET',
                    success: function (data) {
                        $('.details-div').hide();
                        $('#details_' + orderId).html(data).show();
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
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
    <div class="card-footer border-0 py-5">
        <span class="text-muted text-sm">
          Showing  items 
        </span>
        <nav aria-label="Page navigation example">
          {!! $orders->links() !!}  
        </nav>    
      </div>
</body>

</html>
