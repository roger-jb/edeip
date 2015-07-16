<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:57
 */

class PointCptDTO {
	protected $idPointCpt;
	protected $libellePointCpt;
	protected $idDomaineCpt;

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

	/**
	 * @return mixed
	 */
	public function getLibellePointCpt () {
		return $this->libellePointCpt;
	}

	/**
	 * @param mixed $libellePointCpt
	 */
	public function setLibellePointCpt ($libellePointCpt) {
		$this->libellePointCpt = $libellePointCpt;
	}

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


}