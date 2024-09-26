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

// Retrieve booking details, including passenger_id
$booking_id = $_GET['booking_id'];
$sql = "SELECT Booking.flight_id, Booking.passenger_id, Passenger.passenger_name, Passenger.contact_details 
        FROM Booking
        JOIN Passenger ON Booking.passenger_id = Passenger.passenger_id
        WHERE Booking.booking_id = $booking_id";

$result = $conn->query($sql);

// If booking exists, fetch its data
if ($result->num_rows > 0) {
    $booking = $result->fetch_assoc();
} else {
    echo "Booking not found.";
    exit;
}

if ($_POST) {
    // Get updated data from the form
    $flight_id = $_POST['flight_id'];
    $passenger_name = $_POST['passenger_name'];
    $contact_details = $_POST['contact_details'];

    // Update passenger details
    $sql_passenger = "UPDATE Passenger
                      SET passenger_name='$passenger_name', contact_details='$contact_details'
                      WHERE passenger_id=" . $booking['passenger_id'];
    if ($conn->query($sql_passenger) === TRUE) {
        // Update booking details
        $sql_booking = "UPDATE Booking
                        SET flight_id='$flight_id'
                        WHERE booking_id='$booking_id'";

        if ($conn->query($sql_booking) === TRUE) {
            echo "Booking updated successfully!";
        } else {
            echo "Error updating booking: " . $conn->error;
        }
    } else {
        echo "Error updating passenger: " . $conn->error;
    }
}

// Retrieve current flight details
$sql_flights = "SELECT * FROM Flight";
$flights = $conn->query($sql_flights);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Booking</title>
</head>
<body>
    <h2>Update Booking</h2>
    <form method="POST" action="">
        <label for="flight_id">Flight ID:</label>
        <select name="flight_id">
            <?php
            while ($flight = $flights->fetch_assoc()) {
                $selected = ($flight['flight_id'] == $booking['flight_id']) ? 'selected' : '';
                echo "<option value='" . $flight['flight_id'] . "' $selected>" . $flight['flight_number'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="passenger_name">Passenger Name:</label>
        <input type="text" name="passenger_name" value="<?php echo $booking['passenger_name']; ?>" required><br><br>

        <label for="contact_details">Contact Details:</label>
        <input type="text" name="contact_details" value="<?php echo $booking['contact_details']; ?>" required><br><br>

        <input type="submit" value="Update Booking">
    </form>
</body>
</html>

<?php
$conn->close();
?>
