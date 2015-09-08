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

//echo json_encode($_GET['action']::getById($_GET['id'.$_GET['action']])->toArray());


switch ($_GET['action']) {
	case 'CarnetLiaison' :
		echo json_encode(CarnetLiaison::getById($_GET['idCarnetLiaison'])->toArray());
		break;
	case 'Evaluation':
		echo json_encode(Evaluation::getById($_GET['idEvaluation'])->toArray());
		break;
    case 'Matiere' :
        echo json_encode(Matiere::getById($_GET['idMatiere'])->toArray());
        break;
    case 'Module' :
        echo json_encode(Module::getById($_GET['idModule'])->toArray());
        break;
    case 'Niveau' :
        echo json_encode(Niveau::getById($_GET['idNiveau'])->toArray());
        break;
    case 'NiveauCpt' :
        echo json_encode(NiveauCpt::getById($_GET['idNiveauCpt'])->toArray());
        break;
	case 'Periode':
		echo json_encode(Periode::getById($_GET['idPeriode'])->toArray());
		break;
	case 'Trimestre':
		echo json_encode(Trimestre::getById($_GET['idTrimestre'])->toArray());
		break;
    case 'Utilisateur' :
        echo json_encode(Utilisateur::getById($_GET['idUtilisateur'])->toArray());
        break;
}