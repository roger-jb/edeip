<?php
header('content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP - Environnement</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="../Images/Logo32.ico"/>
	<link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<div id='angle_rond'>
	<?php
	include '../Include/include_header.php';
	?>
	<div class="corps">
		<br/>

		<div class="titre_corps">
			<h2 class="centrer">Environnement</h2>
		</div>
		<map name="approche">
			<area title="Equipe Pédagogique" shape="rect" coords="310,0,500,30"
			      href="/equipe_pedagogique.php"/>
			<area title="Association" shape="rect" coords="410,80,560,130"
			      href="/association_diamant_brut.php"/>
			<area title="Groupe Référents" shape="rect" coords="440,170,600,200"
			      href="/groupe_referents.php"/>
			<area title="Comité d'éthique" shape="rect" coords="440,260,600,290" href=""/>
			<area title="Structure d'accueil" shape="rect" coords="400,350,580,380"
			      href="/structure_accueil.php"/>
			<area title="Pédagogie" shape="rect" coords="310,430,410,456" href="/pedagogie.php"/>
		</map>
		<p style="text-align: center;"><img usemap="#approche" src="../Images/schema_fonctionnement_edeip_600_457.png"
		                                    alt="schema de fonctionnement"/></a></p>

		<p>Sur fond de « liberté encadrée », elles visent l’autonomie et reposent sur la mise en place des 3
			composantes pédagogiques recommandées pour aider les enfants précoces dans leur démarche
			d’apprentissage.</p>

		<p style='text-align: center;'><a href="/equipe_pedagogique.php">&gt;&gt; Equipe pédagogique</a></p>
	</div>
	<?php
	include '../Include/include_footer.php';
	?>
</div>
</body>
</html>
