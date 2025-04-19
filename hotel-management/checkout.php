<?php
include('includes/db.php');

// Fetch only 'Booked' bookings (not completed)
$sql = "SELECT b.booking_id, c.name AS customer_name, r.room_type
        FROM bookings b
        JOIN customers c ON b.customer_id = c.customer_id
        JOIN rooms r ON b.room_id = r.room_id
        WHERE b.status = 'Booked'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Check-Out</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #eef5fb;
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
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        select, input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        a.back {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>✅ Check-Out</h2>

    <form method="POST" action="">
        <label><strong>Select Booking:</strong></label>
        <select name="booking_id" required>
            <option value="">-- Select Booking --</option>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['booking_id']; ?>">
                    Booking #<?php echo $row['booking_id']; ?> - <?php echo $row['customer_name']; ?> (<?php echo $row['room_type']; ?>)
                </option>
            <?php } ?>
        </select>

        <input type="submit" name="checkout" value="Check-Out">
    </form>

    <?php
    if (isset($_POST['checkout'])) {
        $booking_id = $_POST['booking_id'];

        // 1. Set booking status to 'Completed'
        mysqli_query($conn, "UPDATE bookings SET status = 'Completed' WHERE booking_id = $booking_id");

        // 2. Get the room_id from booking
        $roomResult = mysqli_query($conn, "SELECT room_id FROM bookings WHERE booking_id = $booking_id");
        $room = mysqli_fetch_assoc($roomResult);
        $room_id = $room['room_id'];

        // 3. Set room as available again
        mysqli_query($conn, "UPDATE rooms SET is_available = 1 WHERE room_id = $room_id");

        echo "<p class='success'>Room checked out successfully!</p>";

        // Refresh page to reflect updated bookings
        echo "<script>setTimeout(function(){ window.location.href = 'checkout.php'; }, 1500);</script>";
    }
    ?>

    <a class="back" href="index.php">← Back to Dashboard</a>
</div>

</body>
</html>
