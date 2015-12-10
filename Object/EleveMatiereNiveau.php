<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:35
 */
class EleveMatiereNiveau {
	protected $idEleve;
	protected $idMatiereNiveau;

	public static function getAll () {
		$query = "SELECT * FROM ELEVE_MATIERE_NIVEAU";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('EleveMatiereNiveau')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getyId ($idEleve, $idMatiereNiveau) {
		$query = "SELECT * FROM ELEVE_MATIERE_NIVEAU WHERE idEleve = $idEleve AND idMatiereNiveau =  $idMatiereNiveau";
		$result = db_connect::query($query);
		$return = new EleveMatiereNiveau();
		if ($result->num_rows == 1) {
			$return = $result->fetch_object('EleveMatiereNiveau');
		}
		$result->close();
		return $return;
	}

	/**
	 * @return mixed
	 */
	public function getIdEleve () {
		return $this->idEleve;
	}

	/**
	 * @param mixed $idEleve
	 */
	public function setIdEleve ($idEleve) {
		$this->idEleve = $idEleve;
	}

	/**
	 * @return mixed
	 */
	public function getIdMatiereNiveau () {
		return $this->idMatiereNiveau;
	}

	/**
	 * @param mixed $idMatiereNiveau
	 */
	public function setIdMatiereNiveau ($idMatiereNiveau) {
		$this->idMatiereNiveau = $idMatiereNiveau;
	}

	public function insert () {
		$query = "INSERT INTO ELEVE_MATIERE_NIVEAU (idEleve, idMatiereNiveau) VALUES (" .
			$this->getIdEleve() . ", " .
			$this->getIdMatiereNiveau() . ")";
		return db_connect::query($query);
	}

	public function update () {
		//non implémenter car table de jointure
		// potentiellement faire delete puis insert ...
		return false;
	}

	public function delete () {
		$query = "DELETE FROM ELEVE_MATIERE_NIVEAU WHERE idEleve = " . $this->getIdEleve() ." AND idMatiereNiveau = ".$this->getIdMatiereNiveau();
		if (db_connect::query($query)) return true;
		return false;
	}
}