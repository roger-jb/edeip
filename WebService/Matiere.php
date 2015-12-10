<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/11/2015
 * Time: 15:06
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');

if (isset ($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addMatiere' :
            $eleve = Eleve::getById($_GET['idEleve']);
            $matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
            $eleveMatiereNiveau = EleveMatiereNiveau::getyId($eleve->getIdEleve(), $matiereNiveau->getIdMatiereNiveau());
            if ($eleveMatiereNiveau->getIdEleve() == ''){
                $eleveMatiereNiveau->setIdEleve($eleve->getIdEleve());
                $eleveMatiereNiveau->setIdMatiereNiveau($matiereNiveau->getIdMatiereNiveau());
                $eleveMatiereNiveau->insert();
            }
            echo json_encode($eleve->toArray());
            break;
        case 'delMatiere':
            $eleve = Eleve::getById($_GET['idEleve']);
            $matiereNiveau = MatiereNiveau::getByMatiereNiveau($_GET['idMatiere'], $_GET['idNiveau']);
            $eleveMatiereNiveau = EleveMatiereNiveau::getyId($eleve->getIdEleve(), $matiereNiveau->getIdMatiereNiveau());
            if ($eleveMatiereNiveau->getIdEleve() != ''){
                $eleveMatiereNiveau->delete();
            }
            echo json_encode($eleve->toArray());
            break;

    }
}