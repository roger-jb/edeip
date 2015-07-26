<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:42
 */

require_once('/Object/Utilisateur.php');

class Professeur extends Utilisateur {

	public static function getAll () {
		$parents = parent::getAll();
		$return = array ();
		foreach ($parents as $parent) {
			$return[] = Professeur::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getAllActif () {
		$parents = parent::getAllActif();
		$return = array ();
		foreach ($parents as $parent) {
			$return[] = Professeur::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getById($idProfesseur){
		$parent = parent::getById($idProfesseur);
		$prof = new Professeur();

		foreach ($parent as $attr => $value){
			$prof->{'set'.$attr}($value);
		}

		return $prof;
	}

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