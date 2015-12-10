<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 19/08/2015
 * Time: 15:05
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
if (isset($_SESSION['id'])) {
    $utilisateur = Utilisateur::getById($_SESSION['id']);
    if (!$utilisateur->estAdministrateur()) {
        header('location: ../Intranet/mesInformations.php');
    }
} else {
    header('location: ../Intranet/connexion.php');
}
if (isset($_POST['btSubmit'])) {
    $niveauCpt = new NiveauCpt();
    if (!empty($_POST['idNiveauCpt']))
        $niveauCpt = NiveauCpt::getById($_POST['idNiveauCpt']);

    if (!empty(trim($_POST['libelleNiveauCpt'])))
        $niveauCpt->setLibelleNiveauCpt($_POST['libelleNiveauCpt']);
    if (!empty(trim($_POST['codeNiveauCpt'])))
        $niveauCpt->setCodeNiveauCpt($_POST['codeNiveauCpt']);
    if (!empty(trim($niveauCpt->getLibelleNiveauCpt())))
        if (empty($niveauCpt->getIdNiveauCpt())) {
            if (!empty(trim($niveauCpt->getLibelleNiveauCpt())))
                $niveauCpt->insert();
        } else
            $niveauCpt->update();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Gestion des Niveaux de Comp&eacute;tence</title>
    <link rel="stylesheet" href="styleIntranet.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../Require/jquery-ui.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
    <link rel="shortcut icon" href="../Images/Logo32.ico"/>
    <link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jQuery.js"></script>
<script src="../Require/jquery-ui.js"></script>
<div id='angle_rond'>
    <?php
    include '../Include/include_header.php';
    ?>
    <div id="content">
        <div id="menuLeft">
            <?php
            require_once('../Intranet/menuIntranet.php');
            ?>
        </div>
        <div id="corps">
            <div class="titre_corps">
                <h3 class="centrer">Gestion des Niveaux de Comp&eacute;tence</h3>
            </div>

            <table id="selectAction" style="width: 100%">
                <tr>
                    <td>
                        <span id="newNiveauCpt"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouveau Niveau de Comp&eacute;tence</span>
                    </td>
                    <td>
                        <div>
                            Niveau :
                            <select id="selectNiveauCpt" size="1" style="min-width: 200px">
                                <option value=""></option>
                                <?php
                                $niveauxCpt = NiveauCpt::getAll();
                                foreach ($niveauxCpt as $niveauCpt) {
                                    echo '<option value="' . $niveauCpt->getIdNiveauCpt() . '">' . $niveauCpt->getLibelleNiveauCpt() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
            </br>
            <fieldset style="width: 70%; margin: auto;">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table>
                        <tr>
                            <td><input id="inputId" type="hidden" name="idNiveauCpt"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputCode">Code * :</label></td>
                            <td><input id="inputCode" type="text" required name="codeNiveauCpt"
                                       value="">&nbsp;&nbsp;(1 seul caract&egrave;re)</td>
                        </tr>
                        <tr>
                            <td><label for="inputLibelle">Libell&eacute; * :</label></td>
                            <td><input id="inputLibelle" type="text" required name="libelleNiveauCpt"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><input type="submit" id="submitButton" name="btSubmit" value="Valider"></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
            <br/>
        </div>
        <div style="clear: both"></div>
    </div>
    <?php
    include '../Include/include_footer.php';
    db_connect::close();
    ?>
</div>
<script src="NiveauCpt.js"></script>
</body>
</html>
