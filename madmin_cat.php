<?php
session_start();
if ($_SESSION['is_admin'] && isset($_POST['cat'])){
	include('./db.inc.php');
	$cat = mysql_real_escape_string($_POST['cat']);
	$query = "INSERT INTO `category` ( `pk` , `name` ) VALUES (NULL , '$cat');";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: ./mpanel.php?cat=success");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>