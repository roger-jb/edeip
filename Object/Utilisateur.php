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

require_once('../include/db_connect.php');
require_once('../Object/Administrateur.php');
require_once('../Object/Eleve.php');
require_once('../Object/Professeur.php');
require_once('../Object/Responsable.php');


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
			$return = $result->fetch_object('Utilisateur');
			$result->close();
			return $return;
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

	public function insert(){
		$query = "INSERT INTO UTILISATEUR (nomUtilisateur, prenomUtilisateur, adr1Utilisateur, adr2Utilisateur, cpUtilisateur, villeUtilisateur, actifUtilisateur, mailUtilisateur, dateNaissanceUtilisateur, dateInscriptionUtilisateur) VALUES (".
			"'".db_connect::escape_string($this->getNomUtilisateur())."', ".
			"'".db_connect::escape_string($this->getPrenomUtilisateur())."', ".
			"'".db_connect::escape_string($this->getAdr1Utilisateur())."', ".
			"'".db_connect::escape_string($this->getAdr2Utilisateur())."', ".
			"'".db_connect::escape_string($this->getCpUtilisateur())."', ".
			"'".db_connect::escape_string($this->getVilleUtilisateur())."', ".
			($this->getActifUtilisateur()?'true':'false').", ".
			"'".db_connect::escape_string($this->getMailUtilisateur()).", ".
			"'".db_connect::escape_string($this->getDateNaissanceUtilisateur())."', ".
			"'".db_connect::escape_string($this->getDateInscriptionUtilisateur())."'"
			.")";
		if (db_connect::getInstance()->query($query)){
			$query2 = "SELECT idUtulisateur FROM UTILISATEUR WHERE ".
				" AND nomUtilisateur = '".db_connect::escape_string($this->getNomUtilisateur())."', ".
				" AND prenomUtilisateur = '".db_connect::escape_string($this->getPrenomUtilisateur())."', ".
				" AND adr1Utilisateur = '".db_connect::escape_string($this->getAdr1Utilisateur())."', ".
				" AND adr2Utilisateur = '".db_connect::escape_string($this->getAdr2Utilisateur())."', ".
				" AND cpUtilisateur = '".db_connect::escape_string($this->getCpUtilisateur())."', ".
				" AND villeUtilisateur = '".db_connect::escape_string($this->getVilleUtilisateur())."', ".
				" AND actifUtilisateur = ".($this->getActifUtilisateur()?'true':'false').", ".
				" AND mailUtilisateur = '".db_connect::escape_string($this->getMailUtilisateur()).", ".
				" AND dateNaissanceUtilisateur = '".db_connect::escape_string($this->getDateNaissanceUtilisateur())."', ".
				" AND dateInscriptionUtilisateur = '".db_connect::escape_string($this->getDateInscriptionUtilisateur())."'";
			$result = db_connect::getInstance()->query($query);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdUtilisateur($info['idUtilisateur']);
				$result->close();
				return true;
			}
			$result->close();
			return false;
		}
		return false;
	}

	public function update(){
		$query = "UPDATE UTILISATEUR SET ".
			" nomUtilisateur = '".db_connect::escape_string($this->getNomUtilisateur())."', ".
			" prenomUtilisateur = '".db_connect::escape_string($this->getPrenomUtilisateur())."', ".
			" adr1Utilisateur = '".db_connect::escape_string($this->getAdr1Utilisateur())."', '".
			" adr2Utilisateur = '".db_connect::escape_string($this->getAdr2Utilisateur())."', ".
			" cpUtilisateur = '".db_connect::escape_string($this->getCpUtilisateur())."', ".
			" villeUtilisateur = '".db_connect::escape_string($this->getVilleUtilisateur())."', ".
			" actifUtilisateur = ".($this->getActifUtilisateur()?'true':'false').", ".
			" mailUtilisateur = '".db_connect::escape_string($this->getMailUtilisateur()).", ".
			" dateNaissanceUtilisateur = '".db_connect::escape_string($this->getDateNaissanceUtilisateur())."', ".
			" dateInscriptionUtilisateur = '".db_connect::escape_string($this->getDateInscriptionUtilisateur())."'".
			" WHERE idUtilisateur = ".$this->getIdUtilisateur();
		return db_connect::getInstance()->query($query);
	}

	public function delete(){
		/*$query = "DELETE FROM UTILISATEUR WHERE idUtilisateur = ".$this->getIdUtilisateur();
		return db_connect::getInstance()->query($query);*/
		$this->setActifUtilisateur(false);
		$this->update();
	}
}