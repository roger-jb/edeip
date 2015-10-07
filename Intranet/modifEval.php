<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 05/10/2015
 * Time: 14:50
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
if (isset($_SESSION['id'])) {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
	if (!($utilisateur->estAdministrateur() || $utilisateur->estProfesseur())) {
		header('location: ../Intranet/mesInformations.php');
	}
}
else {
	header('location: ../Intranet/connexion.php');
}

if (isset($_POST['btModifier'])) {
	$evaluation = Evaluation::getById($_POST['idEval']);
	$evaluation->setDateEvaluation($_POST['addDate']);
	$evaluation->setIdMatiereNiveau(MatiereNiveau::getByMatiereNiveau($_POST['addMatiere'], $_POST['addNiveau'])
		->getIdMatiereNiveau());
	$evaluation->setIdTypeEvaluation($_POST['addType']);
	$evaluation->setTitreEvaluation($_POST['addTitre']);
	$evaluation->setMaxEvaluation($_POST['addMax']);
	if ($evaluation->getIdTypeEvaluation() == 3)
		$evaluation->setAutreEvaluation($_POST['autreEval']);

	$evaluation->update();

	// tansfert du fichier Sujet associé.
	if (!empty($_FILES['fichierSujet'])) {
		if (ftp_link::estPDFfile($_FILES['fichierSujet']['name'], $_FILES['fichierSujet']['type'])) {
			if ($_FILES['fichierSujet']['error'] == 0) {
				if (file_exists('../Evaluation/Sujet' . $evaluation->getIdEvaluation() . '.pdf'))
					unlink('../Evaluation/Sujet' . $evaluation->getIdEvaluation() . '.pdf');
				if (!move_uploaded_file($_FILES['fichierSujet']['tmp_name'], '../Evaluation/Sujet' . $evaluation->getIdEvaluation() . '.pdf')) {
					echo "Un problème est survenu sur l'envoi du fichier SUJET. Merci de contacter le support.";
				}
			}
		}
	}

	// tansfert du fichier Corrige associé.
	if (!empty($_FILES['fichierCorrection'])) {
		if (ftp_link::estPDFfile($_FILES['fichierCorrection']['name'], $_FILES['fichierCorrection']['type'])) {
			if ($_FILES['fichierCorrection']['error'] == 0) {
				if (file_exists('../Evaluation/Corrige' . $evaluation->getIdEvaluation() . '.pdf'))
					unlink('../Evaluation/Corrige' . $evaluation->getIdEvaluation() . '.pdf');
				if (!move_uploaded_file($_FILES['fichierCorrection']['tmp_name'], '../Evaluation/Corrige' . $evaluation->getIdEvaluation() . '.pdf')) {
					echo "Un problème est survenu sur l'envoi du fichier CORRIGE. Merci de contacter le support.";
				}
			}
		}
	}
}
elseif (isset($_GET['idEval']) && !empty($_GET['idEval']))
	$evaluation = Evaluation::getById($_GET['idEval']);
