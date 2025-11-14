 <tr>
                    <td><?php echo $cle['num']?></td>
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
						<td><?php  echo $cle['vis_a_vis']?></td>
						<td align=center>
						<?php 
						$recouvrements=$ponct->getRecouvrement($cle['code']);
						if(@count($recouvrements)>0)
						{
						
						foreach($recouvrements as $detR);
						
						?>
						 
						<!--<a href="?ModifierRECP&Ponctuel=<?php //echo $detR['code']?>&id_modifier=<?php //echo $detR['id']?>">-->
						<?php if($_SESSION['user']=='Admin'){?>
						<a href="?AfficherRECP&updateRec&id_modifier=<?php echo $detR['id']?>&codeP=<?php echo $detR['code']?>" onclick="if(!confirm('voulez-vous supprimer')) return false">
						<?php
						
						/*if($detR['RECOUV']!=null)
						{*/
							
								echo 'F '.$detR['FACTURE'].'<br>';
							echo $detR['RECOUV'].'<br>';
						
						//}
						?></a>
						<?php } else if($_SESSION['user']!='Admin') {
						if($detR['FACTURE']!=null)
							{
								echo 'F '.$detR['FACTURE'].'<br>';
							}
						
						}
						
						}
						
						?>
						<?php
						//if(count($recouvrements)==0 ){?>
						
						<a href="?recP_Ajout&Ponctuel=<?php echo $cle['code']?>&OP=<?php echo $cle['code_offre']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">
						 Recouvrement</a>
						<?php // } ?>
						</td>
						<?php if($_SESSION['user']=='Admin'){ ?>
						<td><?php  echo $cle['honoraire']?></td>
						<?php }?>
						<?php
						
						$recouvrement=$recP->getRecouvrementPonctuel($cle['code']);
						
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
					<td valign=top><?php 
					      if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouv)
						{
						
         					 echo $recouv['COMM'].'<br>';
							 
							}} 
							?>
					   
					   </td>
					 <td>
					 <?php 
					  if(@count($recouvrement)>0)
						{
					 foreach($recouvrement as $i)
						{
  					 echo $i['ing'].'<br>';
						}}?>
					 
					 </td> 
                     <?php if($_SESSION['user']=='Admin'){?>
                       <td valign=top>
					   
						
						
					   <?php   if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouv)
						{
						
						@$totrecouv=$totrecouv+$recouv['RECOUV'];
         					 echo $recouv['RECOUV'].'<br>';
							 
							}} 
							?>
							
							</td>
					   <td valign=top><?php 
					      if(@count($recouvrement)>0)
						{
						
						foreach($recouvrement as $recouv)
						{
						
         					 echo $recouv['date'].'<br>';
							 
							}} 
							?>
					   
					   </td>
					  
					 
                   
					<?php 
				  } 
					?>
					 </tr>