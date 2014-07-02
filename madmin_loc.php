<?php
session_start();
if ($_SESSION['is_admin'] && isset($_POST['loc'])){
	include('./db.inc.php');
	$loc = mysql_real_escape_string($_POST['loc']);
	$query = "INSERT INTO `location` ( `pk` , `name` ) VALUES (NULL , '$loc');";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: ./mpanel.php?loc=success");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>