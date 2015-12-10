<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 14/09/2015
 * Time: 21:19
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
if (isset($_SESSION['id'])) {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
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
			/*
			 * Dump du $_FILES
			'fichierPlanTravail' =>
			    array (size=5)
			      'name' => string 'ContratTravailCDDGardeSimpleGEDform.pdf' (length=39)
			      'type' => string 'application/pdf' (length=15)
			      'tmp_name' => string 'D:\wamp\tmp\php1A1B.tmp' (length=23)
			      'error' => int 0
			      'size' => int 192600
			 */
			if ($_FILES['fichierPlanTravail']['error'] == 0)
				if (!ftp_link::putPlanTravail('planTravail' . $planTravail->getIdPlanTravail() . '.pdf', $_FILES['fichierPlanTravail']['tmp_name']))
					echo 'PB lors du transfert de fichier';
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
			<br/>
			<fieldset>
				<legend>liste des plans de travail d&eacute;j&agrave; existant :</legend>
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
<script src="PlanTravail.js"></script>
</body>
</html>