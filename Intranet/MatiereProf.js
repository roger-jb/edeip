/**
 * Created by Jean-Baptiste on 20/08/2015.
 */
$("#selectNiveau").change(function () {
    var idNiveau = $("#selectNiveau option:selected").val();
    clear();
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

function clear() {
    $("#inputId").val("");
    $("#inputLibelle").val("");
    $("#inputModule").val('');
};