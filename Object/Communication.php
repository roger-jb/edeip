<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:55
 */
class Communication {
	protected $idCommunication;
	protected $contenuCommunication;
	protected $idRedacteur;
	protected $dateRedaction;

	public static function getAll(){
		$query = "SELECT * FROM COMMUNICATION ORDER BY dateRedaction DESC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('Communication')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idCommunication){
		$query = "SELECT * FROM COMMUNICATION WHERE idCommunication = $idCommunication";
		$result = db_connect::query($query);
		$return = new Communication();
		if ($result->num_rows ==1){
			$return = $result->fetch_object('Communication');
		}
		$result->close();
		return $return;
	}

	public function getRedacteur(){
		return Utilisateur::getById($this->getIdRedacteur());
	}

	/**
	 * @return mixed
	 */
	public function getIdCommunication () {
		return $this->idCommunication;
	}

	/**
	 * @param mixed $idCommunication
	 */
	public function setIdCommunication ($idCommunication) {
		$this->idCommunication = $idCommunication;
	}

	/**
	 * @return mixed
	 */
	public function getContenuCommunication () {
		return $this->contenuCommunication;
	}

	/**
	 * @param mixed $contenuCommunication
	 */
	public function setContenuCommunication ($contenuCommunication) {
		$this->contenuCommunication = $contenuCommunication;
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

	public function insert(){
		$query = "INSERT INTO COMMUNICATION (".
			"contenuCommunication, idRedacteur, dateRedaction"
			.") VALUES (".
			"'".db_connect::escape_string($this->getContenuCommunication())."', ".
			"".$this->getIdRedacteur().", ".
			"'".$this->getDateRedaction()."'"
			.")";
		if (db_connect::query($query)){
			$query2 = "SELECT idCommunication FROM COMMUNICATION WHERE ".
				"contenuCommunication = '".db_connect::escape_string($this->getContenuCommunication())."' AND ".
				"idRedacteur = ".$this->getIdRedacteur()." AND ".
				"dateRedaction = '".$this->getDateRedaction()."'";
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdCommunication($info['idCommunication']);
				$result->close();
				return true;
			}
		}
		//db_connect::getInstance()->rollback();
		return false;
	}

	public function update(){
		return false;
	}

	public function delete(){
		$query = "DELETE FROM COMMUNICATION WHERE idCommunication = ".$this->idCommunication;
		if (db_connect::query($query))
			return true;
	}
}