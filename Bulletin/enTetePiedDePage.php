<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 03/12/2015
 * Time: 19:15
 */
?>
<page_header style="text-align: center;">
	<table  style="width: 100%;">
		<col style="width: 15%">
		<col style="width: 85%">
		<tr>
			<td rowspan="6" width="100mm"><img src="./logoEdeip.jpg"  height="106px"></td>
			<td width="100%">
				<table style="width: 100%;">
					<col style="width: 60%">
					<col style="width: 33%">
					<tr>
						<td style="text-align: left; color: #871641;" width="150mm">Ecole Des Enfants Intellectuellement Pr&eacute;coces</td>
						<td style="text-align: right;" width="250px">Ann&eacute;e 2015-2016</td>
					</tr>
					<tr>
						<td style="text-align: left; color: #871641;">27 rue Raoul Servant</td>
						<td style="text-align: right;" id="libelleTrimestre"><?php echo $trimestre->getLibelleTrimestre(); ?></td>
					</tr>
					<tr>
						<td style="text-align: left; color: #871641;">69007 Lyon</td>
						<td></td>
					</tr>
					<tr>
						<td style="text-align: left; color: #871641;">www.edeip-lyon.fr</td>
						<td style="text-align: right;" id="libelleEleve"><b><?php echo $eleve->getLibelleUtilisatur(); ?></b></td>
					</tr>
					<tr>
						<td style="text-align: left; color: #871641;">04 37 37 86 65</td>
						<td style="text-align: right;" id="libelleNiveau"><b>Classe : <?php echo $eleve->getNiveau()->getLibelleNiveau(); ?></b></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
</page_header>
<page_footer>
</page_footer>
