
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
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Tourists Data</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            {{-- <th>Name</th>
            <th>Type</th>
            <th>Email</th> --}}
            <th>Country</th>
            <th>Gender</th>
            <th>Avatar</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @isset($tourists)
            @foreach($tourists as $tourist)
                <tr>
                    <td>{{ $tourist['id'] }}</td>
                    {{-- <td>{{ $tourist['name'] }}</td>
                    <td>{{ $tourist['type'] }}</td>
                    <td>{{ $tourist['email'] }}</td> --}}
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
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">No tourists data available</td>
            </tr>
        @endisset
    </tbody>
</table>

</body>
</html>
