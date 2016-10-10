<?php
$RoomNum = $_POST['InsertRoomNum'];
$NumOfBeds = $_POST['InsertNumOfBeds'];
$CostPerDay = $_POST['InsertCostPerDay'];
$Extras = $_POST['InsertExtras'];
$username = 'root';
$password = '';
try
{
	$conn = new PDO('mysql:host=localhost;dbname=guest_house_bookings', $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('UPDATE rooms SET NumOfBeds = :NumOfBeds, CostPerDay = :CostPerDay, Extras = :Extras WHERE RoomNumber = :RoomNumber'); 
	$stmt->bindParam(':RoomNumber', $RoomNum, PDO::PARAM_STR);
	$stmt->bindParam(':NumOfBeds', $NumOfBeds, PDO::PARAM_STR);
	$stmt->bindParam(':CostPerDay', $CostPerDay, PDO::PARAM_STR);
	$stmt->bindParam(':Extras', $Extras, PDO::PARAM_STR);
	$stmt->execute();
	
header("Location: show_rooms.php");

}
catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo"</table>";
?>