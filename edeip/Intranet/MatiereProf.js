/**
 * Created by Jean-Baptiste on 20/08/2015.
 */

$("#selectNiveau").change(function(){
    var idNiveau = $("#selectNiveau option:selected").val();
    if (idNiveau != '') {
        majListe();
    }
});

$("#addCouple").click(function(){
    var idNiveau = $("#selectNiveau option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    var idProf = $("#selectProf option:selected").val();
    var idMatiereNiveau = '';
    if (idNiveau != '' && idMatiere != ''){
        $.ajax({
            url: '../WebService/MatiereNiveau.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, idMatiere: idMatiere, action: 'addByMatiereNiveau'}
        }).success(function (data) {
            idMatiereNiveau = data['idMatiereNiveau'];
            if (idProf != '' && idMatiereNiveau != ''){
                $.ajax({
                    url: '../WebService/ProfesseurMatiereNiveau.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {idMatiereNiveau: idMatiereNiveau, idProfesseur: idProf, action: 'addByProfesseurMatiereNiveau'}
                }).success(function (data) {
                    idProf = data['idUtilisateur'];
                    majListe();
                }).error(function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log('Erreur dans la recuperation des infoamations');
                });
            }
            else {
                majListe();
            }
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des infoamations');
        });
    }
});

$("#delCouple").click(function (){
    var idNiveau = $("#selectNiveau option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    $.ajax({
        url: '../WebService/MatiereNiveau.php',
        type: 'GET',
        dataType: 'json',
        data: {idNiveau: idNiveau, idMatiere: idMatiere, action: 'suppByMatiereNiveau'}
    }).success(function (data) {
        majListe();
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans la recuperation des infoamations');
    });
});

function majListe(){
    var idNiveau = $("#selectNiveau option:selected").val();
    $.ajax({
        url: '../WebService/MatiereNiveau.php',
        type: 'GET',
        dataType: 'json',
        data: {idNiveau: idNiveau, action: 'getListeMatiereProf'}
    }).success(function (data) {
        $("#listeCouple").html(data);
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans la recuperation des infoamations');
    })
}

$("#updateCouple").click(function(){
    var idNiveau = $("#selectNiveau option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    var idProf = $("#selectProf option:selected").val();
    $.ajax({
        url: '../WebService/ProfesseurMatiereNiveau.php',
        type: 'GET',
        dataType: 'json',
        data: {idNiveau: idNiveau, idMatiere: idMatiere, idProfesseur:idProf, action: 'changeProfesseur'}
    }).success(function (data) {
        majListe();
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans la recuperation des infoamations');
    })
});