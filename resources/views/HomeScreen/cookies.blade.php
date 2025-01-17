<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>
<style>
    .banner {
        position: fixed;
        bottom: -75px; 
        left: 0;
        width: 100%;
        height: 60px !important;
        transition: bottom 1.5s ease-in-out; 
        z-index: 99;
    }

    .banner.show {
        bottom: 60px; /* Slide up to show */
    }

    .banner .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        background: linear-gradient(to bottom, #006d74, #02904c);
        border: none;
        font-size: 20px;
        color: #fff;
        width: 70px;
        height: 30px;
    }

    .cookies-app {
        height: 50% !important;
        border-radius: 0 !important;
    }

    .cook {
        border: #006d74 solid 5px;
        border-radius: 0 !important; /* Remove border-radius from custom class */
    }

    .text-img {
        background-image: url("/image/WIthColor_logo.png");
        background-size: contain;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<?php if (!Cookie::has('banner_cookie')): ?>
<div class="banner shadow-lg">
    <div class="card w-100 cook">
        <div class="cookies-app">
            <center>
                <h3 class="text-img">Cookies</h3>
            </center>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem rerum accusantium doloribus quidem dolorum repudiandae natus, qui asperiores autem quibusdam.waqas yahyah yehdgdt gdhfyr bcnhb fhvnbcy</p>
            <button onclick="dismissBanner()" class="btn btn-sm float-end download Readexpro1"
                style="
                    margin-top: 15px;
                    border: white solid 1px;
                    width: 200px;
                    font-size: 19px;
                    font-weight: 600;
                    height: 49px;
                    color: white;
                    background: linear-gradient(to bottom, #006d74, #02904c);
                    font-family: 'Readex Pro', sans-serif;">
                <a style="color:white; text-decoration: none;" href="https://play.google.com/store/apps/details?id=com.app.islame">Download the App</a>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    function dismissBanner() {
        sessionStorage.setItem('bannerDismissed', 'true');
        document.querySelector('.banner').classList.remove('show');
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (!sessionStorage.getItem('bannerDismissed')) {
            // Show banner after 2.5 seconds
            setTimeout(function() {
                document.querySelector('.banner').classList.add('show');
                
                // Automatically hide banner after 2 seconds if no interaction
                setTimeout(function() {
                    dismissBanner();
                }, 6000); // 2 seconds delay before hiding
            }, 2500); 
        }
    });
</script>
