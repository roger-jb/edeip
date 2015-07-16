<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:56
 */

class AbsenceDTO {
	protected $idAbsence;
	protected $idEleve;
	protected $dateDebutAbsence;
	protected $dateFinAbsence;
	protected $etatAbsence;
	protected $motifAbsence;
	protected $idRedacteur;
	protected $dateRedaction;

	/**
	 * @return mixed
	 */
	public function getIdAbsence () {
		return $this->idAbsence;
	}

	/**
	 * @param mixed $idAbsence
	 */
	public function setIdAbsence ($idAbsence) {
		$this->idAbsence = $idAbsence;
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
	public function getDateDebutAbsence () {
		return $this->dateDebutAbsence;
	}

	/**
	 * @param mixed $dateDebutAbsence
	 */
	public function setDateDebutAbsence ($dateDebutAbsence) {
		$this->dateDebutAbsence = $dateDebutAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinAbsence () {
		return $this->dateFinAbsence;
	}

	/**
	 * @param mixed $dateFinAbsence
	 */
	public function setDateFinAbsence ($dateFinAbsence) {
		$this->dateFinAbsence = $dateFinAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getEtatAbsence () {
		return $this->etatAbsence;
	}

	/**
	 * @param mixed $etatAbsence
	 */
	public function setEtatAbsence ($etatAbsence) {
		$this->etatAbsence = $etatAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getMotifAbsence () {
		return $this->motifAbsence;
	}

	/**
	 * @param mixed $motifAbsence
	 */
	public function setMotifAbsence ($motifAbsence) {
		$this->motifAbsence = $motifAbsence;
	}

	/**
	 * @return mixed
	 */
	public function getIdRedacteur () {
		return $this->idRedacteur;
	}

	/**
	 * @param mixed $idRedacteur
	 */
	public function setIdRedacteur ($idRedacteur) {
		$this->idRedacteur = $idRedacteur;
	}

	/**
	 * @return mixed
	 */
	public function getDateRedaction () {
		return $this->dateRedaction;
	}

	/**
	 * @param mixed $dateRedaction
	 */
	public function setDateRedaction ($dateRedaction) {
		$this->dateRedaction = $dateRedaction;
	}


}