<?php
session_start();
session_unset();
session_destroy();
require("./resource.php");
if (file_exists("setup.php")){
	top("REMOVE setup.php");
	print "You must remove the setup.php before continuing";
	bottom();
	exit();
}
top("Please Login");
echo "<div align='center'>";
if ($_GET["error"] == "login"){
	print "<h5 align='center'><font color='red'>User name and/or password incorrect</font></h5>";
}elseif ($_GET["error"] == "mail"){
	print "<h5 align='center'><font color='red'>Please check your email to validate</font></h5>";
}
?>
<form action="./p_login.php" method="POST">
			<table align="center">
				<tr>
					<td>Username</td>
					<td><input type="text" name="usrid"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="passwd"></td>
				</tr>
				<tr>
					<td><input type="submit" value="Enter"></td>
					<td><a href="./register.php">Don't have an account? Register here</a></td>
				</tr>
			</table>
		</form>
<?php
echo "</div>";
bottom();
?>
