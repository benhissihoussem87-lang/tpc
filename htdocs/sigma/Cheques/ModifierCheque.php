<?php

$details=$ch->detailcheques($_GET['id_modifier']);
foreach($details as $det);
if(isset($_POST['ok']))
{
 if($ch->Modifiercheques($_GET['id_modifier']))
 {
 
 //echo "<script>alert('Partenaire Modifier')</script>";
 
echo "<script>document.location.href='sigma.php?AfficherCH'</script>";

 }
 else
 {
 echo 'Erreur Ajout';
  
 }
}

?>
<form method="post">
<div class="container" style="position:relative; top:-20px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Modifier Cheque
		<input type="submit" style="width:250px; margin:auto;position:relative; top:-20px" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		
		</div>
        <div class="card-body">
          
            <table width=100% cellpadding=4  >
			<tr>
<td width=40%><label for="num">Num</label>
                  
				    
                    <input type="text" readonly value="<?php echo $det['num']; ?>" id="numCH" style="padding:6px 0 6px 4px" name="num" class="form-control" >
					 
					
					</td>
<td width=40%>
<label for="ordre">Ordre de </label>
                  <div class="form-label-group">
				    
                    <input type="text" value="<?php echo $det['ordre_de']; ?>" name="ordre_de" style="padding:6px 0 6px 4px"id="ordre"  class="form-control"/>
					</td>
</tr>
<tr>
<td width=40%><label for="date_sortie">Date sortie</label>
                  
				    
                    <input type="date" value="<?php echo $det['date_sortie']; ?>" id="date_sortieCH" style="padding:6px 0 6px 4px" name="date_sortie" class="form-control" >
					
					</td>
					<td width=40%><label for="montant">Montant</label>
                  <div class="form-label-group">
				    
                    <input type="text" value="<?php echo $det['montant']; ?>" id="montantCH" style="padding:6px 0 6px 4px" name="montant" class="form-control" ></td>

</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="echeance">Date echeance</label>
                  
				    
                    <input type="date" value="<?php echo $det['date_echeance']; ?>" id="echeanceCH" style="padding:6px 0 6px 4px" name="date_echeance" class="form-control" ></td>
					
					<td width=40%><label for="eta">Etat</label>
                  
				    
                    <select id="etat" style="padding:6px 0 6px 4px" name="etat" class="form-control" >
					<option <?php if($det['etat']=='PAYE'){?> selected <?php } ?>>PAYE</option>
					<option <?php if($det['etat']=='EN COURS'){?> selected <?php } ?>>EN COURS</option>
					<option <?php if($det['etat']=='ANNULE'){?> selected <?php } ?>>ANNULE</option>
					</select>
					</td>
</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="date_payement">Date payement</label>
                  <div class="form-label-group">
				    
                    <input type="date" value="<?php echo $det['date_payement']; ?>" id="date_payementCH" style="padding:6px 0 6px 4px" name="date_payement" class="form-control"></td>
					<td width=40%><label for="soldes">Soldes</label>
                  
				    
                    <input type="text" value="<?php echo $det['soldes']; ?>" id="soldes" style="padding:6px 0 6px 4px" name="soldes" class="form-control" ></td>

</tr>
<!----------------------->
<tr> <?php if($_SESSION['user']=='Admin')
					{ if($det['typeuser']=='utilisateur'){
						?>
				   <td width=50 align=center>
				  <label for="bordero" ><b>USER</b></label>
					
						</td>
					  <td>
					 <table width=90%>
					 <!--<tr>
					 <th >
						Utilisateur</th><td><input type="radio" chehed style="width:120px" name="user" value="utilisateur" ></td></tr>
						 --><tr>
					 <th>
						Admin</th><td><input type="radio" name="user" style="width:120px" value="null" ></td></tr>
						</table>
				  </td>
				  <?php } } ?></tr>
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
            
			
			
         
          
        </div>
      </div>
    </div>
	</form>