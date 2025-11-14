$(function(){

   $("#date_limit input").change(function(){
   var dl=$(this).val();
   
      $("#date_decharg").val(dl);
	
	   
   
   });

//Traitement  de SP Project
 $("#codep").change(function(){
   var code_sp=$(this).val();
   var sp=code_sp+'/';
     $("#code_sp").val(sp);
	   
   
   });
});