$(function(){
//$("#FactureRecouvrement #facture").val('non');
$("#FactureRecouvrement input[type=radio]").click(function(){
$("#FactureRecouvrement").show();
$("#AutreFactureRecouvrementS").hide();
 var btn=$(this).val();
 if(btn=='oui')
 {
var codeFact=$("#FactureRecouvrement #codeFact").val();

 $("#FactureRecouvrement #facture").val(codeFact);
 }
 else if(btn=='non')
 {


 $("#FactureRecouvrement #facture").val("non");
 }
});
//$("#FactureRecouvrement #facture").val('non');
$("#AutreFactureRecouvrementS input[type=radio]").click(function(){
$("#FactureRecouvrement").hide();
$("#AutreFactureRecouvrementS").show();
 var btnA=$(this).val();

 if(btnA=='ouiAutre')
 {
var codeAutreFact=$("#AutreFactureRecouvrementS #codeAutreFact").val();

 $("#AutreFactureRecouvrementS #Autrefacture").val(codeAutreFact);
 }
 else if(btnA=='non')
 {


 $("#AutreFactureRecouvrementS #Autrefacture").val("non");
 }
});

});