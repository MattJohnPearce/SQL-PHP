<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Family Name</th><th>Booking ID</th><th>Date To</th><th>Date From</th><th>Total Days</th><th>Room Number</th><th>Cost of Room</th><th>Payment Due</th></tr>";
class TableRows extends RecursiveIteratorIterator{
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current(){
			return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
		}
		function beginChildren(){
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
	$stmt = $conn->prepare("SELECT FamilyName, BookingID, DateTo,DateFrom, SUM(DATEDIFF(DateTo,DateFrom)) AS TotalDays, RoomNumber, CostPerday, SUM(DATEDIFF(DateTo,DateFrom) * CostPerDay) as TOTAL FROM bookings JOIN rooms on bookings.RoomNumber_fk = rooms.RoomNumber JOIN guests ON bookings.guestID_fk = guests.GuestID GROUP BY BookingID"); 
		$stmt->execute();
		
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
		{
			echo $v;
		}
		
	}

catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo"</table>";
?>