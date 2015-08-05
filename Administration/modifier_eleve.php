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
        <title>EDEIP - Modifier Elève</title>
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
                    <h3 class="centrer">Modifier Elève</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['modifier'])) {
                            if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['nom_eleve']) && !empty($_POST['nom_eleve']) && isset($_POST['prenom_eleve']) && !empty($_POST['prenom_eleve']) && isset($_POST['date_naiss_eleve']) && !empty($_POST['date_naiss_eleve']) && isset($_POST['date_inscription_eleve']) && !empty($_POST['date_inscription_eleve']) && isset($_POST['niveau']) && !empty($_POST['niveau']) && isset($_POST['adr_eleve']) && !empty($_POST['adr_eleve']) && isset($_POST['cp_adr_eleve']) && !empty($_POST['cp_adr_eleve']) && isset($_POST['ville_adr_eleve']) && !empty($_POST['ville_adr_eleve']) && isset($_POST['login_eleve']) && !empty($_POST['login_eleve'])) {
                                //on veux modifier un élève. On récupère et on sécurise
                                $id_eleve = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));
                                $nom_eleve = mysql_real_escape_string(htmlentities($_POST['nom_eleve'], ENT_QUOTES, 'UTF-8'));
                                $prenom_eleve = mysql_real_escape_string(htmlentities($_POST['prenom_eleve'], ENT_QUOTES, 'UTF-8'));
                                $adr_eleve = mysql_real_escape_string(htmlentities($_POST['adr_eleve'], ENT_QUOTES, 'UTF-8'));
                                $cp_adr_eleve = mysql_real_escape_string(htmlentities($_POST['cp_adr_eleve'], ENT_QUOTES, 'UTF-8'));
                                $ville_adr_eleve = mysql_real_escape_string(htmlentities($_POST['ville_adr_eleve'], ENT_QUOTES, 'UTF-8'));
                                $date_naiss_eleve = mysql_real_escape_string(htmlentities($_POST['date_naiss_eleve'], ENT_QUOTES, 'UTF-8'));
                                $date_naiss_eleve = date("Y-m-d", strtotime($date_naiss_eleve));
                                $date_inscription_eleve = mysql_real_escape_string(htmlentities($_POST['date_inscription_eleve'], ENT_QUOTES, 'UTF-8'));
                                $date_inscription_eleve = date("Y-m-d", strtotime($date_inscription_eleve));
                                $classe_actuelle_eleve = mysql_real_escape_string(htmlentities($_POST['niveau'], ENT_QUOTES, 'UTF-8'));
                                $login_eleve = mysql_real_escape_string(htmlentities($_POST['login_eleve'], ENT_QUOTES, 'UTF-8'));
                                $compl_adr_eleve = mysql_real_escape_string(htmlentities($_POST['compl_adr_eleve'], ENT_QUOTES, 'UTF-8'));

                                //la query est en plusieurs parties
                                $query = "UPDATE personne SET nom_personne = UPPER('$nom_eleve'), prenom_personne = '$prenom_eleve', adr_personne = '$adr_eleve'";
                                if (!empty($compl_adr_eleve)) {
                                    $query .= ", compl_adr_personne = '$compl_adr_eleve'";
                                }

                                $query .= ", cp_adr_personne = '$cp_adr_eleve', ville_adr_personne = '$ville_adr_eleve', login_personne = '$login_eleve', date_naiss = '$date_naiss_eleve', date_inscription = '$date_inscription_eleve' WHERE id_personne = '$id_eleve';";
                                $result = mysql_query($query);

                                $query = "UPDATE eleve SET id_niveau = '$classe_actuelle_eleve' WHERE id_eleve = '$id_eleve';";
                                $result = mysql_query($query);
                                echo "<p>La modification de l'élève a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de modification d'un élève n'est pas valide. Veuillez <a href='modifier_eleve.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['supprimer'])) {
                            if (isset($_POST['id']) && !empty($_POST['id'])) {
                                //on veux supprimer un eleve. On récupère et on sécurise
                                $id_eleve = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));

                                $query = "UPDATE personne SET etat_personne = '0' WHERE id_personne = '$id_eleve';";
                                $result = mysql_query($query);
                                echo "<p>La suppression de l'élève a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de suppression d'un élève n'est pas valide. Veuillez <a href='modifier_eleve.php'>réésayer</a></p>";
                            }
                        } else if (isset($_POST['reanimer'])) {
                            if (isset($_POST['id']) && !empty($_POST['id'])) {
                                //on veux reanimer un eleve. On récupère et on sécurise
                                $id_eleve = mysql_real_escape_string(htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'));

                                $query = "UPDATE personne SET etat_personne = '1' WHERE id_personne = '$id_eleve';";
                                $result = mysql_query($query);
                                echo "<p>La réanimation de l'élève a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de réanimation d'un élève n'est pas valide. Veuillez <a href='modifier_eleve.php'>réésayer</a></p>";
                            }
                        } else {
                            //on affiche les élèves
                            $form = true;
                        }

                        if ($form) {
                            $eleves = Eleve::recupBddActif();
                            foreach ($eleves as $eleve) {
                                $pers = $eleve->get_personne();

                                $id_eleve = $pers->get_id();
                                $date_naiss_eleve = date("d-m-Y", strtotime($pers->get_dateNaiss()));
                                $date_inscription_eleve = date("d-m-Y", strtotime($pers->get_dateInscription()));
                                $niveau_actuel_eleve = $eleve->get_niveau()->get_libelle();
                                $nom_eleve = $pers->get_nom();
                                $prenom_eleve = $pers->get_prenom();
                                $adr_eleve = $pers->get_adr();
                                $compl_adr_eleve = $pers->get_complAdr();
                                $cp_adr_eleve = $pers->get_cpAdr();
                                $ville_adr_eleve = $pers->get_ville();
                                $etat_eleve = $pers->get_etat();
                                $login_eleve = $pers->get_login();
                                ?>
                                <fieldset style="width: 790px;">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <table>
                                            <tr><td><input type="hidden" name="id" value="<?php echo $id_eleve; ?>">
                                            <tr><td>Nom * :</td><td><input type="text" required name="nom_eleve" value="<?php echo $nom_eleve; ?>"></td></tr>
                                            <tr><td>Prénom * :</td><td><input type="text" required name="prenom_eleve" value="<?php echo $prenom_eleve; ?>"></td></tr>
                                            <tr><td>Adresse * :</td><td><input type="text" required name="adr_eleve" value="<?php echo $adr_eleve; ?>"></td></tr>
                                            <tr><td>Complément d'adresse :</td><td><input type="text" name="compl_adr_eleve" value="<?php echo $compl_adr_eleve; ?>"></td></tr>
                                            <tr><td>Code postal * :</td><td><input type="text" required name="cp_adr_eleve" value="<?php echo $cp_adr_eleve; ?>"></td></tr>
                                            <tr><td>Ville * :</td><td><input type="text" name="ville_adr_eleve" required value="<?php echo $ville_adr_eleve; ?>"></td></tr>
                                            <tr><td>Date de naissance (JJ-MM-AAAA) * :</td><td><input type="text" required name="date_naiss_eleve" value="<?php echo $date_naiss_eleve; ?>"></td></tr>
                                            <tr><td>Date d'inscription (JJ-MM-AAAA) * :</td><td><input type="text" required name="date_inscription_eleve" value="<?php echo $date_inscription_eleve; ?>"></td></tr>
                                            <tr><td>Niveau actuel <strong>(<?php echo $niveau_actuel_eleve; ?>)</strong> *:</td>
                                                <td><select id="niveau" name="niveau">
                <?php
                $niveaux = Niveau::recupBdd();
                foreach($niveaux as $niv) {
                    echo '<option value="' . $niv->get_id() . '">' . $niv->get_libelle() . '</option>';
                }
                ?>
                                                    </select></td></tr>
                                            <tr><td>Login * :</td><td><input type="text" name="login_eleve" required value="<?php echo $login_eleve; ?>"></td></tr>
                                            <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                        </table>
                                        <input type="submit" name="modifier" value="Modifier"/>
                                                        <?php
                                                        if ($etat_eleve == 1) {
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
