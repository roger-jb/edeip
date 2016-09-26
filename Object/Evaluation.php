<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:14
 */
class Evaluation extends FormatDate{
	protected $idEvaluation;
	protected $idTypeEvaluation;
	protected $idMatiereNiveau;
	protected $dateEvaluation;
	protected $titreEvaluation;
	protected $autreEvaluation;
	protected $maxEvaluation;

	public function toArray () {
		$return = array ();
		$return['idEvaluation'] = $this->getIdEvaluation();
		$return['idTypeEvaluation'] = $this->getIdTypeEvaluation();
		$return['idMatiereNiveau'] = $this->getIdMatiereNiveau();
		$return['dateEvaluation'] = $this->afficheDateEvaluation();
		$return['titreEvaluation'] = $this->getTitreEvaluation();
		$return['autreEvaluation'] = $this->getAutreEvaluation();
		$return['maxEvaluation'] = $this->getMaxEvaluation();
		$return['libelleEvaluation'] = $this->getLibelleEvaluation();


		if (!empty($this->getIdMatiereNiveau())){
			$matiereNiveau = MatiereNiveau::getById($this->getIdMatiereNiveau());
			if (!empty($matiereNiveau->getIdMatiereNiveau())){
				$return['idMatiere'] = $matiereNiveau->getIdMatiere();
				$return['idNiveau'] = $matiereNiveau->getIdNiveau();
			}
			else {
				$return['idMatiere'] = '';
				$return['idNiveau'] = '';
			}
		}
		else {
			$return['idMatiere'] = '';
			$return['idNiveau'] = '';
		}
		return $return;
	}

