<?php
// index.php - Hotel Room Reservation Homepage
include 'db_config/db_connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Room Reservation</title>
    <link href="assets/bootstrap5/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #fff;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.8);
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
        }

        .hero img {
            max-width: 90%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .hero h1 {
            font-size: 48px;
            font-weight: bold;
            margin-top: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 20px;
            margin-top: 10px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
        }

        .btn-custom {
            padding: 12px 30px;
            font-size: 20px;
            font-weight: bold;
            background: #ff7eb3;
            border: none;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-custom:hover {
            background: #ff4f8b;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🏨 Hotel Booking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="db_config/logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="db_config/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="db_config/signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
    <div class="container">
        <div class="hero">
            <h1>Welcome to ADCB</h1>
            <img src="assets/img/HRRBG.jpg" class="img-fluid" alt="Hotel Background">
            <p class="lead">Experience luxury and comfort with a breathtaking view.</p>
            <a href="db_config/booking.php" class="btn btn-custom">Book Now</a>
        </div>
    </div>

    <script src="assets/bootstrap5/bootstrap.bundle.min.js"></script>
</body>
</html>