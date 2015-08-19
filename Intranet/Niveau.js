/**
 * Created by Jean-Baptiste on 17/08/2015.
 */
$("#selectNiveau").change(function () {
    var idNiveau = $("#selectNiveau option:selected").val();
    $("#inputModule").val('');
    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/adminNiveau.php',
            type: 'POST',
            dataType: 'json',
            data: {idNiveau: idNiveau, action: 'getNiveauById'}
        }).success(function (data) {
            $("#inputId").val(data['idNiveau']);
            $("#inputLibelle").val(data['libelleNiveau']);
            $("#inputModule option[value='" + data['idModule'] + "']").attr('selected', 'selected');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la récupération des info du niveau.');
        })
    }
});

$("#newModule").click(function () {
    $("#inputId").val("");
    $("#inputLibelle").val("");
    $("#inputModule").val('');
});