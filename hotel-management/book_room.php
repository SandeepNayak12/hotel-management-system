<?php include('includes/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Room</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 500px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        select, input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
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

        p {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>📖 Book a Room</h2>
    <form method="POST" action="">
        <label>Select Customer:</label>
        <select name="customer_id" required>
            <option value="">-- Select Customer --</option>
            <?php
            $customers = mysqli_query($conn, "
            SELECT MIN(customer_id) as customer_id, name, phone 
            FROM customers 
            WHERE customer_id NOT IN (
                SELECT customer_id FROM bookings WHERE status = 'Booked'
            )
            GROUP BY name, phone
        ");
        
        
            while ($row = mysqli_fetch_assoc($customers)) {
                echo "<option value='{$row['customer_id']}'>{$row['name']} ({$row['phone']})</option>";
            }
            ?>
        </select>

        <label>Select Available Room:</label>
        <select name="room_id" required>
            <option value="">-- Select Room --</option>
            <?php
            $rooms = mysqli_query($conn, "SELECT * FROM rooms WHERE is_available = 1");
            while ($room = mysqli_fetch_assoc($rooms)) {
                echo "<option value='{$room['room_id']}'>Room {$room['room_id']} - {$room['room_type']} (₹{$room['price']})</option>";
            }
            ?>
        </select>

        <label>Check-in Date:</label>
        <input type="date" name="check_in" required>

        <label>Check-out Date:</label>
        <input type="date" name="check_out" required>

        <input type="submit" name="submit" value="Book Room">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $customer_id = $_POST['customer_id'];
        $room_id = $_POST['room_id'];
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];

        $sql = "INSERT INTO bookings (customer_id, room_id, check_in_date, check_out_date, status)
                VALUES ('$customer_id', '$room_id', '$check_in', '$check_out', 'Booked')";

if (mysqli_query($conn, $sql)) {
    $booking_id = mysqli_insert_id($conn); // Get newly created booking ID

    // Mark the room as unavailable
    mysqli_query($conn, "UPDATE rooms SET is_available = 0 WHERE room_id = $room_id");

    // Redirect to payment page
    header("Location: payment.php?booking_id=$booking_id");
    exit();
} else {
    echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
}

    }
    ?>
</div>

</body>
</html>
