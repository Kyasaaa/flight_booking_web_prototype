<!DOCTYPE html>
<html>
<head>
    <title>Flight Booking System</title>
</head>
<body>
    <h1>Welcome to the Flight Booking System</h1>

    <h2>Available Options</h2>
    <ul>
        <li><a href="list_bookings.php">View All Bookings (Update/Delete)</a></li>
    </ul>

    <h2>Book a Flight Now</h2>
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
