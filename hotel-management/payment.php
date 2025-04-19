<?php
include('includes/db.php');

// Get booking ID passed via URL
$booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : null;
if (!$booking_id) {
    echo "<p style='color:red;'>Invalid access: Booking ID not found.</p>";
    exit();
}

// Fetch booking details with customer & room info
$query = "SELECT b.booking_id, b.check_in_date, b.check_out_date, c.name, r.room_type, r.price 
          FROM bookings b
          JOIN customers c ON b.customer_id = c.customer_id
          JOIN rooms r ON b.room_id = r.room_id
          WHERE b.booking_id = $booking_id";
$result = mysqli_query($conn, $query);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    echo "<p style='color:red;'>Booking not found!</p>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Record Payment</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f6fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 450px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .details {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 5px solid #007bff;
            font-size: 14px;
        }

        label {
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .receipt {
    background-color: #f9f9f9;
    border: 2px dashed #ccc;
    padding: 25px;
    margin-top: 30px;
    border-radius: 8px;
    width: 100%;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
    font-size: 16px;
    color: #333;
}

.receipt h2 {
    text-align: center;
    color: #28a745;
    margin-bottom: 20px;
}

    </style>
</head>
<body>

<div class="container">
    <h2>💳 Record Payment</h2>

    <div class="details">
        <p><strong>Booking ID:</strong> <?= $booking['booking_id'] ?></p>
        <p><strong>Customer:</strong> <?= $booking['name'] ?></p>
        <p><strong>Room Type:</strong> <?= $booking['room_type'] ?></p>
        <p><strong>Price (per night):</strong> ₹<?= $booking['price'] ?></p>
        <p><strong>Stay:</strong> <?= $booking['check_in_date'] ?> to <?= $booking['check_out_date'] ?></p>
    </div>

    <form method="POST">
        <label>Total Amount (₹):</label>
        <input type="number" name="amount" required placeholder="Enter amount">

        <input type="submit" name="submit" value="Record Payment">
    </form>

    <?php
if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];

    // Insert payment
    $insert = "INSERT INTO payments (booking_id, amount, payment_date) 
               VALUES ($booking_id, $amount, NOW())";
    if (mysqli_query($conn, $insert)) {
        // Fetch payment ID and show receipt
        $payment_id = mysqli_insert_id($conn);

        echo "<div class='receipt'>
                <h2>🧾 Payment Receipt</h2>
                <p><strong>Receipt ID:</strong> $payment_id</p>
                <p><strong>Booking ID:</strong> {$booking['booking_id']}</p>
                <p><strong>Customer Name:</strong> {$booking['name']}</p>
                <p><strong>Room Type:</strong> {$booking['room_type']}</p>
                <p><strong>Stay Duration:</strong> {$booking['check_in_date']} to {$booking['check_out_date']}</p>
                <p><strong>Amount Paid:</strong> ₹$amount</p>
                <p><strong>Payment Date:</strong> " . date('Y-m-d H:i:s') . "</p>

                <button onclick='window.print()' style='margin-top: 20px; padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 6px; cursor: pointer;'>🖨️ Print Receipt</button>
              </div>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . mysqli_error($conn) . "</p>";
    }
}
?>


    <a class="back-link" href="index.php">← Back to Dashboard</a>
</div>

</body>
</html>
