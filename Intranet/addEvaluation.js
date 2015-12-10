/**
 * Created by Jean-Baptiste on 30/09/2015.
 */
$(function () {
    $("#addDate").datepicker();
});

$("#btModif").click(function(){
    checkEvalSelect();
});

$("#btCpt").click(function(){
    checkEvalSelect();
});

$("#btVerif").click(function(){
    checkEvalSelect();
});

$("#btNoter").click(function(){
    checkEvalSelect();
});

function checkEvalSelect(){
    var idEval = $("#selectEval option:selected").val();
    if (idEval == ''){
        alert('merci de selectionner une evaluation.');
    }
}

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

    if (!(idNiveau == '') && !(idMatiere == "")){
        $.ajax({
            url: '../WebService/getEvaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, idMatiere: idMatiere, action: 'getByMatiereNiveau'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idEvaluation'] + '">' + item['libelleEvaluation'] + '</option>';
                });
            }
            $("#selectEval").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
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