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
if ($_SESSION['employer'] == 'true') {
	top("What would you like to do today?");
	if ($_GET['drop'] == 'success'){
		echo "<div align='center'><h4 style='color:red'>The selected job has been unposted</h4></div>";
	}
	elseif ($_GET['error'] == 'profanity'){
		echo "<div align='center'><h4 style='color:red'>Your job could not be posted due to unacceptable language</h4></div>";
	}
	echo "<div align='center'><a href='./choose.php?show=search'>Search Jobs</a><br>";
	echo "<a href='./choose.php?show=insert'>Insert Jobs</a><br>";
	echo "<a href='./choose.php?show=delete'>Delete Jobs</a><br></div>";
}

else{
	top("Search from any of the Criteria");
}

if ($_GET['show'] == "search"){
	body('Search from any of the Criteria');
}

if (($_SESSION['employer'] != 'true') || ($_GET['show'] == 'search')){
	if ($_GET['missing'] == 'true'){
		print "<h5 align='center'><font color='red'>All fields must be entered</font></h5>";
	}
	echo "<form name=form method='post' action='p_search.php'>Keywords:<br><input type='text' name='search_str'><br>Location: <br><select name='vLocation[]' selected size='5' multiple>";
	// Performing SQL query
	$query = "SELECT * FROM location ORDER BY name";
	$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
		$i++;
		$pk = $row["pk"];
		$name = $row["name"];
		if ($i == 1){
			echo "<option value='$pk' selected>$name";
		}
		else{
			echo "<option value='$pk'>$name";
		}
	}
	echo "</select><br>Category:<br><select name='vCategory[]' size='5' multiple>";
	// Performing SQL query
	$query = "SELECT * FROM category ORDER BY name";
	$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
	// Printing results in HTML
	$j = 0;
	while ($row = mysql_fetch_assoc($result)) {
		$j++;
		$pk = $row["pk"];
		$name = $row["name"];
		if ($j == 1){
			echo "<option value='$pk' selected>$name";
		}
		else{
			echo "<option value='$pk'>$name";
		}
	}
	echo "</select><br><input type='submit' value='Submit'></form>";
}

if (($_SESSION['employer'] == 'true') && ($_GET['show'] == 'insert')){
	body("Insert a job");
	if ($_GET['missing2'] == 'true'){
		print "<h5 align='center'><font color='red'>All fields must be entered</font></h5>";
	}
	echo "<form name=form method='post' action='p_insert.php'>";
	echo "Job Title<br>";
	echo "<input name='jTitle' type='text'></input><br>";
	echo "Job Description<br>";
	echo "<textarea name='jDescription' rows='3' cols='40'></textarea><br>";
	echo "Location: <br>";
	echo "<select name='vLocation[]' size='5' multiple>";
	// Performing SQL query
	$query = "SELECT * FROM location ORDER BY name";
	$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
	// Printing results in HTML
	$k = 0;
	while ($row = mysql_fetch_assoc($result)) {
		$k++;
		$pk = $row["pk"];
		$name = $row["name"];
		if ($k == 1){
			echo "<option value='$pk' selected>$name";
		}else{
			echo "<option value='$pk'>$name";
		}
	}
	echo "</select>";
	echo "<br>";
	echo "Category:";
	echo "<br>";
	echo "<select name='vCategory[]' size='5' multiple>";
	// Performing SQL query
	$query = "SELECT * FROM category ORDER BY name";
	$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
	// Printing results in HTML
	$l = 0;
	while ($row = mysql_fetch_assoc($result)) {
		$l++;
		$pk = $row["pk"];
		$name = $row["name"];
		if ($l == 1){
			echo "<option value='$pk' selected>$name";
		}
		else{
			echo "<option value='$pk'>$name";
		}
	}
	echo "</select><br>";
	echo "Employment Type:<br>";
	echo "<input type='radio' name='type' value='FT' checked>Full Time<br>";
	echo "<input type='radio' name='type' value='PT'>Part Time<br></input>";
	echo "<input type='radio' name='type' value='NA'>Not Available<br></input>";
	echo "<input type='radio' name='type' value='CT'>Contract<br></input>";
	echo "Salary Type:<br>";
	echo "<input type='radio' name='pay' value='HR' checked>Hourly<br></input>";
	echo "<input type='radio' name='pay' value='MO'>Monthly<br></input>";
	echo "<input type='radio' name='pay' value='YR'>Yearly<br></input>";
	echo "Wage Amount:<br><input type='text' name='wage'></input><br>";
	echo "<input type='submit' value='Submit'>";
	echo "</form>";
}
//end of loop if employer logs in

if (($_SESSION['employer'] == 'true') && ($_GET['show'] == 'delete')){
	body("Select a job to unpost");
	$query = "SELECT pk FROM account WHERE user_id='" . $_SESSION['uid'] . "'";
	$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
	$row = mysql_fetch_assoc($result);
	$uNum = $row['pk'];
	$query = "SELECT * FROM employment WHERE fk_account ='" . $uNum . "'";
	$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
	echo "<table align='center'><tr bgcolor='grey' style='color:white'><td>Date</td><td>Title</td><td>Company</td><td>Location</td></tr>";
	while ($row = mysql_fetch_assoc($result)) {
		$location = str_replace("_", "", $row['fk_location']); // cleaning all the "_" out
		$location = explode(" ", $location); // now turned into an array
		$count = 0;
		foreach ($location as $value) {
			$count++;
		}
		if ($count < 2){
			$location = trim($row['fk_location'], '_');
			$query2 = "SELECT name FROM location WHERE pk='" . $location . "'";
			//whorable style for any large scale site since multiple queries put the server under too much load
			$result2 = mysql_query($query2) or die("Query failed due to: " . mysql_error());
			$row2 = mysql_fetch_assoc($result2);
			$loc = $row2['name'];
		}
		else{
			$loc = 'MANY';
		}
		$account = trim($row['fk_account'], '_');
		$query3= "SELECT name FROM account WHERE pk='" . $account . "'";
		$result3 = mysql_query($query3) or die("Query failed due to: " . mysql_error());
		$row3 = mysql_fetch_assoc($result3);
		$acc = $row3['name'];
		echo "<tr bgcolor='white'><td>" . $row['date'] . "</td><td><a href=./p_remove.php?pkref=" . $row['pk'] . ">" . $row['title'] . "</a>"  . "</td><td>" . $acc . "</td><td>" . $loc ."</td></tr>";
	}
	echo "</table>";
}
bottom();
?>