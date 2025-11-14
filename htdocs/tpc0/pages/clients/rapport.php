<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<?php
include_once  '../../class/client.class.php';
include_once  '../../class/Factures.class.php';
$clients=$clt->getAllClients();


		
 ?>
<!-- DataTales Example -->
                   
                                <table  border=2 style="border:black 1px solid" width="95%" align="center" height="100%" cellspacing="0">
                                    <thead>
                                        <tr bgcolor="grey">
											<th width=30% >Client</th>
											
											<th >Projets</th>
											<th width=40%>Observation</th>
											</tr>
                                    </thead>
                                    
                                    <tbody>
									<?php if(!empty($clients)){
										foreach($clients as $key){
									$projetsClient=$clt->RapportClient($key['id']);
									$projetsClientArchive=$clt->RapportClientArchive($key['id']);
									
										?>
											 <tr>
												<td>
												<b><?=$key['nom_client']?></b>
												</td>
												 <td>
									<?php if(!empty($projetsClient)){
										
										foreach($projetsClient as $p){
										
										?>
										<?=$p['classement']?><br>
										
									<?php } } if(!empty($projetsClientArchive)){
										foreach($projetsClientArchive as $pA){?>
										<?=@$pA['Projets']?><br>
									   
									
										<?php }}?>
												</td>
												
												<td></td>
											
												
												 
												
											 </tr>
									<?php }}?>
									 </tbody>
                                </table>
                            