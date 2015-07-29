<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:42
 */
class DomaineCpt {
	protected $idDomaineCpt;
	protected $libelleDomaineCpt;
	protected $idMatiereNiveau;

    public static function getAll(){
        $query = "SELECT * FROM DOMAINE_CPT";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while ($info = $result->fetch_object('DomaineCpt')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idDomaineCpt){
        $query = "SELECT * FROM DOMAINE_CPT WHERE idDomaineCpt = $idDomaineCpt";
        $result = db_connect::getInstance()->query($query);
        if ($result->num_rows == 1){
            $return = $result->fetch_object('DomaineCpt');
            $result->close();
            return $return;
        }
        $result->close();
        return new DomaineCpt();
    }

    public function getMatiereNiveau(){
        return MatiereNiveau::getById($this->getIdMatiereNiveau());
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

	/**
	 * @return mixed
	 */
	public function getLibelleDomaineCpt () {
		return $this->libelleDomaineCpt;
	}

	/**
	 * @param mixed $libelleDomaineCpt
	 */
	public function setLibelleDomaineCpt ($libelleDomaineCpt) {
		$this->libelleDomaineCpt = $libelleDomaineCpt;
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


}