<div class="container" style="width:100%">
    <div class="row">
        
    		<div class="invoice-title col-3" style="position:absolute;top:-25px;left:0px">
    			<h2><img src="../../assets/images/logo.png" height=100/></h2>
    		</div>
			
    	<h3 class="col-3" style="text-align:center;text-transform:uppercase;position:relative;top:150px;font-size:15px">
		Offre <?=@$infosOffre['num_offre']?> </h3>
    		
    			
    			<div class="col-3" style="float:right">
    				<address>
        			  <ol >
					    <li>Date :  <b><?=@$date?></b></li>
    					<li>Client : <b><?=@$infosOffre['nom_client']?></b></li>
    					<li>Adresse : <b><?=@$infosOffre['adresse']?></b></li>
    					
						
					  <ol>
    				</address>
    			</div>
    		
    	<div class="row">
				<div class="col-md-11">
				<div class="panel-body col-12" style="position:relative;top:-50px" >
				<p class="col-12" style="text-align:left;font-size:15px;padding-top:230px">
	Faisons suite de votre demande, nous avons l’honneur de vous communiquer notre meilleure offre de prix détaillée comme suit :
	
	</p>
				<!-- Détail -->
				   <div class="panel-body" style="position:relative;top:50px" >
    				<div class="table-responsive" >
					
						<table class="table table-bordered"  border=1 height=150 width=100% >
						<thead>
						<tr style="background:#f5f5f5;text-transform:uppercase">
						  
							<th style="width:60%;text-align:center">Description</th>
							<th style="width:10%;text-align:center">qte</th>
							<th style="width:10%;text-align:center">p.u.h.t</th>
							<th style="width:10%;text-align:center">p.t.h.t</th>
						</tr>
						</thead>
						<tbody>
						<?php
						//echo '<p> Offre '.$verifForfitaireOffre.'</p>';
							$totalHT=0;
							$i=0;
						//echo '<h1> Il ya adresse '.$nbAdresse.'</h1>';
				//si pas d'adresse 
				if($nbAdresse==0){
						//echo '<h1> Nb Projets '.count($ProjetsOffre).'</h1>';
						if(!empty($ProjetsOffre)){
							
							foreach($ProjetsOffre as $projet){
							
							$i+=1;
					// si l'offre est un offre non Forfitaire
					if($verifForfitaireOffre=='Nonforfitaire'){
							
							
								$PTHT=($projet['qte']*$projet['prix_unit_htv']);
								$totalHT+=$PTHT;
					
								
								//echo '<h1> PTHT '.$PTHT.' Total : '.$totalHT.'</h1>';
							}

                    // si l'offre est un offre non Forfitaire
					if($verifForfitaireOffre=='forfitaire'){
							
							if($projet['prixForfitaire']!=''){
								$PTHT=$projet['prixForfitaire'];
								$totalHT+=$PTHT;
								}
								
								//echo '<h1> PTHT '.$PTHT.' Total : '.$totalHT.'</h1>';
							}

                 $project=explode(' ',$projet['classement']);
							?>
							<tr >
							
								<td style="font-size:15px;font-family:Arial;padding-left:5px;text-align:center">
								
								  <?php if(count($project)>6){?>
								<p style="width:50%">
								<?=@$project[0].' '.@$project[1].' '.@$project[2].' '.@$project[3].' '.@$project[4].' '.@$project[5].' '.@$project[6].' '.@$project[7]?>
								</p>
								<p style="width:50%">
								<?=@$project[8].' '.@$project[9].' '.@$project[10].' '.@$project[11].' '.@$project[12].' '?>
								</p>
								  <?php } else {?>
								  <p style="width:50%"><?=$projet['classement']?></p>
								  
								  <?php } ?>
								</td>
								
								
								<td  align="center" style="font-size:15px;font-family:Arial;text-align:center">
								<table width="100%">
								<tr>
								<th>
								<?=$projet['qte']?>
								</th>
								</tr>
								</table>
								</td>
								
								<td  align="center"  style="font-size:15px;font-family:Arial;text-align:center">
								<?php if($projet['qte']!='ENS' && $projet['qte']!='' ){?>
								<?=$projet['prix_unit_htv']?>
								<?php } else {?>
								<?=$projet['prixForfitaire']?>
								<?php } ?>
								
								</td>
								<td  align="right"  style="font-size:15px;font-family:Arial;"> 
								
								<?php 
								
								if(!empty($PTHT)){
								$dataPPTH=explode($PTHT,'.');
								$verifPoint=null;
								
								if(strpos($PTHT,'.')){
								$verifPoint=1;
								}
								else{
								
								$verifPoint=0;
								}
								
								if($verifPoint==0){$PTHT=$PTHT.'.000';}
								}
							   if($projet['prixForfitaire']!='' || $projet['prix_unit_htv']!=''){	
								?>
							
								<?=$PTHT?>
								<?php } ?>
								</td>
							</tr>
						<?php }} 
				} else {
				 // si on des adresses 
				 //echo '<h1> Il ya adresse '.$nbAdresse.'</h1>';
				   for($a=0;$a<$nbAdresse;$a++){?>
								<tr>
								
								<!-- Colonne 1 Nom Projet-->
								<td >
								   <table width=100%>
								   <tr>
								    <td>
									  <table width=100%  border=1>
									<u style="text-transform:uppercase"><?=$adressesClient[$a][0]?> </u>
									<br>
									<?php
							$nbProjet=count($Projets);
							if($nbProjet<6){$height='50px';} else {$height='30px';}
							
						if(!empty($Projets)){foreach($Projets as $projet){
							if($projet['adresseClient']==$adressesClient[$a][0]){
								$project=explode(' ',$projet['classement']);
								
									?>
									 <tr>
									   <td height=30px style="font-size:12px;font-family:Arial;padding-left:5px">
									   
									   <?php if(count($project)>6){?>
									   <input type="text" style="width:100%; border:0;text-transform:uppercase;font-size:12px" value="<?=@$project[0].' '.@$project[1].' '.@$project[2].' '.@$project[3].' '.@$project[4].' '.@$project[5].' '.@$project[6]?>">
									   <input type="text" style="width:100%; border:0;text-transform:uppercase;font-size:12px" value="<?=@$project[7].' '.@$project[8].' '.@$project[9]?>">
									   <?php } else { ?>
									  <input type="text" style="width:100%; border:0;text-transform:uppercase;font-size:12px" value="<?=$projet['classement']?>">
									   <?php } if($nbProjet<6){?>
								<!------********** -------->
                                        <input  type="text" style="width:100%; border:0;text-transform:uppercase;font-size:12px">
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
						if(!empty($Projets)){foreach($Projets as $projet){
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
						if(!empty($Projets)){foreach($Projets as $projet){
							if($projet['adresseClient']==$adressesClient[$a][0]){
									?>
									 <tr >
									   <td height=<?=$height?>  style="font-size:12px;font-family:Arial;" align=center>
									   <?php if(!empty($projet['prix_unit_htv'])){?>
									   <?=$projet['prix_unit_htv']?>
									   <?php } else {?>
									    <?=$projet['prixForfitaire']?>
									   <?php }?>
									   </td>
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
						if(!empty($Projets)){foreach($Projets as $projet){
							if($projet['adresseClient']==$adressesClient[$a][0]){
								@$PTHT=($projet['qte']*$projet['prix_unit_htv']);
								@$totalHT+=$PTHT;
									?>
									 <tr >
									   <td height=<?=$height?> align=right  style="font-size:12px;font-family:Arial;">
									   
									   <?=@number_format((@$projet['prix_unit_htv']*@$projet['qte']),3)?></td>
									  </tr>	
						<?php }}} ?>
									</table>
									</td>
								   </tr>
								  </table>
								</td>
							
							</tr>
							

								<?php }
				}
						?>
												
						</tbody>
				 

		</table>
							
	      <!-- Pied -->
		   <div  style="width:50%;float:right;display:flex" >
               <div style="width:60%;margin-right:5px">
			     <ul>
				   <li  style="font-size:12px;font-family:Arial;font-weight:italic;margin-bottom:10px">Total H.T</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic;margin-bottom:10px">taux de t.v.a</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic;margin-bottom:10px">t.v.a</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic;margin-bottom:10px">t.t.c</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic;margin-bottom:10px">droit de timbre</li>
				   <li style="font-size:12px;font-family:Arial;font-weight:italic">total note d'honoraires</li>
				 </ul>
			   </div>
				<div style="width:40%;border:solid 1px black;padding-right:5px">
				    <ul>
				   <li style="font-size:15px;font-family:Arial"><?php if(!empty($totalHT)){?>
				   <?=number_format($totalHT,3)?>
				   
				   <?php } else {
				   
				   ?>
				   <?=$totalHT?>
				   <?php } ?>
				  
				   </li>
				   <li style="font-size:15px;font-family:Arial">19%</li>
				   <li style="font-size:15px;font-family:Arial"><?php if(!empty($totalHT)){?><?=number_format(($totalHT*0.19),3)?><?php } ?></li>
				   <li style="font-size:9px;font-family:Arial">
				   <?php
				   if(!empty($totalHT)){
				    $ttc=($totalHT*0.19)+$totalHT;
					
					echo "<span style='font-size:15px'> ".number_format($ttc,3).'</span>';
					}
				   ?>
				   
				   </li>
				   <li style="font-size:15px;font-family:Arial">1.000</li>
				   <li style="font-size:9px;font-family:Arial">
						<?php @$honoraire=$ttc+1.000;
						 $chiffres=explode('.', $honoraire);
						 if(!isset($chiffres[1])){$honoraire=$honoraire.'.000';}
						 else {$honoraire=$honoraire;}
							echo "<b style='font-size:18px'> ".$honoraire.'</b>';?>
							</li>
				 </ul>
				 </div>			   
			  
		   </div>
		  <!-- Fin Pied -->
	
    				</div>
	
    			</div>
	<p class="col-12" style="text-align:left;font-size:15px;padding-top:230px">
	Restons à votre disposition pour tous les renseignements complémentaires que vous jugeriez utiles de nous demander. Nous vous prions d’agréer, l’expression de nos salutations distinguées.
	
	</p>
	<p style="width:90%;text-align:right;padding-top:50px;font-size:15px;padding-right:5px">
		<b>SIGNATURE</b>
		</p>
     
				 </div>
				</div>
		</div>
		
		
    	
    </div>
    <div style="width:90%;text-align:center;padding-top:50px;padding-right:5px;">
		<p style="font-size:10px;">T.P.C : TUNISIA POLYCONTROLS </p>
		<p style="font-size:10px;">S.A.R.L. au capital de 20.000 DT – Code T.V.A : 1426729 H/A/M/000-R.C.: B 2621285205  </p>
		<p style="font-size:10px;">BUREAU : 5 Rue Benghazi-Bureau 4.5 ,4 Eme Etage-1002 Tunis </p> 
		<p style="font-size:10px;">Tél : 36 131 731- GSM : 24 131 544 Email : tunisia.polycontrols.tpc@gmail.com </p>


		</div>
    
</div>
