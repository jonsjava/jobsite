<?php
include('./db.inc.php');
require("./resource.php");
session_start();
if(($_SESSION["valid"] != "true") && ($_SESSION['employer'] != true)) {
	header("Location: ./login.php");
	exit;
}
else if ((empty($_POST["jTitle"])) || (empty($_POST["jDescription"])) || (empty($_POST["vCategory"])) || (empty($_POST["vLocation"])) || (empty($_POST["type"])) || (empty($_POST["pay"]))){
	header("Location: ./choose.php?missing2=true");
	exit;
}elseif ((inFile('./bad_words.txt', $_POST['jTitle'])) || (inFile('./bad_words.txt', $_POST['jDescription']))){
	header("Location: ./choose.php?error=profanity");
	exit;
}
top("Inserting Records");
$query = "SELECT * FROM account WHERE user_id='" . $_SESSION['uid'] . "'";
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
$row = mysql_fetch_assoc($result);
$title = mysql_real_escape_string($_POST['jTitle']);//-good to go
$emp = $row['pk']; //-good to go
$desc = mysql_real_escape_string($_POST['jDescription']);//-good to go
$arr = $_POST["vCategory"];//needs review
$loc = $_POST['vLocation'];//needs review
$date = date("d-M-y");
$desc = $title . " : " . $desc;
$category = implode(" ", $arr);
$location = implode(" ", $loc);
$emp_type = mysql_real_escape_string($_POST['type']);//-good to go
$sal_type = mysql_real_escape_string($_POST['pay']);//-good to go
$sal = mysql_real_escape_string($_POST['wage']);//-good to go
echo "<div align='center'><h4 style='color:green'>This job will be automatically removed from the system in 45 days</h4></div>";
echo "<div align='center'>Values are being inserted</div>";
$query = "INSERT INTO employment (title, description, employment_type, wage, wage_type, fk_account, fk_category, fk_location, date) VALUES('$title','$desc','$emp_type','$sal','$sal_type','$emp','$category','$location','$date')";
mysql_query($query) or die("Query failed due to: " . mysql_error());
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//New function deletions old jobs of previously entered date by employer December 15,2005
$query = "SELECT pk, date FROM employment";
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
while($row = mysql_fetch_object($result))
{
	$date = $row->date;
	$curDate = date("d-M-y", time());
	if(DayDiff($date, $curDate) > 45)
	{
		$action ="Delete  From employment Where `pk` = " . $row->pk;
		$execute = mysql_query($action) or die("Query failed due to: " . mysql_error());
	}
}
function DayDiff($StartDate, $StopDate)
{
	return (date('U', strtotime($StopDate)) - date('U', strtotime($StartDate))) / 86400; //seconds a day
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "<a href='./choose.php?show=insert'>Return Home</a>";
bottom();
?>