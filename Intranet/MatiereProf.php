<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 20/08/2015
 * Time: 10:40
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
    var_dump($_POST);
    /*$niveau = new Niveau();
    if (!empty($_POST['idNiveau']))
        $niveau = Niveau::getById($_POST['idNiveau']);

    if (!empty(trim($_POST['libelleNiveau'])))
        $niveau->setLibelleNiveau($_POST['libelleNiveau']);
    if (!empty(trim($niveau->getLibelleNiveau())))
        if (empty($niveau->getIdNiveau())) {
            if (!empty(trim($niveau->getLibelleNiveau())))
                $niveau->insert();
        } else
            $niveau->update();*/
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Assignation des Mati&egrave;res</title>
    <link rel="stylesheet" href="../Intranet/styleIntranet.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../Require/jQuery-ui.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.min.css" type="text/css" media="screen"/>
    <link rel="shortcut icon" href="../Images/Logo32.ico"/>
    <link rel="icon" href="../Images/logo32.png" type="image/png"/>
</head>
<body>
<script src="../Require/jquery.js"></script>
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
                <h3 class="centrer">Assignation des Mati&egrave;res</h3>
            </div>

            <table id="selectAction" style="width: 100%">
                <tr>
                    <td>
                        <div>
                            Niveau :
                            <select id="selectNiveau" size="1" style="min-width: 200px">
                                <option value=""></option>
                                <?php
                                $niveaux = Niveau::getAll();
                                foreach ($niveaux as $niveau) {
                                    echo '<option value="' . $niveau->getIdNiveau() . '">' . $niveau->getLibelleNiveau() . '</option>';
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
                    <table style="width: 90%; margin: auto;">
                        <tr>
                            <td style="width: 10%;">Enseigner</td>
                            <td style="width: 45%;">Mati&egrave;re</td>
                            <td style="width: 45%;">Professeur</td>
                        </tr>
                        <?php
                        $matieres = Matiere::getAll();
                        foreach ($matieres as $matiere){
                            ?>
                            <tr>
                                <td style="width: 0%; text-align: center;">
                                    <input id="inputFonctionAdministrateur" type="checkbox" multiple name="Assigner[]"
                                           value="<?php echo $matiere->getIdMatiere(); ?>"/>
                                </td>
                                <td style="width: 50%;"><?php echo $matiere->getLibelleMatiere(); ?></td>
                                <td style="width: 50%;"><select>
                                        <option value=""></option>
                                        <?php
                                        $professeurs = Professeur::getAllActif();
                                        foreach($professeurs as $prof){
                                            echo '<option value="'.$prof->getIdUtilisateur().'">'.$prof->getNomUtilisateur().' '.$prof->getPrenomUtilisateur().'</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
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
<script src="Niveau.js"></script>
</body>
</html>
