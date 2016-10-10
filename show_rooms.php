<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Room Number</th><th>Number of Beds</th><th>Cost Per Day</th><th>Extras</th></th></tr>";
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
	$stmt = $conn->prepare('SELECT RoomNumber, NumOfBeds, CostPerDay, Extras FROM rooms');
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
echo '<form action="manager_edit_rooms.php" method="post">';
echo 'Which Room would you like to update: <input type="text" name="InsertRoomNum"><br>';
echo 'Number of Beds: <input type="text" name="InsertNumOfBeds"><br>';
echo 'Cost Per Day: &emsp; <input type="text" name="InsertCostPerDay"><br>';
echo 'Extras:&emsp;&emsp;&emsp; &emsp;<input type="text" name="InsertExtras"><br>';
echo '<input type="submit" value="Update"></form>';
?>