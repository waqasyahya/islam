@extends('HomeScreen.Header-Layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<div style="margin-top:200px"></div>
<div class="container-fluid " style="border: 3px solid black; width:80%; height:100%; margin-top:-100px;">

<div id="demo" class="carousel slide" data-ride="carousel" data-interval="1000"> <!-- Set interval to 1000ms (1 second) -->


    <div class="carousel-inner" id="content">


            @if ($data)
                <div class="field">
                    <span class="field-label">Words in Arabic:</span>
                    <span class="field-value">{{ $data->Words_Arabic ?? 'N/A' }}</span>
                </div>
                <div class="field">
                    <span class="field-label">ID:</span>
                    <span class="field-value">{{ $data->Quaida_id }}</span>
                </div>
                <div class="field">
                    <span class="field-label">Audio:</span>
                    <a href="{{ $data->audio1 }}" target="_blank" class="field-value">Play Audio</a>
                </div>
                <div class="field">
                    <span class="field-label">File Type:</span>
                    <span class="field-value">{{ $data->file_type ?? 'Unknown' }}</span>
                </div>
            @else
                <p>No data found for this Quaida ID and specific ID.</p>
            @endif

    </div>
    </div>


<!-- Left and right controls -->
<div id="controls">
    <a class="carousel-control-prev" onclick="location.href='?id={{ $prevId }}'" style="background-color: blue; width:5%;height:50%;margin-top:100px;" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo"     style="background-color: blue; width:5%;height:50%;margin-top:100px;" onclick="location.href='?id={{ $nextId }}'" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
</div>
</body>
</html>
