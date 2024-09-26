<!DOCTYPE html>
<html>
<head>
    <title>Save Booking</title>
</head>
<body>
    <h2>Flight Booking Form</h2>
    <form method="POST" action="save_booking.php">
        <label for="flight_id">Flight ID:</label>
        <input type="number" name="flight_id" required><br><br>

        <label for="passenger_name">Passenger Name:</label>
        <input type="text" name="passenger_name" required><br><br>

        <label for="contact_details">Contact Details:</label>
        <input type="text" name="contact_details" required><br><br>

        <input type="submit" value="Book Flight">
    </form>
</body>
</html>
