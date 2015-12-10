<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 28/11/2015
 * Time: 13:28
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByMatiereNiveau' :
			//idMatiere: idMatiere, idNiveau: idNiveau, action: 'getByMatiereNiveau'
			$matiere = Matiere::getById($_GET['idMatiere']);
			$niveau = Niveau::getById($_GET['idNiveau']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($matiere->getIdMatiere(), $niveau->getIdNiveau());
			$eleves = Eleve::getByMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			$return = array ();
			foreach ($eleves as $eleve) {
				$return[] = $eleve->toArray();
			}
			echo json_encode($return);
			break;
		case 'getByNiveau':
			//idNiveau: idNiveau, action: 'getByNiveau'
			$niveau = Niveau::getById($_GET['idNiveau']);
			$eleves = Eleve::getByNiveau($niveau->getIdNiveau());
			$return = array ();
			foreach ($eleves as $eleve) {
				$return[] = $eleve->toArray();
			}
			echo json_encode($return);
			break;
	}
}