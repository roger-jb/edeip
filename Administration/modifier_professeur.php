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
        <title>EDEIP - Modifier Professeur</title>
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
                    <h3 class="centrer">Modifier Professeur</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['modifier'])) {
                            if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['nom_professeur']) && !empty($_POST['nom_professeur']) && isset($_POST['prenom_professeur']) && !empty($_POST['prenom_professeur']) && isset($_POST['mail_professeur']) && !empty($_POST['mail_professeur']) && isset($_POST['login_professeur']) && !empty($_POST['login_professeur'])) {
                                //on veux modifier un admin. On récupère et on sécurise
                                $id_professeur = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));
                                $nom_professeur = mysql_real_escape_string(htmlentities($_POST['nom_professeur'], ENT_QUOTES, 'UTF-8'));
                                $prenom_professeur = mysql_real_escape_string(htmlentities($_POST['prenom_professeur'], ENT_QUOTES, 'UTF-8'));
                                $adr_professeur = mysql_real_escape_string(htmlentities($_POST['adr_professeur'], ENT_QUOTES, 'UTF-8'));
                                $compl_adr_professeur = mysql_real_escape_string(htmlentities($_POST['compl_adr_professeur'], ENT_QUOTES, 'UTF-8'));
                                $cp_adr_professeur = mysql_real_escape_string(htmlentities($_POST['cp_adr_professeur'], ENT_QUOTES, 'UTF-8'));
                                $ville_adr_professeur = mysql_real_escape_string(htmlentities($_POST['ville_adr_professeur'], ENT_QUOTES, 'UTF-8'));
                                $mail_professeur = mysql_real_escape_string(htmlentities($_POST['mail_professeur'], ENT_QUOTES, 'UTF-8'));
                                $login_professeur = mysql_real_escape_string(htmlentities($_POST['login_professeur'], ENT_QUOTES, 'UTF-8'));

                                //la query est en plusieurs parties
                                $query = "UPDATE personne SET nom_personne = UPPER('$nom_professeur'), prenom_personne = '$prenom_professeur'";
                                if (!empty($adr_professeur)) {
                                    $query .= ", adr_personne = '$adr_professeur'";
                                }
                                if (!empty($compl_adr_professeur)) {
                                    $query .= ", compl_adr_personne = '$compl_adr_professeur'";
                                }
                                if (!empty($cp_adr_professeur)) {
                                    $query .= ", cp_adr_personne = '$cp_adr_professeur'";
                                }
                                if (!empty($ville_adr_professeur)) {
                                    $query .= ", ville_adr_personne = '$ville_adr_professeur'";
                                }
                                
                                $query .= ", login_personne = '$login_professeur',  mail = '$mail_professeur' WHERE id_personne = '$id_professeur';";
                                mysql_query($query);

                                echo "<p>La modification du professeur a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de modification d'un professeur n'est pas valide. Veuillez <a href='modifier_professeur.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['supprimer'])) {
                            if (isset($_POST['id']) && !empty($_POST['id'])) {
                                //on veux supprimer un professeur. On récupère et on sécurise
                                $id_professeur = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));

                                $query = "UPDATE personne SET etat_personne = '0' WHERE id_personne = '$id_professeur';";
                                $result = mysql_query($query);
                                echo "<p>La suppression du professeur a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de suppression d'un professeur n'est pas valide. Veuillez <a href='modifier_professeur.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['reanimer'])) {
                            if (isset($_POST['id']) && !empty($_POST['id'])) {
                                //on veux réanimer un professeur. On récupère et on sécurise
                                $id_professeur = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));

                                $query = "UPDATE personne SET etat_personne = '1' WHERE id_personne = '$id_professeur';";
                                $result = mysql_query($query);
                                echo "<p>La réanimation du professeur a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de réanimation d'un professeur n'est pas valide. Veuillez <a href='modifier_professeur.php'>réésayer</a></p>";
                            }
                        } else {
                            //on affiche les professeurs
                            $form = true;
                        }

                        if ($form) {
                            $professeurs = Professeur::recupBddActif();
                            foreach ($professeurs as $prof) {
                                $pers = $prof->get_personne();
                                $id_professeur = $pers->get_id();
                                $mail_professeur = $pers->get_mail();
                                $nom_professeur = $pers->get_nom();
                                $prenom_professeur = $pers->get_prenom();
                                $adr_professeur = $pers->get_adr();
                                $compl_adr_professeur = $pers->get_complAdr();
                                $cp_adr_professeur = $pers->get_cpAdr();
                                $ville_adr_professeur = $pers->get_ville();
                                $etat_professeur = $pers->get_etat();
                                $login_professeur = $pers->get_login();
                                ?>
                                <fieldset style="width: 790px;">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <table>
                                            <tr><td><input type="hidden" name="id" value="<?php echo $prof->get_personne()->get_id(); ?>">
                                            <tr><td>Nom * :</td><td><input type="text" required name="nom_professeur" value="<?php echo $prof->get_personne()->get_nom(); ?>"></td></tr>
                                            <tr><td>Prénom * :</td><td><input type="text" required name="prenom_professeur" value="<?php echo $prof->get_personne()->get_prenom(); ?>"></td></tr>
                                            <tr><td>Adresse :</td><td><input type="text" name="adr_professeur" value="<?php echo $prof->get_personne()->get_adr(); ?>"></td></tr>
                                            <tr><td>Complément d'adresse :</td><td><input type="text" name="compl_adr_professeur" value="<?php echo $prof->get_personne()->get_complAdr(); ?>"></td></tr>
                                            <tr><td>Code postal :</td><td><input type="text" name="cp_adr_professeur" value="<?php echo $prof->get_personne()->get_cpAdr(); ?>"></td></tr>
                                            <tr><td>Ville :</td><td><input type="text" name="ville_adr_professeur" value="<?php echo $prof->get_personne()->get_ville(); ?>"></td></tr>
                                            <tr><td>Mail * :</td><td><input type="text" required name="mail_professeur" value="<?php echo $prof->get_personne()->get_mail(); ?>"></td></tr>
                                            <tr><td>Login * :</td><td><input type="text" required name="login_professeur" value="<?php echo $prof->get_personne()->get_login(); ?>"></td></tr>
                                            <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                        </table>
                                        <input type="submit" name="modifier" value="Modifier"/>
                                        <?php
                                        if ($etat_professeur == 1) {
                                            ?>
                                            <input type="submit" name="supprimer" value="Supprimer"/>
                                            <?php
                                        } else {
                                            ?>
                                            <input type="submit" name="reanimer" value="Réanimer"/>
                                            <?php
                                        }
                                        ?>
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
