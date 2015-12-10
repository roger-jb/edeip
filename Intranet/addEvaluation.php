<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 30/09/2015
 * Time: 21:05
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

if (isset($_POST['modif'])){
	if (isset($_POST['selectEval']) && !empty($_POST['selectEval']))
		header('location: ../Intranet/modifEval.php?idEval='.$_POST['selectEval']);
}

if (isset($_POST['cpt'])){
	if (isset($_POST['selectEval']) && !empty($_POST['selectEval']))
		header('location: ../Intranet/modifCpt.php?idEval='.$_POST['selectEval']);
}

if (isset($_POST['verif'])){
	if (isset($_POST['selectEval']) && !empty($_POST['selectEval']))
		header('location: ../Intranet/verifNote.php?idEval='.$_POST['selectEval']);
}

if (isset($_POST['noter'])){
	if (isset($_POST['selectEval']) && !empty($_POST['selectEval']))
		header('location: ../Intranet/affectNote.php?idEval='.$_POST['selectEval']);
}

if (isset($_POST['btAjouter'])) {
	$evaluation = new Evaluation();
	$evaluation->setDateEvaluation($_POST['addDate']);
	$evaluation->setIdMatiereNiveau(MatiereNiveau::getByMatiereNiveau($_POST['addMatiere'], $_POST['addNiveau'])->getIdMatiereNiveau());
	$evaluation->setIdTypeEvaluation($_POST['addType']);
	$evaluation->setTitreEvaluation($_POST['addTitre']);
	$evaluation->setMaxEvaluation($_POST['addMax']);
	if ($evaluation->getIdTypeEvaluation() == 3)
		$evaluation->setAutreEvaluation($_POST['autreEval']);

	if ($evaluation->insert()){
		$msgInsert = "<h4 style='color: green'>
				L'ajout de l'&eacute;valuation a r&eacute;ussi.
			</h4>";
	}
	else{
		$msgInsert = "<h4 style='color: red'>
				L'ajout de l'&eacute;valuation a &eacute;chou&eacute;.
			</h4>";
	}

	// tansfert du fichier Sujet associ�.
	if (!empty($_FILES['fichierSujet'])) {
		if (ftp_link::estPDFfile($_FILES['fichierSujet']['name'], $_FILES['fichierSujet']['type'])) {
			if ($_FILES['fichierSujet']['error'] == 0)
				if (!move_uploaded_file($_FILES['fichierSujet']['tmp_name'], '../Evaluation/Sujet' . $evaluation->getIdEvaluation() . '.pdf')) {
					echo "Un probl�me est survenu sur l'envoi du fichier SUJET. Merci de contacter le support.";
				}
		}
	}

	// tansfert du fichier Corrige associ�.
	if (!empty($_FILES['fichierCorrection'])) {
		if (ftp_link::estPDFfile($_FILES['fichierCorrection']['name'], $_FILES['fichierCorrection']['type'])) {
			if ($_FILES['fichierCorrection']['error'] == 0)
				if (!move_uploaded_file($_FILES['fichierCorrection']['tmp_name'], '../Evaluation/Corrige' . $evaluation->getIdEvaluation() . '.pdf')) {
					echo "Un probl�me est survenu sur l'envoi du fichier CORRIGE. Merci de contacter le support.";
				}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Evaluation</title>
	<link rel="stylesheet" href="et.css" type="text/css" media="screen"/>
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
			<?php
			if (isset($msgInsert)){
				echo $msgInsert;
			}
			?>
			<fieldset>
				<legend>Choisir une &eacute;valuation</legend>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Niveau</td>
						<td>
							<select id="selectNiveau">
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
						<td>Mati&egrave;re</td>
						<td>
							<select id="selectMatiere">
								<option value=""></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>&Eacute;valuation : </td>
						<td>
							<select id="selectEval" name="selectEval">
								<option value=""></option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" id="btModif" name="modif" value="Modifier">&nbsp;&nbsp;
							<input type="submit" id="btCpt" name="cpt" value="G&eacute;rer Comp&eacute;tences">&nbsp;&nbsp;
							<input type="submit" id="btVerif" name="verif" value="G&eacute;rer les notes">
					</tr>
				</table>
				</form>
			</fieldset>

			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
				<fieldset>
					<legend>Nouvelle &Eacute;valuation</legend>
					<input name="idEval" type="hidden" value="">
					<table width="100%">
						<tr>
							<td><label for="addDate"> date de l'&eacute;valuation : </label></td>
							<td colspan="3"><input type="text" id="addDate" name="addDate"></td>
						</tr>
						<tr>
							<td><label for="addTitre"> titre de l'&eacute;valuation : </label></td>
							<td colspan="3"><input type="text" id="addTitre" name="addTitre"></td>
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
										echo '<option value="' . $niveau->getIdNiveau() . '">' . $niveau->getLibelleNiveau() . '</option>';
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
										echo '<option value="' . $te->getIdTypeEvaluation() . '">' . $te->getLibelleTypeEvaluation() . '</option>';
									}
									?>
								</select></td>
						</tr>
						<tr>
							<td><label for="contenu">D&eacute;tail (Autre) : </label></td>
							<td>
								<input id="contenu" type="text" name="autreEval">
							</td>
						</tr>
						<tr>
							<td><label for="addMax"> Note Max de l'&eacute;valuation : </label></td>
							<td colspan="3"><input type="text" id="addMax" name="addMax" value="20"></td>
						</tr>
						<tr>
							<td><label for="inputSujet"> Sujet PDF (5Mo Max) * :</label></td>
							<td><input id="inputSujet" type="file" name="fichierSujet"
									   value="" style="width: 100%;"></td>
						</tr>
						<tr>
							<td><label for="inputCorrection"> Correction PDF (5Mo Max) * :</label></td>
							<td><input id="inputCorrection" type="file" name="fichierCorrection"
									   value="" style="width: 100%;"></td>
						</tr>
					</table>
					<br>
					<input type="submit" id="submitButton" name="btAjouter" value="Ajouter">
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
<script src="addEvaluation.js"></script>
</body>
</html>