<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | ChartJS</title>
    <!-- Google Font: Source Sans Pro -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
</head>

<body class="hold-transition sidebar-mini">
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
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!-- Profile Link -->
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
            <a href="../../index3.html" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if(Auth::user()->profile_image): ?>
                            <img src="<?php echo e(Storage::url(Auth::user()->profile_image)); ?>"
                                style="height: 40px; width: 40px; border-radius: 50%;" alt="User Image">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="d-block"><?php echo e(Auth::user()->name); ?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo e(route('user.statistics')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Charts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.users')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Table All Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.createparts')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Add new parts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.bookings.index')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    Process car
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.inprocess')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    View Inprocess
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('history.index')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    View history
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Car History</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Car History</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
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
                                                <?php $__currentLoopData = $historyCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($car->user->name ?? 'N/A'); ?></td>
                                                        <!-- Move car owner's name to this column -->
                                                        <td><?php echo e($car->carModel); ?></td>
                                                        <td><?php echo e($car->serviceType); ?></td>
                                                        <td><?php echo e($car->carIssue); ?></td>
                                                        <td><?php echo e($car->appointmentDate); ?></td>
                                                        <td><?php echo e($car->plateNumber); ?></td>
                                                        <td><?php echo e($car->additionalNotes); ?></td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#viewPartsModal<?php echo e($car->id); ?>">
                                                                View Parts
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="viewPartsModal<?php echo e($car->id); ?>" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="viewPartsModalLabel<?php echo e($car->id); ?>"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="viewPartsModalLabel<?php echo e($car->id); ?>">
                                                                                Parts for <?php echo e($car->carModel); ?>

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
                                                                                    <?php if($car->historyParts->isNotEmpty()): ?>
                                                                                        <?php $__currentLoopData = $car->historyParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <tr>
                                                                                                <td><?php echo e($part->part_name); ?>

                                                                                                </td>
                                                                                                <td><?php echo e($part->part_price); ?>

                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php else: ?>
                                                                                        <tr>
                                                                                            <td colspan="2">No parts
                                                                                                added</td>
                                                                                        </tr>
                                                                                    <?php endif; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0-rc
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
</body>
<script>
    function searchFilter() {
        // Get the search input value
        const searchValue = document.getElementById("searchInput").value.toLowerCase();

        // Get the table and rows
        const table = document.getElementById("historyTable");
        const rows = table.getElementsByTagName("tr");

        // Loop through the rows, skipping the first one (header row)
        for (let i = 1; i < rows.length; i++) {
            let showRow = false;

            // Get all table data (td) elements in the row
            const columns = rows[i].getElementsByTagName("td");

            // Loop through the columns (except the last one for buttons)
            for (let j = 0; j < columns.length - 1; j++) {
                const cellText = columns[j].textContent.toLowerCase();

                // Check if the cell text includes the search value
                if (cellText.includes(searchValue)) {
                    showRow = true;
                    break;
                }
            }

            // Show or hide the row based on the search result
            rows[i].style.display = showRow ? "" : "none";
        }
    }
</script>

</html>
<?php /**PATH C:\Users\Miner\Documents\jm\laravel4\github\autoservs1\resources\views/history/index.blade.php ENDPATH**/ ?>