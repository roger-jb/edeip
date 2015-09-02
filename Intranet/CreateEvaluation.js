/**
 * Created by Jean-Baptiste on 24/08/2015.
 */
$("#newEvaluationClick").click(function(){
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
});

$(function () {
    $("#newDateEvaluation").datepicker();
    $("#autreType").hide()
});

$("#newSelectNiveau").change(function(){
    var idNiveau =$("#newSelectNiveau option:selected").val();
    var idUtilisateur = $("#idUtilisateur").val();

    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, idUtilisateur: idUtilisateur, action: 'listeMatiereByNiveauUtilisateur'}
        }).success(function (data) {
            var html = "";
            if(data.length){
                var html = '<option value=""></option>';
                $.each(data, function(i, item) {
                    html += '<option value="'+item['idMatiere']+'">'+item['libelleMatiere']+'</option>';
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

$("#selectNiveau").change(function(){
    var idNiveau =$("#selectNiveau option:selected").val();
    var idUtilisateur = $("#idUtilisateur").val();

    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, idUtilisateur: idUtilisateur, action: 'listeMatiereByNiveauUtilisateur'}
        }).success(function (data) {
            var html = "";
            if(data.length){
                var html = '<option value=""></option>';
                $.each(data, function(i, item) {
                    html += '<option value="'+item['idMatiere']+'">'+item['libelleMatiere']+'</option>';
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

$("#selectMatiere").click(function(){
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
            if(data.length){
                var html = '<option value=""></option>';
                $.each(data, function(i, item) {
                    html += '<option value="'+item['idEvaluation']+'">'+item['libelleEvaluation']+'</option>';
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

$("#selectEvaluation").click(function(){
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

$("#ajoutCpt").click(function(){
    var nbCpt = $("#nbCpt").html();
    nbCpt = parseInt(nbCpt);
    nbCpt ++;
    var idDomaine = $("#idDomaineCpt").val();
    var libDomaine = $("#libDomaineCpt").val();
    var idPointCpt = $("#idPointCpt").val();
    var libPointCpt = $("#libPointCpt").val();
    console.log(idDomaine+' : '+ libDomaine);
    console.log(idPointCpt+ ' : '+libPointCpt);
    var listeCpt = $("#listeCpt").html();
    console.log(listeCpt);
    var ajoutCpt;
    ajoutCpt = '<tr><td><input type="hidden" name="idDomaine'+nbCpt+'" value="'+idDomaine+'">'+libDomaine+'</td><td><input type="hidden" name="idPoint'+nbCpt+'" value="'+idPointCpt+'">'+libPointCpt+'</td></tr>';
    $("#listeCpt").html(listeCpt+ajoutCpt);
});

$("#newSelectType").change(function(){
    $("#autreType").hide();
    if ($('#newSelectType').val() == '3'){
        $("#autreType").show();
    }
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
            'juil.', 'ao�t', 'sept.', 'oct.', 'nov.', 'd&eacute;c.'],
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