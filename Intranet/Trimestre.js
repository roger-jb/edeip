/**
 * Created by Jean-Baptiste on 19/08/2015.
 */
$("#selectTrimestre").change(function () {
    var idTrimestre = $("#selectTrimestre option:selected").val();
    if (!idTrimestre == '') {
        $.ajax({
            url: '../WebService/getById.php',
            type: 'GET',
            dataType: 'json',
            data: {idTrimestre: idTrimestre, action: 'Trimestre'}
        }).success(function (data) {
            $("#inputId").val(data['idTrimestre']);
            $("#inputLibelle").val(data['libelleTrimestre']);
            $("#inputDateDebut").val(data['dateDebutTrimestre']);
            $("#inputDateFin").val(data['dateFinTrimestre']);
            $("#inputDateFinComm").val(data['dateFinCommentaire']);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des info du niveau.');
        })
    }
});

$("#newTrimestre").click(function () {
    $("#selectTrimestre").val("");
    $("#inputId").val("");
    $("#inputLibelle").val("");
    $("#inputDateDebut").val("");
    $("#inputDateFin").val("");
    $("#inputDateFinComm").val("");
});

$(function () {
    $("#inputDateDebut").datepicker();
    $("#inputDateFin").datepicker();
    $("#inputDateFinComm").datepicker();
});