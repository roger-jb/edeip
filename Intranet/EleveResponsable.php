<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 03/10/2015
 * Time: 14:34
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
}
else {
	header('location: ../Intranet/connexion.php');
}
if (isset($_POST['btSubmit'])) {
	$module = new Module();
	if (!empty($_POST['idModule']))
		$module = Module::getById($_POST['idModule']);

	if (!empty(trim($_POST['libelleModule'])))
		$module->setLibelleModule($_POST['libelleModule']);
	if (!empty(trim($module->getLibelleModule())))
		if (empty($module->getIdModule())) {
			if (!empty(trim($module->getLibelleModule())))
				$module->insert();
		}
		else
			$module->update();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Lien Parent - &Eacute;l&egrave;ve</title>
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
				<h3 class="centrer">Lien Parent - &Eacute;l&egrave;ve</h3>
			</div>
			<fieldset>
				<legend>V&eacute;rification par &eacute;l&egrave;ve</legend>
				<table id="selectAction" style="width: 100%">
					<tr>
						<td>&Eacute;l&egrave;ve</td>
						<td>
							<select id="EleveSelect" name="EleveSelect">
								<option value=""></option>
								<?php
								$eleves = Eleve::getAllActif();
								foreach ($eleves as $e) {
									echo "<option value='" . $e->getIdEleve() . "'>" . $e->getLibelleUtilisatur() . "</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>
				<fieldset>
					<legend>Liste des parents li&eacute;s</legend>
					<ul id="ResponsableSelect"></ul>
				</fieldset>
			</fieldset>
			</br>
			<fieldset>
				<legend>Modification lien Parent/Enfant</legend>
				<table>
					<tr>
						<td style="width: 33%">&Eacute;l&egrave;ve</td>
						<td>
							<select id="inputEleve" name="inputEleve">
								<option value=""></option>
								<?php
								$eleves = Eleve::getAllActif();
								foreach ($eleves as $e) {
									echo "<option value='" . $e->getIdEleve() . "'>" . $e->getLibelleUtilisatur() . "</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Parent</td>
						<td>
							<select id="inputResponsable" name="inputResponsable">
								<option value=""></option>
								<?php
								$responsables = Responsable::getAllActif();
								foreach ($responsables as $r) {
									echo "<option value='" . $r->getIdResponsable() . "'>" . $r->getLibelleUtilisatur() . "</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<span id="btAjouter">Ajouter</span>
							&nbsp;&nbsp;&nbsp;
							<span id="btSupprimer">Supprimer</span>
						</td>
					</tr>
				</table>
			</fieldset>
			<br/>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
<script src="EleveResponsable.js"></script>
</body>
</html>
