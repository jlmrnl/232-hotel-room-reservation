<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$success = $error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_type = isset($_POST['room_type']) ? trim($_POST['room_type']) : '';
    $check_in = isset($_POST['check_in']) ? trim($_POST['check_in']) : '';
    $check_out = isset($_POST['check_out']) ? trim($_POST['check_out']) : '';
    $user_email = $_SESSION['user'];

    // Validate fields
    if (!empty($room_type) && !empty($check_in) && !empty($check_out)) {
        if ($check_in >= $check_out) {
            $error = "Check-out date must be after check-in date.";
        } else {
            $stmt = $conn->prepare("INSERT INTO bookings (user_email, room_type, check_in, check_out) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $user_email, $room_type, $check_in, $check_out);

            if ($stmt->execute()) {
                $success = "Room booked successfully!";
            } else {
                $error = "Error booking the room.";
            }
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>
    <link href="assets/bootstrap5/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }
        .booking-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            border-radius: 50px;
        }
    </style>
</head>
<body>

    <div class="booking-container">
        <h2 class="text-center mb-4">Book a Room</h2>
        
        <!-- Display success or error messages -->
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label>Room Type:</label>
                <select class="form-control" name="room_type" required>
                    <option value="">Select Room Type</option>
                    <option value="Single">Single Room</option>
                    <option value="Double">Double Room</option>
                    <option value="Suite">Suite</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Check-in Date:</label>
                <input type="date" class="form-control" name="check_in" required>
            </div>
            <div class="mb-3">
                <label>Check-out Date:</label>
                <input type="date" class="form-control" name="check_out" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Book Now</button>
        </form>
    </div>

</body>
</html>