<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:59
 */
class PointCptEleveDTO {
	protected $idPointCpt;
	protected $idEleve;
	protected $idNiveauCpt;

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