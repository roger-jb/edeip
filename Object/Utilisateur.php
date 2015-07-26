<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/07/2015
 * Time: 10:38
 */

/*
 * TODO
 *
 * getCarnetLiaison
 * getCommunication
 * getAbsence
 * getCahierTexte
 *
 */

require_once('/include/db_connect.php');
require_once('/Object/Administrateur.php');
require_once('/Object/Eleve.php');
require_once('/Object/Professeur.php');
require_once('/Object/Responsable.php');


class Utilisateur {
	protected $idUtilisateur;
	protected $nomUtilisateur;
	protected $prenomUtilisateur;
	protected $adr1Utilisateur;
	protected $adr2Utilisateur;
	protected $cpUtilisateur;
	protected $villeUtilisateur;
	protected $actifUtilisateur;
	protected $mailUtilisateur;
	protected $dateNaissanceUtilisateur;
	protected $dateInscriptionUtilisateur;


	public function estAdministrateur(){
		$query = "SELECT * FROM ADMINISTRATEUR WHERE idAdministrateur = ".$this->idUtilisateur;
		$result = db_connect::getInstance()->query($query);
		if ($result->num_rows ==1){
			$result->close();
			return true;
		}
		$result->close();
		return false;
	}

	public function estEleve(){
		$query = "SELECT * FROM ELEVE WHERE idEleve = ".$this->idUtilisateur;
		$result = db_connect::getInstance()->query($query);
		if ($result->num_rows ==1){
			$result->close();
			return true;
		}
		$result->close();
		return false;
	}

	public function estProfesseur(){
		$query = "SELECT * FROM PROFESSEUR WHERE idProfesseur = ".$this->idUtilisateur;
		$result = db_connect::getInstance()->query($query);
		if ($result->num_rows ==1){
			$result->close();
			return true;
		}
		$result->close();
		return false;
	}

	public function estResponsable(){
		$query = "SELECT * FROM RESPONSABLE WHERE idResponsable = ".$this->idUtilisateur;
		$result = db_connect::getInstance()->query($query);
		if ($result->num_rows ==1){
			$result->close();
			return true;
		}
		$result->close();
		return false;
	}

	public static function getById ($id) {
		if (!is_numeric($id)) {
			return new Utilisateur();
		}
		$query = "SELECT * FROM UTILISATEUR WHERE idUtilisateur = $id";

		$result = db_connect::getInstance()->query($query);

		if ($result->num_rows == 1) {
			$test = $result->fetch_object('Utilisateur');
			$result->close();
			return $test;
		}
		else {
			$result->close();
			return new Utilisateur();
		}
	}

	public static function getAll () {
		$query = "SELECT * FROM UTILISATEUR";
		$result = db_connect::getInstance()->query($query);
		$return = array ();
		while ($info = $result->fetch_object('Utilisateur')) {
			$return[] = $info;
		}
		return $return;
	}

	public static function getAllActif () {
		$query = "SELECT * FROM UTILISATEUR WHERE actifUtilisateur = 1";
		$result = db_connect::getInstance()->query($query);
		$return = array ();
		while ($info = $result->fetch_object('Utilisateur')) {
			$return[] = $info;
		}
		return $return;
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
	public function getNomUtilisateur () {
		return $this->nomUtilisateur;
	}

	/**
	 * @param mixed $nomUtilisateur
	 */
	public function setNomUtilisateur ($nomUtilisateur) {
		$this->nomUtilisateur = $nomUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getPrenomUtilisateur () {
		return $this->prenomUtilisateur;
	}

	/**
	 * @param mixed $prenomUtilisateur
	 */
	public function setPrenomUtilisateur ($prenomUtilisateur) {
		$this->prenomUtilisateur = $prenomUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getAdr1Utilisateur () {
		return $this->adr1Utilisateur;
	}

	/**
	 * @param mixed $adr1Utilisateur
	 */
	public function setAdr1Utilisateur ($adr1Utilisateur) {
		$this->adr1Utilisateur = $adr1Utilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getAdr2Utilisateur () {
		return $this->adr2Utilisateur;
	}

	/**
	 * @param mixed $adr2Utilisateur
	 */
	public function setAdr2Utilisateur ($adr2Utilisateur) {
		$this->adr2Utilisateur = $adr2Utilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getCpUtilisateur () {
		return $this->cpUtilisateur;
	}

	/**
	 * @param mixed $cpUtilisateur
	 */
	public function setCpUtilisateur ($cpUtilisateur) {
		$this->cpUtilisateur = $cpUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getVilleUtilisateur () {
		return $this->villeUtilisateur;
	}

	/**
	 * @param mixed $villeUtilisateur
	 */
	public function setVilleUtilisateur ($villeUtilisateur) {
		$this->villeUtilisateur = $villeUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getActifUtilisateur () {
		return $this->actifUtilisateur;
	}

	/**
	 * @param mixed $actifUtilisateur
	 */
	public function setActifUtilisateur ($actifUtilisateur) {
		$this->actifUtilisateur = $actifUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getMailUtilisateur () {
		return $this->mailUtilisateur;
	}

	/**
	 * @param mixed $mailUtilisateur
	 */
	public function setMailUtilisateur ($mailUtilisateur) {
		$this->mailUtilisateur = $mailUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getDateNaissanceUtilisateur () {
		return $this->dateNaissanceUtilisateur;
	}

	/**
	 * @param mixed $dateNaissanceUtilisateur
	 */
	public function setDateNaissanceUtilisateur ($dateNaissanceUtilisateur) {
		$this->dateNaissanceUtilisateur = $dateNaissanceUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getDateInscriptionUtilisateur () {
		return $this->dateInscriptionUtilisateur;
	}

	/**
	 * @param mixed $dateInscriptionUtilisateur
	 */
	public function setDateInscriptionUtilisateur ($dateInscriptionUtilisateur) {
		$this->dateInscriptionUtilisateur = $dateInscriptionUtilisateur;
	}
}