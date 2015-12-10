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
	protected $idMatiere;

	public function toArray(){
		$return = array();
		$return['idDomaineCpt'] = $this->getIdDomaineCpt();
		$return['libelleDomaineCpt'] = $this->getLibelleDomaineCpt();
		$return['idMatiereNiveau'] = $this->getIdMatiere();
		return $return;
	}

	public function exist(){
		$query = "SELECT * FROM DOMAINE_CPT WHERE libelleDomaineCpt LIKE '".$this->getLibelleDomaineCpt()."'";
		$result = db_connect::query($query);
		if ($result->num_rows != 1)
			return false;
		$info = $result->fetch_object('DomaineCpt');
		$this->setIdDomaineCpt($info->getIdDomaineCpt());
		$this->setIdMatiere($info->getIdMatiereNiveau());
		$this->setLibelleDomaineCpt($info->getLibelleDomaineCpt());
		return true;
	}

    public static function getAll(){
        $query = "SELECT * FROM DOMAINE_CPT";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('DomaineCpt')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idDomaineCpt){
        $query = "SELECT * FROM DOMAINE_CPT WHERE idDomaineCpt = $idDomaineCpt";
        $result = db_connect::query($query);
        if ($result->num_rows == 1){
            $return = $result->fetch_object('DomaineCpt');
            $result->close();
            return $return;
        }
        $result->close();
        return new DomaineCpt();
    }

	public static function getByMatiere($idMatiere){
		$query = "SELECT * FROM DOMAINE_CPT WHERE idMatiere = $idMatiere";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('DomaineCpt')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getByLibelle($libDomaine){
		$libDomaine = trim($libDomaine);
		$query = "SELECT * FROM DOMAINE_CPT WHERE libelleDomaineCpt like '$libDomaine'";
		$result = db_connect::query($query);
		if ($result->num_rows == 1){
			$return = $result->fetch_object('DomaineCpt');
			$result->close();
			return $return;
		}
		$result->close();
		return new DomaineCpt();
	}

    public function getMatiere(){
        return Matiere::getById($this->getIdMatiere());
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
	public function getIdMatiere () {
		return $this->idMatiere;
	}

	/**
	 * @param mixed $idMatiere
	 */
	public function setIdMatiere ($idMatiere) {
		$this->idMatiere = $idMatiere;
	}

	public function insert(){
		$query = "INSERT INTO DOMAINE_CPT (".
			"libelleDomaineCpt, idMatiere".
			") VALUES (".
			"'".db_connect::escape_string($this->getLibelleDomaineCpt())."', ".
			$this->getIdMatiere().
			")";
		if (db_connect::query($query)){
			$query2 = "SELECT * FROM DOMAINE_CPT WHERE ".
				"libelleDomaineCpt = '".db_connect::escape_string($this->getLibelleDomaineCpt())."' AND ".
				"idMatiere = ".$this->getIdMatiere();
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
			"idMatiere = ".$this->getIdMatiere().
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