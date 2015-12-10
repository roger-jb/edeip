<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 20/09/2015
 * Time: 16:26
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
if (isset($_POST['btSubmit'])) {
	$cahierTexte   = new CahierTexte();
	$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_POST['selectMatiere'], $_POST['selectNiveau']);
	$cahierTexte->setIdMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
	$cahierTexte->setDateRealisation($_POST['selectDate']);
	$cahierTexte->setDateRedaction(date("Y-m-d"));
	$cahierTexte->setIdRedacteur($utilisateur->getIdUtilisateur());
	$cahierTexte->setContenuCahierTexte($_POST['contenuCahierTexte']);
	$cahierTexte->insert();

	// tansfert du fichier Plan de Travail associ�.
	if (!empty($_FILES['fichierCahierTexte'])) {
		if (ftp_link::estPDFfile($_FILES['fichierCahierTexte']['name'], $_FILES['fichierCahierTexte']['type'])) {
			if ($_FILES['fichierCahierTexte']['error'] == 0)
				if (!move_uploaded_file($_FILES['fichierCahierTexte']['tmp_name'], '../CahierTexte/CahierTexte' . $cahierTexte->getIdCahierTexte() . '.pdf')) {
					echo "Un probl�me est survenu sur l'envoi du fichier. Merci de contacter le support.";
				}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Cahier de Texte</title>
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
				<h3 class="centrer">Cahier de Texte</h3>
			</div>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
				<fieldset>
					<legend>Choix du jour, du niveau et de la matiere</legend>
					<table width="100%">
						<tr>
							<!--<td><input type="radio" name="dateSelect" value="PourLe"> Pour le : <br><input type="radio"
																										   name="dateSelect"
																										   value="aPartirDu">
								A partir du :
							</td>-->
							<td><label for="selectDate"> travail pour le : </label></td>
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
					<table>
						<tr>
							<td><label for="contenu"> Travail &agrave; faire : </label></td>
							<td>
								<div id="listeTravail">
									<textarea id="contenu" rows="10" cols="60" name="contenuCahierTexte"
											  required></textarea>
								</div>
							</td>
						</tr>

						<tr>
							<td><label for="inputFichier"> Fichier PDF (5Mo Max) :</label></td>
							<td><input id="inputFichier" type="file" name="fichierCahierTexte"
									   value="" style="width: 100%;"></td>
						</tr>
					</table>
					<br>
					<input type="submit" id="submitButton" name="btSubmit" value="Ajouter">
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
<script src="addCahierTexte.js"></script>
</body>
</html>