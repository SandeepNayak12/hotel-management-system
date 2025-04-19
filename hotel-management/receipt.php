<?php
include('includes/db.php');

if (!isset($_GET['id'])) {
    echo "Booking ID not provided.";
    exit;
}

$booking_id = $_GET['id'];

// Fetch booking details
$sql = "SELECT b.*, c.name, c.email, c.phone, r.room_type, r.price 
        FROM bookings b 
        JOIN customers c ON b.customer_id = c.customer_id 
        JOIN rooms r ON b.room_id = r.room_id 
        WHERE b.booking_id = $booking_id";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Booking not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt #<?php echo $booking_id; ?></title>
</head>
<body>
    <h2>Hotel Booking Receipt</h2>
    <hr>
    <h3>Booking Details</h3>
    <p><strong>Booking ID:</strong> <?php echo $booking_id; ?></p>
    <p><strong>Customer:</strong> <?php echo $data['name']; ?> (<?php echo $data['email']; ?>, <?php echo $data['phone']; ?>)</p>
    <p><strong>Room:</strong> <?php echo $data['room_type']; ?></p>
    <p><strong>Check-In:</strong> <?php echo $data['check_in_date']; ?></p>
    <p><strong>Check-Out:</strong> <?php echo $data['check_out_date']; ?></p>
    <p><strong>Status:</strong> <?php echo $data['status']; ?></p>
    <p><strong>Payment:</strong> <?php echo $data['payment_status']; ?></p>
    <p><strong>Total Paid:</strong> ₹<?php echo $data['total_amount']; ?></p>

    <br><br>
    <button onclick="window.print()">🖨️ Print Receipt</button>
</body>
</html>
