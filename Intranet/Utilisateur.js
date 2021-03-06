/**
 * Created by Jean-Baptiste on 11/08/2015.
 */
$.ready(
    $("#activeButton").hide()
);

$("#selectUtilisateur").change(function () {
    var idUtilisateur = $("#selectUtilisateur option:selected").val();
    $("#newUser").click();
    if (idUtilisateur != '') {
        $("#selectUtilisateur option[value='" + idUtilisateur + "']").attr('selected', 'selected');
        $.ajax({
            url: '../WebService/getById.php',
            type: 'GET',
            dataType: 'json',
            data: {idUtilisateur: idUtilisateur, action: 'Utilisateur'}
        }).success(function (data) {
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


        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la r�cup�ration des info de l\'utilisateur.');
        });

        $.ajax({
            url: '../WebService/adminUtilisateur.php',
            type: 'GET',
            dataType: 'json',
            data: {idUtilisateur: idUtilisateur, action: 'getFonctionUtilisateur'}
        }).success(function (data) {
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
                $("#inputNiveau option[value='" + data['niveau'] + "']").attr('selected', 'selected');

            }
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la r�cup�ration des info de l\'utilisateur.');
        })
    }
});

$("#newUser").click(function () {
    $("#inputNiveau option[value='']").attr('selected', 'selected');

    $("#inputFonctionAdministrateur").prop("checked", false);
    $("#inputFonctionProfesseur").prop("checked", false);
    $("#inputFonctionResponsable").prop("checked", false);
    $("#inputFonctionEleve").prop("checked", false);

    $("#selectUtilisateur option[value='']").attr('selected', 'selected');

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
    // appel WS pour r�cup�rer le user selectionn�

    if ($("#inputActive").val() == "1")
        $("#activeButton").val("D&eacute;sactiver")
    else
        $("#activeButton").val("Activer")
})

$(function () {
    $("#dateNaissanceUtilisateur").datepicker();
    $("#dateInscriptionUtilisateur").datepicker();
});

