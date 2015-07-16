<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:27
 */

class ConnexionDTO {
	protected $idUtilisateur;
	protected $loginUtilisateur;
	protected $mdpUtilisateur;

	function __construct () {
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
		$this->mdpUtilisateur = $mdpUtilisateur;
	}
}