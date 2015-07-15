<?php
header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EDEIP - Tarifs et inscriptions</title>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
        <link rel="shortcut icon" href="../images/Logo32.ico"/>                        
        <link rel="icon" href="../images/logo32.png" type="image/png"/>
    </head>
    <body>
        <div id='angle_rond'>
            <?php
            include '../include/include_header.php';
            ?>
            <div class="corps">
                <br/>
                <div class="titre_corps">
                    <h3 class="centrer">Tarifs et inscription</h3>
                </div>
                <p><strong>Les inscriptions pour l’année 2015-2016 sont ouvertes.</strong></p>
                <p><strong>Coût annuel de la scolarité :</strong></p>
                <table id="tarif">
                    <tr><td></td><td>Module 1 <br>(CP &agrave; CE2)</td><td>Module 2 <br>(CM1 &agrave; 6ieme)</td><td>Module 3 <br>(5ieme &agrave; 3ieme)</td><td>Module 4 <br>(2nde &agrave; 1iere)</td></tr>
                    <tr><td>Frais de dossier</td><td>150 €</td><td>150 €</td><td>150 €</td><td>150 €</td></tr>
                    <tr><td>Adhésion à l'association "Diamant Brut"</td><td>60 €</td><td>60 €</td><td>60 €</td><td>60 €</td></tr>
                    <tr><td>Frais de scolarité</td><td>5500 €</td><td>5800 €</td><td>6100 €</td><td>6200 €</td></tr>
                </table>
                <p>Ce tarif inclut le prêt de manuels aux élèves de primaire.</p>
                <p>Les inscriptions sont prises toute l’année. L’EDEIP Lyon accueille les enfants dont le QI est supérieur à 130 sans condition de dossier scolaire.</p>
                <p>Ce tarif ne comprend pas :</p>
                <ul>
                    <li>les fournitures scolaires</li>
                    <li>les manuels des élèves du secondaire</li>
                    <li>les repas</li>
                </ul>
                <p>Il sera par ailleurs demandé de fournir un titre de transport pour d'éventuels déplacements sur Lyon (sports, visites...)</p>
                <p><a href="../docs/Inscription.pdf">Document d'inscription année courante</a> - <a href="../docs/INSCRIPTION 2015-16.pdf">Document d'inscription année suivante (2015-16)</a><!-- (<a href="../docs/inscrip2015-16Verso.pdf">page 2</a>)--></p>
            </div>
            <?php
            include '../include/include_footer.php';
            ?>
        </div>
    </body>
</html>
