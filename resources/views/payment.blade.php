<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client | Payment</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('payment.css') }}">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    /* Flex container for QR and table */
    .flex-container {
        display: flex;
        justify-content: flex-start; /* Align slightly to the right */
        align-items: flex-start;
        margin: 5px 20px; /* Adds a right shift */
    }

    /* QR Image Styling */
    .qr-container {
        flex-basis: 30%;
        margin-right: 20px; /* Adds a small margin to the right */
    }

    .qr-image {
        width: 100%;
        height: auto;
        max-width: 300px;
        object-fit: contain;
    }

    /* Table container will take remaining space */
    .table-container {
        flex-basis: 65%;
    }

    .table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
    }

    .table th, .table td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ddd;
        word-wrap: break-word;
    }

    .table td button {
        padding: 5px 10px;
        font-size: 14px;
    }

    /* Responsive design for smaller screens */
    @media (max-width: 768px) {
        .flex-container {
            flex-direction: column;
            align-items: center;
            margin-right: 0; /* Remove the negative margin */
        }

        .qr-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .qr-image {
            max-width: 200px; /* Slightly smaller for mobile */
        }

        .table-container {
            width: 100%; /* Make the table full width */
            overflow-x: auto; /* Enable horizontal scrolling if necessary */
        }

        .table {
            width: 100%;
            font-size: 12px;
        }

        .table td, .table th {
            display: block;
            width: 100%;
            text-align: left;
        }

        .table thead {
            display: none;
        }

        .table tr {
            margin-bottom: 15px;
            display: block;
            border-bottom: 1px solid #ddd;
        }

        .table td {
            padding-left: 50%;
            position: relative;
            text-align: left;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 45%;
            padding-left: 15px;
            font-weight: bold;
        }

        .table td button {
            width: 100%;
            padding: 8px;
            font-size: 14px;
        }
    }
</style>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/autoservbg.png') }}" alt="autoservbg" height="270" width="300">
        </div>
        
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('dist/img/autoservbg.png') }}" alt="AUTOSERV Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
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
                            <a href="{{ route('ClientHistory.maintenanceHistory') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Maintenance History</p>
                            </a>
                        </li>
                        <!-- PROFILE -->
                        <li class="nav-item">
                            <a href="{{ route('messages.notification') }}" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>Notification</p>
                            </a>
                        </li>
                        
                        <!-- payment -->
                        <li class="nav-item">
                            <a href="{{ route('payment.show') }}" class="nav-link active">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>Payment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.support') }}" class="nav-link"
                                aria-label="Contact Customer Support">
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
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">PAYMENT</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section for QR code -->
            <section>
                <div class="container">
                    <div class="flex-container">
                        <!-- QR Code -->
                        <div class="qr-container">
                            <img src="{{ asset('dist/img/qrpayment.jpg') }}" class="qr-image" alt="QR code" draggable="false" oncontextmenu="return false;" style="pointer-events: none;">
                        </div>
                        <!-- Table -->
                        <div class="table-container">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Upload Proof</th> <!-- New Column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($processes as $process)
                                            <tr>
                                                <td>{{ $process->serviceType }}</td>
                                                <td>₱{{ number_format($process->totalPrice, 2) }}</td>
                                                <td>{{ $process->status }}</td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#viewPartsModal-{{ $process->id }}">
                                                        View Added Parts
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#uploadProofModal-{{ $process->id }}">
                                                        Upload Proof
                                                    </button>
                                                </td>
                                            </tr>
            
                                            <!-- Modal for Viewing Added Parts -->
                                            <div class="modal fade" id="viewPartsModal-{{ $process->id }}" tabindex="-1" role="dialog" aria-labelledby="viewPartsModalLabel-{{ $process->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewPartsModalLabel-{{ $process->id }}">Added Parts for {{ $process->serviceType }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Add logic here to display the added parts -->
                                                            <ul>
                                                                @foreach($process->clientParts as $clientPart) <!-- Assuming you have a relationship defined -->
                                                                    <li>{{ $clientPart->part->name_parts }} - ₱{{ number_format($clientPart->part->price, 2) }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <!-- Modal for Uploading Payment Proof -->
                                            <div class="modal fade" id="uploadProofModal-{{ $process->id }}" tabindex="-1" role="dialog" aria-labelledby="uploadProofModalLabel-{{ $process->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadProofModalLabel-{{ $process->id }}">Upload Payment Proof for {{ $process->serviceType }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('processes.uploadProof', $process->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="proof_payment">Choose Payment Proof Image</label>
                                                                    <input type="file" class="form-control-file" name="proof_payment" id="proof_payment" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Upload Proof</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            
        </div>
        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022-2024 <a href="https://github.com/maze272003/autoservs1.git">AUTOSERV</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('payment.js') }}"></script>
</body>

</html>
