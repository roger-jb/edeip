<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/05/2016
 * Time: 22:26
 */

header('content-type: text/html; charset=utf-8');
require_once('../Require/Objects.php');

if (isset($_GET['action']) && !empty($_GET['action'])){
    switch ($_GET['action']){
        case "getEleves" :
            $idResponsable = $_GET['idResponsable'];
            $leResponsable = Responsable::getById($idResponsable);

            $lesEleves = $leResponsable->getEleves();
            $retour = array();
            foreach ($lesEleves as $eleve){
                $retour[] = $eleve->toArray();
            }
            echo preg_replace('/u([\da-fA-F]{4})/', '&#x\1;', str_replace('\u','u',json_encode($retour)));
            break;
    }
}