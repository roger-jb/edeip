<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 28/11/2015
 * Time: 14:46
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByEleveMatiereNiveauTrimestre' :
			//idEleve: idEleve, idMatiere: idMatiere, idNiveau: idNiveau, idTrimestre:idTrimestre, action: 'getByEleveMatiereNiveauTrimestre'
			$trimestre = Trimestre::getById($_GET['idTrimestre']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$eleve = Eleve::getById($_GET['idEleve']);
			$bulletin = Bulletin::getByEleveMatiereNiveauTrimestre($eleve->getIdEleve(), $matiereNiveau->getIdMatiereNiveau(), $trimestre->getIdTrimestre());
			if (!$bulletin->getIdBulletin()){
				$ret = array();
				$ret['contenuBulletin'] = '';
				$ret['idBulletin'] = '';
				echo json_encode($ret);
				break;
			}
			echo json_encode($bulletin->toArray());
			break;
		case 'addCommentaire':
			//idEleve: idEleve, idMatiere: idMatiere, idNiveau: idNiveau, idTrimestre:idTrimestre, idBulletin: idBulletin, commBulletin: commBulletin, action: 'addCommentaire'
			$trimestre = Trimestre::getById($_GET['idTrimestre']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$eleve = Eleve::getById($_GET['idEleve']);

			$bulletin = new Bulletin();
			if ($_GET['idBulletin'] == 0){
				$bulletin->setIdEleve($eleve->getIdUtilisateur());
				$bulletin->setIdMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
				$bulletin->setContenuBulletin($_GET['commBulletin']);
				$bulletin->setDateRedacton(date('Y-m-d'));
				$bulletin->insert();
			}
			else {
				$bulletin = Bulletin::getById($_GET['idBulletin']);
				$bulletin->setContenuBulletin($_GET['commBulletin']);
				//$bulletin->setDateRedacton(date('Y-m-d'));
				$bulletin->update();
			}

			echo json_encode($bulletin->toArray());
			break;
		case 'addNivCpt' :
			//idEleve: idEleve, idTrimestre:idTrimestre, idPtCpt: idPtCpt, idNivCpt: idNivCpt, action: 'addNivCpt'
			$pointCptEleve = PointCptEleve::getById($_GET['idPtCpt'], $_GET['idEleve'], $_GET['idTrimestre']);

			// il n'existe pas, on le cr�e
			if (is_null($pointCptEleve->getIdPointCpt())){
				$pointCptEleve->setIdEleve($_GET['idEleve']);
				$pointCptEleve->setIdPointCpt($_GET['idPtCpt']);
				$pointCptEleve->setIdTrimestre($_GET['idTrimestre']);
				$pointCptEleve->setIdNiveauCpt($_GET['idNivCpt']);
				if ($_GET['idNivCpt']){
					$pointCptEleve->insert();
				}
			}
			else {
				// sinon, soit on le met � jour
				if ($_GET['idNivCpt'] != 0){
					$pointCptEleve->setIdNiveauCpt($_GET['idNivCpt']);
					$pointCptEleve->update();
				}
				// soit on le supprime
				else {
					$pointCptEleve->delete();
				}
			}
			echo json_encode($pointCptEleve->toArray());
			break;
		case 'getListeCompetence' :
			//idEleve: idEleve, idTrimestre:idTrimestre, action: 'getListeCompetence'
			// exemple param debug : /WebService/Bulletin.php?idEleve=19&idTrimestre=1&action=getListeCompetence
			$return = array();
			$idEleve = $_GET['idEleve'];
			$idTrimestre = $_GET['idTrimestre'];
			$idMatiere  = $_GET['idMatiere'];
			$pointCptEleves = PointCptEleve::getByEleveMatiereTrimestre($idEleve, $idMatiere, $idTrimestre);
			foreach($pointCptEleves as $pce){
				//$pce = new PointCptEleve();
				$return[] = "<tr><td width='70%' style='text-align: left'>(".$pce->getPointCpt()->getDomaineCpt()->getLibelleDomaineCpt().") ".$pce->getPointCpt()->getLibellePointCpt()."</td><td style='text-align: center'>".$pce->getNiveauCpt()->getCodeNiveauCpt()."</td></tr>";
			}
			echo json_encode($return);
			break;
	}
}