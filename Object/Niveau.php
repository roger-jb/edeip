<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:36
 */
class Niveau {
	protected $idNiveau;
	protected $libelleNiveau;
	protected $idModule;

	public static function getById($idNiveau){
		$query = "SELECT * FROM NIVEAU WHERE idNiveau = $idNiveau";
		$result = db_connect::query($query);
		$return = new Niveau();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('Niveau');
		}
		$result->close();
		return $return;
	}

	public static function getAll(){
		$query = "SELECT * FROM NIVEAU";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('Niveau')){
			$return[] = $info;
		}
		return $return;
	}

	public function getModule(){
		return Module::getById($this->getIdModule());
	}

	/**
	 * @return mixed
	 */
	public function getIdNiveau () {
		return $this->idNiveau;
	}

	/**
	 * @param mixed $idNiveau
	 */
	public function setIdNiveau ($idNiveau) {
		$this->idNiveau = $idNiveau;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleNiveau () {
		return $this->libelleNiveau;
	}

	/**
	 * @param mixed $libelleNiveau
	 */
	public function setLibelleNiveau ($libelleNiveau) {
		$this->libelleNiveau = $libelleNiveau;
	}

	/**
	 * @return mixed
	 */
	public function getIdModule () {
		return $this->idModule;
	}

	/**
	 * @param mixed $idModule
	 */
	public function setIdModule ($idModule) {
		$this->idModule = $idModule;
	}

	public function insert(){
		$query = "INSERT INTO NIVEAU (libelleNiveau, idModule) VALUES (".
			"'".db_connect::escape_string($this->getLibelleNiveau())."', ".
			"".$this->getIdModule()."".
			")";
		if (db_connect::query($query)){
			$select = "SELECT idNiveau WHERE ".
				"libelleNiveau = '".db_connect::escape_string($this->getLibelleNiveau())."' AND ".
				"idModule = ".$this->getIdModule()."";
			$result = db_connect::query($select);
			if ($result->num_rows){
				$info = $result->fetch_assoc();
				$this->setIdNiveau($info['idNiveau']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		$query = "UPDATE NIVEAU SET ".
			"libelleNiveau = '".db_connect::escape_string($this->getLibelleNiveau())."', ".
			"idModule = ".$this->getIdModule()."".
			"WHERE idNiveau = ".$this->getIdNiveau();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM NIVEAU WHERE idNiveau = ".$this->getIdNiveau();
		if (db_connect::query($query))
			return true;
		return false;
	}
}