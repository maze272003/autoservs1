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
        font-family: 'Poppins', sans-serif
    }

    .container {
        margin: 30px auto;
    }

    .container .card {
        width: 100%;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        background: #fff;
        border-radius: 0px;
    }

    body {
        background: #eee
    }

    .btn.btn-primary {
        background-color: #ddd;
        color: black;
        box-shadow: none;
        border: none;
        font-size: 20px;
        width: 100%;
        height: 100%;
    }

    .btn.btn-primary:focus {
        box-shadow: none;
    }

    .container .card .img-box {
        width: 80px;
        height: 50px;
    }

    .container .card img {
        width: 100%;
        object-fit: fill;
    }

    .container .card .number {
        font-size: 24px;
    }

    .container .card-body .btn.btn-primary .fab.fa-cc-paypal {
        font-size: 32px;
        color: #3333f7;
    }

    .fab.fa-cc-amex {
        color: #1c6acf;
        font-size: 32px;
    }

    .fab.fa-cc-mastercard {
        font-size: 32px;
        color: red;
    }

    .fab.fa-cc-discover {
        font-size: 32px;
        color: orange;
    }

    .c-green {
        color: green;
    }

    .box {
        height: 40px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ddd;
    }

    .btn.btn-primary.payment {
        background-color: #1c6acf;
        color: white;
        border-radius: 0px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 24px;
    }

    .form__div {
        height: 50px;
        position: relative;
        margin-bottom: 24px;
    }

    .form-control {
        width: 100%;
        height: 45px;
        font-size: 14px;
        border: 1px solid #DADCE0;
        border-radius: 0;
        outline: none;
        padding: 2px;
        background: none;
        z-index: 1;
        box-shadow: none;
    }

    .form__label {
        position: absolute;
        left: 16px;
        top: 10px;
        background-color: #fff;
        color: #80868B;
        font-size: 16px;
        transition: .3s;
        text-transform: uppercase;
    }

    .form-control:focus+.form__label {
        top: -8px;
        left: 12px;
        color: #1A73E8;
        font-size: 12px;
        font-weight: 500;
        z-index: 10;
    }

    .form-control:not(:placeholder-shown).form-control:not(:focus)+.form__label {
        top: -8px;
        left: 12px;
        font-size: 12px;
        font-weight: 500;
        z-index: 10;
    }

    .form-control:focus {
        border: 1.5px solid #1A73E8;
        box-shadow: none;
    }
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
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/autoservbg.png" alt="autoservbg" height="270" width="300">
        </div>
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
                            <a href="{{ route('payment') }}" class="nav-link">
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
                            <h1 class="m-0">PAYMENT</h1>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- section -->
            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-12 mt-4">
                            <div class="card p-3">
                                <p class="mb-0 fw-bold h4">Payment Methods</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card p-3">
                                <div class="card-body border p-0">
                                    <p>
                                        <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                                            data-bs-toggle="collapse" href="#collapseExample" role="button"
                                            aria-expanded="true" aria-controls="collapseExample">
                                            <span class="fw-bold">PayPal</span>
                                            <span class="fab fa-cc-paypal">
                                            </span>
                                        </a>
                                    </p>
                                    <div class="collapse p-3 pt-0" id="collapseExample">
                                        <div class="row">
                                            <div class="col-8">
                                                <p class="h4 mb-0">Summary</p>
                                                <p class="mb-0"><span class="fw-bold">Product:</span><span
                                                        class="c-green">: Name of
                                                        product</span>
                                                </p>
                                                <p class="mb-0"><span class="fw-bold">Price:</span><span
                                                        class="c-green">:$452.90</span></p>
                                                <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing
                                                    elit. Atque
                                                    nihil neque
                                                    quisquam aut
                                                    repellendus, dicta vero? Animi dicta cupiditate, facilis provident
                                                    quibusdam ab
                                                    quis,
                                                    iste harum ipsum hic, nemo qui!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border p-0">
                                    <p>
                                        <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                            data-bs-toggle="collapse" href="#collapseExample" role="button"
                                            aria-expanded="true" aria-controls="collapseExample">
                                            <span class="fw-bold">Credit Card</span>
                                            <span class="">
                                                <span class="fab fa-cc-amex"></span>
                                                <span class="fab fa-cc-mastercard"></span>
                                                <span class="fab fa-cc-discover"></span>
                                            </span>
                                        </a>
                                    </p>
                                    <div class="collapse show p-3 pt-0" id="collapseExample">
                                        <div class="row">
                                            <div class="col-lg-5 mb-lg-0 mb-3">
                                                <p class="h4 mb-0">Summary</p>
                                                <p class="mb-0"><span class="fw-bold">Product:</span><span
                                                        class="c-green">: Name of
                                                        product</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bold">Price:</span>
                                                    <span class="c-green">:$452.90</span>
                                                </p>
                                                <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing
                                                    elit. Atque
                                                    nihil neque
                                                    quisquam aut
                                                    repellendus, dicta vero? Animi dicta cupiditate, facilis provident
                                                    quibusdam ab
                                                    quis,
                                                    iste harum ipsum hic, nemo qui!
                                                </p>
                                            </div>
                                            <div class="col-lg-7">
                                                <form action="" class="form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form__div">
                                                                <input type="text" class="form-control"
                                                                    placeholder=" ">
                                                                <label for="" class="form__label">Card
                                                                    Number</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form__div">
                                                                <input type="text" class="form-control"
                                                                    placeholder=" ">
                                                                <label for="" class="form__label">MM /
                                                                    yy</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form__div">
                                                                <input type="password" class="form-control"
                                                                    placeholder=" ">
                                                                <label for="" class="form__label">cvv
                                                                    code</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form__div">
                                                                <input type="text" class="form-control"
                                                                    placeholder=" ">
                                                                <label for="" class="form__label">name on the
                                                                    card</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="btn btn-primary w-100">Sumbit</div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn btn-primary payment">
                                Make Payment
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <!-- section -->
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
    <!-- jQuery UI 1.11.4 -->
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
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
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
</body>

</html>
