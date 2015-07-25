<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:34
 */
class EleveResponsableDTO {
	protected $idEleve;
	protected $idResponsable;

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
	public function getIdResponsable () {
		return $this->idResponsable;
	}

	/**
	 * @param mixed $idResponsable
	 */
	public function setIdResponsable ($idResponsable) {
		$this->idResponsable = $idResponsable;
	}

}