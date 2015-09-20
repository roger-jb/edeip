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
	<a href="../Intranet/MesInformations.php">Modifier mes informations</a><br/><br/>
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
			        href="../Intranet/MesInformations.php?id=<?php echo $eleves[0]->getIdUtilisateur(); ?>"
			        style="font-size: 12px">Modifier Information de l'enfant</a>
		<?php
		}
	}

	if ($utilisateur->estAdministrateur()) {
		?>
		<h3 id="adminReduc"><i class="fa fa-arrow-circle-o-up"></i> Administration</h3>
		<ul id="adminMenu">
			<li><a href="../Intranet/Utilisateur.php">gérer les utilisateurs</a></li>
			<li id="adminMatiereReduc"><i class="fa fa-arrow-circle-o-up"></i> gérer les matières</li>
			<ul id="adminMatiere">
				<li><a href="../Intranet/Matiere.php">gérer les matières</a></li>
				<li><a href="../Intranet/MatiereProf.php">assigner les matières</a></li>
			</ul>
			<li><a href="../Intranet/Niveau.php">gérer les niveaux</a></li>
			<li><a href="../Intranet/Module.php">gérer les modules</a></li>
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
					<li><a href="../Intranet/Periode.php">Définir les Périodes</a></li>
					<li><a href="../Intranet/Trimestre.php">Définir les trimestres</a></li>
				</ul>
			</li>
		</ul>

	<?php
	}

	/*if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()) {
		?>
		<h3 id="evalReduc"><i class="fa fa-arrow-circle-o-up"></i> Evaluation</h3>
		<ul id="evalMenu">
			<li><a href="../Intranet/CreateEvaluation.php">Créer Evaluation</a></li>
			<li><a href="">Affecter Note à une évaluation</a></li>
			<?php
			if ($utilisateur->estAdministrateur()) {
				?>
				<li><a href="">Gérer les types d'évaluation</a></li>
			<?php
			}
			?>
		</ul>
	<?php
	}*/

	if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur() || $utilisateur->estResponsable() || $utilisateur->estEleve()) {
		?>
		<h3 id="publiReduc"><i class="fa fa-arrow-circle-o-up"></i> Publication</h3>
		<ul id="publiMenu">
			<li><a href="../Intranet/CarnetLiaison.php">Carnet de Liaison</a></li>
			<?php
			if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()){
				?>
				<li><a href="addCahierTexte.php">Ajouter un Cahier de texte</a></li>
				<?php
			}
			?>
			<li><a href="../Intranet/CahierTexte.php">Cahier de Texte</a></li>
			<li><a id="EmploiTempsEleve" href="../Intranet/EmploiTemps.php">Emploi du temps</a></li>
			<?php
			if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()){
				?>
				<li><a href="addPlanTravail.php">Ajouter un Plan de Travail</a></li>
			<?php
			}
			?>
			<li><a href="../Intranet/PlanTravail.php">Plan de travail</a></li>
			<!--<li><a href="">Communication</a></li>-->
			<!--<li><a href="">Absences</a></li>-->
		</ul>
	<?php
	}

	/*if ($utilisateur->estAdministrateur() || $utilisateur->estProfesseur()) {
		?>
		<h3 id="bulletinReduc"><i class="fa fa-arrow-circle-o-up"></i> Bulletin</h3>
		<ul id="bulletinMenu">
			<li><a href="">Remplir Bulletin</a></li>
			<?php
			if ($utilisateur->estAdministrateur()) {
				?>
				<li><a href="">Générer Bulletin</a></li>
			<?php
			}
			?>
		</ul>
	<?php
	}*/
	?>


</div>
<script src="../Intranet/menuIntranet.js"></script>
