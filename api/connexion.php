<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/05/2016
 * Time: 12:04
 */
header('content-type: text/html; charset=utf-8');
require_once('../Require/Objects.php');

if (isset($_GET['login']) && !empty($_GET['login']) && isset($_GET['pwd']) && !empty($_GET['pwd'])){
	$utilisateur = Connexion::connecter($_GET['login'], $_GET['pwd']);
	$User = $utilisateur->getUtilisateur();


	//echo html_entity_decode(json_encode($User->toArray()));
	echo preg_replace('/u([\da-fA-F]{4})/', '&#x\1;', str_replace('\u','u',json_encode($User->toArray())));
}
if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['pwd']) && !empty($_POST['pwd'])){
	$utilisateur = Connexion::connecter($_POST['login'], $_POST['pwd']);
	$User = $utilisateur->getUtilisateur();

	/*$json = json_encode($User->toArray());
	$str     = str_replace('\u','u',json_encode($User->toArray()));
	$strJSON = preg_replace('/u([\da-fA-F]{4})/', '&#x\1;', str_replace('\u','u',json_encode($User->toArray())));*/

	//echo html_entity_decode(json_encode($User->toArray()));
	echo preg_replace('/u([\da-fA-F]{4})/', '&#x\1;', str_replace('\u','u',json_encode($User->toArray())));
}
