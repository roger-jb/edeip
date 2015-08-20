<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 11:53
 */
class NiveauCpt
{
    protected $idNiveauCpt;
    protected $codeNiveauCpt;
    protected $libelleNiveauCpt;

    public function toArray(){
        $return = array();
        $return['idNiveauCpt'] = $this->getIdNiveauCpt();
        $return['libelleNiveauCpt'] = $this->getLibelleNiveauCpt();
        $return['codeNiveauCpt'] = $this->getCodeNiveauCpt();

        return $return;
    }

    /**
     * @return mixed
     */
    public function getCodeNiveauCpt()
    {
        return $this->codeNiveauCpt;
    }

    /**
     * @param mixed $codeNiveauCpt
     */
    public function setCodeNiveauCpt($codeNiveauCpt)
    {
        $this->codeNiveauCpt = $codeNiveauCpt;
    }

    public static function getAll()
    {
        $query = "SELECT * FROM NIVEAU_CPT ORDER BY codeNiveauCpt ASC";
        $result = db_connect::query($query);
        $return = array();
        while ($info = $result->fetch_object('NiveauCpt')) {
            $return[] = $info;
        }
        $result->close();
        return $return;
    }

    public static function getById($idNiveauCpt)
    {
        $query = "SELECT * FROM NIVEAU_CPT WHERE idNiveauCpt = $idNiveauCpt";
        $result = db_connect::query($query);
        if ($result->num_rows == 1) {
            $return = $result->fetch_object('NiveauCpt');
            $result->close();
            return $return;
        }
        $result->close();
        return new NiveauCpt();
    }

    /**
     * @return mixed
     */
    public function getIdNiveauCpt()
    {
        return $this->idNiveauCpt;
    }

    /**
     * @param mixed $idNiveauCpt
     */
    public function setIdNiveauCpt($idNiveauCpt)
    {
        $this->idNiveauCpt = $idNiveauCpt;
    }

    /**
     * @return mixed
     */
    public function getLibelleNiveauCpt()
    {
        return $this->libelleNiveauCpt;
    }

    /**
     * @param mixed $libelleNiveauCpt
     */
    public function setLibelleNiveauCpt($libelleNiveauCpt)
    {
        $this->libelleNiveauCpt = $libelleNiveauCpt;
    }

    public function insert()
    {
        $query = "INSERT INTO NIVEAU_CPT (codeNiveauCpt, libelleNiveauCpt) VALUES (" .
            "'" . db_connect::escape_string($this->getCodeNiveauCpt()) . "'," .
            "'" . db_connect::escape_string($this->getLibelleNiveauCpt()) . "'" .
            ")";
        if (db_connect::query($query)) {
            $select = "SELECT idNiveauCpt FROM NIVEAU_CPT WHERE libelleNiveauCpt = '" . db_connect::escape_string($this->getLibelleNiveauCpt()) . "' " .
                "AND codeNiveauCpt = '" . db_connect::escape_string($this->getCodeNiveauCpt()) . "'";
            $result = db_connect::query($select);
            if ($result->num_rows == 1) {
                $info = $result->fetch_assoc();
                $this->setIdNiveauCpt($info['idNiveauCpt']);
                $result->close();
                return TRUE;
            }
            //db_connect::getInstance()->rollback();
        }
        return FALSE;
    }

    public function update()
    {
        $query = "UPDATE NIVEAU_CPT SET libelleNiveauCpt = '" . db_connect::escape_string($this->getLibelleNiveauCpt()) . "', codeNiveauCpt = '" . db_connect::escape_string($this->getCodeNiveauCpt()) . "'  WHERE idNiveauCpt = " . $this->getIdNiveauCpt();
        if (db_connect::query($query))
            return TRUE;
        return FALSE;
    }

    public function delete()
    {
        $query = "DELETE FROM NIVEAU_CPT WHERE idNiveauCpt = " . $this->getIdNiveauCpt();
        if (db_connect::query($query))
            return TRUE;
        return FALSE;
    }
}