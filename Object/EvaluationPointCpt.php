<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:22
 */
class EvaluationPointCpt {
	protected $idEvaluationPointCpt;
	protected $idEvaluation;
	protected $idPointCpt;

	public function toArray(){
		$return = array();
		$return['idEvaluationPointCpt'] = $this->getIdEvaluationPointCpt();
		$return['idEvaluation'] = $this->getIdEvaluation();
		$return['idPointCpt'] = $this->getIdPointCpt();
		if (!empty($this->getIdEvaluation()))
		$return['evaluation'] = $this->getEvaluation()->toArray();
		if (!empty($this->getIdPointCpt()))
			$return['pointCpt'] = $this->getPointCpt()->toArray();

		return $return;
	}

	public static function getAll(){
		$query = "SELECT * FROM EVALUATION_POINT_CPT";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('EvaluationPointCpt')){
			$return [] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idEvaluationPointCpt){
		$query = "SELECT * FROM EVALUATION_POINT_CPT WHERE idEvaluationPointCpt = $idEvaluationPointCpt";
		$result = db_connect::query($query);
		$return = new EvaluationPointCpt();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('EvaluationPointCpt');
		}
		$result->close();
		return $return;
	}

	public static function getByEvalPoint($idEval, $idPoint){
		$query = "SELECT * FROM EVALUATION_POINT_CPT WHERE idEvaluation = $idEval AND idPointCpt = $idPoint";
		$result = db_connect::query($query);
		$return = new EvaluationPointCpt();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('EvaluationPointCpt');
		}
		$result->close();
		return $return;
	}

	public static function getByEvaluation($idEvaluation){
		$query = "	SELECT epCpt.* FROM EVALUATION_POINT_CPT epCpt, POINT_CPT pCpt
					WHERE epCpt.idEvaluation = $idEvaluation
					AND epCpt.idPointCpt = pCpt.idPointCpt
					ORDER BY pCpt.idDomaineCpt";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('EvaluationPointCpt')){
			$return [] = $info;
		}
		$result->close();
		return $return;
	}

	public function getEvaluation(){
		return Evaluation::getById($this->getIdEvaluation());
	}

	public function getPointCpt(){
		return PointCpt::getById($this->getIdPointCpt());
	}

	/**
	 * @return mixed
	 */
	public function getIdEvaluationPointCpt () {
		return $this->idEvaluationPointCpt;
	}

	/**
	 * @param mixed $idEvaluationPointCpt
	 */
	public function setIdEvaluationPointCpt ($idEvaluationPointCpt) {
		$this->idEvaluationPointCpt = $idEvaluationPointCpt;
	}

	/**
	 * @return mixed
	 */
	public function getIdEvaluation () {
		return $this->idEvaluation;
	}

	/**
	 * @param mixed $idEvaluation
	 */
	public function setIdEvaluation ($idEvaluation) {
		$this->idEvaluation = $idEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getIdPointCpt () {
		return $this->idPointCpt;
	}

	/**
	 * @param mixed $idPointCpt
	 */
	public function setIdPointCpt ($idPointCpt) {
		$this->idPointCpt = $idPointCpt;
	}

	public function insert(){
		$query = "INSERT INTO EVALUATION_POINT_CPT (".
			"idEvaluation, idPointCpt".
			") VALUES (".
			$this->getIdEvaluation().", ".
			$this->getIdPointCpt().
			")";
		if (db_connect::query($query)){
			$query2 = "SELECT idEvaluationPointCpt FROM EVALUATION_POINT_CPT WHERE ".
				"idEvaluation = ".$this->getIdEvaluation()." AND ".
				"idPointCpt = ".$this->getIdPointCpt();
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdEvaluationPointCpt($info['idEvaluationPointCpt']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		return false;
	}

	public function delete(){
		$query = "DELETE FROM EVALUATION_POINT_CPT WHERE idEvaluationPointCpt = ".$this->getIdEvaluationPointCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}
}