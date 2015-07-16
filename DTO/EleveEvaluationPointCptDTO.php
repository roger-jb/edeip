<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:21
 */

class EleveEvaluationPointCptDTO {
	protected $idEleve;
	protected $idEvalautionPointCpt;
	protected $idNiveauCpt;

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


}