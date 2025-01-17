<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>islameapp</title>
  <link href="/image/WIthColor_logo.png" rel="icon">
  <link href="/image/WIthColor_logo.png" rel="apple-touch-icon">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/832a5a0186.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/css/Headfoot.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">
    <style>
     
        /* sidebar */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }



        @media screen and (max-height: 450px) {
            .float-end1{
                display: none !important;
            }
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        /* sidebar */
        .loader-container {
            display: none;
            /* Hide the loader by default */
        }

        @font-face {
            font-family: 'popinsFonts';
            src: url('/Naskh/Poppins-Regular.ttf') format('ttf');
            font-weight: 400;

        }

        .closeNavicon {
            /*display:none;*/
        }

        @media screen and (min-width: 250px) and (max-width: 501px) {
            .float-end1{
                display: none !important;
            }
            .logo-img2 {
                display: none;
            }

            .header {
                border-top-right-radius: 1px !important;
                border-top-left-radius: 1px !important;
            }

            .loader-container {
                display: none !important;
                /* Show the loader for screens <= 500px */
            }

            .Readexpro1 {
                font-family: 'Readex Pro', sans-serif !important;
            }


        }


        .dropdown-item:hover {
    background-color: #069999 !important;
    color: white !important;
    font-size: 20px !important;

    font-weight: 600 !important;
    border: white 2px solid !important;
}

.dropdown-menu {
    max-width: 20%;
    margin-right: 10; /* Adjusted to align the menu properly */
    margin-top: 4px !important;
    width: auto; /* Set width to auto to fit content */
    min-width: 150px; /* Optional: Set a minimum width for better readability */
    border: white 5px solid !important;

}


        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(5px);
            }

            50% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }

            100% {
                transform: translateX(-5px);
            }
        }

        .shake-button {
            animation: shake 2s ease infinite;
        }
      
    </style>
</head>

