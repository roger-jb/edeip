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
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'listeMatiereByNiveauUtilisateur' :
			$utilisateur = Utilisateur::getById($_GET['idUtilisateur']);
			$Matieres = Matiere::getByNiveauProfesseur($_GET['idNiveau'], $_GET['idUtilisateur']);
			if ($utilisateur->estAdministrateur())
				$Matieres = Matiere::getByNiveau($_GET['idNiveau']);
			$return = array ();
			foreach ($Matieres as $mat) {
				$return[] = $mat->toArray();
			}
			echo json_encode($return);
			break;
		case 'listeEvaluationByMatiereNiveau':
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$evaluations = Evaluation::getByMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			$return = array ();
			foreach ($evaluations as $eval) {
				$return[] = $eval->toArray();
			}

			echo json_encode($return);
			break;


		case 'insertDomaine':
			echo json_encode('tutu');
			break;
			$return = new DomaineCpt();
			$return->setLibelleDomaineCpt($_GET['libDomaineCpt']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$return->setIdMatiere($matiereNiveau->getIdMatiereNiveau());
			if(!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;
		case 'insertCompetence':
			$return = new PointCpt();
			$return->setLibellePointCpt($_GET['libPointCpt']);
			$return->setIdDomaineCpt($_GET['idDomaineCpt']);
			if (!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;

		case 'delCorrige':
			echo json_encode(unlink('../Evaluation/Corrige'.$_GET['idEval'].'.pdf'));
			break;
		case 'delSujet':
			echo json_encode(unlink('../Evaluation/Sujet'.$_GET['idEval'].'.pdf'));
			break;

		case 'notation':
			//idEval: idEval, idEleve: idEleve, note: note, action: 'notation'
			$idEval = $_GET['idEval'];
			$idEleve = $_GET['idEleve'];
			$note = $_GET['note'];

			$laNote = Note::getById($idEleve, $idEval);
			if ($laNote->getIdEleve() == ''){
				$laNote->setIdEleve($idEleve);
				$laNote->setIdEvaluation($idEval);
				$laNote->setNote($note);
				if ($note)
					$laNote->insert();
			}
			else{
				if (!$note){
					$laNote->delete();
				}
				else{
					$laNote->setNote($note);
					$laNote->update();
				}
			}
			echo json_encode($laNote->toArray());
			break;

		case 'competence':
			$idEval = $_GET['idEval'];
			$idEleve = $_GET['idEleve'];
			$pushCptValCpt = $_GET['pushCptValCpt'];
			$pushCptValCpt = substr($pushCptValCpt, 0 ,strlen($pushCptValCpt)-1);
			$arrayCpt = explode('|', $pushCptValCpt);
			foreach($arrayCpt as $coupleCpt){
				$coupleCptVal = explode(':', $coupleCpt);
				$evalPointCpt = EvaluationPointCpt::getByEvalPoint($idEval, $coupleCptVal[0]);
				$eleveEvalPointCpt = EleveEvaluationPointCpt::getById($idEleve, $evalPointCpt->getIdEvaluationPointCpt());
				/*echo '<pre>';
				var_dump($eleveEvalPointCpt);
				echo '</pre>';*/
				if ($eleveEvalPointCpt->getIdEleve() == ''){
					$eleveEvalPointCpt->setIdEleve($idEleve);
					$eleveEvalPointCpt->setIdEvaluationPointCpt($coupleCptVal[0]);
					if ($coupleCptVal[1] != ''){
						$eleveEvalPointCpt->setIdNiveauCpt($coupleCptVal[1]);
						$eleveEvalPointCpt->insert();
					}
				}
				else{
					//if (!$eleveEvalPointCpt->getIdNiveauCpt()){
					if (!$coupleCptVal[1]){
						$eleveEvalPointCpt->delete();
					}
					else{
						$eleveEvalPointCpt->setIdNiveauCpt($coupleCptVal[1]);
						$eleveEvalPointCpt->update();
					}
				}
			}
			echo json_encode(Evaluation::getById($idEval)->toArray());
			break;
		case 'modifNote':
			//idEval: idEval, idEleve: idEleve, note: note, action: 'modifNote'
			$evaluation = Evaluation::getById($_GET['idEval']);
			$eleve = Eleve::getById($_GET['idEleve']);
			$laNote = $_GET['note'];
			$oldNote = Note::getById($eleve->getIdEleve(), $evaluation->getIdEvaluation());
			if ($laNote == ''){
				$oldNote->delete();
			}
			else {
				$oldNote->setNote($laNote);
				if ($oldNote->getIdEleve() != '')
					$oldNote->update();
				else {
					$oldNote->setIdEleve($eleve->getIdEleve());
					$oldNote->setIdEvaluation($evaluation->getIdEvaluation());
					$oldNote->insert();
				}
			}
			echo json_encode($oldNote->toArray());
			break;
		case 'modifCpt':
			//idEval: idEval, idEleve: idEleve, idPointCpt: idPointCpt, nivCpt: nivCpt, action: 'modifCpt'
			$evaluation = Evaluation::getById($_GET['idEval']);
			$eleve = Eleve::getById($_GET['idEleve']);
			$laCpt = EleveEvaluationPointCpt::getById($eleve->getIdEleve(), EvaluationPointCpt::getByEvalPoint($evaluation->getIdEvaluation(), $_GET['idPointCpt'])->getIdEvaluationPointCpt());
			if ($_GET['nivCpt'] == ''){
				$laCpt->delete();
			}
			else{
				$nivCpt = NiveauCpt::getById($_GET['nivCpt']);
				$laCpt->setIdNiveauCpt($nivCpt->getIdNiveauCpt());
				if ($laCpt->getIdEvaluationPointCpt() != ''){
					$laCpt->update();
				}
				else {
					$laCpt->setIdEleve($eleve->getIdEleve());
					$laCpt->setIdEvaluationPointCpt(EvaluationPointCpt::getByEvalPoint($evaluation->getIdEvaluation(), $_GET['idPointCpt'])->getIdEvaluationPointCpt());
					$laCpt->insert();
				}
			}
			echo json_encode($laCpt->toArray());
			break;

		case 'getListeEleveNoteByEval':
			//idEval: idEval, action: 'getListeEleveNoteByEval'
			$return = array();
			$evaluation = Evaluation::getById($_GET['idEval']);
			$evalCpt = EvaluationPointCpt::getByEvaluation($evaluation->getIdEvaluation());
			$eleves = Eleve::getByNoteEvaluation($evaluation->getIdEvaluation());
			foreach ($eleves as $eleve){
				$ligne = '';
				$ligne .= '<tr>';
				// nom de l'eleve
				$ligne .=  '<td>'.$eleve->getLibelleUtilisatur().'</td>';
				// recpération affichage de la note
				$note = Note::getById($eleve->getIdEleve(),$evaluation->getIdEvaluation());
				$ligne .=  '<td>'.$note->getNote().'</td>';

				//recuperation de affichage de points de compétence
				$nbCpt      = 1;
				foreach ($evalCpt as $eCpt) {
					//$eCpt = new EvaluationPointCpt();
					$elevePointCpt = EleveEvaluationPointCpt::getById($eleve->getIdUtilisateur(), $eCpt->getIdEvaluationPointCpt());
					$nbCpt++;
					if (!is_null($elevePointCpt->getIdNiveauCpt()))
						$ligne .=  '<td>'.$elevePointCpt->getNiveauCpt()->getCodeNiveauCpt().'</td>';
					else
						$ligne .=  '<td></td>';
				}
				$nbCpt--;
				$ligne .=  '</tr>';
				$return[] = $ligne;
			}

			echo json_encode($return);
			break;
	}
}elseif ($_POST['action']) {
	switch ($_POST['action']){
		case 'insertDomaine':
			$return = new DomaineCpt();
			$return->setLibelleDomaineCpt($_POST['libDomaineCpt']);
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_POST['idMatiere'], $_POST['idNiveau']);
			$return->setIdMatiere($matiereNiveau->getIdMatiereNiveau());
			if(!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;
		case 'insertCompetence':
			$return = new PointCpt();
			$return->setLibellePointCpt($_POST['libPointCpt']);
			$return->setIdDomaineCpt($_POST['idDomaineCpt']);
			if (!$return->exist())
				$return->insert();
			echo json_encode($return->toArray());
			break;
	}
}
else
	echo json_encode('ERREUR DANS action');
