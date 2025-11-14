$(function(){

var total= $("#tot").val();
var totals= $("#total").val();
var articles= $("#articles").val();
var prixs= $("#prixs").val();
var qte=0;
var articles= $("#articles").val();
 $("#factureCreation input[type='checkbox']").click(function(){
     var vl=$(this).val();
	 
	  if(vl==1)
	  {
	 
   var qte=$("#factureCreation input[name='qte1']").val();
    var article=$("#factureCreation textarea[name='article1']").val();
	var prix=$("#factureCreation input[name='prix1']").val();
	  var mantant=qte*prix;
	 
	 
   }
   if(vl==2)
	  {
   var qte=$("#factureCreation input[name='qte2']").val();
    var article=$("#factureCreation textarea[name='article2']").val();
	var prix=$("#factureCreation input[name='prix2']").val();
	 var mantant=qte*prix;
   }
   if(vl==3)
	  {
   var qte=$("#factureCreation input[name='qte3']").val();
    var article=$("#factureCreation textarea[name='article3']").val();
	var prix=$("#factureCreation input[name='prix3']").val();
	var mantant=qte*prix;
   }
   if(vl==4)
	  {
   var qte=$("#factureCreation input[name='qte4']").val();
    var article=$("#factureCreation textarea[name='article4']").val();
	var prix=$("#factureCreation input[name='prix4']").val();
	var mantant=qte*prix;
   }
    if(vl==5)
	  {
   var qte=$("#factureCreation input[name='qte5']").val();
    var article=$("#factureCreation textarea[name='article5']").val();
	var prix=$("#factureCreation input[name='prix5']").val();
	var mantant=qte*prix;
   }
   
   if(vl==6)
	  {
   var qte=$("#factureCreation input[name='qte6']").val();
    var article=$("#factureCreation textarea[name='article6']").val();
	var prix=$("#factureCreation input[name='prix6']").val();
	var mantant=qte*prix;
   }
    if(vl==7)
	  {
   var qte=$("#factureCreation input[name='qte7']").val();
    var article=$("#factureCreation textarea[name='article7']").val();
	var prix=$("#factureCreation input[name='prix7']").val();
	var mantant=qte*prix;
   }
   
    if(vl==8)
	  {
   var qte=$("#factureCreation input[name='qte8']").val();
    var article=$("#factureCreation textarea[name='article8']").val();
	var prix=$("#factureCreation input[name='prix8']").val();
	var mantant=qte*prix;
   }
   
    if(vl==9)
	  {
   var qte=$("#factureCreation input[name='qte9']").val();
    var article=$("#factureCreation textarea[name='article9']").val();
	var prix=$("#factureCreation input[name='prix9']").val();
	var mantant=qte*prix;
   }
   
    if(vl==10)
	  {
   var qte=$("#factureCreation input[name='qte10']").val();
    var article=$("#factureCreation textarea[name='article10']").val();
	var prix=$("#factureCreation input[name='prix10']").val();
	var mantant=qte*prix;
   }
   
    if(vl==11)
	  {
   var qte=$("#factureCreation input[name='qte11']").val();
    var article=$("#factureCreation textarea[name='article11']").val();
	var prix=$("#factureCreation input[name='prix11']").val();
	var mantant=qte*prix;
   }
   
    if(vl==12)
	  {
   var qte=$("#factureCreation input[name='qte12']").val();
    var article=$("#factureCreation textarea[name='article12']").val();
	var prix=$("#factureCreation input[name='prix12']").val();
	var mantant=qte*prix;
   }
   
    if(vl==13)
	  {
   var qte=$("#factureCreation input[name='qte13']").val();
    var article=$("#factureCreation textarea[name='article13']").val();
	var prix=$("#factureCreation input[name='prix13']").val();
	var mantant=qte*prix;
   }
   
    if(vl==14)
	  {
   var qte=$("#factureCreation input[name='qte14']").val();
    var article=$("#factureCreation textarea[name='article14']").val();
	var prix=$("#factureCreation input[name='prix14']").val();
	var mantant=qte*prix;
   }
   
    if(vl==15)
	  {
   var qte=$("#factureCreation input[name='qte15']").val();
    var article=$("#factureCreation textarea[name='article15']").val();
	var prix=$("#factureCreation input[name='prix15']").val();
	var mantant=qte*prix;
   }
   
    if(vl==16)
	  {
   var qte=$("#factureCreation input[name='qte16']").val();
    var article=$("#factureCreation textarea[name='article16']").val();
	var prix=$("#factureCreation input[name='prix16']").val();
	var mantant=qte*prix;
   }
   
    if(vl==17)
	  {
   var qte=$("#factureCreation input[name='qte17']").val();
    var article=$("#factureCreation textarea[name='article17']").val();
	var prix=$("#factureCreation input[name='prix17']").val();
	var mantant=qte*prix;
   }
   
    if(vl==18)
	  {
   var qte=$("#factureCreation input[name='qte18']").val();
    var article=$("#factureCreation textarea[name='article18']").val();
	var prix=$("#factureCreation input[name='prix18']").val();
	var mantant=qte*prix;
   }
   
    if(vl==19)
	  {
   var qte=$("#factureCreation input[name='qte19']").val();
    var article=$("#factureCreation textarea[name='article19']").val();
	var prix=$("#factureCreation input[name='prix19']").val();
	var mantant=qte*prix;
   }
   
    if(vl==20)
	  {
   var qte=$("#factureCreation input[name='qte20']").val();
    var article=$("#factureCreation textarea[name='article20']").val();
	var prix=$("#factureCreation input[name='prix20']").val();
	var mantant=qte*prix;
   }
   
   total=total+qte+'<br />';
   articles=articles+article+'<br />';
   prixs=prixs+prix+'<br />';
   totals= Number(totals)+Number(mantant);
   $("#total").val(totals); 
$("#tot").val(total); 
 $("#articles").val(articles); 
$("#prixs").val(prixs);  
 });
 
  
});