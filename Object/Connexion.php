<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:27
 */
class Connexion {
  protected $idUtilisateur = 0;
  protected $loginUtilisateur;
  protected $mdpUtilisateur;

  public static function getById($idUtilisateur) {
    $query = "SELECT * FROM CONNEXION WHERE idUtilisateur = " . $idUtilisateur;

    $result = db_connect::query($query);

    if ($result->num_rows != 1) {
      return new Connexion();
    } else {
      return $result->fetch_object('Connexion');
    }
  }

  public function getUtilisateur() {
    return Utilisateur::getById($this->idUtilisateur);
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
  public function getLoginUtilisateur() {
    return $this->loginUtilisateur;
  }

  /**
   * @param mixed $loginUtilisateur
   */
  public function setLoginUtilisateur($loginUtilisateur) {
    $this->loginUtilisateur = $loginUtilisateur;
  }

  /**
   * @return mixed
   */
  public function getMdpUtilisateur() {
    return $this->mdpUtilisateur;
  }

  /**
   * @param mixed $mdpUtilisateur
   */
  public function setMdpUtilisateur($mdpUtilisateur) {
    $this->mdpUtilisateur = $this->hashMdp($mdpUtilisateur);
  }

  static public function hashMdp($mdp) {
    return hash("sha256", $mdp);
  }

  public function update() {
    $db_login = db_connect::escape_string($this->getLoginUtilisateur());
    $db_mdp = db_connect::escape_string($this->getMdpUtilisateur());
    if (empty($this->getMdpUtilisateur())) {
      $this->insert();
    }
    $query = "UPDATE CONNEXION SET " .
        "loginUtilisateur = '$db_login', mdpUtilisateur = '$db_mdp' " .
        "WHERE idUtilisateur = " . $this->getIdUtilisateur();
    return db_connect::query($query);
  }

  // non implementé car gérée par le trigger trg_utilisaeur_after_insert
  public function insert() {
    if (empty($this->getMdpUtilisateur())) {
      $this->setMdpUtilisateur('123Soleil');
    }
    $query = "INSERT INTO CONNEXION (idUtilisateur, loginUtilisateur, mdpUtilisateur) VALUES (" .
        $this->getIdUtilisateur() . ", " .
        "'" . $this->getLoginUtilisateur() . "', " .
        "'" . $this->getMdpUtilisateur() . "'"
        . ")";
    return db_connect::query($query);
  }

  public function delete() {
    $query = "DELETE FROM CONNEXION WHERE idUtilisateur = " . $this->getIdUtilisateur();
    if (db_connect::query($query))
      return true;
    return false;
  }

  public static function connecter($login, $mdp) {
    $connexion = new Connexion();
    $connexion->setLoginUtilisateur($login);
    $connexion->setMdpUtilisateur($mdp);

    $query = " SELECT c.* FROM CONNEXION c, UTILISATEUR u " .
        " WHERE c.loginUtilisateur = '" . db_connect::escape_string($connexion->getLoginUtilisateur()) . "' " .
        " AND c.mdpUtilisateur = '" . $connexion->getMdpUtilisateur() . "' " .
        " AND c.idUtilisateur = u.idUtilisateur " .
        " AND u.actifUtilisateur = 1 ";
    $result = db_connect::query($query);

    if ($result->num_rows != 1) {
      return new connexion;
    } else {
      return $result->fetch_object('Connexion');
    }
  }

  public static function getAll() {
    $query = "	SELECT c.* FROM CONNEXION c, UTILISATEUR u
					WHERE c.idUtilisateur = u.idUtilisateur
					AND u.actifUtilisateur = 1
					ORDER BY loginUtilisateur ASC";
    $result = db_connect::query($query);
    $return = array();
    while ($info = $result->fetch_object('Connexion')) {
      $return[] = $info;
    }
    $result->close();
    return $return;

    //return $result->fetch_all();
  }
}