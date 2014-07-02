<?php
include('./db.inc.php');
require('./resource.php');
top("Registration Complete");
if ((!empty($_GET["eml"]) && $_GET["eml"] == 1) && !empty($_GET["pk"]) && is_numeric($_GET['pk'])) {
	$pk = $_GET["pk"];
	mysql_connect($db_host, $db_user, $db_password) or die ("Connection failed due to: " . mysql_error());
	mysql_select_db ($db_name) or die("Selection failed due to: " . mysql_error());
	//creating SQL query
	//searching to see if passed PK exists
	$query = "SELECT pk FROM account WHERE pk = $pk";
	//query
	$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
	//number of rows, if any
	if (mysql_num_rows($result) > 0) {
		$query = "UPDATE account SET valid = 1 WHERE pk = $pk";
		//update account if valid
		mysql_query($query) or die("Query failed due to: " . mysql_error());
		echo "EMAIL HAS BEEN <strong style='color:green'>VALIDATED</strong> PLEASE <a href='./login.php'>LOGIN</a> TO CONTINUE...";
	}
}
else {
	echo "EMAIL HAS <strong style='color:red'>NOT</strong> BEEN VALIDATED PLEASE <a href='./register.php'>REREGISTER</a> TO CONTINUE...";
}
bottom();
?>
