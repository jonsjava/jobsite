<?php
include('./db.inc.php');
session_start();
$link = mysql_connect($db_host, $db_user, $db_password) or die ("Connection failed due to: " . mysql_error());
mysql_select_db ($db_name) or die("Selection failed due to: " . mysql_error());
if($_SESSION["valid"] != "true") {

	header("Location: ./login.php");

	exit;

}
include("./resource.php");
if ($_SESSION["valid"] = "true") {
	top("Moderator Panel");
	echo "Please select from the icons below (hover over to get a description)";
	body("What would you like to do today?");
	echo "<div align='center'><a href='./panel.php?show=rpost'><img src='./images/logout.gif' title='Remove Job' border='0'></a>";
	echo "<a href='./panel.php?show=ruser'><img src='./images/ipban.gif' title='Remove User' border='0'></a>";
	echo "<a href='./panel.php?show=cat'><img src='./images/blocks.gif' title='New Category' border='0'></a>";
	echo "<a href='./panel.php?show=loc'><img src='./images/weblinks.gif' title='New Location' border='0'></a><br>";
}
if ($_GET['drop'] == 'success'){
	echo "<div align='center'><h4 style='color:red'>The selected user has been removed</h4></div>";
}
if ($_GET['cat'] == 'success'){
	echo "<div align='center'><h4 style='color:green'>The new category has been added</h4></div>";
}
if ($_GET['ropost'] == 'success'){
	echo "<div align='center'><h4 style='color:red'>The selected job post has been removed</h4></div>";
}
if ($_GET['loc'] == 'success'){
	echo "<div align='center'><h4 style='color:green'>The new location has been successfully added.</h4></div>";
}
if ($_GET['show'] == 'ruser'){
	echo "<form name=form method='post' action='admin_remove.php'>User to Remove:<br><input type='text' name='uname'>";
	echo "</select><br><input type='submit' value='Remove User'></form>";
}
if ($_GET['show'] == 'rpost'){
	echo "<form name=form method='post' action='remove_post.php'>Post Number to Remove:<br><input type='text' name='pk'>";
	echo "</select><br><input type='submit' value='Remove Post'></form>";
}
if ($_GET['show'] == 'cat'){
	echo "<form name=form method='post' action='admin_cat.php'>Name of New Category:<br><input type='text' name='cat'>";
	echo "</select><br><input type='submit' value='Create Category'></form>";
}
if ($_GET['show'] == 'loc'){
	echo "<form name=form method='post' action='admin_loc.php'>Name of New Location:<br><input type='text' name='loc'>";
	echo "</select><br><input type='submit' value='Create Location'></form>";
}
if ($_GET['rmod'] == 'success'){
	echo "<div align='center'><h4 style='color:red'>The selected moderator has been removed</h4></div>";
}
bottom();
?>