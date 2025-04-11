<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTOSERV | FRONT PAGE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar span {
            color: #e74c3c;
        }

        .nav-links {
            display: flex;
            list-style: none;
            margin-left: auto;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links li a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links li a:hover,
        .nav-links li a.active {
            color: #e74c3c;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 1;
        }

        .dropdown-content a {
            padding: 10px 15px;
            display: block;
            color: #333;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #f8f9fa;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            flex-direction: column;
            justify-content: space-between;
            height: 20px;
        }

        .bar {
            width: 25px;
            height: 3px;
            background-color: #333;
            transition: transform 0.3s, opacity 0.3s;
        }

        /* Sidebar for Mobile */
        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 250px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 1001;
        }

        .sidebar.active {
            right: 0;
        }

        .sidebar .nav-links {
            flex-direction: column;
            padding: 20px;
        }

        .sidebar .nav-links li {
            margin: 15px 0;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .overlay.active {
            display: block;
        }

        /* Hero Section */
        .home {
            position: relative;
            text-align: center;
            margin-bottom: 40px;
        }

        .home img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 36px;
            font-weight: 600;
            background-color: rgba(231, 76, 60, 0.8);
            padding: 20px;
            border-radius: 10px;
        }

        /* Category Section */
        .category {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 40px 20px;
        }

        .box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .box h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #e74c3c;
        }

        .box p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .box a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .box a:hover {
            background-color: #c0392b;
        }

        /* About Section */
        .about {
            background-color: #fff;
            padding: 60px 20px;
            text-align: center;
        }

        .about h1 {
            font-size: 36px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .about p {
            font-size: 16px;
            color: #666;
            max-width: 800px;
            margin: 0 auto 20px;
            line-height: 1.8;
        }

        .about .images {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .about img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: #fff;
            padding: 40px 20px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact p {
            margin-bottom: 10px;
        }

        .social a {
            margin-left: 10px;
        }

        .social img {
            width: 30px;
            height: 30px;
            transition: transform 0.3s;
        }

        .social img:hover {
            transform: scale(1.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .nav-links {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .sidebar .nav-links {
                display: flex;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .social {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../dist/img/autoservbg.png" alt="Logo" class="logo-img">
            <span>
                <h1>AUTOSERVS</h1>
            </span>
        </div>
        <ul class="nav-links">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li class="dropdown">
                <a href="#service" class="dropbtn">Services</a>
                <div class="dropdown-content">
                    <a href="#service1">Engine Repair</a>
                    <a href="#service2">Tire Replacement</a>
                    <a href="#service3">Oil Change</a>
                </div>
            </li>
            <li><a href="#footer">Contact</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Sign Up</a>
                <div class="dropdown-content">
                    <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>">Log In</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>">Register</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleSidebar()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </nav>

    <!-- Sidebar for Mobile -->
    <div class="sidebar">
        <ul class="nav-links">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li class="dropdown">
                <a href="#service" class="dropbtn">Services</a>
                <div class="dropdown-content">
                    <a href="#service1">Engine Repair</a>
                    <a href="#service2">Tire Replacement</a>
                    <a href="#service3">Oil Change</a>
                </div>
            </li>
            <li><a href="#footer">Contact</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Sign Up</a>
                <div class="dropdown-content">
                    <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>">Log In</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>">Register</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>

    <!-- Overlay for Sidebar -->
    <div class="overlay" onclick="toggleSidebar()"></div>

    <!-- Hero Section -->
    <div class="home" id="home">
        <div class="image-container">
            <img src="<?php echo e(asset('dist/img/automotive1.webp')); ?>" alt="Car-Service">
            <div class="text-overlay">Your Trusted Auto Service Partner</div>
        </div>
    </div>

    <!-- Category Section -->
    <div class="category">
        <div class="box">
            <h3>MECHANICS</h3>
            <p>Receive expert, hands-on care for your vehicle with our mechanics service. Our skilled mechanics are
                dedicated to delivering high-quality automotive solutions, whether for routine maintenance or complex
                repairs.</p>
            <a href="#">VIEW</a>
        </div>
        <div class="box">
            <h3>TIRE SERVICES</h3>
            <p>Ensure your tires are in optimal condition with our comprehensive tire services. We provide a range of
                solutions, including inspections, rotations, balancing, and alignments.</p>
            <a href="#">VIEW</a>
        </div>
        <div class="box">
            <h3>BREAKDOWN SERVICES</h3>
            <p>Reliable breakdown services are available during business hours to get you back on the road quickly and
                safely. Our expert team is ready to provide prompt assistance.</p>
            <a href="#">VIEW</a>
        </div>
        <div class="box">
            <h3>CAR DETAILING</h3>
            <p>Keep your car looking pristine with our professional detailing service. Our skilled team uses
                high-quality products and techniques to thoroughly clean and restore your vehicle.</p>
            <a href="#">VIEW</a>
        </div>
    </div>

    <!-- About Section -->
    <div class="about" id="about">
        <h1>About Autoserve</h1>
        <p>We are a trusted and reliable company, committed to providing high-quality services that meet your needs. Our
            skilled professionals ensure that every project is handled with care, expertise, and dedication.</p>
        <div class="images">
            <img src="<?php echo e(asset('dist/img/CarRepairContent.webp')); ?>" alt="repair">
            <img src="<?php echo e(asset('dist/img/CarRepairContent1.webp')); ?>" alt="repair">
            <img src="<?php echo e(asset('dist/img/repair.jpg')); ?>" alt="repair">
        </div>
    </div>

    <!-- Footer Section -->
    <footer id="footer">
        <div class="footer-content">
            <div class="contact">
                <p>Contact Us:</p>
                <p>📞 +63 915 212 3234</p>
                <p>📧 autoservs@gmail.com</p>
            </div>
            <div class="social">
                <p>FOLLOW US:</p>
                <a href="https://www.facebook.com/MAZEFY00/">
                    <img src="<?php echo e(asset('dist/img/Facebook-removebg-preview (1).png')); ?>" alt="Facebook">
                </a>
                <a href="#"><img src="<?php echo e(asset('dist/img/ig-removebg-preview.png')); ?>" alt="Instagram"></a>
                <a href="#"><img src="<?php echo e(asset('dist/img/twitter-removebg-preview.png')); ?>" alt="Twitter"></a>
            </div>
        </div>
    </footer>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close Sidebar when clicking outside
        document.querySelector('.overlay').addEventListener('click', toggleSidebar);
    </script>
</body>

</html><?php /**PATH C:\Users\John Michael Jonatas\Documents\advanceprog\autoservs1\resources\views/client/index.blade.php ENDPATH**/ ?>