<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:43
 */

require_once('../Object/Utilisateur.php');

class Responsable extends Utilisateur {

	public static function getAll () {
		$parents = parent::getAll();
		$return = array ();
		foreach ($parents as $parent) {
			$return[] = Responsable::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getAllActif () {
		$parents = parent::getAllActif();
		$return = array ();
		foreach ($parents as $parent) {
			$return[] = Responsable::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getById ($idResponsable) {
		$parent = parent::getById($idResponsable);
		$responsable = new Responsable();

		foreach ($parent as $attr => $value) {
			$responsable->{'set' . $attr}($value);
		}
		return $responsable;
	}

	public function getEleves(){
		$query = "SELECT * FROM ELEVE_RESPONSABLE WHERE idResponsable = " . $this->getIdResponsable();
		$result = db_connect::getInstance()->query($query);
		$return = array ();
		if ($result->num_rows > 0) {
			while ($info = $result->fetch_assoc()) {
				$return[] = Eleve::getById($info['idEleve']);
			}
		}
		return $return;
	}

	public function setEleve($idEleve){
		$eleves = $this->getEleves();
		$exist = FALSE;
		foreach ($eleves as $eleve){
			if ($eleve->getIdEleve() == $idEleve){
				$exist = TRUE;
			}
		}
		if (!$exist){
			$query = "INSERT INTO ELEVE_RESPONSABLE (idEleve, idResponsable) VALUES ($idEleve, ".$this->getIdResponsable().")";
			db_connect::getInstance()->query($query);
		}
	}

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

	public function insert(){
		if (parent::insert()){
			$query = "INSERT INTO RESPONSABLE (idReponsable) VALUES (".
				$this->getIdResponsable()
				.")";
			return db_connect::getInstance()->query($query);
		}
		return false;
	}
}