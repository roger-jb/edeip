<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:58
 */

class Bulletin {
	protected $idBulletin;
	protected $contenuBulletin;
	protected $idEleve;
	protected $idMatiereNiveau;
	protected $dateRedacton;

	public function toArray(){
		$return = array();
		$return['idBulletin'] = $this->getIdBulletin();
		$return['contenuBulletin'] = $this->getContenuBulletin();
		$return['idEleve'] = $this->getIdEleve();
		$return['Eleve'] = $this->getEleve()->toArray();
		$return['idMatiereNiveau'] = $this->getIdMatiereNiveau();
		$return['MatiereNiveau'] = $this->getMatiereNiveau()->toArray();
		$return['dateRedaction'] = $this->getDateRedacton();

		return $return;
	}

	public static function getById($idBulletin){
		$query = "SELECT * FROM BULLETIN WHERE idBulletin = $idBulletin";

		$result = db_connect::query($query);

		if ($result->num_rows != 1){
			return new Bulletin();
		}
		else{
			return $result->fetch_object('Bulletin');
		}

	}

	public static function getByEleve($idEleve){
		$query = "SELECT * FROM BULLETIN WHERE idEleve = $idEleve";

		$result = db_connect::query($query);
		$bulletins = array();
		while($bulletin = $result->fetch_object('Bulletin')){
			$bulletins[] = $bulletin;
		}
		return $bulletins;
	}

	public static function getByEleveMatiereNiveauTrimestre($idEleve, $idMatiereNiveau, $idTrimestre){
		if ($idTrimestre != 1){
		$query = "	SELECT B.* FROM BULLETIN B
					WHERE B.idEleve = $idEleve
					AND B.idMatiereNiveau = $idMatiereNiveau
					AND dateRedaction >= (SELECT T.dateFinCommentaire FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre - 1)
					AND dateRedaction <= (SELECT T.dateFinCommentaire FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)";
		}
		else {
			$query = "	SELECT B.* FROM BULLETIN B
					WHERE B.idEleve = $idEleve
					AND B.idMatiereNiveau = $idMatiereNiveau
					AND dateRedaction <= (SELECT T.dateFinCommentaire FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)";
		}
		$result = db_connect::query($query);
//echo $result->num_rows;


		if ($result->num_rows != 1){
			return new Bulletin();
		}
		else{
			return $result->fetch_object('Bulletin');
		}
	}

	public static function getMoyenneByEleveTrimestreMatiere($idEleve, $idTrimestre, $idMatiere){
		$query = "	SELECT SUM(n.note)/SUM(ev.maxEvaluation)*20 as moyenne
					FROM NOTE n, EVALUATION ev, MATIERE_NIVEAU MN
					WHERE n.idEvaluation = ev.idEvaluation
					AND ev.idMatiereNiveau = MN.idMatiereNiveau
					AND MN.idMatiere = $idMatiere
					AND n.idEleve = $idEleve
					AND ev.dateEvaluation >= (SELECT T.dateDebutTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)
					AND ev.dateEvaluation <= (SELECT T.dateFinTrimestre FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)";
		$result = db_connect::query($query);
		$info = $result->fetch_assoc();
		if (!is_null($info['moyenne'])){
			return number_format($info['moyenne'], 2, ',', ' ');
		}
		return '';
	}

	public static function getByEleveTrimestreMatiere($idEleve, $idTrimestre, $idMatiere){
		if ($idTrimestre != 1){
			$query = "	SELECT b.*
						FROM BULLETIN b, MATIERE_NIVEAU MN
						WHERE b.idMatiereNiveau = MN.idMatiereNiveau
						AND MN.idMatiere = $idMatiere
						AND b.idEleve = $idEleve
						AND dateRedaction >= (SELECT T.dateFinCommentaire FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre - 1)
						AND dateRedaction <= (SELECT T.dateFinCommentaire FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)";
		}
		else {
			$query = "	SELECT b.*
						FROM BULLETIN b, MATIERE_NIVEAU MN
						WHERE b.idMatiereNiveau = MN.idMatiereNiveau
						AND MN.idMatiere = $idMatiere
						AND b.idEleve = $idEleve
						AND dateRedaction <= (SELECT T.dateFinCommentaire FROM TRIMESTRE T WHERE T.idTrimestre = $idTrimestre)";
		}
		$result = db_connect::query($query);

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

	public function insert(){
		$query = "INSERT INTO BULLETIN (".
			"dateRedaction, contenuBulletin, idEleve, idMatiereNiveau ".
			")".
			"VALUES (".
			"'".$this->getDateRedacton()."',".
			" '".db_connect::escape_string($this->getContenuBulletin())."', ".
			$this->getIdEleve().", ".
			$this->getIdMatiereNiveau().
			")";
		if (!db_connect::query($query)){
			return false;
		}

		$query2 = "	SELECT * FROM BULLETIN
					WHERE dateRedaction = '" . $this->getDateRedacton() . "'
					AND idEleve = " . $this->getIdEleve() . "
					AND idMatiereNiveau = " . $this->getIdMatiereNiveau() . "
					AND contenuBulletin =  '".db_connect::escape_string($this->getContenuBulletin())."'";

		$result = db_connect::query($query2);
		if ($result->num_rows != 1){
			return false;
		}
		else{
			$ret = $result->fetch_object('Bulletin');
			$this->setIdBulletin($ret->getIdBulletin());
			return true;
		}

		return false;
	}

	public function delete(){
		$query = "DELETE FROM BULLETIN WHERE idBulletin = ".$this->getIdBulletin();
		if (db_connect::query($query)){
			return true;
		}
		return false;
	}

	public function update(){
		$query = "	UPDATE BULLETIN
					SET
					dateRedaction = '".$this->getDateRedacton()."',
					contenuBulletin = '".db_connect::escape_string($this->getContenuBulletin())."',
					idEleve = ".$this->getIdEleve().",
					idMatiereNiveau = ".$this->getIdMatiereNiveau()."
					WHERE idBulletin = ".$this->getIdBulletin();
		if (db_connect::query($query)){
			return true;
		}
		return false;
	}
}