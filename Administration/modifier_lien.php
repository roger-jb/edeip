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
        <title>EDEIP - Modifier Lien</title>
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
                    <h3 class="centrer">Modifier Lien</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['modifier'])) {
                            if (isset($_POST['parent']) && !empty($_POST['parent']) && isset($_POST['eleve']) && !empty($_POST['eleve'])) {
                                //on veux modifier un lien. On récupère et on sécurise
                                $id_parent = mysql_real_escape_string(htmlentities($_POST['parent'], ENT_QUOTES, 'UTF-8'));
                                $id_eleve = mysql_real_escape_string(htmlentities($_POST['eleve'], ENT_QUOTES, 'UTF-8'));
                                $id_parent_original = mysql_real_escape_string(htmlentities($_POST['id_parent'], ENT_QUOTES, 'UTF-8'));
                                $id_eleve_original = mysql_real_escape_string(htmlentities($_POST['id_eleve'], ENT_QUOTES, 'UTF-8'));

                                $query = "UPDATE eleve_parent SET id_parent = '$id_parent', id_eleve = '$id_eleve' WHERE id_parent = '$id_parent_original' AND id_eleve = '$id_eleve_original';";
                                $result = mysql_query($query);
                                echo "<p>La modification du lien a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de modification d'un lien n'est pas valide. Veuillez <a href='modifier_lien.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['supprimer'])) {
                            if (isset($_POST['id_parent']) && !empty($_POST['id_parent']) && isset($_POST['id_eleve']) && !empty($_POST['id_eleve'])) {
                                //on veux supprimer un parent. On récupère et on sécurise
                                $id_parent = mysql_real_escape_string(htmlentities($_POST['id_parent'], ENT_QUOTES, 'UTF-8'));
                                $id_eleve = mysql_real_escape_string(htmlentities($_POST['id_eleve'], ENT_QUOTES, 'UTF-8'));

                                //on supprime la TJ
                                $query = "DELETE FROM eleve_parent WHERE id_parent = '$id_parent' and id_eleve = '$id_eleve';";
                                $result = mysql_query($query);
                                echo "<p>La suppression du lien a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de suppression d'un lien n'est pas valide. Veuillez <a href='modifier_lien.php'>réésayer</a></p>";
                            }
                        } else {
                            //on affiche les parents
                            $form = true;
                        }

                        if ($form) {
                            $query = "SELECT * FROM eleve_parent;";
                            $result = mysql_query($query);
                            while ($infos = mysql_fetch_array($result)) {
                                $id_parent = $infos['id_parent'];
                                $id_eleve = $infos['id_eleve'];

                                //on récupère les infos du parent
                                $parent = Personne::getById($id_parent);
                                $nom_parent = $parent->get_nom();
                                $prenom_parent = $parent->get_prenom();

                                //on récupère les infos de l'enfant
                                $enfant = Personne::getById($id_eleve);
                                $nom_eleve = $enfant->get_nom();
                                $prenom_eleve = $enfant->get_prenom();
                                ?>
                                <fieldset style="width: 790px;">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <table>
                                            <tr><td><input type="hidden" name="id_parent" value="<?php echo $id_parent; ?>">
                                            <tr><td><input type="hidden" name="id_eleve" value="<?php echo $id_eleve; ?>">
                                            <tr><td>Parent <strong>(<?php echo $nom_parent . " " . $prenom_parent; ?>)</strong> *:</td>
                                                <td><select id="parent" name="parent">
                                                        <?php
                                                        $listParents = Parents::recupBdd();
                                                        foreach ($listParents as $par) {
                                                            if ($par->get_personne()->get_etat() == 1) {
                                                                echo '<option value="' . $par->get_id() . '"';
                                                                if ($id_parent == $par->get_id()) {
                                                                    echo " selected ";
                                                                }
                                                                echo '>' . $par->get_personne()->get_nom() . " " . $par->get_personne()->get_prenom() . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select></td></tr>
                                            <tr><td>Enfant <strong>(<?php echo $nom_eleve . " " . $prenom_eleve; ?>)</strong> *:</td>
                                                <td><select id="eleve" name="eleve">
                                                        <?php
                                                        $listEleves = Eleve::recupBddActif();
                                                        foreach ($listEleves as $eleve) {
                                                            echo '<option value="' . $eleve->get_id() . '"';
                                                            if ($id_eleve == $eleve->get_id()) {
                                                                echo " selected ";
                                                            }
                                                            echo '>' . $eleve->get_personne()->get_nom() . " " . $eleve->get_personne()->get_prenom() . '</option>';
                                                        }
                                                        ?>
                                                    </select></td></tr>
                                            <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                        </table>
                                        <input type="submit" name="modifier" value="Modifier"/>
                                        <input type="submit" name="supprimer" value="Supprimer"/>
                                    </form>
                                </fieldset>
                                <br/>
                                <?php
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
