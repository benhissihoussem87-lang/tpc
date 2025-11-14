<?php 
						$recouvrements=$ponct->getRecouvrementsRecp($cle['code']);
						if(@count($recouvrements)>0)
						{
						
						foreach($recouvrements as $detR){
						
						?>
						 
						<!--<a href="?ModifierRECP&Ponctuel=<?php //echo $detR['code']?>&id_modifier=<?php //echo $detR['id']?>">-->
						
						<a href="?AfficherRECP&updateRec&id_modifier=<?php echo $detR['id']?>&codeP=<?php echo $detR['code']?>" onclick="if(!confirm('voulez-vous supprimer')) return false">
						<?php
						
									/*if($detR['FACTURE']==null and $detR['RECOUV']==null)
									{
							         echo 'F '.$detR['FACTURE'].'<br>';
									}*/
									if($detR['FACTURE']!=null){
										echo 'F '.$detR['FACTURE'].'<br>';
									}
						
						} }
						?></a>
						
						
						
						<a href="?recP_Ajout&Ponctuel=<?php echo $cle['code']?>&OP=<?php echo $cle['code_offre']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">
						 Recouvrement</a>
