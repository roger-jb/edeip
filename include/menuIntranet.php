<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 05/08/2015
 * Time: 17:44
 */

?>
<i id="reduction" class="fa fa-arrow-circle-o-left"></i>
<div id="menuContent">

<h3>Administration</h3>
<ul>
	<li><a href="">ajouter un utilisateur</a></li>
	<li><a href="">modifier un utilisateur</a></li>
</ul>

<h3>Evaluation</h3>
<ul>
	<li><a href="">Créer Evaluation</a></li>
	<li><a href="">Affecter Note à une évaluation</a></li>
</ul>
</div>
<script type="text/javascript">
	$("#reduction").click(function(){
		$("#content").toggleClass('close');
		//$("#menuContent").toggle();
		//$("#reduction").addClass("fa-plus").removeClass("fa-minus");
		if ($("#reduction").hasClass("fa-arrow-circle-o-left")){
			$("#reduction").addClass("fa-arrow-circle-o-right").removeClass("fa-arrow-circle-o-left");
		}
		else {
			$("#reduction").removeClass("fa-arrow-circle-o-right").addClass("fa-arrow-circle-o-left");
		}
		//$("#reduction").toggleClass("fa-plus")
	});
</script>