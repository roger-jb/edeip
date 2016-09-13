<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 10/08/2015
 * Time: 19:29
 */
header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';

$msgErreur = "";
$utilisateur = new Utilisateur();
if (isset($_POST['connexion'])) {
    $connexion = new Connexion();
    if (isset($_POST['loginUtilisateur']) && !empty($_POST['loginUtilisateur']) && isset($_POST['mdpUtilisateur']) && !empty($_POST['mdpUtilisateur'])) {
        $connexion = $connexion->connecter($_POST['loginUtilisateur'], $_POST['mdpUtilisateur']);
        if (empty($connexion->getIdUtilisateur())) {
            $msgErreur .= "Le couple identifiant / Mot de passe incorrect";
        } else {
            $_SESSION['id'] = $connexion->getIdUtilisateur();
        }
    } else {
        if (!isset($_POST['loginUtilisateur']) || empty($_POST['loginUtilisateur'])) {
            $msgErreur .= "Veuillez saisir votre identifiant<br/>";
        }
        if (!isset($_POST['mdpUtilisateur']) || empty($_POST['mdpUtilisateur'])) {
            $msgErreur .= "Veuillez saisir votre mot de passe<br/>";
        }
    }
}

if (isset($_GET['deco'])) {
    $_SESSION = array();
    session_destroy();
}

if (isset($_SESSION['id'])) {
    $utilisateur = Utilisateur::getById($_SESSION['id']);
}

if (!empty($utilisateur->getIdUtilisateur())) {
    header('Location: ../Intranet/MesInformations.php');
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Connexion &agrave; l'Intranet</title>
        <link rel="stylesheet" href="./style.css" type="text/css" media="screen"/>
        <link rel="shortcut icon" href="../Images/Logo32.ico"/>
        <link rel="icon" href="../Images/logo32.png" type="image/png"/>
    </head>
    <body>
    <div id='angle_rond'>
        <?php
        include '../Include/include_header.php';
        ?>
        <div id="corps">
            <div class="titre_corps">
                <h3 class="centrer">Connexion &aacute; l'Intranet EDEIP</h3>
            </div>
            <fieldset style="width: 30%; margin: auto;">
                <legend>Vos informations de connexion</legend>
                <?php
                if (!empty($msgErreur)) {
                    echo '<div style="color:red;">' . $msgErreur . '</div>';
                }
                ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table>
                        <tr>
                            <td><label for="login">Identifiant :</label></td>
                            <td><input id="login" type="text" size="20" name="loginUtilisateur"/></td>
                        </tr>
                        <tr>
                            <td><label for="mdp">Mot de passe :</label></td>
                            <td><input id="mdp" type="password" size="20" name="mdpUtilisateur"/></td>
                        </tr>
                    </table>
                    <input type="submit" name="connexion" value="Connexion"/>
                </form>
            </fieldset>
            <br/>

            <p style="width: 60%; margin: auto;">En cas de probleme de connexion, veuillez envoyer un mail &agrave; <a
                    href="mailto:support@edeip-lyon.fr"
                    style='color:#65B1FF;'>support@edeip-lyon.fr</a>
            </p>
        </div>
        <?php
        include '../Include/include_footer.php';
        ?>
    </div>

    </body>
    </html>
    <?php
} // fin du if ($form)
db_connect::close();
?>
