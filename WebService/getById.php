<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 20/08/2015
 * Time: 10:52
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
switch ($_POST['action']) {
    case 'Matiere' :
        $matiere = Matiere::getById($_POST['idMatiere']);
        echo json_encode($matiere->toArray());
        break;
    case 'Module' :
        $module = Module::getById($_POST['idModule']);
        echo json_encode($module->toArray());
        break;
    case 'Niveau' :
        $niveau = Niveau::getById($_POST['idNiveau']);
        echo json_encode($niveau->toArray());
        break;
    case 'NiveauCpt' :
        $niveauCpt = NiveauCpt::getById($_POST['idNiveauCpt']);
        echo json_encode($niveauCpt->toArray());
        break;
    case 'Utilisateur' :
        $utilisateur = Utilisateur::getById($_POST['idUtilisateur']);
        echo json_encode($utilisateur->toArray());
        break;
}