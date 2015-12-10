/**
 * Created by Jean-Baptiste on 22/11/2015.
 */

$("#eleve").change(function(){
    MaJlisteMatiere();
});

function MaJlisteMatiere(){
    var idEleve = $("#eleve option:selected").val();
    var html = '';
    $("#listeMatiere").html(html);
    if (idEleve != '') {
        $.ajax({
            url: '../WebService/EleveMatiereNiveau.php',
            type: 'GET',
            dataType: 'json',
            data: {idEleve: idEleve, action: 'getListeMatiere'}
        }).success(function (data) {
            html += "<ul>";
            $.each(data, function (i, item) {
                html += '<li >' + item['niveau']['libelleNiveau'];
                html += '<ul>';
                var matieres = item['matiere'];
                $.each(matieres, function (i, mat) {
                    html += '<li >' + mat['libelleMatiere']+'</li>';
                });

                html += '</ul></li>';
            });
            html +="</ul>"
            $("#listeMatiere").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
}

$("#btAdd").click(function(){
    var idEleve = $("#eleve option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    var idNiveau = $("#selectNiveau option:selected").val();
    if (idEleve != ''&& idMatiere != ''&& idNiveau != '') {
        $.ajax({
            url: '../WebService/Matiere.php',
            type: 'GET',
            dataType: 'json',
            data: {idEleve: idEleve, idMatiere: idMatiere, idNiveau: idNiveau, action: 'addMatiere'}
        }).success(function (data) {
            MaJlisteMatiere();
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }

});

$("#btDel").click(function(){
    var idEleve = $("#eleve option:selected").val();
    var idMatiere = $("#selectMatiere option:selected").val();
    var idNiveau = $("#selectNiveau option:selected").val();
    if (idEleve != ''&& idMatiere != ''&& idNiveau != '') {
        $.ajax({
            url: '../WebService/Matiere.php',
            type: 'GET',
            dataType: 'json',
            data: {idEleve: idEleve, idMatiere: idMatiere, idNiveau: idNiveau, action: 'delMatiere'}
        }).success(function (data) {
            MaJlisteMatiere();
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});

$("#selectNiveau").change(function(){
    var idNiveau = $("#selectNiveau option:selected").val();
    if (!idNiveau == '') {
        $.ajax({
            url: '../WebService/getMatiere.php',
            type: 'GET',
            dataType: 'json',
            data: {idNiveau: idNiveau, action: 'getByNiveau'}
        }).success(function (data) {
            var html = "";
            if (data.length) {
                var html = '<option value=""></option>';
                $.each(data, function (i, item) {
                    html += '<option value="' + item['idMatiere'] + '">' + item['libelleMatiere'] + '</option>';
                });
            }
            $("#selectMatiere").html(html);
        }).error(function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log('Erreur dans la recuperation des matieres.');
        })
    }
});