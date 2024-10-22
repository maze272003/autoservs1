<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client | Book Car</title>
    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('dist/css/booking.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    /* Centering the modal */
    #imageModal {
        display: none;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
    }

    /* Styles for mobile view */
    #modalImage {
        width: 80vw;
        height: auto;
    }

    /* Media query for desktop view */
    @media (min-width: 800px) {
        #modalImage {
            width: 750px;
            height: 900px;
        }
    }

    /* Style for close button */
    #imageModal .close-btn {
        position: absolute;
        top: -5px;
        right: 15px;
        font-size: 40px;
        color: white;
        cursor: pointer;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Dropdown for Profile and Logout -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!-- Profile Link -->
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user"></i> {{ __('Profile') }}
                        </a>

                        <!-- Logout Link -->
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>

                        <!-- Hidden Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/autoservbg.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AUTOSERV</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->profile_image)
                            <!-- Add an onclick event to show the image in the overlay -->
                            <img src="{{ Storage::url(Auth::user()->profile_image) }}"
                                style="height: 40px; width: 40px; border-radius: 50%;" alt="User Image"
                                onclick="openModal('{{ Storage::url(Auth::user()->profile_image) }}')">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Image Modal -->
                <div id="imageModal">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <img id="modalImage" src="" alt="Profile Image">
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    dashboard
                                </p>
                            </a>
                        </li>
                        <!-- BOOK -->
                        <li class="nav-item">
                            <a href="{{ route('book') }}" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Books Car</p>
                            </a>
                        </li>
                        <!-- history -->
                        <li class="nav-item">
                            <a href="{{ route('maintenance') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Maintenance History</p>
                            </a>
                        </li>
                        <!-- PROFILE -->
                        <li class="nav-item">
                            <a href="{{ route('notification') }}" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>Notification</p>
                            </a>
                        </li>
                        <!-- payment -->
                        <li class="nav-item">
                            <a href="{{ route('payment.show') }}" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>Payment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.support') }}" class="nav-link">
                                <i class="nav-icon fas fa-headset"></i>
                                <p>Customer Support</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ratings') }}" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Feedback and Reviews</p>
                            </a>
                        </li>
                        
                    </ul>
            </div>
            </nav>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">BOOK CAR</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Profile</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- content -->
        @if (session('error'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    showCloseButton: true, // Add close button
                    timer: 10000, // Time in milliseconds
                    toast: true
                });
            </script>
        @endif
        <!-- Your booking form -->

        <div class="container">
            <form id="bookingForm" class="row g-3" method="POST" action="{{ route('bookings.store') }}">
                @csrf

                <!-- Car Model -->
                <div class="col-md-4">
                    <label for="carModel" class="form-label">Car Model</label>
                    <select class="form-control" id="carModel" name="carModel" required>
                        <option selected disabled>Choose...</option>
                        <option value="Suzuki Alto">Suzuki Alto</option>
                        <option value="Toyota Vios">Toyota Vios</option>
                        <option value="Mitsubishi Mirage">Mitsubishi Mirage</option>
                        <option value="Honda City">Honda City</option>
                        <option value="Nissan Almera">Nissan Almera</option>
                        <option value="Suzuki Swift">Suzuki Swift</option>
                        <option value="Ford EcoSport">Ford EcoSport</option>
                        <option value="Kia Picanto">Kia Picanto</option>
                        <option value="Toyota Innova">Toyota Innova</option>
                        <option value="Mitsubishi Montero Sport">Mitsubishi Montero Sport</option>
                        <option value="Honda CR-V">Honda CR-V</option>
                        <option value="Nissan Navara">Nissan Navara</option>
                        <option value="Isuzu D-Max">Isuzu D-Max</option>
                        <option value="Toyota Fortuner">Toyota Fortuner</option>
                        <option value="Mitsubishi Strada">Mitsubishi Strada</option>
                        <option value="Hyundai Accent">Hyundai Accent</option>
                        <option value="Toyota Rush">Toyota Rush</option>
                        <option value="Kia Seltos">Kia Seltos</option>
                        <option value="MG ZS">MG ZS</option>
                        <option value="Chevrolet Trailblazer">Chevrolet Trailblazer</option>
                        <option value="Subaru XV">Subaru XV</option>
                        <option value="Honda HR-V">Honda HR-V</option>
                        <option value="Nissan Terra">Nissan Terra</option>
                        <option value="Toyota Hilux">Toyota Hilux</option>
                        <option value="Mitsubishi L300">Mitsubishi L300</option>
                        <option value="Suzuki Ertiga">Suzuki Ertiga</option>
                        <option value="Toyota Avanza">Toyota Avanza</option>
                        <option value="Nissan Juke">Nissan Juke</option>
                        <option value="Chery Tiggo">Chery Tiggo</option>
                        <option value="Foton Thunder">Foton Thunder</option>
                        <option value="Maxus V80">Maxus V80</option>
                        <option value="Geely Coolray">Geely Coolray</option>
                        <option value="Peugeot 3008">Peugeot 3008</option>
                        <option value="Volkswagen Santana">Volkswagen Santana</option>
                        <option value="Hyundai Reina">Hyundai Reina</option>
                        <option value="Nissan Leaf">Nissan Leaf</option>
                        <option value="Kia Stonic">Kia Stonic</option>
                        <option value="Toyota Land Cruiser">Toyota Land Cruiser</option>
                        <option value="Isuzu mu-X">Isuzu mu-X</option>
                        <option value="Mitsubishi Xpander">Mitsubishi Xpander</option>
                        <option value="Honda Mobilio">Honda Mobilio</option>
                        <option value="Chevrolet Tracker">Chevrolet Tracker</option>
                        <option value="MG RX5">MG RX5</option>
                        <option value="Subaru Evoltis">Subaru Evoltis</option>
                        <option value="Mazda BT-50">Mazda BT-50</option>
                        <option value="Ford Ranger">Ford Ranger</option>
                        <option value="Chevrolet Colorado">Chevrolet Colorado</option>
                        <option value="Toyota Tacoma">Toyota Tacoma</option>
                        <option value="Nissan Frontier">Nissan Frontier</option>
                        <option value="Ram 1500">Ram 1500</option>
                        <option value="GMC Sierra 1500">GMC Sierra 1500</option>
                        <option value="Hyundai Santa Cruz">Hyundai Santa Cruz</option>
                        <option value="Kia Sorento">Kia Sorento</option>
                        <option value="Chrysler Pacifica">Chrysler Pacifica</option>
                        <option value="Ford Mustang">Ford Mustang</option>
                        <option value="Chevrolet Camaro">Chevrolet Camaro</option>
                        <option value="Dodge Challenger">Dodge Challenger</option>
                        <option value="Nissan 370Z">Nissan 370Z</option>
                        <option value="Toyota 86">Toyota 86</option>
                        <option value="Subaru BRZ">Subaru BRZ</option>
                        <option value="BMW 3 Series">BMW 3 Series</option>
                        <option value="Audi A4">Audi A4</option>
                        <option value="Mercedes-Benz C-Class">Mercedes-Benz C-Class</option>
                        <option value="Lexus IS">Lexus IS</option>
                        <option value="Tesla Model 3">Tesla Model 3</option>
                        <option value="Tesla Model S">Tesla Model S</option>
                        <option value="Tesla Model X">Tesla Model X</option>
                        <option value="Tesla Model Y">Tesla Model Y</option>
                        <option value="Porsche 911">Porsche 911</option>
                        <option value="Jaguar F-Type">Jaguar F-Type</option>
                        <option value="Mazda6">Mazda6</option>
                        <option value="Toyota Corolla">Toyota Corolla</option>
                        <option value="Honda Civic">Honda Civic</option>
                        <option value="Nissan Sentra">Nissan Sentra</option>
                        <option value="Ford Focus">Ford Focus</option>
                        <option value="Chevrolet Cruze">Chevrolet Cruze</option>
                        <option value="Hyundai Elantra">Hyundai Elantra</option>
                        <option value="Kia Forte">Kia Forte</option>
                        <option value="Volkswagen Jetta">Volkswagen Jetta</option>
                        <option value="Subaru Impreza">Subaru Impreza</option>
                        <option value="Dodge Charger">Dodge Charger</option>
                        <option value="Chevrolet Tahoe">Chevrolet Tahoe</option>
                        <option value="Ford Expedition">Ford Expedition</option>
                        <option value="Honda Pilot">Honda Pilot</option>
                        <option value="Toyota Sequoia">Toyota Sequoia</option>
                        <option value="Nissan Armada">Nissan Armada</option>
                        <option value="Subaru Ascent">Subaru Ascent</option>
                        <option value="Chrysler 300">Chrysler 300</option>
                        <option value="Buick Enclave">Buick Enclave</option>
                        <option value="GMC Acadia">GMC Acadia</option>
                        <option value="Volkswagen Atlas">Volkswagen Atlas</option>
                        <option value="Hyundai Palisade">Hyundai Palisade</option>
                        <option value="Kia Telluride">Kia Telluride</option>
                        <option value="Ford Explorer">Ford Explorer</option>
                        <option value="Chevrolet Suburban">Chevrolet Suburban</option>
                        <option value="Nissan Pathfinder">Nissan Pathfinder</option>
                        <option value="Dodge Durango">Dodge Durango</option>
                        <option value="Infiniti QX60">Infiniti QX60</option>
                        <option value="Cadillac Escalade">Cadillac Escalade</option>
                        <option value="Lexus RX">Lexus RX</option>
                        <option value="Acura MDX">Acura MDX</option>
                        <option value="Land Rover Range Rover">Land Rover Range Rover</option>
                        <option value="Jaguar F-Pace">Jaguar F-Pace</option>
                        <option value="Porsche Macan">Porsche Macan</option>
                        <option value="Mitsubishi Outlander">Mitsubishi Outlander</option>
                        <option value="Nissan X-Trail">Nissan X-Trail</option>
                        <option value="Peugeot 2008">Peugeot 2008</option>
                        <option value="Fiat 500X">Fiat 500X</option>
                        <option value="Renault Koleos">Renault Koleos</option>
                        <option value="Skoda Kodiaq">Skoda Kodiaq</option>
                        <option value="Volvo XC60">Volvo XC60</option>
                        <option value="Tesla Cybertruck">Tesla Cybertruck</option>
                        <option value="Rivian R1T">Rivian R1T</option>
                        <option value="Lucid Air">Lucid Air</option>
                        <option value="Hummer EV">Hummer EV</option>
                        <option value="Mercedes-Benz EQC">Mercedes-Benz EQC</option>
                        <option value="Ford Mustang Mach-E">Ford Mustang Mach-E</option>
                        <option value="Audi e-tron">Audi e-tron</option>
                        <option value="Volkswagen ID.4">Volkswagen ID.4</option>
                        <option value="Chevrolet Bolt EV">Chevrolet Bolt EV</option>
                        <option value="Nissan Ariya">Nissan Ariya</option>
                        <option value="Hyundai Ioniq 5">Hyundai Ioniq 5</option>
                        <option value="Kia EV6">Kia EV6</option>
                        <option value="Subaru Solterra">Subaru Solterra</option>
                        <option value="BMW iX">BMW iX</option>
                        <option value="Jaguar I-PACE">Jaguar I-PACE</option>
                        <option value="Porsche Taycan">Porsche Taycan</option>
                        <option value="Fisker Ocean">Fisker Ocean</option>
                        <option value="Polestar 2">Polestar 2</option>
                        <option value="Lotus Eletre">Lotus Eletre</option>
                        <option value="Mitsubishi Outlander PHEV">Mitsubishi Outlander PHEV</option>
                        <option value="Toyota Prius">Toyota Prius</option>
                        <option value="Honda Insight">Honda Insight</option>
                        <option value="Kia Niro">Kia Niro</option>
                        <option value="Ford Fusion Energi">Ford Fusion Energi</option>
                        <option value="Chevrolet Volt">Chevrolet Volt</option>
                        <option value="Nissan Leaf e+">Nissan Leaf e+</option>
                        <option value="Hyundai Sonata Hybrid">Hyundai Sonata Hybrid</option>
                        <option value="Volkswagen Jetta Hybrid">Volkswagen Jetta Hybrid</option>
                        <option value="Toyota RAV4 Hybrid">Toyota RAV4 Hybrid</option>
                        <option value="Honda CR-V Hybrid">Honda CR-V Hybrid</option>
                        <option value="Ford Escape Hybrid">Ford Escape Hybrid</option>
                        <option value="Kia Sorento Hybrid">Kia Sorento Hybrid</option>
                        <option value="Subaru Crosstrek Hybrid">Subaru Crosstrek Hybrid</option>
                        <option value="Toyota Corolla Hybrid">Toyota Corolla Hybrid</option>
                        <option value="Chevrolet Malibu Hybrid">Chevrolet Malibu Hybrid</option>
                        <option value="Lexus RX Hybrid">Lexus RX Hybrid</option>
                        <option value="BMW 5 Series Hybrid">BMW 5 Series Hybrid</option>
                        <option value="Mercedes-Benz E-Class Hybrid">Mercedes-Benz E-Class Hybrid</option>
                        <option value="Audi A6 Hybrid">Audi A6 Hybrid</option>
                        <option value="Volvo S60 Recharge">Volvo S60 Recharge</option>
                        <option value="Jaguar XE">Jaguar XE</option>
                        <option value="Porsche Panamera Hybrid">Porsche Panamera Hybrid</option>
                        <option value="Toyota Mirai">Toyota Mirai</option>
                        <option value="Honda Clarity Fuel Cell">Honda Clarity Fuel Cell</option>
                        <option value="Hyundai Nexo">Hyundai Nexo</option>
                        <option value="BMW i3">BMW i3</option>
                        <option value="Tesla Roadster">Tesla Roadster</option>
                    </select>
                </div>

                <!-- Service Type -->
                <div class="col-md-4">
                    <label for="serviceType" class="form-label">Service Type</label>
                    <select class="form-select" id="serviceType" name="serviceType" required>
                        <option selected disabled>Choose...</option>
                        <option value="oil-change">Oil Change</option>
                        <option value="tire-rotation">Tire Rotation</option>
                        <option value="engine-check">Engine Check</option>
                        <option value="brake-inspection">Brake Inspection</option>
                        <option value="battery-test">Battery Test</option>
                        <option value="wheel-alignment">Wheel Alignment</option>
                        <option value="transmission-fluid-change">Transmission Fluid Change</option>
                        <option value="coolant-flush">Coolant Flush</option>
                        <option value="air-filter-replacement">Air Filter Replacement</option>
                        <option value="cabin-air-filter-replacement">Cabin Air Filter Replacement</option>
                        <option value="spark-plug-replacement">Spark Plug Replacement</option>
                        <option value="fuel-filter-replacement">Fuel Filter Replacement</option>
                        <option value="belt-replacement">Belt Replacement</option>
                        <option value="hose-replacement">Hose Replacement</option>
                        <option value="exhaust-system-check">Exhaust System Check</option>
                        <option value="steering-system-inspection">Steering System Inspection</option>
                        <option value="suspension-check">Suspension Check</option>
                        <option value="tire-balancing">Tire Balancing</option>
                        <option value="light-bulb-replacement">Light Bulb Replacement</option>
                        <option value="wiper-blade-replacement">Wiper Blade Replacement</option>
                        <option value="oil-filter-replacement">Oil Filter Replacement</option>
                        <option value="wheel-bearing-replacement">Wheel Bearing Replacement</option>
                        <option value="differential-fluid-change">Differential Fluid Change</option>
                        <option value="engine-light-diagnosis">Engine Light Diagnosis</option>
                        <option value="AC-service">AC Service</option>
                        <option value="anti-lock-brake-check">Anti-Lock Brake Check</option>
                        <option value="drivetrain-check">Drivetrain Check</option>
                        <option value="safety-inspection">Safety Inspection</option>
                        <option value="road-test">Road Test</option>
                        <option value="fuel-injector-cleaning">Fuel Injector Cleaning</option>
                        <option value="emission-test">Emission Test</option>
                        <option value="bodywork-repair">Bodywork Repair</option>
                        <option value="paint-touch-up">Paint Touch-Up</option>
                        <option value="dent-removal">Dent Removal</option>
                        <option value="windshield-repair">Windshield Repair</option>
                        <option value="glass-tinting">Glass Tinting</option>
                        <option value="interior-cleaning">Interior Cleaning</option>
                        <option value="exterior-wash">Exterior Wash</option>
                        <option value="clay-bar-treatment">Clay Bar Treatment</option>
                        <option value="waxing">Waxing</option>
                        <option value="polishing">Polishing</option>
                        <option value="rust-proofing">Rust Proofing</option>
                        <option value="ceramic-coating">Ceramic Coating</option>
                        <option value="car-detailing">Car Detailing</option>
                        <option value="paint-protection-film">Paint Protection Film</option>
                        <option value="engine-cleaning">Engine Cleaning</option>
                        <option value="battery-replacement">Battery Replacement</option>
                        <option value="fuel-system-service">Fuel System Service</option>
                        <option value="overheating-diagnosis">Overheating Diagnosis</option>
                        <option value="vibration-diagnosis">Vibration Diagnosis</option>
                        <option value="leak-diagnosis">Leak Diagnosis</option>
                        <option value="water-pump-replacement">Water Pump Replacement</option>
                        <option value="timing-belt-replacement">Timing Belt Replacement</option>
                        <option value="compression-test">Compression Test</option>
                        <option value="fuel-pump-replacement">Fuel Pump Replacement</option>

                    </select>
                </div>

                <!-- Car Issue -->
                <div class="col-md-4">
                    <label for="carIssue" class="form-label">Car Issue</label>
                    <input type="text" class="form-control" id="carIssue" name="carIssue"
                        placeholder="Other Issue...">
                </div>

                <!-- Appointment Date -->
                <div class="col-md-4">
                    <label for="appointmentDate" class="form-label">Preferred Appointment Date</label>
                    <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" required>
                </div>

                <!-- Appointment Time -->
                <div class="col-md-4">
                    <label for="appointmentTime" class="form-label">Preferred Appointment Time</label>
                    <input type="time" class="form-control" id="appointmentTime" name="appointmentTime" required>
                </div>

                <!-- Plate Number -->
                <div class="col-md-4">
                    <label for="plateNumber" class="form-label">Plate Number</label>
                    <input type="text" class="form-control" id="plateNumber" name="plateNumber" required
                        placeholder="XXX-000">
                </div>

                <!-- Additional Notes -->
                <div class="col-md-12">
                    <label for="additionalNotes" class="form-label">Additional Notes</label>
                    <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2022-2024 <a href="https://adminlte.io">AUTOSERV</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> v1
        </div>
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- Daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- OverlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
</body>
<script>
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to submit this booking?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('bookingForm').submit();
            }
        });
    });
</script>
<script>
    function openModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('imageModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    function confirmImageUpdate() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to update your profile image!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('profileImageForm').submit(); // Submit the form
            }
        });
    }
</script>

</html>
