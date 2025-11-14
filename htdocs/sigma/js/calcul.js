$(function(){
$("#honoetude").change(function(){
  var hn=$("#hono").val();
  var hnet=$("#honoetude").val();
  var reshn=hn-hnet;
  $("#honovisite").val(reshn);
   
});


/////////////
$("#hono").blur(function(){
 var hono=$("#hono").val();
 var cout=$("#cout").val();
 var prc=(hono/cout)/10;
 var res=prc.toFixed(2);
 if((res<0.1)||(res > 10))
 {
 $("#pourcentage").val('le pourcentage doit etre entre 0.1 et 10');
 $("#pourcentage").css({'border':'red 4px solid','color':'orange'});
 }
 else
 {
 $("#pourcentage").val(res);
  $("#pourcentage").css({'border':'none','color':'black'});
 }
 
});
//Offre des prix
$("#codeAO").click(function(){
if(!confirm('voulez-vous modifier'))
{
$(this).attr('readonly',true);
 
 }
 else
 {
  $(this).attr('readonly',false);
 }
});
//Pour cheque
$("#numCH").click(function(){
if(!confirm('voulez-vous modifier'))
{
$(this).attr('readonly',true);
 
 }
 else
 {
  $(this).attr('readonly',false);
 }
});

$("#date_sortieCH").change(function(){

var date=$(this).val();
 $("#echeanceCH").val(date);
 $("#date_payementCH").val(date);
});


///////////////////
$("#codeprojet").click(function(){
if(!confirm('voulez-vous modifier'))
{
$(this).attr('readonly',true);
 
 }
 else
 {
  $(this).attr('readonly',false);
 }
});
//Pour code Ponctuel

$("#codePonctuel").click(function(){
if(!confirm('voulez-vous modifier'))
{
$(this).attr('readonly',true);
 
 }
 else
 {
  $(this).attr('readonly',false);
 }
});

$("#codePonctuel").change(function(){

$(this).attr('readonly',true);
 
 
});
//Pour Num Ponctuel

$("#numPonctuel").click(function(){
if(!confirm('voulez-vous modifier'))
{
$(this).attr('readonly',true);
 
 }
 else
 {
  $(this).attr('readonly',false);
 }
});

$("#numPonctuel").change(function(){

$(this).attr('readonly',true);
 
 
});
});
