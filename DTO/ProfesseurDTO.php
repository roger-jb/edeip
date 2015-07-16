<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:42
 */

class ProfesseurDTO extends UtilisateurDTO{

	/**
	 * @return mixed
	 */
	public function getIdPrfesseur () {
		return $this->getIdUtilisateur();
	}

	/**
	 * @param mixed $idPrfesseur
	 */
	public function setIdPrfesseur ($idPrfesseur) {
		$this->setIdUtilisateur($idPrfesseur);
	}

}