/**
 * Created by Jean-Baptiste on 14/09/2015.
 */

$("#selectNiveau").change(function(){
    var idNiveau = $("#selectNiveau option:selected").val();
    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/getMatiere.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, action: 'getByNiveau'}
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