<?php
    header( 'content-type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EDEIP - Contact</title>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
        <link rel="shortcut icon" href="../images/Logo32.ico"/>                        
        <link rel="icon" href="../images/logo32.png" type="image/png"/>
    </head>
    <body>
        <div id='angle_rond'>
            <?php
            include '../include/include_header.php';
            $form = true;

            // On veut traiter le formulaire ?
            if (isset($_POST['envoi'])) {
                if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['mail']) && !empty($_POST['mail'])) {
                    $form = false;
                    // On récupère les valeurs
                    $nom = $_POST['nom'];
                    $mail = $_POST['mail'];
                    $adresse = $_POST['adresse'];
                    $tel = $_POST['tel'];
                    $age = $_POST['age'];
                    $classe_actuelle = $_POST['classe_actuelle'];
                    $demande = $_POST['demande'];
                    $post = $_POST['post'];
                    
                    $to = "contact@edeip-lyon.fr";
                    $entete = "Inscription Form submitted on Ecole Des Enfants Intellectuellement Précoces de Lyon";
                    $message = "Nom : $nom\n\n";
                    $message .= "E-mail : $mail\n\n";
                    if (isset($_POST['adresse']) && !empty($_POST['adresse'])) {
                        $message .= "Adresse : $adresse\n\n";
                    }
                    if (isset($_POST['tel']) && !empty($_POST['tel'])) {
                        $message .= "Téléphone : $tel\n\n";
                    }
                    if (isset($_POST['age']) && !empty($_POST['age'])) {
                        $message .= "Age de l'enfant : $age\n\n";
                    }
                    if (isset($_POST['classe_actuelle']) && !empty($_POST['classe_actuelle'])) {
                        $message .= "Classe actuelle : $classe_actuelle\n\n";
                    }
                    if (isset($_POST['demande']) && !empty($_POST['demande'])) {
                        $message .= "Demande : $demande\n\n";
                    }
                    $message .= "Message : $post\n\n";
                    $headers = "From: $nom - <$mail>\n"; 
                    $headers .='Content-Type: text/plain; charset="UTF-8"'."\n"; 
                    $headers .='Content-Transfer-Encoding: 8bit';
                    mail($to, $entete, $message, $headers);
                }
                else {
                    echo "<p>Merci de remplir les champs comportants une étoile</p>";
                }
            }

            if ($form) {
                // Affichage
                // récupération des informations reçues
                $nom = (isset($_POST['nom']) ? $_POST['nom'] : "");
                $mail = (isset($_POST['mail']) ? $_POST['mail'] : "");
                $adresse = (isset($_POST['adresse']) ? $_POST['adresse'] : "");
                $tel = (isset($_POST['tel']) ? $_POST['tel'] : "");
                $post = (isset($_POST['post']) ? $_POST['post'] : "");
                ?>
                <div class='corps'>
                    <br/>
                    <div class="titre_corps">
                        <h3 class="centrer">Contact</h3>
                    </div>
                    <div id="map_canvas_custom_181039" style="width:700px; height:500px; margin-left:100px;" ></div>
                    <script type="text/javascript">
                        (function(d, t) {
                            var g = d.createElement(t),s = d.getElementsByTagName(t)[0];
                            g.src = "http://map-generator.net/fr/maps/181039.js?point=27+Rue+Raoul+Servant%2C+69007+Lyon";
                            s.parentNode.insertBefore(g, s);}
                        (document, "script"));
                    </script>
                    <a class="mapgen-link" style="font:8px Arial;text-decoration:none;color:#5C5C5C;text-align: right; display: block; width: 700px;" href="http://map-generator.net/fr">map-generator.net</a>
                    <p style="text-align: center;"><strong>EDEIP</strong><br/>27, rue Raoul Servant<br/>69007 LYON</p>
                    <p>04 37 37 86 65 - 06 62 35 85 84<br/><a href="mailto:contact@edeip-lyon.fr">contact@edeip-lyon.fr</a></p>
                    <div class="sous_titre_corps">
                        <h4>Pour tout renseignement, nous vous remercions de remplir ce formulaire</h4>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" ENCTYPE="multipart/form-data">
                        <table>
                            <tr><td><strong>Nom * :</strong></td></tr>
                            <tr><td><input type="text" required name="nom" value="<?php echo $nom; ?>" required/></td></tr>
                            <tr><td><strong>E-Mail * :</strong></td></tr>
                            <tr><td><input type="email" required name="mail" value="<?php echo $mail; ?>" required/></td></tr>
                            <tr><td><strong>Adresse :</strong></td></tr>
                            <tr><td><input type="text" name="adresse" value="<?php echo $adresse; ?>"/></td></tr>
                            <tr><td><strong>Téléphone :</strong></td></tr>
                            <tr><td><input type="text" name="tel" value="<?php echo $tel; ?>"/></td></tr>
                            <tr><td><strong>Age :</strong></td></tr>
                            <tr>
                                <td>
                                    <select name="age">
                                        <option value=""></option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><td><strong>Classe actuelle :</strong></td></tr>
                            <tr>
                                <td>
                                    <select name="classe_actuelle">
                                        <option value=""></option>
                                        <option value="CP">CP</option>
                                        <option value="CE1">CE1</option>
                                        <option value="CE2">CE2</option>
                                        <option value="CM1">CM1</option>
                                        <option value="CM2">CM2</option>
                                        <option value="6e">6e</option>
                                        <option value="5e">5e</option>
                                        <option value="4e">4e</option>
                                        <option value="3e">3e</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><td><strong>Votre demande * :</strong></td></tr>
                            <tr><td>
                                    <input type="checkbox" name="demande" value="J’envisage d’inscrire mon (mes) enfant(s) à l’EDEIP Lyon à la prochaine rentrée scolaire"/>J’envisage d’inscrire mon (mes) enfant(s) à l’EDEIP Lyon à la prochaine rentrée scolaire<br/>
                                    <input type="checkbox" name="demande" value="Je souhaite être contacté(e) pour plus d’informations"/>Je souhaite être contacté(e) pour plus d’informations<br/>
                                    <input type="checkbox" name="demande" value="Je propose mes compétences pour renforcer l’équipe"/>Je propose mes compétences pour renforcer l’équipe<br/>
                                </td>
                            </tr>
                            <tr><td>Les champs suivis d'un * sont obligatoires</td></tr>
                        </table>
                        <p><strong>Message * :</strong></p>
                        <textarea name="post" required cols="60" rows="5"></textarea><br/>
                        <input type="submit" name="envoi" value="Envoyer"/>
                    </form>
                    <br/>
                </div>
                <?php
            }
            include '../include/include_footer.php';
            ?>
        </div>
    </body>
</html>
