<?php
include('./db.inc.php');
session_start();
if (($_SESSION['is_moderator']) && isset($_POST['cat'])){
	$cat = mysql_real_escape_string($_POST['cat']);
	if ($_SESSION['is_admin']){
		$url = "./mpanel.php?cat=success";
	}
	else {
		$url = "./panel.php?cat=success";
	}
	$query = "INSERT INTO `category` ( `pk` , `name` ) VALUES ('', '".$_POST['cat']."');";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	header("Location: $url");
	exit;
}
else{
	header("location:index.php");
	exit();
}
?>