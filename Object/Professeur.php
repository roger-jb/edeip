<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:42
 */

class Professeur extends Utilisateur {

	public static function getAll () {
		$parents = parent::getAll();
		$return = array ();
		foreach ($parents as $parent) {
			if ($parent->estProfesseur())
				$return[] = Professeur::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getAllActif () {
		$parents = parent::getAllActif();
		$return = array ();
		foreach ($parents as $parent) {
			if ($parent->estProfesseur())
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
	public function getIdProfesseur () {
		return $this->getIdUtilisateur();
	}

	/**
	 * @param mixed $idPrfesseur
	 */
	public function setIdProfesseur ($idProfesseur) {
		$this->setIdUtilisateur($idProfesseur);
	}

	public function insert(){
		if (parent::insert()){
			$query = "INSERT INTO PROFESSEUR (idProfesseur) VALUES (".
				$this->getIdProfesseur().
				")";
			return db_connect::query($query);
		}
		return false;
	}

    public function insertOnly(){
        $query = "INSERT INTO PROFESSEUR (idProfesseur) VALUES (".
            $this->getIdProfesseur().
            ")";
        return db_connect::query($query);
    }
}