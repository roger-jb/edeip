<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:59
 */
class PointCptEleve {
	protected $idPointCpt;
	protected $idEleve;
	protected $idTrimestre;
	protected $idNiveauCpt;

    public static function getAll(){
        $query = "SELECT * FROM POINT_CPT_ELEVE";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('PointCptEleve')){
            $return [] = $info;
        }
		return $return;
    }

    public static function getById($idPointCpt, $idEleve, $idTrimestre){
        $query = "SELECT * FROM POINT_CPT_ELEVE WHERE idPointCpt = $idPointCpt AND idEleve = $idEleve AND idTrimestre = $idTrimestre";
        $result = db_connect::query($query);
        if ($result->num_rows == 1){
            $return = $result->fetch_object('PointCptEleve');
            $result->close();
            return $return;
        }
        $result->close();
        return new PointCptEleve();
    }

	public static function getByEleveTrimestre($idEleve, $idTrimestre){
		$query = "	SELECT * FROM POINT_CPT_ELEVE pce
					WHERE pce.idEleve = $idEleve
					AND pce.idTrimestre = $idTrimestre";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('PointCptEleve')){
			$return [] = $info;
		}
		return $return;
	}

    public function getEleve(){
        return Eleve::getById($this->getIdEleve());
    }

    public function getPointCpt(){
        return PointCpt::getById($this->getIdPointCpt());
    }

    public function getNiveauCpt(){
        return NiveauCpt::getByid($this->getIdNiveauCpt());
    }

	/**
	 * @return mixed
	 */
	public function getIdPointCpt () {
		return $this->idPointCpt;
	}

	/**
	 * @param mixed $idPointCpt
	 */
	public function setIdPointCpt ($idPointCpt) {
		$this->idPointCpt = $idPointCpt;
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

	public function getIdTrimestre(){
		return $this->idTrimestre;
	}

	public function setIdTrimestre($idTrimestre){
		$this->idTrimestre = $idTrimestre;
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
		$query = "INSERT INTO POINT_CPT_ELEVE (idPointCpt, idEleve, idTrimestre, idNiveauCpt) VALUES (".
			$this->getIdPointCpt().", ".
			$this->getIdEleve().", ".
			$this->getIdTrimestre().', '.
			$this->getIdNiveauCpt().
			")";
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function update(){
		$query = "	UPDATE POINT_CPT_ELEVE SET
					idNiveauCpt = ".$this->getIdNiveauCpt()."
					WHERE idPointCpt = ".$this->getIdPointCpt()." AND
					idEleve = ".$this->getIdEleve()." AND
					idTrimestre = ".$this->getIdTrimestre();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM POINT_CPT_ELEVE WHERE idPointCpt = ".$this->getIdPointCpt(). " AND idEleve = ".$this->getIdEleve()." AND idTrimestre = ".$this->getIdTrimestre();
		if (db_connect::query($query))
			return true;
		return false;
	}
}