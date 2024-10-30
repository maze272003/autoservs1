<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link
        rel="stylesheet"href="<?php echo e(asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/ionicons/ionicons.min.css')); ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/jqvmap/jqvmap.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/summernote-bs4.min.css')); ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

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
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo e(asset('dist/img/autoservbg.png')); ?>" alt="autoservbg" height="270" width="300">
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
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        
                        <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                            <i class="fas fa-user"></i> <?php echo e(__('Profile')); ?>

                        </a>

                        <!-- Logout Link -->
                        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <?php echo e(__('Logout')); ?>

                        </a>

                        <!-- Hidden Logout Form -->
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo e(url('/')); ?>" class="brand-link">
                <img src="<?php echo e(asset('dist/img/autoservbg.png')); ?>" alt="AUTOSERV Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AUTOSERV</span>
            </a>
            
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if(Auth::user()->profile_image): ?>
                            <!-- Add an onclick event to show the image in the overlay -->
                            <img src="<?php echo e(Storage::url(Auth::user()->profile_image)); ?>"
                                style="height: 40px; width: 40px; border-radius: 50%;" alt="User Image"
                                onclick="openModal('<?php echo e(Storage::url(Auth::user()->profile_image)); ?>')">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="d-block"><?php echo e(Auth::user()->name); ?></a>
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
                            <a href="<?php echo e(route('dashboard')); ?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <!-- BOOK -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('book')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Books Car</p>
                            </a>
                        </li>
                        <!-- history -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('ClientHistory.maintenanceHistory')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Maintenance History</p>
                            </a>
                        </li>
                        <!-- NOTIFICATION -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('messages.notification')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>Notification</p>
                            </a>
                        </li>
                        
                        
                        <!-- payment -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('payment.show')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>Payment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('customer.support')); ?>" class="nav-link"
                                aria-label="Contact Customer Support">
                                <i class="nav-icon fas fa-headset"></i>
                                <p>Customer Support</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('ratings')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Feedback and Reviews</p>
                            </a>
                        </li>
                    </ul>
            </div>
            </nav>
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
                        <h1 class="m-0">DASHBOARD</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo e($userAddedPartsCount); ?></h3> <!-- Display count of added parts -->
                                <p>ADDED PARTS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#viewPartsModal">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    
                    
                    <!-- Modal for Viewing Parts -->
                    <div class="modal fade" id="viewPartsModal" tabindex="-1" role="dialog" aria-labelledby="viewPartsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewPartsModalLabel">Added Parts</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                        // Fetch all processes for the authenticated user
                                        $processes = \App\Models\Process::where('user_id', Auth::id())->get();
                                    ?>

                                    <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <h5>Process ID: <?php echo e($process->id); ?></h5>
                                        <ul class="list-group">
                                            <?php
                                                $clientParts = \App\Models\ClientPart::where('process_id', $process->id) // Fetch client parts based on process_id
                                                    ->with('part')
                                                    ->get();
                                                $totalPrice = 0; // Initialize total price for this process
                                            ?>
                                            <?php $__empty_1 = true; $__currentLoopData = $clientParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong><?php echo e($clientPart->part->name_parts ?? 'N/A'); ?></strong> -
                                                        ₱<?php echo e($clientPart->part->price ?? 'N/A'); ?>

                                                    </div>
                                                    <form action="<?php echo e(route('parts.decline', $clientPart->id)); ?>" method="POST" class="ml-2 decline-part-form">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                                    </form>
                                                    
                                                </li>
                                                <?php
                                                    // Add the part's price to total price
                                                    $totalPrice += $clientPart->part->price ?? 0;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="list-group-item">No parts added for this process.</li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php if($totalPrice > 0): ?>
                                            <h5>Total Price: ₱<?php echo e($totalPrice); ?></h5> <!-- Display total price -->
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo e($bookingCount); ?><sup style="font-size: 20px"></sup></h3>
                                
                                <p>PENDING CAR</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-model-s"></i>
                            </div>
                            <!-- Button to trigger the modal -->
                            <a href="#" class="small-box-footer" data-toggle="modal"
                                data-target="#pendingModal">More info
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Pending Cars Modal -->
                    <div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pendingModalLabel">Pending Cars</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Table to display pending cars -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Car Model</th>
                                                <th>Service Type</th>
                                                <th>Appointment Date</th>
                                                <th>Appointment Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($pendingBookings->isEmpty()): ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No pending cars.</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $pendingBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendingBooking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($pendingBooking->carModel); ?></td>
                                                        <td><?php echo e($pendingBooking->serviceType); ?></td>
                                                        <td><?php echo e($pendingBooking->appointmentDate); ?></td>
                                                        <td><?php echo e($pendingBooking->appointmentTime); ?></td>
                                                        <td><?php echo e($pendingBooking->status); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
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
                    <!-- Cancelled Bookings Card -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo e($canceledCount); ?></h3>
                                
                                <p>CANCELLED BOOK</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-model-s"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal"
                                data-target="#canceledBookingsModal">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Canceled Bookings Modal -->
                    <div class="modal fade" id="canceledBookingsModal" tabindex="-1" role="dialog"
                        aria-labelledby="canceledBookingsLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="canceledBookingsLabel">Canceled Bookings</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Car Model</th>
                                                <th>Service Type</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $canceledBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($booking->carModel); ?></td>
                                                    <td><?php echo e($booking->serviceType); ?></td>
                                                    <td><?php echo e(\Carbon\Carbon::parse($booking->appointmentDate)->format('F j, Y')); ?>

                                                    </td>
                                                    <td><?php echo e(\Carbon\Carbon::parse($booking->appointmentTime)->format('h:i A')); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($canceledBookings->isEmpty()): ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No canceled bookings found.
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
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
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo e($processCount); ?></h3>
                                
                                <p>IN RPOCESS CAR</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-model-s"></i>
                            </div>
                            <!-- Button to trigger the modal -->
                            <a href="#" class="small-box-footer" data-toggle="modal"
                                data-target="#processModal">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="processModal" tabindex="-1" aria-labelledby="processModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="processModalLabel">In Process Cars</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Table to display in process cars -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Car Model</th>
                                                <th>Service Type</th>
                                                <th>Appointment Date</th>
                                                <th>Plate Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($process->carModel); ?></td>
                                                    <td><?php echo e($process->serviceType); ?></td>
                                                    <td><?php echo e($process->appointmentDate); ?></td>
                                                    <td><?php echo e($process->plateNumber); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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


                </div>
            </div>
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Ongoing Car </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Car Model</th>
                                    <th>Service Type</th>
                                    <th>Appointment Time</th>
                                    <th>Appointment Date</th>
                                    <th>Additional Notes</th>
                                    <th>Action</th> <!-- New Action Column -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($booking->carModel); ?></td>
                                        <td><?php echo e($booking->serviceType); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($booking->appointmentTime)->format('h:i A')); ?>

                                        </td>
                                        <td><?php echo e(\Carbon\Carbon::parse($booking->appointmentDate)->format('F j, Y')); ?>

                                        </td>
                                        <td><?php echo e($booking->additionalNotes); ?></td>
                                        <td>
                                            <!-- Cancel Button with SweetAlert2 -->
                                            <form action="<?php echo e(route('booking.destroy', $booking->id)); ?>"
                                                method="POST" class="cancel-form" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="btn btn-danger btn-sm cancel-button">
                                                    Cancel
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No bookings available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- /.col -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
    </div>
    <!-- /.row -->
    </div>
    <!-- /.card-footer -->
    </div>
    <!-- /.card -->
    <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </section>
    <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    <!-- Scripts -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo e(asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- ChartJS -->
    <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo e(asset('plugins/sparklines/sparkline.js')); ?>"></script>
    <!-- JQVMap -->
    <script src="<?php echo e(asset('plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo e(asset('plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
    <!-- Summernote -->
    <script src="<?php echo e(asset('plugins/summernote/summernote-bs4.min.js')); ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo e(asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('dist/js/adminlte.js')); ?>"></script>
    <!-- AdminLTE dashboard demo -->
    <script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Target all cancel buttons
        document.querySelectorAll('.cancel-button').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent form submission

                // Get the form
                let form = button.closest('form');

                // SweetAlert2 confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This booking will be permanently canceled!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Target all decline buttons inside the modal
        document.querySelectorAll('.decline-part-button').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the form from submitting

                // Get the associated form
                let form = button.closest('form');

                // SweetAlert2 confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This part will be removed from the list!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        form.submit();
                    }
                });
            });
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
<?php /**PATH /Users/mac/Documents/3rdyr/LARAVEL2/laravelfromgit/Autoservs1stSem/resources/views/dashboard.blade.php ENDPATH**/ ?>