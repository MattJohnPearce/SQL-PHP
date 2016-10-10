<?php
$FamName = $_POST['InsertFamName'];
$FirstName = $_POST['InsertFirstName'];
$Suburb = $_POST['InsertSuburb'];
$StreetAdd = $_POST['InsertStreetAdd'];
$Postcode = $_POST['InsertPostcode'];
$State = $_POST['InsertState'];
$Email = $_POST['InsertEmail'];
$GPassword = $_POST['InsertPassword'];
$Comment = $_POST['InsertComment'];
$username = 'root';
$password = '';
try
{
	mysql_connect("localhost","root","");
	mysql_select_db("guest_house_bookings" );
	
	$checkEmail=mysql_query("SELECT Email FROM guests WHERE Email = '$Email'");
	$checkrows=mysql_num_rows($checkEmail);
	if($checkrows>0)
	{
		echo 'Sorry that email has already registered would you need to login into';
		echo 'our Returning guests page';
		echo '<form action="login_guests.html" method="post" target="_top">';
		echo '<input type="Submit" value="Continue">';
		echo '</form>';
		echo '</H1>';
		
	}
	else
	{
	$conn = new PDO('mysql:host=localhost;dbname=guest_house_bookings', $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('INSERT guests(FamilyName, FirstName, Suburb, StreetAddress, Postcode, State, Email, Password, Marketing) 
	VALUES (:FamName,:FirstName,:Suburb,:StreetAdd,:Postcode,:State,:Email,:Password, :Marketing)');
	$stmt->bindParam(':FamName', $FamName, PDO::PARAM_STR);
	$stmt->bindParam(':FirstName', $FirstName, PDO::PARAM_STR);
	$stmt->bindParam(':Suburb', $Suburb, PDO::PARAM_STR);
	$stmt->bindParam(':StreetAdd', $StreetAdd, PDO::PARAM_STR);
	$stmt->bindParam(':Postcode', $Postcode, PDO::PARAM_STR);
	$stmt->bindParam(':State', $State, PDO::PARAM_STR);
	$stmt->bindParam(':Email', $Email, PDO::PARAM_STR);
	$stmt->bindParam(':Password', $GPassword, PDO::PARAM_STR);
	$stmt->bindParam(':Marketing', $Comment, PDO::PARAM_STR);
	$stmt->execute();
	$checkID=mysql_query("SELECT GuestID, Email FROM guests WHERE Email = '$Email'");
	$GuestID=mysql_fetch_array($checkID);
	
	echo '<H1>';
echo 'Your record has been successfully added'.'<br>';
echo 'Your GuestID is: ' . $GuestID['GuestID'] .'<br>';
echo '<form action="new_booking.html" method="post" target="_top">';
echo '<input type="Submit" value="Continue">';
echo '</form>';
echo '</H1>';
}
}
catch(PDOException $e)
{
	echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo"</table>";
?>