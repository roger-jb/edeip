<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:58
 */

require_once('../include/db_connect.php');

class Bulletin {
	protected $idBulletin;
	protected $contenuBulletin;
	protected $idEleve;
	protected $idMatiereNiveau;
	protected $dateRedacton;

	public static function getById($idBulletin){
		$query = "SELECT * FROM BULLETIN WHERE idBulletin = $idBulletin";

		$result = db_connect::getInstance()->query($query);

		if ($result->num_rows != 1){
			return new Bulletin();
		}
		else{
			return $result->fetch_object('Bulletin');
		}

	}

	public static function getByEleve($idEleve){
		$query = "SELECT * FROM BULLETIN WHERE idEleve = $idEleve";

		$result = db_connect::getInstance()->query($query);
		$bulletins = array();
		while($bulletin = $result->fetch_object('Bulletin')){
			$bulletins[] = $bulletin;
		}
		return $bulletins;
	}

	public function getEleve(){
		return Eleve::getById($this->getIdEleve());
	}

	public function getMatiereNiveau(){
		return MatiereNiveau::getById($this->getIdMatiereNiveau());
	}

	/**
	 * @return mixed
	 */
	public function getIdBulletin () {
		return $this->idBulletin;
	}

	/**
	 * @param mixed $idBulletin
	 */
	public function setIdBulletin ($idBulletin) {
		$this->idBulletin = $idBulletin;
	}

	/**
	 * @return mixed
	 */
	public function getContenuBulletin () {
		return $this->contenuBulletin;
	}

	/**
	 * @param mixed $contenuBulletin
	 */
	public function setContenuBulletin ($contenuBulletin) {
		$this->contenuBulletin = $contenuBulletin;
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
	public function getDateRedacton () {
		return $this->dateRedacton;
	}

	/**
	 * @param mixed $dateRedacton
	 */
	public function setDateRedacton ($dateRedacton) {
		$this->dateRedacton = $dateRedacton;
	}


}