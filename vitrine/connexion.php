<?php
header('content-type: text/html; charset=utf-8');
session_start();
include '../include/db_connect.php';
require_once '../Object/Utilisateur.php';
require_once '../Object/Connexion.php';
require_once '../Object/Eleve.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Connexion à l'Intranet</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../images/Logo32.ico"/>
	<link rel="icon" href="../images/logo32.png" type="image/png"/>
</head>
<body>
<div id='angle_rond'>
	<?php
	include '../include/include_header.php';
	?>

	<div class="corps">
		<br/>

		<div class="titre_corps">
			<h3 class="centrer">Merci de vous connecter</h3>
		</div>

		<?php
		if (isset($_GET['deco'])) {
			$_SESSION = array ();
			session_destroy();
		}

		$utilisateur = new Utilisateur();

		if (isset($_POST['co'])) {
			if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp'])) {
				// les champs sont bons, on sécurise

				$login = htmlentities($_POST['login'], ENT_QUOTES, 'UTF-8');
				$mdp = $_POST['mdp'];

				$connexion = Connexion::connecter($login, $mdp);
				$utilisateur = $connexion->getUtilisateur();

				if (!($utilisateur->getIdUtilisateur())) {
					echo "Le couple Login/Mot de Passe est incorrect<br/>";
				}
				else {
					$_SESSION['id'] = $utilisateur->getIdUtilisateur();
					if ($utilisateur->estResponsable()) {
						$utilisateur = Responsable::getById($utilisateur->getIdUtilisateur());
						$eleves = $utilisateur->getEleves();
						foreach ($eleves as $eleve) {
							echo "<p><a href='connexion.php?id=" . $eleve->getIdEleve() . "'>Enfant en classe de " . $eleve->getNiveau()->getLibelleNiveau() . " : " . $eleve->getNomUtilisateur() . " " . $eleve->getPrenomUtilisateur() . "</a></p>";
						}
					}
				}
			}
			else {
				// champs non remplis ?
				if (!isset($_POST['login']) || empty($_POST['login'])) {
					echo "Veuillez remplir le login<br/>";
				}
				if (!isset($_POST['mdp']) || empty($_POST['mdp'])) {
					echo "Veuillez remplir le mot de passe<br/>";
				}
			}
		}

		if (isset($_SESSION['id'])) {
			$utilisateur = Utilisateur::getById($_SESSION['id']);
		}
		if ($utilisateur->getIdUtilisateur()) {
			if (($utilisateur->estResponsable()) && isset($_GET['id']) && !empty($_GET['id'])) {
				$_SESSION['id_enfant'] = $_GET['id'];
			}
				$form = false;
				echo "<p>Bonjour <strong>" . $utilisateur->getNomUtilisateur() . " " . $utilisateur->getPrenomUtilisateur() . "</strong> !</p>";
				echo "<p><a href='../intranet/intranet.php'>Accéder à l'intranet</a></p>";
				echo "<p><a href='../intranet/changer_mdp.php'>Changer de mot de passe</a></p>";
				echo "<p><a href='../vitrine/connexion.php?deco=1'>Deconnexion</a></p>";
		}
		else {
			// sinon on affiche le form de connexion
			$form = true;
		}


		if ($form) {
			?>
			<fieldset>
				<legend>Vos informations de connexion</legend>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table>
						<tr>
							<td>Login :</td>
							<td><input type="text" size="20" name="login"/></td>
						</tr>
						<tr>
							<td>Mot de passe :</td>
							<td><input type="password" size="20" name="mdp"/></td>
						</tr>
					</table>
					<input type="submit" name="co" value="Connexion"/>
				</form>
			</fieldset>
			<p>En cas de probleme de connexion, veuillez envoyer un mail à <a href="mailto:support@edeip-lyon.fr"
			                                                                  style='color:#65B1FF;'>support@edeip-lyon.fr</a>
			</p>
		<?php
		} // fin du if ($form)
		?>
	</div>
	<?php
	include '../include/include_footer.php';
	db_connect::close();
	?>
</div>
</body>
</html>
