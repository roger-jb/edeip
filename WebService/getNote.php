<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 01/12/2015
 * Time: 14:37
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByEleveEvaluation' :
			$note = Note::getById($_GET['idEleve'], $_GET['idEval']);
			$return = array();
			$return['note'] = '';
			if($note->getIdEleve() != ''){
				echo json_encode($note->toArray());
			}
			else
				echo json_encode($return);
			break;
	}
}