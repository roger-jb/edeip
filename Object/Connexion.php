<?php

require_once('/include/db_connect.php');
require_once('/Object/Utilisateur.php');
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:27
 */
class Connexion {
	protected $idUtilisateur;
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
		$db_login = db_connect::escape_string($this->loginUtilisateur);
		$db_mdp = db_connect::escape_string($this->mdpUtilisateur);
		$query = "UPDATE UTILISATEUR SET loginUtilisateur = '$db_login', mdpUtilisateur = '$db_mdp' WHERE idUtilisateur = " . $this->idUtilisateur;
		db_connect::getInstance()->query($query);
	}

}