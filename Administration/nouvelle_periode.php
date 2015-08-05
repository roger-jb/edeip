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
        <title>EDEIP - Nouvelle Période</title>
        <link rel="stylesheet" href="style_administration.css" type="text/css" media="screen"/>
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
                    <h3 class="centrer">Nouvelle Période</h3>
                </div>
                <?php
                if (isset($personne)) {
                    //on est connecté
                    if ($personne->get_estAmdin()) {
                        //on est admin
                        if (isset($_POST['envoyer'])) {
                            if (isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['date_debut']) && !empty($_POST['date_debut']) && isset($_POST['date_fin']) && !empty($_POST['date_fin']) && isset($_POST['vacances'])) {
                                //on veux créer une nouvelle période. On récupère les champs et on envoie à la BDD
                                $libelle = mysql_real_escape_string(htmlentities($_POST['libelle'], ENT_QUOTES, 'UTF-8'));
                                $date_debut = mysql_real_escape_string(htmlentities($_POST['date_debut'], ENT_QUOTES, 'UTF-8'));
                                $date_debut = date("Y-m-d", strtotime($date_debut));
                                $date_fin = mysql_real_escape_string(htmlentities($_POST['date_fin'], ENT_QUOTES, 'UTF-8'));
                                $date_fin = date("Y-m-d", strtotime($date_fin));
                                $bool_vacances = mysql_real_escape_string(htmlentities($_POST['vacances'], ENT_QUOTES, 'UTF-8'));

                                $query = "INSERT INTO periode (libelle_periode, date_debut_periode, date_fin_periode, bool_vacance) VALUES ('$libelle', '$date_debut', '$date_fin', '$bool_vacances');";
                                $result = mysql_query($query);
                                
                                echo "<p>La nouvelle période a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de nouvelle période n'est pas valide. Veuillez <a href='nouvelle_periode.php'>réésayer</a></p>";
                            }
                        } else {
                            $form = true;
                        }

                        if ($form) {
                            ?>
                            <fieldset style="width: 790px;"><legend>Nouvelle période</legend>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <table>
                                        <tr><td>Libelle période * :</td><td><input type="text" required name="libelle"></td></tr>
                                        <tr><td>Date de début (JJ-MM-AAAA) * :</td><td><input type="text" required name="date_debut"></td></tr>
                                        <tr><td>Date de fin (JJ-MM-AAAA) * : </td><td><input type="text" required name="date_fin"></td></tr>
                                        <tr><td>Période de vacances * : </td><td><input type="radio" name="vacances" value="1">Oui<input type="radio" name="vacances" value="0">Non</td></tr>
                                        <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                    </table>
                                    <input type="submit" name="envoyer" value="Envoyer"/>
                                </form>
                            </fieldset>
                            <br/>
            <?php
        }
    } else {
        echo "<p>Vous devez être administrateur pour accéder à cette page. <a href='../intranet/intranet.php'>Retourner à L'intranet</a></p>";
    }
} else {
    echo "<p>Vous devez être connecté pour accéder à cette page. <a href='../vitrine/connexion.php'>Merci de vous connecter</a></p>";
}
?>
            </div>
                <?php
                include '../include/include_footer.php';
                mysql_close($db);
                ?>
        </div>
    </body>
</html>
