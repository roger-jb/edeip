<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 12/09/2015
 * Time: 17:15
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addByProfesseurMatiereNiveau' :
            $professeurMatiereNiveau = ProfesseurMatiereNiveau::getByMatiereNiveau($_GET['idMatiereNiveau']);
            if (empty($professeurMatiereNiveau->getIdProfesseurMatiereNiveau())) {
                $professeurMatiereNiveau->setIdMatiereNiveau($_GET['idMatiereNiveau']);
                $professeurMatiereNiveau->setIdProfesseur(($_GET['idProfesseur']));
                if (!$professeurMatiereNiveau->insert()) {
                }
            }
            else{
                $professeurMatiereNiveau->setIdProfesseur($_GET['idProfesseur']);
                $professeurMatiereNiveau->update();
            }
            echo json_encode($professeurMatiereNiveau->toArray());
            break;

        case 'changeProfesseur':
            $matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
            $PMN = ProfesseurMatiereNiveau::getByMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
            if ($PMN->getIdProfesseurMatiereNiveau()) {
                $PMN->setIdProfesseur($_GET['idProfesseur']);
                $PMN->update();
            }
            echo json_encode('ok');
            break;
    }
}