<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 19/08/2015
 * Time: 18:47
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
    header('location: ../Intranet/Connexion.php');
}
if (isset($_POST['btSubmit'])) {
    $matiere = new Matiere();
    if (!empty($_POST['idMatiere']))
        $matiere = Matiere::getById($_POST['idMatiere']);

    if (!empty(trim($_POST['libelleMatiere'])))
        $matiere->setLibelleMatiere($_POST['libelleMatiere']);
    if (!empty(trim($matiere->getLibelleMatiere())))
        if (empty($matiere->getIdMatiere())) {
            if (!empty(trim($matiere->getLibelleMatiere())))
                $matiere->insert();
        } else
            $matiere->update();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Gestion des Mati&egrave;res</title>
    <link rel="stylesheet" href="../Intranet/styleIntranet.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../Require/jQuery-ui.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
    <link rel="shortcut icon" href="../images/Logo32.ico"/>
    <link rel="icon" href="../images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jQuery.js"></script>
<script src="../Require/jQuery-ui.js"></script>
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
                <h3 class="centrer">Gestion des Mati&egrave;res</h3>
            </div>

            <table id="selectAction" style="width: 100%">
                <tr>
                    <td>
                        <span id="newMatiere">Nouvelle Mati&egrave;res</span>
                    </td>
                    <td>
                        <div>
                            Mati&egrave;re :
                            <select id="selectMatiere" size="1" style="min-width: 200px">
                                <option value=""></option>
                                <?php
                                $matieres = Matiere::getAll();
                                foreach ($matieres as $matiere) {
                                    echo '<option value="' . $matiere->getIdMatiere() . '">' . $matiere->getLibelleMatiere() . '</option>';
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
                            <td><input id="inputId" type="hidden" name="idMatiere"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputLibelle"> Libell&eacute; * :</label></td>
                            <td><input id="inputLibelle" type="text" required name="libelleMatiere"
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
    include '../include/include_footer.php';
    db_connect::close();
    ?>
</div>
<script src="Matiere.js"></script>
</body>
</html>