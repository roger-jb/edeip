<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 07/09/2015
 * Time: 18:33
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByNiveauMatiere' :
			//data :{idNiveau: idNiveau, idMatiere: idMatiere, action: 'getByNiveauMatiere'}
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);

			$PlansTravail = PlanTravail::getbyMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			$return = array ();
			foreach ($PlansTravail as $pt) {
				$return[] = $pt->toArray();
			}
			echo json_encode($return);
			break;
	}
}