<!DOCTYPE html>
<html>
<head>
    <title>Show Tourist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        p {
            text-align: justify;
            text-justify: inter-word;
            font-size: 14px;
            margin: 0; 
            line-height: 2; 
        }
        .description {
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <header class="bg-light text-dark">
        <h1 class="display-4">Tourguide Details</h1>
    </header>
    <div class="container w-75">
        <div class="card p-3 shadow ">
            <div class="card-content ">
                <h2>ID: {{ $tourguide['id'] }}</h2>
                <p>Name: {{ $user['name'] }}</p>
                <p><strong>Birth Date:</strong> {{ $tourguide['birth_date'] }}</p>
                <p><strong>Bio:</strong> {{ $tourguide['bio'] }}</p>
                <div class="description">
                    <p><strong>Description:</strong></p>
                    <?php
                    $description = $tourguide['description'];
                    $words = explode(' ', $description); 
                    $wordCount = count($words);
                    $wordsPerLine = 10; 
                    $lines = ceil($wordCount / $wordsPerLine);

                    for ($i = 0; $i < $lines; $i++) {
                        echo '<p>';
                        for ($j = 0; $j < $wordsPerLine; $j++) {
                            $wordIndex = $i * $wordsPerLine + $j;
                            if ($wordIndex < $wordCount) {
                                echo $words[$wordIndex] . ' ';
                            }
                        }
                        echo '</p>';
                    }
                    ?>
                </div>
                <p><strong>Gender:</strong> {{ $tourguide['gender'] }}</p>
                <p><strong>Phone:</strong> {{ $tourguide['phone'] }}</p>
                <div class="row">
                    
                    <div class="col-6">
                        <p><strong>Avatar:</strong></p>
                        @if (Str::startsWith($tourguide['avatar'], 'http'))
                        <img src="{{ $tourguide['avatar'] }}" alt="Avatar" class="img-thumbnail w-50">
                        @else
                        <img src="{{ asset('img/' . $tourguide['avatar'])}}" alt="Avatar" class="img-thumbnail w-50">

                        @endif
                    </div>
                    <div class="col-6">
                        <p><strong>Profile Image:</strong></p>
                        @if (Str::startsWith($tourguide['profile_img'], 'http'))
                        <img src="{{ $tourguide['profile_img'] }}" alt="Avatar" class="img-thumbnail w-50">
                        @else
                        <img src="{{ asset('img/' . $tourguide['profile_img'])}}" alt="Avatar" class="img-thumbnail w-50">

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


