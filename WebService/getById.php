<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 20/08/2015
 * Time: 10:52
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
switch ($_GET['action']) {
	case 'CarnetLiaison' :
		$carnetLiaison = CarnetLiaison::getById($_GET['idCarnetLiaison']);
		echo json_encode($carnetLiaison->toArray());
		break;
	case 'Evaluation':
		$evaluation = Evaluation::getById($_GET['idEvaluation']);
		echo json_encode($evaluation->toArray());
		break;
    case 'Matiere' :
        $matiere = Matiere::getById($_GET['idMatiere']);
        echo json_encode($matiere->toArray());
        break;
    case 'Module' :
        $module = Module::getById($_GET['idModule']);
        echo json_encode($module->toArray());
        break;
    case 'Niveau' :
        $niveau = Niveau::getById($_GET['idNiveau']);
        echo json_encode($niveau->toArray());
        break;
    case 'NiveauCpt' :
        $niveauCpt = NiveauCpt::getById($_GET['idNiveauCpt']);
        echo json_encode($niveauCpt->toArray());
        break;
    case 'Utilisateur' :
        $utilisateur = Utilisateur::getById($_GET['idUtilisateur']);
        echo json_encode($utilisateur->toArray());
        break;
}