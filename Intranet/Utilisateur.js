/**
 * Created by Jean-Baptiste on 11/08/2015.
 */
$.ready(
    $("#activeButton").hide()
);

$("#selectUtilisateur").change(function () {
    var idUtilisateur = $("#selectUtilisateur option:selected").val();
    $("#inputFonctionAdministrateur").prop( "checked", false);
    $("#inputFonctionProfesseur").prop( "checked", false);
    $("#inputFonctionResponsable").prop( "checked", false);
    $("#inputFonctionEleve").prop( "checked", false);

    $.ajax({
        url: '../WebService/adminUtilisateur.php',
        type: 'POST',
        dataType: 'json',
        data: {idUtilisateur: idUtilisateur, action: 'getUtilisateurById'}
    })
        .success(function (data) {
            $("#inputId").val(data['idUtilisateur']);
            $("#inputActive").val(data['actifUtilisateur']);
            $("#inputNom").val(data['nomUtilisateur']);
            $("#inputPrenom").val(data['prenomUtilisateur']);
            $("#inputAdr1").val(data['adr1Utilisateur']);
            $("#inputAdr2").val(data['adr2Utilisateur']);
            $("#inputCp").val(data['cpUtilisateur']);
            $("#inputVille").val(data['villeUtilisateur']);
            $("#inputMail").val(data['mailUtilisateur']);
            $("#dateNaissanceUtilisateur").val(data['dateNaissanceUtilisateur']);
            $("#dateInscriptionUtilisateur").val(data['dateInscriptionUtilisateur']);
            $("#activeButton").show();
            if (data['actifUtilisateur'] == 1) {
                $("#activeButton").val('Inactiver');
            }
            else {
                $("#activeButton").val("Activer")
            }


        })
        .error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la récupération des info de l\'utilisateur.');
        })

    $.ajax({
        url: '../WebService/adminUtilisateur.php',
        type: 'POST',
        dataType: 'json',
        data: {idUtilisateur: idUtilisateur, action: 'getFonctionUtiisateur'}
    })
        .success(function (data) {
            console.log(data);
            $("#inputNiveau").val('');
            if (data['administrateur'] == 'TRUE') {
                $('#inputFonctionAdministrateur').prop('checked', true);
            }
            if (data['professeur'] == 'TRUE') {
                $('#inputFonctionProfesseur').prop('checked', true);
            }
            if (data['responsable'] == 'TRUE') {
                $('#inputFonctionResponsable').prop('checked', true);
            }
            if (data['eleve'] == 'TRUE') {
                $('#inputFonctionEleve').prop('checked', true);
                $("#inputNiveau option[value='"+data['niveau']+"']").attr('selected', 'selected');

            }
        })
        .error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la récupération des info de l\'utilisateur.');
        })

});

$("#newUser").click(function () {
    $("#inputNiveau option[value='']").attr('selected', 'selected');

    $("#inputFonctionAdministrateur").prop( "checked", false);
    $("#inputFonctionProfesseur").prop( "checked", false);
    $("#inputFonctionResponsable").prop( "checked", false);
    $("#inputFonctionEleve").prop( "checked", false);

    $("#inputId").val("");
    $("#inputActive").val("");
    $("#inputNom").val("");
    $("#inputPrenom").val("");
    $("#inputAdr1").val("");
    $("#inputAdr2").val("");
    $("#inputCp").val("");
    $("#inputVille").val("");
    $("#inputMail").val("");
    $("#dateNaissanceUtilisateur").val("");
    $("#dateInscriptionUtilisateur").val("");
    $("#activeButton").hide();
});

$("#updateUser").click(function () {
    $("#activeButton").show();
    // appel WS pour récupérer le user selectionné

    if ($("#inputActive").val() == "1")
        $("#activeButton").val("D&eacute;sactiver")
    else
        $("#activeButton").val("Activer")
})

$(function () {
    $("#dateNaissanceUtilisateur").datepicker();
    $("#dateInscriptionUtilisateur").datepicker();
});

(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD. Register as an anonymous module.
        define(["../jquery.ui.datepicker"], factory);
    } else {
        // Browser globals
        factory(jQuery.datepicker);
    }
}(function (datepicker) {
    datepicker.regional['fr'] = {
        closeText: 'Fermer',
        prevText: 'Pr&eacute;c&eacute;dent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['janvier', 'f&eacute;vrier', 'mars', 'avril', 'mai', 'juin',
            'juillet', 'ao&ucirc;t', 'septembre', 'octobre', 'novembre', 'd&eacute;cembre'],
        monthNamesShort: ['janv.', 'f&eacute;vr.', 'mars', 'avril', 'mai', 'juin',
            'juil.', 'août', 'sept.', 'oct.', 'nov.', 'd&eacute;c.'],
        dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
        dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    datepicker.setDefaults(datepicker.regional['fr']);
    return datepicker.regional['fr'];
}));