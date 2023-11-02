<!DOCTYPE html>
<html>
<head>
    <title>Tourguides</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #2b2a2a;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #3b3b3b;
        }
    </style>
</head>
<body>
    <h1>Tourguides</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                {{-- <th>Name</th>
                <th>Type</th>
                <th>Email</th> --}}
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Bio</th>
                <th>Description</th>
                <th>Avatar</th>
                <th>Profile Image</th>
                <th>Day Price</th>
                <th>Phone</th>
                <th>Languages</th>
                <th>Average Stars</th>
            </tr>
        </thead>
        <tbody>
         
            @foreach ($tourguides as $tourguide)
                <tr>
                    <td>{{ $tourguide['id'] }}</td>
                    {{-- <td>{{ $tourguide['name'] }}</td>
                    <td>{{ $tourguide['type'] }}</td>
                    <td>{{ $tourguide['email'] }}</td> --}}
                    <td>{{ $tourguide['gender'] }}</td>
                    <td>{{ $tourguide['birth_date'] }}</td>
                    <td>{{ $tourguide['bio'] }}</td>
                    <td>{{ $tourguide['description'] }}</td>
                    <td><img src="{{ $tourguide->avatar }}" alt="Avatar" style="width: 50px; height: 50px;"></td>
<td><img src="{{ $tourguide->profile_img }}" alt="Profile Image" style="width: 50px; height: 50px;"></td>

                        <td>{{ $tourguide['day_price'] }}</td>
                    <td>{{ $tourguide['phone'] }}</td>
                    <td>
                        <ul>
                            @foreach ($tourguide['languages'] as $language)
                                <li>{{ $language }}</li>
                            @endforeach
                        </ul>
                    </td>
                    {{-- <td>{{ $tourguide['reviews']['avg'] }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
