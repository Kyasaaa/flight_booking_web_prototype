<?php
// Database connection
$servername = "localhost";
$username = "root";  // XAMPP default user
$password = "";      // XAMPP default has no password
$dbname = "airline_reservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_POST) {
    $flight_id = $_POST['flight_id'];
    $passenger_name = $_POST['passenger_name'];
    $contact_details = $_POST['contact_details'];

    // Check if the passenger already exists
    $sql_passenger = "SELECT passenger_id FROM Passenger WHERE passenger_name='$passenger_name' AND contact_details='$contact_details'";
    $result = $conn->query($sql_passenger);

    if ($result->num_rows > 0) {
        // Passenger exists, fetch passenger_id
        $row = $result->fetch_assoc();
        $passenger_id = $row['passenger_id'];
    } else {
        // Insert new passenger and get the passenger_id
        $sql_insert_passenger = "INSERT INTO Passenger (passenger_name, contact_details) VALUES ('$passenger_name', '$contact_details')";
        if ($conn->query($sql_insert_passenger) === TRUE) {
            $passenger_id = $conn->insert_id;
        } else {
            echo "Error: " . $conn->error;
            exit;
        }
    }

    // Insert new booking
    $booking_date = date("Y-m-d");
    $sql_insert_booking = "INSERT INTO Booking (flight_id, passenger_id, booking_date) VALUES ('$flight_id', '$passenger_id', '$booking_date')";

    if ($conn->query($sql_insert_booking) === TRUE) {
        echo "Booking successfully saved!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
