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

if (!isset($_GET['idEval'])) {
	header('location: ../Intranet/addEvaluation.php');
}
$evaluation = Evaluation::getById($_GET['idEval']);

// préparation du select du niveau de cpt
$selectNiveauCpt = "<option></option>";
$niveauCpt       = NiveauCpt::getAll();
foreach ($niveauCpt as $nv) {
	$selectNiveauCpt .= "<option value=" . $nv->getIdNiveauCpt() . ">" . $nv->getLibelleNiveauCpt() . "</option>";
}

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
			<div>
				<a href="../Intranet/addEvaluation.php">Retour au choix d'&eacute;valuation</a>
			</div>
			<div id="libRappelEval">Rappel des Informations sur l'évaluation</div>
			<fieldset id="detRappelEval">
				<legend>Rappel Information sur l'&eacute;valuation</legend>
				<input id="idEval" type="hidden" value="<?php echo $evaluation->getIdEvaluation(); ?>">
				<table width="100%">
					<tr>
						<td><label for="addDate"> date de l'&eacute;valuation : </label></td>
						<td colspan="3"><input type="text" id="addDate" name="addDate" readonly
											   value="<?php echo $evaluation->afficheDateEvaluation(); ?>"></td>
					</tr>
					<tr>
						<td><label for="addTitre"> titre de l'&eacute;valuation : </label></td>
						<td colspan="3"><input type="text" id="addTitre" name="addTitre" readonly
											   value="<?php echo $evaluation->getTitreEvaluation(); ?>"></td>
					</tr>
					<tr>
						<td width="20%"><label for="addNiveau"> Niveau : </label></td>
						<td width="30%">
							<input type="text" readonly value="<?php echo $evaluation->getMatiereNiveau()->getNiveau()
								->getLibelleNiveau(); ?>">
						</td>
					</tr>
					<tr>
						<td width="20%"><label for="addMatiere"> Matiere : </label></td>
						<td width="30%">
							<input type="text" readonly value="<?php echo $evaluation->getMatiereNiveau()->getMatiere()
								->getLibelleMatiere(); ?>">
						</td>
					</tr>
					<tr>
						<td><label for="typeEval">Type d'&eacute;valuation : </label></td>
						<td>
							<input type="text" readonly
								   value="<?php echo $evaluation->getTypeEvaluation()->getLibelleTypeEvaluation(); ?>">
						</td>
					</tr>
					<tr>
						<td><label for="contenu">D&eacute;tail (Autre) : </label></td>
						<td>
							<input id="contenu" type="text" name="autreEval" readonly
								   value="<?php echo $evaluation->getAutreEvaluation(); ?>">
						</td>
					</tr>
					<tr>
						<td><label for="addMax"> Note Max de l'&eacute;valuation : </label></td>
						<td colspan="3"><input type="text" id="addMax" name="addMax" readonly
											   value="<?php echo $evaluation->getMaxEvaluation(); ?>"></td>
					</tr>
					<tr>
						<td><label for="inputSujet"> Sujet PDF :</label></td>
						<td>
							<?php
							if (file_exists('../Evaluation/Sujet' . $evaluation->getIdEvaluation() . '.pdf')) {
								?>
								<a href="../Evaluation/Sujet<?php echo $evaluation->getIdEvaluation() ?>.pdf">Visualiser</a>
								<?php
							}
							else {
								?>
								Il n'y a pas de Sujet pour cette &eacute;valuation.
								<?php
							}
							?>
						</td>
					</tr>
					<tr>
						<td><label for="inputCorrection"> Correction PDF :</label></td>
						<td>
							<?php
							if (file_exists('../Evaluation/Corrige' . $evaluation->getIdEvaluation() . '.pdf')) {
								?>
								<a href="../Evaluation/Corrige<?php echo $evaluation->getIdEvaluation() ?>.pdf">Visualiser</a>
								<?php
							}
							else {
								?>
								Il n'y a pas de Corrig&eacute; pour cette &eacute;valuation.
								<?php
							}
							?>
						</td>
					</tr>
				</table>
			</fieldset>
			<br>

			<div id="libRappelCpt">Rappel des compétences</div>
			<fieldset id="detRappelCpt">
				<legend>Rappel des compétences</legend>
				<table width="100%">
					<thead>
					<td>racourci compétence</td>
					<td>domaine de compétence</td>
					<td>libellé de la compétence</td>
					</thead>
					<?php
					$nbCpt      = 1;
					$pointsCpts = PointCpt::getByEvaluation($evaluation->getIdEvaluation());
					foreach ($pointsCpts as $pCpt) {
						echo '<tr><td>Cpt' . $nbCpt . '</td><td><input type="hidden" value="'.$pCpt->getIdPointCpt().'" id="idCpt'.$nbCpt.'" /></span>' . $pCpt->getLibellePointCpt() . '</td><td>' . $pCpt->getDomaineCpt()
								->getLibelleDomaineCpt() . '</td></tr>';
						$nbCpt++;
					}
					$nbCpt--;
					?>
				</table>
			</fieldset>
			<br>
			<fieldset>
				<legend id="nomEleve" idEleve="idEleve">Noter un élève</legend>
				<input type="hidden" id="nbCpt" value="<?php echo $nbCpt;?>"/>
				<table>
					<tr>
						<td>&Eacute;lève :</td>
						<td>
							<select id="idEleveNote">
								<option></option>
								<?php
								$allEleves = $evaluation->getEleves();
								foreach ($allEleves as $allE) {
									echo '<option value="' . $allE->getIdEleve() . '">' . $allE->getLibelleUtilisatur() . '</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>note :</td>
						<td>
							<input type="number" id="noteEleve" idEleve="idEleve" value="" min="0"
								   max="<?php echo $evaluation->getMaxEvaluation(); ?>">
						</td>
					</tr>
				</table>
				notation des compétences :<br>
				<table>
					<tr>
						<?php
						$noteCpt = 0;
						while ($noteCpt < $nbCpt) {
							echo '<td>cpt' . ($noteCpt + 1) . '</td>';
							$noteCpt++;
						}
						?>
					</tr>
					<tr>
						<?php
						$noteCpt = 0;
						while ($noteCpt < $nbCpt) {
							echo "<td><select id='evalCpt".($noteCpt+1)."'>" . $selectNiveauCpt . "</select></td>";
							$noteCpt++;
						}
						?>
					</tr>
				</table>
				<br>
				<input id="validation" type="button" value="Valider" class="submit">
				<br>
			</fieldset>
			<br>
		</div>
		<div style="clear: both"></div>
	</div>
	<?php
	include '../Include/include_footer.php';
	db_connect::close();
	?>
</div>
<script src="affectNote.js"></script>
</body>
</html>
