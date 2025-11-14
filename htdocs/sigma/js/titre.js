$(function(){
 $("#titre").blur(function(){
 
 var res=$("#titre").val().split(" ");
 var ln= res.length;
 var intit=" ";
 for(i=0;i<ln;i++)
 {
 intit=res[0]+" "+res[ln-2]+" "+res[ln-1];
 
  
 }
$("#intitule").val(intit);
 });


});