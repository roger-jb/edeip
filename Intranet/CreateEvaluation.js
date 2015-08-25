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
});

$("#selectNiveau").click(function(){
    var idNiveau =$("#selectNiveau option:selected").val();
    var idUtilisateur = $("#idUtilisateur").val();

    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/Evaluation.php',
            type: 'POST',
            dataType: 'json',
            data: {idNiveau: idNiveau, idUtilisateur: idUtilisateur, action: 'listeMatiere'}
        }).success(function (data) {
            if(data.length){
                $("#newSelectMatiere")
            }
            else {

            }
            $("#selectEleve option[value='" + data['idEleve'] + "']").attr('selected', 'selected');
        }).error(function (xhr, ajaxOptions, thrownError) {
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