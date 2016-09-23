<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/05/2016
 * Time: 17:32
 */

header('content-type: text/html; charset=utf-8');
require_once('../Require/Objects.php');

if (isset($_GET['id']) && !empty($_GET['id'])){
	$unUtilisateur = Utilisateur::getById($_GET['id']);
	echo preg_replace('/u([\da-fA-F]{4})/', '&#x\1;', str_replace('\u','u',json_encode($unUtilisateur->toArray())));
}
