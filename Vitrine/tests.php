<?php
require_once('../Require/Objects.php');

echo '<pre>';
$array = get_class_methods(new mysqli());
sort($array);
var_dump($array);
die;