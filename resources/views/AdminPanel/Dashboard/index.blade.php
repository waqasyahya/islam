@extends('layouts.app')
@section('title')
    DashBoard
@endsection
@section('page-header')

    <head>
        <link href="vendor1/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Custom styles for this template-->
        <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <style>
        .progress {
            height: 20px;
            margin-bottom: 10px;
        }

        .progress-bar {
            background-color: #4CAF50;
            /* Green color */
            color: white;
            text-align: center;
            line-height: 20px;
            /* Align text vertically */
        }
    </style>
    <div class="page-header ">
        <div class="page-leftheader">

        </div>
    </div>
    <!-- END PAGE HEADER -->
@endsection

@section('content')
    <div id="splash-screen" class="splash">
        <!-- Splash screen content -->
        <div class="splash-content">
            <div class="logo-spinner-container">
                <img src="/image/WIthColor_logo.png" alt="Logo" width="125">
                <div class="spinner-border text-primary spinner-overlay" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    <div id="app">
        <div id="wrapper" style="margin-top:-60px;">

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
                        style="margin-top:18px;">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->

                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                {{-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> --}}
                                <a href="/send-email" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                        class="fas fa-download fa-sm text-white-50"></i>Send Email</a>
                            </div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">

                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    CEO & FOUNDER</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                    style="font-size: 16px;">Qamar Chishti</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    CTO & CO-FOUNDER</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                    style="font-size: 16px;">Waqas Yahya</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    PROJECT MANAGER</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                    style="font-size: 16px;">ZIA UR REHMAN</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    APP DEVELOPER</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                    style="font-size: 16px;">ZAIN UL ABDIN</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->

                        <div class="row">

                            <!-- Area Chart -->
                            <div class="col-xl-8 col-lg-7">
                                <div class="card shadow mb-4">

                                </div>
                            </div>
                            <div class="container">
                                <canvas id="visitsChart"></canvas>
                            </div>

                            <div id="progressBarsContainer"></div>

                            <!-- Pie Chart -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">

                                </div>
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <style>
            .splash {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #ffffff;
                /* Adjust as needed */
                z-index: 9999;
                /* Ensure it's above other content */
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .splash-content {
                position: relative;
            }

            .logo-spinner-container {
                position: relative;
                display: inline-block;
            }

            .spinner-overlay {
                width: 50px;
                height: 50px;
                position: absolute;
                top: 30%;
                left: 30%;
                border: 4px solid transparent;
                border-top-color: white;
                /* First color */
                border-right-color: green;
                /* Second color */
                border-left-color: greenyellow;
                /* Second color */
                border-bottom-color: black;
                /* Second color */
                border-radius: 50%;
                animation: spin 1s linear infinite;

            }
        </style>

        <!-- JavaScript to show splash screen for 5 seconds -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Show splash screen
                var splashScreen = document.getElementById('splash-screen');
                splashScreen.style.display = 'flex'; // Show splash screen
                // Hide splash screen after 5 seconds
                setTimeout(function() {
                    splashScreen.style.display = 'none';
                }, 1000); // 5000 milliseconds = 5 seconds
            });
        </script>
        <script src="vendor1/jquery/jquery.min.js"></script>
        <script src="vendor1/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor1/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor1/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

        <script>
            // Fetch visits data from your Laravel API
            fetch('/api/visits')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(visit => visit.date);
                    const visits = data.map(visit => visit.visits);
                    const countries = data.map(visit => visit.country);
                    const cities = data.map(visit => visit.city);
                    const longitudes = data.map(visit => visit.longitude);
                    const latitudes = data.map(visit => visit.latitude);
                    // Prepare dataset
                    const chartData = {
                        labels: labels,
                        datasets: [{
                            label: 'Number of Users',
                            data: visits,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        }]
                    };
                    // Create the chart
                    const ctx = document.getElementById('visitsChart').getContext('2d');
                    const visitsChart = new Chart(ctx, {
                        type: 'line',
                        data: chartData,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        title: function(tooltipItems) {
                                            return `Date: ${tooltipItems[0].label}`;
                                        },
                                        label: function(tooltipItem) {
                                            return `Visits: ${tooltipItem.raw}`;
                                        },
                                        afterLabel: function(tooltipItem) {
                                            const index = tooltipItem.dataIndex;
                                            return [
                                                `Country: ${countries[index]}`,
                                                `City: ${cities[index]}`,
                                                `Latitude: ${latitudes[index]}`,
                                                `Longitude: ${longitudes[index]}`
                                            ];
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        </script>

        <script>
            // Fetch progress data from your Laravel API
            fetch('/api/progress')
                .then(response => response.json())
                .then(data => {
                    const progressBarsContainer = document.getElementById('progressBarsContainer');
                    progressBarsContainer.innerHTML = data.map(visit => `
                <div>
                    <strong>Date: ${visit.date} - ${visit.visits} Visits</strong>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: ${visit.percentage}%;" aria-valuenow="${visit.percentage}" aria-valuemin="0" aria-valuemax="100">${visit.percentage}%</div>
                    </div>
                </div>
            `).join('');
                });
        </script>
    @endsection
