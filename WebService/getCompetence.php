<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 01/12/2015
 * Time: 14:46
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByEleveEvaluation' :
			//idEval: idEval, idEleve: idEleve, action: 'getByEleveEvaluation'
			$return = array();

			$eval = Evaluation::getById($_GET['idEval']);
			$eleve = Eleve::getById($_GET['idEleve']);
			$evalPointCpts = EvaluationPointCpt::getByEvaluation($eval->getIdEvaluation());
			foreach($evalPointCpts as $epc){
				$eleveEvalPointCpt = EleveEvaluationPointCpt::getById($eleve->getIdUtilisateur(), $epc->getIdEvaluationPointCpt());
				if ($eleveEvalPointCpt->getIdEvaluationPointCpt() != '')
					$return[] = $eleveEvalPointCpt->toArray();
				else
					$return[] = (new EvaluationPointCpt())->toArray();
			}
			echo json_encode($return);
			break;
		case 'getByMatiereNiveauTrimestre' :
			//idMatiere: idMatiere, idNiveau: idNiveau, idTrimestre: idTrimestre, action: 'getByMatiereNiveauTrimestre'
			$return = array();

			$matiere = Matiere::getById($_GET['idMatiere']);
			$niveau = Niveau::getById($_GET['idNiveau']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($matiere->getIdMatiere(), $niveau->getIdNiveau());
			$trimestre = Trimestre::getById($_GET['idTrimestre']);

			$pointsCpt = PointCpt::getByMatiereNiveauTrimestre($matiereNiveau->getIdMatiereNiveau(), $trimestre->getIdTrimestre());

			foreach($pointsCpt as $pointCpt){
				//$pointCpt = new PointCpt();
				$return[] = "<option value='".$pointCpt->getIdPointCpt()."'>(".$pointCpt->getDomaineCpt()->getLibelleDomaineCpt().") ".$pointCpt->getLibellePointCpt()."</option>";
			}

			echo json_encode($return);
			break;
		case 'getByMatiereTrimestre':
			//idMatiere: idMatiere, idTrimestre: idTrimestre, action: 'getByMatiereTrimestre'
			//action=getByMatiereTrimestre&idMatiere=6&idTrimestre=1
			$return = array();

			$matiere = Matiere::getById($_GET['idMatiere']);
			//$niveau = Niveau::getById($_GET['idNiveau']);
			//$matiereNiveau = MatiereNiveau::getByMatiereNiveau($matiere->getIdMatiere(), $niveau->getIdNiveau());
			$trimestre = Trimestre::getById($_GET['idTrimestre']);

			$pointsCpt = PointCpt::getByMatiereTrimestre($matiere->getIdMatiere(), $trimestre->getIdTrimestre());

			foreach($pointsCpt as $pointCpt){
				//$pointCpt = new PointCpt();
				$return[] = "<option value='".$pointCpt->getIdPointCpt()."'>(".$pointCpt->getDomaineCpt()->getLibelleDomaineCpt().") ".$pointCpt->getLibellePointCpt()."</option>";
			}

			echo json_encode($return);
			break;

		case 'getByEleveMatiereTrimestre':
			//idEleve: idEleve, idMatiere: idMatiere, idNiveau: idNiveau, idTrimestre:idTrimestre, action: 'getByEleveMatiereTrimestre
			// ?action=getByEleveMatiereTrimestre&idEleve=19&idMatiere=6&idTrimestre=1&isNiveau=2
			$return = array();

			$eleve=Eleve::getById($_GET['idEleve']);
			$matiere = Matiere::getById($_GET['idMatiere']);
			$niveau = Niveau::getById($_GET['idNiveau']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($matiere->getIdMatiere(), $niveau->getIdNiveau());
			$trimestre = Trimestre::getById($_GET['idTrimestre']);

			$eleveEvalPointCpt = EleveEvaluationPointCpt::getByEleveMatiereTrimestre($eleve->getIdEleve(), $matiere->getIdMatiere(), $trimestre->getIdTrimestre());

			foreach ($eleveEvalPointCpt as $EEPC){
				//$EEPC = new EleveEvaluationPointCpt();

				$tmp = array();
				$tmp['libCpt'] = $EEPC->getEvaluationPointCpt()->getEvaluation()->getLibelleEvaluation();
				$tmp['noteCpt'] = $EEPC->getNiveauCpt()->getCodeNiveauCpt(). ' (' .$EEPC->getNiveauCpt()->getLibelleNiveauCpt() . ')';

				$return[] = $tmp;
			}

			echo json_encode($return);
			break;
		case 'getByElevePointCptTrimestreForCpt':
			//idEleve: idEleve, idMatiere: idMatiere, idTrimestre:idTrimestre, action: 'getByEleveMatiereTrimestreForCpt'
			// ?action=getByEleveMatiereTrimestre&idEleve=19&idMatiere=6&idTrimestre=1&isNiveau=2
			$return = array();

			$eleve=Eleve::getById($_GET['idEleve']);
			$pointCpt = PointCpt::getById($_GET['idPtCpt']);
			$trimestre = Trimestre::getById($_GET['idTrimestre']);

			$eleveEvalPointCpt = EleveEvaluationPointCpt::getByElevePointCpt($eleve->getIdUtilisateur(), $pointCpt->getIdPointCpt());

			foreach ($eleveEvalPointCpt as $EEPC){
				//$EEPC = new EleveEvaluationPointCpt();

				$tmp = array();
				$tmp['libCpt'] = $EEPC->getEvaluationPointCpt()->getPointCpt()->getLibellePointCpt();
				$tmp['noteCpt'] = $EEPC->getNiveauCpt()->getCodeNiveauCpt(). ' (' .$EEPC->getNiveauCpt()->getLibelleNiveauCpt() . ')';

				$return[] = $tmp;
			}

			echo json_encode($return);
			break;
	}
}