<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 29/11/2015
 * Time: 18:17
 */

require_once '../Require/Objects.php';

$trimestre = Trimestre::getById($idTrimestre);
$eleve = Eleve::getById($idEleve);


?>
<style type="text/css">
	.tableau td {
		padding: 2mm;
		border: solid 1px #000000;
	}
</style>

<page backtop="30mm" backbottom="7mm" backleft="10mm" backright="10mm">
	<?php
	include_once('./enTetePiedDePage.php');
	?>
	<H1 style="text-align: center; color: #871641;">BULLETIN TRIMESTRIEL</H1>
	<br>
	<table cellspacing="0" style="border: solid 2px #000000; width: 100%;" class="tableau">
		<col style="width: 20%">
		<col style="width: 15%">
		<col style="width: 65%">
		<thead>
		<tr>
			<th style="border-bottom: solid 2px #000000; text-align: left; color: #871641;">&nbsp;&nbsp;MATI&Egrave;RE</th>
			<th style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">&nbsp;&nbsp;MOYENNE</th>
			<th style="border-bottom: solid 2px #000000; text-align: center; color: #871641;">&nbsp;&nbsp;COMMENTAIRE</th>
		</tr>
		</thead>
		<tr>
			<td style="border: solid 1px #000000; background: #FFD9D9;" colspan="3"><b>Ma&icirc;trise de la langue</b></td>
		</tr>
		<tr>
			<td colspan="3"><u>Langue Fran&ccedil;aise</u></td>
		</tr>
		<tr>
			<td>Fran&ccedil;ais<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 2);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 2);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="3"><u>Langues Etrang&egrave;res</u></td>
		</tr>
		<tr>
			<td>Anglais<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 6);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 6);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Espagnol<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 7);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 7);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Chinois<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 2);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 8);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>


		<tr>
			<td colspan="3" style="border: solid 1px #000000; background: #FFD9D9;"><b>Culture scientifique</b></td>
		</tr>
		<tr>
			<td>Math&eacute;matiques<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 1);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 1);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Physique, Chimie,<br>Technologie<br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 4);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 4);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>SVT<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 5);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 5);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>


		<tr>
			<td colspan="3" style="border: solid 1px #000000; background: #FFD9D9;"><b>Culture humaniste</b></td>
		</tr>
		<tr>
			<td>Histoire,<br>G&eacute;ographie,<br>Education Civique</td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 2);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 3);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Arts Plastiques<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 11);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 11);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Musique<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 10);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 10);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Th&eacute;&acirc;tre<br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 12);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 12);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Philosophie<br><br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 17);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 17);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>


		<tr>
			<td colspan="3" style="border: solid 1px #000000; background: #FFD9D9;"><b>EPS</b></td>
		</tr>
		<tr>
			<td><br><br><br><br></td>
			<td style="text-align: center;">
				<?php
				echo Bulletin::getMoyenneByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 9);
				?>
			</td>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 9);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
	</table>
	<br>
	<table width="100%" style="border: solid 2px black;">
		<col width="100%">
		<tr>
			<td width="100%">
				<u>Avis de l'&eacute;quipe &eacute;ducative : </u>
				<br>
			</td>
		</tr>
		<tr>
			<td>
				<?php
				$bulletins =  Bulletin::getByEleveTrimestreMatiere($eleve->getIdEleve(), $trimestre->getIdTrimestre(), 20);
				foreach($bulletins as $bulletin){
					echo str_replace("\n", "<br>", $bulletin->getContenuBulletin()).'<br>';
				}
				?>
			</td>
		</tr>
	</table>

</page>
