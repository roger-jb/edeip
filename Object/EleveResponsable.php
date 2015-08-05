<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:34
 */
class EleveResponsable {
	protected $idEleve;
	protected $idResponsable;

	public static function getAll(){
		$query = "SELECT * FROM ELEVE_RESPONSABLE";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('EleveResponsable')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idEleveResponsable){
		$query = "SELECT * FROM ELEVE_RESPONSABLE WHERE idEleveResponsable = $idEleveResponsable";
		$result = db_connect::query($query);
		$return = new EleveResponsable();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('EleveResponsable');
		}
		$result->close();
		return $return;
	}

	public function getEleve(){
		return Eleve::getById($this->getIdEleve());
	}

	public function getResponsable(){
		return Responsable::getById($this->getIdResponsable());
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
	public function getIdResponsable () {
		return $this->idResponsable;
	}

	/**
	 * @param mixed $idResponsable
	 */
	public function setIdResponsable ($idResponsable) {
		$this->idResponsable = $idResponsable;
	}

	public function insert(){
		$query = "INSERT INTO ELEVE_RESPONSABLE (idEleve, idResponsable) VALUES ".
			$this->getIdEleve()."', ".
			$this->getIdResponsable().")";
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function update(){
		//non implemnter car table de jointure
		return false;
	}

	public function delete(){
		$query = "DELETE FROM ELEVE_RESPONSABLE WHERE ".
			"idEleve = ".$this->getIdEleve()." AND ".
			"idResponsable = ".$this->getIdResponsable();
		if (db_connect::query($query))
			return true;
		return false;
	}
}