<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:13
 */
class Note {
	protected $idEleve;
	protected $idEvaluation;
	protected $note;

	public static function getAll(){
		$query = "SELECT * FROM NOTE";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while ($info = $result->fetch_object('Note')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idEleve, $idEvaluation){
		$query = "SELECT * FROM NOTE WHERE idEleve = $idEleve AND idEvaluation = $idEvaluation";
		$result = db_connect::getInstance()->query($query);
		$return = new Note();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('Note');
		}
		$result->close();
		return $return;
	}

	public function getEleve(){
		return Eleve::getById($this->getIdEleve());
	}

	public function getEvaluation(){
		return Evaluation::getById($this->getIdEvaluation());
	}

	/**
	 * @return mixed
	 */
	public function getIdEleve () {
		return $this->idEleve;
	}

	/**
	 * @param mixed $idNote
	 */
	public function setIdEleve ($idEleve) {
		$this->idEleve = $idEleve;
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
	public function setIdEvaluation ($idEvaluation) {
		$this->idEvaluation = $idEvaluation;
	}

	/**
	 * @return mixed
	 */
	public function getNote () {
		return $this->note;
	}

	/**
	 * @param mixed $note
	 */
	public function setNote ($note) {
		$this->note = $note;
	}


}