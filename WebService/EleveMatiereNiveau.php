<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/11/2015
 * Time: 11:26
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');

if (isset ($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getListeMatiere' :
            $return = array();
            $eleve = Eleve::getById($_GET['idEleve']);
            $matiereNiveau = MatiereNiveau::getFollowingByEleve($eleve->getIdEleve());
            foreach($matiereNiveau as $mn){
                $return[$mn->getIdNiveau()]['niveau'] = $mn->getNiveau()->toArray();
                $return[$mn->getIdNiveau()]['matiere'][] = $mn->getMatiere()->toArray();
            }
            echo json_encode($return);
            break;
    }
}