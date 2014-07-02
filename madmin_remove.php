<?php
session_start();
if (($_SESSION['is_admin'] || $_SESSION['is_moderator'])&& isset($_POST['uname'])){
	include('./db.inc.php');
	$uname = mysql_real_escape_string($_POST['uname']);
	$query = "DELETE FROM account where user_id='$uname';";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: ./mpanel.php?drop=success");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>
