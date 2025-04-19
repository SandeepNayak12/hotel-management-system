<?php include('includes/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
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
            width: 420px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-link {
            text-align: center;
            display: block;
            margin-top: 15px;
            background: #28a745;
            color: white;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        p {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>➕ Add Customer</h2>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <textarea name="address" placeholder="Address" required></textarea>
        
        <input type="number" name="guest_count" placeholder="Number of Guests" required>
        <textarea name="guest_names" placeholder="Names of Other Guests (if any)"></textarea>
        
        <input type="submit" name="submit" value="Add Customer">
    </form>

    <?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $guest_count = $_POST['guest_count'];
    $guest_names = $_POST['guest_names'];

    // Check if customer exists
    $check = mysqli_query($conn, "SELECT * FROM customers WHERE name = '$name' AND phone = '$phone'");
    
    if (mysqli_num_rows($check) == 0) {
        // Insert new customer
        $sql = "INSERT INTO customers (name, email, phone, address, guest_count, guest_names)
                VALUES ('$name', '$email', '$phone', '$address', '$guest_count', '$guest_names')";
        mysqli_query($conn, $sql);

        // Get the new customer ID
        $customer_id = mysqli_insert_id($conn);
    } else {
        // Get the existing customer ID
        $existing = mysqli_fetch_assoc($check);
        $customer_id = $existing['customer_id'];
    }

    // ✅ Redirect to booking page with customer_id
    header("Location: book_room.php?customer_id=$customer_id");
    exit();
}
?>


</div>

</body>
</html>
