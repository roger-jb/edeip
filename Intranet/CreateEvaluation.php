<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 24/08/2015
 * Time: 18:30
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();

if (isset($_SESSION['id'])) {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
	if (!$utilisateur->estAdministrateur() && !$utilisateur->estProfesseur()) {
		header('location: ../Intranet/mesInformations.php');
	}
}
else {
	header('location: ../Intranet/connexion.php');
}
if (isset($_POST['btSubmit'])) {
	$msg = TRUE;
	$carnetLiaison = new CarnetLiaison();
	if (!empty(trim($_POST['contenuCarnetLiaison'])) && !empty(trim($_POST['idEleve']))) {
		$carnetLiaison->setIdRedacteur($utilisateur->getIdUtilisateur());
		$carnetLiaison->setDateRedaction(date('Y-m-d H:i:s'));
		$carnetLiaison->setIdEleve($_POST['idEleve']);
		if (!empty($_POST['idReponse'])) $carnetLiaison->setIdReponse($_POST['idReponse']);
		$carnetLiaison->setContenuCarnetLiaison($_POST['contenuCarnetLiaison']);
		$msg = $carnetLiaison->insert();
	}
}
if (isset($_POST['btSubmitAll'])){

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : &Eacute;valuation</title>
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
				<h3 id="pageTitle" class="centrer">Cr&eacute;ation D'&Eacute;valuation</h3>
			</div>
			<?php
			if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur() || $utilisateur->estResponsable()) {
				?>
				<table id="selectAction" style="width: 100%">
					<tr>
						<td>
							<span id="newEvaluationClick"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouvelle &Eacute;valuation</span>
						</td>
						<td>
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
						</td>
					</tr>
					<tr>
						<td>
							Mati&egrave;re :
							<select id="selectMatiere" size="1" style="min-width: 200px">
								<option value=""></option>
							</select>
						</td>
						<td>
							&Eacute;valuation :
							<select id="selectEvaluation" size="1" style="min-width: 200px">
								<option value=""></option>
							</select>
						</td>
					</tr>
				</table>
				<br>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<input id="idUtilisateur" type="hidden" value="<?php
					echo $utilisateur->getIdUtilisateur();
					?>">
					<fieldset style="width: 90%; margin: auto;" id="newEvaluation">
						<table style="width: 100%;">
							<tr>
								<td><input id="newInputIdEvaluation" type="hidden" name="idEvaluation"
								           value=""></td>
							</tr>
							<tr>
								<td>Niveau * :</td>
								<td>
									<select id="newSelectNiveau" size="1" style="min-width: 200px" name="idNiveau">
										<option value=""></option>
										<?php
										$niveaux = Niveau::getAll();
										foreach ($niveaux as $niveau) {
											echo '<option value="' . $niveau->getIdNiveau() . '">' . $niveau->getLibelleNiveau() . '</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Matiere * :</td>
								<td>
									<select id="newSelectMatiere" size="1" style="min-width: 200px" name="idMatiere">
										<option value=""></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>type d'evaluation * :</td>
								<td>
									<select id="newSelectType" size="1" style="min-width: 200px" name="idType">
										<option value=""></option>
										<?php
										$typeEvals = TypeEvaluation::getAll();
										foreach ($typeEvals as $type) {
											echo '<option value="' . $type->getIdTypeEvaluation() . '">' . $type->getLibelleTypeEvaluation() . '</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr id="autreType" style="display: none;">
								<td>Autre * :</td>
								<td>
									<input id="newInputAutre" type="text" name="autreEvaluation"
									       value="">
								</td>
							</tr>
							<tr>
								<td>Titre :</td>
								<td>
									<input id="newInputTitre" type="text" name="titreEvaluation" value=""
									       style="width: 100%;">
								</td>
							</tr>
							<tr>
								<td>Date de l'évaluation :</td>
								<td>
									<input id="newDateEvaluation" type="text" name="dateEvaluation" value=""
									       style="width: 100%;">
								</td>
							</tr>
							<tr>
								<td>Note sur :</td>
								<td>
									<input id="newMaxEvaluation" type="text" name="maxEvaluation" value="20"
									       style="width: 100%;">
								</td>
							</tr>
							<tr>
								<td><input type="submit" id="submitButton" name="btSubmit" value="Valider"></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style="width: 90%; margin: auto;">
						<legend>Competences :</legend>
						<table style="width: 100%;">
							<tr>
								<td style="width: 30%;">Domaine de compétence :</td>
								<td>
									<input type="hidden" id="idDomaineCpt" name="idDomaineCpt" value="">
									<input type="text" id="libDomaineCpt" name="libDomaineCpt" value=""></br>
									<select>
										<option value=""></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Compétence :</td>
								<td>
									<input type="hidden" id="idPointCpt" name="idPointCpt" value="">
									<input type="text" id="libPointCpt" name="libPointCpt" value=""></br>
									<select>
										<option value=""></option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2"><span id="ajoutCpt"><i class="fa fa-plus-square-o" style="font-size: 20px;"> Ajouter la compétence</span></td>
							</tr>
						</table>
						<br>
						<table style="width: 100%;">
							<thead>
								<td>Domaine</td>
								<td>Competence</td>
								<td><span hidden id="nbCpt">0</span></td>
							</thead>
							<tbody id="listeCpt">
							</tbody>
						</table>
					</fieldset>
					<br>
					<input type="submit" id="submitButtonAll" name="btSubmitAll" value="Valider tous les changements">
				</form>
				<br>
			<?php
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
<script src="CreateEvaluation.js"></script>
</body>
</html>
