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
	$periode = new Periode();
	if (!empty($_POST['idPeriode']))
		$periode = Periode::getById($_POST['idPeriode']);

	if (!empty(trim($_POST['libellePeriode'])))
		$periode->setLibellePeriode($_POST['libellePeriode']);
	if (!empty(trim($_POST['dateDebutPeriode'])))
		$periode->setDateDebutPeriode($_POST['dateDebutPeriode']);
	if (!empty(trim($_POST['dateFinPeriode'])))
		$periode->setDateFinPeriode($_POST['dateFinPeriode']);
	if (!empty(trim($_POST['selectTrimestre'])))
		$periode->setIdTrimestre($_POST['selectTrimestre']);
	if (!empty(trim($periode->getLibellePeriode())))
		if (empty($periode->getIdPeriode())) {
			if (!empty(trim($periode->getLibellePeriode())))
				$periode->insert();
		} else
			$periode->update();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Gestion des P&eacute;riodes</title>
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
				<h3 class="centrer">Gestion des P&eacute;riodes</h3>
			</div>

			<table id="selectAction" style="width: 100%">
				<tr>
					<td>
						<span id="newPeriode"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouvelle P&eacute;riode</span>
					</td>
					<td>
						<div>
							P&eacute;riode :
							<select id="selectPeriode" size="1" style="min-width: 200px">
								<option value=""></option>
								<?php
								$periodes = Periode::getAll();
								foreach ($periodes as $periode) {
									echo '<option value="' . $periode->getIdPeriode() . '">' . $periode->getLibellePeriode() . '</option>';
								}
								?>
							</select>
						</div>
					</td>
				</tr>

			</table>
			</br>
			<fieldset style="width: 70%; margin: auto;">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table>
						<tr>
							<td><input id="inputId" type="hidden" name="idPeriode"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="inputLibelle"> Libell&eacute; * :</label></td>
							<td><input id="inputLibelle" type="text" required name="libellePeriode"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="inputDateDeb"> date d&eacute;but * :</label></td>
							<td><input id="inputDateDeb" type="text" required name="dateDebutPeriode"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="inputDateFin"> date fin * :</label></td>
							<td><input id="inputDateFin" type="text" required name="dateFinPeriode"
							           value=""></td>
						</tr>
						<tr>
							<td><label for="selectTrimestre"> Trimestre * :</label></td>
							<td><select id="selectTrimestre" size="1" style="min-width: 200px" name="selectTrimestre">
									<option value=""></option>
									<?php
									$trimestres = Trimestre::getAll();
									foreach ($trimestres as $trimestre) {
										echo '<option value="' . $trimestre->getIdTrimestre() . '">' . $trimestre->getLibelleTrimestre() . '</option>';
									}
									?>
								</select></td>
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
<script src="Periode.js"></script>
</body>
</html>