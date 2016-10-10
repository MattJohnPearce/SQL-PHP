<?php
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

$GuestID = $_POST['InsertGuestID'];
$DateTo = $_POST['InsertDateTo'];
$DateFrom = $_POST['InsertDateFrom'];
$GuestHouse = $_POST['InsertGuestHouse'];
$Room = $_POST['InsertRoom'];
$username = 'root';
$password = '';
try
{		
mysql_connect("localhost","root","");
	mysql_select_db("guest_house_bookings" );
	$checkDate=mysql_query("SELECT * FROM bookings WHERE RoomNumber_fk='$Room' AND GuestHouseID_fk='$GuestHouse' AND  DateFrom BETWEEN '$DateFrom' AND '$DateTo' AND  DateTo BETWEEN '$DateFrom' AND '$DateTo'");
	$checkrows=mysql_num_rows($checkDate);
	
	if($checkrows>0)
	{
		echo "Sorry that room has already been booked at those times please select a different date";
		
	}
	else
	{
	$conn = new PDO('mysql:host=localhost;dbname=guest_house_bookings', $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('INSERT bookings (DateFrom, DateTo, GuestHouseID_fk, GuestID_fk, RoomNumber_fk) 
	VALUES (:DateFrom,:DateTo,:GuestHouseID,:GuestID,:RoomNumber)');
	$stmt->bindParam(':DateFrom', $DateFrom, PDO::PARAM_STR);
	$stmt->bindParam(':DateTo', $DateTo, PDO::PARAM_STR);
	$stmt->bindParam(':GuestHouseID', $GuestHouse, PDO::PARAM_STR);
	$stmt->bindParam(':GuestID', $GuestID, PDO::PARAM_STR);
	$stmt->bindParam(':RoomNumber', $Room, PDO::PARAM_STR);
		$stmt->execute();
		echo '<H1>';
		echo 'Your booking has been successfully added';
		echo '</H1>';
		
		echo '<form action="login_guests.html" method="post" target="_top">';
		echo '<input type="Submit" value="Continue">';
		echo '</form>';
	
	}
}
catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
?>