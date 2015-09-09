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
		$result = db_connect::query($query);
		$return = array();
		while($info = $result->fetch_object('ProfesseurMatiereNiveau')){
			$return[] = $info;
		}
		$result->close();
		return $return;
	}

	public static function getByProfesseurMatiereNiveau($idProfesseur, $idMatiereNiveau){
		$query = "SELECT * FROM PROFESSEUR_MATIERE_NIVEAU WHERE idProfesseur = $idProfesseur AND idMatiereNiveau = $idMatiereNiveau";
		$result = db_connect::query($query);
		$return = new ProfesseurMatiereNiveau();
		if ($result->num_rows == 1){
			$return = $result->fetch_object('ProfesseurMatiereNiveau');
		}
		$result->close();
		return $return;
	}

	public static function getById($idProfesseurMatiereNiveau){
		$query = "SELECT * FROM PROFESSEUR_MATIERE_NIVEAU WHERE idProfesseurMatiereNiveau = $idProfesseurMatiereNiveau";
		$result = db_connect::query($query);
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

	public function insert(){
		$query = "INSERT INTO PROFESSEUR_MATIERE_NIVEAU (idProfesseur, idMatiereNiveau) VALUES (".
			"".$this->getIdProfesseur().", ".
			"".$this->getIdMatiereNiveau()."".
			")";
		if (db_connect::query($query)){
			$select = "SELECT idProfesseurMatiereNiveau FROM PROFESSEUR_MATIERE_NIVEAU WHERE ".
				"idProfesseur = ".$this->getIdProfesseur()." AND ".
				"idMatiereNiveau = ".$this->getIdMatiereNiveau()."";
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdProfesseurMatiereNiveau($info['idProfesseurMatiereNiveau']);
				$result->close();
				return true;
			}
			// db_connect::getInstance()->rollback();
		}
		return false;
	}

	public function update(){
		// table de jointure, pas d'update
		return false;
	}

	public function delete(){
		$query = "DELETE FROM PROFESSEUR_MATIERE_NIVEAU WHERE idProfesseurMatiereNiveau = ".$this->getIdProfesseurMatiereNiveau();
		if (db_connect::query($query))
			return true;
		return false;
	}
}