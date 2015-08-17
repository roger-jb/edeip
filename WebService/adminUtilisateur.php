<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/08/2015
 * Time: 16:28
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
switch ($_POST['action']) {
    case 'getUtilisateurById' :
        $utilisateur = Utilisateur::getById($_POST['idUtilisateur']);
        echo json_encode($utilisateur->toArray());
        break;
    case 'getFonctionUtiisateur':
        $utilisateur = Utilisateur::getById($_POST['idUtilisateur']);
        $return = array();
        $return['niveau'] = '';
        if ($utilisateur->estAdministrateur())
            $return['administrateur'] = 'TRUE';
        else
            $return['administrateur'] = 'FALSE';

        if ($utilisateur->estProfesseur())
            $return['professeur'] = 'TRUE';
        else
            $return['professeur'] = 'FALSE';

        if ($utilisateur->estResponsable())
            $return['responsable'] = 'TRUE';
        else
            $return['responsable'] = 'FALSE';

        if ($utilisateur->estEleve()){
            $return['eleve']='TRUE';
            $eleve = Eleve::getById($utilisateur->getIdUtilisateur());
            $return['niveau']=$eleve->getIdNiveau();
        }
        else
            $return['eleve']='FALSE';
        echo json_encode($return);
        break;
}
