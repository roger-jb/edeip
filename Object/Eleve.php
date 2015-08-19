<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:45
 */

/**
 * Class Eleve
 */
class Eleve extends Utilisateur {
	protected $idNiveau;

	public static function getAll () {
		$parents = parent::getAll();
		$return = array ();
		foreach ($parents as $parent) {
			if ($parent->estEleve())
				$return[] = Eleve::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getAllActif () {
		$parents = parent::getAllActif();
		$return = array ();
		foreach ($parents as $parent) {
			if ($parent->estEleve())
				$return[] = Eleve::getById($parent->getIdUtilisateur());
		}
		return $return;
	}

	public static function getById ($idEleve) {
		$parent = parent::getById($idEleve);
		$eleve = new Eleve();

		foreach ($parent as $attr => $value) {
			$eleve->{'set' . $attr}($value);
		}

		$query = "SELECT * FROM ELEVE WHERE idEleve = " . $eleve->getIdEleve();
		$result = db_connect::query($query);
		$info = $result->fetch_assoc();

		$eleve->setIdNiveau($info['idNiveau']);

		return $eleve;
	}

	public function getResponsables () {
		$query = "SELECT * FROM ELEVE_RESPONSABLE WHERE idEleve = " . $this->getIdEleve();
		$result = db_connect::query($query);
		$return = array ();
		if ($result->num_rows > 0) {
			while ($info = $result->fetch_object('EleveResponsable')) {
				$return[] = $info->getResponsable();
			}
		}
		return $return;
	}

	public function setResponsable ($idResponsable) {
		$responsables = $this->getResponsables();

		$exist = FALSE;
		foreach ($responsables as $resp) {
			if ($resp->getIdResponsable == $idResponsable) {
				$exist = TRUE;
			}
		}
		if (!$exist) {
			$query = "INSERT INTO ELEVE_RESPONSABLE (idEleve, idResponsable) VALUES (" . $this->getIdEleve() . ", $idResponsable)";
			db_connect::query($query);

		}
	}

	public function getNiveau () {
		$query = "SELECT n.* FROM NIVEAU n, ELEVE e WHERE n.idNiveau = e.idNiveau AND e.idEleve " . $this->getIdEleve();
		$result = db_connect::query($query);
		return $result->fetch_object('Niveau');
	}


	/**
	 * @return mixed
	 */
	public function getIdEleve () {
		return $this->getIdUtilisateur();
	}

	/**
	 * @param mixed $idEleve
	 */
	public function setIdEleve ($idEleve) {
		$this->setIdUtilisateur($idEleve);
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

	public function insert(){
		if (parent::insert()){
			$query = "INSERT INTO ELEVE (idEleve, idNiveau) VALUES (".
				"".$this->getIdEleve().", ".
				"".$this->getIdNiveau().", ".
				")";
			return db_connect::query($query);
		}
		return false;
	}

    public function insertOnly(){
        $query = "INSERT INTO ELEVE (idEleve, idNiveau) VALUES (".
            "".$this->getIdEleve().", ".
            "".$this->getIdNiveau().", ".
            ")";
        return db_connect::query($query);
    }
}