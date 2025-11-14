$(function(){

$("#consultation_bordero").click(function(){
    var type=$(this).val();
	$("#expertise").show();
	$("#consultation").show();
 
 });
 
 $("#expertise_bordero").click(function(){
    var type=$(this).val();
	$("#expertise").show();
	$("#consultation").hide();
 
 });


});