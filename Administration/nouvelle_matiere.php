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
        <title>EDEIP - Nouvelle Matière</title>
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
                    <h3 class="centrer">Nouvelle Matière</h3>
                </div>
                <?php
                if (isset($personne)) {
                    if ($personne->get_estAmdin()) {
                        if (isset($_POST['envoyer'])) {
                            if (isset($_POST['matiere']) && !empty($_POST['matiere']) && isset($_POST['professeur']) && !empty($_POST['professeur']) && isset($_POST['niveau']) && !empty($_POST['niveau'])) {
                                // on veux créer une nouvelle matière. On récupère et on sécurise
                                $nom_matiere = mysql_real_escape_string(htmlentities($_POST['matiere'], ENT_QUOTES, 'UTF-8'));
                                $id_professeur = mysql_real_escape_string(htmlentities($_POST['professeur'], ENT_QUOTES, 'UTF-8'));
                                $id_niveau = mysql_real_escape_string(htmlentities($_POST['niveau'], ENT_QUOTES, 'UTF-8'));

                                switch ($id_niveau) {
                                    case 'TOUS':
                                        $niveau = Niveau::recupBdd();
                                        foreach ($niveau as $niv) {
                                            $matiere = new Matiere("", $nom_matiere, $niv->get_id(), $id_professeur);
                                            $matiere->INSERT();
                                        }
                                        break;
                                    
                                    case 'PRIMAIRE':
                                        $niveau = Niveau::recupPrimaire();
                                        foreach ($niveau as $niv) {
                                            $matiere = new Matiere("", $nom_matiere, $niv->get_id(), $id_professeur);
                                            $matiere->INSERT();
                                        }
                                        break;

                                    case 'SECONDAIRE':
                                        $niveau = Niveau::recupSecondaire();
                                        foreach ($niveau as $niv) {
                                            $matiere = new Matiere("", $nom_matiere, $niv->get_id(), $id_professeur);
                                            $matiere->INSERT();
                                        }
                                        break;

                                    default:
                                        $matiere = new Matiere("", $nom_matiere, $id_niveau, $id_professeur);
                                        $matiere->INSERT();
                                        break;
                                }
                                

                                echo "<p>L'inscription de la nouvelle matière a bien été prise en compte. Retour à l'<a href='administration.php'>administration</a></p>";
                            } else {
                                echo "<p>Votre demande de nouvelle matière n'est pas valide. Veuillez <a href='nouvelle_matiere.php'>réésayer</a></p>";
                            }
                        } else {
                            $form = true;
                        }

                        if ($form) {
                            ?>
                            <fieldset style="width: 790px;"><legend>Nouvelle matière</legend>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <table>
                                        <tr><td>Nom professeur * :</td>
                                            <td><select id="professeur" name="professeur">
                                                    <?php
                                                    $professeurs = Professeur::recupBddActif();
                                                    foreach ($professeurs as $prof) {
                                                        echo '<option value="'.$prof->get_id().'">'.$prof->get_personne()->get_nom()." ".$prof->get_personne()->get_prenom().'</option>';
                                                    }
                                                    ?>
                                                </select></td></tr>
                                        <tr><td>Libellé niveau * :</td>
                                            <td><select id="niveau" name="niveau">
                                                    <option value="TOUS">TOUS</option>
                                                    <option value="PRIMAIRE">PRIMAIRE</option>
                                                    <option value="SECONDAIRE">SECONDAIRE</option>
                                                    <?php
                                                    $niveaux = Niveau::recupBdd();
                                                    foreach ($niveaux as $niv) {
                                                        echo '<option value="'.$niv->get_id().'">'.$niv->get_libelle().'</option>';
                                                    }
                                                    ?>
                                                </select></td></tr>
                                        <tr><td>Nom matière * :</td><td><input type="text" required id="matiere" name="matiere"></td></tr>
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
