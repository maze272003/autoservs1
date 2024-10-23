<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AdminLTE 3 | Processes</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
</head>
<style>
    .modal-backdrop.show {
        opacity: 0.5;
        /* Adjust this value to make it less dark */
    }
    .text-darkred {
        background-color: #8B0000; /* Dark Red background color for button */
        border-radius: 4px; /* Optional: adds some border radius to the button */
    }
</style>

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
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                            <i class="fas fa-user"></i> <?php echo e(__('Profile')); ?>

                        </a>
                        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <?php echo e(__('Logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?php echo e(url('/')); ?>" class="brand-link">
                <img src="<?php echo e(asset('dist/img/autoservbg.png')); ?>" alt="AUTOSERV Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AUTOSERV</span>
            </a>
            <div class="sidebar">
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
                            <a href="<?php echo e(route('admin.history.index')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>View History</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Processes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Processes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Process Table</h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="max-height: 680px; overflow-y: auto;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Owner</th>
                                                <th>Car Model</th>
                                                <th>Service Type</th>
                                                <th>Car Issue</th>
                                                <th>Appointment Date</th>
                                                <th>Appointment Time</th>
                                                <th>Plate Number</th>
                                                <th>Additional Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($process->id); ?></td>
                                                    <td><?php echo e($process->user->name ?? 'N/A'); ?></td>
                                                    <td><?php echo e($process->carModel); ?></td>
                                                    <td><?php echo e($process->serviceType); ?></td>
                                                    <td><?php echo e($process->carIssue); ?></td>
                                                    <td><?php echo e($process->appointmentDate); ?></td>
                                                    <td><?php echo e($process->appointmentTime); ?></td>
                                                    <td><?php echo e($process->plateNumber); ?></td>
                                                    <td><?php echo e($process->additionalNotes); ?></td>
            
                                                    <!-- Action Buttons -->
                                                    <td>
                                                        <!-- Add Parts Button -->
                                                        <a href="#" data-toggle="modal" data-target="#addPartsModal-<?php echo e($process->id); ?>" class="text-success">
                                                            <i class="bx bx-plus-circle bx-md"></i>
                                                        </a>
            
                                                        <!-- View Parts Button -->
                                                        <a href="#" data-toggle="modal" data-target="#viewPartsModal-<?php echo e($process->id); ?>" class="text-info">
                                                            <i class="bx bx-show bx-md"></i>
                                                        </a>
            
                                                       <!-- Mark as Done Button -->
                                                        <form action="<?php echo e(route('process.done', $process->id)); ?>" method="POST" style="display:inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?> <!-- Specify the method as PUT -->
                                                            <button type="submit" class="border-0 bg-transparent <?php if(!$process->proof_payment): ?> text-darkred <?php endif; ?>" title="Mark as Done" <?php if(!$process->proof_payment): ?> disabled <?php endif; ?>>
                                                                <i class="bx bx-check-circle bx-md" style="color: red;"></i>
                                                            </button>
                                                        </form>
            
                                                        <!-- Print Button -->
                                                        <button class="text-primary border-0 bg-transparent" data-toggle="modal" data-target="#printModal-<?php echo e($process->id); ?>" <?php if(!$process->proof_payment): ?> disabled <?php endif; ?>>
                                                            <i class="bx bx-printer bx-md"></i>
                                                        </button>
            
                                                        <!-- View Proof of Payment Icon -->
                                                        <?php if($process->proof_payment): ?>
                                                            <a href="<?php echo e(asset('uploads/proofs/' . $process->proof_payment)); ?>" target="_blank" class="text-info">
                                                                <i class="bx bx-file bx-md" title="View Proof of Payment"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <i class="bx bx-file bx-md text-muted" title="No Proof of Payment Uploaded"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
            
                                                <!-- Modal for Adding Parts -->
                                                <div class="modal fade" id="addPartsModal-<?php echo e($process->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add Parts for <?php echo e($process->user->name ?? 'N/A'); ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo e(route('client.parts.store')); ?>" method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="process_id" value="<?php echo e($process->id); ?>">
                                                                    <div class="form-group">
                                                                        <label>Select Parts</label>
                                                                        <div>
                                                                            <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="parts_ids[]" value="<?php echo e($part->id); ?>" id="part-<?php echo e($part->id); ?>">
                                                                                    <label class="form-check-label" for="part-<?php echo e($part->id); ?>">
                                                                                        <?php echo e($part->name_parts); ?> - $<?php echo e($part->price); ?> (Qty: <?php echo e($part->quantity); ?>)
                                                                                    </label>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Add Parts</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <!-- Modal for Viewing Parts -->
                                                <div class="modal fade" id="viewPartsModal-<?php echo e($process->id); ?>" tabindex="-1" role="dialog" aria-labelledby="viewPartsModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewPartsModalLabel">Parts for <?php echo e($process->user->name ?? 'N/A'); ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    <?php
                                                                        $clientParts = \App\Models\ClientPart::where('process_id', $process->id)->with('part')->get();
                                                                        $totalPrice = 0;
                                                                    ?>
                                                                    <?php $__empty_1 = true; $__currentLoopData = $clientParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                        <li class="list-group-item">
                                                                            <?php echo e($clientPart->part->name_parts ?? 'N/A'); ?> - $<?php echo e($clientPart->part->price ?? 'N/A'); ?>

                                                                        </li>
                                                                        <?php
                                                                            $totalPrice += $clientPart->part->price ?? 0;
                                                                        ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                        <li class="list-group-item">No parts added.</li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                                <?php if($totalPrice > 0): ?>
                                                                    <h5>Total Price: $<?php echo e($totalPrice); ?></h5>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <!-- Print Modal -->
                                                <div class="modal fade" id="printModal-<?php echo e($process->id); ?>" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="printModalLabel">Receipt for <?php echo e($process->user->name ?? 'N/A'); ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Process ID: <?php echo e($process->id); ?></h6>
                                                                <h6>Owner: <?php echo e($process->user->name ?? 'N/A'); ?></h6>
                                                                <h6>Total Price: $<span id="totalPrice-<?php echo e($process->id); ?>"><?php echo e($totalPrice); ?></span></h6>
                                                                <h6>Parts:</h6>
                                                                <ul id="partsList-<?php echo e($process->id); ?>" class="list-group">
                                                                    <?php $__currentLoopData = $clientParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li class="list-group-item">
                                                                            <?php echo e($clientPart->part->name_parts ?? 'N/A'); ?> - $<?php echo e($clientPart->part->price ?? 'N/A'); ?>

                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary" onclick="printReceipt('<?php echo e($process->id); ?>')" <?php if(!$process->proof_payment): ?> disabled <?php endif; ?>>
                                                                    Print
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
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
                <b>Version</b> v1
            </div>
        </footer>
    </div>
    <!-- jQuery -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>

</body>
<script>
    function printReceipt(processId) {
        // Get the process data dynamically
        const processIdElement = document.querySelector(`#printModal-${processId} h6:nth-child(1)`).innerText;
        const ownerElement = document.querySelector(`#printModal-${processId} h6:nth-child(2)`).innerText;
        const totalPriceElement = document.querySelector(`#totalPrice-${processId}`).innerText;
        const partsListElement = document.querySelectorAll(`#partsList-${processId} .list-group-item`);

        // Prepare the content in a string format resembling a table
        let receiptContent =
            `${processIdElement}\n${ownerElement}\nTotal Price: $${totalPriceElement}\n\nParts List:\n`;
        receiptContent += "-----------------------------\n";
        receiptContent += "Part Name\t\tPrice\n";
        receiptContent += "-----------------------------\n";

        // Loop through parts and add each to the receipt content
        partsListElement.forEach((item) => {
            let partText = item.innerText.split(" - ");
            receiptContent += `${partText[0]}\t\t${partText[1]}\n`;
        });

        receiptContent += "-----------------------------\n";
        receiptContent += `Total Price:${totalPriceElement}\n`;

        // Open a new window and print only the text content, styled for A5
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Receipt</title>');

        // Add CSS for A5 paper and to remove blank spaces
        printWindow.document.write(`
        <style>
            @page {
                size: A5;
                margin: 0;
            }
            body {
                font-family: Arial, sans-serif;
                margin: 10mm;
            }
            pre {
                font-size: 12px;
                line-height: 1.5;
            }
        </style>
    </head><body><pre>`);

        printWindow.document.write(receiptContent); // Adding the formatted content to the window
        printWindow.document.write('</pre></body></html>');
        printWindow.document.close();
        printWindow.focus();

        // Trigger the print functionality
        printWindow.print();
        printWindow.close();
    }
</script>

</html>
<?php /**PATH /Users/mac/Documents/3rdyr/LARAVEL2/laravel from git/autoservs1 2/resources/views/admin/inprocess.blade.php ENDPATH**/ ?>