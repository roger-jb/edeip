<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:32
 */
class PlanTravail {
	protected $idPlanTravail;
	protected $libellePlanTravail;
	protected $idMatiereNiveau;
	protected $idPeriode;

	public function toArray(){
		$return = array();
		$return['idPlanTravail'] = $this->getIdPlanTravail();
		$return['libellePlanTravail'] = $this->getLibellePlanTravail();
		$return['idMatiereNiveau'] = $this->getIdMatiereNiveau();
		$return['idPeriode'] = $this->getIdPeriode();
		$return['libellePeriode'] = $this->getPeriode()->getLibellePeriode();
		return $return;
	}

    public static function getAll(){
        $query = "SELECT * FROM PLAN_TRAVAIL";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('PlanTravail')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

	public static function getbyMatiereNiveau($idMatiereNiveau){
		$query = "SELECT PL.* FROM PLAN_TRAVAIL PL, PERIODE P WHERE PL.idMatiereNiveau = $idMatiereNiveau AND PL.idPeriode = P.idPeriode ORDER BY P.dateDebutPeriode DESC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('PlanTravail')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

    public static function getById($idPlanTravail){
        $query = "SELECT * FROM PLAN_TRAVAIL WHERE idPlanTravail = $idPlanTravail";
        $result = db_connect::query($query);
        $return = new PlanTravail();
        if ($result->num_rows == 1){
            $return = $result->fetch_object('PlanTravail');
        }
        $result->close();
        return $return;
    }

    public function getPeriode(){
        return Periode::getById($this->getIdPeriode());
    }

    public function getMatiereNiveau(){
        return MatiereNiveau::getById($this->getIdMatiereNiveau());
    }

	/**
	 * @return mixed
	 */
	public function getIdPlanTravail () {
		return $this->idPlanTravail;
	}

	/**
	 * @param mixed $idPlanTravail
	 */
	public function setIdPlanTravail ($idPlanTravail) {
		$this->idPlanTravail = $idPlanTravail;
	}

	/**
	 * @return mixed
	 */
	public function getLibellePlanTravail () {
		return $this->libellePlanTravail;
	}

	/**
	 * @param mixed $libellePlanTravail
	 */
	public function setLibellePlanTravail ($libellePlanTravail) {
		$this->libellePlanTravail = $libellePlanTravail;
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

	public function insert(){
		$query = "INSERT INTO PLAN_TRAVAIL (libellePlanTravail, idMatiereNiveau, idPeriode) VALUES (".
			"'".db_connect::escape_string($this->getLibellePlanTravail())."', ".
			$this->getIdMatiereNiveau().", ".
			$this->getIdPeriode().
			")";
		if (db_connect::query($query)){
			$select = "SELECT idPlanTravail FROM PLAN_TRAVAIL WHERE ".
				"libellePlanTravail = '".db_connect::escape_string($this->getLibellePlanTravail())."' AND ".
				"idMatiereNiveau = ".$this->getIdMatiereNiveau()." AND ".
				"idPeriode = ".$this->getIdPeriode();
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdPlanTravail($info['idPlanTravail']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		return false;
	}

	public function delete(){
		$query = "DELETE FROM PLAN_TRAVAIL WHERE idPlanTravail = ".$this->getIdPlanTravail();
		if (db_connect::query($query))
			return true;
		return false;
	}
}