<?php
session_start();
session_unset();
session_destroy();
include('./db.inc.php');
require("./resource.php");
if (file_exists("setup.php")){
	top("REMOVE setup.php");
	print "You must remove the setup.php before continuing";
	bottom();
	exit();
}
top("ADMIN LOGIN");
echo "<div align='center'>";
if ($_GET["error"] == "login"){
	print "<h5 align='center'><font color='red'>User name and/or password incorrect</font></h5>";
}
?>
<form action="./a_login.php" method="POST">
			<table align="center">
				<tr>
					<td>Username</td>
					<td><input type="text" name="user_id"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"</td>
				</tr>
				<tr>
					<td><input type="submit" value="Enter"></td>
					<td>ADMIN ONLY!!!</td>
				</tr>
			</table>
		</form>
<?php
echo "</div>";
bottom();
?>
