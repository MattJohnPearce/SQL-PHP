<?php

echo '<link rel="stylesheet" href="css/bootstrap.css">';
$GuestID = $_POST['InsertGuestID'];
$GPassword = $_POST['InsertPassword'];
$username = 'root';
$password = '';

try
{	
	$conn = new PDO('mysql:host=localhost;dbname=guest_house_bookings', $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	mysql_connect("localhost","root","");
	mysql_select_db("guest_house_bookings" );
	
	$checkPass=mysql_query("SELECT password FROM guests WHERE GuestID = '$GuestID'");
	$userpassword = mysql_fetch_array($checkPass);
	
	if($userpassword['password'] != $GPassword)
	{
		echo "Login eror";
		
	}
	else
	{
	echo "<table style='border: solid 1px black;'>";
	echo "<tr><th>Booking ID </th><th>|&nbsp;Date From</th><th>|&nbsp;Date To </th><th>|&nbsp;Room Number</th></tr>";
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
	$stmt = $conn->prepare('SELECT BookingID, DateFrom, DateTo, RoomNumber_fk FROM bookings WHERE GuestID_fk = :GuestID');
	$stmt->bindParam(':GuestID', $GuestID, PDO::PARAM_STR);
	$stmt->execute();
		
	
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
		echo $v;
	
	}
	
	}
	
}
catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo"</table>";
?>
<html>
<style type="text/css">
body {
    background-color: #e7e7e7;
};
.resizedTextbox2 {
}
</style>
<body>
<form action="new_booking.html" method="post" target="_top"><br>
To Make A New Booking Click Here <input type="submit" value="Add Booking"></form><br>
<form action="login_guest_booking_delete.php" method="post"> 
Type in the booking ID you want removed : <input name="DeleteBooking" type="text" class="resizedTextbox2"> <input type="submit" value="Delete"></form>
<form action="feedback_guests.html" method="post" target="_top"> <input type="submit" value="Give us Feedback">
</form>
</body>
</html>