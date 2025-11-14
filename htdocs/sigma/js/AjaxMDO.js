// JavaScript Document

$(function(){
	
$("#mdoApreAjax").hide();

	//"Surveillance du champ "Recherche" avec la méthode jQuery "keyup"
	$("#code").change(function(){
		
		var data='code='+$("#code").val();
		if($("#code").val()!='0')
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
	// Code Ponctuel
	$("#codeP").change(function(){
		
		var data='codeP='+$("#codeP").val();
		$("#SP").hide();
		if($("#codeP").val()!='0')
		{
		
			$.ajax({
				type:'GET',
				url:'rechercheajaxPonctMDO.php',
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
