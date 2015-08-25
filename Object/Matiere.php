<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:38
 */
class Matiere {
	protected $idMatiere;
	protected $libelleMatiere;

	public function toArray () {
		$return = array ();
		$return['idMatiere'] = $this->getIdMatiere();
		$return['libelleMatiere'] = $this->getLibelleMatiere();
		return $return;
	}

	public static function getAll () {
		$query = "SELECT * FROM MATIERE ORDER BY libelleMatiere ASC";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('Matiere')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getByNiveauProfesseur ($idNiveau, $idProfesseur) {
		$query = "SELECT M.* FROM MATIERE M, PROFESSEUR_MATIERE_NIVEAU PMN, MATIERE_NIVEAU MN
					WHERE M.idMatiere = MN.idMatiere
					AND MN.idMatiereNiveau = PMN.idMatiereNiveau
					AND PMN.idProfesseur = $idProfesseur
					AND MN.idNiveau = $idNiveau
					ORDER BY M.libelleMatiere ASC";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('Matiere')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById ($idMatiere) {
		$query = "SELECT * FROM MATIERE WHERE idMatiere = $idMatiere";
		$result = db_connect::query($query);
		$return = new Matiere();
		if ($result->num_rows == 1) {
			$return = $result->fetch_object('Matiere');
		}
		$result->close();
		return $return;
	}

	/**
	 * @return mixed
	 */
	public function getIdMatiere () {
		return $this->idMatiere;
	}

	/**
	 * @param mixed $idMatiere
	 */
	public function setIdMatiere ($idMatiere) {
		$this->idMatiere = $idMatiere;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleMatiere () {
		return $this->libelleMatiere;
	}

	/**
	 * @param mixed $libelleMatiere
	 */
	public function setLibelleMatiere ($libelleMatiere) {
		$this->libelleMatiere = $libelleMatiere;
	}

	public function insert () {
		$query = "INSERT INTO MATIERE (libelleMatiere) VALUES (" . "'" . $this->getLibelleMatiere() . "' " . ")";
		if (db_connect::query($query)) {
			$select = "SELECT idMatiere FROM MATIERE WHERE " . "libelleMatiere = '" . $this->getLibelleMatiere() . "'";
			$result = db_connect::query($select);
			if ($result->num_rows == 1) {
				$info = $result->fetch_assoc();
				$this->setIdMatiere($info['idMatiere']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update () {
		$query = "UPDATE MATIERE SET " . "libelleMatiere = '" . $this->getLibelleMatiere() . "'" . "WHERE idMatiere = " . $this->getIdMatiere();
		if (db_connect::query($query)) return true;
		return false;
	}

	public function delete () {
		$query = "DELETE FROM MATIERE WHERE idMatiere = " . $this->getIdMatiere();
		if (db_connect::query($query)) return true;
		return false;
	}
}