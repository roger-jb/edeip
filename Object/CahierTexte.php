<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:58
 */
class CahierTexte extends FormatDate{
	protected $idCahierTexte;
	protected $idMatiereNiveau;
	protected $dateRealisation;
	protected $contenuCahierTexte;
	protected $idRedacteur;
	protected $dateRedaction;

	public static function getByMaiereNiveauDateCritere($IdMatiereNiveau, $dateChoisi, $critereDate){
		$tmp = new CahierTexte();
		$tmp->setDateRealisation($dateChoisi);
		switch ($critereDate){
			case 'PourLe':
				$query = "SELECT * FROM CAHIER_TEXTE WHERE idMatiereNiveau = $IdMatiereNiveau AND dateRealisation LIKE '".$tmp->SQLdateRealisation()."%' ORDER BY dateRealisation DESC";
				break;
			case 'aPartirDu':
				$query = "SELECT * FROM CAHIER_TEXTE WHERE idMatiereNiveau = $IdMatiereNiveau AND dateRealisation > ".$tmp->SQLdateRealisation()." ORDER BY dateRealisation DESC";
				break;
			default:
				$query = "SELECT * FROM CAHIER_TEXTE ORDER BY dateRealisation DESC";
		}
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('CahierTexte')){
			$return[] = $info;
		}
		return $return;
	}

	public function getMatiereNiveau(){
		return MatiereNiveau::getById($this->getIdMatiereNiveau());
	}

	public function getRedacteur(){
		return Utilisateur::getById($this->getIdRedacteur());
	}

	public static function getAll(){
		$query = "SELECT * FROM CAHIER_TEXTE ORDER BY dateRealisation DESC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('CahierTexte')){
			$return[] = $info;
		}
		return $return;
	}

	public static function getById($idCahierTexte){
		$query = "SELECT * FROM CAHIER_TEXTE WHERE idCahierTexte = $idCahierTexte";

		$result = db_connect::query($query);
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
	public function getIdMatiereNiveau () {
		return $this->idMatiereNiveau;
	}

	/**
	 * @param $idMatiereNiveau
	 */
	public function setIdMatiereNiveau ($idMatiereNiveau) {
		$this->idMatiereNiveau = $idMatiereNiveau;
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

	public function afficheDateRealisation(){
		return $this->affiche($this->getDateRealisation());
	}

	public function SQLdateRealisation(){
		return $this->SQL($this->getDateRealisation());
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

	public function afficheDateRedaction(){
		return $this->affiche($this->getDateRedaction());
	}

	public function SQLdateRedaction(){
		return $this->SQL($this->getDateRedaction());
	}

	public function insert(){
		$query = "INSERT INTO CAHIER_TEXTE (".
			"idMatiereNiveau, dateRealisation, contenuCahierTexte, idRedacteur, dateRedaction".
			") VALUES (".
			$this->getIdMatiereNiveau().", ".
			"'".$this->SQLdateRealisation()."', ".
			"'".db_connect::escape_string($this->getContenuCahierTexte())."', ".
			$this->getIdRedacteur().", ".
			"'".$this->SQLdateRedaction()."'".
			")";
		if (db_connect::query($query)){
			$query2 = "SELECT idCahierTexte FROM CAHIER_TEXTE WHERE ".
				"idMatiereNiveau = ".$this->getIdMatiereNiveau()." AND ".
				"idRedacteur = ".$this->getIdRedacteur()." AND ".
				"dateRedaction = '".$this->SQLdateRedaction()."' AND ".
				"dateRealisation = '".$this->SQLdateRealisation()."' AND ".
				"contenuCahierTexte = '".db_connect::escape_string($this->getContenuCahierTexte())."'";
			$result = db_connect::query($query2);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdCahierTexte($info['idCahierTexte']);
				$result->close();
				return true;
			}
		}
		return false;
	}

	public function update(){
		$query = "UPDATE CAHIER_TEXTE SET ".
			"idMatiereNiveau = ".$this->getIdMatiereNiveau()." , ".
			"idRedacteur = ".$this->idRedacteur." , ".
			"dateRedaction = '".$this->SQLdateRedaction()."' , ".
			"dateRealisation = '".$this->SQLdateRealisation()."' , ".
			"contenuCahierTexte = '".db_connect::escape_string($this->getContenuCahierTexte())."' ".
			"WHERE idCahierTexte = ".$this->getIdCahierTexte();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM CAHIER_TEXTE WHERE idCahierTexte = ".$this->getIdCahierTexte();
		if (db_connect::query($query))
			return true;
		return false;
	}
}