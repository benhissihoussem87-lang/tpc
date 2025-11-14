$(function(){

   $('#clientMdo').keyup(function(){
       var client=$(this).val();
	  // alert(client);
	  $("#designnationMDO").html(client);
      
   });

});