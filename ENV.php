<?php
require_once '../ENVIRONNEMENT.php';

if (!$ENV) {
//en prod
	$__DB_SRV = 'ecoleepledepl.mysql.db';
	$__DB_NAME = 'ecoleepledepl';
	$__DB_USER = 'ecoleepledepl';
	$__DB_MDP = 'xpN7z7xX';
}
else {
	$__DB_NAME = 'EDEIP';
	$__DB_USER = 'EDEIP';
	$__DB_MDP = 'xpN7z7xX';
	if ($ENV == 'dev')
		$__DB_SRV = 'roger-leoen.ddns.net';
	elseif ($ENV == 'dev_local')
		$__DB_SRV = '192.168.10.4';
}
