/**
 * Created by Jean-Baptiste on 22/08/2015.
 */

$("#newMessageClick").click(function(){
    $("#newMessage").show();
    $('html,body').animate({scrollTop: $("#pageTitle").offset().top}, 200);
    $("#inputIdReponse").val("");
    $("#selectEleve").val("");
    $("#contenu").val("");
});

$(".repondre").click(function(){
    var idReponse = this.getAttribute('idcarnetliaison');
    $("#newMessageClick").click();
    $("#inputIdReponse").val(idReponse);

    if (!idReponse == '') {
        $.ajax({
            url: '../WebService/getById.php',
            type: 'GET',
            dataType: 'json',
            data: {idCarnetLiaison: idReponse, action: 'CarnetLiaison'}
        }).success(function (data) {
            $("#selectEleve option[value='" + data['idEleve'] + "']").attr('selected', 'selected');
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la r�cup�ration des info du niveau.');
        })
    }

});

$(".reponse").click(function(){
    var reponse = '#Reponse'+this.getAttribute('idReponse');
    console.log(reponse);
    $(reponse).show();
    $(this).hide();
    console.log($(this).attr('id'));

});