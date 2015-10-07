<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/07/2015
 * Time: 10:37
 */
class Absence {
	protected $idAbsence;
	protected $idEleve;
	protected $dateDebutAbsence;
	protected $dateFinAbsence;
	protected $etatAbsence;
	protected $motifAbsence;
	protected $idRedacteur;
	protected $dateRedaction;

	public static function getAll () {
		$query = 'SELECT * FROM ABSENCE ORDER BY dateDebutAbsence DESC';
		$result = db_connect::query($query);

		$return = array ();
		while ($info = $result->fetch_object('Absence')) {
			$return[] = $info;
		}
		db_connect::close();
		return $return;
	}

	public static function getById ($id) {
		if (!is_numeric($id)) {
			return false;
		}

		$query = "SELECT * FROM ABSENCE WHERE idAbsence = $id ORDER BY dateDebutAbsence DESC";

		$result = db_connect::query($query);
		if ($result->num_rows ==1) {
			$return = $result->fetch_object('Absence');
			db_connect::close();
			return $return;
		}
		else {
			$result->close();
			return new Absence();
		}
	}

	public static function getAllByIdEleve ($idEleve) {
		if (!is_numeric($idEleve)) {
			return array();
		}

		$query = "SELECT * FROM ABSENCE WHERE idEleve = $idEleve ORDER BY dateDebutAbsence DESC";
		$return = array ();
		$result = db_connect::query($query);
		while ($info = $result->fetch_object('Absence')) {
			$return[] = $info;
		}
		return $return;
	}

	public function getEleve () {
		return Eleve::getById($this->idEleve);
	}

	public function getRedacteur () {
		return Utilisateur::getById($this->idRedacteur);
	}

	/**
	 * @return mixed
	 */
	public function getIdAbsence () {
		return $this->idAbsence;
	}

	/**
	 * @param mixed $idAbsence
	 */
	public function setIdAbsence ($idAbsence) {
		$this->idAbsence = $idAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getIdEleve () {
		return $this->idEleve;
	}

	/**
	 * @param mixed $idEleve
	 */
	public function setIdEleve ($idEleve) {
		$this->idEleve = $idEleve;
	}

	/**
	 * @return mixed
	 */
	public function getDateDebutAbsence () {
		return $this->dateDebutAbsence;
	}

	/**
	 * @param mixed $dateDebutAbsence
	 */
	public function setDateDebutAbsence ($dateDebutAbsence) {
		$this->dateDebutAbsence = $dateDebutAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinAbsence () {
		return $this->dateFinAbsence;
	}

	/**
	 * @param mixed $dateFinAbsence
	 */
	public function setDateFinAbsence ($dateFinAbsence) {
		$this->dateFinAbsence = $dateFinAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getEtatAbsence () {
		return $this->etatAbsence;
	}

	/**
	 * @param mixed $etatAbsence
	 */
	public function setEtatAbsence ($etatAbsence) {
		$this->etatAbsence = $etatAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getMotifAbsence () {
		return $this->motifAbsence;
	}

	/**
	 * @param mixed $motifAbsence
	 */
	public function setMotifAbsence ($motifAbsence) {
		$this->motifAbsence = $motifAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getIdRedacteur () {
		return $this->idRedacteur;
	}

	/**
	 * @param mixed $idRedacteur
	 */
	public function setIdRedacteur ($idRedacteur) {
		$this->idRedacteur = $idRedacteur;
	}

	/**
	 * @return mixed
	 */
	public function getDateRedaction () {
		return $this->dateRedaction;
	}

	/**
	 * @param mixed $dateRedaction
	 */
	public function setDateRedaction ($dateRedaction) {
		$this->dateRedaction = $dateRedaction;
	}

	public function update(){
		$query = "UPDATE ABSENCE SET ".
			" idEleve = ".$this->getIdEleve().
			", dateDebutAbsence = '".$this->getDateDebutAbsence()."' ".
			", dateFinAbsence = '".$this->getDateFinAbsence()."' ".
			", etatAbsence = ".($this->getEtatAbsence()?'TRUE':'FALSE').
			", motifAbsence = '".db_connect::escape_string($this->getMotifAbsence())."' ".
			", dateRedaction = '".$this->getDateRedaction()."' ".
			", idRedacteur = ".$this->getIdRedacteur().
			" WHERE idAbsence = ".$this->getIdAbsence();
		return db_connect::query($query);

	}

	public function insert(){
		$query = "INSERT INTO ABSENCE (idEleve, dateDebutAbsence, dateFinAbsence, etatAbsence, motifAbsence, dateRedaction, idRedacteur) VALUES (".
			$this->getIdEleve().", '".$this->getDateDebutAbsence()."', '".$this->getDateFinAbsence()."', ".
			($this->getEtatAbsence()?'TRUE':'FALSE').", '".db_connect::escape_string($this->getMotifAbsence())."', '".$this->getDateRedaction()."', ".$this->getIdRedacteur().
			")";
		if( db_connect::query($query)){
			$query2 = "SELECT * FROM ABSENCE WHERE idEleve = ".$this->getIdEleve()." AND dateDebutAbsence = '".$this->getDateDebutAbsence()."' AND dateFinAbsence = '".$this->getDateFinAbsence()."' ".
				"AND etatAbsence = ". ($this->getEtatAbsence()?'TRUE':'FALSE')." and motifAbsence = '".db_connect::escape_string($this->getMotifAbsence())."' AND dateRedaction = '".$this->getDateRedaction()."' AND idRedacteur = ".$this->getIdRedacteur();
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$return = $result->fetch_object('Absence');
				$this->setIdAbsence($return->getIdAbsence());
				return true;
			}
			return false;
		}
		return false;
	}

	public function delete(){
		$query = "DELETE FROM ABSENCE WHERE idAbsence = ".$this->getIdAbsence();
		return db_connect::query($query);
	}
}