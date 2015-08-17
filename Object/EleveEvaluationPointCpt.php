<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:21
 */
class EleveEvaluationPointCpt {
	protected $idEleve;
	protected $idEvalautionPointCpt;
	protected $idNiveauCpt;

	public static function getAll(){
		$query = "SELECT * FROM ELEVE_EVALUATION_POINT_CPT";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('EleveEvaluationPointCpt')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public function getById($idEleve, $idEvaluationPointCpt){
		$query = "SELECT * FROM ELEVE_EVALUATION_POINT_CPT WHERE idEleve = $idEleve AND idEvaluationPointCpt = $idEvaluationPointCpt";
		$result = db_connect::query($query);
		$return = new EleveEvaluationPointCpt();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('EleveEvaluationPointCpt');
		}
		$result->close();
		return $return;
	}

	public function getEleve(){
		return Eleve::getById($this->getIdEleve());
	}

	public function getEvaluationPointCpt(){
		return EvaluationPointCpt::getById($this->getIdEvalautionPointCpt());
	}

	public function getNiveauCpt(){
		return NiveauCpt::getById($this->getIdNiveauCpt());
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
	public function getIdEvalautionPointCpt () {
		return $this->idEvalautionPointCpt;
	}

	/**
	 * @param mixed $idEvalautionPointCpt
	 */
	public function setIdEvalautionPointCpt ($idEvalautionPointCpt) {
		$this->idEvalautionPointCpt = $idEvalautionPointCpt;
	}

	/**
	 * @return mixed
	 */
	public function getIdNiveauCpt () {
		return $this->idNiveauCpt;
	}

	/**
	 * @param mixed $idNiveauCpt
	 */
	public function setIdNiveauCpt ($idNiveauCpt) {
		$this->idNiveauCpt = $idNiveauCpt;
	}

	public function insert(){
		$query = "INSERT INTO ELEVE_EVALUATION_POINT_CPT (idEleve, idEvaluationPointCpt, idNiveauCpt) VALUES (".
			"".$this->getIdEleve().", ".
			"".$this->getIdEvalautionPointCpt().", ".
			"".(!is_null($this->getIdNiveauCpt())?$this->getIdNiveauCpt():'NULL').
			")";
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function update(){
		$query = "UPDATE ELEVE_EVALUATION_POINT_CPT SET ".
			"idNiveauCpt = ".(!is_null($this->getIdNiveauCpt())?$this->getIdNiveauCpt():'NULL')." ".
			"WHERE idEleve = ".$this->getIdEleve()." AND idEvaluationPointCpt = ".$this->getIdEvalautionPointCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM ELEVE_EVALUATION_POINT_CPT WHERE idEleve = ".$this->getIdEleve()." AND idEvaluationPointCpt = ".$this->getIdEvalautionPointCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}
}