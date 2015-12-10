<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/07/2015
 * Time: 10:38
 */
/*
 * TODO
 *
 * getCarnetLiaison
 * getCommunication
 * getAbsence
 * getCahierTexte
 *
 */

class Utilisateur extends FormatDate {
	protected $idUtilisateur;
	protected $nomUtilisateur;
	protected $prenomUtilisateur;
	protected $adr1Utilisateur;
	protected $adr2Utilisateur;
	protected $cpUtilisateur;
	protected $villeUtilisateur;
	protected $actifUtilisateur;
	protected $mailUtilisateur;
	protected $dateNaissanceUtilisateur;
	protected $dateInscriptionUtilisateur;

	public function toArray() {
		$return                               = array();
		$return['idUtilisateur']              = $this->getIdUtilisateur();
		$return['nomUtilisateur']             = $this->getNomUtilisateur();
		$return['prenomUtilisateur']          = $this->getPrenomUtilisateur();
		$return['libelleUtilisateur']		  = $this->getLibelleUtilisatur();
		$return['adr1Utilisateur']            = $this->getAdr1Utilisateur();
		$return['adr2Utilisateur']            = $this->getAdr2Utilisateur();
		$return['cpUtilisateur']              = $this->getCpUtilisateur();
		$return['villeUtilisateur']           = $this->getVilleUtilisateur();
		$return['actifUtilisateur']           = $this->getActifUtilisateur();
		$return['mailUtilisateur']            = $this->getMailUtilisateur();
		$return['dateNaissanceUtilisateur']   = $this->getDateNaissanceUtilisateur();
		$return['dateInscriptionUtilisateur'] = $this->getDateInscriptionUtilisateur();
		return $return;
	}

	public function estAdministrateur() {
		$query  = "SELECT * FROM ADMINISTRATION WHERE idAdministration = " . $this->idUtilisateur;
		$result = db_connect::query($query);
		if ($result->num_rows == 1) {
			$result->close();
			return TRUE;
		}
		$result->close();
		return FALSE;
	}

	public function estEleve() {
		$query  = "SELECT * FROM ELEVE WHERE idEleve = " . $this->idUtilisateur;
		$result = db_connect::query($query);
		if ($result->num_rows == 1) {
			$result->close();
			return TRUE;
		}
		$result->close();
		return FALSE;
	}

	public function estProfesseur() {
		$query  = "SELECT * FROM PROFESSEUR WHERE idProfesseur = " . $this->idUtilisateur;
		$result = db_connect::query($query);
		if ($result->num_rows == 1) {
			$result->close();
			return TRUE;
		}
		$result->close();
		return FALSE;
	}

	public function estResponsable() {
		$query  = "SELECT * FROM RESPONSABLE WHERE idResponsable = " . $this->idUtilisateur;
		$result = db_connect::query($query);
		if ($result->num_rows == 1) {
			$result->close();
			return TRUE;
		}
		$result->close();
		return FALSE;
	}

	public static function getById($id) {
		if (!is_numeric($id)) {
			return new Utilisateur();
		}
		$query = "SELECT * FROM UTILISATEUR WHERE idUtilisateur = $id";

		$result = db_connect::query($query);

		if ($result->num_rows == 1) {
			$return = $result->fetch_object('Utilisateur');
			$result->close();
			return $return;
		}
		else {
			$result->close();
			return new Utilisateur();
		}
	}

