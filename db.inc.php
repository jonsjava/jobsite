<?php
// ** MySQL settings ** //
$db_name  = "database_name";   // The name of the database.
$db_user  = "database_user";   // Your MySQL username. You MUST create the user and pass yourself
$db_password  = "database_users_password";   // ...and password
$db_host  = "localhost";   // 99% chance you won't need to change this value




/* DO NOT EDIT */
if (!isset($setup)){
	$link = mysql_connect($db_host, $db_user, $db_password) or die ("Connection failed due to: " . mysql_error());
	mysql_select_db ($db_name) or die("Selection failed due to: " . mysql_error());
}
?>
