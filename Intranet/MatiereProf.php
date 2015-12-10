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
    header('location: ../Intranet/connexion.php');
}
if (isset($_POST['btSubmit'])) {
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
	if (isset($_POST['Assigner']) && isset($_POST['idNiveau']) && !empty($_POST['idNiveau'])){
		$idNiveau = $_POST['idNiveau'];
		foreach ($_POST['Assigner'] as $idMatiere){
			$matiere = Matiere::getById($idMatiere);
			$idProfesseur = $_POST['idProf'.$idMatiere];
			if (isset($_POST['idProf'.$idMatiere]) && !empty($_POST['idProf'.$idMatiere])){
				$professeur = Professeur::getById($_POST['idProf'.$idMatiere]);
				$matiereNiveau = MatiereNiveau::getByMatiereNiveau($matiere->getIdMatiere(), $idNiveau);
				$profMatiereNiveau = ProfesseurMatiereNiveau::getByProfesseurMatiereNiveau($professeur->getIdProfesseur(), $matiereNiveau->getIdMatiereNiveau());

			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EDEIP : Assignation des Mati&egrave;res</title>
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
                    <td>
                        Matiere
                        <select id="selectMatiere" size="1">
                            <option value=""></option>
                            <?php
                            $matieres = Matiere::getAll();
                            foreach ($matieres as $matiere){
                                echo '<option value="' . $matiere->getIdMatiere() . '">' . $matiere->getLibelleMatiere() . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Professeur
                        <select id="selectProf" size="1">
                            <option value=""></option>
                            <?php
                            $profs = Professeur::getAll();
                            foreach ($profs as $prof){
                                echo '<option value="' . $prof->getIdProfesseur() . '">' . $prof->getLibelleUtilisatur() . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>
						<span id="addCouple">Ajouter</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="delCouple">Supprimer</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="updateCouple">Changer professeur</span>
                    </td>
                </tr>
            </table>
            <br/>
            <fieldset style="width: 70%; margin: auto;">
				<legend>Liste des matieres assign&eacute;es au Niveau et leur professeur</legend>
                <table>
					<thead>
					<tr><td>Matiere</td><td>Professeur</td></tr>
					</thead>
					<tbody id="listeCouple">
					</tbody>
				</table>
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
<script src="MatiereProf.js"></script>
</body>
</html>