	public static function getAll () {
		$query = "SELECT * FROM EVALUATION";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('Evaluation')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}
/*
	public static function getByMatiereNiveauTrimestre($idMatiereNiveau, $idTrimestre){
		$query = "	SELECT ev.* FROM EVALUATION ev
					WHERE ev.idMatiereNiveau = $idMatiereNiveau
					AND ev.dateEvaluation >= (SELECT T.dateDebutTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)
					AND ev.dateEvaluation <= (SELECT T.dateFinTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('Evaluation')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}
*/
	public function getEleves(){
		$query = "	SELECT DISTINCT * FROM (
						SELECT e.idNiveau, u.*
						FROM EVALUATION ev, MATIERE_NIVEAU mn, ELEVE_MATIERE_NIVEAU emn, ELEVE e, UTILISATEUR u
						WHERE ev.idEvaluation = ".$this->getIdEvaluation()."
						AND ev.idMatiereNiveau = mn.idMatiereNiveau
						AND mn.idMatiereNiveau = emn.idMatiereNiveau
						AND e.idEleve = emn.idEleve
						AND e.idEleve = u.idUtilisateur

						UNION
						SELECT e.idNiveau, u.*
						FROM ELEVE e, NOTE n, UTILISATEUR u
						WHERE n.idEvaluation = ".$this->getIdEvaluation()."
						AND n.idEleve = e.idEleve
						AND e.idEleve = u.idUtilisateur
					) as ELEVES
					ORDER BY nomUtilisateur, prenomUtilisateur";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('Eleve')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getByMatiereNiveau ($idMatiereNiveau) {
		$query = "SELECT * FROM EVALUATION WHERE idMatiereNiveau = $idMatiereNiveau";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('Evaluation')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getByMatiereTrimestre($idMatiere, $idTrimestre){
		$query = "	SELECT * FROM EVALUATION E, MATIERE_NIVEAU MN
					WHERE E.idMatiereNiveau = MN.idMatiereNiveau
					AND MN.idMatiere = $idMatiere
					AND E.dateEvaluation >= (SELECT T.dateDebutTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)
					AND E.dateEvaluation <= (SELECT T.dateFinTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)";
		$result = db_connect::query($query);
		$return = array ();
		while ($info = $result->fetch_object('Evaluation')) {
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById ($idEvaluation) {
		$query = "SELECT * FROM EVALUATION WHERE idEvaluation = $idEvaluation";
		$result = db_connect::query($query);
		$return = new Evaluation();
		if ($result->num_rows == 1) {
			$return = $result->fetch_object('Evaluation');
		}
		$result->close();
		return $return;
	}

	public function getTypeEvaluation () {
		return TypeEvaluation::getById($this->getIdTypeEvaluation());
	}

	public function getMatiereNiveau () {
		return MatiereNiveau::getById($this->getIdMatiereNiveau());
	}

	/**
	 * @return mixed
	 */
	public function getIdEvaluation () {
		return $this->idEvaluation;
	}

	/**
	 * @param mixed $idEvaluation
	 */
	public function setIdEvaluaton ($idEvaluation) {
		$this->idEvaluation = $idEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getIdTypeEvaluation () {
		return $this->idTypeEvaluation;
	}

	/**
	 * @param mixed $idTypeEvaluation
	 */
	public function setIdTypeEvaluation ($idTypeEvaluation) {
		$this->idTypeEvaluation = $idTypeEvaluation;
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

	/**
	 * @return mixed
	 */
	public function getDateEvaluation () {
		return $this->dateEvaluation;
	}

	/**
	 * @param mixed $dateEvaluation
	 */
	public function setDateEvaluation ($dateEvaluation) {
		$this->dateEvaluation = $dateEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getTitreEvaluation () {
		return $this->titreEvaluation;
	}

	/**
	 * @param mixed $titreEvaluation
	 */
	public function setTitreEvaluation ($titreEvaluation) {
		$this->titreEvaluation = $titreEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getAutreEvaluation () {
		return $this->autreEvaluation;
	}

	/**
	 * @param mixed $autreEvaluation
	 */
	public function setAutreEvaluation ($autreEvaluation) {
		$this->autreEvaluation = $autreEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getMaxEvaluation () {
		return $this->maxEvaluation;
	}

	/**
	 * @param mixed $maxEvaluation
	 */
	public function setMaxEvaluation ($maxEvaluation) {
		$this->maxEvaluation = $maxEvaluation;
	}

	public function getLibelleEvaluation () {
		$return = '';
		$typeEval = TypeEvaluation::getById($this->getIdTypeEvaluation());
		if (strtoupper($typeEval->getLibelleTypeEvaluation()) == 'AUTRE') $return .= $this->getAutreEvaluation();
		else
			$return .= $typeEval->getLibelleTypeEvaluation();
		$return .= ($this->getTitreEvaluation()?' '.$this->getTitreEvaluation().' ':'');
		$return .= ' du : ' . $this->afficheDateEvaluation();
		return $return;
	}

	public function afficheDateEvaluation () {
		return $this->affiche($this->getDateEvaluation());
	}

	public function sqlDateEvaluation () {
		return $this->SQL($this->getDateEvaluation());
	}

	public function insert () {
		$query = "INSERT INTO EVALUATION (idTypeEvaluation, idMatiereNiveau, dateEvaluation, titreEvaluation, autreEvaluation, maxEvaluation)" . "VALUES (" . "" . $this->getIdTypeEvaluation() . ", "  . $this->getIdMatiereNiveau() . ", '" . $this->sqlDateEvaluation() . "', '" . $this->getTitreEvaluation() . "', " .  (empty($this->getAutreEvaluation()) ? 'NULL' : "'".$this->getAutreEvaluation()."'") . ", " .  $this->getMaxEvaluation() . ")";
		if (db_connect::query($query)) {
			$query2 = "	SELECT idEvaluation FROM EVALUATION
						WHERE idTypeEvaluation = " . $this->getIdTypeEvaluation() . "
						AND idMatiereNiveau = " . $this->getIdMatiereNiveau() . "
						AND dateEvaluation = '" . $this->sqlDateEvaluation() . "'
						AND titreEvaluation = '" . db_connect::escape_string($this->getTitreEvaluation()) . "'
						AND autreEvaluation " . (empty($this->getAutreEvaluation()) ? ' IS NULL' : "= '".db_connect::escape_string($this->getAutreEvaluation())."'") . "
						AND maxEvaluation = " . $this->getMaxEvaluation();
			$result = db_connect::query($query2);
			if ($result->num_rows == 1) {
				$info = $result->fetch_assoc();
				$this->setIdEvaluaton($info['idEvaluation']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update () {
		$query = "UPDATE EVALUATION SET " . "idTypeEvaluation = " . $this->getIdTypeEvaluation() . ", " . "idMatiereNiveau = " . $this->getIdMatiereNiveau() . ", " . "dateEvaluation = '" . $this->sqlDateEvaluation() . "', " . "titreEvaluation = '" . db_connect::escape_string($this->getTitreEvaluation()) . "', " . "autreEvaluation = " . (empty($this->getAutreEvaluation()) ? 'NULL' : "'".db_connect::escape_string($this->getAutreEvaluation())."'") . ", " . "maxEvaluation = " . $this->getMaxEvaluation() . " " . "WHERE idEvaluation = " . $this->getIdEvaluation();
		if (db_connect::query($query)) return true;
		return false;
	}

	public function delete () {
		$query = "DELETE FROM EVALUATION WHERE idEvaluation = " . $this->getIdEvaluation();
		if (db_connect::query($query)) return true;
		return false;
	}
}