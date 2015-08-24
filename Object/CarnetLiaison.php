<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:53
 */
class CarnetLiaison {
	protected $idCarnetLiaison;
	protected $contenuCarnetLiaison;
	protected $idReponse;
	protected $idRedacteur;
	protected $dateRedaction;
	protected $idEleve;

    public static function getAll(){
        $query = "SELECT * FROM CARNET_LIAISON ORDER BY dateRedaction DESC";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('CarnetLiaison')){
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idCarnetLiaison){
        $query = "SELECT * FROM CARNET_LIAISON WHERE idCarnetLiaison = $idCarnetLiaison";
        $result = db_connect::query($query);
        $return = new CarnetLiaison();
        if ($result->num_rows == 1){
            $return = $result->fetch_object('CarnetLiaison');
        }
        $result->close();
        return $return;
    }

	public static function getByIdRedacteur($idRedacteur){
		$query = "SELECT * FROM CARNET_LIAISON WHERE idRedacteur = $idRedacteur OR idReponse IN (SELECT idCarnetLiaison FROM CARNET_LIAISON WHERE idRedacteur = $idRedacteur) ORDER BY dateRedaction DESC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('CarnetLiaison')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public function estReponse(){
		if (empty($this->getIdReponse())){
			return false;
		}
		return true;
	}

	public function toArray(){
		$return = array();
		$return['idCarnetLiaison'] = $this->getIdCarnetLiaison();
		$return['contenuCarnetLiaison'] = $this->getContenuCarnetLiaison();
		$return['idReponse'] = $this->getIdReponse();
		$return['idRedacteur'] = $this->getIdRedacteur();
		$return['dateRedaction'] = $this->getDateRedaction();
		$return['idEleve'] =  $this->getIdEleve();
		return $return;
	}

    public function getReponse(){
        return CarnetLiaison::getById($this->getIdReponse());
    }

	public function afficheDateRedaction(){
		$date = $this->getDateRedaction();
		if (strlen($date)>10){
			$date = explode('-', substr($date, 0, (strpos($date, ' ')>0?strpos($date, ' '):strlen($date))));
			return substr($date[2], 0, 2).'/'.$date[1].'/'.$date[0];
		}
		return substr($date, 0, (strpos(' ', $date)>0?strpos(' ', $date):strlen($date)));
	}

	private function sqlDateRedaction(){
		$date = $this->getDateRedaction();
		if (strpos($date, '/') > 0){
			$date = explode('/', $date);
			return $date[2].'-'.$date[1].'-'.$date[0];
		}
		return $date;

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
	public function getContenuCarnetLiaison () {
		return $this->contenuCarnetLiaison;
	}

	/**
	 * @param mixed $contenuCarnetLiaison
	 */
	public function setContenuCarnetLiaison ($contenuCarnetLiaison) {
		$this->contenuCarnetLiaison = $contenuCarnetLiaison;
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
			"'".db_connect::escape_string($this->getContenuCarnetLiaison())."', ".
			"".($this->getIdReponse()?$this->getIdReponse():'NULL').", ".
			"".$this->getIdRedacteur().", ".
			"'".$this->sqlDateRedaction()."', ".
			"".$this->getIdEleve().""
			.")";
		if (db_connect::query($query)){
			$query2 = "SELECT idCarnetLiaison FROM CARNET_LIAISON WHERE ".
				"contenuCarnetLiaison = '".db_connect::escape_string($this->getContenuCarnetLiaison())."' AND ".
				"idReponse = ".($this->getIdReponse()?$this->getIdReponse():'NULL')." AND ".
				"idRedacteur = ".$this->getIdRedacteur()." AND ".
				"dateRedaction = '".$this->sqlDateRedaction()."' AND ".
				"idEleve = ".$this->getIdEleve()."";
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdCarnetLiaison($info['idCarnetLiaison']);
				return true;
			}
		}
		return false;
	}

	public function update(){
		$query = "UPDATE CARNET_LIAISON SET ".
			"contenuCarnetLiaison = '".db_connect::escape_string($this->getContenuCarnetLiaison())."', ".
			"idReponse = ".($this->getIdReponse()?$this->getIdReponse():'NULL').", ".
			"idRedacteur = ".$this->getIdRedacteur().", ".
			"dateRedacation = '".$this->sqlDateRedaction()."', ".
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