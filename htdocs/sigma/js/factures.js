$(function(){

$("#numAutreFacture").hide();
$("input[type='radio']").click(function(){
     var btn=$(this).val();
	if(btn=='facture')
	{
		$("#numAutreFacture").hide();
		$("#numFacture").show();
		
	}
	else if(btn=='Autrefacture')
	{
		$("#numAutreFacture").show();
		$("#numFacture").hide();
		
	}
});


})