

<!DOCTYPE html>
<html lang="en">

<head>
    <title>order Data</title>
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
    </style>
</head>
<body>

    <div class="container">
        <h1>Orders Data</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tourist Name</th>
                    <th>Tourguide Name</th>
                    <th>Status</th>
                    <th>Comment</th>
                    <th>Phone</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>City</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->tourist_id }}</td>
                        <td>{{ $order->tourguide_id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->comment }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->from }}</td>
                        <td>{{ $order->to }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->city }}</td>
                        <td>{{ $order->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
