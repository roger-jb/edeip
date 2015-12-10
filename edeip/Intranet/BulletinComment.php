<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 28/11/2015
 * Time: 11:38
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
if (isset($_SESSION['id'])) {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
	$utilisateur = Utilisateur::getById($_SESSION['id']);
	if (!($utilisateur->estAdministrateur() || $utilisateur->estProfesseur() )) {
		header('location: ../Intranet/MesInformations.php');
	}
}
else {
	header('location: ../Intranet/connexion.php');
}

if (isset($_POST['submit'])){
	echo '<pre>';
	var_dump($_POST);
	echo '</pre>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Bulletin</title>
	<link rel="stylesheet" href="../Intranet/styleIntranet.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../Require/jquery-ui.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../Images/Logo32.ico"/>
	<link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jQuery.js"></script>
<script src="../Require/jquery-ui.js"></script>
<script src="../Require/DatePickerFr.js"></script>

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
				<h3 class="centrer">Bulletin</h3>
			</div>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<fieldset>
					<legend>Choix du niveau, de la mati&egrave;re et de l'&eacute;l&egrave;ve</legend>
					<table width="100%">
						<tr>
							<td width="20%"><label for="selectTrimestre"> Trimestre : </label></td>
							<td>
								<?php
								$trimestres = Trimestre::getAll();
								?>
								<select id="selectTrimestre" name="selectTrimestre">
									<option value=""></option>
									<?php
									foreach ($trimestres as $trimestre) {
										//$trimestre = new Trimestre();
										echo '<option value="' . $trimestre->getIdTrimestre() . '">' . $trimestre->getLibelleTrimestre() . '</option>';
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="20%"><label for="selectNiveau"> Niveau : </label></td>
							<td>
								<?php
								$niveaux = Niveau::getAll();
								?>
								<select id="selectNiveau" name="selectNiveau">
									<option value=""></option>
									<?php
									foreach ($niveaux as $niveau) {
										echo '<option value="' . $niveau->getIdNiveau() . '">' . $niveau->getLibelleNiveau() . '</option>';
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="20%"><label for="selectMatiere"> Matiere : </label></td>
							<td>
								<select id="selectMatiere" name="selectMatiere">
									<option value=""></option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="selectEleve">&Eacute;l&eacute;ve : </label></td>
							<td>
								<select id="selectEleve" name="selectEleve">
									<option value=""></option>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Commentaire sur le bulletin</legend>
					<textarea id="txtCommentaire" cols="80" rows="5"></textarea><br>
					<div id="idBulletin" hidden></div>
					<input type="button" class="submit" id="btComm" name="btComm" value="enregistrer"/>
				</fieldset>
				<fieldset>
					<legend>Comp&eacute;tences pour le trimestre</legend>
					<div>
						<table>
							<tr>
								<td width="70%">(Domaine) Point de comp&eacute;tence</td>
								<td>&Eacute;valuation de la comp&eacute;tence</td>
							</tr>
							<tr>
								<td>
									<select id="idPtCpt">
										<option value=""></option>
									</select>
								</td>
								<td>
									<select class="selectNivCpt" id="idNivCpt">
										<option value=""></option>
										<?php
										$niveauCpts = NiveauCpt::getAll();
										foreach ($niveauCpts as $nc){
											echo '<option value="'.$nc->getIdNiveauCpt().'">'.$nc->getLibelleNiveauCpt().'</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td><input class="submit" type="button" id="btNivCpt" value="Valider"></td>
								<td>Remplir &agrave; vide pour supprimer</td>
							</tr>
						</table>
					</div>
					<fieldset>
						<legend>liste des comp&eacute;tences &eacute;valu&eacute;es pour l'&eacute;l&egrave;ve pour le trimestre</legend>
						<table id="listeCompetence" width="100%">
						</table>
					</fieldset>
					<fieldset>
						<legend>liste des comp&eacute;tences &eacute;valu&eacute;es pour l'&eacute;l&egrave;ve lors des &eacute;valuations</legend>
						<table id="listeCompetenceEval" width="100%">
						</table>
					</fieldset>
				</fieldset>

			</form>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
<script src="BulletinComment.js"></script>
</body>
</html>