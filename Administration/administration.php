<?php
header('content-type: text/html; charset=utf-8');
session_start();
require_once '../include/db.php';
require_once '../objet/objet.php';
$include = includeObjet('../');
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
} else {
    $personne = Personne::getById($_SESSION['id']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EDEIP - Administration</title>
        <link rel="stylesheet" href="../administration/style_administration.css" type="text/css" media="screen"/>
        <link rel="shortcut icon" href="../images/Logo32.ico"/>                        
        <link rel="icon" href="../images/logo32.png" type="image/png"/>
    </head>
    <body>
        <div id='angle_rond'>
            <?php
            include '../include/include_header_administration.php';
            ?>
            <div class='corps'>
                <br/>
                <div class="titre_corps">
                    <h3 class="centrer">Administration</h3>
                </div>
                <?php
                if (isset($_SESSION['id'])) {
                    if ($personne->get_estAmdin()) {
                        ?>
                        <div class="sous_titre_corps">
                            <h4 class="centrer">A partir de cette page, vous pouvez administrer le site via les diff&eacute;rentes rubriques de menu</h4>
                        </div>
                        <?php
                    }
                    else {
                        echo "<p>Vous n'êtes pas autorisé à accéder à cette page. Veuillez retourner sur l'<a href='../intranet/intranet.php'>Intranet</a> ou la page d'<a hre='../vitrine/accueil.php'>Accueil</a></p>";
                    }
                }
                else {
                    echo "<p>Vous devez être connecté pour accéder à cette page. <a href='../vitrine/connexion.php'>Merci de vous connecter</a></p>";
                }
                ?>
            </div>
            <?php
            include '../include/include_footer.php';
            ?>
        </div>
    </body>
</html>
