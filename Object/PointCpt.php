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

	public function toArray(){
		$return = array();
		$return['idPointCpt'] = $this->getIdPointCpt();
		$return['libellePointCpt'] = $this->getLibellePointCpt();
		$return['idDomaineCpt'] = $this->getIdDomaineCpt();
		return $return;
	}

	public function exist(){
		$query = "SELECT * FROM POINT_CPT WHERE libellePointCpt LIKE '".$this->getDomaineCpt()->getLibelleDomaineCpt()."' AND idDomaineCpt = ".$this->getIdDomaineCpt();
		$result = db_connect::query($query);
		if ($result->num_rows != 1)
			return false;
		$info = $result->fetch_object('PointCpt');
		$this->setIdDomaineCpt($info->getIdDomaineCpt());
		$this->setIdPointCpt($info->getIdPointCpt());
		$this->setLibellePointCpt($info->getLibellePointCpt());
		return true;
	}

    public static function getAll(){
        $query = "SELECT * FROM POINT_CPT";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('PointCpt')){
            $return [] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idPointCpt){
        $query = "SELECT * FROM POINT_CPT WHERE idPointCpt = $idPointCpt";
        $result = db_connect::query($query);
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

	public function insert(){
		$query = "INSERT INTO POINT_CPT (libellePointCpt, idDomaineCpt) VALUES (".
			"'".db_connect::escape_string($this->getLibellePointCpt())."', ".
			"".$this->getIdDomaineCpt()."".
			")";
		if (db_connect::query($query)){
			$select = "SELECT idPointCpt FROM POINT_CPT WHERE ".
				"libellePointCpt = '".db_connect::escape_string($this->getLibellePointCpt())."' AND ".
				"idDomaineCpt = ".$this->getIdDomaineCpt();
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdPointCpt($info['idPointCpt']);
				$result->close();
				return true;
			}
			// db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		$query = "UPDATE POINT_CPT SET ".
			"libellePointCpt = '".db_connect::escape_string($this->getLibellePointCpt())."', ".
			"idDomaineCpt = ".$this->getIdDomaineCpt()." ".
			"WHERE idPointCpt = ".$this->getIdPointCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM POINT_CPT WHERE idPointCpt = ".$this->getIdPointCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}
}