<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
$ponctuels=$ponct->getPonctuels();
  $recouv=$ponct->getRecouvrement();
if(isset($_GET['updateRec']))
{
 if($recP->Modifierrec_p($_GET['id_modifier']))
 {
$recP->deleterec_p($_GET['id_modifier']); 
$recP->deleteAutreFactureRec($_GET['codeP']); 

 $recP->deleteFactureRec($_GET['codeP']);
 
 echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";
 }
}
if(isset($_GET['id_delete']))

{
 if($ponct->deletePonctuel($_GET['id_delete']))
 {
 echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";
 }
}
//session_start();
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
             <table style="position:relative;left:120px; top:-30px"  width=90%>
			  <tr>
			 <td > <b style="font-size:20px;position:relative;top:30px;left:-20px">Recouvrement Ponctuel</b></td>
			  <td >
			   <form method="post" style="padding-left:20px;position:relative;left:-300px">
			  <table width="80%">
			  <tr>
			  <td><input type="radio" name="fact" value="impaye"  style="width:20px;height:20px" >
			   <b style="font-size:20px">IMPAYE   </b></td>
			    
			   <td> <input type="submit" value="Afficher" name="AfficherFactureImpaye" class="btn btn-primary btn-block"></td>
			   </tr>
			   </table>
			   </form>
			   
			   </td>
              </tr>
			  
			  </table>
			  </div>
			 
		        
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                       <?php if($_SESSION['user']=='Admin'){ ?>
                      <th>Num</th>
					   <?php } ?>
                     <th>Code</th>
						  <th>MDO</th>
					   <th>Projet</th>  
                        <?php if($_SESSION['user']=='Admin'){ ?>
					    <th>vis-à-vis</th>
						<?php } ?>	
					<th>Recouvrement</th>
				<?php if($_SESSION['user']=='Admin'){ ?>
					  <th>Hono</th>
					  
					  <th>COMM/<br>MISS</th>
					  <?php }?>
					   <th>ING</th>
					  <?php if($_SESSION['user']=='Admin'){?>
					     <th>Recouv</th>
					 <?php }?>
						   <th >date.................</th> 					
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $row=count($ponctuels);
				  if($row>0)
				  {
				  $tothono=0;
				   $comm=0;
				    $totfacture=0;
					 $totrecouv=0;
					
				  foreach($ponctuels as $cle)
				  {
				
				  @ $tothono= $tothono+$cle['honoraire'];
				  $recouvrements=$ponct->getRecouvrementsRecp($cle['code']);
				 
				  if(@count($recouvrements)>0)
						{
						
				  foreach($recouvrements as $Rec);
				 
						}
				 ?>
				
				    <?php
							 $totrecouvRe=0; 
					   if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouvV)
						{
						
						@$totrecouv=$totrecouv+$recouvV['RECOUV'];
						
							@$totrecouvRe+= $recouvV['RECOUV'];
						//}
							}}
							//echo '<h1>'.$totrecouvRe.'___'.$cle['honoraire'].'</h1>'; 							
							?>
				
				  <tr <?php if($totrecouvRe < $cle['honoraire']){?> bgcolor=yellow<?php } ?>>
				  <?php if($_SESSION['user']=='Admin' ){?>
                    <td><?php echo $cle['num']?></td>
				 <?php } ?>
					  
			<td>
					   <b>PP</b><?php echo $cle['code']?>
					    <?php if($cle['code_offre']!=null)
					   {?>
					   <br>
					   <b>OP</b><?php echo $cle['code_offre']?>
					   <?php } ?>
					   </td>

						  <td><?php echo $cle['mdo']?></td>
					    <td><?php echo $cle['projet']?></td>
						<?php if($_SESSION['user']=='Admin'){?>
						<td><?php  echo $cle['vis_a_vis']?></td>
						<?php } ?>
       	
						<?php if($_SESSION['user']=='Admin'){?>
						<td align=center>
						<?php 
						
						if(@count($recouvrements)>0)
						{
						
						foreach($recouvrements as $detR){
						
						?>
						
						
						
						<a href="?ModifierRECP&Projet=<?php echo $cle['code']?>&Facture=<?php echo $detR['FACTURE']?>&idRecP=<?php echo $detR['id']?>">
						<?php
						
									if($detR['FACTURE']!=null)
									{
										
							         echo 'F '.$detR['FACTURE'].'<br>';
									
									}
									else if($detR['RECOUV']!=null)
									{
							   echo $detR['RECOUV'].'<br>';
									}
						
						} } 
						?></a>
						
						
						
						<a href="?recP_Ajout&Ponctuel=<?php echo $cle['code']?>&OP=<?php echo $cle['code_offre']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">
						 Recouvrement</a>
						
						</td><?php } else if($_SESSION['user']=='Admin2'){?>
						<td>
						
						<?php include 'RecpAdmin2.php';?>
						
						
						</td>
						
						<?php }$recouvrement=$recP->getRecouvrementPonctuel($cle['code']);
						?>
						<?php if($_SESSION['user']=='Admin'){ ?>
						<td><?php  echo $cle['honoraire']?></td>
						
						<?php
						
						
						
						if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouv)
						{
						 @$comm=$comm+$recouv['COMM'];
						 $ing=$recouv['ing'];
						 $facture=$recouv['FACTURE'];
						 $recouvr=$recouv['RECOUV'];
						 $date=$recouv['date'];
						} 
						
						}
						else{
						 $comm=null;
						 $ing=null;
						 $facture=null;
						 $recouvr=null;
						 $date=null;
						}
						?>
					<td valign=top ><?php 
					      if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouv)
						{
							//if($recouv['COMM']!=null){
         					 echo $recouv['COMM'].'<br>';
							//}
							}} 
							?>
					   
					   </td>
					   <?php }?>
					   
					 <td> 
					 <?php 
					
					  if(@count($recouvrement)>0)
						{
					 foreach($recouvrement as $i)
						{
							//if($i['ing']!=null){
  					 echo $i['ing'].'<br>';
							//}
						}}?>
					 
					 </td> 
                     <?php if($_SESSION['user']=='Admin'){?>
                       <td valign=top>
		
						
					   <?php
						
					   if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouv)
						{
						
						@$totrecouv=$totrecouv+$recouv['RECOUV'];
						//if($recouv['RECOUV']!=null  or ){
         					 echo $recouv['RECOUV'].'<br>';
							
						//}
							}}
												
							?>
							
							</td>
							<?php 
				  } 
					?>
					   <td valign=top><?php 
					      if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouv)
						{
							//if($recouv['date']!=null){
         					 echo $recouv['date'].'<br>';
							//}
							}} 
							?>
					   
					   </td>
					  
						
				 <?php }} ?>
					 </tr>

                     <?php					 
				   
				  
				  
					?>
					
                  </tbody>
				   <?php if($_SESSION['user']=='Admin'){?>
				  <tr bgcolor="#A8B1C1">
				    <td></td><td></td><td></td><td></td><td></td><td></td>
					
					<td><b style="font-size:16px">Hono</b></td>
                    <td><b style="font-size:16px">Comm/Miss</b></td>
					<td></td>
					<td><b style="font-size:16px">Facture</b></td>
					<td><b style="font-size:16px">Recouv</b></td>
					<td></td><td></td>
				   </tr>
					<tr bgcolor="#A8B1C1">
					<td></td><td></td><td></td><td></td><td></td><td></td>
					<td><?php echo $tothono ?></td>
                    <td><?php echo $comm?></td>
					<td></td>
					<td><?php echo $totfacture?></td>
					<td><?php echo $totrecouv?></td>
					<td></td><td></td>
				   </tr>
				   <?php }?>
                </table>
              </div>
            </div>
				 
          </div>

         