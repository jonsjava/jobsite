<?php
include('./db.inc.php');
session_start();
if($_SESSION["valid"] != "true") {
	header("Location: ./login.php");
	exit;
}
else if ((empty($_POST["vLocation"])) || (empty($_POST["vCategory"]))){
	header("Location: ./choose.php?missing=true");
	exit;
}
require("./resource.php");
top("Your search results");
$search = mysql_real_escape_string($_POST["search_str"]);
$loc_arr = $_POST["vLocation"];
$countme1 = 0;
$loc_count = count($loc_arr);
$loc_in = "";
foreach ($loc_arr as $value){
	$countme1++;
	if ($countme1 < $loc_count){
		$loc_in .= "'$value',";
	}
	else{
		$loc_in .= "'$value'";
	}
}
$cat_arr = $_POST["vCategory"];
$countme = 0;
$cat_count = count($cat_arr);
$cat_in = "";
foreach ($cat_arr as $value){
	$countme++;
	if ($countme != $cat_count){
		$cat_in .= "'$value',";
	}
	else{
		$cat_in .= "'$value'";
	}
}
$location = implode(" ", $loc_arr);
$category = implode(" ", $cat_arr);
if (empty($_POST["search_str"])) {
	$query = "SELECT * FROM `employment` WHERE `fk_category` IN ($cat_in )AND`fk_location` IN ($loc_in);";
}
else {
	$query = "SELECT * FROM `employment` WHERE `description` LIKE '%$search%';";
}
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
echo "<table align='center'><tr bgcolor='grey' style='color:white'><td>Date</td><td>Title</td><td>Company</td><td>Location</td></tr>";
while ($row = mysql_fetch_assoc($result)) {
	$thispk = $row['fk_location'];
	$thissql = "SELECT `name` FROM `location` WHERE `pk`=$thispk LIMIT 1;";
	$thisresult = mysql_query($thissql);
	$thisrow = mysql_fetch_assoc($thisresult);
	$thisname = $thisrow['name'];
	$location = explode(" ", $location); // now turned into an array
	$loc = $thisname;
	$account = $row['fk_account'];
	$query3= "SELECT name FROM account WHERE pk='" . $account . "'";
	$result3 = mysql_query($query3) or die("Query failed due to: " . mysql_error());
	$row3 = mysql_fetch_assoc($result3);
	$acc = $row3['name'];
	echo "<tr bgcolor='white'><td>" . $row['date'] . "</td><td><a href=./description.php?pkref=" . $row['pk'] . ">" . $row['title'] . "</a>"  . "</td><td>" . $acc . "</td><td>" . $loc ."</td></tr>";
}
echo "</table>";
echo "<a href='./choose.php?show=search'>Return Home</a>";
bottom();
?>