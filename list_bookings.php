<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airline_reservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all bookings
$sql = "SELECT Booking.booking_id, Flight.flight_number, Passenger.passenger_name, Booking.booking_date 
        FROM Booking
        JOIN Flight ON Booking.flight_id = Flight.flight_id
        JOIN Passenger ON Booking.passenger_id = Passenger.passenger_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Bookings</title>
</head>
<body>
    <h2>List of Bookings</h2>
    <table border="1">
        <tr>
            <th>Booking ID</th>
            <th>Flight Number</th>
            <th>Passenger Name</th>
            <th>Booking Date</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["booking_id"] . "</td>";
                echo "<td>" . $row["flight_number"] . "</td>";
                echo "<td>" . $row["passenger_name"] . "</td>";
                echo "<td>" . $row["booking_date"] . "</td>";
                echo "<td>
                        <a href='update_booking.php?booking_id=" . $row["booking_id"] . "'>Edit</a> |
                        <a href='delete_booking.php?booking_id=" . $row["booking_id"] . "' onclick=\"return confirm('Are you sure you want to delete this booking?')\">Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No bookings found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
