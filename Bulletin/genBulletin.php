<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 29/11/2015
 * Time: 18:10
 */

//header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
require_once '../html2pdf/html2pdf.class.php';
/*
echo '<pre>';
var_dump($_POST);
echo'</pre>';

exit;*/
if (isset($_POST['idEleve']) && !empty($_POST['idEleve']) && isset($_POST['idTrimestre'])&& !empty($_POST['idTrimestre'])){
	$idEleve = $_POST['idEleve'];
	$idTrimestre = $_POST['idTrimestre'];
}
else {
	header('location: ../Intranet/getBulletin.php');
}
if (isset($_POST['genBulletin'])){
	ob_start();
	$eleve = Eleve::getById($idEleve);
	if ($eleve->getIdNiveau() < 9)
		require_once './modelBulletinCollege.php';
	elseif($eleve->getIdNiveau() == 9){
		require_once './modelBulletin3eme.php';
	}
	else
		require_once './modelBulletinLycee.php';
	$content = ob_get_clean();
	$pdf = new HTML2PDF('P','A4','fr', true, 'UTF-8', array(5, 5, 5, 5));
	$pdf->writeHTML($content);
	$pdf->Output($eleve->getLibelleUtilisatur().'-Bulletin-Trimestre'.$idTrimestre.'.pdf');
}
if (isset($_POST['genNotes'])){
	ob_start();
	$eleve = Eleve::getById($idEleve);
	if ($eleve->getIdNiveau() < 9)
		require_once './modelNoteCollege.php';
	elseif($eleve->getIdNiveau() == 9){
		require_once './modelNote3eme.php';
	}
	else
		require_once './modelNoteLycee.php';
	$content = ob_get_clean();
	$pdf = new HTML2PDF('P','A4','fr', true, 'UTF-8', array(5, 5, 5, 5));
	$pdf->writeHTML($content);
	$pdf->Output($eleve->getLibelleUtilisatur().'-Note-Trimestre'.$idTrimestre.'.pdf');
}
if (isset($_POST['genCpt'])){
	ob_start();
	$eleve = Eleve::getById($idEleve);
	if ($eleve->getIdNiveau() < 9)
		require_once './modelCompetenceCollege.php';
	elseif($eleve->getIdNiveau() == 9){
		require_once './modelCompetence3eme.php';
	}
	else
		require_once './modelCompetenceLycee.php';

	$content = ob_get_clean();
	$pdf = new HTML2PDF('P','A4','fr', true, 'UTF-8', array(5, 5, 5, 5));
	$pdf->pdf->SetDisplayMode('fullpage');
	$pdf->writeHTML($content);
	$pdf->Output($eleve->getLibelleUtilisatur().'-Competence-Trimestre'.$idTrimestre.'.pdf');
}
