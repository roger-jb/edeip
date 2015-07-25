<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:36
 */
class NiveauDTO {
	protected $idNiveau;
	protected $libelleNiveau;
	protected $idModule;

	/**
	 * @return mixed
	 */
	public function getIdNiveau () {
		return $this->idNiveau;
	}

	/**
	 * @param mixed $idNiveau
	 */
	public function setIdNiveau ($idNiveau) {
		$this->idNiveau = $idNiveau;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleNiveau () {
		return $this->libelleNiveau;
	}

	/**
	 * @param mixed $libelleNiveau
	 */
	public function setLibelleNiveau ($libelleNiveau) {
		$this->libelleNiveau = $libelleNiveau;
	}

	/**
	 * @return mixed
	 */
	public function getIdModule () {
		return $this->idModule;
	}

	/**
	 * @param mixed $idModule
	 */
	public function setIdModule ($idModule) {
		$this->idModule = $idModule;
	}


}