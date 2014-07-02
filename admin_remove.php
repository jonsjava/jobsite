<?php
include('./db.inc.php');
session_start();
if (isset($_POST['uname']) && ($_SESSION['is_admin'] || $_SESSION['is_moderator'])){
	$query = "DELETE FROM account where user_id='".$_POST['uname']."'";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: ./panel.php?drop=success");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>
