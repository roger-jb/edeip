<?php
	include 'ENV.php';
	include_once 'include/db.php';
	mysql_close($db);
    header ('Location: http://'.$URLracine.'/vitrine/accueil.php');
?>
