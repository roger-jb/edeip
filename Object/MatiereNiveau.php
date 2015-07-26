<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:39
 */
class MatiereNiveau {
	protected $idMatiereNiveau;
	protected $idMatiere;
	protected $idNiveau;

	public static function getAll(){
		$query = "SELECT * FROM MATIERE_NIVEAU";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while ($info = $result->fetch_object('MatiereNiveau')){
			$return[] = $info;
		}
		return $return;
	}

	public static function getById($idMatiereNiveau){
		$query = "SELECT * FROM MATIERE NIVEAU WHERE idMatiereNiveau = $idMatiereNiveau";
		$result = db_connect::getInstance()->query($query);
		$return = new MatiereNiveau();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('MatiereNiveau');
		}
		return $return;
	}

	public function getMatiere(){
		return Matiere::getById($this->getIdMatiere());
	}

	public function getNiveau(){
		return Niveau::getById($this->getIdNiveau());
	}

	/**
	 * @return mixed
	 */
	public function getIdMatiereNiveau () {
		return $this->idMatiereNiveau;
	}

	/**
	 * @param mixed $idMatiereNiveau
	 */
	public function setIdMatiereNiveau ($idMatiereNiveau) {
		$this->idMatiereNiveau = $idMatiereNiveau;
	}

	/**
	 * @return mixed
	 */
	public function getIdMatiere () {
		return $this->idMatiere;
	}

	/**
	 * @param mixed $idMatiere
	 */
	public function setIdMatiere ($idMatiere) {
		$this->idMatiere = $idMatiere;
	}

	/**
	 * @return mixed
	 */
	public function getIdNiveau () {
		return $this->idNiveau;
	}

	/**
	 * @param mixed $idNiveau
	 */
	public function setIdNiveau ($idNiveau) {
		$this->idNiveau = $idNiveau;
	}


}