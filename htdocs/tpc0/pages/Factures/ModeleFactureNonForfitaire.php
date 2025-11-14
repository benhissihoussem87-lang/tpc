<div class="container" style="width:100%">
    <div class="row">
        
    		<div class="invoice-title col-3" style="position:absolute;top:-25px;left:0px">
    			<h2><img src="../../assets/images/logo.png" height=100/></h2>
    		</div>
			
    	<h3 class="col-3" style="text-align:center;text-transform:uppercase;position:relative;top:170px;font-size:20px;font-weight:bold">
		Facture <?=$infosFacture['num_fact']?> </h3>

    			<div class="col-3" style="float:right">
    				<address>
        			  <ol >
					    <li>Date :  <b><?=$date?></b></li>
    					<li>Client : <b><?=$infosFacture['nom_client']?> </b></li>
    					<li>Adresse : <b><?=$infosFacture['adresse']?></b></li>
    					<li>Matricule Fiscale :<b><?=$infosFacture['matriculeFiscale']?></b></li>
						<li>Exonoration N° :<b><input type="text" value="<?=$infosFacture['numexonoration']?>" style="border:none"/></b></li>
						<li>Bon de commande N° :  <b>
						<?php if($infosFacture['numboncommande']!=null){ echo @$bonCommandeFacture['num_bon_commandeClient'];}else{?>
						 <input type="text" style="border:none" value='<?=@$bonCommandeFacture['num_bon_commandeClient']?>'>
						<?php }?>
						</b></li>
					  <ol>
    				</address>
    			</div>
    </div>
    
    <div class="row">
    	<div class="col-md-11">	
    			<div class="panel-body" style="position:relative;top:50px" >
    				<div class="table-responsivef"  >
					
						<table class="table table-bordere" border=1   >
						<thead>
						<tr style="background:#f5f5f5;text-transform:uppercase">
							<th style="width:70%;text-align:center;font-size:15px;">Description<br><input type="text" style="width:100%;border:none;text-align:center;font-size:15px;font-weight:normal" value="Mission d'inspection"></th>
							<th style="width:10%;text-align:center;font-size:15px;">qte</th>
							<th style="width:10%;text-align:center;font-size:15px;">p.u.h.t</th>
							<th style="width:10%;text-align:center;font-size:15px;">p.t.h.t</th>
						</tr>
						</thead>
						<tbody >
						<?php
							$totalHT=0;
						//si pas d'adresse 
						if($nbAdresse==0){
						if(!empty($ProjetsFacture)){
							
							foreach($ProjetsFacture as $projet){
							
								$PTHT=($projet['qte']*$projet['prix_unit_htv']);
								$totalHT+=$PTHT;
							$project=explode(' ',$projet['classement']);
								?>
							<tr>
								<td style="font-size:12px;font-family:Arial;padding-left:5px">
								 <?php if(count($project)>6){?>
								<p><?=@$project[0].' '.@$project[1].' '.@$project[2].' '.@$project[3].' '.@$project[4].' '.@$project[5].' '.@$project[6]?><br>
								<?=@$project[7].' '.@$project[8].' '.@$project[9].' '.@$project[10].' '.@$project[11]?>
								
								</p>
								
								 <?php } else {?>
								 
								 <?=$projet['classement']?>
								 <?php } ?>
								</td>
								
								
								<td align="center" style="font-size:12px;font-family:Arial;"><?=$projet['qte']?></td>
								<td align="center"  style="font-size:12px;font-family:Arial;"><?=$projet['prix_unit_htv']?></td>
								<td align="right"  style="font-size:12px;font-family:Arial;"><?=round($PTHT,3)?></td>
							</tr>
						<?php }} ?>
						<?php } else {
								for($a=0;$a<$nbAdresse;$a++){?>
								<tr>
								<!-- Colonne 1 Nom Projet-->
								<td>
								   <table width=100%>
								   <tr>
								    <td>
									  <table width=100%  border=1>
									<u style="text-transform:uppercase"><?=$adressesClient[$a][0]?></u>
									<br>
									<?php
							$nbProjet=count($ProjetsFacture);
							//echo '<h1> Nb Projects '.$nbProjet.'</h1>';
							if($nbProjet<6){$height='50px';} else {$height='30px';}
							//echo '<h1> Height : '.$height.'</h1>';
						if(!empty($ProjetsFacture)){foreach($ProjetsFacture as $projet){
							if($projet['adresseClient']==$adressesClient[$a][0]){
								$project=explode(' ',$projet['classement']);
								//echo '<h1> Nb Projects : '.count($project).'</h1>';
									?>
									 <tr>
									   <td height=<?=$height?> style="font-size:12px;font-family:Arial;padding-left:5px">
									   <?php if(count($project)>6){?>
									   <input type="text" style="width:100%; border:0;text-transform:uppercase;font-size:12px" value="<?=@$project[0].' '.@$project[1].' '.@$project[2].' '.@$project[3].' '.@$project[4].' '.@$project[5].' '.@$project[6]?>">
									   <span style="width:100%; border:0;text-transform:uppercase;font-size:12px"><?=@$project[7].' '.@$project[8].' '.@$project[9].' '.@$project[10].' '.@$project[11]?></span>
									  
									   <?php } else { ?>
									  <input type="text" style="width:100%; border:0;text-transform:uppercase;font-size:12px" value="<?=$projet['classement']?>">
									 
									  
									   <?php } if($nbProjet<6){?>
								<!------********** -------->
                                        <input  type="text" style="width:100%; border:0;text-transform:uppercase;font-size:12px">
										 
									   <?php } ?>	
										 
									   </td>
									  </tr>	
						<?php }}} ?>
									</table>
									</td>
								   </tr>
								  </table>
								</td>
								<!-- Colonne 2 : QTE-->
								<td>
								   <table width=100% >
								   <tr>
								    <td>
									  <table width=100%  align=center border=1>
									<br>
									<?php
						if(!empty($ProjetsFacture)){foreach($ProjetsFacture as $projet){
							if($projet['adresseClient']==$adressesClient[$a][0]){
									?>
									 <tr>
									   <td height=<?=$height?>  style="font-size:12px;font-family:Arial;" align=center> <?=$projet['qte']?></td>
									  </tr>	
						<?php }}} ?>
									</table>
									</td>
								   </tr>
								  </table>
								</td>
							    
								<!-- Colonne 3 P.U.H.T-->
								<td>
								   <table width=100%>
								   <tr>
								    <td>
									  <table width=100%  align=center border=1>
									<br>
									<?php
						if(!empty($ProjetsFacture)){foreach($ProjetsFacture as $projet){
							if($projet['adresseClient']==$adressesClient[$a][0]){
									?>
									 <tr >
									   <td height=<?=$height?>  style="font-size:12px;font-family:Arial;" align=center><?=$projet['prix_unit_htv']?></td>
									  </tr>	
						<?php }}} ?>
									</table>
									</td>
								   </tr>
								  </table>
								</td>
							
							   <!-- Colonne 4 P.T.H.T-->
								<td>
								   <table width=100% >
								   <tr>
								    <td>
									  <table width=100% border=1 >
									<br>
									<?php
						if(!empty($ProjetsFacture)){foreach($ProjetsFacture as $projet){
							if($projet['adresseClient']==$adressesClient[$a][0]){
								$PTHT=($projet['qte']*$projet['prix_unit_htv']);
								$totalHT+=$PTHT;
									?>
									 <tr>
									   <td height=<?=$height?> align=right  style="font-size:12px;font-family:Arial;">
									   
									   <?=number_format(($projet['prix_unit_htv']*$projet['qte']),3)?></td>
									  </tr>	
						<?php }}} ?>
									</table>
									</td>
								   </tr>
								  </table>
								</td>
							
							</tr>
							

								<?php } } ?>							
						</tbody>
				 

		</table>
							
	      <!-- Pied -->
		   <div  style="width:50%;float:right;display:flex;position:relative;top:-20px;padding-top:5px" >
               <div style="width:60%;margin-right:5px">
			     <ul>
				   <li  style="font-size:12px;font-family:Arial;font-weight:italic">Total H.T</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic">taux de t.v.a</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic">t.v.a</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic">t.t.c</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic">droit de timbre</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic">total note d'honoraires</li>
				 </ul>
			   </div>
				<div style="width:40%;border:solid 1px black;padding-right:5px">
				    <ul>
				   <li style="font-size:12px;font-family:Arial">
				   <?=number_format($totalHT,3)?></li>
				   <li style="font-size:12px;font-family:Arial">
				   <?php if($infosFacture['exonoration']=='oui'){echo '0%';}
				   else {echo '19%';}?>
				   
				   </li>
				   <li style="font-size:12px;font-family:Arial">
				     <?php if($infosFacture['exonoration']=='oui'){echo '0';}
					 else {?>
				   <?=number_format(($totalHT*0.19),3)?>
					 <?php } ?>
				   </li>
				   <li style="font-size:12px;font-family:Arial">
				   <?php
				     if($infosFacture['exonoration']=='oui'){ $ttc=$totalHT;}
				    else  {$ttc=($totalHT*0.19)+$totalHT;}
					echo number_format($ttc,3);
				   ?>
				   
				   </li>
				   <li style="font-size:12px;font-family:Arial"><input type="text" value="1.000" style="text-align:right;border:0;width:50%"/></li>
				   <li style="font-size:12px;font-family:Arial">
						<?php $honoraire=$ttc+1.000;
						 $chiffres=explode('.', $honoraire);
						
						 if(!isset($chiffres[1])){$honoraire=$honoraire.'.000';}
						 else {
							  $rest=strlen($chiffres[1]);
							  $res=$chiffres[1]*100;
							 // echo  '<p>'.$res.'</p>';
							  if($rest<3){
								  $honoraire=$chiffres[0].'.'.$res;
							  }
							  else{
							 $honoraire=$honoraire;
							  }
							 }?>
							 <input type="text" value="<?=$honoraire?>" style="text-align:right;border:0;width:50%"/>
							
							</li>
				 </ul>
				 </div>			   
			  
		   </div>
		  <!-- Fin Pied -->
    				</div>
    			</div>
	
	<?php 
	$padding=0;
	 if($nbProjet==1){$padding='170px';}
	 else if($nbProjet==2){$padding='150px';}
	else if($nbProjet==3){$padding='120px';}
	else if($nbProjet==4){$padding='100px';}
	else if($nbProjet==5){$padding='70px';}
	else if($nbProjet>5){$padding='70px';}
	
	
	?>
	<p class="col-12" style="text-align:left;font-size:15px;padding-top:<?=$padding?>">
	Arrêtée la présente facture à la somme de : 
	<span style="text-transform:uppercase">
	<input style="text-transform:uppercase;width:100%; border:none" type="text" value="<?= asLetters($honoraire);?>"></span>
	</p>
    <div class="col-12 flex-container" style="display:flex;position:relative;top:20px">
	  <!-- Left Bloc TPC-Direction -->
	  <div style="width:62.5%;margin-right:2%;font-size:10px;padding-top:0px">
	    <p>
		Veuillez rédiger tous les chèques a l'ordre de <b>TUNISIA POLYCONTROLS</b>.<br>
		Pour toute question concernant cette facture, veuillez nous contacter<br>
		par e-mail: <b>tunisia.polycontrols.tpc@gmail.com</b>.
		</p>
		<p>Veuillez rédiger les virements au nom de <b>T.P.C</b><br>
		  sur le <b>RIB N°  <input type="text" value="14 009 009 1017 00818 0 10" style="border:none"/></b>
		</p>
		<p><b>MERCI DE VOTRE CONFIANCE</b></p>
		<p style="width:40%;text-align:center;font-size:12px"><b>LA DIRECTION<br>TPC</b></p>
		
	  </div>
	  <!-- Fin Bloc TPC-Direction -->
	  <!-- Right Bloc TPC-Direction -->
	  <div style="width:35%;float:right;padding-top:0px;font-size:10px">
	     <p>
		<b>TPC : TUNISIA POLYCONTROLS</b>.<br>
		S.A.R.L au capital de 20.000 DT -Code TVA: <br>
		1426729 H/A/M/000-R.C: B 2621285205
		par e-mail: <b>tunisia.polycontrols.tpc@gmail.com</b>.
		</p>
		<b>Siège Social : </b>
		5 rue Benghazi-bureau 4-5, 4<sup>ème</sup> étage -1002 Tunis <br>
		<b>Tél :36 131 731</b>
		<b>GSM :24 131 544</b>
		</p>
	  </div>
	  <!-- Fin RIGHT Bloc TPC-Direction -->
	</div>	
    	</div>
    </div>
	
</div>