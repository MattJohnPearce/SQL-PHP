<?php
$Email = $_POST['InsertEmail'];
$FBack = $_POST['InsertFeedback'];
$FutureImp = $_POST['InsertFutureImp'];
$username = 'root';
$password = '';
try
{
	$conn = new PDO('mysql:host=localhost;dbname=guest_house_bookings', $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('UPDATE guests SET Feedback = :Feedback, FutureImprov = :FutureImprove WHERE email = :Email'); 
	$stmt->bindParam(':Email', $Email, PDO::PARAM_STR);
	$stmt->bindParam(':Feedback', $FBack, PDO::PARAM_STR);
	$stmt->bindParam(':FutureImprove', $FutureImp, PDO::PARAM_STR);
	$stmt->execute();
	
	echo '<H1>';
echo 'Thankyou';
echo '</H1>';
echo 'Returning to Our Hompage in 5 secs';
header("Refresh: 5;url=index.html");

}
catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo"</table>";
?>