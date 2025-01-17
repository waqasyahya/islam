<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

/* Base Styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body, html {
    height: 100%;
    width: 100%;
    font-family: Arial, sans-serif;
    line-height: 1.6;
}

/* Universal Container Styling */
.container {
    width: 90%; /* 90% of the viewport width */
    height: 60vh; /* 60% of the viewport height */
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

/* Text Styling */
.text {
    font-size: 5vw; /* 5% of the viewport width */
    text-align: center;
    line-height: 1.2;
}

/* Responsive Adjustments Using Media Queries */
@media (min-width: 220px) and (max-width: 319px) {
    .container {
        width: 95%;
        height: 50vh;
    }

    .text {
        font-size: 6vw;
    }
}

@media (min-width: 320px) and (max-width: 479px) {
    .container {
        width: 90%;
        height: 55vh;
    }

    .text {
        font-size: 5.5vw;
    }
}

@media (min-width: 480px) and (max-width: 767px) {
    .container {
        width: 85%;
        height: 60vh;
    }

    .text {
        font-size: 5vw;
    }
}

@media (min-width: 768px) and (max-width: 1023px) {
    .container {
        width: 80%;
        height: 65vh;
    }

    .text {
        font-size: 4.5vw;
    }
}

@media (min-width: 1024px) and (max-width: 1199px) {
    .container {
        width: 75%;
        height: 70vh;
    }

    .text {
        font-size: 4vw;
    }
}

@media (min-width: 1200px) and (max-width: 1799px) {
    .container {
        width: 70%;
        height: 75vh;
    }

    .text {
        font-size: 3.5vw;
    }
}

@media (min-width: 1800px) {
    .container {
        width: 65%;
        height: 80vh;
    }

    .text {
        font-size: 3vw;
    }
}


    </style>
</head>
<body>
    <div class="container" style="background-color: red">
        <p class="text">This is a responsive container.</p>
    </div>
    <div class="container" style="background-color: red">
        <p class="text">This is a responsive container.</p>
    </div>
</body>
</html>