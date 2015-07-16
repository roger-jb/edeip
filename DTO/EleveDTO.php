<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:45
 */

class EleveDTO extends UtilisateurDTO{
	protected $idNiveau;

	/**
	 * @return mixed
	 */
	public function getIdEleve () {
		return $this->getIdUtilisateur();
	}

	/**
	 * @param mixed $idEleve
	 */
	public function setIdEleve ($idEleve) {
		$this->setIdUtilisateur($idEleve);
	}

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
}