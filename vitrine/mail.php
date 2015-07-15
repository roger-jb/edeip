<?php
header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<div id='angle_rond'>
    <?php
    include '../include/include_header.php';
    ?>
    <div class='corps'>
        <br/>
        <?php
        $sujet = 'Demande de renseignements';
        $message = "Bonjour,
        M(me) $nom habitant à l'adresse suivante :
        $adresse
        souhaite inscrire $nbr_enfants enfants : $nbr_primaire en primaire et/ou $nbr_secondaire en secondaire.
        Sa demande est la suivante :
        $demande
        Elle a aussi écrit le message suivant :
        $post
        Vous pouvez lui répondre par mail à $mail ou par téléphone au $tel.";
        if (mail('tristan.perchec@gmail.com', 'Demande de renseignement', $message)) {
            include "../include/include_header.php";
            echo "L'email a bien été envoyé.";
        }
        else {
            echo "Une erreur c'est produite lors de l'envois de l'email.";
        }
        ?>
    </div>
</div>

