<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/08/2015
 * Time: 09:25
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once('../Require/Objects.php');
switch ($_POST['action']) {
    case 'getModuleById' :
        $module = Module::getById($_POST['idModule']);
        echo json_encode($module->toArray());
        break;

}
