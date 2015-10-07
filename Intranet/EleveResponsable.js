/**
 * Created by Jean-Baptiste on 03/10/2015.
 */

$('#EleveSelect').change(function(){
    var idEleve = $("#EleveSelect option:selected").val();
    if (!idEleve == '') {
        $.ajax({
            url: '../WebService/EleveResponsable.php',
            type: 'GET',
            dataType: 'json',
            data: {idEleve: idEleve, action: 'getResponsables'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                $.each(data, function (i, item) {
                    html += '<li>' + item.libelleUtilisateur + '</li>';
                });
            }
            $("#ResponsableSelect").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des responsables.');
        })
    }
});

$('#btAjouter').click(function(){
    var idEleve = $("#inputEleve option:selected").val();
    var idResponsable = $("#inputResponsable option:selected").val();

    if (!(idEleve == '') && !(idResponsable == '')){
        $.ajax({
            url: '../WebService/EleveResponsable.php',
            type: 'GET',
            dataType: 'json',
            data: {idEleve: idEleve, idResponsable: idResponsable, action: 'addResponsable'}
        }).success(function () {
            alert('Ajout Realise');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des responsables.');
        })
    }
});

$('#btSupprimer').click(function(){
    var idEleve = $("#inputEleve option:selected").val();
    var idResponsable = $("#inputResponsable option:selected").val();

    if (!(idEleve == '') && !(idResponsable == '')){
        $.ajax({
            url: '../WebService/EleveResponsable.php',
            type: 'GET',
            dataType: 'json',
            data: {idEleve: idEleve, idResponsable: idResponsable, action: 'delResponsable'}
        }).success(function () {
            alert('Suppression Realise');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des responsables.');
        })
    }
});
