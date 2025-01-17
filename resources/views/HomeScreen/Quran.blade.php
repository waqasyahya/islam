@extends('HomeScreen.Header-Layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">


    <style>

@font-face {
    font-family: 'NashkFonts';
    src: url('/Naskh/JameelNooriNastaleeq.woff2') format('woff2');
    font-weight: 400;

 }
           body{
        background-color:whitesmoke !important;
    }
        .card-container {
            position: relative;
            width: 80%;
            margin: auto;
        }
        .card-link {
            display: block;
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }
        .card-body {
            position: relative;
            z-index: 2;
        }
        .heart-icon {
            z-index: 3; /* Ensure the heart icon is above the clickable link */
        }
        .circle-background {
        background-color: #006d74; /* Background color of the circle */
        color: white; /* Text color */
        border-radius: 50%; /* Makes the background circular */
        width: 35px; /* Width of the circle */
        height: 35px; /* Height of the circle */
        display: flex; /* Center the text */
        align-items: center; /* Center the text vertically */
        justify-content: center; /* Center the text horizontally */
        font-size: 14px; /* Font size of the ID */

    }
    </style>
</head>
<body>

<div class="" style="margin-top:120px;"></div>

<div class="container">
    @foreach($data as $item)
        <a href="{{ url('quran-detail/' . $item->id) }}" style="text-decoration: none; color: inherit;">
            <div class="card shadow-lg mb-4 card-container">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-left" style="margin-top: 2%;">
                            <div class="circle-background">
                                <p style="font-size: 18px; margin: 0;">{{ $item->id }}</p> <!-- ID -->
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <p style="font-size: 35px; font-family: NashkFonts;">{{ $item->Quran_Name ?? $item->Quaida_Name }}</p> <!-- Name -->
                            <p style="font-size: 15px; color: gray; font-family: NashkFonts;">{{ $item->Quran_Words ?? $item->Quaida_Words }}</p> <!-- Words -->
                        </div>
                        <div class="col-3 text-right" style="margin-top: 2%;">
                            <i class="fa fa-heart heart-icon" id="heart-{{ $item->id }}"
                               onclick="toggleBookmark(event, {{ $item->id }}, '{{ $item->Quran_Name ? 'quran' : 'quaida' }}')"
                               style="color: #006d74; font-size: 30px; cursor: pointer;"></i> <!-- Heart icon with dynamic color -->
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>


<!-- Add Font Awesome CDN for the heart icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- JavaScript to toggle bookmark -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Check localStorage and update icon color on page load
    document.querySelectorAll('.heart-icon').forEach(function(icon) {
        const itemId = icon.id.split('-')[1]; // This will extract the ID from the heart icon
        const bookmarked = localStorage.getItem('bookmark-' + itemId) === 'true';
        icon.style.color = bookmarked ? 'black' : '#006d74'; // Set color based on bookmark status
    });
});

function toggleBookmark(event, itemId, type) {
    event.preventDefault();
    event.stopPropagation(); // Stop click event from propagating to <a> tag

    // Prepare the correct data (either quran_id or quaida_id) based on the type
    let data = {};
    if (type === 'quran') {
        data.quran_id = itemId;
    } else if (type === 'quaida') {
        data.quaida_id = itemId;
    }

    console.log(data); // Log the data to ensure it's correct

    $.ajax({
        url: '{{ route("bookmark.toggle") }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Get CSRF token from meta tag
        },
        data: data,
        success: function(response) {
            const heartIcon = document.getElementById('heart-' + itemId);
            if (response.status === 'added') {
                heartIcon.style.color = '#87ceeb'; // Change color when bookmarked
                localStorage.setItem('bookmark-' + itemId, 'true'); // Save status to localStorage
            } else if (response.status === 'removed') {
                heartIcon.style.color = '#006d74'; // Change color when removed from bookmark
                localStorage.setItem('bookmark-' + itemId, 'false'); // Save status to localStorage
            }
        },
        error: function(xhr, status, error) {
            console.error("Error toggling bookmark:", xhr.responseText);
            alert('Error toggling bookmark status.');
        }
    });
}

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
