<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:14
 */
class Evaluation {
	protected $idEvaluaton;
	protected $idTypeEvaluation;
	protected $idMatiereNiveau;
	protected $dateEvaluation;
	protected $titreEvaluation;
	protected $autreEvaluation;
	protected $maxEvaluation;

	public static function getAll(){
		$query = "SELECT * FROM EVALUATION";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while ($info = $result->fetch_object('Evaluation')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idEvaluation){
		$query = "SELECT * FROM EVALUATION WHERE idEvaluation = $idEvaluation";
		$result = db_connect::getInstance()->query($query);
		$return = new Evaluation();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('Evaluation');
		}
		$result->close();
		return $return;
	}

	public function getTypeEvaluation(){
		return TypeEvaluation::getById($this->getIdTypeEvaluation());
	}

	public function getMatiereNiveau(){
		return MatiereNiveau::getById($this->getIdMatiereNiveau());
	}

	/**
	 * @return mixed
	 */
	public function getIdEvaluaton () {
		return $this->idEvaluaton;
	}

	/**
	 * @param mixed $idEvaluaton
	 */
	public function setIdEvaluaton ($idEvaluaton) {
		$this->idEvaluaton = $idEvaluaton;
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

	public function insert(){
		$query = "INSERT INTO EVALUATION (idTypeEvaluation, idMatiereNiveau, dateEvaluation, titreEvaluation, autreEvaluation, maxEvaluation)".
			"VALUES (".
			"".$this->getIdTypeEvaluation().", ".
			"".$this->getIdMatiereNiveau().", ".
			"'".$this->getDateEvaluation()."', ".
			"'".$this->getTitreEvaluation()."', ".
			"".(empty($this->getAutreEvaluation())?'NULL':$this->getAutreEvaluation()).", ".
			"".$this->getMaxEvaluation().
			")";
		if (db_connect::query($query)){
			$query2 = "SELECT idEvaluation FROM EVALUATION WHERE ".
				"idTypeEvaluation = ".$this->getIdTypeEvaluation()." AND ".
				"idMatiereNiveau = ".$this->getIdMatiereNiveau()." AND ".
				"dateEvaluation = '".$this->getDateEvaluation()."' AND ".
				"titreEvaluation = '".$this->getTitreEvaluation()."' AND ".
				"autreEvaluation = ".(empty($this->getAutreEvaluation())?'NULL':$this->getAutreEvaluation())." AND ".
				"maxEvaluation = ".$this->getMaxEvaluation();
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdEvaluaton($info['idEvaluation']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		$query = "UPDATE EVALUATION SET ".
			"idTypeEvaluation = ".$this->getIdTypeEvaluation().", ".
			"idMatiereNiveau = ".$this->getIdMatiereNiveau().", ".
			"dateEvaluation = '".$this->getDateEvaluation()."', ".
			"titreEvaluation = '".$this->getTitreEvaluation()."', ".
			"autreEvaluation = ".(empty($this->getAutreEvaluation())?'NULL':$this->getAutreEvaluation()).", ".
			"maxEvaluation = ".$this->getMaxEvaluation()." ".
			"WHERE idEvaluation = ".$this->getIdEvaluaton();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM EVALUATION WHERE idEvaluation = ".$this->getIdEvaluaton();
		if (db_connect::query($query))
			return true;
		return false;
	}
}