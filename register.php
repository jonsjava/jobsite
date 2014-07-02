<?php
session_start();
require("./resource.php");
top("Enter Appropriate Data");
if($_GET['error'] == "missing"){
	echo "<div align='center'><h4 style='color:red'>Enter all data</h4><br></div>";
}elseif($_GET['error'] == "match"){
	echo "<div align='center'><h4 style='color:red'>Passwords must match</h4><br></div>";
}elseif($_GET['error'] == "email"){
	echo "<div align='center'><h4 style='color:red'>Email must be valid</h4><br></div>";
}elseif($_GET['error'] == "weak"){
	echo "<div align='center'><h4 style='color:red'>Weak Password, must be 6+ characters, and not a common word</h4><br></div>";
}elseif($_GET['error'] == "exists"){
	echo "<div align='center'><h4 style='color:red'>Weak Password, must be 6+ characters</h4><br></div>";
}elseif($_GET['error'] == "orig"){
	echo "<div align='center'><h4 style='color:red'>Select a UNIQUE email and/or password</h4><br></div>";
}elseif($_GET['error'] == "phone"){
	echo "<div align='center'><h4 style='color:red'>Phone number must be less than 10 characters</h4><br></div>";
}
?>
<div align="center">
	<form name=form method="post" action="p_register.php">
	<table>
		<tr>
			<td>Email</td>
			<td><input name="username" type="text"></input></td>
		</tr>
		<tr>
			<td>Password</td><td>
			<input name="passwd" type="password"></input></td>
		</tr>
		<tr>
			<td>Re-enter Password</td>
			<td><input name="passwd2" type="password"></input></td>
		</tr>
		<tr>
			<td>Real Name or Company Name</td>
			<td><input name="rName" type="text"></input></td>
		</tr>
		<tr>
			<td>Phone - Optional</td>
			<td><input name="phone" type="text"></input></td>
		</tr>
		<tr>
			<td><input name="eType" value="1" type="radio">Employer</input></td>
			<td><input name="eType" value="0" type="radio" checked>Prospective Employee</input></td>
		</tr>
		<tr>
			<td><input type="submit" value="submit"></input></td>
		</tr>
	</table>
	</form>
</div>

<?php
bottom();
?>
