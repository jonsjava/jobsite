<?php
function top($header){
	include("config.inc.php");
	if ($_SESSION['is_admin'] || $_SESSION['is_moderator'] || $_SESSION['valid']){
		$url = "<a href=\"./login.php\">Logout</a>	|";
}
else{
	$url = "";
}
	echo <<< END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> $title </title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="container">
			<div id="head">
				<h2>$m_head</h2>
			</div>
			<!-- css needs to be reworked so that i dont have to use id an make the html valid-->
			<div id="head">
				<h4>
					| <a href="http://jonsjava.com">JonsJava</a> |
					$url
				</h4>
			</div>
			<div id="side">
				<div class="inSide">
					<div class="boxhead">
						<h2>$ttopr</h2>
					</div>
					<div class="boxbody">
						$topr
					</div>
				</div>
				<div class="inSide">
					<div class="boxhead">
						<h2>$tbotr</h2>
					</div>
					<div class="boxbody">
						$botr
					</div>
				</div>
			</div>
			<div id="content">
				<div class="inMain">
					<div class="boxhead">
						<h2>$header</h2>
					</div>
					<div class="boxbody">
END;

}



function body($header){

	echo <<< END
					</div>
				</div>
				<div class="inMain">
					<div class="boxhead">
						<h2>$header</h2>
					</div>
					<div class="boxbody">
END;
}



function bottom(){
	echo <<< END
					</div>
				</div>
			</div>
			<div id="head">
				<h4>
					Copyleft 2005-2009 <a href="http://jonsjava.com">JonsJava</a>
				</h4>
			</div>
		</div>
	</body>
</html>
END;

}

function inFile($file, $string) {
	$fileString = file_get_contents($file);
	$matchString = preg_replace('/\s/', '|', trim($fileString));
	if (eregi($matchString, $string)) {
		return true;
	}
	else {
		return false;
	}
}
