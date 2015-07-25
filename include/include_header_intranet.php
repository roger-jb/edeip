<div class='header' style="background:url(../images/header.jpg) no-repeat top left;"/>

<div class='titre'>Ecole Des Enfants Intellectuellement Précoces de Lyon</div>
<div class="sous_titre">Impulsons leurs talents</div>


<div class="menu">
	<ul id="menu">
		<li><a href="../intranet/c_liaison.php">Cahier de liaison</a></li>
		<li><a href="../intranet/c_texte.php">Cahier de texte</a></li>
		<li><a href="../intranet/reglement.php">Règlement</a></li>
		<li><a href="../intranet/absence.php">Absences</a></li>
		<li><a href="../intranet/communication.php">Communication</a></li>
		<?php
		if ($personne->get_estAmdin()) {
			echo '<li><a href="../administration/administration.php">Administration</a></li>';
		}
		else {
			echo '<li><a href="../intranet/certificat_scolarite.php">Certificat de Scolarité</a></li>';
		}
		?>
		<li><a href="../intranet/plan_travail.php">Plan de travail</a></li>
		<li><a href="../intranet/emploi_temps.php">Emploi du temps</a></li>
		<li><a href="../notation/addEvaluation.php">Notation</a></li>
		<li><a href="../bulletin/bulletin.php">Bulletin</a></li>
		<li><a href="../intranet/contact.php">Contact</a></li>
		<li style='border-right:1px solid rgba(0,0,0,0.5);'><a href="../vitrine/connexion.php?deco=1">Deconnexion</a>
		</li>
	</ul>
</div>