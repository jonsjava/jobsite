<?PHP
//Date: December 15, 2005
//Programmer: Greg Spranger and Dustin Griesman
//Purpose: To analyze the date recorded in the post for the job and remove job if it exceeds 45 days
include('./db.inc.php');
$query = "SELECT pk, date FROM employment";
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
while($row = mysql_fetch_object($result))
{
	$date = $row->date;
	$curDate = date("d-M-y", time());
	if(DayDiff($date, $curDate) > 45)
	{
		$action ="Delete From employment Where pk = " . $row->pk;
		$execute = mysql_query($action) or die("Query failed due to: " . mysql_error());
		echo $date . 'and' . $row->pk;
	}
	else
	{
		echo "No changes applied during execution";
	}
}

function DayDiff($StartDate, $StopDate)
{
	return (date('U', strtotime($StopDate)) - date('U', strtotime($StartDate))) / 86400; //seconds a day
}
?>
