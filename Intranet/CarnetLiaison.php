<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/08/2015
 * Time: 16:14
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();

$caL = CarnetLiaison::getAll();

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
	$msg = TRUE;
	$carnetLiaison = new CarnetLiaison();
	if (!empty(trim($_POST['contenuCarnetLiaison'])) && !empty(trim($_POST['idEleve']))) {
		$carnetLiaison->setIdRedacteur($utilisateur->getIdUtilisateur());
		$carnetLiaison->setDateRedaction(date('Y-m-d H:i:s'));
		$carnetLiaison->setIdEleve($_POST['idEleve']);
		if (!empty($_POST['idReponse']))
			$carnetLiaison->setIdReponse($_POST['idReponse']);
		$carnetLiaison->setContenuCarnetLiaison($_POST['contenuCarnetLiaison']);
		$msg = $carnetLiaison->insert();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP : Carnet de Liaison</title>
	<link rel="stylesheet" href="../Intranet/styleIntranet.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../Require/jQuery-ui.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../Images/Logo32.ico"/>
	<link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jquery.js"></script>
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
				<h3 id="pageTitle" class="centrer">Carnet de Liaison</h3>
			</div>
			<?php
			if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur() || $utilisateur->estResponsable()) {
				?>
			<table id="selectAction" style="width: 100%">
				<tr>
					<td>
						<span id="newMessageClick"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouveau Message</span>
					</td>
					<td>
					</td>
				</tr>

			</table>
			</br>
			<fieldset style="width: 70%; margin: auto; display: none;" id="newMessage">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table>
						<tr>
				           <td><input id="inputIdReponse" type="hidden" name="idReponse"
				           value=""></td>
						</tr>
						<tr>
							<td>&Eacute;l&egrave;ve * :</td>
							<td>
								<select id="selectEleve" size="1" style="min-width: 200px" name="idEleve">
	                                <option value=""></option>
	                                <?php
				$eleves = Eleve::getAllActif();
				foreach ($eleves as $eleve) {
					echo '<option value="' . $eleve->getIdEleve() . '">' . $eleve->getNomUtilisateur() . ' ' . $eleve->getPrenomUtilisateur() . '</option>';
				}
				?>
	                            </select>
							</td>
						</tr>
						<tr>
							<td>Message * :</td>
							<td><textarea id="contenu" rows="10" cols="60" name="contenuCarnetLiaison" required></textarea></td>
						</tr>
						<tr>
							<td><input type="submit" id="submitButton" name="btSubmit" value="Valider"></td>
						</tr>
					</table>
				</form>
			</fieldset>
			<?php
			}
			?>
			<br/>
			<?php
			$CarnetLiaisonAll = array ();
			if ($utilisateur->estProfesseur() || $utilisateur->estResponsable()) {
				$CarnetLiaisonAll = CarnetLiaison::getByIdRedacteur($utilisateur->getIdUtilisateur());
			}
			if ($utilisateur->estAdministrateur()) {
				$CarnetLiaisonAll = CarnetLiaison::getAll();
			}
			foreach ($CarnetLiaisonAll as $carnetLiaison) {
				?>
			<fieldset style="width: 80%; margin: auto;">

				<legend>Message du <strong><?php echo $carnetLiaison->afficheDateRedaction(); ?></strong> concernant <strong><?php echo $carnetLiaison->getEleve()->getNomUtilisateur() . ' ' . $carnetLiaison->getEleve()->getPrenomUtilisateur(); ?></strong></legend>
				Auteur : <?php echo $carnetLiaison->getRedacteur()->getNomUtilisateur() . ' ' . $carnetLiaison->getRedacteur()->getPrenomUtilisateur(); ?></br>
				Message : </br><textarea rows="10" cols="60"  readonly><?php echo $carnetLiaison->getContenuCarnetLiaison() ?></textarea>
				<?php
				if ($carnetLiaison->estReponse()) {
					?>
				</br><span id="textReponse<?php echo $carnetLiaison->getIdReponse(); ?>" class="reponse" idReponse="<?php echo $carnetLiaison->getIdReponse(); ?>">Voir le Message anterieur.</span>
					<div id="Reponse<?php echo $carnetLiaison->getIdReponse(); ?>" style="display: none">
					</br>
					<fieldset id="Reponse<?php echo $carnetLiaison->getIdReponse(); ?>" style="width: 80%; margin: auto;">
						<legend>Message du <strong><?php echo $carnetLiaison->getReponse()->afficheDateRedaction(); ?></strong> concernant <strong><?php echo $carnetLiaison->getReponse()->getEleve()->getNomUtilisateur() . ' ' . $carnetLiaison->getReponse()->getEleve()->getPrenomUtilisateur(); ?></strong></legend>
						Auteur : <?php echo $carnetLiaison->getReponse()->getRedacteur()->getNomUtilisateur() . ' ' . $carnetLiaison->getReponse()->getRedacteur()->getPrenomUtilisateur(); ?></br>
						Message : </br> <textarea rows="10" cols="60"  readonly><?php echo $carnetLiaison->getReponse()->getContenuCarnetLiaison() ?></textarea>
					</fieldset>
					</div>
				<?php
				}
				?>
				</br>
				<input type='submit' class="repondre" idcarnetliaison="<?php echo $carnetLiaison->getIdCarnetLiaison(); ?>" name='repondre' value='R&eacute;pondre'/>
			</fieldset>
				</br>
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
<script src="CarnetLiaison.js"></script>
</body>
</html>
