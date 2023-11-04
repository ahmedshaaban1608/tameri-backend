<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            color: #333;
        }
        
        .editt {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        
        input[type="text"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <h2>Edit Review</h2>

    <form class="editt" action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="title" id="title" name="title" value="{{ $review['title'] }}">

        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment" value="{{ $review['comment'] }}">

       
        {{-- <label for="avatar">Avatar:</label>
        <input type="text" id="avatar" name="avatar" value="{{ $tourist['avatar'] }}">

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ $tourist['phone'] }}"> --}}
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
