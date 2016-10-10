<?php
echo '<form action="manager_delete_booking.php" method="post">';
echo 'Delete Booking ID: <input type="text" name="DeleteBooking">';
echo '<input type="submit" value="Remove">';
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>BookingID</th><th>Family Name</th><th>Date From</th><th>Date To</th><th>Location</th><th>Room Number</th><th>GuestID</th></tr>";
class TableRows extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}
	function current() {
		return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
	}
	function beginChildren() {
		echo "<tr>";
	}
	function endChildren() {
		echo "</tr>" . "\n";
	}
}

$username = 'root';
$password = '';
try
{
	$conn = new PDO('mysql:host=localhost;dbname=guest_house_bookings', $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('SELECT BookingID, FamilyName, DateFrom, DateTo, Location, RoomNumber, GuestID FROM Bookings  JOIN rooms on bookings.RoomNumber_fk = rooms.RoomNumber  JOIN guests on bookings.GuestID_fk = guests.GuestID LEFT JOIN locations on bookings.GuestHouseID_fk = locations.GuestHouseID');
	$stmt->execute();
		
	
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
		echo $v;
	}
}
catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo "</table>";
?>