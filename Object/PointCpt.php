<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:57
 */
class PointCpt {
	protected $idPointCpt;
	protected $libellePointCpt;
	protected $idDomaineCpt;

    public static function getAll(){
        $query = "SELECT * FROM POINT_CPT";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while ($info = $result->fetch_object('PointCpt')){
            $return [] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idPointCpt){
        $query = "SELECT * FROM POINT_CPT WHERE idPointCpt = $idPointCpt";
        $result = db_connect::getInstance()->query($query);
        if ($result->num_rows == 1){
            $return = $result->fetch_object('PointCpt');
            $result->close();
            return $return;
        }
        $result->close();
        return new PointCpt();
    }

    public function getDomaineCpt(){
        return DomaineCpt::getById($this->getIdDomaineCpt());
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
	public function getLibellePointCpt () {
		return $this->libellePointCpt;
	}

	/**
	 * @param mixed $libellePointCpt
	 */
	public function setLibellePointCpt ($libellePointCpt) {
		$this->libellePointCpt = $libellePointCpt;
	}

	/**
	 * @return mixed
	 */
	public function getIdDomaineCpt () {
		return $this->idDomaineCpt;
	}

	/**
	 * @param mixed $idDomaineCpt
	 */
	public function setIdDomaineCpt ($idDomaineCpt) {
		$this->idDomaineCpt = $idDomaineCpt;
	}


}