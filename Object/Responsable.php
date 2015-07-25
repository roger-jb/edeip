<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:43
 */

require_once('/Object/Utilisateur.php');

class Responsable extends Utilisateur {

	public function getEleves(){
		$query = "SELECT * FROM ELEVE_RESPONSABLE WHERE idResponsable = " . $this->getIdResponsable();
		$result = db_connect::getInstance()->query($query);
		if ($result->num_rows > 0) {
			$return = array ();
			while ($info = $result->fetch_assoc()) {
				$return[] = Eleve::getById($info['idEleve']);
			}
			return $return;
		}
		else
			return NULL;
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
}