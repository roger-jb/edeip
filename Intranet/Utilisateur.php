<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 11/08/2015
 * Time: 18:15
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
    $personne = new Utilisateur();
    if (!empty($_POST['idUtilisateur']))
        $personne = Utilisateur::getById($_POST['idUtilisateur']);

    if (!empty(trim($_POST['nomUtilisateur'])))
        $personne->setNomUtilisateur($_POST['nomUtilisateur']);
    if (!empty(trim($_POST['prenomUtilisateur'])))
        $personne->setPrenomUtilisateur($_POST['prenomUtilisateur']);
    $personne->setAdr1Utilisateur($_POST['adr1Utilisateur']);
    $personne->setAdr2Utilisateur($_POST['adr2Utilisateur']);
    $personne->setCpUtilisateur($_POST['cpUtilisateur']);
    $personne->setVilleUtilisateur($_POST['villeUtilisateur']);
    $personne->setMailUtilisateur($_POST['mailUtilisateur']);
    if (!empty(trim($_POST['dateNaissanceUtilisateur'])))
        $personne->setDateNaissanceUtilisateur($_POST['dateNaissanceUtilisateur']);
    if (!empty(trim($_POST['dateInscriptionUtilisateur'])))
        $personne->setDateInscriptionUtilisateur($_POST['dateInscriptionUtilisateur']);

    $fonction = array('Administrateur' => FALSE, 'Responsable' => FALSE, 'Professeur' => FALSE, 'Eleve' => FALSE);
    if (isset($_POST['fonction']))
        foreach ($_POST['fonction'] as $fct) {
            $fonction[$fct] = TRUE;
        }
    
    $maj = FALSE;
    if (!empty(trim($personne->getNomUtilisateur())))
        if (empty($personne->getIdUtilisateur())) {
            if (!empty(trim($personne->getNomUtilisateur())))
                $maj = $personne->insert();
        } else
            $maj = $personne->update();

    if ($maj){
        if ($fonction['Administrateur'] && !$personne->estAdministrateur()){
            $admin = new Administrateur();
            $admin->setIdAdministrateur($personne->getIdUtilisateur());
            $admin->insertOnly();
        }
        if ($fonction['Professeur'] && !$personne->estProfesseur()){
            $prof = new Professeur();
            $prof->setIdProfesseur($personne->getIdUtilisateur());
            $prof->insertOnly();
        }
        if ($fonction['Responsable'] && !$personne->estResponsable()){
            $resp = new Responsable();
            $resp->setIdResponsable($personne->getIdUtilisateur());
            $resp->insertOnly();
        }
        if ($fonction['Eleve']){
            $eleve = new Eleve();
            $eleve->setIdEleve($personne->getIdUtilisateur());
            $eleve->setIdNiveau($_POST['niveauEleve']);
            $eleve->insertOnly();
        }
    }

}

if (isset($_POST['btActive'])) {
    $personne = Utilisateur::getById($_POST['idUtilisateur']);
    if ($personne->getActifUtilisateur())
        $personne->desactiver();
    else
        $personne->activer();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Gestion des Utilisateurs</title>
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
                <h3 class="centrer">Gestion des Utilisateurs</h3>
            </div>

            <table id="selectAction" style="width: 100%">
                <tr>
                    <td>
                        <span id="newUser"><i class="fa fa-plus-square-o" style="font-size: 20px;"></i> Nouvel Utilisateur</span>
                    </td>
                    <td>
                        <div>
                            <label for="selectUtilisateur" >nom Utilisateur :</label>
                            <select id="selectUtilisateur" size="1" style="min-width: 200px">
                                <option value=""></option>
                                <optgroup label="Utilisateur Actif"></optgroup>
                                <?php
                                $utilisateurActifs = Utilisateur::getAllActif();
                                foreach ($utilisateurActifs as $user) {
                                    //$user = new Utilisateur();
                                    echo '<option value="' . $user->getIdUtilisateur() . '">' . $user->getNomUtilisateur() . ' ' . $user->getPrenomUtilisateur() . '</option>';
                                }
                                ?>
                                <optgroup label="Utilisateur Inactif"></optgroup>
                                <?php
                                $utilisateurInactifs = Utilisateur::getAllInactif();
                                foreach ($utilisateurInactifs as $user) {
                                    //$user = new Utilisateur();
                                    echo '<option value="' . $user->getIdUtilisateur() . '">' . $user->getNomUtilisateur() . ' ' . $user->getPrenomUtilisateur() . '</option>';
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
                            <td><input id="inputId" type="hidden" name="idUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><input id="inputActive" type="hidden" name="activeUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputNom">Nom * :</label</td>
                            <td><input id="inputNom" type="text" required name="nomUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputPrenom">Pr&eacute;nom * :</label></td>
                            <td><input id="inputPrenom" type="text" required name="prenomUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputAdr1">Adresse :</label></td>
                            <td><input id="inputAdr1" type="text" name="adr1Utilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputAdr2">compl&eacute;ment d'adresse :</label></td>
                            <td><input id="inputAdr2" type="text" name="adr2Utilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputCp">Code postal :</label></td>
                            <td><input id="inputCp" type="text" name="cpUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputVille">Ville :</label></td>
                            <td><input id="inputVille" type="text" name="villeUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td><label for="inputMail" >Mail :</label></td>
                            <td><input id="inputMail" type="text" name="mailUtilisateur"
                                       value=""></td>
                        </tr>
                        <tr>
                            <td>Fonction :</td>
                            <td>
                                <input id="inputFonctionAdministrateur" type="checkbox" multiple name="fonction[]"
                                       value="Administrateur"/> Administrateur<br/>
                                <input id="inputFonctionProfesseur" type="checkbox" multiple name="fonction[]"
                                       value="Professeur"/> Professeur<br/>
                                <input id="inputFonctionResponsable" type="checkbox" multiple name="fonction[]"
                                       value="Responsable"/> Parent<br/>
                                <input id="inputFonctionEleve" type="checkbox" multiple name="fonction[]"
                                       value="Eleve"/> &Eacute;l&egrave;ve<br/>
                                Niveau de l'&Eacute;l&egrave;ve :
                                <select id="inputNiveau" name="niveauEleve" size="1">
                                    <option value=''></option>
                                    <?php
                                    $niveaux = Niveau::getAll();
                                    foreach ($niveaux as $niveau) {
                                        echo "<option value='" . $niveau->getIdNiveau() . "'>" . $niveau->getLibelleNiveau() . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Date de naissance :</td>
                            <td><input type="text" id="dateNaissanceUtilisateur" name="dateNaissanceUtilisateur"></td>
                        </tr>
                        <tr>
                            <td>Date de Inscription :</td>
                            <td><input type="text" id="dateInscriptionUtilisateur" name="dateInscriptionUtilisateur">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Les champs suivis d'un * sont obligatoires</td>
                        </tr>

                        <tr>
                            <td><input type="submit" id="submitButton" name="btSubmit" value="Valider"></td>
                            <td><input type="submit" id="activeButton" name="btActive" value="Supprimer"></td>
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
<script src="Utilisateur.js"></script>
</body>
</html>
