<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 05/08/2015
 * Time: 17:44
 */

?>
<i id="reduction" class="fa fa-arrow-circle-o-left"></i>
<div id="menuContent">
	<a href="MesInformations.php">Modifier mes informations</a><br/><br/>
	<?php
	if ($utilisateur->estResponsable()) {
		$utilisateur = Responsable::getById($utilisateur->getIdUtilisateur());
		$eleves = $utilisateur->getEleves();
		if (count($eleves) > 0) {
			echo "Enfant Sélectionné :<br/>";
			if (count($eleves) == 1) {
				echo '<span hidden id="idEnfant">' . $eleves[0]->getIdUtilisateur() . '</span>';
				echo $eleves[0]->getNomUtilisateur() . " " . $eleves[0]->getPrenomUtilisateur();
			}
			else {
				?>
				<span hidden id="idEnfant"><?php echo $eleves[0]->getIdUtilisateur(); ?></span>
				<select id="choixEnfant">
					<?php
					foreach ($eleves as $eleve) {
						echo "<option value='" . $eleve->getIdEleve() . "'>" . $eleve->getNomUtilisateur() . " " . $eleve->getPrenomUtilisateur() . "</option>";
					}
					?>
				</select>
			<?php
			}
			?>
			<br/><a id="enfantURL"
			        href="MesInformations.php?id=<?php echo $eleves[0]->getIdUtilisateur(); ?>"
			        style="font-size: 12px">Modifier Information de l'enfant</a>
		<?php
		}
	}

	if ($utilisateur->estAdministrateur()) {
		?>
		<h3 id="adminReduc"><i class="fa fa-arrow-circle-o-up"></i> Administration</h3>
		<ul id="adminMenu">
			<li><a href="Utilisateur.php">gérer les utilisateurs</a></li>
			<li><a href="EleveResponsable.php">g&eacute;rer les liens parent/enfant</a> </li>
			<li id="adminMatiereReduc"><i class="fa fa-arrow-circle-o-up"></i> gérer les matières</li>
			<ul id="adminMatiere">
				<li><a href="Matiere.php">gérer les matières</a></li>
				<li><a href="MatiereProf.php">assigner les matières</a></li>
			</ul>
			<li><a href="Niveau.php">gérer les niveaux</a></li>
			<li><a href="Module.php">gérer les modules</a></li>
			<!--<li id="adminCptReduc"><i class="fa fa-arrow-circle-o-up"></i> gérer les compétences
				<ul id="adminCptMenu">
					<li><a href="../Intranet/DomaineCpt.php">domaines de compétences</a></li>
					<li><a href="../Intranet/PointCpt.php">points de compétences</a></li>
					<li><a href="../Intranet/NiveauCpt.php">niveaux de compétences</a></li>
				</ul>
			</li>-->
			<li id="adminPlanningReduc"><i class="fa fa-arrow-circle-o-up"></i> gérer la planification
				<ul id="adminPlanningMenu">
					<!-- <li><a href="">Modifier Emploi du temps</a></li> -->
					<li><a href="">Définir les Périodes</a></li>
					<li><a href="hp">Définir les trimestres</a></li>
				</ul>
			</li>
		</ul>

	<?php
	}

	if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()) {
		?>
		<h3 id="evalReduc"><i class="fa fa-arrow-circle-o-up"></i> Evaluation</h3>
		<ul id="evalMenu">
			<li><a href="re.php">G&eacute;rer les mati&egrave;res des &eacute;l&egrave;ves</a></li>
			<li><a href="on.php">Gérer Evaluation</a></li>
			<?php
/*
			if ($utilisateur->estAdministrateur()) {
				?>
				<li><a href="">Gérer les types d'évaluation</a></li>
			<?php
			}*/
			?>
		</ul>
	<?php
	}

	if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur() || $utilisateur->estResponsable() || $utilisateur->estEleve()) {
		?>
		<h3 id="publiReduc"><i class="fa fa-arrow-circle-o-up"></i> Publication</h3>
		<ul id="publiMenu">
			<li><a href="on.php">Carnet de Liaison</a></li>
			<?php
			if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()){
				?>
				<li><a href="addCahierTexte.php">Ajouter un Cahier de texte</a></li>
				<?php
			}
			?>
			<li><a href=".php">Cahier de Texte</a></li>
			<li><a id="EmploiTempsEleve" href=".php">Emploi du temps</a></li>
			<?php
			if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()){
				?>
				<li><a href="addPlanTravail.php">Ajouter un Plan de Travail</a></li>
			<?php
			}
			?>
			<li><a href=".php">Plan de travail</a></li>
			<!--<li><a href="">Communication</a></li>-->
			<!--<li><a href="">Absences</a></li>-->
		</ul>
	<?php
	}

	if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()) {
		?>
		<h3 id="bulletinReduc"><i class="fa fa-arrow-circle-o-up"></i> Bulletin</h3>
		<ul id="bulletinMenu">
			<li><a href="BulletinComment.php">Remplir Bulletin</a></li>
			<?php
			if ($utilisateur->estAdministrateur()) {
				?>
				<li><a href="getBulletin.php">Générer Bulletin</a></li>
			<?php
			}
			?>
		</ul>
	<?php
	}
	?>


</div>
<script src="t.js"></script>
