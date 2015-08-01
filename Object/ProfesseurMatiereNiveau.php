<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 31/07/2015
 * Time: 08:54
 */

class ProfesseurMatiereNiveau {
	protected $idProfesseurMatiereNiveau;
	protected $idProfesseur;
	protected $idMatiereNiveau;

	public static function getAll(){
		$query = "SELECT * FROM PROFESSEUR_MATIERE_NIVEAU";
		$result = db_connect::getInstance()->query($query);
		$return = array();
		while($info = $result->fetch_object('ProfesseurMatiereNiveau')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getById($idProfesseurMatiereNiveau){
		$query = "SELECT * FROM PROFESSEUR_MATIERE_NIVEAU WHERE idProfesseurMatiereNiveau = $idProfesseurMatiereNiveau";
		$result = db_connect::getInstance()->query($query);
		$return = new ProfesseurMatiereNiveau();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('ProfesseurMatiereNiveau');
		}
		$result->close();
		return $return;
	}

	public function getProfesseur(){
		return Professeur::getById($this->getIdProfesseur());
	}

	public function getMatiereNiveau(){
		return MatiereNiveau::getById($this->getIdMatiereNiveau());
	}

	/**
	 * @return mixed
	 */
	public function getIdProfesseurMatiereNiveau () {
		return $this->idProfesseurMatiereNiveau;
	}

	/**
	 * @param mixed $idProfesseurMatiereNiveau
	 */
	public function setIdProfesseurMatiereNiveau ($idProfesseurMatiereNiveau) {
		$this->idProfesseurMatiereNiveau = $idProfesseurMatiereNiveau;
	}

	/**
	 * @return mixed
	 */
	public function getIdProfesseur () {
		return $this->idProfesseur;
	}

	/**
	 * @param mixed $idProfesseur
	 */
	public function setIdProfesseur ($idProfesseur) {
		$this->idProfesseur = $idProfesseur;
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


}