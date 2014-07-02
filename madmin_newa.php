<?php
session_start();
if ($_SESSION['is_admin'] && isset($_POST['user_id']) && isset($_POST['password'])){
	include('./db.inc.php');
	$username = mysql_real_escape_string($_POST['user_id']);
	$password = md5(mysql_real_escape_string($_POST['password']));
	$query = "INSERT INTO `admin` ( `user_id` , `password` )VALUES ('$username' ,'$password');";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: ./mpanel.php?newa=success");
	exit;
}
print_r($_SESSION);
exit();
/*
else{
	header("location:index.php");
	exit();
}
*/
?>