/**
 * Created by Jean-Baptiste on 24/08/2015.
 */
$("#newEvaluationClick").click(function () {
    //$("#newEvaluation").show();
    //$('html,body').animate({scrollTop: $("#pageTitle").offset().top}, 200);
    $("#newInputIdEvaluation").val("");
    $("#newSelectNiveau").val("");
    $("#newSelectMatiere").val("");
    $("#newSelectType").val("");
    $("#newInputAutre").val("");
    $("#autreType").hide();
    $("#newInputTitre").val("");
    $("#newDateEvaluation").val("");
    $("#newMaxEvaluation").val("20");
    $("#selectNiveau").val("");
    $("#selectMatiere").val("");
    $("#selectEvaluation").val("");
});

$(function () {
    $("#newDateEvaluation").datepicker();
    $("#autreType").hide()
});

$("#newSelectNiveau").change(function () {
    var idNiveau = $("#newSelectNiveau option:selected").val();
    var idUtilisateur = $("#idUtilisateur").val();

    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, idUtilisateur: idUtilisateur, action: 'listeMatiereByNiveauUtilisateur'}
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
            console.log('Erreur dans la recuperation des info du niveau.');
        })
    }
});
$("#newSelectNiveau").change(function () {
    $("#selectNiveau").val($("#newSelectNiveau option:selected").val());
    $("#selectNiveau").change()
});
$("#selectNiveau").change(function () {
    var idNiveau = $("#selectNiveau option:selected").val();
    var idUtilisateur = $("#idUtilisateur").val();
    $("#newSelectNiveau").val(idNiveau);

    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, idUtilisateur: idUtilisateur, action: 'listeMatiereByNiveauUtilisateur'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idMatiere'] + '">' + item['libelleMatiere'] + '</option>';
                });
            }
            $("#selectMatiere").html(html);
            $("#newSelectMatiere").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des info du niveau.');
        })
    }
});

$("#selectMatiere").click(function () {
    var idNiveau = $("#selectNiveau option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    var action = 'listeEvaluationByMatiereNiveau';
    if (!idNiveau == '' && !idMatiere == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, idMatiere: idMatiere, action: action}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idEvaluation'] + '">' + item['libelleEvaluation'] + '</option>';
                });
            }
            $("#selectEvaluation").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(action);
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des info du niveau.');
        })
    }
    if (idNiveau == '' || idMatiere == '') {
        $("#selectEvaluation").html("");
    }
});

$("#selectEvaluation").click(function () {
    console.log($("#selectEvaluation option:selected").val())
    var idEvaluation = $("#selectEvaluation option:selected").val();
    var action = 'Evaluation';
    if (!idEvaluation == '') {
        $.ajax({
            url: '../WebService/getById.php',
            type: 'GET',
            dataType: 'json',
            data: {idEvaluation: idEvaluation, action: action}
        }).success(function (data) {
            $("#newInputIdEvaluation").val(data['idEvaluation']);
            $("#newInputAutre").val(data['autreEvaluation']);
            $("#newInputTitre").val(data['titreEvaluation']);
            $("#newDateEvaluation").val(data['dateEvaluation']);
            $("#newSelectNiveau option[value='" + data['idNiveau'] + "']").attr('selected', 'selected');
            $("#newSelectMatiere option[value='" + data['idMatiere'] + "']").attr('selected', 'selected');
            $("#newSelectType option[value='" + data['idTypeEvaluation'] + "']").attr('selected', 'selected');
            $("#newSelectType").change();
            //$("#newSelectNiveau option[value='" + data['idNiveau'] + "']").attr('selected', 'selected');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(action);
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des info du niveau.');
        })
    }
});

$("#ajoutCpt").click(function () {
    var nbCpt = $("#nbCpt").html();
    nbCpt = parseInt(nbCpt);

    console.log(nbCpt);
    var idDomaine = $("#idDomaineCpt").val();
    var libDomaine = $("#libDomaineCpt").val();
    var idPointCpt = $("#idPointCpt").val();
    var libPointCpt = $("#libPointCpt").val();
    var idNiveau = $("#newSelectNiveau option:selected").val();
    var idMatiere = $("#newSelectMatiere option:selected").val();

    var listeCpt = $("#listeCpt").html();
    var ajoutCpt = '';

    if (libDomaine != '' && libPointCpt != '') {
        console.log('idDomaine : ' + libDomaine);
        console.log('idPointCpt : ' + libPointCpt);
        var action = 'insertDomaine';
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {libDomaineCpt: libDomaine, idNiveau: idNiveau, idMatiere: idMatiere, action: action}
        }).success(function (data) {
            console.log(data);
            idDomaine = data.idDomaineCpt;
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(action);
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans l ajout du domaine de compétence ' + libDomaine + '.');
        });

        if (idDomaine != ''){
            action2 = 'insertCompetence';
            $.ajax({
                url: '../WebService/Evaluation.php',
                type: 'GET',
                dataType: 'json',
                data: {libPointCpt: libPointCpt, idDomaine: idDomaine, action: action2}
            }).success(function (data) {
                idPointCpt = data['idPointCpt'];
            }).error(function (xhr, ajaxOptions, thrownError) {
                console.log(action2);
                console.log(xhr.status);
                console.log(thrownError);
                console.log('Erreur dans l ajout du point de compétence ' + libPointCpt + '.');
            });
            console.log('nbCpt = '+nbCpt);
            nbCpt++;
            ajoutCpt = '<tr><td><input type="hidden" name="idDomaine' + nbCpt + '" value="' + idDomaine + '">' + libDomaine + '</td><td><input type="hidden" name="idPoint' + nbCpt + '" value="' + idPointCpt + '">' + libPointCpt + '</td></tr>';
        }
        $("#nbCpt").html(nbCpt);
        $("#listeCpt").html(listeCpt + ajoutCpt);
    }
});

$("#newSelectType").change(function () {
    $("#autreType").hide();
    if ($('#newSelectType').val() == '3') {
        $("#autreType").show();
    }
});
