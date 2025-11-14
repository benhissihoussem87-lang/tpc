<div class="container" style="width:100%">
    <div class="row">
        
    		<div class="invoice-title col-3" style="position:absolute;top:-25px;left:0px">
    			<h2><img src="../../assets/images/logo.png" height=100/></h2>
    		</div>
			
    	<h3 class="col-3" style="text-align:center;text-transform:uppercase;position:relative;top:150px;font-size:25px">
		Bordereaux N° <?=$infosBordereau['num_bordereaux']?> </h3>
    		
    			
    			<div class="col-3" style="float:right">
    				<address>
        			  <ol >
					    <li>Date :  <b><?=$date?></b></li>
    					<li>Client : <b><?=$infosBordereau['nom_client']?></b></li>
    					<li>Adresse : <b><?=$infosBordereau['adresse']?></b></li>
    					
						
					  <ol>
    				</address>
    			</div>
    		
    	<div class="row">
				<div class="col-md-11">
				<div class="panel-body col-12" style="position:relative;top:-50px" >
				<p class="col-12" style="text-align:left;font-size:15px;padding-top:230px">
	
	
	</p>
				<!-- Détail -->
				   <div class="panel-body" style="position:relative;top:50px" >
    				<div class="table-responsive" >
					
						<table class="table " style="height:150px" border=1  >
						<thead>
						<tr style="background:#f5f5f5;text-transform:uppercase">
						  
							<th style="width:60%;text-align:center">Designation</th>
							<th style="width:10%;text-align:center">Nombre</th>
							<th style="width:30%;text-align:center">Observation</th>
							
						</tr>
						</thead>
						<tbody>
						<?php
							$totalHT=0;
							$i=0;
						$i+=1;
								
								?>
							<tr >
							
								<td style="font-size:15px;font-family:Arial;padding-left:5px;text-align:center;" valign=top>
								<table width="100%" border=1 height=100>
								<tr>
								<th>
								<?php
							foreach($infosBordereaux as $detailBrd){
								if(!empty($detailBrd['adresse_bordereaux'])){
										?>
									<u  style="text-transform:uppercase;text-decoration:none;font-weight:bold">
									<?=$detailBrd['adresse_bordereaux']?> </u>	 
									 <?php 
								}
								$brds=explode('<br>',$detailBrd['type']);
								 for($i=0;$i<count($brds);$i++){
								  $brds=explode('&',$detailBrd['type']);?>
								<p style="font-size:15px;font-family:Arial;font-weight:normal"> 
								<?=$brds[$i]?>
								</p>
								
								  
									<?php }} ?>
								 
								 </th>
								</tr>
								<tr>
								<th>
								<p style="font-size:15px;font-family:Arial;">FACTURE N° <?=$infosBordereau['num_fact']?></p>
								</th>
								</tr>
								</table>
								</td>
								<td align="center" style="font-size:11px;font-family:Arial;text-align:center;padding-top:0">
								<?php
								foreach($infosBordereaux as $detailBrd){
									if(!empty($detailBrd['adresse_bordereaux'])){
						echo '<input type="text" readonly  style="text-align:center;border:0;width:100%;margin-bottom:3px"/>';
						$margeTop='0';
					
						}
						else {
							
							$margeTop='-10';
						}
                                $brds=explode('<br>',$detailBrd['type']);
								for($i=0;$i<count($brds);$i++){
								$brds=explode('&',$detailBrd['type']);?>
					        
								<p style="font-size:15px;font-family:Arial;position:relative;top:<?=$margeTop?>px">
								<input type="text" value="1" style="text-align:center;border:0;width:100%"/> </p>
								<?php }} ?>
								  
								  <p style="font-size:15px;font-family:Arial; position:relative;top:-5px">
								<input type="text" value="1" style="text-align:center;border:0;width:100%"/>
								</p>
								</td>
								<td align="center"  style="text-align:center">
								<?php 
								foreach($infosBordereaux as $detailBrd){
									if(!empty($detailBrd['adresse_bordereaux'])){
						echo '<input type="text" readonly  style="text-align:center;border:0;width:100%;margin-bottom:3px"/>';
						$margeTop='0';
					
						}
						else {
							$margeTop='-10';
						}
								$brds=explode('<br>',$detailBrd['type']);
								$brds=explode('&',$detailBrd['type']);
								 for($i=0;$i<count($brds);$i++){?>
								 
								<p style="font-size:15px;font-family:Arial;position:relative;top:<?=$margeTop?>px">POUR ARCHIVE</p>
								<?php } } ?>
								<p style="font-size:15px;font-family:Arial;position:relative;top:-5px">POUR REGLEMENT</p>
								
								</td>
								
							</tr>
						
												
						</tbody>
				 

		</table>
							
	      
		  <!-- Fin Pied -->
	
    				</div>
	
    			</div>
	<p class="col-12" style="text-align:left;font-size:15px;padding-top:230px">
	</p>
	<div style="width:90%;display:flex">
	<p style="width:50%;text-align:left;padding-top:50px;font-size:15px;padding-left:50px">
		<b>SOCIETE TPC</b>
		</p>
		<p style="width:50%;text-align:right;padding-top:50px;font-size:15px;padding-right:5px">
		<b>CLIENT</b>
		</p>
     
		</div>

		</div>
				</div>
		</div>
		
		
    	
    </div>
    <div style="width:90%;text-align:center;padding-top:200px;padding-right:5px;">
		<p style="font-size:10px;">T.P.C : TUNISIA POLYCONTROLS </p>
		<p style="font-size:10px;">S.A.R.L. au capital de 20.000 DT – Code T.V.A : 1426729 H/A/M/000-R.C.: B 2621285205  </p>
		<p style="font-size:10px;">BUREAU : 5 Rue Benghazi-Bureau 4.5 ,4 Eme Etage-1002 Tunis </p> 
		<p style="font-size:10px;">Tél : 36 131 731- GSM : 24 131 544 Email : tunisia.polycontrols.tpc@gmail.com </p>


		</div>
    
+
</div>