<body>
    <header class="header fixed-top flex-fill"
        style="
        background: linear-gradient(to bottom, #006d74, #02904c);
        height: 80px;
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
      ">
        <div class="container-fluid">
            <div class="row">
                {{-- sidepanel --}}
              
                <div class="col-4">
                    <div id="mySidenav" style="background: linear-gradient(to top, #006d74, #02904c)" class="sidenav">
                        <img class="img4" src="/image/WIthColor_logo.png"
                            style="
                  width: 60px;
                  height: 60px;
                  border-radius: 30px;
margin-top:-60px;
                  margin-left: 80px;
                "
                            alt="" />

                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                        </a>

                        <a class="Readexpro1" href="{{ url('/islame') }}"
                            style="color: white;font-family: 'Readex Pro', sans-serif;


    ">home</a>
                        <a class="nav-link   Readexpro1" style="color: white" aria-current="page"
                            href="{{ url('/') }}">about</a>

                        <a class="nav-link  Readexpro1 "
                            style="color: white;font-family: 'Readex Pro', sans-serif;"
                            href="{{ url('/Quran-surah') }}">servics</a>

                        <a class="Readexpro1" href="{{ url('/blogpage') }}"
                            style="color: white;font-family: 'Readex Pro', sans-serif;">blog</a>
                        <!--<a href="{{ url('/term-and-condition') }}" style="color: white">Condition</a>-->

                        <a class="Readexpro1" href="{{ url('/privecy-policy') }}"
                            style="color: white;font-family: 'Readex Pro', sans-serif;


">Policy</a>
                        <a class-"Readexpro1" href="{{ url('/About') }}"
                            style="color: white;font-family: 'Readex Pro', sans-serif;


">term</a>
                    </div>
                    <button class="openbtn"
                        style="
                background: linear-gradient(to bottom, #006d74, #02904c);
                font-size: 26px;
                margin-top: 14px;
              "
                        onclick="openNav()">
                        &#9776;
                    </button>
                    <button class="navbar-toggler btn-lg" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><a href="{{ url('/') }}"></button>

                    <img class="img4 logo-img2" src="/image/WIthColor_logo.png"
                        style="
                width: 50px;
                height: 50px;
                border-radius: 30px;
                color: blue;
                margin-top: -20px;
                margin-left: -20px;
              "
                        alt="" />
                </div>
                {{-- sidepanel --}}

                <div class="col-5">
                    <center>
                        <nav class="navbar navbar-expand-lg" style="margin-left: 130px">
                            <div class="navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">

                                    <li class="nav-item me-5 ww" onclick="active('nav3')">
                                        <a class="nav-link computer-resp Readexpro1" id="nav3"
                                            style="
                          font-size: 20px;
                          margin-top: 10px;
                          font-weight: 300;
                          color: white;
                       font-family: 'Readex Pro', sans-serif;
                        "
                                            href="{{ url('/featurepage') }}">Features</a>
                                    </li>
                                    {{-- new --}}

                                    <li class="nav-item dropdown me-5 ww">
                                        <a id="nav2"
                                            class="nav-link home1 dropdown-toggle computer-resp Readexpro1"
                                            style="
                                                font-size: 20px;
                                                margin-top: 10px;
                                                font-weight: 300;
                                                color: white;
                                                font-family: 'Readex Pro', sans-serif;
                                            "
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                            onclick="active('nav1')">
                                            Learn
                                        </a>
                                        <ul class="dropdown-menu" style="text-align: left; padding: 0;">
                                            <li>
                                                <a class="dropdown-item Readexpro1"
                                                    style="
                                                    border-left:#006d74 solid 2px;
                                                    margin-top:3%;
                                                        font-family: 'Readex Pro', sans-serif;
                                                        padding-left: 15px; /* Adjust padding to position text from the left */
                                                    "
                                                    href="{{ url('/quaidaapp') }}">Quaida</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item Readexpro1"
                                                    style="
                                                    border-left:#006d74 solid 2px;
                                                    margin-top:2%;
                                                        font-family: 'Readex Pro', sans-serif;
                                                        padding-left: 15px;
                                                    "
                                                    href="{{ url('/quranapp') }}">Quran</a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="nav-item me-5 ww" onclick="active('nav3')">
                                        <a class="nav-link computer-resp Readexpro1" id="nav3"
                                            style="
                          font-size: 20px;
                          margin-top: 10px;
                          font-weight: 300;
                          color: white;
                       font-family: 'Readex Pro', sans-serif;
                        "
                                            href="{{ url('/qariProfile') }}">Teach</a>
                                    </li>

                                    <li class="nav-item dropdown me-5 ww">
                                        <a id="nav2"
                                            class="nav-link home1 dropdown-toggle computer-resp Readexpro1"
                                            style="
                         font-size: 20px;
                         margin-top: 10px;
                         font-weight: 300;
                         color: white;
                       font-family: 'Readex Pro', sans-serif;
                       "
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                            onclick="active('nav1')">
                                            Company
                                        </a>
                                        <ul class="dropdown-menu" style="text-align: left; padding: 0;">

                                                <li>
                                                    <a class="dropdown-item Readexpro1"
                                                        style="
                                                        border-left:#006d74 solid 5px;
                                                        padding-left: 15px;
                                                        margin-top:3%;
                                                        font-family: 'Readex Pro', sans-serif;"
                                                        href="{{ url('/aboutpage') }}">About</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item Readexpro1"
                                                        style="
                                                         border-left:#006d74 solid 5px;
                                                         margin-top:3%;
                                                          padding-left: 15px;

                                                        font-family: 'Readex Pro', sans-serif;"
                                                        href="{{ url('/servics') }}">Servics</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item Readexpro1"
                                                        style="
                                                         border-left:#006d74 solid 5px;
                                                         padding-left: 15px;
                                                        margin-top:3%;

                                                        font-family: 'Readex Pro', sans-serif;"
                                                        href="{{ url('/blogpage') }}">Blog</a>
                                                </li>


                                        </ul>
                                    </li>
                                    <button class=" btn btn-sm float-end1 download1  Readexpro1"
                                        style="
                  background-color: white;
                  margin-top: 8px;
                  border: white solid 1px;
                  border-radius: 26px;
                  margin-left: 1%;
                  width: 150px !important;
                  font-size: 23px;

                  font-weight: 600;
                  height: 49px;
                  color: #006d74;
                  font-family: 'Readex Pro', sans-serif;
              ">
                                        <a style="color:#006d74; text-decoration: none; background-color:white;"
                                            href="https://play.google.com/store/apps/details?id=com.app.islame">Support</a>
                                    </button>
                                </ul>
                            </div>
                        </nav>
                    </center>
                </div>
                <div class="col-3">

                    <button class="btn btn-sm float-end download    Readexpro1"
                        style="
           background:none;
            margin-top: 15px;
            border: white solid 1px;
            border-radius: 28px;
            margin-left: 40%;
            width: auto;
            font-size: 19px;
            font-weight: 600;
            height: 49px;
            color: white;
            font-family: 'Readex Pro', sans-serif;
        ">
                        <a style="color:white; text-decoration: none;     "
                            href="https://play.google.com/store/apps/details?id=com.app.islame">Download the App</a>
                    </button>
                </div>

            </div>
        </div>
    </header>

    
       <script>
           function openNav() {
            document.getElementById("mySidenav").style.width = "225px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
