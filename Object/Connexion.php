<?php

require_once('../include/db_connect.php');
require_once('../Object/Utilisateur.php');
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:27
 */
class Connexion {
	protected $idUtilisateur = 0;
	protected $loginUtilisateur;
	protected $mdpUtilisateur;

	public function getUtilisateur(){
		return Utilisateur::getById($this->idUtilisateur);
	}

	/**
	 * @return mixed
	 */
	public function getIdUtilisateur () {
		return $this->idUtilisateur;
	}

	/**
	 * @param mixed $idUtilisateur
	 */
	public function setIdUtilisateur ($idUtilisateur) {
		$this->idUtilisateur = $idUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getLoginUtilisateur () {
		return $this->loginUtilisateur;
	}

	/**
	 * @param mixed $loginUtilisateur
	 */
	public function setLoginUtilisateur ($loginUtilisateur) {
		$this->loginUtilisateur = $loginUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getMdpUtilisateur () {
		return $this->mdpUtilisateur;
	}

	/**
	 * @param mixed $mdpUtilisateur
	 */
	public function setMdpUtilisateur ($mdpUtilisateur) {
		$this->mdpUtilisateur = $this->hashMdp($mdpUtilisateur);
	}

	static public function hashMdp ($mdp) {
		return hash("sha256", $mdp);
	}

	public function update () {
		$db_login = db_connect::escape_string($this->getLoginUtilisateur());
		$db_mdp = db_connect::escape_string($this->getMdpUtilisateur());
		$query = "UPDATE CONNEXION SET ".
			"loginUtilisateur = '$db_login', mdptilisateur = '$db_mdp' ".
			"WHERE idUtilisateur = ".$this->getIdUtilisateur();
		if (db_connect::query($query))
			return true;
		return false;
	}

	// non implementé car gérée par le trigger trg_utilisaeur_after_insert
	public function insert(){
		return false;
	}

	public function delete(){
		$query = "DELETE FROM CONNEXION WHERE idUtilisateur = ".$this->getIdUtilisateur();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public static function connecter($login, $mdp){
		$connexion = new Connexion();
		$connexion->setLoginUtilisateur($login);
		$connexion->setMdpUtilisateur($mdp);

		$query =    " SELECT c.* FROM CONNEXION c, UTILISATEUR u ".
					" WHERE c.loginUtilisateur = '".db_connect::escape_string($connexion->getLoginUtilisateur())."' ".
					" AND c.mdpUtilisateur = '".$connexion->getMdpUtilisateur()."' ".
					" AND c.idUtilisateur = u.idUtilisateur ".
					" AND u.actifUtilisateur = 1 ";
		$result = db_connect::getInstance()->query($query);

		if ($result->num_rows != 1){
			return new connexion;
		}
		else{
			return $result->fetch_object('Connexion');
		}
	}
}