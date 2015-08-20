/*
 * Created by Jean-Baptiste on 10/08/2015.
 */

$("#reduction").click(function(){
    $("#content").toggleClass('close');
    $("#reduction").toggleClass("fa-arrow-circle-o-right").toggleClass("fa-arrow-circle-o-left");
});

$("#adminReduc").click(function(){
    $("#adminMenu").toggle();
    $("#adminReduc i").toggleClass("fa-arrow-circle-o-down").toggleClass("fa-arrow-circle-o-up");
});

$("#adminMatiereReduc").click(function(){
    $("#adminMatiere").toggle();
    $("#adminMatiereReduc i").toggleClass("fa-arrow-circle-o-down").toggleClass("fa-arrow-circle-o-up");
});

$("#adminCptReduc").click(function(){
    $("#adminCptMenu").toggle();
    $("#adminCptReduc i").toggleClass("fa-arrow-circle-o-down").toggleClass("fa-arrow-circle-o-up");
});

$("#adminPlanningReduc").click(function(){
    $("#adminPlanningMenu").toggle();
    $("#adminPlanningReduc i").toggleClass("fa-arrow-circle-o-down").toggleClass("fa-arrow-circle-o-up");
});

$("#evalReduc").click(function(){
    $("#evalMenu").toggle();
    $("#evalReduc i").toggleClass("fa-arrow-circle-o-down").toggleClass("fa-arrow-circle-o-up");
});

$("#publiReduc").click(function(){
    $("#publiMenu").toggle();
    $("#publiReduc i").toggleClass("fa-arrow-circle-o-down").toggleClass("fa-arrow-circle-o-up");
});

$("#bulletinReduc").click(function(){
    $("#bulletinMenu").toggle();
    $("#bulletinReduc i").toggleClass("fa-arrow-circle-o-down").toggleClass("fa-arrow-circle-o-up");
});

$.ready(
    start()
);

function start(){
    $("#adminReduc").click();
    $("#adminCptReduc").click();
    $("#adminPlanningReduc").click();
    $("#evalReduc").click();
    $("#publiReduc").click();
    $("#bulletinReduc").click();
    $("#adminMatiereReduc").click();
}

$( "#choixEnfant" ).change(function() {
    $("#idEnfant").html($( "#choixEnfant option:selected" ).val());
    $("#enfantURL").attr('href', "../Intranet/MesInformations.php?id="+$( "#choixEnfant option:selected" ).val());
});

