<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:53
 */
class CarnetLiaisonDTO {
	protected $idCarnetLiaison;
	protected $contenuCarnetLiason;
	protected $idReponse;
	protected $idRedacteur;
	protected $dateRedaction;
	protected $idEleve;

	/**
	 * @return mixed
	 */
	public function getIdCarnetLiaison () {
		return $this->idCarnetLiaison;
	}

	/**
	 * @param mixed $idCarnetLiaison
	 */
	public function setIdCarnetLiaison ($idCarnetLiaison) {
		$this->idCarnetLiaison = $idCarnetLiaison;
	}

	/**
	 * @return mixed
	 */
	public function getContenuCarnetLiason () {
		return $this->contenuCarnetLiason;
	}

	/**
	 * @param mixed $contenuCarnetLiason
	 */
	public function setContenuCarnetLiason ($contenuCarnetLiason) {
		$this->contenuCarnetLiason = $contenuCarnetLiason;
	}

	/**
	 * @return mixed
	 */
	public function getIdReponse () {
		return $this->idReponse;
	}

	/**
	 * @param mixed $idReponse
	 */
	public function setIdReponse ($idReponse) {
		$this->idReponse = $idReponse;
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


}