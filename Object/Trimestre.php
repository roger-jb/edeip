<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:30
 */
class Trimestre extends FormatDate{
	protected $idTrimestre;
	protected $libelleTrimestre;
	protected $dateDebutTrimestre;
	protected $dateFinTrimestre;
	protected $dateFinCommentaire;

	public function toArray(){
		$return = array();
		$return['idTrimestre'] = $this->getIdTrimestre();
		$return['libelleTrimestre'] = $this->getLibelleTrimestre();
		$return['dateDebutTrimestre'] = $this->afficheDateDebut();
		$return['dateFinTrimestre'] = $this->afficheDateFin();
		$return['dateFinCommentaire'] = $this->afficheDateFinCommentaire();
		return $return;
	}

    public static function getAll(){
        $query = "SELECT * FROM TRIMESTRE";
        $result = db_connect::query($query);
        $return = array();
        while($info = $result->fetch_object('Trimestre')){
            $return[] =$info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idTrimestre){
        $query = "SELECT * FROM TRIMESTRE WHERE idTrimestre = $idTrimestre";
        $result = db_connect::query($query);
        $return = new Trimestre();
        if ($result->num_rows == 1){
            $return = $result->fetch_object('Trimestre');
        }
        $result->close();
	    return $return;
    }

	public function afficheDateDebut(){
		return $this->affiche($this->getDateDebutTrimestre());
	}

	public function afficheDateFin(){
		return $this->affiche($this->getDateFinTrimestre());
	}

	public function afficheDateFinCommentaire(){
		return $this->affiche($this->getDateFinCommentaire());
	}

	/**
	 * @return mixed
	 */
	public function getIdTrimestre () {
		return $this->idTrimestre;
	}

	/**
	 * @param mixed $idTrimestre
	 */
	public function setIdTrimestre ($idTrimestre) {
		$this->idTrimestre = $idTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getLibelleTrimestre () {
		return $this->libelleTrimestre;
	}

	/**
	 * @param mixed $libelleTrimestre
	 */
	public function setLibelleTrimestre ($libelleTrimestre) {
		$this->libelleTrimestre = $libelleTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getDateDebutTrimestre () {
		return $this->dateDebutTrimestre;
	}

	/**
	 * @param mixed $dateDebutTrimestre
	 */
	public function setDateDebutTrimestre ($dateDebutTrimestre) {
		$this->dateDebutTrimestre = $dateDebutTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinTrimestre () {
		return $this->dateFinTrimestre;
	}

	/**
	 * @param mixed $dateFinTrimestre
	 */
	public function setDateFinTrimestre ($dateFinTrimestre) {
		$this->dateFinTrimestre = $dateFinTrimestre;
	}

	/**
	 * @return mixed
	 */
	public function getDateFinCommentaire () {
		return $this->dateFinCommentaire;
	}

	/**
	 * @param mixed $dateFinCommentaire
	 */
	public function setDateFinCommentaire ($dateFinCommentaire) {
		$this->dateFinCommentaire = $dateFinCommentaire;
	}

	public function insert(){
		$query = "INSERT INTO TRIMESTRE (libelleTrimestre, dateDebutTrimestre, dateFinTrimestre, dateFinCommentaire) VALUES (".
			"'".db_connect::escape_string($this->getLibelleTrimestre())."', ".
			"'".$this->SQLdateDebutTrimestre()."', ".
			"'".$this->SQLdateFinTrimestre()."', ".
			"'".$this->SQLdateFinCommentaire()."'".
			")";
		if (db_connect::query($query)){
			$select = "SELECT idTrimestre FROM TRIMESTRE WHERE ".
				"libelleTrimestre = '".db_connect::escape_string($this->getLibelleTrimestre())."' AND ".
				"dateDebutTrimestre = '".$this->SQLdateDebutTrimestre()."' AND ".
				"dateFinTrimestre = '".$this->SQLdateFinTrimestre()."' AND ".
				"dateFinCommentaire = '".$this->SQLdateFinCommentaire()."'";
			$result = db_connect::query($select);
			if ($result->num_rows == 1){
				$info = $result->fetch_assoc();
				$this->setIdTrimestre($info['idTrimestre']);
				$result->close();
				return true;
			}
		}
		return false;
	}

	public function update(){
		$query = "UPDATE TRIMESTRE SET ".
			"libelleTrimestre = '".db_connect::escape_string($this->getLibelleTrimestre())."', ".
			"dateDebutTrimestre = '".$this->SQLdateDebutTrimestre()."', ".
			"dateFinTrimestre = '".$this->SQLdateFinTrimestre()."', ".
			"dateFinCommentaire = '".$this->SQLdateFinCommentaire()."'".
			"WHERE idTrimestre = ".$this->getIdTrimestre();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function delete(){
		$query = "DELETE FROM TRIMESTRE WHERE idTrimestre = ".$this->getIdTrimestre();
		if (db_connect::query($query))
			return true;
		return false;
	}

	public function SQLdateDebutTrimestre(){
		return $this->SQL($this->getDateDebutTrimestre());
	}
	public function SQLdateFinTrimestre(){
		return $this->SQL($this->getDateFinTrimestre());
	}
	public function SQLdateFinCommentaire(){
		return $this->SQL($this->getDateFinCommentaire());
	}
}