<?php
session_start();
include('./db.inc.php');
if (($_SESSION['is_moderator']) && isset($_POST['loc'])){
	$loc = mysql_real_escape_string($_POST['loc']);
	if ($_SESSION['is_admin']){
		$url = "./mpanel.php?loc=success";
	}
	else {
		$url = "./panel.php?loc=success";
	}
	$query = "INSERT INTO `location` ( `pk` , `name` ) VALUES('','".$_POST['loc']."');";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: $url");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>