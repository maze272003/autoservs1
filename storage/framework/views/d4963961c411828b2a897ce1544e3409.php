
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'Laravel')); ?> | Notification</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">

    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/summernote-bs4.min.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/booking.css')); ?>">
</head>
<style>
    .rating {
display: flex;
flex-direction: row-reverse; /* Fixes the reverse hover */
justify-content: center;
}

.rating input {
display: none; /* Hide the radio buttons */
}

.rating label {
font-size: 2em;
color: gray;
cursor: pointer;
}

/* Default color for stars */
.rating label:hover,
.rating label:hover ~ label {
color: gold; /* Change star color on hover */
}

/* When a star is clicked, this keeps the star filled */
.rating input:checked ~ label {
color: gold;
}
/* Enhanced button design */
.btn-primary {
    background: linear-gradient(135deg, #4A90E2, #003366); /* Gradient background */
    border: none;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 50px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #003366, #4A90E2); /* Reverse the gradient */
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px); /* Slight lift on hover */
}

.btn-primary:active {
    background: #003366; /* Darker background on click */
    box-shadow: none;
    transform: translateY(0); /* No lift on click */
}

/* Styling for the heading and label */
h1 {
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 700;
    color: #003366;
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 20px;
}

label {
    font-family: 'Source Sans Pro', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    display: inline-block;
}

/* Form group styling */
.form-group {
    margin-bottom: 20px;
}

/* Rating stars */
.rating label {
    font-size: 2em;
    color: #ddd;
    cursor: pointer;
    transition: color 0.3s ease;
}

.rating label:hover,
.rating label:hover ~ label {
    color: gold;
}

.rating input:checked ~ label {
    color: gold;
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
                        <!-- PROFILE -->
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
                            <a href="<?php echo e(route('ratings')); ?>" class="nav-link active">
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
            <br>
            <br>
            <br>

            <br>
            <br>

            <section>
                <!-- /.content-header -->
                <!-- content -->
                <!-- /.col -->
                <!-- content -->
                <div class="container mt-5">
                    <h1 class="text-center">Submit Your Rating</h1>

                    <!-- Display success message -->
                    <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>

                    <!-- Rating Form -->
                    <form action="<?php echo e(route('ratings.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group text-center">
                            <label for="rating">Rate this project (1-5):</label>
                            <div class="rating">
                                <input type="radio" name="rating" id="star5" value="5">
                                <label for="star5">&#9733;</label>
                                <input type="radio" name="rating" id="star4" value="4">
                                <label for="star4">&#9733;</label>
                                <input type="radio" name="rating" id="star3" value="3">
                                <label for="star3">&#9733;</label>
                                <input type="radio" name="rating" id="star2" value="2">
                                <label for="star2">&#9733;</label>
                                <input type="radio" name="rating" id="star1" value="1">
                                <label for="star1">&#9733;</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
                        </div>
                    </form>
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
    <!-- JavaScript to handle star rating -->
    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('mouseover', function () {
                resetStars();
                highlightStars(this.dataset.value);
            });

            star.addEventListener('click', function () {
                selectedRating = this.dataset.value;
                ratingInput.value = selectedRating;
                setActiveStars(selectedRating);
            });

            star.addEventListener('mouseout', function () {
                if (!selectedRating) {
                    resetStars();
                } else {
                    setActiveStars(selectedRating);
                }
            });
        });

        function highlightStars(rating) {
            stars.forEach(star => {
                if (star.dataset.value <= rating) {
                    star.classList.add('hover');
                }
            });
        }

        function resetStars() {
            stars.forEach(star => {
                star.classList.remove('hover');
            });
        }

        function setActiveStars(rating) {
            stars.forEach(star => {
                star.classList.remove('active');
                if (star.dataset.value <= rating) {
                    star.classList.add('active');
                }
            });
        }
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
</body>

</html>
<?php /**PATH C:\Users\John Michael Jonatas\Documents\advanceprog\autoservs1\resources\views/ratings.blade.php ENDPATH**/ ?>