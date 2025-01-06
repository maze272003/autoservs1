<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'Laravel')); ?> | Notification</title>  <title>Client | Notification</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/booking.css')); ?>">
    <!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

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
                            <a href="<?php echo e(route('dashboard')); ?>" class="nav-link">
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
                            <a href="<?php echo e(route('messages.notification')); ?>" class="nav-link active">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>Notification</p>
                                <?php if($unreadCount > 0): ?>
                                    <span class="badge badge-danger right"><?php echo e($unreadCount); ?></span>
                                <?php endif; ?>
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
                            <h1 class="m-0">NOTIFICATIONS</h1>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            
            <section>
                <div class="col-md-15">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Inbox</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <button id="deleteSelected" class="btn btn-danger btn-sm ml-2" title="Delete Selected" style="display: none;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search Mail">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody id="messageTableBody">
                                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" class="message-checkbox" value="<?php echo e($message->id); ?>" id="check<?php echo e($message->id); ?>">
                                                        <label for="check<?php echo e($message->id); ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-name"><?php echo e($message->email); ?></td>
                                                <td class="mailbox-subject"><?php echo e($message->message); ?></td>
                                                <td class="mailbox-date" data-created-at="<?php echo e($message->created_at); ?>"><?php echo e($message->created_at->diffForHumans()); ?></td>
                                                <td>
                                                    <!-- Link to open modal -->
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#repliesModal<?php echo e($message->id); ?>">View Replies</button>
                                                </td>
                                            </tr>
            
                                            <!-- Modal for Replies -->
                                            <div class="modal fade" id="repliesModal<?php echo e($message->id); ?>" tabindex="-1" role="dialog" aria-labelledby="repliesModalLabel<?php echo e($message->id); ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="repliesModalLabel<?php echo e($message->id); ?>">Replies for <?php echo e($message->email); ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php if($message->replies->count() > 0): ?>
                                                                <ul class="list-group">
                                                                    <?php $__currentLoopData = $message->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li class="list-group-item"><?php echo e($reply->reply); ?> (by <?php echo e($reply->user->name); ?>)</li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <p>No replies yet.</p>
                                                            <?php endif; ?>
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
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo e(asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
    
     <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('.mailbox-messages tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = ""; // Show row
                } else {
                    row.style.display = "none"; // Hide row
                }
            });
        });

        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('.mailbox-messages tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = ""; // Show row
                } else {
                    row.style.display = "none"; // Hide row
                }
            });
        });
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

    
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.message-checkbox');
            const deleteButton = document.getElementById('deleteSelected');
    
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // I-toggle ang display ng delete button
                    deleteButton.style.display = Array.from(checkboxes).some(checkbox => checkbox.checked) ? 'inline-block' : 'none';
                });
            });
    
            deleteButton.addEventListener('click', function() {
                const selectedIds = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
    
                if (selectedIds.length > 0) {
                    if (confirm('Are you sure you want to delete the selected messages?')) {
                        // Gumawa ng POST request para i-delete ang mga mensahe
                        fetch('/messages/delete', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            },
                            body: JSON.stringify({ ids: selectedIds }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // I-refresh ang page o i-update ang table
                                location.reload();
                            } else {
                                alert('Failed to delete messages.');
                            }
                        });
                    }
                }
            });
        });
  
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.message-checkbox');
            const deleteButton = document.getElementById('deleteSelected');
    
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Toggle the display of the delete button
                    deleteButton.style.display = Array.from(checkboxes).some(checkbox => checkbox.checked) ? 'inline-block' : 'none';
                });
            });
    
            deleteButton.addEventListener('click', function() {
                const selectedIds = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
    
                if (selectedIds.length > 0) {
                    // Use SweetAlert for confirmation
                    swal({
                        title: 'Are you sure?',
                        text: "You want to delete the selected messages!",
                        icon: 'warning',
                        buttons: {
                            cancel: "Cancel",
                            confirm: {
                                text: "Yes, delete it!",
                                value: true,
                                visible: true,
                                className: "btn-danger",
                                closeModal: true
                            }
                        }
                    }).then((willDelete) => {
                        if (willDelete) {
                            // Make a POST request to delete the messages
                            fetch('/messages/delete', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                },
                                body: JSON.stringify({ ids: selectedIds }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Refresh the page or update the table
                                    location.reload();
                                } else {
                                    alert('Failed to delete messages.');
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.view-replies', function() {
            var messageId = $(this).data('id');
    
            // Fetch replies using AJAX
            $.ajax({
                url: '/client/messages/' + messageId + '/replies', // Adjust the URL as needed
                method: 'GET',
                success: function(data) {
                    $('#repliesList').empty(); // Clear previous replies
                    data.replies.forEach(function(reply) {
                        $('#repliesList').append('<li class="list-group-item">' + reply.message + ' <small class="text-muted">' + reply.created_at + '</small></li>');
                    });
                    $('#repliesModal').modal('show'); // Show the modal
                },
                error: function() {
                    alert('Unable to fetch replies.');
                }
            });
        });
    </script>
</body>

</html>
<?php /**PATH C:\Users\JM\Documents\autoservs1\resources\views/messages/notification.blade.php ENDPATH**/ ?>