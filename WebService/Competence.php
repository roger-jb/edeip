<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 07/10/2015
 * Time: 21:56
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'addDomaineLib' :
			$libDomaine = $_GET['libDomaineCpt'];
			$domaine = DomaineCpt::getByLibelle($libDomaine);

			if (!$domaine->getIdDomaineCpt()){
				$domaine->setLibelleDomaineCpt($libDomaine);
				$domaine->setIdMatiere(Evaluation::getById($_GET['idEvaluation'])->getMatiereNiveau()->getMatiere()->getIdMatiere());
				$domaine->insert();
			}
			echo json_encode($domaine->toArray());
			break;
		case 'addPointLib':
			$libPointCpt = $_GET['libPointCpt'];
			$idDomaineCpt = $_GET['idDomaineCpt'];
			$domaine = DomaineCpt::getById($idDomaineCpt);
			$point = new PointCpt();
			$point->setIdDomaineCpt($domaine->getIdDomaineCpt());
			$point->setLibellePointCpt($libPointCpt);
			$point->insert();
			$idEval = $_GET['idEvaluation'];
			echo majEvalCompetence($idEval, $point->getIdPointCpt());
			break;

		case 'addPointId':
			$idDomaineCpt = $_GET['idDomaine'];
			$domaine = DomaineCpt::getById($idDomaineCpt);
			$idPointCpt = (isset($_GET['idPointCpt'])?$_GET['idPointCpt']:$idPointCpt);
			$point = PointCpt::getById($idPointCpt);
			$idEval = $_GET['idEvaluation'];
			echo majEvalCompetence($idEval, $idPointCpt);
			break;
		case 'getListe':
			$return = array();
			$idEval = $_GET['idEvaluation'];
			$pointsCpt = PointCpt::getByEvaluation($idEval);
			foreach ($pointsCpt as $pointCpt){
				$tmp = array();
				$tmp['pointCpt'] = $pointCpt->toArray();
				$tmp['domaineCpt'] = $pointCpt->getDomaineCpt()->toArray();
				$return[] = $tmp;
				$tmp = array();
			}
			echo json_encode($return);
			break;

		case 'getAllDomaineCpt':
			$domaines = DomaineCpt::getAll();
			$return = array();
			foreach ($domaines as $domaine){
				$return[] = $domaine->toArray();
			}
			echo json_encode($return);
			break;
	}
}

function majEvalCompetence($idEval, $idPoint){
	$evalPoint = EvaluationPointCpt::getByEvalPoint($idEval, $idPoint);
	if (!$evalPoint->getIdEvaluationPointCpt()){
		$evalPoint->setIdEvaluation($idEval);
		$evalPoint->setIdPointCpt($idPoint);
		$evalPoint->insert();
	}
	return json_encode($evalPoint->toArray());
}