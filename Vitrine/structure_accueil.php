<?php
header('content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>EDEIP - Structure d'accueil</title>
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
			<h3 class="centrer">Structure d’accueil</h3>
		</div>
		<p>L’Ecole Des Enfants Intellectuellement Précoces de Lyon accueille les élèves</p>

		<p>27 rue Raoul Servant 69007 LYON</p>

		<div class="sous_titre_corps">
			<h4>4 modules</h4>
		</div>
		<p>A partir de septembre 2016, les élèves seront répartis en 4 modules :</p>
		<ul>
			<li>module 1 : du CP au CE2 (cycle des apprentissages fondamentaux)</li>
			<li>module 2 : du CM1 à la 6ème (cycle de consolidation)</li>
			<li>module 3 : de la 5ème à la 3ème (cycle d’approfondissement)</li>
			<li>module 4 : de la 2nde à la terminale (lycée)</li>
		</ul>
		<p>L’EDEIP propose les séries S, ES et L. Les élèves qui sollicitent une entrée en terminale et n’ayant pas effectué l’année de 1ère à l’EDEIP seront inscrits sur liste d’attente.</p>
		<div class="sous_titre_corps">
			<h4>Vie à l'école</h4>
		</div>
		<p><strong>Vacances</strong> : Le planning est identique à celui de la zone A.</p>

		<p><strong>Horaires :</strong></p>
		<p>Les horaires des modules 1 et 2 sont répartis sur 4 jours (LMJV), de 9h à 16h30. Les élèves des modules 3 et 4 terminent la journée à 17h et ont en plus cours le mercredi matin.</p>
		<br>
		<p><strong>Repas de midi</strong> : apporté par chaque élève, il est pris à l’école. Les activités pendant la
			pause sont libres : sieste, jeux, lecture, …

		<p style='text-align: center;'><a href="/equipe_pedagogique.php">&gt;&gt; Equipe Pédagogique</a></p>
	</div>
	<?php
	include '../Include/include_footer.php';
	?>
</div>
</body>
</html>
