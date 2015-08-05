<?php
header ( 'content-type: text/html; charset=utf-8' );
session_start ();
require_once '../include/db.php';
require_once '../objet/objet.php';
$include = includeObjet ( '../' );
if (! isset ( $_SESSION ['id'] )) {
	header ( 'Location: index.php' );
} else {
	$personne = Personne::getById ( $_SESSION ['id'] );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>EDEIP - Nouveau Lien</title>
<link rel="stylesheet" href="style_administration.css" type="text/css"
	media="screen" />
<link rel="shortcut icon" href="../images/Logo32.ico" />
<link rel="icon" href="../images/logo32.png" type="image/png" />
<script src="../include/jquery.js"></script>
</head>
<body>
	<div id='angle_rond'>
<?php
include '../include/include_header_administration.php';
?>
		<div class='corps'>
			<br />
			<div class="titre_corps">
				<h3 class="centrer">Nouveau Lien</h3>
			</div>
<?php
if (isset ( $personne )) {
	if ($personne->get_estAmdin ()) { // on est admin
		if (isset ( $_POST ['envoyer'] )) { // on a validé
			if (isset ( $_POST ['id_parent'] ) && ! empty ( $_POST ['id_parent'] ) && isset ( $_POST ['id_eleve'] ) && ! empty ( $_POST ['id_eleve'] )) {
				// les champs sont bon on sécurise
				$id_eleve = mysql_real_escape_string ( htmlentities ( $_POST ['id_eleve'], ENT_QUOTES, 'UTF-8' ) );
				$id_parent = mysql_real_escape_string ( htmlentities ( $_POST ['id_parent'], ENT_QUOTES, 'UTF-8' ) );
				
				// on lie un parent et un élève
				$query = "INSERT INTO eleve_parent (id_parent, id_eleve) VALUES ('$id_parent', '$id_eleve');";
				$result = mysql_query ( $query );
				
				echo "<p>Le nouveau lien a bien été pris en compte. Retour à l'<a href='administration.php'>administration</a></p>";
			} else {
				echo "<p>Votre demande de nouveau lien n'est pas valide. Veuillez <a href='nouveau_lien.php'>réésayer</a></p>";
			}
			$form = FALSE;
		} else {
			$form = true; // on affiche le formulaire
		}
		
		if ($form) {
			$parents = Parents::recupBddActif();
			$enfants = Eleve::recupBddActif();
			?>
<fieldset style="width: 790px;">
				<legend>Nouveau lien</legend>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table>
						<tr>
							<td>Nom parent * :</td>
							<td><select id="id_parent" name="id_parent">
<?php
			foreach ( $parents as $par ) {
				echo '<option value="' . $par->get_personne ()->get_id () . '">' . $par->get_personne ()->get_nom () . " " . $par->get_personne ()->get_prenom () . '</option>';
			}
			?>
</select></td>
						</tr>
						<tr>
							<td>Nom élève * :</td>
							<td><select id="id_eleve" name="id_eleve">
<?php
			foreach ( $enfants as $enf ) {
				echo '<option value="' . $enf->get_id() . '">' . $enf->get_personne()->get_nom() . " " . $enf->get_personne()->get_prenom() . '</option>';
			}
			?>
</select></td>
						</tr>
						<tr>
							<td>Les champs suivis d'un * sont obligatoires</td>
						</tr>
					</table>
					<input type="submit" name="envoyer" value="Créer lien" />
				</form>
			</fieldset>
			<br />
<?php
		}
	} else {
		echo "<p>Vous devez être administrateur pour accéder à cette page. <a href='../intranet/intranet.php'>Retourner à L'intranet</a></p>";
	}
} else {
	echo "<p>Vous devez être connecté pour accéder à cette page. <a href='../vitrine/connexion.php'>Merci de vous connecter</a></p>";
}
?>
</div>
<?php
include '../include/include_footer.php';
mysql_close ( $db );
?>
</div>
</body>
</html>
