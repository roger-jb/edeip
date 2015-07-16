<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:30
 */

class TrimestreDTO {
	protected $idTrimestre;
	protected $libelleTrimestre;
	protected $dateDebutTrimeste;
	protected $dateFinTrimestre;
	protected $dateFinCommentaire;

	/**
	 * @return mixed
	 */
	public function getIdTrimestre () {
		return $this->idTrimestre;
	}

	/**
	 * @param mixed $idTrimestre
	 */
	public function setIdTrimestre ($idTrimestre) {
		$this->idTrimestre = $idTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleTrimestre () {
		return $this->libelleTrimestre;
	}

	/**
	 * @param mixed $libelleTrimestre
	 */
	public function setLibelleTrimestre ($libelleTrimestre) {
		$this->libelleTrimestre = $libelleTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getDateDebutTrimeste () {
		return $this->dateDebutTrimeste;
	}

	/**
	 * @param mixed $dateDebutTrimeste
	 */
	public function setDateDebutTrimeste ($dateDebutTrimeste) {
		$this->dateDebutTrimeste = $dateDebutTrimeste;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinTrimestre () {
		return $this->dateFinTrimestre;
	}

	/**
	 * @param mixed $dateFinTrimestre
	 */
	public function setDateFinTrimestre ($dateFinTrimestre) {
		$this->dateFinTrimestre = $dateFinTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinCommentaire () {
		return $this->dateFinCommentaire;
	}

	/**
	 * @param mixed $dateFinCommentaire
	 */
	public function setDateFinCommentaire ($dateFinCommentaire) {
		$this->dateFinCommentaire = $dateFinCommentaire;
	}


}