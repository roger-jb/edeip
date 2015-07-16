<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:38
 */

class MatiereDTO {
	protected $idMatiere;
	protected $libelleMatiere;

	/**
	 * @return mixed
	 */
	public function getIdMatiere () {
		return $this->idMatiere;
	}

	/**
	 * @param mixed $idMatiere
	 */
	public function setIdMatiere ($idMatiere) {
		$this->idMatiere = $idMatiere;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleMatiere () {
		return $this->libelleMatiere;
	}

	/**
	 * @param mixed $libelleMatiere
	 */
	public function setLibelleMatiere ($libelleMatiere) {
		$this->libelleMatiere = $libelleMatiere;
	}

}