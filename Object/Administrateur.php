<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/07/2015
 * Time: 11:05
 */

require_once('../Object/Utilisateur.php');

class Administrateur extends Utilisateur{

	public function getIdAdministrateur(){
		return $this->idUtilisateur;
	}

	public function setIdAdministrateur($idAdministrateur){
		$this->setIdUtilisateur($idAdministrateur);
	}

	public static function getAll () {
		$parents = parent::getAll();
		$return = array ();
		foreach ($parents as $parent) {
			$return[] = Administrateur::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getAllActif () {
		$parents = parent::getAllActif();
		$return = array ();
		foreach ($parents as $parent) {
			$return[] = Administrateur::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getById ($idResponsable) {
		$parent = parent::getById($idResponsable);
		$administrateur = new Administrateur();

		foreach ($parent as $attr => $value) {
			$administrateur->{'set' . $attr}($value);
		}
		return $administrateur;
	}

	public function insert(){
		if (parent::insert()){
			$query = "INSERT INTO ADMINISTRATEUR (idAdministrateur) VALUES (".$this->getIdAdministrateur().")";
			return db_connect::getInstance()->query($query);
		}
		return false;
	}
}