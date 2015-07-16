<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:30
 */

class AdministrateurDTO extends UtilisateurDTO{

		/**
	 * @return mixed
	 */
	public function getIdAdministrateur () {
		return $this->getIdUtilisateur();
	}

	/**
	 * @param mixed $idAdministrateur
	 */
	public function setIdAdministrateur ($idAdministrateur) {
		$this->setIdUtilisateur($idAdministrateur);
	}


}