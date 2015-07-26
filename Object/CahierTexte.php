<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:58
 */
class CahierTexte {
	protected $idCahierTexte;
	protected $idNiveau;
	protected $dateRealisation;
	protected $contenuCahierTexte;
	protected $idRedacteur;
	protected $dateRedaction;

	public function getNiveau(){
		return Niveau::getById($this->getIdNiveau());
	}

	public function getRedacteur(){
		return Utilisateur::getById($this->getIdRedacteur());
	}

	public static function getAll(){
		$query = "SELECT * FROM CAHIER_TEXTE ORDER BY dateRealisation DESC";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while ($info = $result->fetch_object('CahierTexte')){
			$return[] = $info;
		}
		return $return;
	}

	public static function getById($idCahierTexte){
		$query = "SELECT * FROM CAHIER_TEXTE WHERE idCahierTexte = $idCahierTexte";

		$result = db_connect::getInstance()->query($query);
		$return = new CahierTexte();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('CahierTexte');
		}
		$result->close();
		return $return;
	}

	/**
	 * @return mixed
	 */
	public function getIdCahierTexte () {
		return $this->idCahierTexte;
	}

	/**
	 * @param mixed $idCahierTexte
	 */
	public function setIdCahierTexte ($idCahierTexte) {
		$this->idCahierTexte = $idCahierTexte;
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
	public function getDateRealisation () {
		return $this->dateRealisation;
	}

	/**
	 * @param mixed $dateRealisation
	 */
	public function setDateRealisation ($dateRealisation) {
		$this->dateRealisation = $dateRealisation;
	}

	/**
	 * @return mixed
	 */
	public function getContenuCahierTexte () {
		return $this->contenuCahierTexte;
	}

	/**
	 * @param mixed $contenuCahierTexte
	 */
	public function setContenuCahierTexte ($contenuCahierTexte) {
		$this->contenuCahierTexte = $contenuCahierTexte;
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


}