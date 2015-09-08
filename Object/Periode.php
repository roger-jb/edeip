<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:31
 */

require_once('../Require/Objects.php');
class Periode extends FormatDate{
	protected $idPeriode;
	protected $libellePeriode;
	protected $dateDebutPeriode;
	protected $dateFinPeriode;
	protected $idTrimestre;

    public static function getAll(){
        $query = "SELECT * FROM PERIODE";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('Periode')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

	public function toArray(){
		$return = array();
		$return['idPeriode'] = $this->getIdPeriode();
		$return['libellePeriode'] = $this->getLibellePeriode();
		$return['dateDebutPeriode'] = $this->afficheDateDebutPeriode();
		$return['dateFinPeriode'] = $this->afficheDateFinPeriode();
		$return['idTrimestre'] = $this->getIdTrimestre();
		$return['Trimestre'] = $this->getTrimestre()->toArray();
		return $return;
	}

    public static function getById($idPeriode){
        $query = "SELECT * FROM PERIODE WHERE idPeriode = $idPeriode";
        $result = db_connect::query($query);
        $return = new Periode();
        if ($result->num_rows == 1){
            $return = $result->fetch_object('Periode');
        }
        $result->close();
        return $return;
    }

    public function getTrimestre(){
        return Trimestre::getById($this->getIdTrimestre());
    }

	/**
	 * @return mixed
	 */
	public function getIdPeriode () {
		return $this->idPeriode;
	}

	/**
	 * @param mixed $idPeriode
	 */
	public function setIdPeriode ($idPeriode) {
		$this->idPeriode = $idPeriode;
	}

	/**
	 * @return mixed
	 */
	public function getLibellePeriode () {
		return $this->libellePeriode;
	}

	/**
	 * @param mixed $libellePeriode
	 */
	public function setLibellePeriode ($libellePeriode) {
		$this->libellePeriode = $libellePeriode;
	}

	/**
	 * @return mixed
	 */
	public function getDateDebutPeriode () {
		return $this->dateDebutPeriode;
	}

	/**
	 * @param mixed $dateDebutPeriode
	 */
	public function setDateDebutPeriode ($dateDebutPeriode) {
		$this->dateDebutPeriode = $dateDebutPeriode;
	}

	public function afficheDateDebutPeriode(){
		return $this->affiche($this->getDateDebutPeriode());
	}

	public function SQLdateDebutperiode(){
		return $this->SQL($this->getDateDebutPeriode());
	}

	/**
	 * @return mixed
	 */
	public function getDateFinPeriode () {
		return $this->dateFinPeriode;
	}

	/**
	 * @param mixed $dateFinPeriode
	 */
	public function setDateFinPeriode ($dateFinPeriode) {
		$this->dateFinPeriode = $dateFinPeriode;
	}

	public function afficheDateFinPeriode(){
		return $this->affiche($this->getDateFinPeriode());
	}

	public function SQLdateFinPeriode(){
		return $this->SQL($this->getDateFinPeriode());
	}

	/**
	 * @return mixed
	 */
	public function getIdTrimestre () {
		return $this->idTrimestre;
	}

	/**
	 * @param mixed $idTrimestre
	 */
	public function setIdTrimestre ($idTrimestre) {
		$this->idTrimestre = $idTrimestre;
	}

	public function insert(){
		$query = "INSERT INTO PERIODE (libellePeriode, dateDebutPeriode, dateFinPeriode, idTrimestre) VALUES (".
			"'".db_connect::escape_string($this->getLibellePeriode())."', ".
			"'".$this->SQLdateDebutPeriode()."', ".
			"'".$this->SQLdateFinPeriode()."', ".
			"".$this->getIdTrimestre()."".
			")";
		if (db_connect::query($query)){
			$select = "SELECT idPeriode FROM PERIODE WHERE ".
				"libellePeriode = '".db_connect::escape_string($this->getLibellePeriode())."' AND ".
				"dateDebutPeriode = '".$this->SQLdateDebutperiode()."' AND ".
				"dateFinPeriode = '".$this->SQLdateFinPeriode()."' AND ".
				"idTrimestre = ".$this->getIdTrimestre()."";
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdPeriode($info['idPeriode']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		$query = "UPDATE PERIODE SET ".
			"libellePeriode = '".db_connect::escape_string($this->getLibellePeriode())."', ".
			"dateDebutPeriode = '".$this->SQLdateDebutperiode()."', ".
			"dateFinPeriode = '".$this->SQLdateFinPeriode()."', ".
			"idTrimestre = ".$this->getIdTrimestre()." ".
			"WHERE idPeriode = ".$this->getIdPeriode();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM PERIODE WHERE idPeriode = ".$this->getIdPeriode();
		if (db_connect::query($query))
			return true;
		return false;
	}
}