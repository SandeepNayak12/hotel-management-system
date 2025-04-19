<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Management Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .logout {
            color: white;
            text-decoration: none;
            font-weight: bold;
            background-color: #e74c3c;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s ease;
        }
        .logout:hover {
            background-color: #c0392b;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            padding: 40px;
        }
        .card {
            background: white;
            padding: 25px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .card a {
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        .card a:hover {
            color: #2980b9;
        }
        .footer {
            text-align: center;
            background: #2c3e50;
            color: white;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>🏨 Hotel Management System</h1>
    <a class="logout" href="logout.php">Logout</a>
</div>

<div class="dashboard">
    <div class="card"><a href="add_customer.php">➕ Add Customer</a></div>
    <div class="card"><a href="book_room.php">📖 Book a Room</a></div>
    <div class="card"><a href="checkout.php">✅ Check-Out</a></div>
    <div class="card"><a href="view_bookings.php">📋 View All Bookings</a></div>
</div>

<div class="footer">
    &copy; <?php echo date('Y'); ?> Hotel Management System
</div>

</body>
</html>
