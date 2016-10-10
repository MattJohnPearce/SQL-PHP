<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>GuestID</th><th>Family Name</th><th>First Name</th><th>Suburb</th><th>Street Address</th><th>Postcode</th><th>State</th><th>Email</th></tr>";
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
	$stmt = $conn->prepare('SELECT GuestID, FamilyName, FirstName, Suburb, StreetAddress, Postcode, State, Email FROM guests ORDER BY Suburb');
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