	public static function getAll() {
		$query  = "SELECT * FROM UTILISATEUR ORDER BY nomUtilisateur ASC, prenomUtilisateur ASC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('Utilisateur')) {
			$return[] = $info;
		}
		return $return;
	}

	public static function getAllActif() {
		$query  = "SELECT * FROM UTILISATEUR WHERE actifUtilisateur = 1 ORDER BY nomUtilisateur ASC, prenomUtilisateur ASC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('Utilisateur')) {
			$return[] = $info;
		}
		return $return;
	}

	public static function getAllInactif() {
		$query  = "SELECT * FROM UTILISATEUR WHERE actifUtilisateur = 0 ORDER BY nomUtilisateur ASC, prenomUtilisateur ASC";
		$result = db_connect::query($query);
		$return = array();
		while ($info = $result->fetch_object('Utilisateur')) {
			$return[] = $info;
		}
		return $return;
	}

	/**
	 * @return mixed
	 */
	public function getIdUtilisateur() {
		return $this->idUtilisateur;
	}

	/**
	 * @param mixed $idUtilisateur
	 */
	public function setIdUtilisateur($idUtilisateur) {
		$this->idUtilisateur = $idUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getNomUtilisateur() {
		return $this->nomUtilisateur;
	}

	/**
	 * @param mixed $nomUtilisateur
	 */
	public function setNomUtilisateur($nomUtilisateur) {
		$this->nomUtilisateur = mb_convert_case($nomUtilisateur, MB_CASE_UPPER, "UTF-8");
	}

	public function getLibelleUtilisatur() {
		return $this->getNomUtilisateur() . ' ' . $this->getPrenomUtilisateur();
	}

	/**
	 * @return mixed
	 */
	public function getPrenomUtilisateur() {
		return $this->prenomUtilisateur;
	}

	/**
	 * @param mixed $prenomUtilisateur
	 */
	public function setPrenomUtilisateur($prenomUtilisateur) {

		$prenom = explode('-', trim($prenomUtilisateur));
		foreach ($prenom as $key => $p) {
			$prenom[$key] = mb_convert_case($p, MB_CASE_TITLE, "UTF-8");
		}
		$prenomUtilisateur = implode('-', $prenom);

		$this->prenomUtilisateur = $prenomUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getAdr1Utilisateur() {
		return $this->adr1Utilisateur;
	}

	/**
	 * @param mixed $adr1Utilisateur
	 */
	public function setAdr1Utilisateur($adr1Utilisateur) {
		$this->adr1Utilisateur = $adr1Utilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getAdr2Utilisateur() {
		return $this->adr2Utilisateur;
	}

	/**
	 * @param mixed $adr2Utilisateur
	 */
	public function setAdr2Utilisateur($adr2Utilisateur) {
		$this->adr2Utilisateur = $adr2Utilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getCpUtilisateur() {
		return $this->cpUtilisateur;
	}

	/**
	 * @param mixed $cpUtilisateur
	 */
	public function setCpUtilisateur($cpUtilisateur) {
		$this->cpUtilisateur = $cpUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getVilleUtilisateur() {
		return $this->villeUtilisateur;
	}

	/**
	 * @param mixed $villeUtilisateur
	 */
	public function setVilleUtilisateur($villeUtilisateur) {
		$this->villeUtilisateur = $villeUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getActifUtilisateur() {
		return $this->actifUtilisateur;
	}

	/**
	 * @param mixed $actifUtilisateur
	 */
	public function setActifUtilisateur($actifUtilisateur) {
		$this->actifUtilisateur = $actifUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getMailUtilisateur() {
		return $this->mailUtilisateur;
	}

	/**
	 * @param mixed $mailUtilisateur
	 */
	public function setMailUtilisateur($mailUtilisateur) {
		$this->mailUtilisateur = $mailUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getDateNaissanceUtilisateur() {
		return $this->dateNaissanceUtilisateur;
	}

	/**
	 * @param mixed $dateNaissanceUtilisateur
	 */
	public function setDateNaissanceUtilisateur($dateNaissanceUtilisateur) {
		$this->dateNaissanceUtilisateur = $dateNaissanceUtilisateur;
	}

	/**
	 * @return mixed
	 */
	public function getDateInscriptionUtilisateur() {
		return $this->dateInscriptionUtilisateur;
	}

	/**
	 * @param mixed $dateInscriptionUtilisateur
	 */
	public function setDateInscriptionUtilisateur($dateInscriptionUtilisateur) {
		$this->dateInscriptionUtilisateur = $dateInscriptionUtilisateur;
	}

	public function insert() {
		$query = "INSERT INTO UTILISATEUR (nomUtilisateur, prenomUtilisateur, adr1Utilisateur, adr2Utilisateur, cpUtilisateur, villeUtilisateur, actifUtilisateur, mailUtilisateur, dateNaissanceUtilisateur, dateInscriptionUtilisateur) VALUES (" .
			"'" . db_connect::escape_string(trim($this->getNomUtilisateur())) . "', " .
			"'" . db_connect::escape_string(trim($this->getPrenomUtilisateur())) . "', " .
			"'" . db_connect::escape_string(trim($this->getAdr1Utilisateur())) . "', " .
			"'" . db_connect::escape_string(trim($this->getAdr2Utilisateur())) . "', " .
			"'" . db_connect::escape_string(trim($this->getCpUtilisateur())) . "', " .
			"'" . db_connect::escape_string(trim($this->getVilleUtilisateur())) . "', " .
			($this->getActifUtilisateur() ? 'true' : 'false') . ", " .
			"'" . db_connect::escape_string(trim($this->getMailUtilisateur())) . "', " .
			"'" . db_connect::escape_string(trim($this->getDateNaissanceUtilisateur())) . "', " .
			"'" . db_connect::escape_string(trim($this->getDateInscriptionUtilisateur())) . "'"
			. ")";
		if (db_connect::query($query)) {
			$query2 = "SELECT idUtilisateur FROM UTILISATEUR WHERE " .
				" nomUtilisateur = '" . db_connect::escape_string(trim($this->getNomUtilisateur())) . "' " .
				" AND prenomUtilisateur = '" . db_connect::escape_string(trim($this->getPrenomUtilisateur())) . "' " .
				" AND adr1Utilisateur = '" . db_connect::escape_string(trim($this->getAdr1Utilisateur())) . "' " .
				" AND adr2Utilisateur = '" . db_connect::escape_string(trim($this->getAdr2Utilisateur())) . "' " .
				" AND cpUtilisateur = '" . db_connect::escape_string(trim($this->getCpUtilisateur())) . "' " .
				" AND villeUtilisateur = '" . db_connect::escape_string(trim($this->getVilleUtilisateur())) . "' " .
				" AND actifUtilisateur = " . ($this->getActifUtilisateur() ? 'true' : 'false') . " " .
				" AND mailUtilisateur = '" . db_connect::escape_string(trim($this->getMailUtilisateur())) . "' " .
				" AND dateNaissanceUtilisateur = '" . db_connect::escape_string(trim($this->getDateNaissanceUtilisateur())) . "' " .
				" AND dateInscriptionUtilisateur = '" . db_connect::escape_string(trim($this->getDateInscriptionUtilisateur())) . "'";
			$result = db_connect::query($query2);
			if ($result->num_rows == 1) {
				$info = $result->fetch_assoc();
				$this->setIdUtilisateur($info['idUtilisateur']);
				$result->close();

				$connexion = new Connexion();
				$connexion->setIdUtilisateur($this->getIdUtilisateur());
				$connexion->setLoginUtilisateur($this->getNomUtilisateur() . '.' . $this->getPrenomUtilisateur());
				$connexion->setMdpUtilisateur('123Soleil');
				$connexion->insert();
				return TRUE;
			}
			$result->close();
			return FALSE;
		}
		return FALSE;
	}

	public function update() {
		$query = "UPDATE UTILISATEUR SET " .
			" nomUtilisateur = '" . db_connect::escape_string(trim($this->getNomUtilisateur())) . "', " .
			" prenomUtilisateur = '" . db_connect::escape_string(trim($this->getPrenomUtilisateur())) . "', " .
			" adr1Utilisateur = '" . db_connect::escape_string(trim($this->getAdr1Utilisateur())) . "', " .
			" adr2Utilisateur = '" . db_connect::escape_string(trim($this->getAdr2Utilisateur())) . "', " .
			" cpUtilisateur = '" . db_connect::escape_string(trim($this->getCpUtilisateur())) . "', " .
			" villeUtilisateur = '" . db_connect::escape_string(trim($this->getVilleUtilisateur())) . "', " .
			" actifUtilisateur = " . ($this->getActifUtilisateur() ? 'true' : 'false') . ", " .
			" mailUtilisateur = '" . db_connect::escape_string(trim($this->getMailUtilisateur())) . "', " .
			" dateNaissanceUtilisateur = '" . db_connect::escape_string(trim($this->getDateNaissanceUtilisateur())) . "', " .
			" dateInscriptionUtilisateur = '" . db_connect::escape_string(trim($this->getDateInscriptionUtilisateur())) . "'" .
			" WHERE idUtilisateur = " . $this->getIdUtilisateur();
		if (db_connect::query($query)) {
			$connexion = Connexion::getById($this->getIdUtilisateur());
			if (empty($connexion->getIdUtilisateur()))
				$connexion->setIdUtilisateur($this->getIdUtilisateur());
			$connexion->setLoginUtilisateur($this->getNomUtilisateur() . '.' . $this->getPrenomUtilisateur());
			if (empty($connexion->getMdpUtilisateur()))
				$connexion->setMdpUtilisateur('123Soleil');
			return $connexion->update();
		}
		return FALSE;
	}

	public function delete() {
		/*$query = "DELETE FROM UTILISATEUR WHERE idUtilisateur = ".$this->getIdUtilisateur();
		return db_connect::query($query);*/
		$this->setActifUtilisateur(FALSE);
		$this->update();
	}

	public function activer() {
		$this->setActifUtilisateur(TRUE);
		$this->update();
	}

	public function desactiver() {
		$this->delete();
	}
}

function _ucwords($txt) {
	return preg_replace_callback('#\\W\\w#', '_ucwords_callback', ucfirst(strtolower($txt)));
}

function _ucwords_callback($m) {
	return strtoupper($m[0]);
}

