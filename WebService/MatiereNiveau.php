<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 12/09/2015
 * Time: 16:57
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');

if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'addByMatiereNiveau' :
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			if (empty($matiereNiveau->getIdMatiereNiveau())){
				$matiereNiveau->setIdMatiere($_GET['idMatiere']);
				$matiereNiveau->setIdNiveau(($_GET['idNiveau']));
				$matiereNiveau->insert();
			}
			echo json_encode($matiereNiveau->toArray());
			break;
		case 'getListeMatiereProf':
			$matieresNiveaux = MatiereNiveau::getByNiveau($_GET['idNiveau']);
			$html = '';
//			echo '<pre>';
//			var_dump($matieresNiveaux);
//			echo '</pre>';
			foreach ($matieresNiveaux as $MN){
//				echo '<pre>';
//				var_dump($MN);
//				var_dump($MN->getIdMatiereNiveau());
//				echo '</pre>';

				$PMN = ProfesseurMatiereNiveau::getByMatiereNiveau($MN->getIdMatiereNiveau());
//				echo '<pre>';
//				var_dump($PMN);
//				echo '</pre>';

				$html .= "<tr><td>".$MN->getMatiere()->getLibelleMatiere()."</td><td>".($PMN->getIdProfesseurMatiereNiveau()?$PMN->getProfesseur()->getLibelleUtilisatur():'Pas de Professeur d&eacute;fini')."</td></tr>";
			}
			echo json_encode($html);
			break;
		case 'suppByMatiereNiveau':
			$matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
			$PMN = ProfesseurMatiereNiveau::getByMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
			if ($PMN->getIdProfesseurMatiereNiveau())
				$PMN->delete();
//			$matiereNiveau->delete();
			echo json_encode('OK');
			break;
	}
}