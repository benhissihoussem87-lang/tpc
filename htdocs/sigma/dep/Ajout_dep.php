<?php
$nbsponct=$ponct->getponctuel();
$dernier_ponct=$ponct->getponctuel();
/***Pour afficher num****/
$nb_ponct=count($dernier_ponct);
$depDernier=$dep->getdep();

if(count($depDernier)>0)
{
foreach($depDernier as $cledep);
}

/*******Fin Affichage Num********/
$designation_partenaire=$partenaires->getPartenairesMDO();

//Ajout Appel Offre
if(isset($_POST['ok']))
{
	
/***Traitement Journal Caisse****/

 //Traitement de Alimentation
				   if($_POST['RAISON']=='Alimentation Caisse' )
				   {
					  $alimentation=$_POST['montant'];
					  $caisse=0;
					}
				   
 //Traitement de caisse
				else {
				  if(empty($_POST['num_CHQ']))
				   {
					   
					   $caisse=$_POST['montant'];
					   $alimentation=0;
					   
					  
				   }
				    else{
					   $alimentation=0;
					   $caisse=0;
					   }
				   }

 $journal_caisseT=$alimentation-$caisse;
 @$journalCaisse=($cledep['journal_caisse']+$journal_caisseT);
 //echo '<h1> Journal '.$journalCaisse.'</h1>';
  //echo '<h1> Caisie '.$caisse.'</h1>';
 //echo '<h1> Alimentation '.$alimentation.'</h1>';

/******Fin traitement********/
if($dep->ajout_dep($journalCaisse))
 {
	 /********/
$sommePermanent=0;
//$deps=$dep->getdepsSommePermanent($_POST['DATE']);
foreach($deps as $cle)
				  {
					  $sommePermanent+=$cle['sommeP'];
				  }

//echo '<h1>'.$sommePermanent.'</h1>';


/**********/
 echo '<h1>OKKKKKK</h1>';
echo "<script>document.location.href='sigma.php?AfficherDep'</script>";
 //header("location:sigma.php?AO_Ajout");
 }
 else
 {
 echo 'Erreur Ajout';
  
 }
 
 
}

//Fin Ajout


?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Ajouter Dep
		  <input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Ajouter" name="ok" class="btn btn-primary btn-block"/>
		  </div>
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=100% >
		  <tr>
            <!---------*********************-->
			<td width=70% >
	   <table width=100%   cellpadding=4   >
	<tr >
	<td width=30% align=center><label for="date">Date</label>	</td>
	<td>
	<input type="date" value="<?php echo date('Y-m-d')?>" style="padding:6px 0 6px 4px" name="DATE" class="form-control" >
	</td>
	</tr>
	<tr>
    <td width=30% align=center><label for="RESTE_TS_SAL_FRAIS">MONTANT</label>	</td>
	<td>
	<input type="text" style="padding:6px 0 6px 4px" name="montant" class="form-control" >
	</td>
	</tr>
	<tr>
    <td width=30% align=center><label for="RAISON">RAISON</label>	</td>
	<td>
	<select style="padding:6px 0 6px 4px" name="RAISON" class="form-control" >
	<option>Alimentation Caisse</option>
	<option>Salaire</option>
	<option>Frais</option>
	
	</select>
	</td>
	</tr>	
	
	<tr>
    <td width=30% align=center><label for="BENEFICIARE">BENEFICIARE</label>	</td>
	<td>
	<input type="text" style="padding:6px 0 6px 4px" name="BENEFICIARE" class="form-control" >
	</td>
	</tr>
   <!--<tr>
    <td width=30% align=center><label for="ETAT_DE_CAISSE">ETAT DE CAISSE</label>	</td>
	<td>
	<input type="text" style="padding:6px 0 6px 4px" name="ETAT_DE_CAISSE" class="form-control" >
	</td>
	</tr>
	<tr>
    <td width=30% align=center><label for="CHEQUES">CHEQUES</label>	</td>
	<td>
	<input type="text" style="padding:6px 0 6px 4px" name="CHEQUES" class="form-control" >
	</td>
	</tr>
		-->
	</table>
</td>

			  <!--**********************************************-->
			  </tr>
			  </table>
			  </div>
          
			
			
         
          
        </div>
      </div>
    </div> 
	</form>