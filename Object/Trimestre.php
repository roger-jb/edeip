<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:30
 */
class Trimestre {
	protected $idTrimestre;
	protected $libelleTrimestre;
	protected $dateDebutTrimeste;
	protected $dateFinTrimestre;
	protected $dateFinCommentaire;

    public function getAll(){
        $query = "SELECT * FROM TRIMESTRE";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while($info = $result->fetch_object('Trimestre')){
            $return[] =$info;
        }
        $result->close();
        return $return;
    }

    public function getById($idTrimestre){
        $query = "SELECT * FROM TRIMESTRE WHERE idTrimestre = $idTrimestre";
        $result = db_connect::getInstance()->query($query);
        $return = new Trimestre();
        if ($result->num_rows == 1){
            $return = $result->fetch_object('Trimestre');
        }
        $result->close();
        return $return;
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

	/**
	 * @return mixed
	 */
	public function getLibelleTrimestre () {
		return $this->libelleTrimestre;
	}

	/**
	 * @param mixed $libelleTrimestre
	 */
	public function setLibelleTrimestre ($libelleTrimestre) {
		$this->libelleTrimestre = $libelleTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getDateDebutTrimeste () {
		return $this->dateDebutTrimeste;
	}

	/**
	 * @param mixed $dateDebutTrimeste
	 */
	public function setDateDebutTrimeste ($dateDebutTrimeste) {
		$this->dateDebutTrimeste = $dateDebutTrimeste;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinTrimestre () {
		return $this->dateFinTrimestre;
	}

	/**
	 * @param mixed $dateFinTrimestre
	 */
	public function setDateFinTrimestre ($dateFinTrimestre) {
		$this->dateFinTrimestre = $dateFinTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinCommentaire () {
		return $this->dateFinCommentaire;
	}

	/**
	 * @param mixed $dateFinCommentaire
	 */
	public function setDateFinCommentaire ($dateFinCommentaire) {
		$this->dateFinCommentaire = $dateFinCommentaire;
	}


}