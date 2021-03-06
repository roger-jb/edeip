<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/08/2015
 * Time: 10:40
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
	$niveau = new Niveau();
	if (!empty($_POST['idNiveau'])) $niveau = Niveau::getById($_POST['idNiveau']);

	if (!empty(trim($_POST['libelleNiveau'])) && !empty($_POST['module'])) {
		$niveau->setLibelleNiveau($_POST['libelleNiveau']);
		$niveau->setIdModule($_POST['module']);
	}

	if (!empty(trim($niveau->getLibelleNiveau()))) if (empty($niveau->getIdNiveau())) {
		if (!empty(trim($niveau->getLibelleNiveau()))) $niveau->insert();
	}
	else
		$niveau->update();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Gestion des Niveaux</title>
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
				<h3 class="centrer">Gestion des Niveaux</h3>
			</div>

			<table id="selectAction" style="width: 100%">
				<tr>
					<td>
						<span id="newNiveau"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouveau Niveau</span>
					</td>
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
				</tr>

			</table>
			</br>
			<fieldset style="width: 70%; margin: auto;">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table>
						<tr>
							<td><input id="inputId" type="hidden" name="idNiveau"
							           value=""></td>
						</tr>
						<tr>
							<td>Libell&eacute; * :</td>
							<td><input id="inputLibelle" type="text" required name="libelleNiveau"
							           value=""></td>
						</tr>
						<tr>
							<td>
								Module de rattachement :
							</td>
							<td>
								<select id="inputModule" name="module" size="1">
									<option value=""></option>
									<?php
									$modules = Module::getAll();
									foreach ($modules as $module) {
										echo "<option value='" . $module->getIdModule() . "'>" . $module->getLibelleModule() . "</option>";
									}
									?>
								</select>
							</td>
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
<script src="Niveau.js"></script>
</body>
</html>
