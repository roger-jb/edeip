<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 21/07/2015
 * Time: 14:58
 */

require_once('/include/db_connect.php');
require_once('/DTO/connexionDTO.php');
require_once('/Object/Utilisateur.php');

class ConnexionDAL {
	static public function connecter ($login, $mdp) {
		$db_login = db_connect::escape_string($login);
		$db_mdp = Connexion::hashMdp($mdp);
		$query = "SELECT * FROM CONNEXION WHERE loginUtilisateur = '$login' AND mdpUtilisateur = '$mdp'";
		$result = db_connect::getInstance()->query($query);
		$return = array ();
		while ($info = $result->fetch_assoc()) {
			$return[] = Utilisateur::getById($info['idUtilisateur']);
		}

		if (count($return) == 1) {
			return $return[0];
		}
		return false;
	}
}