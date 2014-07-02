<?php
include('./db.inc.php');
session_start();
$link = mysql_connect($db_host, $db_user, $db_password) or die ("Connection failed due to: " . mysql_error());
mysql_select_db ($db_name) or die("Selection failed due to: " . mysql_error());
if($_SESSION["is_admin"] != "true") {
	header("Location: ./login.php");
	exit;
}
include("./resource.php");
if ($_SESSION["valid"] = "true") {
	top("Admin Panel");
	echo "Please select from the icons below (hover over to get a description)";
	body("What would you like to do today?");
	echo "<div align='center'><a href='./mpanel.php?show=rpost'><img src='./images/logout.gif' title='Remove Job' border='0'></a>";
	echo "<a href='./mpanel.php?show=ruser'><img src='./images/ipban.gif' title='Remove User' border='0'></a>";
	echo "<a href='./mpanel.php?show=cat'><img src='./images/blocks.gif' title='New Category' border='0'></a>";
	echo "<a href='./mpanel.php?show=loc'><img src='./images/weblinks.gif' title='New Location' border='0'></a>";
	echo "<a href='./mpanel.php?show=rmod'><img src='./images/authors.gif' title='Remove Moderator' border='0'></a>";
	echo "<a href='./mpanel.php?show=newa'><img src='./images/users.gif' title='Add a Moderator' border='0'></a><br />";
}
if ($_GET['drop'] == 'success'){
	echo "<div align='center'><h4 style='color:red'>The selected user has been removed</h4></div>";
}
if ($_GET['cat'] == 'success'){
	echo "<div align='center'><h4 style='color:green'>The new category has been added</h4></div>";
}
if ($_GET['rpost'] == 'success'){
	echo "<div align='center'><h4 style='color:red'>The selected job post has been removed</h4></div>";
}
if ($_GET['loc'] == 'success'){
	echo "<div align='center'><h4 style='color:green'>The new location has been successfully added.</h4></div>";
}
if ($_GET['newa'] == 'success'){
	echo "<div align='center'><h4 style='color:green'>New moderator account created successfully.</h4></div>";
}
if ($_GET['show'] == 'ruser'){
	echo "<form name=form method='post' action='madmin_remove.php'>User to Remove:<br><input type='text' name='uname'>";
	echo "</select><br><input type='submit' value='Remove User'></form>";
}
if ($_GET['show'] == 'rpost'){
	echo "<form name=form method='post' action='mremove_post.php'>Post Number to Remove:<br><input type='text' name='pk'>";
	echo "</select><br><input type='submit' value='Remove Post'></form>";
}
if ($_GET['show'] == 'cat'){
	echo "<form name=form method='post' action='madmin_cat.php'>Name of New Category:<br><input type='text' name='cat'>";
	echo "</select><br><input type='submit' value='Create Category'></form>";
}
if ($_GET['show'] == 'loc'){
	echo "<form name=form method='post' action='madmin_loc.php'>Name of New Location:<br><input type='text' name='loc'>";
	echo "</select><br><input type='submit' value='Create Location'></form>";
}
if ($_GET['show'] == 'newa'){
	echo "<form name=form method='post' action='madmin_newa.php'>New Moderator Name<br><input type='text' name='user_id'><br /> New Moderator Password<br /><input type='text' name='password'>";
	echo "</select><br><input type='submit' value='Create Moderator'></form>";
}
if ($_GET['show'] == 'rmod'){
	echo "<form name=form method='post' action='mmod_remove.php'>Moderator to Remove:<br><input type='text' name='uname'>";
	echo "</select><br><input type='submit' value='Remove Moderator'></form>";
}
bottom();
exit;
?>