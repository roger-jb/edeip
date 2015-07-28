<?php
//en dev ==> localhost
$__ENV = 'dev';

if (substr($_SERVER['SERVER_ADDR'], 0, 3) == '192' || substr($_SERVER['SERVER_ADDR'], 0, 3) == '127') {
    $__DB_SRV = '192.168.10.4';
} else {
    $__DB_SRV = 'roger-leoen.ddns.net';
}
$__DB_NAME = 'EDEIP';
$__DB_USER = 'EDEIP';
$__DB_MDP = 'xpN7z7xX';

