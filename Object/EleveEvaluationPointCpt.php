<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:21
 */
class EleveEvaluationPointCpt {
	protected $idEleve;
	protected $idEvaluationPointCpt;
	protected $idNiveauCpt;

	public function toArray(){
		$return = array();
		$return['idEleve'] = $this->getIdEleve();
		$return['idEvaluationPointCpt'] = $this->getIdEvaluationPointCpt();
		$return['idNiveauCpt'] = $this->getIdNiveauCpt();
		$return['Eleve'] = $this->getEleve()->toArray();
		$return['EvaluationPointCpt'] = $this->getEvaluationPointCpt()->toArray();
		$return['NiveauCpt'] = $this->getNiveauCpt()->toArray();
		return $return;
	}

	public static function getAll(){
		$query = "SELECT * FROM ELEVE_EVALUATION_POINT_CPT";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('EleveEvaluationPointCpt')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idEleve, $idEvaluationPointCpt){
		$query = "SELECT * FROM ELEVE_EVALUATION_POINT_CPT WHERE idEleve = $idEleve AND idEvaluationPointCpt = $idEvaluationPointCpt";
		$result = db_connect::query($query);
		$return = new EleveEvaluationPointCpt();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('EleveEvaluationPointCpt');
		}
		$result->close();
		return $return;
	}

	public static function getByEleveMatiereTrimestre($idEleve, $idMatiere, $idTrimestre){
		$query = "	SELECT EEP.* FROM ELEVE_EVALUATION_POINT_CPT EEP
					WHERE EEP.idEleve = $idEleve
					AND EEP.idEvaluationPointCpt IN (
						SELECT idEvaluationPointCpt FROM EVALUATION_POINT_CPT EP
						WHERE EP.idEvaluation IN (
							SELECT idEvaluation FROM EVALUATION E, MATIERE_NIVEAU MN
							WHERE E.idMatiereNiveau = MN.idMatiereNiveau
							AND MN.idMatiere = $idMatiere
							AND E.dateEvaluation >= (SELECT T.dateDebutTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)
							AND E.dateEvaluation <= (SELECT T.dateFinTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)
							)
						)";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('EleveEvaluationPointCpt')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getByElevePointCpt($idEleve, $idPointCpt){
		$query = "	SELECT eep.* from ELEVE_EVALUATION_POINT_CPT eep, EVALUATION_POINT_CPT ept
					WHERE eep.idEleve = $idEleve
					AND eep.idEvaluationPointCpt = ept.idEvaluationPointCpt
					AND ept.idPointCpt = $idPointCpt";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('EleveEvaluationPointCpt')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public function getEleve(){
		return Eleve::getById($this->getIdEleve());
	}

	public function getEvaluationPointCpt(){
		return EvaluationPointCpt::getById($this->getIdEvaluationPointCpt());
	}

	public function getNiveauCpt(){
		return NiveauCpt::getById($this->getIdNiveauCpt());
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
	public function getIdEvaluationPointCpt () {
		return $this->idEvaluationPointCpt;
	}

	/**
	 * @param mixed $idEvaluationPointCpt
	 */
	public function setIdEvaluationPointCpt ($idEvaluationPointCpt) {
		$this->idEvaluationPointCpt = $idEvaluationPointCpt;
	}

	/**
	 * @return mixed
	 */
	public function getIdNiveauCpt () {
		return $this->idNiveauCpt;
	}

	/**
	 * @param mixed $idNiveauCpt
	 */
	public function setIdNiveauCpt ($idNiveauCpt) {
		$this->idNiveauCpt = $idNiveauCpt;
	}

	public function insert(){
		$query = "INSERT INTO ELEVE_EVALUATION_POINT_CPT (idEleve, idEvaluationPointCpt, idNiveauCpt) VALUES (".
			$this->getIdEleve().", ".
			$this->getIdEvaluationPointCpt().", ".
			(!is_null($this->getIdNiveauCpt())?$this->getIdNiveauCpt():'NULL').
			")";
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function update(){
		$query = "UPDATE ELEVE_EVALUATION_POINT_CPT SET ".
			"idNiveauCpt = ".(!is_null($this->getIdNiveauCpt())?$this->getIdNiveauCpt():'NULL')." ".
			"WHERE idEleve = ".$this->getIdEleve()." AND idEvaluationPointCpt = ".$this->getIdEvaluationPointCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM ELEVE_EVALUATION_POINT_CPT WHERE idEleve = ".$this->getIdEleve()." AND idEvaluationPointCpt = ".$this->getIdEvaluationPointCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}
}