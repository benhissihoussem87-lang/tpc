// JavaScript Document
$(function(){
$("#mdoApreAjax").hide();

	//"Surveillance du champ "Recherche" avec la méthode jQuery "keyup"
	$("#codep").change(function(){
		
		var data='code='+$("#codep").val();
		if($("#codep").val()!='0')
		{
		
			$.ajax({
				type:'GET',
				url:'rechercheajaxSOusProjet.php',
				data: data,
				
				success:function(code_html){
					
					//on fait apparaître le résultat dans la div d'id "resultat"
					
					$("#res_sousProjet").html(code_html);
				}
			});			
        }		
		
	});	
	
	//Pour titre de projet
	$("#projet").change(function(){
		
		var data='projet='+$("#projet").val();
		if($("#projet").val()!='0')
		{
		
			$.ajax({
				type:'GET',
				url:'rechercheajaxMDO.php',
				data: data,
				
				success:function(code_html){
					
					//on fait apparaître le résultat dans la div d'id "resultat"
					$("#mdoAvantAjax").hide();
					$("#mdoApreAjax").show();
					
						$("#SPAvantAjax").hide();
					$("#SPApreAjax").show();
					
					$("#mdoApreAjax").html(code_html);
					
				}
			});			
        }		
		
	});	
});