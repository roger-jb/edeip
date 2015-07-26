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

	public static function getAll(){
		$query = "SELECT * FROM MATIERE";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while($info = $result->fetch_object('Matiere')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idMatiere){
		$query = "SELECT * FROM MATIERE WHERE idMatiere = $idMatiere";
		$result = db_connect::getInstance()->query($query);
		$return = new Matiere();
		if ($result->num_rows == 1){
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

}