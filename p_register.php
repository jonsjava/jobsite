<?php
include('./db.inc.php');
$password = mysql_real_escape_string($_POST['passwd']);
$username = mysql_real_escape_string($_POST['username']);
$query = "SELECT * FROM account WHERE password='$password'";
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
$passtest = mysql_num_rows($result);
$query = "SELECT * FROM account WHERE user_id='$username'";
$result = mysql_query($query) or die("Query failed due to: " . mysql_error());
$idtest = mysql_num_rows($result);
if (!(empty($_POST['phone']))){
	$phone = preg_replace('/\s/', '', $_POST['phone']);
	$phone = str_replace('-', '', $phone);
	$phone = mysql_real_escape_string($phone);
	settype($phone, "int");
}
if ((empty($_POST['username'])) || (empty($_POST['passwd'])) || (empty($_POST['passwd2'])) || (empty($_POST['rName']))){
	header("Location: ./register.php?error=missing");
	exit;
}
elseif (!(eregi('^[a-z0-9._%+-]+@[a-z0-9._%-+]+\.[a-z0-9]{2,6}$', $_POST['username']))) {
	header("Location: ./register.php?error=email");
	exit;
}
elseif (($_POST['passwd']) != ($_POST['passwd2'])){
	header("Location: ./register.php?error=match");
	exit;
}
elseif (strlen($_POST['passwd']) <= 6) {
	header("Location: ./register.php?error=weak");
	exit;
}
elseif (strlen($phone) > 10) {
	header("Location: ./register.php?error=phone");
	exit;
}elseif (($idtest != 0)) {
	header("Location: ./register.php?error=orig");
	exit;
}else{
	require('./resource.php');
	top('Register Successful');
	$usrid = $username;
	$passwd = $password;
	$name = mysql_real_escape_string($_POST['rName']);
	$emp = mysql_real_escape_string($_POST['eType']);
	settype($emp, "int");
	$query = "INSERT INTO account (user_id, name, password, employer, phone) VALUES('$usrid','$name','$passwd','$emp','$phone')";
	mysql_query($query) or die("Query failed due to: " . mysql_error());
	//initial UID grab in p_login.php or whatever file name you're using
	$vUserID=trim($_POST["username"]);
	//after validating email using regular expressions AND
	//inserting into account table, send email to user to further validate
	//the function "mysql_insert_id()" gets the ID generated from the previous INSERT operation
	$to = "$vUserID";
	$subject = 'VALIDATE EMAIL (USER ID)';
	$message = "Please copy and paste the Web address below into your Web browser's address bar...\n
This allows KATRINA.ELMO-MS.COM to validate your email\n
Thank you!!!\n
\n
".$domain.$server_root."validate.php?eml=1&pk=" . mysql_insert_id();
	$headers = "From: $admin_email";
	mail($to, $subject, $message, $headers);
	echo "<div align='center'><h4 style='color:red'>You must now click on the link sent to your email to validate</h4></div>";
	echo "<div align='center'><a href='./login.php'>Click to return to login</a></div>";
	bottom();
}
?>
