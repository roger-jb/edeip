<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 07/10/2015
 * Time: 21:42
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
if (isset ($_GET['action'])) {
	switch ($_GET['action']) {
		case 'getByDomaineCpt' :
			$pointsCpt = PointCpt::getByDomaineCpt($_GET['idDomaineCpt']);
			$return = array ();
			foreach ($pointsCpt as $point) {
				$return[] = $point->toArray();
			}
			echo json_encode($return);
			break;
	}
}