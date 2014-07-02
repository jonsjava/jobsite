<?php
include('./db.inc.php');
session_start();
$UID = mysql_real_escape_string(trim($_POST["usrid"]));
$PASSWD = md5(mysql_real_escape_string(trim($_POST["passwd"])));
if ((empty($UID)) || (empty($PASSWD))){
	header("Location: ./login.php?error=ETY");
	exit;
}
$query = "SELECT * FROM account WHERE user_id = '$UID' AND password = '$PASSWD' LIMIT 1;";
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
$count = mysql_num_rows($result);
if ($count == 1) {
	$row = mysql_fetch_assoc($result);
	$_SESSION["valid"] = "true";
	if($row['valid'] == 0){
		header("Location: ./login.php?error=mail");
		exit;
	}
	elseif ($row['employer'] == 1){
		$_SESSION['employer'] = true;
		$_SESSION['uid'] = $UID;
		$_SESSION['owner_id'] = $row['pk'];
	}
	else {
		$_SESSION['employer'] = false;
		$_SESSION['uid'] = $UID;
	}
	mysql_close($link);
	header("Location: ./choose.php");
	exit;
}
else {
	mysql_close($link);
	header("Location: ./login.php?error=login");
	exit;
}
?>