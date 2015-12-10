/**
 * Created by Jean-Baptiste on 07/09/2015.
 */
$("#selectNiveau").change(function () {
    var idNiveau = $("#selectNiveau option:selected").val();
    var idUtilisateur = $("#idUtilisateur").val();
    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/getMatiere.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau,idUtilisateur: idUtilisateur , action: 'getByNiveauUtilisateur'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idMatiere'] + '">' + item['libelleMatiere'] + '</option>';
                });
            }
            $("#selectMatiere").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

$("#selectMatiere").change(function(){
    var idNiveau = $("#selectNiveau option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();

    if (!idMatiere == ''){
        $.ajax({
            url: '../WebService/getPlanTravail.php',
            type: 'GET',
            dataType: 'json',
            data :{idNiveau: idNiveau, idMatiere: idMatiere, action: 'getByNiveauMatiere'}
        }).success(function(data){
            var html = "";
            if (data.length) {
                var html = '';
                $.each(data, function (i, item) {
                    html += '<tr></tr><td><a href="../PlanTravail/planTravail'+item['idPlanTravail']+'.pdf">Plan de Travail "'+item['libellePlanTravail']+'" pour la P&eacute;riode '+item['libellePeriode']+'</a></td></tr>';
                });
            }
            $("#listePlanTravail").html(html);


        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

$("#newSelectNiveau").click(function(){
    var idNiveau = $("#newSelectNiveau option:selected").val();
    var idUtilisateur = $("#idUtilisateur").val();
    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/getMatiere.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau,idUtilisateur: idUtilisateur , action: 'getByNiveauUtilisateur'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idMatiere'] + '">' + item['libelleMatiere'] + '</option>';
                });
            }
            $("#newSelectMatiere").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

$("#newPlanTravail").click(function () {
    $("#selectNiveau").val("");
    $("#selectMatiere").val("");
    $("#inputLibelle").val("");
    $("#newSelectNiveau").val("");
    $("#newSelectMatiere").val("");
    $("#newSelectPeriode").val("");
    $("#inputFichier").val("");
});