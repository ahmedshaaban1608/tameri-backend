

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
    </style>
</head>
<body>

{{-- @if(count($users) > 0) --}}
    <div>
        <h2>User Data</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->type }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
{{-- @else
    <p>No users found.</p>
@endif --}}


</body>

</html>
