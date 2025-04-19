

<?php include('includes/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
</head>
<body>
    <h2>Add Room</h2>
    <form method="POST" action="">
        <label>Room Type:</label>
        <input type="text" name="room_type" placeholder="e.g. Single, Double, Deluxe" required><br><br>

        <label>Price (per night):</label>
        <input type="number" step="0.01" name="price" required><br><br>

        <input type="submit" name="submit" value="Add Room">
    </form>

<?php
if (isset($_POST['submit'])) {
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];

    $sql = "INSERT INTO rooms (room_type, price) VALUES ('$room_type', '$price')";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
header("Location: payment.php?booking_id=$last_id");
exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

</body>
</html>
