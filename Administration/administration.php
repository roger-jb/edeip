<?php
header('content-type: text/html; charset=utf-8');
session_start();
require_once '../include/Objects.php';
if (!isset($_SESSION['id'])) {
	header('Location: index.php');
}
else {
	$utilisateur = Utilisateur::getById($_SESSION['id']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP - Administration</title>
	<link rel="stylesheet" href="../administration/style_administration.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../images/Logo32.ico"/>
	<link rel="icon" href="../images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../include/jquery.js"></script>
<div id='angle_rond'>
	<?php
	include '../include/include_header_administration.php';
	?>
	<div id="content">
		<div id="menuLeft">
			<?php
			require_once('../include/menuIntranet.php');
			?>
		</div>
		<div id='corps' >
			<br/>

			<div class="titre_corps">
				<h3 class="centrer">Administration</h3>
			</div>
			<?php
			if ($utilisateur->estAdministrateur()) {
				?>
				<div class="sous_titre_corps">
					<h4 class="centrer">A partir de cette page, vous pouvez administrer le site via les diff&eacute;rentes
						rubriques de menu</h4>
				</div>
			<?php
			}
			else {
				echo "<p>Vous n'êtes pas autorisé à accéder à cette page. Veuillez retourner sur l'<a href='../intranet/intranet.php'>Intranet</a> ou la page d'<a hre='../vitrine/accueil.php'>Accueil</a></p>";
			}
			?>
		</div>
		<div style="clear: both;">

		</div>
	</div>
	<?php
	include '../include/include_footer.php';
	?>
</div>
</body>
</html>
