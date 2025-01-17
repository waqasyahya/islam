@extends('Homescreen.Header-Layout')
@include('Homescreen.cookies')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/css/main.css" rel="stylesheet">
    <title>islameapp</title>
    <link href="/image/WIthColor_logo.png" rel="icon">
    <link href="/image/WIthColor_logo.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/Islame.css" />
    <link rel="stylesheet" href="/css/islameapp.css" />
</head>

<body>



  



    <div style="height:83px;width:100%" class="height-from-top"></div>

    <div class="carousel-container">
        <div class="mySlides w3-animate-opacity">
            <div class="top-caption-container" style="background-color: #006d74; height:50px;border-radius:10px;">
                <p>Top Text for Image 1</p>
            </div>
            <img src="/image/practice12.png" alt="Image 1">
            <div class="caption-container">
                <p>Text for Image 1</p>
                <button>Button 1</button>
            </div>
        </div>
        <div class="mySlides w3-animate-opacity">
            <div class="top-caption-container" style="background-color: #006d74; height:50px;border-radius:10px;">
                <p>Top Text for Image 1</p>
            </div>
            <img src="/image/1699293828.png" alt="Image 2">
            <div class="caption-container">
                <p>Text for Image 2</p>
                <button>Button 2</button>
            </div>
        </div>
        <div class="mySlides w3-animate-opacity  ">
            <div class="top-caption-container" style="background-color: #006d74; height:50px;border-radius:10px;">
                <p>Top Text for Image 1</p>
            </div>
            <img src="/image/1699293895.png" alt="Image 3">
            <div class="caption-container">
                <p style="color: black">Text for Image 3</p>
                <button>Button 3</button>
            </div>
        </div>
        <!-- Add more slides as needed -->
    </div>
    @if ($data)
        <div class="" style="height: 80px"></div>
        <div class="card-row">
            <div class="w3-card-2 card">
                <div class="w3-display-container w3-text-white">
                    <img src="/image/WIthColor_logo.png" alt="Lights" style="width:100px; height:100px;">
                    <h4 class="w3-center w3-padding-24" style="color: black">Hadith of the Day</h4>
                    <h5 class="w3-left-align w3-animate-left" style="color: black; padding-left:5%;">
                        {{ $data->Hadith_Name }}</h5>
                    <h5 class="w3-left-align w3-animate-left" style="color: black; padding-left:5%;">
                        {{ $data->Hadith_Referance }}</h5>
                    <p style="color: black; padding:4%; font-size:19px;">{{ $data->Hadith_Arabic }}</p>
                    <hr style="border:0px; height:1px;background-color:#006d74; width:90%; margin-left:5%;">
                    <p style="color: black; padding:4%; font-size:19px;">{{ $data->Hadith_Translate }}</p>


                </div>
            </div>
            <div class="w3-card-2 card">
                <div class="w3-display-container w3-text-white" style="min-height: 100px;height:auto;">
                    <img src="/image/WIthColor_logo.png" alt="Lights" style="width:100px; height:100px;">
                    <h4 class="w3-center w3-padding-24" style="color: black">Ayat of the Day</h4>
                    <h5 class="w3-left-align w3-animate-left" style="color: black; padding-left:5%;">
                        {{ $data->Ayat_Name }}</h5>
                    <h5 class="w3-left-align w3-animate-left" style="color: black; padding-left:5%;">
                        {{ $data->Ayat_Referance }}</h5>
                    <p style="color: black; padding:4%; font-size:19px;">{{ $data->Ayat_Arabic }}</p>
                    <hr style="border:0px; height:1px;background-color:#006d74; width:90%; margin-left:5%;">
                    <p style="color: black; padding:4%; font-size:19px;">{{ $data->Ayat_Translate }}</p>

                </div>
            </div>
        </div>
    @else
        <p>No data available for today.</p>
    @endif
    {{-- card --}}

    @if($events->isNotEmpty())
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($events as $event)
                        <p style="color: black">{{ $event->message }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    $(document).ready(function() {
        // Show the modal when the page loads
        $('#eventModal').modal('show');

        // Automatically hide the modal after 5 seconds
        setTimeout(function() {
            $('#eventModal').modal('hide');
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>


    <div id="preloader"></div>
    @include('Homescreen.Footer-Layout')


    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        var slideIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > x.length) {
                slideIndex = 1
            }
            x[slideIndex - 1].style.display = "block";
            setTimeout(carousel, 13500); // Change image every 2 seconds
        }
    </script>
</body>

</html>
