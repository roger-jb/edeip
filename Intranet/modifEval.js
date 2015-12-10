/**
 * Created by Jean-Baptiste on 06/10/2015.
 */
$(function () {
    $("#addDate").datepicker();
});

$("#addNiveau").change(function(){
    var idNiveau = $("#addNiveau option:selected").val();
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
            $("#addMatiere").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

$("#delSujet").click(function(){
    console.log('delSujet');
    var idEvaluation = $("#idEval").val();
    console.log(idEvaluation)
    if (!idEvaluation == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEvaluation, action: 'delSujet'}
        }).success(function (data) {
            if (data == true){
                alert ('suppression du sujet faite');
                $("#libSujet").hide();
            }
            else
                alert ('problème lors de la suppression du sujet')
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la suppression du sujet.');
        })
    }
});

$("#delCorrige").click(function(){
    console.log('delCorrige');
    var idEvaluation = $("#idEval").val();
    if (!idEvaluation == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEvaluation, action: 'delCorrige'}
        }).success(function (data) {
            if (data == true){
                alert ('suppression du corrige faite');
                $("#libCorrige").hide();
            }
            else
                alert ('problème lors de la suppression du corrige')
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la suppression du corrige.');
        })
    }
});