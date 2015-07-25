<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:19
 */
class TypeEvaluationDTO {
	protected $idTypeEvaluation;
	protected $libelleTypeEvaluation;

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