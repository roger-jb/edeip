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

	public function insert(){
		$query = "INSRT INTO DOMAINE_CPT (".
			"libelleDomaineCpt, idMatiereNiveau".
			") VALUES (".
			"'".db_connect::escape_string($this->getLibelleDomaineCpt())."', ".
			"".$this->getIdMatiereNiveau().
			")";
		if (db_connect::query($query)){
			$query2 = "SELECT * FROM DOMAINE_CPT WHERE ".
				"libelleDomaineCpt = '".db_connect::escape_string($this->getLibelleDomaineCpt())."' AND ".
				"idMatiereNiveau = ".$this->getIdMatiereNiveau();
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdDomaineCpt($info['idDomaineCpt']);
				$result->close();
				return true;
			}
		}
		return false;
	}

	public function update(){
		$query = "UPDATE DOMAINE_CPT SET ".
			"libelleDomaineCpt = '".db_connect::escape_string($this->getLibelleDomaineCpt())."', ".
			"idMatiereNiveau = ".$this->getIdMatiereNiveau().
			"WHERE idDomaineCpt = ".$this->getIdDomaineCpt();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM DOMAINE_CPT WHERE idDomaineCpt = ".$this->getIdDomaineCpt();

		if (db_connect::query($query))
			return true;
		return false;
	}
}