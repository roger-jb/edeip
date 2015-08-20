/**
 * Created by Jean-Baptiste on 17/08/2015.
 */
$("#selectModule").change(function () {
    var idModule = $("#selectModule option:selected").val();
    $.ajax({
        url: '../WebService/getById.php',
        type: 'POST',
        dataType: 'json',
        data: {idModule: idModule, action: 'Module'}
    }).success(function (data) {
        $("#inputId").val(data['idModule']);
        $("#inputLibelle").val(data['libelleModule']);
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans la récupération des info de l\'utilisateur.');
    })
});

$("#newModule").click(function () {
    $("#inputId").val("");
    $("#inputLibelle").val("");
});