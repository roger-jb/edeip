<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:13
 */

class NoteDTO {
	protected $idNote;
	protected $idEvaluation;
	protected $note;

	/**
	 * @return mixed
	 */
	public function getIdNote () {
		return $this->idNote;
	}

	/**
	 * @param mixed $idNote
	 */
	public function setIdNote ($idNote) {
		$this->idNote = $idNote;
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