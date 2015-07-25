<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:53
 */
class NiveauCptDTO {
	protected $idNiveauCpt;
	protected $libelleNiveauCpt;

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

	/**
	 * @return mixed
	 */
	public function getLibelleNiveauCpt () {
		return $this->libelleNiveauCpt;
	}

	/**
	 * @param mixed $libelleNiveauCpt
	 */
	public function setLibelleNiveauCpt ($libelleNiveauCpt) {
		$this->libelleNiveauCpt = $libelleNiveauCpt;
	}
}