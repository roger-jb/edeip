<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 14/09/2015
 * Time: 18:48
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
if (isset($_SESSION['id'])) {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
	if (!$utilisateur->estAdministrateur()) {
		header('location: ../Intranet/mesInformations.php');
	}
} else {
	header('location: ../Intranet/connexion.php');
}
if (isset($_POST['btSubmit'])) {
	$matiere = new Matiere();
	if (!empty($_POST['idMatiere']))
		$matiere = Matiere::getById($_POST['idMatiere']);

	if (!empty(trim($_POST['libelleMatiere'])))
		$matiere->setLibelleMatiere($_POST['libelleMatiere']);
	if (!empty(trim($matiere->getLibelleMatiere())))
		if (empty($matiere->getIdMatiere())) {
			if (!empty(trim($matiere->getLibelleMatiere())))
				$matiere->insert();
		} else
			$matiere->update();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Cahier de Texte</title>
	<link rel="stylesheet" href="../Intranet/styleIntranet.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../Require/jquery-ui.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../Images/Logo32.ico"/>
	<link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jQuery.js"></script>
<script src="../Require/jquery-ui.js"></script>
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
				<h3 class="centrer">Cahier de Texte</h3>
			</div>
			<fieldset>
				<legend>Choix du jour et de la matiere</legend>
			</fieldset>
			<fieldset>
				<legend>liste du travail</legend>
				<div>

				</div>
			</fieldset>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
<script src="CahierTexte.js"></script>
</body>
</html>