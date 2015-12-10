<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 06/12/2015
 * Time: 16:41
 */

require_once '../Require/Objects.php';
$idTrimestre = $_POST['idTrimestre'];
$idEleve = $_POST['idEleve'];

$trimestre = Trimestre::getById($idTrimestre);
$eleve = Eleve::getById($idEleve);

function afficheNote($maxEval, $note){
	$laNote = number_format($note, 2, ',', ' ');
	switch ($maxEval){
		case 10:
			echo '
			<td class="Evaluation nivCpt">'.$laNote.'</td>
			<td class="Evaluation nivCpt"></td>';
			break;
		case 20:
			echo '
			<td class="Evaluation nivCpt"></td>
			<td class="Evaluation nivCpt">'.$laNote.'</td>';
			break;
		default:
			echo '
			<td class="Evaluation nivCpt"></td>
			<td class="Evaluation nivCpt"></td>';
	}
}

/**
 * @param $eleve
 * @param $trimestre
 */
function afficheEvaluation(Eleve $eleve, Trimestre $trimestre, $idMatiere){

	$evaluations = Evaluation::getByMatiereTrimestre($idMatiere, $trimestre->getIdTrimestre());
	if (count($evaluations) > 0){
		foreach ($evaluations as $uneEvaluation){
//$uneEvaluation = new Evaluation();
			$laNote = Note::getById($eleve->getIdEleve(), $uneEvaluation->getIdEvaluation());
			if (!empty($laNote->getNote())){
				echo '<tr>
						<td colspan="3"></td>
						<td class="Evaluation">' .$uneEvaluation->getLibelleEvaluation().'</td>';
				afficheNote($uneEvaluation->getMaxEvaluation(), $laNote->getNote());
				echo '</tr>';
			}
		}

	}
}
?>
<style type="text/css">
	.tableau td {
		padding: 0;
		margin: 0;
	}
	.culture{
		background: #FFD9D9;
	}
	.sousCulture{
		color: #871641;
	}
	.Evaluation {
		border-bottom: dotted;
		border-bottom-color: #871641;
	}
	.nivCpt{
		border-left: dashed;
		border-left-color: #FFD9D9;
		text-align: center;
		font-weight: bold;
	}
	.matiere{
		font-weight: bold;
	}
	#legend td{
		padding: 1mm;
		margin: 1mm;
	}
</style>

<page backtop="30mm" backbottom="7mm" backleft="10mm" backright="10mm">
	<?php
	include_once('./enTetePiedDePage.php');
	?>
	<br>
	<H1 style="text-align: center; color: #871641;">RELEV&Eacute; DE NOTES</H1>
	<br>
	<br>
	<br>
	<table cellspacing="0" style="width: 100%; margin: 0; padding: 0;" class="tableau">
		<col style="width: 10mm"> <!-- Culture -->
		<col style="width: 5mm"> <!-- SousCulture -->
		<col style="width: 5mm"> <!-- Matiere -->
		<col style="width: 125mm"> <!-- Evaluation -->
		<col style="width: 15mm"> <!-- note /10 -->
		<col style="width: 15mm"> <!-- note/20 -->

		<thead><tr>
			<th style="border-bottom: solid 2px #000000; text-align: left; color: #871641;" colspan="4">&nbsp;&nbsp;&Eacute;valuation</th>
			<th class="nivCpt" style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">note /10</th>
			<th class="nivCpt" style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">note /20</th>
		</tr>
		</thead>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td class="culture matiere" colspan="4" >Ma&icirc;trise de la langue</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Langue Fran&ccedil;aise</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="2">Fran&ccedil;ais</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 2); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Langue &eacute;trang&egrave;re</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="2">Anglais</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 6); ?>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="2">Espagnol</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 7); ?>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="2">Chinois</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 8); ?>
		<tr>
			<td class="culture matiere" colspan="4" >Culture scientifique</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Math&eacute;matiques</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 1); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Physique, Chimie, Technologie</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 4); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">SVT</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 5); ?>
		<tr>
			<td class="culture matiere" colspan="4" >Culture humaniste</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Histoire, G&eacute;ographie, &Eacute;ducation Civique</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 3); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Arts Plastiques</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 11); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Musique</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 10); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Th&eacute;&acirc;tre</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 12); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="3">Philosophie</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 17); ?>
		<tr>
			<td class="culture matiere" colspan="4" >EPS</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<?php afficheEvaluation($eleve, $trimestre, 9); ?>
		<tr>
			<?php
			for($i = 0; $i<9; $i++){
				echo "<td style='border-top: 2px solid black;'></td>";
			}
			?>

		</tr>
	</table>
</page>
