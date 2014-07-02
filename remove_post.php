<?php
session_start();
include('./db.inc.php');
if (!is_numeric($_POST['pk'])){
	header("location:index.php");
	exit();
}
if (($_SESSION['valid_admin'] || $_SESSION['valid_moderator']) && isset($_POST['pk'])){
	$pk = mysql_real_escape_string($_POST['pk']);
	$query = "DELETE FROM employment where pk='$pk';";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: ./panel.php?rpost=success");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>
