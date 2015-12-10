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
	if (empty($utilisateur->getIdUtilisateur())) {
		header('location: ../Intranet/mesInformations.php');
	}
}
else {
	header('location: ../Intranet/connexion.php');
}
if (isset($_POST['btSubmit'])) {

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Cahier de Texte</title>
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
				<h3 class="centrer">Cahier de Texte</h3>
			</div>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<fieldset>
					<legend>Choix du jour, du niveau et de la matiere</legend>
					<table width="100%">
						<tr>
							<td><input type="radio" name="dateSelect" value="PourLe"> Pour le : <br><input type="radio"
																										   name="dateSelect"
																										   value="aPartirDu">
								A partir du :
							</td>

							<td colspan="3"><input type="text" id="selectDate" name="selectDate"></td>
						</tr>
						<tr>
							<td width="20%"><label for="selectNiveau"> Niveau : </label></td>
							<td width="30%">
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
							<td width="20%"><label for="selectMatiere"> Matiere : </label></td>
							<td width="30%">
								<select id="selectMatiere" name="selectMatiere">
									<option value=""></option>
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" id="submitButton" name="btSubmit" value="Rechercher">
				</fieldset>
			</form>
			<?php
			if (isset($_POST['btSubmit'])) {
				if (isset($_POST['selectNiveau']) && !empty($_POST['selectNiveau']) && isset($_POST['selectDate']) && !empty($_POST['selectDate'])&& isset($_POST['dateSelect']) && !empty($_POST['dateSelect'])) {

					$dateChoisi    = $_POST['selectDate'];
					$critereDate   = $_POST['dateSelect'];
					if (isset($_POST['selectMatiere']) && !empty($POST['selectMatiere'])) {
						$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_POST['selectMatiere'], $_POST['selectNiveau']);
						$cahiersTextes = CahierTexte::getByMatiereNiveauDateCritere($matiereNiveau->getIdMatiereNiveau(), $dateChoisi, $critereDate);
					}
					else
						$cahiersTextes = CahierTexte::getByNiveauDateCritere($_POST['selectNiveau'], $dateChoisi, $critereDate);
					if (count($cahiersTextes) >= 1) {
						foreach ($cahiersTextes as $CT) {
							?>
							<fieldset>
								<legend>Pour le : <?php echo $CT->afficheDateRealisation() ?>
									en <?php echo $CT->getMatiereNiveau()->getMatiere()->getLibelleMatiere() ?></legend>
								<?php echo $CT->getContenuCahierTexte() ?>

								<br>
								<br>
								<div>
									<?php
									if (file_exists("../CahierTexte/CahierTexte".$CT->getIdCahierTexte().".pdf")){
										?>
										<a href="../CahierTexte/CahierTexte<?php echo $CT->getIdCahierTexte();?>.pdf">Un document est joint au travail, cliquer ici pour le r&eacute;cup&eacute;rer</a>
										<?php
									}
									?>
								</div>
							</fieldset>
							<?php
						}
					}
					else
						echo 'Pas de travail pour les crit&egrave;res saisis.';
				}
				else {
					echo "Un des crit&egrave;re n'a pas &eacute;t&eacute; correctement saisi";
				}
			}
			?>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
<script src="addCahierTexte.js"></script>
</body>
</html>