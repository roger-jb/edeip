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
			<h4>3 modules</h4>
		</div>
		<p>Les élèves sont répartis en 3 modules :</p>
		<ul>
			<li>de CP à CM1</li>
			<li>de CM2 à 5ème</li>
			<li>de 4ème à 2nde</li>
		</ul>
		<div class="sous_titre_corps">
			<h4>Vie à l'école</h4>
		</div>
		<p><strong>Vacances</strong> : Le planning est identique à celui de la zone A.</p>

		<p><strong>Horaires :</strong></p>
		<ul>
			<li>Module 1 : LMJV 9h-11h30 / 13h-16h30</li>
			<li>Module 2 : LMJV 9h-12h / 13h-17h</li>
			<li>Module 3 : LMJV 9h-13h / 14h-17h + merc. 9h-11H ou 13h</li>
		</ul>
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
