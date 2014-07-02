<?php
session_start();
include('db.inc.php');
$UID = mysql_real_escape_string(trim($_POST["user_id"]));
$PASSWD = md5(mysql_real_escape_string(trim($_POST["password"])));
if ((empty($UID)) || (empty($PASSWD))){
	header("Location: ./admin.php?error=ETY");
	exit;
}
$query = "SELECT * FROM admin WHERE user_id = '$UID' AND password = '$PASSWD' LIMIT 1;";
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
$row = mysql_fetch_assoc($result);
if (!(empty($row))) {
	$_SESSION["valid"] = "true";
	$_SESSION['uid'] = $UID;
	if ($row['id'] == 1){
		$_SESSION['is_admin'] = true;
		header("Location: ./mpanel.php");
		exit;
	}
	else {
		$_SESSION['is_moderator'] = true;
		header("Location: ./panel.php");
		exit;
	}
}
header("Location: ./admin.php?error=login");
exit;
?>