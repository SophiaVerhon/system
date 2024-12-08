<?php
session_start();
include('../db_connect.php'); // Database connection

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}
$user_id = $_SESSION['user_id']; // Get the logged-in user ID

// Fetch current bookings (status = 'current')
$current_query = "
    SELECT b.booking_id, t.tour_name, b.booking_date
    FROM booking b
    JOIN tour t ON b.tour_id = t.tour_id
    WHERE b.customer_id = ? AND b.status = 'current'
";
$stmt_current = $conn->prepare($current_query);
$stmt_current->bind_param("i", $user_id); // Bind the user_id or customer_id
$stmt_current->execute();
$current_result = $stmt_current->get_result();

// Fetch completed bookings (status = 'completed')
$completed_query = "
    SELECT b.booking_id, t.tour_name, b.booking_date
    FROM booking b
    JOIN tour t ON b.tour_id = t.tour_id
    WHERE b.customer_id = ? AND b.status = 'completed'
";
$stmt_completed = $conn->prepare($completed_query);
$stmt_completed->bind_param("i", $user_id); // Bind the user_id or customer_id
$stmt_completed->execute();
$completed_result = $stmt_completed->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <link rel="stylesheet" href="bookingstatus.css">
</head>
<body>
    <header>
        <h1>Booking Status</h1>
        <nav>
            <a href="home.php">Go Back to Homepage</a>
            <a href="profile.php">My Profile</a>
            <a href="index.php">Log Out</a>
        </nav>
    </header>

    <!-- Buttons -->
    <div class="button-container">
        <button class="button" id="current-booking-btn">CURRENT BOOKING</button>
        <button class="button" id="completed-btn">COMPLETED</button>
    </div>

    <!-- Current Bookings Section -->
    <div class="status-container" id="current-status">
        <h2>Current Bookings</h2>
        <?php
        if ($current_result->num_rows > 0) {
            while ($row = $current_result->fetch_assoc()) {
                echo "<div class='booking-item'>";
                echo "<p><strong>Tour Name:</strong> " . htmlspecialchars($row['tour_name']) . "</p>";
                echo "<p><strong>Booking Date:</strong> " . htmlspecialchars($row['booking_date']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No current bookings found.</p>";
        }
        ?>
    </div>

    <!-- Completed Bookings Section -->
    <div class="status-container" id="completed-status">
        <h2>Completed Bookings</h2>
        <?php
        if ($completed_result->num_rows > 0) {
            while ($row = $completed_result->fetch_assoc()) {
                echo "<div class='booking-item'>";
                echo "<p><strong>Tour Name:</strong> " . htmlspecialchars($row['tour_name']) . "</p>";
                echo "<p><strong>Booking Date:</strong> " . htmlspecialchars($row['booking_date']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No completed bookings found.</p>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Higanteng Laagan Travel & Tours</p>
    </footer>
</body>
</html>

<?php
// Close the database connections
$stmt_current->close();
$stmt_completed->close();
$conn->close();
?>