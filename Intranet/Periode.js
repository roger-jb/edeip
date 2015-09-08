/**
 * Created by Jean-Baptiste on 19/08/2015.
 */
$("#selectPeriode").change(function () {
    var idPeriode = $("#selectPeriode option:selected").val();
    if (!idPeriode == '') {
        $.ajax({
            url: '../WebService/getById.php',
            type: 'GET',
            dataType: 'json',
            data: {idPeriode: idPeriode, action: 'Periode'}
        }).success(function (data) {
            $("#inputId").val(data['idPeriode']);
            $("#inputLibelle").val(data['libellePeriode']);
            $("#inputDateDeb").val(data['dateDebutPeriode']);
            $("#inputDateFin").val(data['dateFinPeriode']);
            $("#selectTrimestre option[value='" + data['idTrimestre'] + "']").attr('selected', 'selected');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des info de la periode.');
        })
    }
});

$("#newPeriode").click(function () {
    $("#inputId").val("");
    $("#inputLibelle").val("");
    $("#inputDateDeb").val("");
    $("#inputDateFin").val("");
    $("#selectTrimestre").val("");
    $("#selectPeriode").val("");
});

$(function () {
    $("#inputDateDeb").datepicker();
    $("#inputDateFin").datepicker();
});