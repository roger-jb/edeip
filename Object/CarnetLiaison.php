<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:53
 */
class CarnetLiaison {
	protected $idCarnetLiaison;
	protected $contenuCarnetLiason;
	protected $idReponse;
	protected $idRedacteur;
	protected $dateRedaction;
	protected $idEleve;

    public static function getAll(){
        $query = "SELECT * FROM CARNET_LIAISON";
        $result = db_connect::getInstance()->query($query);
        $return = array();
        while ($info = $result->fetch_object('CarnetLiaison')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idCarnetLiaison){
        $query = "SELECT * FROM CARNET_LIAISON WHERE idCarnetLiaison = $idCarnetLiaison";
        $result = db_connect::getInstance()->query($query);
        $return = new CarnetLiaison();
        if ($result->num_rows == 1){
            $return = $result->fetch_object('CarnetLiaison');
        }
        $result->close();
        return $return;
    }

    public function getReponse(){
        return CarnetLiaison::getById($this->getIdReponse());
    }

    public function getRedacteur(){
        return Utilisateur::getById($this->getIdRedacteur());
    }

    public function getEleve(){
        return Eleve::getById($this->getIdEleve());
    }

	/**
	 * @return mixed
	 */
	public function getIdCarnetLiaison () {
		return $this->idCarnetLiaison;
	}

	/**
	 * @param mixed $idCarnetLiaison
	 */
	public function setIdCarnetLiaison ($idCarnetLiaison) {
		$this->idCarnetLiaison = $idCarnetLiaison;
	}

	/**
	 * @return mixed
	 */
	public function getContenuCarnetLiason () {
		return $this->contenuCarnetLiason;
	}

	/**
	 * @param mixed $contenuCarnetLiason
	 */
	public function setContenuCarnetLiason ($contenuCarnetLiason) {
		$this->contenuCarnetLiason = $contenuCarnetLiason;
	}

	/**
	 * @return mixed
	 */
	public function getIdReponse () {
		return $this->idReponse;
	}

	/**
	 * @param mixed $idReponse
	 */
	public function setIdReponse ($idReponse) {
		$this->idReponse = $idReponse;
	}

	/**
	 * @return mixed
	 */
	public function getIdRedacteur () {
		return $this->idRedacteur;
	}

	/**
	 * @param mixed $idRedacteur
	 */
	public function setIdRedacteur ($idRedacteur) {
		$this->idRedacteur = $idRedacteur;
	}

	/**
	 * @return mixed
	 */
	public function getDateRedaction () {
		return $this->dateRedaction;
	}

	/**
	 * @param mixed $dateRedaction
	 */
	public function setDateRedaction ($dateRedaction) {
		$this->dateRedaction = $dateRedaction;
	}

	/**
	 * @return mixed
	 */
	public function getIdEleve () {
		return $this->idEleve;
	}

	/**
	 * @param mixed $idEleve
	 */
	public function setIdEleve ($idEleve) {
		$this->idEleve = $idEleve;
	}

	public function insert(){
		$query = "INSERT INTO CARNET_LIAISON (".
			"contenuCarnetLiaison, idReponse, idRedacteur, dateRedaction, idEleve
			) VALUES (".
			"'".db_connect::escape_string($this->getContenuCarnetLiason())."', ".
			"".($this->getIdReponse()?$this->getIdReponse():'NULL').", ".
			"".$this->getIdRedacteur().", ".
			"'".$this->getDateRedaction()."', ".
			"".$this->getIdEleve().""
			.")";
		if (db_connect::query($query)){
			$query2 = "SELECT idCarnetLiaison FROM CARNET_LIAISON WHERE ".
				"contenuCarnetLiaison = '".db_connect::escape_string($this->getContenuCarnetLiason())."' AND ".
				"idReponse = ".($this->getIdReponse()?$this->getIdReponse():'NULL')." AND ".
				"idRedacteur = ".$this->getIdRedacteur()." AND ".
				"dateRedacation = '".$this->getDateRedaction()."' AND ".
				"idEleve = ".$this->getIdEleve()."";
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdCarnetLiaison($info['idCarntLiaison']);
				return true;
			}
		}
		return false;
	}

	public function update(){
		$query = "UPDATE CARNET_LIAISON SET ".
			"contenuCarnetLiaison = '".db_connect::escape_string($this->getContenuCarnetLiason())."', ".
			"idReponse = ".($this->getIdReponse()?$this->getIdReponse():'NULL').", ".
			"idRedacteur = ".$this->getIdRedacteur().", ".
			"dateRedacation = '".$this->getDateRedaction()."', ".
			"idEleve = ".$this->getIdEleve()."".
			"WHERE idCarnetLiaison = ".$this->getIdCarnetLiaison();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM CARNET_LIAISON WHERE idCarnetLiaison = ".$this->getIdCarnetLiaison();
		if (db_connect::query($query))
			return true;
		return false;
	}
}