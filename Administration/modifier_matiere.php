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
        <title>EDEIP - Modifier Matière</title>
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
                    <h3 class="centrer">Modifier Matière</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['modifier'])) {
                            if (isset($_POST['matiere']) && !empty($_POST['matiere']) && isset($_POST['niveau']) && !empty($_POST['niveau']) && isset($_POST['professeur']) && !empty($_POST['professeur'])) {
                                //on veux modifier une matière. On récupère et on sécurise
                                $id_matiere = mysql_real_escape_string(htmlentities($_POST['id_matiere'], ENT_QUOTES, 'UTF-8'));
                                $nom_matiere = mysql_real_escape_string(htmlentities($_POST['matiere'], ENT_QUOTES, 'UTF-8'));
                                $id_niveau = mysql_real_escape_string(htmlentities($_POST['niveau'], ENT_QUOTES, 'UTF-8'));
                                $id_professeur = mysql_real_escape_string(htmlentities($_POST['professeur'], ENT_QUOTES, 'UTF-8'));

                                //on modifie la matière
                                $matiere = Matiere::getById($idMatiere);
                                $matiere->set_nom($nom_matiere);
                                $matiere->set_niveau($id_niveau);
                                $matiere->set_prof($id_professeur);
                                $matiere->UPDATE();
                                /* $query = "UPDATE T_MATIERE SET nom_matiere= '$nom_matiere', id_niveau = '$id_niveau' WHERE id_matiere = '$id_matiere';";
                                  $result = mysql_query($query);

                                  //on modifie la tj
                                  $query = "UPDATE TJ_ENSEIGNER SET id_professeur= '$id_professeur', id_matiere = '$id_matiere', id_niveau = '$id_niveau' WHERE id_matiere = '$id_matiere';";
                                  $result = mysql_query($query); */
                                echo "<p>La modification de la matière a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de modification d'une matière n'est pas valide. Veuillez <a href='modifier_matiere.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['supprimer'])) {
                            if (isset($_POST['id_matiere']) && !empty($_POST['id_matiere'])) {
                                //on veux supprimer une matière. On récupère et on sécurise
                                $id_matiere = mysql_real_escape_string(htmlentities($_POST['id_matiere'], ENT_QUOTES, 'UTF-8'));
                                $query = "DELETE FROM matiere WHERE id_matiere = '$id_matiere';";
                                if (mysql_query($query)) {
                                    echo "<p>La suppression de la matière a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                                } else {
                                    echo "<p>La suppression de la matière n'a pas pu être prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                                }
                            } else {
                                echo "<p>Votre demande de suppression d'une matière n'est pas valide. Veuillez <a href='modifier_matiere.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['liste']) && !empty($_POST['liste'])) {
                            $i = mysql_real_escape_string(htmlentities($_POST['liste'], ENT_QUOTES, 'UTF-8'));
                            $niveau = Niveau::getById($i);
                            echo '<div class="sous_titre_corps"><h4 class="centrer">' . $niveau->get_libelle() . ' :</h4></div>';

                            $matieres = Matiere::getByNiveau($niveau->get_id());
                            foreach ($matieres as $mat) {
                                ?>
                                <fieldset style="width: 790px;">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <table>
                                            <tr><td><input type="hidden" name="id_matiere" value="<?php echo $mat->get_id(); ?>">
                                            <tr><td>Matière *:</td><td><input type="text" required id="matiere" name="matiere" value="<?php echo $mat->get_nom(); ?>">
                                            <tr><td>Niveau <strong>(<?php echo $niveau->get_libelle(); ?>)</strong> *:</td>
                                                <td><select id="niveau" name="niveau">
                                                        <?php
                                                        $niveaux = Niveau::recupBdd();
                                                        foreach ($niveaux as $niv) {
                                                            echo '<option value="' . $niv->get_id() . '" ';
                                                            if ($niv->get_id() == $niveau->get_id()) {
                                                                echo " selected ";
                                                            }
                                                            echo '>' . $niv->get_libelle() . '</option>';
                                                        }
                                                        ?>
                                                    </select></td></tr>
                                            <tr><td>Professeur <strong>(<?php echo $mat->get_prof()->get_personne()->get_nom() . " " . $mat->get_prof()->get_personne()->get_prenom(); ?>)</strong> *:</td><td><select id="professeur" name="professeur">
                                                        <?php
                                                        $profs = professeur::recupBddActif();
                                                        foreach ($profs as $prof) {
                                                            echo '<option value="' . $prof->get_id() . '" ';
                                                            if ($prof->get_id() == $mat->get_prof()->get_id()) {
                                                                echo " selected ";
                                                            }
                                                            echo '>' . $prof->get_personne()->get_nom() . " " . $prof->get_personne()->get_prenom() . '</option>';
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
                        } else {
                            //on affiche les matières
                            $form = true;
                        }

                        if ($form) {
                            ?>
                            <form method="POST" action="./modifier_matiere.php">
                                <table>
                                    <tr>
                                        <td>Niveau :</td>
                                        <td><select id="liste" name="liste">
                                                <?php
                                                $niveaux = Niveau::recupBdd();
                                                foreach ($niveaux as $niv) {
                                                    echo '<option value="' . $niv->get_id() . '">' . $niv->get_libelle() . '</option>';
                                                }
                                                ?>

                                            </select></td>

                                    </tr>
                                    <tr><td><input type="submit" name="consulter" value="Consulter"/></td></tr>
                                </table>
                                <br/>
                                <br/>
                            </form>
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
