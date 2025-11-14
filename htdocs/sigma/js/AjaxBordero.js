$(function(){

$("#test_visavis").hide();
$("#test_vis").hide();
$("#type").change(function(){
var types=$(this).val();

if(types=='ponctuel' || types=='prive' )
{
  $("#res_bordero").html('Offre de Type Ponctuel');
   var data='ponct='+$("#type").val();	
  	$.ajax({
				type:'GET',
				url:'rechercheajaxMDOPonctuel.php',
				data: data,
				
				success:function(code_html){
				      $("#res_bordero").html(code_html);
				}
		
	});	
 var d = new Date();
 //var m=d.getMonth()
var strDate = d.getDate() + "/" + (d.getMonth()) + "/" + d.getFullYear(); 
var an=d.getFullYear();var m=Number(d.getMonth())+1;var j=d.getDate();
var strDateOffre = j +"/"+ "0"+m +"/" +an;      
 // alert(strDateOffre);		
$("#date_offre").html("Date de l'offre");	
$("#date_decharg").val("15/03/2012");
$("#date_limites").html('');
$("#date_limit input").attr('disabled',true);
//alert(strDate);
$("#date_decharg").val(strDate);
$("#test_visavis").show();
$("#test_vis").show();
	
	
}
else
{
 $("#test_visavis").hide();
    $("#test_vis").hide();

}

});


	//"Surveillance du champ "Recherche" avec la méthode jQuery "keyup"
	$("#mdobordero").change(function(){
	
	if(($("#type").val())!='ponctuel')
	{
		
	
	
	
	   var data='mdo='+$("#mdobordero").val()+'&type='+$("#type").val();	
	 
	 $.ajax({
				type:'GET',
				url:'rechercheajaxbordero.php',
				data: data,
				
				success:function(code_html){
				      $("#res_bordero").html(code_html);
				}
		
	});	
	}
	});	
	
});