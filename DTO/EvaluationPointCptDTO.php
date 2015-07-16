<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:22
 */

class EvaluationPointCptDTO {
	protected $idEvaluationPointCpt;
	protected $idEvaluation;
	protected $idPointCpt;

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