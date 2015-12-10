/**
 * Created by Jean-Baptiste on 19/08/2015.
 */
$("#selectMatiere").change(function () {
    var idMatiere = $("#selectMatiere option:selected").val();
    if (!idMatiere == '') {
        $.ajax({
            url: '../WebService/getById.php',
            type: 'GET',
            dataType: 'json',
            data: {idMatiere: idMatiere, action: 'Matiere'}
        }).success(function (data) {
            $("#inputId").val(data['idMatiere']);
            $("#inputLibelle").val(data['libelleMatiere']);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la r�cup�ration des info du niveau.');
        })
    }
});

$("#newMatiere").click(function () {
    $("#inputId").val("");
    $("#inputLibelle").val("");
});