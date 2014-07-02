<?php
session_start();
if ($_SESSION['is_admin'] && isset($_POST['pk']) && is_numeric($_POST['pk'])){
	include('./db.inc.php');
	$pk = $_POST['pk'];
	$query = "DELETE FROM employment where pk='$pk';";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: ./mpanel.php?rpost=success");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>
