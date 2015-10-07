<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 05/10/2015
 * Time: 09:13
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByMatiereNiveau' :
			$matiere = Matiere::getById($_GET['idMatiere']);
			$niveau = Niveau::getById($_GET['idNiveau']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$evaluations = Evaluation::getByMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			$return = array();
			foreach ($evaluations as $eval){
				$return[] = $eval->toArray();
			}
			echo json_encode($return);
			break;
	}
}