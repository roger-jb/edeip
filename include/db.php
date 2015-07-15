<?php
	//include '../ENV.php';
	//echo "ENV : ".$ENV;
	/*if (isset($ENV)){
		if ($ENV == 'dev'){
			$bdd = "ecoleepledepl_dev";
			$db = mysql_connect("localhost", "root", "77ry4df") or die("Impossible de se connecter &agrave; MySQL");
			mysql_select_db($bdd, $db) or die("Impossible de sélectionner la base de données");
			mysql_query("SET NAMES UTF8");
			$URLracine = "roger-leoen.ddns.net:8080/dev/edeip";
		}
		elseif ($ENV == 'tests') {
			$bdd = "ecoleepledepl_test";
			$db = mysql_connect("localhost", "ecoleepledepl", "xpN7z7xX") or die("Impossible de se connecter &agrave; MySQL");
			mysql_select_db($bdd, $db) or die("Impossible de sélectionner la base de données");
			mysql_query("SET NAMES UTF8");
			$URLracine = "roger-leoen.ddns.net:6080/edeip";
		}
	}
	//prod
	else {*/
		$bdd = "ecoleepledepl";
		$db = mysql_connect("mysql5-15.perso", "ecoleepledepl", "xpN7z7xX") or die("Impossible de se connecter à MySQL");
		mysql_select_db($bdd, $db) or die("Impossible de sélectionner la base de données");
		mysql_query("SET NAMES UTF8");
		$URLracine = "edeip-lyon.fr";
		define("DB", $db);
	//}
	//echo "BDD : ".$bdd;
    
?>
