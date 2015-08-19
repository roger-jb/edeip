<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/08/2015
 * Time: 11:35
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
switch ($_POST['action']) {
    case 'getNiveauById' :
        $niveau = Niveau::getById($_POST['idNiveau']);
        echo json_encode($niveau->toArray());
        break;

}