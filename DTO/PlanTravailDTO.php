<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:32
 */

class PlanTravailDTO {
	protected $idPlanTravail;
	protected $libellePlanTravail;
	protected $idMatiereNiveau;
	protected $idPeriode;

	/**
	 * @return mixed
	 */
	public function getIdPlanTravail () {
		return $this->idPlanTravail;
	}

	/**
	 * @param mixed $idPlanTravail
	 */
	public function setIdPlanTravail ($idPlanTravail) {
		$this->idPlanTravail = $idPlanTravail;
	}

	/**
	 * @return mixed
	 */
	public function getLibellePlanTravail () {
		return $this->libellePlanTravail;
	}

	/**
	 * @param mixed $libellePlanTravail
	 */
	public function setLibellePlanTravail ($libellePlanTravail) {
		$this->libellePlanTravail = $libellePlanTravail;
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
	public function getIdPeriode () {
		return $this->idPeriode;
	}

	/**
	 * @param mixed $idPeriode
	 */
	public function setIdPeriode ($idPeriode) {
		$this->idPeriode = $idPeriode;
	}


}