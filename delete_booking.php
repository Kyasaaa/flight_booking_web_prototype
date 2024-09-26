<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airline_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete booking
$booking_id = $_GET['booking_id'];
$sql = "DELETE FROM Booking WHERE booking_id = $booking_id";

if ($conn->query($sql) === TRUE) {
    echo "Booking deleted successfully!";
    echo "<br><a href='list_bookings.php'>Go Back to List</a>";
} else {
    echo "Error deleting booking: " . $conn->error;
}

$conn->close();
?>
