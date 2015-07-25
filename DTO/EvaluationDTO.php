<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:14
 */
class EvaluationDTO {
	protected $idEvaluaton;
	protected $idTypeEvaluation;
	protected $idMatiereNiveau;
	protected $dateEvaluation;
	protected $titreEvaluation;
	protected $autreEvaluation;
	protected $maxEvaluation;

	/**
	 * @return mixed
	 */
	public function getIdEvaluaton () {
		return $this->idEvaluaton;
	}

	/**
	 * @param mixed $idEvaluaton
	 */
	public function setIdEvaluaton ($idEvaluaton) {
		$this->idEvaluaton = $idEvaluaton;
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
	public function getDateEvaluation () {
		return $this->dateEvaluation;
	}

	/**
	 * @param mixed $dateEvaluation
	 */
	public function setDateEvaluation ($dateEvaluation) {
		$this->dateEvaluation = $dateEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getTitreEvaluation () {
		return $this->titreEvaluation;
	}

	/**
	 * @param mixed $titreEvaluation
	 */
	public function setTitreEvaluation ($titreEvaluation) {
		$this->titreEvaluation = $titreEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getAutreEvaluation () {
		return $this->autreEvaluation;
	}

	/**
	 * @param mixed $autreEvaluation
	 */
	public function setAutreEvaluation ($autreEvaluation) {
		$this->autreEvaluation = $autreEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getMaxEvaluation () {
		return $this->maxEvaluation;
	}

	/**
	 * @param mixed $maxEvaluation
	 */
	public function setMaxEvaluation ($maxEvaluation) {
		$this->maxEvaluation = $maxEvaluation;
	}


}