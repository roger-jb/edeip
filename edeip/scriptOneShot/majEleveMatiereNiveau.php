<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 26/10/2015
 * Time: 21:31
 */


require_once('../Require/Objects.php');

$query = "	select idEleve, mn.idMatiereNiveau
			from ELEVE e, MATIERE_NIVEAU mn
			WHERE e.idNiveau = mn.idMatiere
			ORDER BY idMatiereNiveau asc";
$result = db_connect::query($query);
$return = array();
while ($info = $result->fetch_object('EleveMatiereNiveau')){
	echo '<pre>';
	var_dump($info);
	echo '</pre>';
	$info->insert();
}
$result->close();
db_connect::close();