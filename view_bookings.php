<?php
include('db_connect.php'); // Database connection

// Ensure session is started only if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_log.php");
    exit();
}

// Get the tour_id from URL
$tour_id = $_GET['tour_id'];

// Fetch the tour name for the given tour_id
$tour_query = "SELECT tour_name FROM tour WHERE tour_id = ?";
$tour_name = "Unknown Tour"; // Default in case the query fails

if ($stmt = $conn->prepare($tour_query)) {
    $stmt->bind_param('i', $tour_id); // Bind the tour_id
    $stmt->execute();
    $stmt->bind_result($fetched_tour_name);
    if ($stmt->fetch()) {
        $tour_name = $fetched_tour_name;
    }
    $stmt->close();
}

// Prepare the query to get bookings for the specific tour
$query = "
    SELECT
        customer.customer_id,
        customer.name AS customer_name,
        booking.booking_id,
        booking.booking_date,
        customer.valid_id_path,
        payment.amount_paid,
        payment.reference_no,
        payment.payment_proof
    FROM booking
    JOIN customer ON booking.customer_id = customer.customer_id
    LEFT JOIN payment ON payment.booking_id = booking.booking_id
    WHERE booking.tour_id = ?
    ORDER BY booking.booking_date DESC  /* Sort bookings by date, newest first */
";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param('i', $tour_id); // Bind the tour_id
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="css/view_bookings2.css">
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <div class="back-button">
            <a href="upcoming_tours.php" class="back-link">⟵ Back to Upcoming Tours</a>
        </div>

        <!-- Page Header -->
        <h1 class="header">Bookings for Tour: <?php echo htmlspecialchars($tour_name); ?></h1>

        <?php if (isset($result) && $result->num_rows > 0): ?>
            <div class="table-container">
                <div class="table-header">
                    <div class="table-column">Customer Name</div>
                    <div class="table-column">Booking Date</div>
                    <div class="table-column">Valid ID</div>
                    <div class="table-column">Payment Status</div> <!-- New column for payment status -->
                    <div class="table-column">Ref. No</div>
                    <div class="table-column">Payment_proof</div>
                </div>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="table-row">
                        <div class="table-column">
                            <?php echo htmlspecialchars($row['customer_name']); ?>
                        </div>
                        <div class="table-column">
                            <?php echo htmlspecialchars($row['booking_date']); ?>
                        </div>
                        <div class="table-column">
                                <?php 
                                // Check if there is a valid ID and display it
                                if (!empty($row['valid_id_path'])):
                                    // Convert the LONGBLOB binary data to base64 for display
                                    $imageData = $row['valid_id_path'];
                                    $base64Image = base64_encode($imageData);
                                    // Display the image as base64
                                    echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Valid ID" class="valid-id-img" />';
                                else:
                                    // Display default message or image if no valid ID is provided
                                    echo '<span>No ID Provided</span>';
                                endif;
                                ?>
                            </div>
                        <div class="table-column">
                            <?php 
                            // Check if payment status exists, otherwise show "Payment Pending"
                            echo !empty($row['amount_paid']) ? htmlspecialchars($row['amount_paid']) : "Payment Pending";
                            ?>
                        </div>
                        <div class="table-column">
                            <?php echo htmlspecialchars($row['reference_no']); ?>
                        </div>
                        <div class="table-column">
                            <?php 
                            // Check if there is a payment proof image and display it
                            if (!empty($row['payment_proof'])):
                                $paymentProof = base64_encode($row['payment_proof']); // Base64 encode payment proof
                                echo '<img src="data:image/jpeg;base64,' . $paymentProof . '" alt="Payment Proof" class="payment-proof-img" />';
                            else:
                                echo '<span>No Payment Proof</span>';
                            endif;
                            ?>
                        </div>
                                            </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-bookings">No bookings for this tour.</p>
        <?php endif; ?>

        <!-- Close the database connection -->
        <?php $conn->close(); ?>
    </div>
    <div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
    <div id="caption"></div>
</div>
<script>
var modal = document.getElementById("imageModal");

// Get the image and insert it inside the modal
function openModal(imageSrc) {
    var modalImage = document.getElementById("modalImage");
    var caption = document.getElementById("caption");

    modal.style.display = "block";  // Show the modal
    modalImage.src = imageSrc;  // Set the image source
    caption.innerHTML = "Click to close";  // Optional caption text
}

// Close the modal
function closeModal() {
    modal.style.display = "none";
}

// Add event listener to images for opening the modal
document.querySelectorAll('.valid-id-img, .payment-proof-img').forEach(function(img) {
    img.addEventListener('click', function() {
        openModal(this.src); // Open modal with the clicked image's src
    });
});
</script>
</body>
</html>
