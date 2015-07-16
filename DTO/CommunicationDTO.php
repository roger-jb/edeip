<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 10:55
 */

class CommunicationDTO {
	protected $idCommunication;
	protected $contenuCommunication;
	protected $idRedacteur;
	protected $dateRedaction;

	/**
	 * @return mixed
	 */
	public function getIdCommunication () {
		return $this->idCommunication;
	}

	/**
	 * @param mixed $idCommunication
	 */
	public function setIdCommunication ($idCommunication) {
		$this->idCommunication = $idCommunication;
	}

	/**
	 * @return mixed
	 */
	public function getContenuCommunication () {
		return $this->contenuCommunication;
	}

	/**
	 * @param mixed $contenuCommunication
	 */
	public function setContenuCommunication ($contenuCommunication) {
		$this->contenuCommunication = $contenuCommunication;
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