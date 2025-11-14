// JavaScript Document
$(function(){
$("#resultatApre").hide();
$("#cd_projetsApres").hide();
// Ponctuel
$("#resultatPonctApre").hide();
$("#cd_ponctuelsApres").hide();
	//"Surveillance du champ "Recherche" avec la méthode jQuery "keyup"
	$("#code").change(function(){
		$("#codeP").attr("disabled",true);
		$("#projetP").attr("disabled",true);
		var data='code='+$("#code").val();
		if($("#code").val()!='0')
		{
		
			$.ajax({
				type:'GET',
				url:'rechercheajax.php',
				data: data,
				
				success:function(code_html){
					
					//on fait apparaître le résultat dans la div d'id "resultat"
					$("#resultatAvant").hide();
					$("#resultatApre").show();
					$("#resultatApre").html(code_html);
				}
			});			
        }		
		
	});
/************* Code Ponctuel ***************************/
	$("#codeP").change(function(){
		$("#code").attr("disabled",true);
		$("#projet").attr("disabled",true);
		var data='codeP='+$("#codeP").val();
		if($("#codeP").val()!='0')
		{
		
			$.ajax({
				type:'GET',
				url:'rechercheajaxPonct.php',
				data: data,
				
				success:function(code_html){
					
					//on fait apparaître le résultat dans la div d'id "resultat"
					$("#resultatPonctAvant").hide();
					$("#resultatPonctApre").show();
					$("#resultatPonctApre").html(code_html);
				}
			});			
        }		
		
	});
// si on choisit le titre	
$("#projet").change(function(){
		
		var data='projet='+$("#projet").val();
		if($("#projet").val()!='0')
		{
		
			$.ajax({
				type:'GET',
				url:'rechercheajaxTitre.php',
				data: data,
				
				success:function(code_html){
					
					//on fait apparaître le résultat dans la div d'id "resultat"
					$("#cd_projetsAvant").hide();
					$("#cd_projetsApres").show();
					$("#cd_projetsApres").html(code_html);
				}
			});			
        }		
		
	});

});