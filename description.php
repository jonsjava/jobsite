<?php
include('./db.inc.php');
session_start();
if(!$_SESSION["valid"]) {
	header("Location: ./login.php");
	exit;
}
else if(empty($_GET['pkref'])){
	header("Location: ./p_search.php");
	exit;
}
require("resource.php");
top("Job Details");
$query = "SELECT * FROM employment WHERE pk=" . $_GET['pkref'];
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
$row = mysql_fetch_assoc($result);
$location = str_replace("_", "", $row['fk_location']); // cleaning all the "_" out
$location = explode(" ", $location); // now turned into an array
if(count($location)>5) {
	$i = 0;
	foreach ($location as $value) {
		$result2 = mysql_query("SELECT name FROM location WHERE pk = $value") or die("Query failed due to: " . mysql_error());
		$row2 = mysql_fetch_assoc($result2);
		$loc[$i] = $row2['name'];
		$i = $i + 1;
	}
}
else {
	foreach ($location as $value) {
		$result2 = mysql_query("SELECT name FROM location WHERE pk = $value") or die("Query failed due to: " . mysql_error());
		$row2 = mysql_fetch_assoc($result2);
		$loc = $loc . $row2['name'] . "<br>";
	}
}
$category = str_replace("_", "", $row['fk_category']); // cleaning all the "_" out
$category = explode(" ", $category); // now turned into an array
if(count($category)>5) {
	$i = 0;
	foreach ($category as $value) {
		$result2 = mysql_query("SELECT name FROM category WHERE pk = $value") or die("Query failed due to: " . mysql_error());
		$row2 = mysql_fetch_assoc($result2);
		$cat[$i] = $row2['name'];
		$i = $i + 1;
	}
}
else {
	foreach ($category as $value) {
		$result2 = mysql_query("SELECT name FROM category WHERE pk = $value") or die("Query failed due to: " . mysql_error());
		$row2 = mysql_fetch_assoc($result2);
		$cat = $cat . $row2['name'] . "<br>";
	}
}
$account = trim($row['fk_account'], '_');
$query4= "SELECT name,user_id FROM account WHERE pk='" . $account . "'";
$result4 = mysql_query($query4) or die("Query failed due to: " . mysql_error());
$row4 = mysql_fetch_assoc($result4);
$acc = $row4['name'];
$email = $row4['user_id'];
echo "<table align='center'><tr><td bgcolor='gray' style='color:white' align='center'>Job Title</td><td bgcolor='white' align='center'>" . $row['title'] . "</td></tr>";
echo "<tr><td bgcolor='gray' style='color:white' align='center'>Employer</td><td bgcolor='white' align='center'>" . $acc . "</td></tr>";
echo "<tr><td bgcolor='gray' style='color:white' align='center'>Contact</td><td bgcolor='white' align='center'>" . $email . "</td></tr>";
if(count($category)>5 && count($location)<6) {
	echo "<tr><td bgcolor='gray' style='color:white' align='center'>Job Category</td><td bgcolor='white' align='center'><SELECT SIZE=5 READONLY>";
	foreach ($cat as $value) {
		echo "<OPTION VALUE='$value'>" . $value . "</OPTION>";
	}
	echo "</SELECT></td></tr><tr><td bgcolor='gray' style='color:white' align='center'>Location</td><td bgcolor='white' align='center'>" . $loc . "</td></tr>";
}
else if(count($category)<6 && count($location)>5) {
	echo "<tr><td bgcolor='gray' style='color:white' align='center'>Job Category</td><td bgcolor='white' align='center'>" . $cat . "</td></tr>";
	echo "<tr><td bgcolor='gray' style='color:white' align='center'>Location</td><td bgcolor='white' align='center'><SELECT SIZE=5 READONLY>";
	foreach ($loc as $value) {
		echo "<OPTION VALUE='$value'>" . $value . "</OPTION>";
	}
	echo "</td></tr>";
}
else if(count($category)>5 && count($location)>5) {
	echo "<tr><td bgcolor='gray' style='color:white' align='center'>Job Category</td><td bgcolor='white' align='center'><SELECT SIZE=5 READONLY>";
	foreach ($cat as $value) {
		echo "<OPTION VALUE='$value'>" . $value . "</OPTION>";
	}
	echo "</SELECT></td></tr><tr><td bgcolor='gray' style='color:white' align='center'>Location</td><td bgcolor='white' align='center'><SELECT SIZE=5 READONLY>";
	foreach ($loc as $value) {
		echo "<OPTION VALUE='$value'>" . $value . "</OPTION>";
	}
	echo "</td></tr>";
}
else {
	echo "<tr><td bgcolor='gray' style='color:white' align='center'>Job Category</td><td bgcolor='white' align='center'>" . $cat . "</td></tr>";
	echo "<tr><td bgcolor='gray' style='color:white' align='center'>Location</td><td bgcolor='white' align='center'>" . $loc . "</td></tr>";
}
echo "<tr><td bgcolor='gray' style='color:white' align='center'>Employment Type</td><td bgcolor='white' align='center'>" . $row['employment_type'] . "</td></tr>";
echo "<tr><td bgcolor='gray' style='color:white' align='center'>Wage</td><td bgcolor='white' align='center'>" . $row['wage'] . " per " . $row['wage_type'] . "</td></tr>";
echo "<tr><td bgcolor='gray' style='color:white' align='center'>Description</td><td bgcolor='white' align='center'>" . $row['description'] . "</td></tr>";
echo "</table>";
echo "<a href='./p_search.php'>Return</a>";
bottom();
?>
