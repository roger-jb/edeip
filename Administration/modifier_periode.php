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
        <title>EDEIP - Modifier Période</title>
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
                    <h3 class="centrer">Modifier Période</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['modifier'])) {
                            if (isset($_POST['id_periode']) && !empty($_POST['id_periode']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['date_debut']) && !empty($_POST['date_debut']) && isset($_POST['date_fin']) && !empty($_POST['date_fin'])) {
                                //on veux modifier une période. On récupère et on sécurise
                                $id_periode = mysql_real_escape_string(htmlentities($_POST['id_periode'], ENT_QUOTES, 'UTF-8'));
                                $libelle = mysql_real_escape_string(htmlentities($_POST['libelle'], ENT_QUOTES, 'UTF-8'));
                                $date_debut = mysql_real_escape_string(htmlentities($_POST['date_debut'], ENT_QUOTES, 'UTF-8'));
                                $date_debut = date("Y-m-d", strtotime($date_debut));
                                $date_fin = mysql_real_escape_string(htmlentities($_POST['date_fin'], ENT_QUOTES, 'UTF-8'));
                                $date_fin = date("Y-m-d", strtotime($date_fin));
                                $vacance = mysql_real_escape_string(htmlentities($_POST['vacance'], ENT_QUOTES, 'UTF-8'));

                                if (!isset($_POST['vacance'])) {
                                    $vacance = 0;
                                }

                                $query = "UPDATE periode SET libelle_periode = '$libelle', date_debut_periode = '$date_debut', date_fin_periode = '$date_fin', bool_vacance = '$vacance' WHERE id_periode = '$id_periode';";
                                $result = mysql_query($query);
                                echo "<p>La modification de la période a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de modification d'une période n'est pas valide. Veuillez <a href='modifier_lien.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['supprimer'])) {
                            if (isset($_POST['id_periode']) && !empty($_POST['id_periode'])) {
                                //on veux supprimer une période. On récupère et on sécurise
                                $id_periode = mysql_real_escape_string(htmlentities($_POST['id_periode'], ENT_QUOTES, 'UTF-8'));

                                //on supprime la péridoe
                                $query = "DELETE FROM periode WHERE id_periode = '$id_periode';";
                                if (mysql_query($query)) {
                                    echo "<p>La suppression de la période a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                                }
                                else {
                                    echo "<p>La suppression de la période n'a pas été possible. Retour à l'<a href='administration.php'>administration</a></p>";
                                }
                            } else {
                                echo "<p>Votre demande de suppression d'une période n'est pas valide. Veuillez <a href='modifier_periode.php'>réésayer</a></p>";
                            }
                        } else {
                            //on affiche les périodes
                            $form = true;
                        }

                        if ($form) {
                            $periodes = Periode::recupBdd();
                            $i = 0;
                            foreach ($periodes as $peri) {
                                $i++;
                                ?>
                                <fieldset style="width: 790px;"><legend><strong>Période n°<?php echo $i; ?></strong></legend>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <table>
                                            <tr><td><input type="hidden" name="id_periode" value="<?php echo $peri->get_id(); ?>">
                                            <tr><td>Libelle période * :</td><td><input type="text" required name="libelle" value="<?php echo $peri->get_libelle(); ?>"></td></tr>
                                            <tr><td>Date de début (JJ-MM-AAAA) * :</td><td><input type="date" required name="date_debut" value="<?php echo $peri->get_dateDebut(); ?>"></td></tr>
                                            <tr><td>Date de fin (JJ-MM-AAAA) * : </td><td><input type="date" required name="date_fin"value="<?php echo $peri->get_dateFin(); ?>"></td></tr>
                                            <tr><td>Période de vacances : </td><td><input type="checkbox" name="vacance" value="1" <?php
                                                    if ($peri->get_vacances() == 1) {
                                                        echo " checked ";
                                                    }
                                                    ?>></td></tr>
                                            <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                        </table>
                                        <input type="submit" name="modifier" value="Modifier"/>
                                        <input type="submit" name="supprimer" value="Supprimer"/>
                                    </form>
                                </fieldset>
                                <br/>
                                <?php
                            }

                            if ($i == 0) {
                                echo "<p>Il n'y a pas encore de période définie.</p>";
                            }
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
