<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:58
 */

class CahierTexteDTO {
	protected $idCahierTexte;
	protected $idNiveau;
	protected $dateRealisation;
	protected $contenuCahierTexte;
	protected $idRedacteur;
	protected $dateRedaction;

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
	public function getIdNiveau () {
		return $this->idNiveau;
	}

	/**
	 * @param mixed $idNiveau
	 */
	public function setIdNiveau ($idNiveau) {
		$this->idNiveau = $idNiveau;
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


}