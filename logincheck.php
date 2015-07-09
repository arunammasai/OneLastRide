<?php
session_start();	
	include_once('database.php');
	
	if( ! empty($_SESSION['id_user']))
		header("Location: search.php");

if (isset($_POST['submitBut'])) {
	
//echo "Customer Name :.$customername.$addressline.$addressstreet.$addresscity.$addressstate.$addresspincode.$currency.
//$startdate.$activationdate.$enddate.$lastbilldate.$status.$accountid.$accountbalance";

$customername = $_POST["customername"];
$password = $_POST["password"];

$query = "SELECT AccountId FROM customer WHERE Name='$customername' AND password='$password'";
$result	= mysqli_query($conn, $query);

$user_info = mysqli_fetch_row($result);

$_SESSION['id_user']	=	$user_info[0];

if(empty($user_info)){
	echo "<script>alert('Invalid User');</script>";
	header("Location: login.php?error=1");
	}
else
{
	header("Location: search.php");	
	exit;
}
mysqli_close($conn);
}

?>
