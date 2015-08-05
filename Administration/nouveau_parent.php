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
        <title>EDEIP - Nouveau Parent</title>
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
                    <h3 class="centrer">Nouveau Parent</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['envoyer'])) {
                            if (isset($_POST['nom_parent']) && !empty($_POST['nom_parent']) && isset($_POST['prenom_parent']) && !empty($_POST['prenom_parent']) && isset($_POST['mail_parent']) && !empty($_POST['mail_parent'])) {
                                //on veux créer un nouvel admin. On récupère et on sécurise
                                $nom_personne = mysql_real_escape_string(htmlentities($_POST['nom_parent'],ENT_QUOTES,'UTF-8'));
                                $prenom_personne = mysql_real_escape_string(htmlentities($_POST['prenom_parent'],ENT_QUOTES,'UTF-8'));
                                $adr_personne = mysql_real_escape_string(htmlentities($_POST['adr_parent'],ENT_QUOTES,'UTF-8'));
                                $compl_adr_personne = mysql_real_escape_string(htmlentities($_POST['compl_adr_parent'],ENT_QUOTES,'UTF-8'));
                                $cp_adr_personne = mysql_real_escape_string(htmlentities($_POST['cp_adr_parent'],ENT_QUOTES,'UTF-8'));
                                $ville_adr_personne = mysql_real_escape_string(htmlentities($_POST['ville_adr_parent'],ENT_QUOTES,'UTF-8'));
                                $mail_parent = mysql_real_escape_string(htmlentities($_POST['mail_parent'],ENT_QUOTES,'UTF-8'));
                                $mdp1 = "123Soleil";
                                $mdp = hash('sha256', $mdp1);
                                $login = strtolower($prenom_personne.".".$nom_personne); //prenom.nom

                                $query = "INSERT INTO personne (nom_personne, prenom_personne, adr_personne, compl_adr_personne, cp_adr_personne, ville_adr_personne, login_personne, mdp_personne, niveau_habilitation_personne ,etat_personne, mail)"
                                        . " VALUES (UPPER('$nom_personne'), '$prenom_personne', '$adr_personne', '$compl_adr_personne', '$cp_adr_personne', '$ville_adr_personne', '$login', '$mdp', '3', '1', '$mail_parent');";
                                $result = mysql_query($query);
                                
                                $query = "SELECT * FROM personne ORDER BY id_personne DESC;";
                                $result = mysql_query($query);
                                $infos = mysql_fetch_array($result);
                                $id_parent = $infos['id_personne'];
                                
                                $query = "INSERT INTO parents (id_parent) VALUES ('$id_parent');";
                                if (mysql_query($query)){
                                    echo "<p>L'inscription du nouveau parent a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                                }
                                else {
                                    echo "<p>Une erreur est survenue dans la création du parent. Veuillez <a href='nouveau_parent.php'>réésayer</a></p>";
                                }
                            }
                            else {
                                echo "<p>Votre demande d'inscription d'un nouveau parent n'est pas valide. Veuillez <a href='nouveau_parent.php'>réésayer</a></p>";
                            }
                        }
                        else {
                            $form = true;
                        }
                        
                        if ($form) {
                            ?>
                            <fieldset style="width: 790px;"><legend>Nouveau parent</legend>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <table>
                                        <tr><td>Nom * :</td><td><input type="text" required name="nom_parent"></td></tr>
                                        <tr><td>Prénom * :</td><td><input type="text" required name="prenom_parent"></td></tr>
                                        <tr><td>Adresse * :</td><td><input type="text" name="adr_parent"></td></tr>
                                        <tr><td>Complément d'adresse :</td><td><input type="text" name="compl_adr_parent"></td></tr>
                                        <tr><td>Code postal * :</td><td><input type="text" name="cp_adr_parent"></td></tr>
                                        <tr><td>Ville * :</td><td><input type="text" name="ville_adr_parent"></td></tr>
                                        <tr><td>Mail * :</td><td><input type="text" required name="mail_parent"></td></tr>
                                        <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                    </table>
                                    <input type="submit" name="envoyer" value="Envoyer"/>
                                </form>
                            </fieldset>
                            <br/>
                            <?php
                        }
                    }
                    else {
                        echo "<p>Vous devez être administrateur pour accéder à cette page. <a href='../intranet/intranet.php'>Retourner à L'intranet</a></p>";
                    }
                }
                else {
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