else
	header('location: ../Intranet/addEvaluation.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Evaluation</title>
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
				<h3 class="centrer">Evaluation</h3>
			</div>
			<a href="../Intranet/addEvaluation.php">Retour au choix d'&eacute;valuation</a>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
				<fieldset>
					<legend>Modifier &Eacute;valuation</legend>
					<input id="idEval" name="idEval" type="hidden"
						   value="<?php echo $evaluation->getIdEvaluation(); ?>">
					<table width="100%">
						<tr>
							<td><label for="addDate"> date de l'&eacute;valuation : </label></td>
							<td colspan="3"><input type="text" id="addDate" name="addDate"
												   value="<?php echo $evaluation->afficheDateEvaluation(); ?>"></td>
						</tr>
						<tr>
							<td><label for="addTitre"> titre de l'&eacute;valuation : </label></td>
							<td colspan="3"><input type="text" id="addTitre" name="addTitre"
												   value="<?php echo $evaluation->getTitreEvaluation(); ?>"></td>
						</tr>
						<tr>
							<td width="20%"><label for="addNiveau"> Niveau : </label></td>
							<td width="30%">
								<?php
								$niveaux = Niveau::getAll();
								?>
								<select id="addNiveau" name="addNiveau">
									<option value=""></option>
									<?php
									foreach ($niveaux as $niveau) {
										echo '<option value="' . $niveau->getIdNiveau() . '"'.($evaluation->getMatiereNiveau()->getNiveau()->getIdNiveau()==$niveau->getIdNiveau()?'selected':'').'>' . $niveau->getLibelleNiveau() . '</option>';
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="20%"><label for="addMatiere"> Matiere : </label></td>
							<td width="30%">
								<select id="addMatiere" name="addMatiere">
									<option value=""></option>
									<?php
									$matieres = Matiere::getByNiveau($evaluation->getMatiereNiveau()->getNiveau()->getIdNiveau());
									foreach ($matieres as $matiere){
										echo '<option value="' . $matiere->getIdMatiere() . '"'.($evaluation->getMatiereNiveau()->getMatiere()->getIdMatiere()==$matiere->getIdMatiere()?'selected':'').'>' . $matiere->getLibelleMatiere() . '</option>';
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="typeEval">Type d'&eacute;valuation : </label></td>
							<td><select id="typeEval" name="addType">
									<option value=""></option>
									<?php
									$typeEval = TypeEvaluation::getAll();
									foreach ($typeEval as $te) {
										echo '<option value="' . $te->getIdTypeEvaluation() . '" ' . ($evaluation->getIdTypeEvaluation() == $te->getIdTypeEvaluation() ? 'selected' : '') . ' >' . $te->getLibelleTypeEvaluation() . '</option>';
									}
									?>
								</select></td>
						</tr>
						<tr>
							<td><label for="contenu">D&eacute;tail (Autre) : </label></td>
							<td>
								<input id="contenu" type="text" name="autreEval" value="<?php echo $evaluation->getAutreEvaluation(); ?>">
							</td>
						</tr>
						<tr>
							<td><label for="addMax"> Note Max de l'&eacute;valuation : </label></td>
							<td colspan="3"><input type="text" id="addMax" name="addMax" value="20"></td>
						</tr>
						<?php
						if (file_exists('../Evaluation/Sujet' . $evaluation->getIdEvaluation() . '.pdf')) {
							?>
							<tr id="libSujet">
								<td colspan="2" style="color: green">Il existe un sujet pour cette &eacute;valuation.
									<span id="delSujet" style="color: orange">supprimer</span>&nbsp;&nbsp;<a href="../Evaluation/Sujet<?php echo $evaluation->getIdEvaluation(); ?>.pdf">Visualiser</a>
								</td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td><label for="inputSujet"> Sujet PDF (5Mo Max) * :</label></td>
							<td><input id="inputSujet" type="file" name="fichierSujet"
									   value="" style="width: 100%;"></td>
						</tr>
						<?php
						if (file_exists('../Evaluation/Corrige' . $evaluation->getIdEvaluation() . '.pdf')) {
							?>
							<tr id="libCorrige">
								<td colspan="2" style="color: green">Il existe un corrig&eacute; pour cette &eacute;valuation.
									<span id="delCorrige" style="color: orange">supprimer</span>&nbsp;&nbsp;<a href="../Evaluation/Corrige<?php echo $evaluation->getIdEvaluation(); ?>.pdf">Visualiser</a>
								</td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td><label for="inputCorrection"> Correction PDF (5Mo Max) * :</label></td>
							<td><input id="inputCorrection" type="file" name="fichierCorrection"
									   value="" style="width: 100%;"></td>
						</tr>
					</table>
					<br>
					<input type="submit" id="submitButton" name="btModifier" value="Modifier">
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
<script src="modifEval.js"></script>
</body>
</html>