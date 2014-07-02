<?php
include('./db.inc.php');
session_start();
if(!isset($_SESSION['owner_id']) || !isset($_GET['pkref']) || !is_numeric($_GET['pkref'])){
	header('location:login.php');
	exit();
}
$ownerID = $_SESSION['owner_id'];
$pk = $_GET['pkref'];
$query = "DELETE FROM employment where pk='$pk' AND `fk_account`='$ownerID' LIMIT 1;";
mysql_query($query) or die("Query failed due to: " . mysql_error());
header("Location: ./choose.php?drop=success");
exit;
?>
