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
        <title>EDEIP - Nouvel El&egrave;ve</title>
        <link rel="stylesheet" href="style_administration.css" type="text/css" media="screen"/>
        <link rel="shortcut icon" href="../images/Logo32.ico"/>                        
        <link rel="icon" href="../images/logo32.png" type="image/png"/>
        <script src="../include/jquery.js"></script>
    </head>
    <body>
        <div id='angle_rond'>
            <?php
            include '../include/include_header_administration.php';
            ?>
            <div class='corps'>
                <br/>
                <div class="titre_corps">
                    <h3 class="centrer">Nouvel El&egrave;ve</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['envoyer'])) {
                            if (isset($_POST['nom_eleve']) && !empty($_POST['nom_eleve']) && isset($_POST['prenom_eleve']) && !empty($_POST['prenom_eleve']) && isset($_POST['adr_eleve']) && !empty($_POST['adr_eleve']) && isset($_POST['cp_adr_eleve']) && !empty($_POST['cp_adr_eleve']) && isset($_POST['ville_adr_eleve']) && !empty($_POST['ville_adr_eleve']) && isset($_POST['date_naiss_eleve']) && !empty($_POST['date_naiss_eleve']) && isset($_POST['date_inscription_eleve']) && !empty($_POST['date_inscription_eleve']) && isset($_POST['niveau']) && !empty($_POST['niveau'])) {
                                //on veux cr&eacute;er un nouvel admin. On r&eacute;cup&agrave;¨re et on s&eacute;curise
                                $nom_personne = mysql_real_escape_string(htmlentities($_POST['nom_eleve'], ENT_QUOTES, 'UTF-8'));
                                $prenom_personne = mysql_real_escape_string(htmlentities($_POST['prenom_eleve'], ENT_QUOTES, 'UTF-8'));
                                $adr_personne = mysql_real_escape_string(htmlentities($_POST['adr_eleve'], ENT_QUOTES, 'UTF-8'));
                                $compl_adr_personne = mysql_real_escape_string(htmlentities($_POST['compl_adr_eleve'], ENT_QUOTES, 'UTF-8'));
                                $cp_adr_personne = mysql_real_escape_string(htmlentities($_POST['cp_adr_eleve'], ENT_QUOTES, 'UTF-8'));
                                $ville_adr_personne = mysql_real_escape_string(htmlentities($_POST['ville_adr_eleve'], ENT_QUOTES, 'UTF-8'));
                                $date_naiss_eleve = mysql_real_escape_string(htmlentities($_POST['date_naiss_eleve'], ENT_QUOTES, 'UTF-8'));
                                $date_naiss_eleve = date("Y-m-d", strtotime($date_naiss_eleve));
                                $date_inscription_eleve = mysql_real_escape_string(htmlentities($_POST['date_inscription_eleve'], ENT_QUOTES, 'UTF-8'));
                                $date_inscription_eleve = date("Y-m-d", strtotime($date_inscription_eleve));
                                $classe_actuelle_eleve = mysql_real_escape_string(htmlentities($_POST['niveau'], ENT_QUOTES, 'UTF-8'));
                                $mdp1 = "123Soleil";
                                $mdp = hash('sha256', $mdp1);
                                
                                $login = strtolower($prenom_personne.".".$nom_personne); //prenom.nom

                                $eleve = new Personne('', $nom_personne, $prenom_personne, $adr_personne, $compl_adr_personne, $cp_adr_personne, $ville_adr_personne, $login, $mdp, 4, 1, '', $date_naiss_eleve, $date_inscription_eleve);
                                
                                $eleve->INSERT();
                                
                                $query = "INSERT INTO eleve (id_eleve, id_niveau) VALUES ('".$eleve->get_id()."', '$classe_actuelle_eleve');";
                                if (mysql_query($query)){
                                    echo "<p>L'inscription du nouvel eleve a bien &eacute;t&eacute; prise en compte. Retour &agrave; l'<a href='administration.php'>administration</a></p>";
                                }
                                else {
                                    echo "<p>Une erreur est survenue dans la cr&eacute;ation de l'eleve. Veuillez <a href='nouvel_eleve.php'>r&eacute;&eacute;sayer</a></p>";
                                }
                                
                            } else {
                                echo "<p>Votre demande d'inscription d'un nouvel &eacute;l&egrave;ve n'est pas valide. Veuillez <a href='nouvel_eleve.php'>r&eacute;&eacute;sayer</a></p>";
                            }
                        } else {
                            $form = true;
                        }

                        if ($form) {
                            ?>
                            <fieldset style="width: 790px;"><legend>Nouvel &eacute;l&egrave;ve</legend>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <table>
                                        <tr><td>Nom * :</td><td><input type="text" required name="nom_eleve"></td></tr>
                                        <tr><td>Pr&eacute;nom * :</td><td><input type="text" required name="prenom_eleve"></td></tr>
                                        <tr><td>Adresse * :</td><td><input type="text" required name="adr_eleve"></td></tr>
                                        <tr><td>Compl&eacute;ment d'adresse :</td><td><input type="text" name="compl_adr_eleve"></td></tr>
                                        <tr><td>Code postal * :</td><td><input type="text" required name="cp_adr_eleve"></td></tr>
                                        <tr><td>Ville * :</td><td><input type="text" required name="ville_adr_eleve"></td></tr>
                                        <tr><td>Date de naissance (JJ-MM-AAAA) * :</td><td><input type="text" required name="date_naiss_eleve"></td></tr>
                                        <tr><td>Date d'inscription (JJ-MM-AAAA) * :</td><td><input type="text" required name="date_inscription_eleve"></td></tr>
                                        <tr><td>Niveau actuel * :</td>
                                            <td><select id="niveau" name="niveau">
                                                <?php
                                                    $niveaux = Niveau::recupBdd();
                                                    foreach ($niveaux as $niv) {
                                                        echo '<option value="'.$niv->get_id().'">'.$niv->get_libelle().'</option>';
                                                    }
                                                ?>
                                                </select></td></tr>
                                        <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                                    </table>
                                    <input type="submit" name="envoyer" value="Envoyer"/>
                                </form>
                            </fieldset>
                            <br/>
                            <?php
                        }
                    } else {
                        echo "<p>Vous devez &eacirc;tre administrateur pour acc&eacute;der &agrave;  cette page. <a href='../intranet/intranet.php'>Retourner &agrave;  L'intranet</a></p>";
                    }
                } else {
                    echo "<p>Vous devez &eacirc;tre connect&eacute; pour acc&eacute;der &agrave;  cette page. <a href='../vitrine/connexion.php'>Merci de vous connecter</a></p>";
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
