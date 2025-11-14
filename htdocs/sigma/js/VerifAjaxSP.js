// JavaScript Document
$(function(){
$("#mdoApreAjax").hide();

	//"Surveillance du champ "Recherche" avec la méthode jQuery "keyup"
	$("#code_sp").blur(function(){
		
		var data='code_sp='+$("#code_sp").val();
		if($("#code_sp").val()!='0')
		{
		
			$.ajax({
				type:'GET',
				url:'rechercheajaxSP.php',
				data: data,
				
				success:function(code_html){
					
					//on fait apparaître le résultat dans la div d'id "resultat"
					
					$("#res_SP").html(code_html);
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
					$("#mdoApreAjax").html(code_html);
				}
			});			
        }		
		
	});	
});