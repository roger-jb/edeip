<?php

require_once('../Object/Module.php');

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
		$result = db_connect::getInstance()->query($query);
		$return = new Niveau();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('Niveau');
		}
		$result->close();
		return $return;
	}

	public static function getAll(){
		$query = "SELECT * FROM NIVEAU";
		$result = db_connect::getInstance()->query($query);
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


}