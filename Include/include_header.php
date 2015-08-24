<div class='header' style="background:url(../Images/header.jpg) no-repeat top left;"/>

<div class='titre'>Ecole Des Enfants Intellectuellement Précoces de Lyon</div>
<div class="sous_titre">Impulsons leurs talents</div>


<div class="menu">
	<ul id="menu">
		<li><a href="../Vitrine/accueil.php">Accueil</a></li>
		<li><a href="../Vitrine/structure_accueil.php">Ecole</a>
			<ul>
				<li><a href="../Vitrine/structure_accueil.php">Structure d'accueil</a></li>
				<li><a href="../Vitrine/equipe_pedagogique.php">Equipe pédagogique</a></li>
				<li><a href="../Vitrine/equipe_partenaire.php">Equipe partenaire</a></li>
			</ul>
		</li>
		<li><a href="../Vitrine/enfant_precoce.php">Fondements</a>
			<ul>
				<li><a href="../Vitrine/enfant_precoce.php">Enfant précoce</a></li>
				<li><a href="../Vitrine/attentes_pedagogiques.php">Attentes pédagogiques</a></li>
				<li><a href="../Vitrine/objectifs_ecole.php">Objectifs de l&#8217;école</a></li>
			</ul>
		</li>
		<li><a href="../Vitrine/generalites.php">Pédagogie</a>
			<ul>
				<li><a href="../Vitrine/generalites.php">Généralités</a></li>
				<li><a href="../Vitrine/modalites_pratiques.php">Modalités pratiques</a></li>
				<li><a href="../Vitrine/modalites_didactiques.php">Modalités didactiques</a></li>
				<li><a href="../Vitrine/modalites_operationnelles.php">Modalités opérationnelles</a></li>
			</ul>
		</li>
		<li><a href="../Vitrine/association_diamant_brut.php">Association &laquo;&nbsp;Diamant Brut&nbsp;&raquo;</a>
		</li>
		<li><a href="../Vitrine/tarifs_inscriptions.php">Tarifs et inscription</a></li>
		<li><a href="../Vitrine/ateliers.php">Activités extra-scolaires</a>
			<ul>
				<!--<li><a href="../vitrine/activites.php">Consolidation des apprentissages</a></li>-->
				<li><a href="../Vitrine/ateliers.php">Ateliers plastiques CAPYBARA</a></li>
			</ul>
		</li>
		<li><a href="../Vitrine/contact.php">Contact</a></li>
		<li><a href="https://www.facebook.com/ecole.desenfantsprecoces">Facebook</a></li>
        <?php
        if (!isset($utilisateur) || empty($utilisateur->getIdUtilisateur())) {
            ?>
            <li style='border-right:1px solid rgba(0,0,0,0.5);'><a href="../Intranet/connexion.php">Intranet</a></li>
            <?php
        }
        else {
            ?>
            <li style='border-right:1px solid rgba(0,0,0,0.5);'><a href="../Intranet/connexion.php?deco">Quitter</a></li>
        <?php
        }
        ?>
	</ul>
</div>