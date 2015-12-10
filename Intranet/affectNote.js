/**
 * Created by Jean-Baptiste on 13/10/2015.
 */

$.ready(chargement());

/**
 * Chargement des informations/présentation une fois la page chargée
 */
function chargement(){
    $("#detRappelEval").toggle();
    $("#detRappelCpt").toggle();
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

$("#validation").click(function(){
    var idEval = $("#idEval").val();
    var idEleve = $("#idEleveNote option:selected").val();
    var note = $("#noteEleve").val();
    var nbCpt = $("#nbCpt").val();
	var ok = true;
    var okNote = false;
    var okcpt = false;
    console.log(idEval);
    console.log(idEleve);
    console.log(note);
    console.log("les compétences");
    // ajout de la note
    if (idEleve != '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEval, idEleve: idEleve, note: note, action: 'notation'}
        }).success(function () {
            console.log('reussite note');
            okNote = true;
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
			ok = false;
			alert('Problème lors de l\'ajout de la note');
        })
    }

    // ajout des niveaux de compétences et MaJ
    var pushCptValCpt = "";
    for (var i=1; i <= nbCpt; i++){
        var valCpt = $("#evalCpt"+i+" option:selected").val();
        var idCpt = $("#idCpt"+i).val();
        console.log(idCpt+" : "+valCpt);
        pushCptValCpt += idCpt+':'+valCpt+'|';
    }
    console.log(pushCptValCpt);
    if (idEleve != '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'GET',
            dataType: 'json',
            data: {idEval: idEval, idEleve: idEleve, pushCptValCpt: pushCptValCpt, action: 'competence'}
        }).success(function () {
            console.log('reussite Competence');
            okcpt = true;
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
			ok = false;
			alert('problème lors de l\'ajout des competence.');
        })
    }
	if (idEleve != ''){
        var i = 0;
        while(!ok || (okNote && okcpt)){
            i++;
        }
        if (ok)
    		alert('ajout des compétences et de la note reussi.');
	}
});