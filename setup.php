<?php
include("config.inc.php");
$setup = true;
require('db.inc.php');
require('resource.php');
if (!isset($_GET['step']) || $_GET['step'] != 2){
	top("Step 1 of the install");
	print "Step 2 is automatic, after filling in the following";
	body("Please fill in the following");
	?>
	<form method="POST" action="?step=2">
		<table border="0">
			<tr>
				<td>Admin Username:</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Admin Password:</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
	<?php
	bottom();
}
else {
	session_start();
	top("Executing Setup.....");
	$link = mysql_connect($db_host, $db_user, $db_password) or die ("Connection failed due to: " . mysql_error());
	if($create_db == true) {
		print "creating database";
		$sql = "CREATE DATABASE `$db_name`;";
		mysql_query($sql) or die("Query failed due to: " . mysql_error());
		$result = @mysql_query($sql);
		print $result . "<BR>";
		mysql_select_db ($db_name) or die("Selection failed due to: " . mysql_error());
		print "database '" . $db_name . "' created successfully";
	}
	mysql_select_db ($db_name) or die("Selection failed due to: " . mysql_error());
	$sql = "CREATE TABLE `".  $db_name ."`.`account` (
`pk` int( 11 ) NOT NULL AUTO_INCREMENT ,
`user_id` varchar( 50 ) NOT NULL default '',
`password` varchar( 32 ) NOT NULL default '',
`name` varchar( 50 ) NOT NULL default '',
`phone` varchar( 10 ) default NULL ,
`employer` int( 1 ) NOT NULL default '0',
`valid` int( 1 ) NOT NULL default '1',
PRIMARY KEY ( `pk` ) ,
UNIQUE KEY `user_id` ( `user_id` ) ,
KEY `name` ( `name` ) 
) ENGINE = MYISAM DEFAULT CHARSET = latin1;";
	mysql_query($sql) or die("Query failed due to: " . mysql_error());
	$result = @mysql_query($sql);
	print $result . "<BR>";
	print "table 'account' created successfully";
	$sql = "CREATE TABLE `".  $db_name ."`.`category` (
`pk` int( 11 ) NOT NULL AUTO_INCREMENT ,
`name` varchar( 60 ) NOT NULL default '',
PRIMARY KEY ( `pk` ) ,
UNIQUE KEY `name` ( `name` ) 
) ENGINE = MYISAM DEFAULT CHARSET = latin1;";
	mysql_query($sql) or die("Query failed due to: " . mysql_error());
	$result = @mysql_query($sql);
	print $result . "<br>";
	print "table 'category' created successfully";
	$sql = "CREATE TABLE `".  $db_name ."`.`employment` (
`pk` int( 11 ) NOT NULL AUTO_INCREMENT ,
`date` varchar( 15 ) NOT NULL default '',
`title` varchar( 50 ) NOT NULL default '',
`description` text NOT NULL ,
`employment_type` char( 2 ) NOT NULL default '',
`wage` varchar( 50 ) default NULL ,
`wage_type` char( 2 ) NOT NULL default '',
`fk_account` int( 11 ) NOT NULL default '0',
`fk_category` varchar( 200 ) NOT NULL default '',
`fk_location` varchar( 200 ) NOT NULL default '',
PRIMARY KEY ( `pk` ) ,
KEY `fk_account` ( `fk_account` ) ,
FULLTEXT KEY `title` ( `title` ) ,
FULLTEXT KEY `description` ( `description` ) ,
FULLTEXT KEY `fk_category` ( `fk_category` ) ,
FULLTEXT KEY `fk_location` ( `fk_location` ) 
) ENGINE = MYISAM DEFAULT CHARSET = latin1;";
	mysql_query($sql) or die("Query failed due to: " . mysql_error());
	$result = @mysql_query($sql);
	print $result . "<br>";
	print "table 'employment' created successfully";
	$sql = "CREATE TABLE `".  $db_name ."`.`location` (
`pk` int( 11 ) NOT NULL AUTO_INCREMENT ,
`name` varchar( 40 ) NOT NULL default '',
PRIMARY KEY ( `pk` ) ,
UNIQUE KEY `name` ( `name` ) 
) ENGINE = MYISAM DEFAULT CHARSET = latin1;";
	mysql_query($sql) or die("Query failed due to: " . mysql_error());
	$result = @mysql_query($sql);
	print $result . "<br>";
	print "table 'location' created successfully";
	$sql = "CREATE TABLE `admin` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` VARCHAR( 50 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
INDEX ( `user_id` )
) TYPE = MYISAM ;
";
	mysql_query($sql) or die("Query failed due to: " . mysql_error());
	$result = @mysql_query($sql);
	print $result . "<br>";
	print "table 'admin' created successfully";
	$a_pass = md5($a_pass);
	$sql = "INSERT INTO admin (id, user_id, password) VALUES('','".  $admin  ."','".  $a_pass  ."')";
	mysql_query($sql) or die("Query failed due to: ". mysql_error());
	$result = @mysql_error($sql);
	print $result . "<br>";
	print "admin account created <br>";
	print "Population Complete";
	print "<br>";
	print "you can now go to your index page and create a user.<br /><br /><strong>\n Or go to the <a href='admin.php'>Admin page</a> and log in.</strong>";
}
?>
