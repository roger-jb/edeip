<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 30/09/2015
 * Time: 21:05
 */

header('content-type: text/html; charset=utf-8');
session_start();
require_once '../Require/Objects.php';
$utilisateur = new Utilisateur();
if (isset($_SESSION['id'])) {
    $utilisateur = Utilisateur::getById($_SESSION['id']);
    if (!($utilisateur->estAdministrateur() || $utilisateur->estProfesseur())) {
        header('location: ../Intranet/mesInformations.php');
    }
}
else {
    header('location: ../Intranet/connexion.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Affectation Matiere</title>
    <link rel="stylesheet" href="../Intranet/styleIntranet.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../Require/jquery-ui.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
    <link rel="shortcut icon" href="../Images/Logo32.ico"/>
    <link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jQuery.js"></script>
<script src="../Require/jquery-ui.js"></script>
<script src="../Require/DatePickerFr.js"></script>

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
                <h3 class="centrer">Affecter une matière à un élève</h3>
            </div>
            <fieldset>
                <legend>Choisir un &Eacute;l&egrave;ve</legend>
                <table>
                    <tr>
                        <td>&Eacute;l&egrave;ve : </td>
                        <td>
                            <select id="eleve">
                                <option value=""></option>
                                <?php
                                $eleves = Eleve::getAllActif();
                                foreach ($eleves as $eleve){
                                    echo "<option value='".$eleve->getIdEleve()."'>".$eleve->getLibelleUtilisatur().'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Niveau : </td>
                        <td>
                            <select id="selectNiveau">
                                <option value=""></option>
                                <?php
                                $niveaux = Niveau::getAll();
                                foreach ($niveaux as $niv){
                                    //$niv = new Niveau();
                                    echo '<option value="'.$niv->getIdNiveau().'">'.$niv->getLibelleNiveau().'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Mati&egrave;re : </td>
                        <td>
                            <select id="selectMatiere">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="submit" id="btAdd" name="ajouter" value="Ajouter">&nbsp;&nbsp;
                            <input type="button" class="submit" id="btDel" name="retirer" value="Retirer">
                        </td>
                    </tr>
                </table>

            </fieldset>
            <fieldset>
                <legend>Liste des matieres de l'&eacute;l&egrave;ve</legend>
                <div id="listeMatiere">

                </div>
            </fieldset>
            <br>
        </div>
        <div style="clear: both"></div>
    </div>
    <?php
    include '../Include/include_footer.php';
    db_connect::close();
    ?>
</div>
<script src="affectMatiere.js"></script>
</body>
</html>