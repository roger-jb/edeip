<?php

function includeObjet ($cheminRacine = "..") {
	require_once $cheminRacine . '/objet/Absences.php';
	require_once $cheminRacine . '/objet/Admin.php';
	require_once $cheminRacine . '/objet/CLiaison.php';
	require_once $cheminRacine . '/objet/CTexte.php';
	require_once $cheminRacine . '/objet/ComBulletin.php';
	require_once $cheminRacine . '/objet/Communication.php';
	require_once $cheminRacine . '/objet/CptCpt.php';
	require_once $cheminRacine . '/objet/CptEvalEleve.php';
	require_once $cheminRacine . '/objet/CptGroupe.php';
	require_once $cheminRacine . '/objet/CptPalier.php';
	require_once $cheminRacine . '/objet/CptPoint.php';
	require_once $cheminRacine . '/objet/Eleve.php';
	require_once $cheminRacine . '/objet/ElevePoint.php';
	require_once $cheminRacine . '/objet/EvalPoint.php';
	require_once $cheminRacine . '/objet/Evaluation.php';
	require_once $cheminRacine . '/objet/Matiere.php';
	require_once $cheminRacine . '/objet/NivAcquis.php';
	require_once $cheminRacine . '/objet/Niveau.php';
	require_once $cheminRacine . '/objet/Note.php';
	require_once $cheminRacine . '/objet/Parents.php';
	require_once $cheminRacine . '/objet/Periode.php';
	require_once $cheminRacine . '/objet/Personne.php';
	require_once $cheminRacine . '/objet/PlanTravail.php';
	require_once $cheminRacine . '/objet/PointEval.php';
	require_once $cheminRacine . '/objet/Professeur.php';
	require_once $cheminRacine . '/objet/Publication.php';
	require_once $cheminRacine . '/objet/TypeEval.php';
	require_once $cheminRacine . '/objet/Connexion.php';

	return TRUE;

}

?>