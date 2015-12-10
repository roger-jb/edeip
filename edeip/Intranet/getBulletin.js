/**
 * Created by Jean-Baptiste on 01/12/2015.
 */

$("#selectNiveau").change(function(){
    var idNiveau = $("#selectNiveau option:selected").val();
    console.log(idNiveau);
    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/getEleve.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, action: 'getByNiveau'}
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
});
/*
$("#test").click(function(){
    console.log($('#selectTrimestre').val());
    $('#selectTrimestre').val('2');
})*/

$("#btRechercher").click(function(){
    var idTrimestre = $("#selectTrimestre option:selected").val();
    var idEleve = $("#selectEleve option:selected").val();
    if (idEleve == '' || idTrimestre == ''){
        alert('Merci de selectionner un eleve et un trimestre');
    }
});