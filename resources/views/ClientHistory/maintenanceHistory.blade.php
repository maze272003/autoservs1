<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>client | maintenance history</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
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
                        <img src="{{ Storage::url(Auth::user()->profile_image) }}" style="height: 40px; width: 40px; border-radius: 50%;" alt="User Image">
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
                            <a href="{{ route('maintenance') }}" class="nav-link active">
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
                            <a href="{{ route('payment.show') }}" class="nav-link">
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
            </div>
            </nav>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">MAINTENANCE</h1>
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Search input -->
                                    <div class="mb-3">
                                        <input type="text" id="searchInput" class="form-control"
                                            placeholder="Search for Car Owner, Car Model, Service Type, etc..."
                                            onkeyup="searchFilter()">
                                    </div>
            
                                    <div class="table-responsive p-0">
                                        <table class="table table-bordered" id="historyTable">
                                            <thead>
                                                <tr>
                                                    <th>Car Owner</th>
                                                    <th>Car Model</th>
                                                    <th>Service Type</th>
                                                    <th>Car Issue</th>
                                                    <th>Appointment Date</th>
                                                    <th>Plate Number</th>
                                                    <th>Additional Notes</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($historyCars as $car)
                                                    <tr>
                                                        <td>{{ $car->user->name ?? 'N/A' }}</td>
                                                        <td>{{ $car->carModel }}</td>
                                                        <td>{{ $car->serviceType }}</td>
                                                        <td>{{ $car->carIssue }}</td>
                                                        <td>{{ $car->appointmentDate }}</td>
                                                        <td>{{ $car->plateNumber }}</td>
                                                        <td>{{ $car->additionalNotes }}</td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#viewPartsModal{{ $car->id }}">
                                                                View Parts
                                                            </button>
            
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="viewPartsModal{{ $car->id }}" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="viewPartsModalLabel{{ $car->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="viewPartsModalLabel{{ $car->id }}">
                                                                                Parts for {{ $car->carModel }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Part Name</th>
                                                                                        <th>Part Price</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @if ($car->historyParts->isNotEmpty())
                                                                                        @foreach ($car->historyParts as $part)
                                                                                            <tr>
                                                                                                <td>{{ $part->part_name }}</td>
                                                                                                <td>{{ $part->part_price }}</td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <tr>
                                                                                            <td colspan="2">No parts added</td>
                                                                                        </tr>
                                                                                    @endif
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022-2024 <a href="https://github.com/maze272003/autoservs1.git">AUTOSERV</a>.</strong>
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
    <!-- Search Functionality -->
<script>
    function searchFilter() {
        let input = document.getElementById('searchInput').value.toUpperCase();
        let table = document.getElementById('historyTable');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td');
            let showRow = false;

            for (let j = 0; j < td.length - 1; j++) {
                if (td[j].innerText.toUpperCase().indexOf(input) > -1) {
                    showRow = true;
                    break;
                }
            }

            tr[i].style.display = showRow ? '' : 'none';
        }
    }
</script>
</body>

</html>
