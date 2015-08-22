<?php
//en dev ==> localhost
$__ENV = 'dev';

if (substr($_SERVER['SERVER_ADDR'], 0, 3) == '192' || substr($_SERVER['SERVER_ADDR'], 0, 3) == '127' || $_SERVER['SERVER_ADDR'] == '::1') {
    $__DB_SRV = '192.168.10.4';
} else {
    $__DB_SRV = 'roger-leoen.ddns.net';
}
$__DB_NAME = 'EDEIP';
$__DB_USER = 'EDEIP';
$__DB_MDP = 'xpN7z7xX';

/*
else {
    $bdd = "ecoleepledepl";
    $db = mysql_connect("mysql5-15.perso", "ecoleepledepl", "xpN7z7xX") or die("Impossible de se connecter � MySQL");
    mysql_select_db($bdd, $db) or die("Impossible de s�lectionner la base de donn�es");
    mysql_query("SET NAMES UTF8");
    $URLracine = "edeip-lyon.fr";
    define("DB", $db);
}
*/
