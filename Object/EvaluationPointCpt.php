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

	public static function getAll(){
		$query = "SELECT * FROM EVALUATION_POINT_CPT";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while ($info = $result->fetch_object('EvaluationPointCpt')){
			$return [] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idEvaluationPointCpt){
		$query = "SELECT * FROM EVALUATION_POINT_CPT WHERE idEvaluationPointCpt = $idEvaluationPointCpt";
		$result = db_connect::getInstance()->query($query);
		$return = new EvaluationPointCpt();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('EvaluationPointCpt');
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


}