<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:42
 */
class DomaineCptDTO {
	protected $idDomaineCpt;
	protected $libelleDomaineCpt;
	protected $idMatiereNiveau;

	/**
	 * @return mixed
	 */
	public function getIdDomaineCpt () {
		return $this->idDomaineCpt;
	}

	/**
	 * @param mixed $idDomaineCpt
	 */
	public function setIdDomaineCpt ($idDomaineCpt) {
		$this->idDomaineCpt = $idDomaineCpt;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleDomaineCpt () {
		return $this->libelleDomaineCpt;
	}

	/**
	 * @param mixed $libelleDomaineCpt
	 */
	public function setLibelleDomaineCpt ($libelleDomaineCpt) {
		$this->libelleDomaineCpt = $libelleDomaineCpt;
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


}