<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 03/10/2015
 * Time: 15:43
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
switch ($_GET['action']) {
	case 'getResponsables':
		$eleve = Eleve::getById($_GET['idEleve']);
		$return = array();
		$responsables = $eleve->getResponsables();
		foreach ($responsables as $responsable){
			$return[] = $responsable->toArray();
		}
		echo json_encode($return);
		break;
	case 'addResponsable':
		$eleve = Eleve::getById($_GET['idEleve']);
		$responsable = Responsable::getById($_GET['idResponsable']);
		$eleveResponsable = EleveResponsable::getByEleveResponsable($eleve->getIdEleve(), $responsable->getIdResponsable());
		if (!$eleveResponsable->getIdEleve()){
			$eleveResponsable->setIdEleve($eleve->getIdEleve());
			$eleveResponsable->setIdResponsable($responsable->getIdResponsable());
			if ($eleveResponsable->insert()){
				echo json_encode('true');
			}
		}
		break;
	case 'delResponsable':
		$eleve = Eleve::getById($_GET['idEleve']);
		$responsable = Responsable::getById($_GET['idResponsable']);
		$eleveResponsable = EleveResponsable::getByEleveResponsable($eleve->getIdEleve(), $responsable->getIdResponsable());
		if ($eleveResponsable->getIdEleve()){
			if ($eleveResponsable->delete()){
				echo json_encode('true');
			}
		}
		break;
}