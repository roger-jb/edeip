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
switch ($_POST['action']) {
	case 'listeMatiere' :
		$Matieres = Matiere::getByNiveauProfesseur($_POST['idNiveau'], $_POST['idUtilisateur']);
		$return = array();
		foreach ($Matieres as $mat){
			$return[] = $mat->toArray();
		}

		echo json_encode($return);
		break;
}
