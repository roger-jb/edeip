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
switch ($_GET['action']) {
	case 'listeMatiereByNiveauUtilisateur' :
		$utilisateur = Utilisateur::getById($_GET['idUtilisateur']);
		$Matieres = Matiere::getByNiveauProfesseur($_GET['idNiveau'], $_GET['idUtilisateur']);
		if ($utilisateur->estAdministrateur()) $Matieres = Matiere::getByNiveau($_GET['idNiveau']);
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
}
