<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 10/08/2015
 * Time: 19:48
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
$user = new Utilisateur();
$msg = "";
$msgMdP = "";
if (isset($_SESSION['id'])) {
    $utilisateur = Utilisateur::getById($_SESSION['id']);
} else {
    header('location: ../Intranet/Connexion.php');
}

if (isset($_GET['id']) && (!empty($_GET['id'])))
    $user = Utilisateur::getById($_GET['id']);
else
    $user = Utilisateur::getById($_SESSION['id']);

if (isset($_POST['update'])) {
    if (!empty($_POST['idUtilisateur'])) {
        $user = Utilisateur::getById($_POST['idUtilisateur']);
        if (!empty($_POST['nomUtilisateur']))
            $user->setNomUtilisateur(htmlspecialchars($_POST['nomUtilisateur']));
        if (!empty($_POST['prenomUtilisateur']))
            $user->setPrenomUtilisateur(htmlspecialchars($_POST['prenomUtilisateur']));
        $user->setAdr1Utilisateur($_POST['adr1Utilisateur']);
        $user->setAdr2Utilisateur($_POST['adr2Utilisateur']);
        $user->setCpUtilisateur($_POST['cpUtilisateur']);
        $user->setVilleUtilisateur($_POST['villeUtilisateur']);
        $user->setMailUtilisateur($_POST['mailUtilisateur']);

        $user->update();

        $connexion = Connexion::getById($user->getIdUtilisateur());
        if ((isset($_POST['mdpUtilisateur']) && !empty($_POST['mdpUtilisateur'])) && (isset($_POST['mdpUtilisateurConfirm']) && !empty($_POST['mdpUtilisateurConfirm'])) && ($_POST['mdpUtilisateur'] == $_POST['mdpUtilisateurConfirm'])) {
            $connexion->setMdpUtilisateur($_POST['mdpUtilisateur']);
            if (!$connexion->update()) {
                $msg .= "Le mot de Passe n'a pas pu être changé";
            }
        }
    }
}

$check = new Connexion();
$connect = Connexion::getById($user->getIdUtilisateur());
$check->setMdpUtilisateur('123Soleil');
if ($check->getMdpUtilisateur() == $connect->getMdpUtilisateur())
    $msgMdP = "Il est pr&eacute;f&eacute;rable de changer de mot de passe";


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Mes Informations</title>
    <link rel="stylesheet" href="../Intranet/styleIntranet.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
    <link rel="shortcut icon" href="../images/Logo32.ico"/>
    <link rel="icon" href="../images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jQuery.js"></script>
<div id='angle_rond'>
    <?php
    include '../include/include_header.php';
    ?>
    <div id="content">
        <div id="menuLeft">
            <?php
            require_once('../Intranet/menuIntranet.php');
            ?>
        </div>
        <div id="corps">
            <div class="titre_corps">
                <h3 class="centrer">Mes Informations</h3>
            </div>
            <?php
            if (!empty($msg))
                echo '<div style="width: 50%; color: red; margin: auto;">' . $msg . '</div>';
            if (!empty($msgMdP))
                echo '<div style="width: 50%; color: red; margin: auto;">' . $msgMdP . '</div>';
            ?>
            <fieldset style="width: 70%; margin: auto;">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=2">
                    <table>
                        <tr>
                            <td><input type="hidden" name="idUtilisateur"
                                       value="<?php echo $user->getIdUtilisateur(); ?>">
                        <tr>
                            <td>Nom * :</td>
                            <td><input type="text" required name="nomUtilisateur"
                                       value="<?php echo $user->getNomUtilisateur(); ?>"></td>
                        </tr>
                        <tr>
                            <td>Pr&eacute;nom * :</td>
                            <td><input type="text" required name="prenomUtilisateur"
                                       value="<?php echo $user->getPrenomUtilisateur(); ?>"></td>
                        </tr>
                        <tr>
                            <td>Adresse :</td>
                            <td><input type="text" name="adr1Utilisateur"
                                       value="<?php echo $user->getAdr1Utilisateur(); ?>"></td>
                        </tr>
                        <tr>
                            <td>compl&eacute;ment d'adresse</td>
                            <td><input type="text" name="adr2Utilisateur"
                                       value="<?php echo $user->getAdr2Utilisateur(); ?>"></td>
                        </tr>
                        <tr>
                            <td>Code postal :</td>
                            <td><input type="text" name="cpUtilisateur"
                                       value="<?php echo $user->getCpUtilisateur(); ?>"></td>
                        </tr>
                        <tr>
                            <td>Ville :</td>
                            <td><input type="text" name="villeUtilisateur"
                                       value="<?php echo $user->getVilleUtilisateur(); ?>"></td>
                        </tr>
                        <tr>
                            <td>Mail :</td>
                            <td><input type="text" name="mailUtilisateur"
                                       value="<?php echo $user->getMailUtilisateur(); ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Les champs suivis d'un * sont obligatoires</td>
                        </tr>
                        <tr style="height: 15px">
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">Changer de mot de passe</td>
                        </tr>
                        <tr>
                            <td>Nouveau mot de passe :</td>
                            <td><input type="password" name="mdpUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td>confirmer nouveau mot de passe :</td>
                            <td><input type="password" name="mdpUtilisateurConfirm"
                                       value=""></td>
                        </tr>
                    </table>
                    <input type="submit" name="update" value="Modifier"/>
                </form>
            </fieldset>
            <br/>

        </div>
        <div style="clear: both"></div>
    </div>
    <?php
    include '../include/include_footer.php';
    db_connect::close();
    ?>
</div>
</body>
</html>
