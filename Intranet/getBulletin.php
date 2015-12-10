<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 01/12/2015
 * Time: 00:27
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
if (isset($_SESSION['id'])) {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
	if (!($utilisateur->estAdministrateur())) {
		header('location: ../Intranet/mesInformations.php');
	}
}
else {
	header('location: ../Intranet/connexion.php');
}

if (isset($_POST['rechercher'])){
	if (isset($_POST['selectEleve']) && !empty($_POST['selectTrimestre']))
		header('location: ../Bulletin/genBulletin.php?idEleve='.$_GET['selectEleve'].'&idTrimestre='.$_GET['idTrimestre']);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Bulletin</title>
	<link rel="stylesheet" href="styleIntranet.css" type="text/css" media="screen"/>
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
			<fieldset>
				<legend>Choisir un niveau et un &eacute;l&egrave;ve</legend>
				<form method="post" action="<?php echo '../Bulletin/genBulletin.php' ?>">
					<table>
						<tr>
							<td>Trimestre</td>
							<td>
								<select id="selectTrimestre" name="idTrimestre">
									<option value=""></option>
									<?php
									$trimestres = Trimestre::getAll();
									foreach ($trimestres as $trimestre){
										echo "<option value='".$trimestre->getIdTrimestre()."'>".$trimestre->getLibelleTrimestre()."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Niveau</td>
							<td>
								<select id="selectNiveau" name="idNiveau">
									<option value=""></option>
									<?php
									$niveaux = Niveau::getAll();
									foreach ($niveaux as $niv){
										echo "<option value='".$niv->getIdNiveau()."'>".$niv->getLibelleNiveau()."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>&Eacute;l&egrave;ve :</td>
							<td>
								<select id="selectEleve" name="idEleve">
									<option value=""></option>
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" id="btRechercher" name="genBulletin" value="G&eacute;n&eacute;ner Bulletin">
					<input type="submit" id="btRechercher" name="genNotes" value="G&eacute;n&eacute;ner Relev&eacute; de Notes">
					<input type="submit" id="btRechercher" name="genCpt" value="G&eacute;n&eacute;ner Livret de Comp&eacute;tences">
				</form>
			</fieldset>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
<script src="getBulletin.js"></script>
</body>
</html>