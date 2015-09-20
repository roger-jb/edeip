<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 07/09/2015
 * Time: 17:08
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
	$planTravail = new PlanTravail();
	if (!empty($_POST['idPlanTravail']))
		$planTravail = PlanTravail::getById($_POST['idPlanTravail']);

	if (!empty(trim($_POST['libellePlanTravail'])))
		$planTravail->setLibellePlanTravail($_POST['libellePlanTravail']);
	if (!empty(trim($_POST['selectMatiere'])) && !empty(trim($_POST['selectNiveau'])))
		$planTravail->setIdMatiereNiveau(MatiereNiveau::getByMatiereNiveau($_POST['selectMatiere'], $_POST['selectNiveau'])->getIdMatiereNiveau());
	if (!empty(trim($_POST['SelectPeriode'])))
		$planTravail->setIdPeriode($_POST['SelectPeriode']);
	if (!empty(trim($planTravail->getLibellePlanTravail())))
		if (empty($planTravail->getIdPlanTravail())) {
			if (!empty(trim($planTravail->getLibellePlanTravail())))
				$planTravail->insert();
		}
		else
			$planTravail->update();

	// tansfert du fichier Plan de Travail associé.
	if (!empty($_FILES['fichierPlanTravail'])) {
		if (ftp_link::estPDFfile($_FILES['fichierPlanTravail']['name'], $_FILES['fichierPlanTravail']['type'])) {
			if ($_FILES['fichierPlanTravail']['error'] == 0)
				if(move_uploaded_file ($_FILES['fichierPlanTravail']['tmp_name'], '../PlanTravail/planTravail' . $planTravail->getIdPlanTravail() . '.pdf')){
					echo 'reussi';
				}
				else {
					echo 'Fail!!!';
				}
			ftp_link::close();
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Gestion des Plans de Travail</title>
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
				<h3 class="centrer">Gestion des Plans de Travail</h3>
			</div>

			<table id="selectAction" style="width: 100%">
				<tr>
					<td>
						<span id="newPlanTravail"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouveau Plan de Travail</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td>
						<div>
							Niveau :
							<select id="selectNiveau" size="1" style="min-width: 200px">
								<option value=""></option>
								<?php
								$niveaux = Niveau::getAll();
								foreach ($niveaux as $niveau) {
									echo '<option value="' . $niveau->getIdNiveau() . '">' . $niveau->getLibelleNiveau() . '</option>';
								}
								?>
							</select>
						</div>
					</td>
					<td>
						<div>
							Mati&egrave;re :
							<select id="selectMatiere" size="1" style="min-width: 200px">
								<option value=""></option>
							</select>
						</div>
					</td>
				</tr>

			</table>
			</br>
			<fieldset style="width: 70%; margin: auto;">
				<legend>Ajout d'un Plan de Travail</legend>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
					<input id="idUtilisateur" type="hidden" value="<?php
					echo $utilisateur->getIdUtilisateur();
					?>" name="idUtilisateur">
					<table>
						<tr>
							<td style="width: 35%;"><input id="inputId" type="hidden" name="idPlanTravail"
							                               value=""></td>
							<td style="width: 65%;"></td>
						</tr>
						<tr>
							<td><label for="inputLibelle"> Libell&eacute; * :</label></td>
							<td><input id="inputLibelle" type="text" required name="libellePlanTravail"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="newSelectNiveau"> Niveau * :</label></td>
							<td><select id="newSelectNiveau" size="1" style="min-width: 200px" name="selectNiveau">
									<option value=""></option>
									<?php
									$niveaux = Niveau::getAll();
									foreach ($niveaux as $niveau) {
										echo '<option value="' . $niveau->getIdNiveau() . '">' . $niveau->getLibelleNiveau() . '</option>';
									}
									?>
								</select>
						</tr>
						<tr>
							<td><label for="newSelectMatiere"> Mati&egrave;re * :</label></td>
							<td><select id="newSelectMatiere" size="1" style="min-width: 200px" name="selectMatiere">
									<option value=""></option>
								</select></td>
						</tr>
						<tr>
							<td><label for="newSelectPeriode"> P&eacute;riode * :</label></td>
							<td><select id="newSelectPeriode" type="text" required name="SelectPeriode"
							            value="">
									<option value=""></option>
									<?php
									$periodes = Periode::getAll();
									foreach ($periodes as $periode) {
										echo '<option value="' . $periode->getIdPeriode() . '">' . $periode->getLibellePeriode() . '</option>';
									}
									?>
								</select></td>
						</tr>
						<tr>
							<td><label for="inputFichier"> Fichier PDF (5Mo Max) * :</label></td>
							<td><input id="inputFichier" type="file" required name="fichierPlanTravail"
							           value="" style="width: 100%;"></td>
						</tr>
						<tr>
							<td><input type="submit" id="submitButton" name="btSubmit" value="Valider"></td>
						</tr>
					</table>
				</form>
			</fieldset>
			<br/>
			<fieldset>
				<legend>liste des plans de travail déjà existant :</legend>
				<table id="listePlanTravail"></table>
			</fieldset>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
<script src="addPlanTravail.js"></script>
</body>
</html>