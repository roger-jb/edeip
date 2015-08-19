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
	protected $idNiveauCpt;

    public static function getAll(){
        $query = "SELECT * FROM POINT_CPT_ELEVE";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('PointCptEleve')){
            $return [] = $info;
        }
    }

    public static function getById($idPointCpt, $idEleve){
        $query = "SELECT * FROM POINT_CPT_ELEVE WHERE idPointCpt = $idPointCpt AND idEleve = $idEleve";
        $result = db_connect::query($query);
        if ($result->num_rows == 1){
            $return = $result->fetch_object('PointCptEleve');
            $result->close();
            return $return;
        }
        $result->close();
        return new PointCptEleve();
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
		$query = "INSERT INTO POINT_CPT_ELEVE (idPointCpt, idEleve, idNiveauCpt) VALUES (".
			"".$this->getIdPointCpt().", ".
			"".$this->getIdEleve().", ".
			"".$this->getIdNiveauCpt()."".
			")";
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function update(){
		$query = "UPDATE POINT_CPT_ELEVE SET ".
			"idNiveauCpt = ".$this->getIdNiveauCpt()." ".
			"WHERE idPointCpt = ".$this->getIdPointCpt()." AND ".
			"idEleve = ".$this->getIdEleve();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM POINT_CPT_ELEVE WHERE idPointCpt = ".$this->getIdPointCpt(). " AND idEleve = ".$this->getIdEleve();
		if (db_connect::query($query))
			return true;
		return false;
	}
}