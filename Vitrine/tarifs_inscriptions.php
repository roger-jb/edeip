<?php
header('content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP - Tarifs et inscriptions</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <link rel="shortcut icon" href="../Images/Logo32.ico"/>
    <link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<div id='angle_rond'>
    <?php
    include '../Include/include_header.php';
    ?>
    <div class="corps">
        <br/>

        <div class="titre_corps">
            <h3 class="centrer">Tarifs et inscription</h3>
        </div>
        <p><strong>Les inscriptions pour l’année 2016-2017 sont ouvertes.</strong></p>

        <p><strong>Coût annuel de la scolarité :</strong></p>
        <table id="tarif">
            <tr>
                <td></td>
                <td style="width: 15%;">CP &agrave; CE2</td>
                <td style="width: 15%;">CM1 &agrave; 6<sup>&egrave;me</sup></td>
                <td style="width: 15%;">5<sup>&egrave;me</sup> &agrave; 3<sup>&egrave;me</sup></td>
                <td style="width: 15%;">2<sup>nde</sup></td>
                <td style="width: 15%;">1<sup>&egrave;re</sup> et Term.</td>
            </tr>
            <tr>
                <td>Adhésion <!--à l'association--> "Diamant Brut"</td>
                <td>60 €</td>
                <td>60 €</td>
                <td>60 €</td>
                <td>60 €</td>
                <td>60 €</td>
            </tr>
            <tr>
                <td>Frais de dossier</td>
                <td>210 €</td>
                <td>210 €</td>
                <td>210 €</td>
                <td>210 €</td>
                <td>210 €</td>
            </tr>
            <tr>
                <td>Frais de scolarité</td>
                <td>5 900 €</td>
                <td>6 200 €</td>
                <td>6 500 €</td>
                <td>6 800 €</td>
                <td>7 300 €</td>
            </tr>
        </table>
        <p>Les inscriptions sont prises toute l’année. L’EDEIP Lyon accueille les enfants reconnus EIP par un psychologue
            sans condition de dossier scolaire.</p>

        <p>Ce tarif ne comprend pas :</p>
        <ul>
            <li>les fournitures scolaires</li>
            <li>les manuels des élèves du secondaire</li>
            <li>les repas</li>
        </ul>
        <p>Il sera par ailleurs demandé de fournir un titre de transport pour d'éventuels déplacements sur Lyon (sports,
            visites...)</p>

        <p>
			<!--<a href="../Docs/INSCRIPTION%202015-16.pdf">Document d'inscription année courante</a>-->
			<a href="../Docs/FicheInscription2016-2017.pdf">Document d'inscription année 2016-2017</a><!-- (<a href="../docs/inscrip2015-16Verso.pdf">page 2</a>)-->
        </p>
    </div>
    <?php
    include '../Include/include_footer.php';
    ?>
</div>
</body>
</html>
