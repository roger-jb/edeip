<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 19/08/2015
 * Time: 15:05
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
	$trimestre = new Trimestre();
	if (!empty($_POST['idTrimestre']))
		$trimestre = Trimestre::getById($_POST['idTrimestre']);
	if (!empty(trim($_POST['dateDebutTrimestre'])))
		$trimestre->setDateDebutTrimestre(trim($_POST['dateDebutTrimestre']));
	if (!empty(trim($_POST['dateFinTrimestre'])))
		$trimestre->setDateFinTrimestre(trim($_POST['dateFinTrimestre']));
	if (!empty(trim($_POST['dateFinCommentaire'])))
		$trimestre->setDateFinCommentaire(trim($_POST['dateFinCommentaire']));
	if (!empty(trim($_POST['libelleTrimestre'])))
		$trimestre->setLibelleTrimestre($_POST['libelleTrimestre']);
	if (!empty(trim($trimestre->getLibelleTrimestre())))
		if (empty($trimestre->getIdTrimestre())) {
			if (!empty(trim($trimestre->getLibelleTrimestre())))
				$trimestre->insert();
		} else
			$trimestre->update();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Gestion des Trimestres</title>
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
				<h3 class="centrer">Gestion des Trimestres</h3>
			</div>

			<table id="selectAction" style="width: 100%">
				<tr>
					<td>
						<span id="newTrimestre"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouveau Trimestre</span>
					</td>
					<td>
						<div>
							Trimestre :
							<select id="selectTrimestre" size="1" style="min-width: 200px">
								<option value=""></option>
								<?php
								$trimestres = Trimestre::getAll();
								foreach ($trimestres as $trimestre) {
									echo '<option value="' . $trimestre->getIdTrimestre() . '">' . $trimestre->getLibelleTrimestre() . '</option>';
								}
								?>
							</select>
						</div>
					</td>
				</tr>

			</table>
			<br>
			<fieldset style="width: 70%; margin: auto;">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table>
						<tr>
							<td><input id="inputId" type="hidden" name="idTrimestre"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="inputLibelle"> Libell&eacute; * :</label></td>
							<td><input id="inputLibelle" type="text" required name="libelleTrimestre"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="inputDateDebut"> Date d&eacute;but * :</label></td>
							<td><input id="inputDateDebut" type="text" required name="dateDebutTrimestre"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="inputDateFin"> Date Fin * :</label></td>
							<td><input id="inputDateFin" type="text" required name="dateFinTrimestre"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="inputDateFinComm"> Date limite de commentaire * :</label></td>
							<td><input id="inputDateFinComm" type="text" required name="dateFinCommentaire"
							           value=""></td>
						</tr>
						<tr>
							<td><input type="submit" id="submitButton" name="btSubmit" value="Valider"></td>
						</tr>
					</table>
				</form>
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
<script src="Trimestre.js"></script>
</body>
</html>