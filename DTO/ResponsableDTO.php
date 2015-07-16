<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:43
 */

class ResponsableDTO extends UtilisateurDTO{
	/**
	 * @return mixed
	 */
	public function getIdResponsable () {
		return $this->idUtilisateur;
	}

	/**
	 * @param mixed $idResponsable
	 */
	public function setIdResponsable ($idResponsable) {
		$this->idUtilisateur = $idResponsable;
	}
}