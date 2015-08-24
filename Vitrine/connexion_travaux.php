<?php
header('content-type: text/html; charset=utf-8');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP - en travaux</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../Images/Logo32.ico"/>
	<link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<div id='angle_rond'>
	<?php
	include '../Include/include_header.php';
	?>
	<div class="corps">
		</br>
		<h1>L'intranet est actuellement en maintenance.</h1>

		<h2>Vous serez informés par mail de sa réouverture</h2>

	</div>
	<?php
	include '../Include/include_footer.php';
	?>
</div>
</body>
</html>
