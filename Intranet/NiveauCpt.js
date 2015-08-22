/**
 * Created by Jean-Baptiste on 19/08/2015.
 */
$("#selectNiveauCpt").change(function () {
    var idNiveauCpt = $("#selectNiveauCpt option:selected").val();
    $.ajax({
        url: '../WebService/getById.php',
        type: 'POST',
        dataType: 'json',
        data: {idNiveauCpt: idNiveauCpt, action: 'NiveauCpt'}
    }).success(function (data) {
        $("#inputId").val(data['idNiveauCpt']);
        $("#inputLibelle").val(data['libelleNiveauCpt']);
        $("#inputCode").val(data['codeNiveauCpt'])
    }).error(function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log('Erreur dans la récupération du Niveau de competence.');
    })
});

$("#newNiveauCpt").click(function () {
    $("#inputId").val("");
    $("#inputLibelle").val("");
    $("#inputCode").val("");
});

$('#inputCode').change(function(){
    var code = $('#inputCode').val();
    if (code.length > 0){
        $('#inputCode').val(code.substr(0, 1));
    }
});