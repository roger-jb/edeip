<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 15:46
 */
class EmploiTemps {
	protected $idEdT;
	protected $idPeriode;
	protected $idMatiereNiveau;
	protected $jourEdT;
	protected $heureDebEdT;
	protected $heureFinEdT;

    public static function getAll(){
        $query = "SELECT * FROM EMPLOI_TEMPS";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while ($info = $result->fetch_object('EmploiTemps')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idEdT){
        $query = "SELECT * FROM EMPLOI_TEMPS WHERE idEdT = $idEdT";
        $result = db_connect::getInstance()->query($query);
        $return = new EmploiTemps();
        if ($result->num_rows == 1){
            $return = $result->fetch_object('EmploiTemps');
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
	public function getIdEdT () {
		return $this->idEdT;
	}

	/**
	 * @param mixed $idEdT
	 */
	public function setIdEdT ($idEdT) {
		$this->idEdT = $idEdT;
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
	public function getJourEdT () {
		return $this->jourEdT;
	}

	/**
	 * @param mixed $jourEdT
	 */
	public function setJourEdT ($jourEdT) {
		$this->jourEdT = $jourEdT;
	}

	/**
	 * @return mixed
	 */
	public function getHeureDebEdT () {
		return $this->heureDebEdT;
	}

	/**
	 * @param mixed $heureDebEdT
	 */
	public function setHeureDebEdT ($heureDebEdT) {
		$this->heureDebEdT = $heureDebEdT;
	}

	/**
	 * @return mixed
	 */
	public function getHeureFinEdT () {
		return $this->heureFinEdT;
	}

	/**
	 * @param mixed $heureFinEdT
	 */
	public function setHeureFinEdT ($heureFinEdT) {
		$this->heureFinEdT = $heureFinEdT;
	}


}