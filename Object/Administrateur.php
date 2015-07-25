<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/07/2015
 * Time: 11:05
 */

require_once('/Object/Utilisateur.php');

class Administrateur extends Utilisateur{
	public function getIdAdministrateur(){
		return $this->idUtilisateur;
	}

	public function setIdAdministrateur($idAdministrateur){
		$this->setIdUtilisateur($idAdministrateur);
	}

	public static function getById($idAdministrateur){
		$parent = parent::getById($idAdministrateur);
		$admin = new Administrateur();

		foreach ($parent as $attr => $value){
			$admin->{'set'.$attr}($value);
		}

		return $admin;
	}
}