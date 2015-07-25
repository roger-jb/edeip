<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/07/2015
 * Time: 10:57
 */

/*
 * todo
 *
 * mettre en place les get, add et remove des collection;
 *
 */

require_once('/DTO/EleveDTO.php');

require_once('/DTOC/ResponsableDAL.php');
require_once('/DAL/NiveauDAL.php');
require_once('/DAL/matiereDAL.php');

class EleveDTOC extends Eleve {
	protected $responsable = array ();
	protected $matiere = array ();
	protected $niveau = null;

	/**
	 * @return null
	 */
	public function getNiveau () {
		if (is_null($this->niveau)) {
			$this->niveau = NiveauDAL::getById($this->idNiveau);
		}
		return $this->niveau;
	}

	/**
	 * @param null $niveau
	 */
	public function setNiveau (NiveauDTOC $niveau) {
		$this->niveau = $niveau;
		$this->idNiveau = $niveau->getIdNiveau();
	}


	/**
	 * @return array
	 */
	public function getResponsable ($idResponsable = null) {
		if (is_null($idResponsable)) {
			return $this->responsable;
		}
		else {
			foreach ($this->responsable as $resp) {
				if ($resp->getIdResponsable() == $idResponsable) {
					return $resp;
				}
			}
		}
		return null;
	}

	/**
	 * @param array $responsable
	 */
	public function addResponsable (Responsable $responsable) {
		$existe = false;
		foreach ($this->responsable as $resp) {
			if ($resp->getId() == $responsable->getId()) {
				$existe = true;
				break;
			}
		}
		if (!$existe) {
			$this->responsable[] = $responsable;
		}
	}

	public function removeResponsable (Responsable $responsable) {
		for ($index = 0; $index < count($this->responsable); $index++) {
			if ($this->responsable[$index]->getIdResponsable() == $responsable->getIdResponsable()) {
				unset($this->responsable[$index]);
				$this->responsable = array_values($this->responsable);
				break;
			}
		}
	}

	/**
	 * @return array
	 */
	public function getMatiere ($idMatiere = null) {
		if (is_null($idMatiere)) {
			return $this->matiere;
		}
		else {
			foreach ($this->matiere as $mat) {
				if ($mat->getId() == $idMatiere) {
					return $mat;
				}
			}
		}
		return null;
	}

	/**
	 * @param array $responsable
	 */
	public function addMatiere (MatiereDTO $matiere) {
		$existe = false;
		foreach ($this->matiere as $mat) {
			if ($mat->getIdMatiere() == $matiere->getIdMatiere()) {
				$existe = true;
				break;
			}
		}
		if (!$existe) {
			$this->matiere[] = $matiere;
		}
	}

	public function removeMatiere (MatiereDTO $matiere) {
		for ($index = 0; $index < count($this->matiere); $index++) {
			if ($this->matiere[$index]->getIdMatiere() == $matiere->getIdMatiere()) {
				unset($this->matiere[$index]);
				$this->matiere = array_values($this->matiere);
				break;
			}
		}
	}
}