$(function(){
	$("#ConventionClient").hide();
	$("#PieceExonorationClient").hide();
	//Type Client
	$("#typeClient").change(function(){
		var type=$(this).val()
		if(type=='conventionner'){
			$("#ConventionClient").show();
			$("#ConventionClientUpdate").show();
		}
		else {$("#ConventionClient").hide();
		      $("#ConventionClientUpdate").hide();}
	})
	//Exonoration
	$("#ExonorationClient input[type=radio]").click(function(){
		var exonoration=$(this).val()
		if(exonoration=='oui'){$("#PieceExonorationClient").show();}
		else if(exonoration=='non'){$("#PieceExonorationClient").hide();}
	})

// Get Id Client 
 $(".updateClient").click(function(){
	 
	 let id=$('a',this).attr('id')
	 $("#ClientId").val(id)
	
	 //Ajax
	 let url='pages/clients/ModifierClient.php'
	 $.ajax(url,{
		 type:'GET',
		 data :{id_client:id},
		 success: function (data) {
			
			$("#detail").html(data)
			},
			error: function (errorMessage) {
					console.log(errorMessage);
			}
		 
		 
	 })
 })
 
 
})

