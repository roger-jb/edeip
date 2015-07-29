<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:31
 */

require_once('../Object/Trimestre.php');
class Periode {
	protected $idPeriode;
	protected $libellePeriode;
	protected $dateDebutPeriode;
	protected $dateFinPeriode;
	protected $idTrimestre;

    public static function getAll(){
        $query = "SELECT * FROM PERIODE";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while ($info = $result->fetch_object('Periode')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idPeriode){
        $query = "SELECT * FROM PERIODE WHERE idPeriode = $idPeriode";
        $result = db_connect::getInstance()->query($query);
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


}