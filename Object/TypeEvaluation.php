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
		$query = "SELECT * FROM TYPE_EVALUATION";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while ($info = $result->fetch_object('TypeEvaluation')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idTypeEvaluation){
		$query = "SELECT * FROM TYPE_EVALUATION WHERE idTypeEvaluation = $idTypeEvaluation";
		$result = db_connect::getInstance()->query($query);
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


}