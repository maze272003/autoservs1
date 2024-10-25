<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AUTOSERV | FRONT PAGE</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background-color: rgb(235, 235, 235);
        font-family: abril, fatface;
    }

    /* Navbar */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 50px;
        background-color: #e6e6e6;
        border-bottom: 1px solid #ddd;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar span {
        color: #fc0505;
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
        font-size: 20px;
        transition: color 0.3s;
    }

    /* Active link style */
    .nav-links li a.active {
        color: red;
    }

    /* Add hover effect for navigation links */
    .nav-links li a:hover {
        color: red;
    }

    /* Dropdown menu */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
        text-align: left;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    /* Show the dropdown on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Add arrow down on hover */
    .dropbtn::after {

        display: inline-block;
        margin-left: 5px;
        border-width: 5px;
        border-style: solid;
        border-color: transparent transparent transparent black;
        /* Arrow pointing right */
        transition: transform 0.2s ease;
    }

    /* Rotate the arrow to point down on hover */
    .dropdown:hover .dropbtn::after {
        transform: rotate(1deg);
        /* Rotate to make the arrow point down */
        border-color: black transparent transparent transparent;
        /* Arrow pointing down */
    }

    /* Styling hover background */
    .dropbtn:hover {
        background-color: #ddd;
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
    }

    /* Category Section */
    .category {
        display: flex;
        justify-content: space-around;
        padding: 30px;
        flex-wrap: wrap;
    }

    .box {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Applied box shadow */
        width: 300px;
        padding: 40px 30px;
        text-align: center;
        margin-bottom: 20px;
    }

    .box h3 {
        margin-bottom: 15px;
        font-size: 2rem;
        color: #333;
    }

    .box p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 20px;
    }

    .box a {
        display: inline-block;
        padding: 10px 15px;
        background-color: red;
        color: white;
        text-decoration: none;
        border-radius: 3px;
        transition: background-color 0.3s;
    }

    .box a:hover {
        background-color: darkred;
    }

    /* From Uiverse.io by d4niz */
    .contactButton {
        background: #f70a0acc;
        color: white;
        font-family: inherit;
        padding: 0.45em;
        padding-left: 1em;
        font-size: 17px;
        font-weight: 500;
        border-radius: 0.9em;
        border: none;
        cursor: pointer;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        box-shadow: inset 0 0 1.6em -0.6em #f72323dc;
        overflow: hidden;
        position: relative;
        height: 2.8em;
        padding-right: 3em;
        left: 46%;
        bottom: 580px;
    }

    .iconButton {
        margin-left: 1em;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 2.2em;
        width: 2.2em;
        border-radius: 0.7em;
        box-shadow: 0.1em 0.1em 0.6em 0.2em #f82c25;
        right: 0.3em;
        transition: all 0.3s;
    }

    .contactButton:hover {
        transform: translate(-0.05em, -0.05em);
        box-shadow: 0.15em 0.15em #fc0505;
    }

    .contactButton:active {
        transform: translate(0.05em, 0.05em);
        box-shadow: 0.05em 0.05em #ff1313d2;
    }

    /* Home Image Section */
    .home {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .home img {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }

    .image-container {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .text-overlay {
        position: absolute;
        top: 25%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: rgb(248, 48, 48);
        font-size: 30px;
        font-weight: bold;
        background-color: rgba(255, 255, 255, 0.637);
        /* Optional: darken the background behind the text */
        padding: 10px;
        border-radius: 5px;
        /* Optional: rounded corners */
        text-align: center;
        width: 30%;

        /* Ensures text spans the width of the image */
    }


    /* About Section */
    .about {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 80px 20px;
        background-color: #f5f5f5;
        margin-top: 20px;
    }

    .about h1 {
        font-size: 4rem;
        color: #ff0000;
        margin-bottom: 15px;
    }

    .about p {
        font-size: 1.5rem;
        color: #111111;
        max-width: 800px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .about .images {
        display: flex;
        gap: 20px;
        /* Adjust the spacing between images */
        justify-content: center;
        flex-wrap: wrap;
        /* Allows images to wrap on smaller screens */
    }

    .about img {
        max-width: 100%;
        height: auto;
        width: 200px;
        /* Adjust the size as needed */
        border-radius: 8px;
        /* Optional: adds rounded corners to images */
    }


    /* Footer */
    footer {
        background-color: #4a4a4a;
        color: white;
        padding: 20px;
        text-align: left;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .contact p {
        margin-bottom: 10px;
    }

    .social {
        text-align: right;
    }

    .social a {
        margin-left: 10px;
    }

    .social img {
        width: 30px;
        margin-right: 10px;
    }

    .social .autoserv-logo {
        width: 100px;
        margin-left: 100px;
    }


    /* Hide navigation links on smaller screens */
    @media (max-width: 768px) {
        .nav-links {
            position: absolute;
            right: 0;
            top: 60px;
            height: 0;
            width: 100%;
            background-color: #dddddd;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
            transition: height 0.3s ease;
        }

        .nav-links.active {
            height: 200px;
            /* Adjust this value based on the number of nav items */
        }

        .nav-links li {
            margin: 10px 0;
        }

        .hamburger {
            display: flex;
        }

        .footer-content {
            flex-direction: column;
            text-align: center;
        }

        .social {
            margin-top: 20px;
        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1000;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-check {
            margin-top: 10px;
        }

        button {
            margin-right: 5px;
        }
    }



    /* Responsive adjustments */
    @media (max-width: 480px) {
        .about h1 {
            font-size: 1.5rem;
        }

        .about p {
            font-size: 0.9rem;
        }
    }
</style>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../dist/img/autoservbg.png" alt="Logo" class="logo-img">
            <span>
                <h1>AUTOSERVS</h1>
            </span>
        </div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
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

        <div class="hamburger" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </nav>

    <!-- Image Section -->
    <div class="home" id="home">
        <div class="image-container">
            <img src="<?php echo e(asset('dist/img/automotive1.webp')); ?>" alt="Car-Service">

            
        </div>
    </div>


    <form action="<?php echo e(route('register')); ?>" method="GET" class="inline">
        <button type="submit" class="contactButton">
            Book Now
            <div class="iconButton">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                        fill="currentColor"></path>
                </svg>
            </div>
        </button>
    </form>
    <!-- category -->
    <div class="category">
        <div class="box">
            <h3>MECHANICS</h3>
            <p>Receive expert, hands-on care for your vehicle with our mechanics service. Our skilled mechanics are
                dedicated to delivering high-quality automotive solutions, whether for routine maintenance or complex
                repairs. With the latest tools and technology, we ensure your car performs at its best and stays safe on
                the road.</p>
            <a href="#">VIEW</a>
        </div>

        <div class="box">
            <h3>TIRE SERVICES</h3>
            <p>Ensure your tires are in optimal condition with our comprehensive tire services. We provide a range of
                solutions, including inspections, rotations, balancing, and alignments. Our expert team focuses on
                maintaining your tires for even wear and longevity.</p>
            <a href="#">VIEW</a>
        </div>

        <div class="box">
            <h3>BREAKDOWN SERVICES</h3>
            <p>Reliable breakdown services are available during business hours to get you back on the road quickly and
                safely. Our expert team is ready to provide prompt assistance, offering thorough diagnostics and
                efficient repairs. With a focus on exceptional customer service.</p>
            <a href="#">VIEW</a>
        </div>

        <div class="box">
            <h3>CAR DETAILING</h3>
            <p>Keep your car looking pristine with our professional detailing service. Our skilled team uses
                high-quality products and techniques to thoroughly clean and restore both the interior and exterior of
                your vehicle. From hand washes and waxing to upholstery cleaning. </p>
            <a href="#">VIEW</a>
        </div>
    </div>

    <!-- About Section -->
    <div class="about" id="about">
        <h1>About Autoserve</h1>
        <p>We are a trusted and reliable company, committed to providing high-quality services that meet your needs. Our
            skilled professionals ensure that every project is handled with care, expertise, and dedication. At
            Autoserve, customer satisfaction is our priority.</p>
        <hr>
        <p>Founded on the principles of excellence and reliability, we offer a wide range of services to ensure your
            vehicle runs smoothly. From routine maintenance and repairs to emergency breakdown services, our team is
            equipped with the latest tools and techniques to deliver outstanding results.</p>
        <hr>
        <p>Our commitment to quality is reflected in our use of high-grade parts and our adherence to industry
            standards. We take pride in our transparent pricing and the personalized care we provide to each customer.
            Whether you're looking for expert advice or need urgent assistance, we are here to help with a smile.</p>
        <p>Thank you for choosing Autoserve. We look forward to serving you and ensuring your complete satisfaction.</p>
        <div class="images">
            <img src="<?php echo e(asset('dist/img/repair.jpg')); ?>" alt="repair">
            <img src="<?php echo e(asset('dist/img/repair.jpg')); ?>" alt="repair">
            <img src="<?php echo e(asset('dist/img/repair.jpg')); ?>" alt="repair">
        </div>
    </div>

    <!-- Footer Section -->
    <footer id="footer">
        <div class="footer-content">
            <div class="contact">
                <p>Contact Us:</p>
                <p>📞 +63 915 212 3234</p>
                <p>💬 Chat with autoserv</p>
                <p>📧 autoservs@gmail.com</p>
            </div>
            <div class="social">
                <p>FOLLOW US:</p>
                <a href="https://www.facebook.com/MAZEFY00/">
                    <img src="<?php echo e(asset('dist/img/Facebook-removebg-preview (1).png')); ?>" alt="Facebook">
                </a>
                <a href="#"><img src="<?php echo e(asset('dist/img/ig-removebg-preview.png')); ?>" alt="Instagram"></a>
                <a href="#"><img src="<?php echo e(asset('dist/img/twitter-removebg-preview.png')); ?>" alt="Twitter"></a>
                <img src="<?php echo e(asset('dist/img/autoservbg.png')); ?>" alt="Autoserv Logo" class="autoserv-logo">
            </div>
        </div>
    </footer>

</body>
<script>
    // for Get all nav items
    const navItems = document.querySelectorAll('.nav-item');
    // Add click event to each nav item
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Prevent default anchor behavior
            e.preventDefault();

            // Remove 'active' class from all nav items
            navItems.forEach(link => link.classList.remove('active'));

            // Add 'active' class to the clicked nav item
            this.classList.add('active');

            // Get the target section by the href attribute
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);

            // Scroll to the target section with smooth behavior
            targetSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
    // for Get all nav items


    // for burgir
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }

    // Event listeners for modals
    document.getElementById('myBtn').addEventListener('click', function() {
        document.getElementById('myModal').style.display = 'block';
    });

    document.getElementById('closeSignIn').addEventListener('click', function() {
        document.getElementById('myModal').style.display = 'none';
    });

    document.getElementById('openRegisterModal').addEventListener('click', function() {
        document.getElementById('myModal').style.display = 'none';
        document.getElementById('registerModal').style.display = 'block';
    });

    document.getElementById('closeRegister').addEventListener('click', function() {
        document.getElementById('registerModal').style.display = 'none';
    });

    document.getElementById('backToSignIn').addEventListener('click', function() {
        document.getElementById('registerModal').style.display = 'none';
        document.getElementById('myModal').style.display = 'block';
    });
    // for burgir
</script>

</html>
<?php /**PATH /Users/mac/Documents/3rdyr/LARAVEL2/laravelfromgit/Autoservs1stSem/resources/views/client/index.blade.php ENDPATH**/ ?>