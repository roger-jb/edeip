<?php


/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:19
 */
class TypeEvaluation {
	protected $idTypeEvaluation;
	protected $libelleTypeEvaluation;

	public static function getAll(){
		$query = "SELECT * FROM TYPE_EVALUATION ORDER BY libelleTypeEvaluation DESC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('TypeEvaluation')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idTypeEvaluation){
		$query = "SELECT * FROM TYPE_EVALUATION WHERE idTypeEvaluation = $idTypeEvaluation";
		$result = db_connect::query($query);
		$return = new TypeEvaluation();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('TypeEvaluation');
		}
		$result->close();
		return $return;
	}

	/**
	 * @return mixed
	 */
	public function getIdTypeEvaluation () {
		return $this->idTypeEvaluation;
	}

	/**
	 * @param mixed $idTypeEvaluation
	 */
	public function setIdTypeEvaluation ($idTypeEvaluation) {
		$this->idTypeEvaluation = $idTypeEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleTypeEvaluation () {
		return $this->libelleTypeEvaluation;
	}

	/**
	 * @param mixed $libelleTypeEvaluation
	 */
	public function setLibelleTypeEvaluation ($libelleTypeEvaluation) {
		$this->libelleTypeEvaluation = $libelleTypeEvaluation;
	}

	public function insert(){
		$query = "INSERT INTO TYPE_EVALUATION (libelleTypeEvaluation) VALUES (".
			"'".db_connect::escape_string($this->getLibelleTypeEvaluation())."'".
			")";
		if (db_connect::query($query)){
			$select = "SELECT idTypeEvaluation FROM TYPE_EVALUATION WHERE ".
				"libelleEvaluation = '".db_connect::escape_string($this->getLibelleTypeEvaluation())."'";
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdTypeEvaluation($info['idTypeEvaluation']);
				$result->close();
				return true;
			}
			// db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		$query = "UPDATE TYPE_EVALUATION SET ".
			"libelleEvaluation = '".db_connect::escape_string($this->getLibelleTypeEvaluation())."'".
			"WHERE idTypeEvaluation = ".$this->getIdTypeEvaluation();
		if (db_connect::query($query))
			return true;
		return false;
	}
	public function delete(){
		$query = "DELETE FROM TYPE_EVALUATION WHERE idTypeEvaluation = ".$this->getIdTypeEvaluation();
		if (db_connect::query($query))
			return true;
		return false;
	}
}