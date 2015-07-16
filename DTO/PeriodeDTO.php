<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:31
 */

class PeriodeDTO {
	protected $idPeriode;
	protected $libellePeriode;
	protected $dateDebutPeriode;
	protected $dateFinPeriode;
	protected $idTrimestre;

	/**
	 * @return mixed
	 */
	public function getIdPeriode () {
		return $this->idPeriode;
	}

	/**
	 * @param mixed $idPeriode
	 */
	public function setIdPeriode ($idPeriode) {
		$this->idPeriode = $idPeriode;
	}

	/**
	 * @return mixed
	 */
	public function getLibellePeriode () {
		return $this->libellePeriode;
	}

	/**
	 * @param mixed $libellePeriode
	 */
	public function setLibellePeriode ($libellePeriode) {
		$this->libellePeriode = $libellePeriode;
	}

	/**
	 * @return mixed
	 */
	public function getDateDebutPeriode () {
		return $this->dateDebutPeriode;
	}

	/**
	 * @param mixed $dateDebutPeriode
	 */
	public function setDateDebutPeriode ($dateDebutPeriode) {
		$this->dateDebutPeriode = $dateDebutPeriode;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinPeriode () {
		return $this->dateFinPeriode;
	}

	/**
	 * @param mixed $dateFinPeriode
	 */
	public function setDateFinPeriode ($dateFinPeriode) {
		$this->dateFinPeriode = $dateFinPeriode;
	}

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


}