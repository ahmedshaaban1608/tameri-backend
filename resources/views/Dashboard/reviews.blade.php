<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reviews</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tourist Name</th>
                <th>Tourist Avatar</th>
                <th>Tourguide Name</th>
                <th>Title</th>
                <th>Comment</th>
                <th>Stars</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @isset($reviews)
            @foreach ($reviews as $review)
    <tr>
        <td>{{ $review->id }}</td>
        <td>{{ $review->tourist->id}}</td>
        <td><img src="{{ $review->tourist->avatar }}" alt="Avatar" style="width: 50px; height: 50px;"></td>
        <td>{{ $review->tourguide->id }}</td>
        <td>{{ $review->title }}</td>
        <td>{{ $review->comment }}</td>
        <td>{{ $review->stars }}</td>
        <td>{{ $review->status }}</td>
        <td>{{ $review->created_at }}</td>
    </tr>
@endforeach
@endisset

        </tbody>
    </table>
</body>
</html>
