<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/05/2016
 * Time: 10:13
 */

header('content-type: text/html; charset=utf-8');
require_once('../Require/Objects.php');

$connexion = Connexion::getAll();

/*echo '<pre>';
var_dump($connexion);
echo "</pre>";*/

$ret = array();

foreach ($connexion as $con){
	$ret[] = $con->toArray();

}

/*echo '<pre>';
var_dump($ret);
echo "</pre>";*/

//echo json_encode($connexion);
echo preg_replace('/u([\da-fA-F]{4})/', '&#x\1;', str_replace('\u','u',json_encode($ret)));