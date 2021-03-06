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

	public function toArray(){
		$return = array();
		$return['idMatiereNiveau'] = $this->getIdMatiereNiveau();
		$return['idMatiere'] = $this->getIdMatiere();
		$return['idNiveau'] = $this->getIdNiveau();
		$return['Matiere'] = $this->getMatiere()->toArray();
		$return['Niveau'] = $this->getNiveau()->toArray();

		return $return;
	}

	public static function getAll(){
		$query = "SELECT * FROM MATIERE_NIVEAU";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('MatiereNiveau')){
			$return[] = $info;
		}
		return $return;
	}

	public static function getByNiveau($idNiveau){
		$query = "SELECT * FROM MATIERE_NIVEAU WHERE idNiveau = $idNiveau";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('MatiereNiveau')){
			$return[] = $info;
		}
		return $return;
	}

	public static function getByMatiereNiveau($idMatiere, $idNiveau){
		$query = "SELECT * FROM MATIERE_NIVEAU WHERE idMatiere = $idMatiere AND idNiveau = $idNiveau";
		$result = db_connect::query($query);
		$return = new MatiereNiveau();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('MatiereNiveau');
		}
		return $return;
	}

	public static function getById($idMatiereNiveau){
		$query = "SELECT * FROM MATIERE_NIVEAU WHERE idMatiereNiveau = $idMatiereNiveau";
		$result = db_connect::query($query);
		$return = new MatiereNiveau();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('MatiereNiveau');
		}
		return $return;
	}

	public static function getFollowingByEleve($idEleve){
		$query = "	SELECT MN.* FROM MATIERE_NIVEAU MN, ELEVE_MATIERE_NIVEAU EMN
					WHERE MN.idMatiereNiveau = EMN.idMatiereNiveau
					AND EMN.idEleve = $idEleve";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('MatiereNiveau')){
			$return[] = $info;
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

	public function insert(){
		$query = "INSERT INTO MATIERE_NIVEAU (idMatiere, idNiveau) VALUES (".
			$this->getIdMatiere().", ".
			$this->getIdNiveau().
			")";
		if (db_connect::query($query)){
			$select = "SELECT idMatiereNiveau FROM MATIERE_NIVEAU WHERE ".
				"idMatiere = ".$this->getIdMatiere()." AND ".
				"idNiveau = ".$this->getIdNiveau();
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdMatiereNiveau($info['idMatiereNiveau']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		$query = "UPDATE MATIERE_NIVEAU SET ".
			"idMatiere = ".$this->getIdMatiere()." AND ".
			"idNiveau = ".$this->getIdNiveau()." ".
			"WHERE idMatiereNiveau = ".$this->getIdMatiereNiveau();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM MATIERE_NIVEAU WHERE idMatiereNiveau = ".$this->getIdMatiereNiveau();
		if (db_connect::query($query))
			return true;
		return false;
	}
}