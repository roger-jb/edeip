<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:53
 */
class NiveauCpt {
	protected $idNiveauCpt;
	protected $libelleNiveauCpt;

    public static function getAll(){
        $query = "SELECT * FROM NIVEAU_CPT";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while ($info = $result->fetch_object('NiveauCpt')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idNiveauCpt){
        $query = "SELECT * FROM NIVEAU_CPT WHERE idNiveauCpt = $idNiveauCpt";
        $result = db_connect::getInstance()->query($query);
        if ($result->num_rows == 1){
            $return = $result->fetch_object('NiveauCpt');
            $result->close();
            return $return;
        }
        $result->close();
        return new NiveauCpt();
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

	/**
	 * @return mixed
	 */
	public function getLibelleNiveauCpt () {
		return $this->libelleNiveauCpt;
	}

	/**
	 * @param mixed $libelleNiveauCpt
	 */
	public function setLibelleNiveauCpt ($libelleNiveauCpt) {
		$this->libelleNiveauCpt = $libelleNiveauCpt;
	}
}