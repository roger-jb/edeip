/**
 * Created by Jean-Baptiste on 06/10/2015.
 */

$("#txtDomaine").change(function(){
    reloadDomaine();
    $("#selectCpt").html('<option value=""></option>');
});

function reloadDomaine(){
    $.ajax({
        url: '../WebService/Competence.php',
        type: 'GET',
        dataType: 'json',
        data: {action: 'getAllDomaineCpt'}
    }).success(function (data) {
        var html = "";
        if (data.length) {
            var html = '<option value=""></option>';
            $.each(data, function (i, item) {
                html += '<option value="' + item['idDomaineCpt'] + '">' + item['libelleDomaineCpt'] + '</option>';
            });
        }
        $("#selectDomaine").html(html);
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans le rechagement des Domaines.');
    })
}

$("#selectDomaine").change(function(){
    var idDomaineCpt = $("#selectDomaine option:selected").val();
    if (!idDomaineCpt == '') {
        $.ajax({
            url: '../WebService/getPointCpt.php',
            type: 'GET',
            dataType: 'json',
            data: {idDomaineCpt: idDomaineCpt, action: 'getByDomaineCpt'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idPointCpt'] + '">' + item['libellePointCpt'] + '</option>';
                });
            }
            $("#selectCpt").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

$("#addCpt").click(function(){
    var idDomaineCpt = $("#selectDomaine option:selected").val();
    var idPointCpt = $("#selectCpt option:selected").val();
    var libDomaine = $("#txtDomaine").val();
    var libPoint = $("#txtCpt").val();
    var idEvaluation = $("#idEval").val();
    if (!libDomaine == ''){
        $.ajax({
            url: '../WebService/Competence.php',
            type: 'GET',
            dataType: 'json',
            data: {libDomaineCpt: libDomaine,idEvaluation:idEvaluation, action: 'addDomaineLib'}
        }).success(function (data) {
            console.log(data['idDomaineCpt']);
            idDomaineCpt = data['idDomaineCpt'];
            addPointCpt(libPoint,idPointCpt, idEvaluation, idDomaineCpt);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans l ajout du domaine de Cpt.');
        })
    }
    else if (idDomaineCpt == ''){
        alert ('Aucun doaine choisi');
        return false;
    }
    else {
        addPointCpt(libPoint,idPointCpt, idEvaluation, idDomaineCpt);
    }

});

function mAjourListe(){
    var idEvaluation = $("#idEval").val();
    $.ajax({
        url: '../WebService/Competence.php',
        type: 'GET',
        dataType: 'json',
        data: {idEvaluation:idEvaluation, action: 'getListe'}
    }).success(function (data) {
        var html = "";
        $.each(data, function (i, item) {
            html += '<li>' + item['pointCpt']['libellePointCpt'] + ' (' + item['domaineCpt']['libelleDomaineCpt'] + ')</li>';
        });
        $("#listeCpt").html(html);
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans la recuperation de la liste des CPT.');
    })
}

$.ready(mAjourListe());

function addPointCpt(libPoint,idPointCpt, idEvaluation, idDomaineCpt) {
    console.log('libPt : '+libPoint+' | idPt : '+idPointCpt+' | idEval : '+idEvaluation+' | idDom'+idDomaineCpt);
    if (!(libPoint == '')) {
        $.ajax({
            url: '../WebService/Competence.php',
            type: 'GET',
            dataType: 'json',
            data: {
                idEvaluation: idEvaluation,
                libPointCpt: libPoint,
                idDomaineCpt: idDomaineCpt,
                action: 'addPointLib'
            }
        }).success(function (data) {
            mAjourListe();
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation du point de Cpt.');
        })
    }
    else if (!(idPointCpt == '')) {
        $.ajax({
            url: '../WebService/Competence.php',
            type: 'GET',
            dataType: 'json',
            data: {
                idEvaluation: idEvaluation,
                idPointCpt: idPointCpt,
                idDomaine: idDomaineCpt,
                action: 'addPointId'
            }
        }).success(function () {
            mAjourListe();
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log('idEval : ' + idEvaluation + ' | idPointCpt :' + idPointCpt + ' | idDomaineCpt :' + idDomaineCpt);
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation du point de Cpt par ID.');
        })
    }
    else {
        alert('Aucune compétence choisie.')
    }
}