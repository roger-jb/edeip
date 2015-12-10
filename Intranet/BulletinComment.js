/**
 * Created by Jean-Baptiste on 28/11/2015.
 */

$("#selectNiveau").change(function () {
    var idNiveau = $("#selectNiveau option:selected").val();
    $('#listeCompetenceEval').html('');
    $("#selectMatiere").change();
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

$("#selectMatiere").change(function () {
    var idMatiere = $("#selectMatiere option:selected").val();
    var idNiveau = $("#selectNiveau option:selected").val();
    $('#listeCompetenceEval').html('');
    if (!idMatiere == '' && !idNiveau == '') {
        $.ajax({
            url: '../WebService/getEleve.php',
            type: 'GET',
            dataType: 'json',
            data: {idMatiere: idMatiere, idNiveau: idNiveau, action: 'getByMatiereNiveau'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idUtilisateur'] + '">' + item['libelleUtilisateur'] + '</option>';
                });
            }
            $("#selectEleve").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
    var idTrimestre = $("#selectTrimestre option:selected").val();
    if (!idMatiere == '' && !idNiveau == '' && !idTrimestre == '') {
        $.ajax({
            url: '../WebService/getCompetence.php',
            type: 'GET',
            dataType: 'json',
            data: {idMatiere: idMatiere, idTrimestre: idTrimestre, action: 'getByMatiereTrimestre'}
        }).success(function (data) {
            var html = '<option value=""></option>';
            if (data.length) {
                $.each(data, function (i, item) {
                    html += item;
                });
            }
            $("#idPtCpt").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des competences du niveau.');
        })
    }
});

$("#selectEleve").change(function () {
    var idTrimestre = $("#selectTrimestre option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    var idNiveau = $("#selectNiveau option:selected").val();
    var idEleve = $("#selectEleve option:selected").val();

    $("#idBulletin").html('');
    $("#txtCommentaire").val('');
    $("#listeCompetence").html('');
    if (!idMatiere == '' && !idNiveau == '' && !idEleve == '') {
        $.ajax({
            url: '../WebService/Bulletin.php',
            type: 'GET',
            dataType: 'json',
            data: {
                idEleve: idEleve,
                idMatiere: idMatiere,
                idNiveau: idNiveau,
                idTrimestre: idTrimestre,
                action: 'getByEleveMatiereNiveauTrimestre'
            }
        }).success(function (data) {
            $("#idBulletin").html(data['idBulletin']);
            $("#txtCommentaire").val(data['contenuBulletin']);
            loadCpt();
            majListeCompetence();
        }).error(function (xhr, ajaxOptions, thrownError) {
            $("#idBulletin").html('');
            $("#txtCommentaire").html('');
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des commentaires.');
        })
    }
});

$("#btComm").click(function () {
    var idTrimestre = $("#selectTrimestre option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    var idNiveau = $("#selectNiveau option:selected").val();
    var idEleve = $("#selectEleve option:selected").val();
    var idBulletin = $("#idBulletin").html();
    var commBulletin = $("#txtCommentaire").val();

    if (!idMatiere == '' && !idNiveau == '' && !idEleve == '' && !idTrimestre == '') {
        if (idBulletin == '')
            idBulletin = 0;
        $.ajax({
            url: '../WebService/Bulletin.php',
            type: 'GET',
            dataType: 'json',
            data: {
                idEleve: idEleve,
                idMatiere: idMatiere,
                idNiveau: idNiveau,
                idTrimestre: idTrimestre,
                idBulletin: idBulletin,
                commBulletin: commBulletin,
                action: 'addCommentaire'
            }
        }).success(function (data) {
            $("#idBulletin").html(data['idBulletin']);
            alert('Le commentaire a ete ajoute');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

$("#btNivCpt").click(function () {
    var idTrimestre = $("#selectTrimestre option:selected").val();
    var idEleve = $("#selectEleve option:selected").val();
    var idPtCpt = $("#idPtCpt option:selected").val();
    var idNivCpt = $("#idNivCpt option:selected").val();
    if (!idTrimestre == '' && !idEleve == '' && !idPtCpt == '') {
        if (idNivCpt == '') {
            idNivCpt = 0;
        }
        $.ajax({
            url: '../WebService/Bulletin.php',
            type: 'GET',
            dataType: 'json',
            data: {
                idEleve: idEleve,
                idTrimestre: idTrimestre,
                idPtCpt: idPtCpt,
                idNivCpt: idNivCpt,
                action: 'addNivCpt'
            }
        }).success(function (data) {
            $("#idBulletin").html(data['idBulletin']);
            majListeCompetence();
            alert('La Competence a ete mise a jour.');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

function loadCpt() {
    var idTrimestre = $("#selectTrimestre option:selected").val();
    var idEleve = $("#selectEleve option:selected").val();
    var idPtCpt = $("#idPtCpt option:selected").val();

    if (!idEleve == '' && !idTrimestre == '' && !idPtCpt == '') {
        var htmlCptEval = '<tr><td>&Eacute;valuation</td><td>Niveau de Comp&eacute;tence</td></tr>';
        $('#listeCompetenceEval').html('');
        $.ajax({
            url: '../WebService/getCompetence.php',
            type: 'GET',
            dataType: 'json',
            data: {
                idEleve: idEleve,
                idPtCpt: idPtCpt,
                idTrimestre: idTrimestre,
                action: 'getByElevePointCptTrimestreForCpt'
            }
        }).success(function (data) {
            if (data.length) {
                $.each(data, function (i, item) {
                    htmlCptEval += '<tr><td>' + item['libCpt'] + '</td><td>' + item['noteCpt'] + '</td></tr>';
                });
            }
            $("#listeCompetenceEval").html(htmlCptEval);
        }).error(function (xhr, ajaxOptions, thrownError) {
            $("#idBulletin").html('');
            $("#txtCommentaire").html('');
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des commentaires.');
        })
    }
}
// � reprendre.
/*
 if (!idMatiere == '' && !idNiveau == '' && !idEleve == '' && !idTrimestre == '') {
 var htmlCptEval = '<tr><td>&Eacute;valuation</td><td>Niveau de Comp&eacute;tence</td></tr>';
 $('#listeCompetenceEval').html('');
 $.ajax({
 url: '../WebService/getCompetence.php',
 type: 'GET',
 dataType: 'json',
 data: {idEleve: idEleve, idMatiere: idMatiere, idNiveau: idNiveau, idTrimestre:idTrimestre, action: 'getByEleveMatiereTrimestre'}
 }).success(function (data) {
 if (data.length) {
 $.each(data, function (i, item) {
 htmlCptEval += '<tr><td>'+item['libCpt']+'</td><td>'+item['noteCpt']+'</td></tr>';
 });
 }
 $('#listeCompetenceEval').html(htmlCptEval);
 }).error(function (xhr, ajaxOptions, thrownError) {
 $("#idBulletin").html('');
 $("#txtCommentaire").html('');
 console.log(xhr.status);
 console.log(thrownError);
 console.log('Erreur dans la recuperation des commentaires.');
 })
 }
 */


function majListeCompetence() {
    var html = '';
    var idTrimestre = $("#selectTrimestre option:selected").val();
    var idEleve = $("#selectEleve option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();

    $("#listeCompetence").html('');
    if (!idTrimestre == '' && !idEleve == '') {
        $.ajax({
            url: '../WebService/Bulletin.php',
            type: 'GET',
            dataType: 'json',
            data: {idEleve: idEleve, idMatiere: idMatiere, idTrimestre: idTrimestre, action: 'getListeCompetence'}
        }).success(function (data) {
            if (data.length) {
                $.each(data, function (i, item) {
                    html += item;
                });
            }
            $("#listeCompetence").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
}