<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_log.php");
    exit();
}

// Fetch exclusive tours
$query = "SELECT * FROM tour WHERE is_exclusive = 1 ORDER BY start_date ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusive Tours</title>
    <link rel="stylesheet" href="css/exclusive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="main-container">
        <header class="main-header">
            <div class="header-logo-text">
                <img src="image/logo.png" alt="Logo" class="logo-image">
                <span class="header-text">Higanteng Laagan Travel & Tours</span>
            </div>
            <nav class="header-navHP">
                <a href="admin_tour.php" class="nav-linkHP">TOURS</a>
                <a href="tour_add.php" class="nav-linkHP">+ADD NEW TOURS</a>
                <a href="admin_about.php" class="nav-linkHP">ABOUT US</a>
                <a href="review.php" class="nav-linkHP">REVIEW</a>
                <a href="admin_notifications.php" class="nav-linkHP">NOTIFICATION</a>
                <a href="admin_dashboard.php" class="nav-linkHP">DASHBOARD</a>
                <a href="logout.php" class="logout-button">LOGOUT</a>
            </nav>
        </header>

        <div class="main-container">
    <div class="container">
        <h2>Exclusive Tours</h2>

        <div class="exclusive-tours-container">
            <?php
            // Fetch exclusive tours from the database
            include('db_connect.php');
            $query = "SELECT * FROM tour WHERE is_exclusive = 1";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h3>" . htmlspecialchars($tour['tour_name']) . "</h3>";
                    echo "<p><strong>Start Date:</strong> " . htmlspecialchars($tour['start_date']) . "</p>";
                    echo "<p><strong>Description:</strong> " . htmlspecialchars($tour['description']) . "</p>";
                    echo "<p><strong>Price per Person:</strong> " . $currency_symbol . number_format($tour['price_per_person'], 2) . "</p>";
                    echo "</div>";
    
                    $image_path = htmlspecialchars($row['image_path']);
            ?>
                    <div class="tour-card">
                        <img src="<?php echo $image_path; ?>" alt="Tour Image" class="tour-image">
                        <div class="tour-content">
                            <h3 class="tour-title"><?php echo $tour_name; ?></h3>
                            <p class="tour-description"><?php echo $tour_description; ?></p>
                            <p class="tour-dates">
                                <strong>Start:</strong> <?php echo $start_date; ?><br>
                                <strong>End:</strong> <?php echo $end_date; ?>
                            </p>
                            <div class="tour-action">
                                <a href="tour_details.php?tour_id=<?php echo $tour_id; ?>" class="view-details-btn">View Details</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No exclusive tours available at the moment.</p>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
