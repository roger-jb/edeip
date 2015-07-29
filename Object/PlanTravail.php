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

    public static function getAll(){
        $query = "SELECT * FROM PLAN_TRAVAIL";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while ($info = $result->fetch_object('PlanTravail')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idPlanTravail){
        $query = "SELECT * FROM PLAN_TRAVAIL WHERE idPlanTravail = $idPlanTravail";
        $result = db_connect::getInstance()->query($query);
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


}