<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Booking Deleted</title>
</head>
<?php

$DelBook = $_POST['DeleteBooking'];
$username = 'root';
$password = '';
try
{
	$conn = new PDO('mysql:host=localhost;dbname=guest_house_bookings', $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('DELETE FROM bookings WHERE BookingID = :BookingID');
	$stmt->bindParam(':BookingID', $DelBook, PDO::PARAM_STR);
	$stmt->execute();
	header("Location: show_guests_bookings.php");
}
catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
<body>
</body>
</html>