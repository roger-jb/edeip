/**
 * Created by Jean-Baptiste on 17/08/2015.
 */
$("#selectNiveau").change(function () {
    var idNiveau = $("#selectNiveau option:selected").val();
    $("#newNiveau").click();
    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/getById.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, action: 'Niveau'}
        }).success(function (data) {
            $("#inputId").val(data['idNiveau']);
            $("#inputLibelle").val(data['libelleNiveau']);
            $("#inputModule option[value='" + data['idModule'] + "']").attr('selected', 'selected');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la r�cup�ration des info du niveau.');
        })
    }
});

$("#newNiveau").click(function () {
    $("#inputId").val("");
    $("#inputLibelle").val("");
    $("#inputModule").val('');
});