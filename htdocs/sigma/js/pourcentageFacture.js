$(function(){

 $("#pourcentage").keyup(function(){
   var p=$(this).val();
   var montant=$("#prixsPourcentage").val();
   var res=Number(montant*p)/100;
   $("#montant").val(res);
 });


});