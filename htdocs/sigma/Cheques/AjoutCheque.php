<?php
$banque=null;
if(isset($_GET['STB'])){$banque='STB';}
else if(isset($_GET['BARAKA'])){$banque='BARAKA';}
$numCH=$ch->getNumCH($banque);
foreach($numCH as $cle);


if(count($numCH)>0)
{
if($cle['autre']=='BARAKA')
{
	$numreCH=$cle['num']+1;
}else {
 $numreCH=$cle['num']+1;
 
 $nb=substr($cle['num'],-3);
 //echo '<h1>'.$nb.'</h1>';
 if($nb>=99)
 {
  $numreCH='0000'.($nb+1);
 }
 else{
 $res=(substr($cle['num'],-2))+1;
//echo '<h1>'.$res.'</h1>';
 $numreCH='00000'.$res;
 }
}
}
else{
$numreCH="0000081";
}
if(isset($_POST['ok']))
{
 if($ch->ajoutcheques())
 {
 
 //echo "<script>alert('Partenaire ajouté')</script>";
 
echo "<script>document.location.href='sigma.php?AfficherCHSTB'</script>";

 }
 else
 {
 echo 'Erreur Ajout';
  
 }
}

?>
<form method="post">
        
        <div class="card-header">Ajouter Cheque
		<div class="container" style="position:relative; top:-20px">
      <div class="card card-register mx-auto mt-5">
	   
		<input type="submit" style="width:250px; margin:auto;position:relative; top:-20px" value="Ajouter <?php echo $banque?>" name="ok" class="btn btn-primary btn-block"/>
		
		</div>
        <div class="card-body">
          
            <table width=100% cellpadding=4  >
			<tr>
<td width=40%><label for="num">Num</label>
                  
				    
                    <input type="text" readonly value="<?php echo $numreCH; ?>" id="numCH" style="padding:6px 0 6px 4px" name="num" class="form-control" >
					 
					
					</td>
<td width=40%>
<label for="ordre">Ordre de </label>
                  <div class="form-label-group">
				    
                    <input type="text" name="ordre_de" style="padding:6px 0 6px 4px"id="ordre"  class="form-control"/>
					</td>
</tr>
<tr>
<td width=40%><label for="date_sortie">Date sortie</label>
                  
				    
                    <input type="date" id="date_sortieCH" style="padding:6px 0 6px 4px" name="date_sortie" class="form-control" >
					
					</td>
					<td width=40%><label for="montant">Montant</label>
                  <div class="form-label-group">
				    
                    <input type="text" id="montantCH" style="padding:6px 0 6px 4px" name="montant" class="form-control" ></td>

</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="echeance">Date echeance</label>
                  
				    
                    <input type="date" id="echeanceCH" style="padding:6px 0 6px 4px" name="date_echeance" class="form-control" ></td>
					
					<td width=40%><label for="eta">Etat</label>
                  
				    
                    <select id="etat" style="padding:6px 0 6px 4px" name="etat" class="form-control" >
					<option>PAYE</option>
					<option>EN COURS</option>
					<option>ANNULE</option>
					</select>
					</td>
</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="date_payement">Date payement</label>
                  <div class="form-label-group">
				    
                    <input type="date" id="date_payementCH" style="padding:6px 0 6px 4px" name="date_payement" class="form-control"></td>
					<td width=40%><label for="soldes">Soldes</label>
                  
				    
                    <input type="text" id="soldes" style="padding:6px 0 6px 4px" name="soldes" class="form-control" ></td>

</tr>
<!----------------------->

<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
            
			
			
         
          
        </div>
      </div>
    </div>
	</form>