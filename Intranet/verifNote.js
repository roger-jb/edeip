/**
 * Created by Jean-Baptiste on 22/11/2015.
 */
$.ready(chargement());

/**
 * Chargement des informations/présentation une fois la page chargée
 */
function chargement(){
    $("#detRappelEval").toggle();
    $("#detRappelCpt").toggle();
    majListeEleveNote();
}

/**
 * afficher/masquer le détail de l'évaluation
 */
function toggleRappelEval(){
    $("#libRappelEval").toggle();
    $("#detRappelEval").toggle();
}

$("#libRappelEval").click(function(){
    toggleRappelEval();
});

$("#detRappelEval").click(function(){
    toggleRappelEval();
});

/**
 * afficher/masquer le détail des compétences
 */
function toggleRappelCpt(){
    $("#libRappelCpt").toggle();
    $("#detRappelCpt").toggle();
}

$("#libRappelCpt").click(function(){
    toggleRappelCpt();
});

$("#detRappelCpt").click(function(){
    toggleRappelCpt();
});

$(".evalCpt").click(function(){
    var nb = this.id.substr(7);
    var idPointCpt = $("#idCpt"+nb).val();
    var nivCpt = $("#evalCpt"+nb+" option:selected").val();
    var idEleve = $("#idEleveNote option:selected").val();
    var idEval = $("#idEval").html();
    console.log(idEval +'|'+ idEleve +'|'+ idPointCpt +'|'+ nivCpt +'|'+ 'modifCpt');
    if (idEleve != '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEval, idEleve: idEleve, idPointCpt: idPointCpt, nivCpt: nivCpt, action: 'modifCpt'}
        }).success(function () {
            console.log('reussite Competence');
            majListeEleveNote();
            alert('Modification de la competence reussie.');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la modification de la competence.');
            alert('problème lors de la modification de la competence.');
        })
    }
    else {
        alert('Merci de selectionner un eleve.');
    }
});

$("#modifNote").click(function(){
    var note = $("#noteEleve").val();
    var idEleve = $("#idEleveNote option:selected").val();
    var idEval = $("#idEval").html();
    console.log(note + '|'+idEleve+'|'+idEval);
    if (idEleve != '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEval, idEleve: idEleve, note: note, action: 'modifNote'}
        }).success(function () {
            console.log('reussite Competence');
            majListeEleveNote();
            alert('Modification de la note reussie.');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la modification de la note.');
            alert('problème lors de la modification de la note.');
        })
    }
    else {
        alert('Merci de selectionner un eleve.');
    }
});

$("#idEleveNote").change(function(){
    var idEleve = $("#idEleveNote option:selected").val();
    var idEval = $("#idEval").html();
    // recuperation de la note
    if (idEleve != '') {
        $.ajax({
            url: '../WebService/getNote.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEval, idEleve: idEleve, action: 'getByEleveEvaluation'}
        }).success(function (data) {
            $("#noteEleve").val(data['note']);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation de la note.');
            alert('problème lors de la recuperation de la note.');
        });

        $.ajax({
            url: '../WebService/getCompetence.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEval, idEleve: idEleve, action: 'getByEleveEvaluation'}
        }).success(function (data) {
            var nb = 1;
            $.each(data, function (i, item) {
                if (item == ''){
                    console.log('item Vide');
                }
                else {
                    console.log(i);
                    console.log(item);
                    var ii = i+1;
                    console.log(item['NiveauCpt']['idNiveauCpt']);
                    $("#evalCpt"+(ii)).val(item['NiveauCpt']['idNiveauCpt']);
                }
                nb++;
            });
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des competences.');
            alert('problème lors de la recuperation des competences.');
        })
    }
});

function majListeEleveNote(){
    // nombre de competences
    var nbCpt = $("#nbCpt").val();
    var idEval = $("#idEval").html();

    //creation de la premiere ligne du tableau
    var html = '<tr><td>&Eacute;l&egrave;ve</td><td>Note</td>';
    var i = 1;
    while (i <= nbCpt){
        html += '<td>cpt'+i+'</td>';
        i++;
    }
    html += '</tr>';

    // création de chaque ligne d'eleve
    $.ajax({
        url: '../WebService/Evaluation.php',
        type: 'GET',
        dataType: 'json',
        data: {idEval: idEval, action: 'getListeEleveNoteByEval'}
    }).success(function (data) {
        $.each(data, function (i, item) {
            html += item;
        });
        $("#listeEleveNote").html(html);
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans la recuperation de la liste des elevesNotes.');
        alert('problème lors de la recuperation de la liste des elevesNotes.');
    });


    $("#listeEleveNote").html(html);
}