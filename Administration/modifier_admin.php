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
        <title>EDEIP - Modifier Admin</title>
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
                    <h3 class="centrer">Modifier Admin</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['modifier'])) {
                            if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['nom_admin']) && !empty($_POST['nom_admin']) && isset($_POST['prenom_admin']) && !empty($_POST['prenom_admin']) && isset($_POST['mail_admin']) && !empty($_POST['mail_admin']) && isset($_POST['login_admin']) && !empty($_POST['login_admin'])) {
                                //on veux modifier un admin. On récupère et on sécurise
                                $id_admin = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));
                                $nom_admin = mysql_real_escape_string(htmlentities($_POST['nom_admin'], ENT_QUOTES, 'UTF-8'));
                                $prenom_admin = mysql_real_escape_string(htmlentities($_POST['prenom_admin'], ENT_QUOTES, 'UTF-8'));
                                $mail_admin = mysql_real_escape_string(htmlentities($_POST['mail_admin'], ENT_QUOTES, 'UTF-8'));
                                $login_admin = mysql_real_escape_string(htmlentities($_POST['login_admin'], ENT_QUOTES, 'UTF-8'));
                                $adr_admin = mysql_real_escape_string(htmlentities($_POST['adr_admin'], ENT_QUOTES, 'UTF-8'));
                                $compl_adr_admin = mysql_real_escape_string(htmlentities($_POST['compl_adr_admin'], ENT_QUOTES, 'UTF-8'));
                                $cp_adr_admin = mysql_real_escape_string(htmlentities($_POST['cp_adr_admin'], ENT_QUOTES, 'UTF-8'));
                                $ville_adr_admin = mysql_real_escape_string(htmlentities($_POST['ville_adr_admin'], ENT_QUOTES, 'UTF-8'));


                                //on remplit la requête en fonction des données reçues
                                $query = "UPDATE personne SET nom_personne = UPPER('$nom_admin'), prenom_personne = '$prenom_admin'";
                                if (!empty($adr_admin)) {
                                    $query .= ", adr_personne = '$adr_admin'";
                                }
                                if (!empty($compl_adr_admin)) {
                                    $query .= ", compl_adr_personne = '$compl_adr_admin'";
                                }
                                if (!empty($cp_adr_admin)) {
                                    $query .= ", cp_adr_personne = '$cp_adr_admin'";
                                }
                                if (!empty($ville_adr_admin)) {
                                    $query .= ", ville_adr_personne = '$ville_adr_admin'";
                                }
                                //fin de la requête
                                $query .= ", login_personne = '$login_admin', mail = '$mail_admin' WHERE id_personne = '$id_admin';";
                                $result = mysql_query($query);

                                echo "<p>La modification de l'admin a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de modification d'un admin n'est pas valide. Veuillez <a href='modifier_admin.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['supprimer'])) {
                            if (isset($_POST['id']) && !empty($_POST['id'])) {
                                //on veux supprimer un admin. On récupère et on sécurise
                                $id_admin = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));

                                $query = "UPDATE personne SET etat_personne = '0' WHERE id_personne = '$id_admin';";
                                $result = mysql_query($query);
                                echo "<p>La suppression de l'admin a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de suppression d'un admin n'est pas valide. Veuillez <a href='modifier_admin.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['reanimer'])) {
                            if (isset($_POST['id']) && !empty($_POST['id'])) {
                                //on veux réanimer un admin. On récupère et on sécurise
                                $id_admin = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));

                                $query = "UPDATE personne SET etat_personne = '1' WHERE id_personne = '$id_admin';";
                                $result = mysql_query($query);
                                mysql_close($db);
                                echo "<p>La réanimation de l'admin a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de réanimation d'un admin n'est pas valide. Veuillez <a href='modifier_admin.php'>réésayer</a></p>";
                            }
                        } else {
                            //on affiche les administrateurs
                            $form = true;
                        }

                        if ($form) {
                            $admins = Admin::recupBdd();
                            foreach ($admins as $admin) {
                                $pers = $admin->get_personne();
                                $id_admin = $pers->get_id();
                                $mail_admin = $pers->get_mail();
                                $nom_admin = $pers->get_nom();
                                $prenom_admin = $pers->get_prenom();
                                $adr_admin = $pers->get_adr();
                                $compl_adr_admin = $pers->get_complAdr();
                                $cp_adr_admin = $pers->get_cpAdr();
                                $ville_adr_admin = $pers->get_ville();
                                $etat_admin = $pers->get_etat();
                                $login_admin = $pers->get_login();
                                ?>
                                <fieldset style="width: 790px;">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <table>
                                            <tr><td><input type="hidden" name="id" value="<?php echo $id_admin; ?>">
                                            <tr><td>Nom * :</td><td><input type="text" required name="nom_admin" value="<?php echo $nom_admin; ?>"></td></tr>
                                            <tr><td>Prénom * :</td><td><input type="text" required name="prenom_admin" value="<?php echo $prenom_admin; ?>"></td></tr>
                                            <tr><td>Adresse :</td><td><input type="text" name="adr_admin" value="<?php echo $adr_admin; ?>"></td></tr>
                                            <tr><td>Complément d'adresse :</td><td><input type="text" name="compl_adr_admin" value="<?php echo $compl_adr_admin; ?>"></td></tr>
                                            <tr><td>Code postal :</td><td><input type="text" name="cp_adr_admin" value="<?php echo $cp_adr_admin; ?>"></td></tr>
                                            <tr><td>Ville :</td><td><input type="text" name="ville_adr_admin" value="<?php echo $ville_adr_admin; ?>"></td></tr>
                                            <tr><td>Mail * :</td><td><input type="text" required name="mail_admin" value="<?php echo $mail_admin; ?>"></td></tr>
                                            <tr><td>Login * :</td><td><input type="text" required name="login_admin" value="<?php echo $login_admin; ?>"></td></tr>
                                            <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                        </table>
                                        <input type="submit" name="modifier" value="Modifier"/>
                <?php
                if ($etat_admin == 1) {
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
