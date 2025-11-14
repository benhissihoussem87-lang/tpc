$(function(){
$("#autres").hide();
 $("#lot").change(function(){
   var lt=$("#lot").val();
   if(lt=='Autre')
   {
     $("#autres").show();
	  $("#autres").focus();
   }
   else {
   
   $("#autres").hide();}
 });


});