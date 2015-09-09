/**
 * Created by Jean-Baptiste on 20/08/2015.
 */
$("#selectNiveau").change(function () {
    $("#idNiveau").val($("#selectNiveau option:selected").val());
});

