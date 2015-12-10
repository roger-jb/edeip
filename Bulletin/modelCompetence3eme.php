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

function niveauCpt($idNivCpt){

	switch ($idNivCpt){
		case 1:
			echo '
			<td class="pCpt nivCpt">X</td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>';
			break;
		case 2:
			echo '
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt">X</td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>';
			break;
		case 3:
			echo '
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt">X</td>
			<td class="pCpt nivCpt"></td>';
			break;
		case 4:
			echo '
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt">X</td>';
			break;
		default:
			echo '
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>
			<td class="pCpt nivCpt"></td>';
	}
}

/**
 * @param $eleve
 * @param $trimestre
 */
function afficheDomaine($eleve, $trimestre, $idMatiere){
	$Domaines = DomaineCpt::getByMatiere($idMatiere);
	if (count($Domaines) > 0){
		foreach ($Domaines as $domaine){
			echo '<tr>
				<td colspan="3"></td>
				<td class="domaine" colspan="2">'.$domaine->getLibelleDomaineCpt().'</td>
				<td class="nivCpt"></td>
				<td class="nivCpt"></td>
				<td class="nivCpt"></td>
				<td class="nivCpt"></td>
			</tr>';

			$pointCpts = PointCpt::getByDomaineCpt($domaine->getIdDomaineCpt());
			foreach ($pointCpts as $ptCpt) {
				//$idPointCpt, $idEleve, $idTrimestre
				$EPT = PointCptEleve::getById($ptCpt->getIdPointCpt(), $eleve->getIdUtilisateur(), $trimestre->getIdTrimestre());
				//echo '<tr><td colspan="5"></td><td>'.$EPT->getIdEleve().'</td>'.niveauCpt(0).'</tr>';
				if (!is_null($EPT->getIdNiveauCpt())) {
					echo '<tr>
						<td colspan="4"></td>
						<td class="pCpt">' .$EPT->getPointCpt()->getLibellePointCpt().'</td>';

					niveauCpt($EPT->getIdNiveauCpt());

					echo '</tr>';

				}
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
	.domaine{
		text-align: left;
	}
	.pCpt {
		border-bottom: dotted;
		border-bottom-color: #871641;
	}
	.nivCpt{
		border-left: dashed;
		border-left-color: #FFD9D9;
		text-align: center;
		font-weight: bold;
		/*border-right: dashed;
		border-right-color: #FFD9D9;*/
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
	<H1 style="text-align: center; color: #871641;">LIVRET DE COMPETENCES</H1>
	<br>

	<table id="legend" cellspacing="0" style="width: 100%; padding: 5px; border: solid 2px #000000;">
		<tr>
			<td colspan="2">L&eacute;gende des comp&eacute;tences</td>
		</tr>
		<tr>
			<td>A : <?php echo NiveauCpt::getById(1)->getLibelleNiveauCpt() ?></td>
			<td>B : <?php echo NiveauCpt::getById(2)->getLibelleNiveauCpt() ?></td>
		</tr>
		<tr>
			<td>C : <?php echo NiveauCpt::getById(3)->getLibelleNiveauCpt() ?></td>
			<td>D : <?php echo NiveauCpt::getById(4)->getLibelleNiveauCpt() ?></td>
		</tr>
	</table>
	<br>
	<br>
	<table cellspacing="0" style="width: 100%; margin: 0; padding: 0;" class="tableau">
		<col style="width: 10mm"> <!-- Culture -->
		<col style="width: 5mm"> <!-- SousCulture -->
		<col style="width: 5mm"> <!-- Matiere -->
		<col style="width: 5mm"> <!-- Domaine -->
		<col style="width: 90mm"> <!-- Point Cpt -->
		<col style="width: 15mm"> <!-- A -->
		<col style="width: 15mm"> <!-- B -->
		<col style="width: 15mm"> <!-- C -->
		<col style="width: 15mm"> <!-- D -->

		<thead><tr>
			<th style="border-bottom: solid 2px #000000; text-align: left; color: #871641;" colspan="5">&nbsp;&nbsp;COMPETENCES</th>
			<th class="nivCpt" style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">A</th>
			<th class="nivCpt" style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">B</th>
			<th class="nivCpt" style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">C</th>
			<th class="nivCpt" style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">D</th>
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
			<td class="culture matiere" colspan="5" >Ma&icirc;trise de la langue</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Langue Fran&ccedil;aise</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="3">Fran&ccedil;ais</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 2); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Langue &eacute;trang&egrave;re</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="3">Anglais</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 6); ?>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="3">Espagnol</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 7); ?>
		<tr>
			<td colspan="2"></td>
			<td class="matiere" colspan="3">Chinois</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 8); ?>
		<tr>
			<td class="culture matiere" colspan="5" >Culture scientifique</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Math&eacute;matiques</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 1); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Physique, Chimie, Technologie</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 4); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">SVT</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 5); ?>
		<tr>
			<td class="culture matiere" colspan="5" >Culture humaniste</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Histoire, G&eacute;ographie, &Eacute;ducation Civique</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 3); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Arts Plastiques</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 11); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Musique</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 10); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Th&eacute;&acirc;tre</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 12); ?>
		<tr>
			<td></td>
			<td class="sousCulture" colspan="4">Philosophie</td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
			<td class="nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 17); ?>
		<tr>
			<td class="culture matiere" colspan="5" >EPS</td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
			<td class="culture nivCpt"></td>
		</tr>
		<?php afficheDomaine($eleve, $trimestre, 9); ?>
		<tr>
			<?php
			for($i = 0; $i<9; $i++){
				echo "<td style='border-top: 2px solid black;'></td>";
			}
			?>

		</tr>
	</table>
</page>
