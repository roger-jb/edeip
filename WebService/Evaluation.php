<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 24/08/2015
 * Time: 19:35
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'listeMatiereByNiveauUtilisateur' :
			$utilisateur = Utilisateur::getById($_GET['idUtilisateur']);
			$Matieres = Matiere::getByNiveauProfesseur($_GET['idNiveau'], $_GET['idUtilisateur']);
			if ($utilisateur->estAdministrateur())
				$Matieres = Matiere::getByNiveau($_GET['idNiveau']);
			$return = array ();
			foreach ($Matieres as $mat) {
				$return[] = $mat->toArray();
			}
			echo json_encode($return);
			break;
		case 'listeEvaluationByMatiereNiveau':
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$evaluations = Evaluation::getByMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			$return = array ();
			foreach ($evaluations as $eval) {
				$return[] = $eval->toArray();
			}

			echo json_encode($return);
			break;


		case 'insertDomaine':
			echo json_encode('tutu');
			break;
			$return = new DomaineCpt();
			$return->setLibelleDomaineCpt($_GET['libDomaineCpt']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$return->setIdMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			if(!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;
		case 'insertCompetence':
			$return = new PointCpt();
			$return->setLibellePointCpt($_GET['libPointCpt']);
			$return->setIdDomaineCpt($_GET['idDomaineCpt']);
			if (!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;
	}
}elseif ($_POST['action']) {
	switch ($_POST['action']){
		case 'insertDomaine':
			$return = new DomaineCpt();
			$return->setLibelleDomaineCpt($_POST['libDomaineCpt']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_POST['idMatiere'], $_POST['idNiveau']);
			$return->setIdMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			if(!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;
		case 'insertCompetence':
			$return = new PointCpt();
			$return->setLibellePointCpt($_POST['libPointCpt']);
			$return->setIdDomaineCpt($_POST['idDomaineCpt']);
			if (!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;
	}
}
else
	echo json_encode('ERREUR DANS action');
