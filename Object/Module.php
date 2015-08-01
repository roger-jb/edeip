<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:37
 */
class Module {
	protected $idModule;
	protected $libelleModule;

	public static function getAll(){
		$query = "SELECT * FROM MODULE";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while ($info = $result->fetch_object('Module')){
			$return[] = $info;
		}
		return $return;
	}

	public static function getById($idModule){
		$query = "SELECT * FROM MODULE WHERE idModule = $idModule";
		$result = db_connect::getInstance()->query($query);
		$return = new Module();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('Module');
		}
		return $return;
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

	/**
	 * @return mixed
	 */
	public function getLibelleModule () {
		return $this->libelleModule;
	}

	/**
	 * @param mixed $libelleModule
	 */
	public function setLibelleModule ($libelleModule) {
		$this->libelleModule = $libelleModule;
	}

	public function insert(){
		$query = "INSERT INTO MODULE (libelleModule) VALUES (".
			"'".db_connect::escape_string($this->getLibelleModule())."'".
			")";
		if (db_connect::query($query)){
			$select = "SELECT idModule WHERE ".
				"libelleModule = '".$this->getLibelleModule()."'";
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdModule($info['idModule']);
				$result->close();
				return true;
			}
			//db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		$query = "UPDATE MODULE SET libelleModule = '".$this->getLibelleModule()."' WHERE idModule = ".$this->getIdModule();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM MODULE WHERE idModule = ".$this->getIdModule();
		if (db_connect::query($query))
			return true;
		return false;
	}
}