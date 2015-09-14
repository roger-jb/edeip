<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 07/09/2015
 * Time: 17:01
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByNiveauUtilisateur' :
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
		case 'getByNiveau' :
			$Matieres = Matiere::getByNiveau($_GET['idNiveau']);
			$Matieres = Matiere::getByNiveau($_GET['idNiveau']);
			$return = array ();
			foreach ($Matieres as $mat) {
				$return[] = $mat->toArray();
			}
			echo json_encode($return);
			break;
	}
}