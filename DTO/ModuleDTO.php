<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:37
 */
class ModuleDTO {
	protected $idModule;
	protected $libelleModule;

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

	/**
	 * @return mixed
	 */
	public function getLibelleModule () {
		return $this->libelleModule;
	}

	/**
	 * @param mixed $libelleModule
	 */
	public function setLibelleModule ($libelleModule) {
		$this->libelleModule = $libelleModule;
	}


}