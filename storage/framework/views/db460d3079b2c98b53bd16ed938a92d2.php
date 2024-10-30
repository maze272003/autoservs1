

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
                        <img src="<?php echo e(Storage::url(Auth::user()->profile_image)); ?>" style="height: 40px; width: 40px; border-radius: 50%;" alt="User Image">
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
                            <a href="<?php echo e(route('user.statistics')); ?>" class="nav-link active">
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
                            <a href="<?php echo e(route('admin.history.index')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>View History</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.response.messages')); ?>" class="nav-link ">
                                <i class="nav-icon fas fa-envelope"></i> <!-- Changed icon to envelope -->
                                <p>View Messages</p> <!-- Updated text to reflect the view -->
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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>ChartJS</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="">Home</a>
                                </li>
                                <li class="breadcrumb-item active">ChartJS</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                    <main class="app-main"> <!--begin::App Content Header-->
                        <div class="app-content"> <!--begin::Container-->
                            <div class="container-fluid"> <!--begin::Row-->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-header border-0">
                                                <h3 class="card-title">Products</h3>
                                                <div class="card-tools">
                                                    <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-download"></i> </a>
                                                    <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-list"></i> </a>
                                                </div>
                                            </div>
                                            <!-- Set a max-height and enable vertical scrolling within the card body -->
                                            <div class="card-body table-responsive p-0" style="max-height: 368px; overflow-y: auto;">
                                                <table class="table table-striped align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <th>Sales</th>
                                                            <th>More</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Some Product
                                                            </td>
                                                            <td>$13 USD</td>
                                                            <td> <small class="text-success me-1"> <i class="bi bi-arrow-up"></i> 12% </small> 12,000 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>

                                                        <!-- Additional rows go here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- /.card -->
                                        
                                        <div class="card mb-4">
                                            <div class="card-header border-0">
                                                <h3 class="card-title">Products</h3>
                                                <div class="card-tools">
                                                    <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-download"></i> </a>
                                                    <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-list"></i> </a>
                                                </div>
                                            </div>
                                            <!-- Set a max-height and enable vertical scrolling within the card body -->
                                            <div class="card-body table-responsive p-0" style="max-height: 368px; overflow-y: auto;">
                                                <table class="table table-striped align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <th>Sales</th>
                                                            <th>More</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Some Product
                                                            </td>
                                                            <td>$13 USD</td>
                                                            <td> <small class="text-success me-1"> <i class="bi bi-arrow-up"></i> 12% </small> 12,000 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <img src="../../dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                                                Another Product
                                                            </td>
                                                            <td>$29 USD</td>
                                                            <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i> 0.5% </small> 123,234 Sold </td>
                                                            <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                                        </tr>

                                                        <!-- Additional rows go here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- /.card -->
                                    </div> <!-- /.col-md-6 -->
                                    
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-header border-0">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="card-title">Sales</h3>
                                                    <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Report</a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <p class="d-flex flex-column"> 
                                                        <span class="fw-bold fs-5">$18,230.00</span> 
                                                        <span>Sales Over Time</span> 
                                                    </p>
                                                    <p class="ms-auto d-flex flex-column text-end"> 
                                                        <span class="text-success"> 
                                                            <i class="bi bi-arrow-up"></i> 33.1%
                                                        </span> 
                                                        <span class="text-secondary">Since Past Year</span> 
                                                    </p>
                                                </div>
                                                <div class="position-relative mb-4">
                                                    <div id="sales-chart"></div>
                                                </div>
                                                <div class="d-flex flex-row justify-content-end"> 
                                                    <span class="me-2">
                                                        <i class="bi bi-square-fill text-primary"></i> This year
                                                    </span> 
                                                    <span>
                                                        <i class="bi bi-square-fill text-secondary"></i> Last year
                                                    </span> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="container-fluid">
                                            <div class="card mb-5">
                                            <!-- Bar chart container -->
                                            <div class="row">
                                                
                                                <div class="col-md-100">
                                                    
                                                    <div class="card card-success">
                                                        <div class="card-header">
                                                            <h3 class="card-title">User Count Per Month</h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <canvas id="userBarChart"
                                                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                    
                                            </div>
                                        </div>
                                    </div> <!-- /.col-md-6 -->
                                    
                                </div> <!--end::Row-->
                                
                            </div> <!--end::Container-->
                            
                        </div> <!--end::App Content-->
                        
                    </main> <!--end::App Main--> <!--begin::Footer-->
                
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
            <!-- Add Content Here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- ChartJS -->
    <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pass users per month data from PHP to JavaScript
        const usersPerMonth = <?php echo json_encode($usersPerMonth, 15, 512) ?>;

        // Prepare the data for the bar chart
        const labels = usersPerMonth.map(item => `Month ${item.month}`);
        const data = usersPerMonth.map(item => item.count);

        // Render the bar chart
        const ctx = document.getElementById('userBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Users',
                    data: data,
                    backgroundColor: 'rgba(90,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    
    <script>
        // const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        // const Default = {
        //     scrollbarTheme: "os-theme-light",
        //     scrollbarAutoHide: "leave",
        //     scrollbarClickScroll: true,
        // };
        // document.addEventListener("DOMContentLoaded", function() {
        //     const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        //     if (
        //         sidebarWrapper &&
        //         typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        //     ) {
        //         OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        //             scrollbars: {
        //                 theme: Default.scrollbarTheme,
        //                 autoHide: Default.scrollbarAutoHide,
        //                 clickScroll: Default.scrollbarClickScroll,
        //             },
        //         });
        //     }
        // });
    </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const visitors_chart_options = {
            series: [{
                    name: "High - 2023",
                    data: [100, 120, 170, 167, 180, 177, 160],
                },
                {
                    name: "Low - 2023",
                    data: [60, 80, 70, 67, 80, 77, 100],
                },
            ],
            chart: {
                height: 200,
                type: "line",
                toolbar: {
                    show: false,
                },
            },
            colors: ["#0d6efd", "#adb5bd"],
            stroke: {
                curve: "smooth",
            },
            grid: {
                borderColor: "#e7e7e7",
                row: {
                    colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                    opacity: 0.5,
                },
            },
            legend: {
                show: false,
            },
            markers: {
                size: 1,
            },
            xaxis: {
                categories: ["22th", "23th", "24th", "25th", "26th", "27th", "28th"],
            },
        };

        const visitors_chart = new ApexCharts(
            document.querySelector("#visitors-chart"),
            visitors_chart_options
        );
        visitors_chart.render();

        const sales_chart_options = {
            series: [{
                    name: "Net Profit",
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                },
                {
                    name: "Revenue",
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                },
                {
                    name: "Free Cash Flow",
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
                },
            ],
            chart: {
                type: "bar",
                height: 200,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded",
                },
            },
            legend: {
                show: false,
            },
            colors: ["#0d6efd", "#20c997", "#ffc107"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"],
            },
            xaxis: {
                categories: [
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                ],
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands";
                    },
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#sales-chart"),
            sales_chart_options
        );
        sales_chart.render();
    </script> <!--end::Script-->
</body>

</html>


<?php /**PATH /Users/mac/Documents/3rdyr/LARAVEL2/laravelfromgit/Autoservs1stSem/resources/views/admin/userStatistics.blade.php ENDPATH**/ ?>