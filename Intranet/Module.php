<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 17/08/2015
 * Time: 09:15
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
    $module = new Module();
    if (!empty($_POST['idModule']))
        $module = Module::getById($_POST['idModule']);

    if (!empty(trim($_POST['libelleModule'])))
        $module->setLibelleModule($_POST['libelleModule']);
    if (!empty(trim($module->getLibelleModule())))
        if (empty($module->getIdModule())) {
            if (!empty(trim($module->getLibelleModule())))
            $module->insert();
        } else
            $module->update();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Gestion des Modules</title>
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
                <h3 class="centrer">Gestion des Modules</h3>
            </div>

            <table id="selectAction" style="width: 100%">
                <tr>
                    <td>
                        <span id="newModule"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouveau Module</span>
                    </td>
                    <td>
                        <div>
                            Module :
                            <select id="selectModule" size="1" style="min-width: 200px">
                                <option value=""></option>
                                <?php
                                $modules = Module::getAll();
                                foreach ($modules as $module) {
                                    echo '<option value="' . $module->getIdModule() . '">' . $module->getLibelleModule() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>

            </table>
            <br>
            <fieldset style="width: 70%; margin: auto;">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table>
                        <tr>
                            <td><input id="inputId" type="hidden" name="idModule"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td>Libell&eacute; * :</td>
                            <td><input id="inputLibelle" type="text" required name="libelleModule"
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
<script src="Module.js"></script>
</body>
</html>
