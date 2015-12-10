<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 13/09/2015
 * Time: 11:34
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
$user        = new Utilisateur();
$msg         = "";
$msgMdP      = "";
if (isset($_SESSION['id'])) {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
}
else {
	header('location: ../Intranet/connexion.php');
}

if (isset($_GET['id']) && (!empty($_GET['id'])))
	$user = Utilisateur::getById($_GET['id']);
else
	$user = Utilisateur::getById($_SESSION['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Emploi du temps</title>
	<link rel="stylesheet" href="styleIntranet.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../Images/Logo32.ico"/>
	<link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jQuery.js"></script>
<div id='angle_rond'>
	<?php
	include '../Include/include_header.php';
	?>
	<div id="content">
		<div id="menuLeft">
			<?php
			require_once('../Intranet/menuIntranet.php');
			?>
		</div>
		<div id="corps">
			<div class="titre_corps">
				<h3 class="centrer">Emploi du Temps Module 1</h3>
			</div>
			<img src="../Docs/EdTModule1.PNG" width="90%">
			<br/>

			<div class="titre_corps">
				<h3 class="centrer">Emploi du Temps Module 2</h3>
			</div>
			<img src="../Docs/EdTbisModule2.PNG" width="90%">
			<br/>

			<div class="titre_corps">
				<h3 class="centrer">Planning Module 2</h3>
			</div>
			<img src="../Docs/PlanningModule2.PNG" width="90%">
			<br/>

			<div class="titre_corps">
				<h3 class="centrer">Evaluations Module 2</h3>
			</div>
			<img src="../Docs/EvalModule2.PNG" width="90%">
			<br/>

			<div class="titre_corps">
				<h3 class="centrer">Emploi du Temps Module 3</h3>
			</div>
			<img src="../Docs/EdTModule3.PNG" width="90%">
			<br/>

			<div class="titre_corps">
				<h3 class="centrer">Planning Module 3</h3>
			</div>
			<img src="../Docs/PlanningModule3.PNG" width="90%">
			<br/>

			<div class="titre_corps">
				<h3 class="centrer">Evaluations 3ieme et 2nde</h3>
			</div>
			<img src="../Docs/Eval3eme2nd.PNG" width="90%">
			<br/>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
</body>
</html>
