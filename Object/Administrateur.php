<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 22/07/2015
 * Time: 11:05
 */
class Administrateur extends Utilisateur
{

    public function getIdAdministrateur()
    {
        return $this->idUtilisateur;
    }

    public function setIdAdministrateur($idAdministrateur)
    {
        $this->setIdUtilisateur($idAdministrateur);
    }

    public static function getAll()
    {
        $parents = parent::getAll();
        $return = array();
        foreach ($parents as $parent) {
            if ($parent->estAdministrateur())
                $return[] = Administrateur::getById($parent->getIdUtilisateur());
        }
        return $return;
    }

	/**
	 * @return array
	 */
	public static function getAllActif()
    {
        $parents = parent::getAllActif();
        $return = array();
        foreach ($parents as $parent) {
            if ($parent->estAdministrateur())
                $return[] = Administrateur::getById($parent->getIdUtilisateur());
        }
        return $return;
    }

    public static function getById($idResponsable)
    {
        $parent = parent::getById($idResponsable);
        $administrateur = new Administrateur();

        foreach ($parent as $attr => $value) {
            $administrateur->{'set' . $attr}($value);
        }
        return $administrateur;
    }

    public function insert()
    {
        if (parent::insert()) {
            $query = "INSERT INTO ADMINISTRATION (idAdministration) VALUES (" . $this->getIdAdministrateur() . ")";
            return db_connect::query($query);
        }
        return FALSE;
    }

    public function insertOnly()
    {
        $query = "INSERT INTO ADMINISTRATION (idAdministration) VALUES (" . $this->getIdAdministrateur() . ")";
        return db_connect::query($query);
        return FALSE;
    }
}