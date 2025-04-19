<?php include('includes/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>View All Bookings</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f5f8;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-booked {
            color: #007bff;
            font-weight: bold;
        }

        .status-completed {
            color: #28a745;
            font-weight: bold;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>📋 All Bookings</h2>

<table>
    <tr>
        <th>Booking ID</th>
        <th>Customer</th>
        <th>Room</th>
        <th>Check-In</th>
        <th>Check-Out</th>
        <th>Status</th>
    </tr>

    <?php
    $sql = "SELECT b.booking_id, c.name AS customer_name, r.room_type,
                   b.check_in_date, b.check_out_date, b.status
            FROM bookings b
            JOIN customers c ON b.customer_id = c.customer_id
            JOIN rooms r ON b.room_id = r.room_id
            ORDER BY b.booking_id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>#{$row['booking_id']}</td>";
        echo "<td>{$row['customer_name']}</td>";
        echo "<td>{$row['room_type']}</td>";
        echo "<td>{$row['check_in_date']}</td>";
        echo "<td>{$row['check_out_date']}</td>";
        echo "<td class='status-". strtolower($row['status']) ."'>" . ucfirst($row['status']) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<a class="back-link" href="index.php">← Back to Dashboard</a>

</body>
</html>
