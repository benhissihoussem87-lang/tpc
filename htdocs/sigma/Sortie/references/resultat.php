<?php
session_start();
if(isset($_POST['annee']) and $_POST['annee']!=null)
{
/////////Table Offre
include 'classes/appel_offres.class.php';
include 'classes/Autres_Facture.class.php';
	$offre=new offres();
	$AutreFacture=new AutresFactures();
	$Autres_Factures=$AutreFacture->getAutresFactures();
	$resOffre=$offre->getOffreResultat();

	$resOffreE=$offre->getOffreResultatEtat();
	$resOffreHonoraire=$offre->getOffreResultatHonoraireOffre();
	//var_dump($resOffre);
	/******** Autres_Factures ****************/
	// AutreFactureEnvoyée
	$autreFEnvoye_1=0;
	$autreFEnvoye_2=0;
	$autreFEnvoye_3=0;
	$autreFEnvoye_4=0;
	$autreFEnvoye_5=0;
	$autreFEnvoye_6=0;
	$autreFEnvoye_7=0;
	$autreFEnvoye_8=0;
	$autreFEnvoye_9=0;
	$autreFEnvoye_10=0;
	$autreFEnvoye_11=0;
	$autreFEnvoye_12=0; 
	// AutreFactureRecouvrée
	$autreFRecouvre_1=0;
	$autreFRecouvre_2=0;
	$autreFRecouvre_3=0;
	$autreFRecouvre_4=0;
	$autreFRecouvre_5=0;
	$autreFRecouvre_6=0;
	$autreFRecouvre_7=0;
	$autreFRecouvre_8=0;
	$autreFRecouvre_9=0;
	$autreFRecouvre_10=0;
	$autreFRecouvre_11=0;
	$autreFRecouvre_12=0;
		foreach($Autres_Factures as $cleFA)
	{
	  $dlmA=explode('-',$cleFA['envoye']);
	 @$dateA=$dlmA[0];
	 @$moisA=$dlmA[1];
	 $moisAnA=$dateA.'-'.$moisA;
	  if($_POST['annee']==$dateA)
	 {
		 if($moisA=='01' )
		 {
		 $autreFEnvoye_1=$autreFEnvoye_1+ $cleFA['mantant'];
		 }
		 else  if($moisA=='02' )
		 {
		 $autreFEnvoye_2=$autreFEnvoye_2+ $cleFA['mantant'];
		 }
		 else  if($moisA=='03' )
		 {
		 $autreFEnvoye_3=$autreFEnvoye_3+ $cleFA['mantant'];
		 }
		 else  if($moisA=='04' )
		 {
		 $autreFEnvoye_4=$autreFEnvoye_4+ $cleFA['mantant'];
		 }
		 else  if($moisA=='05' )
		 {
		 $autreFEnvoye_5=$autreFEnvoye_5+ $cleFA['mantant'];
		 }
		 else  if($moisA=='06' )
		 {
		 $autreFEnvoye_6=$autreFEnvoye_6+ $cleFA['mantant'];
		 }
		 else  if($moisA=='07' )
		 {
		 $autreFEnvoye_7=$autreFEnvoye_7+ $cleFA['mantant'];
		 }
		 else  if($moisA=='08' )
		 {
		 $autreFEnvoye_8=$autreFEnvoye_8+ $cleFA['mantant'];
		 }
		 else  if($moisA=='09' )
		 {
		 $autreFEnvoye_9=$autreFEnvoye_9+ $cleFA['mantant'];
		 }
		 else  if($moisA=='10' )
		 {
		 $autreFEnvoye_10=$autreFEnvoye_10+ $cleFA['mantant'];
		 }
		 else  if($moisA=='11' )
		 {
		 $autreFEnvoye_11=$autreFEnvoye_11+ $cleFA['mantant'];
		 }
		 else  if($moisA=='12' )
		 {
		 $autreFEnvoye_12=$autreFEnvoye_12+ $cleFA['mantant'];
		 }
	}
	 
	/****Calculer Facture News Recouvré*****/
	
	     $dlmAR=explode('-',$cleFA['recouvre']);
	 @$dateAR=$dlmAR[0];
	 @$moisAR=$dlmAR[1];
	 $moisAnAR=$dateAR.'-'.$moisAR;
	  if($_POST['annee']==$dateAR)
	 {
		 if($moisAR=='01' )
		 {
		 $autreFRecouvre_1=$autreFRecouvre_1+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='02' )
		 {
		 $autreFRecouvre_2=$autreFRecouvre_2+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='03' )
		 {
		 $autreFRecouvre_3=$autreFRecouvre_3+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='04' )
		 {
		 $autreFRecouvre_4=$autreFRecouvre_4+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='05' )
		 {
		 $autreFRecouvre_5=$autreFRecouvre_5+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='06' )
		 {
		 $autreFRecouvre_6=$autreFRecouvre_6+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='07' )
		 {
		 $autreFRecouvre_7=$autreFRecouvre_7+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='08' )
		 {
		 $autreFRecouvre_8=$autreFRecouvre_8+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='09' )
		 {
		 $autreFRecouvre_9=$autreFRecouvre_9+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='10' )
		 {
		 $autreFRecouvre_10=$autreFEnvoye_10+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='11' )
		 {
		 $autreFRecouvre_11=$autreFRecouvre_11+ $cleFA['mantant'];
		 }
		 else  if($moisAR=='12' )
		 {
		 $autreFRecouvre_12=$autreFRecouvre_12+ $cleFA['mantant'];
		 }
	}
	
	 /****Fin Calculer Facture News Recouvré*****/
	 
} // Fin foreach($Autres_Factures as $cleFA)


	/*********** Fin Autre Facture ******************/
/**Nb Offre****/
	$nboffreTotal_1=0;
	$nboffreTotal_2=0;
	$nboffreTotal_3=0;
	$nboffreTotal_4=0;
	$nboffreTotal_5=0;
	$nboffreTotal_6=0;
	$nboffreTotal_7=0;
	$nboffreTotal_8=0;
	$nboffreTotal_9=0;
	$nboffreTotal_10=0;
	$nboffreTotal_11=0;
	$nboffreTotal_12=0;
   
   $nboffreRetenue_1=0;
   $nboffreRetenue_2=0;
   $nboffreRetenue_3=0;
   $nboffreRetenue_4=0;
   $nboffreRetenue_5=0;
   $nboffreRetenue_6=0;
   $nboffreRetenue_7=0;
   $nboffreRetenue_8=0;
   $nboffreRetenue_9=0;
   $nboffreRetenue_10=0;
   $nboffreRetenue_11=0;
   $nboffreRetenue_12=0;
   
	$HonoTotal_1=0;
	
   $HonoTotal_2=0;
   $HonoTotal_3=0;
   $HonoTotal_4=0;
   $HonoTotal_5=0;
   $HonoTotal_6=0;
   $HonoTotal_7=0;
   $HonoTotal_8=0;
   $HonoTotal_9=0;
   $HonoTotal_10=0;
   $HonoTotal_11=0;
   $HonoTotal_12=0;
	
	
	$HonoTotalRetenue_1=0;
	 $HonoTotalRetenue_2=0;
   $HonoTotalRetenue_3=0;
   $HonoTotalRetenue_4=0;
   $HonoTotalRetenue_5=0;
   $HonoTotalRetenue_6=0;
   $HonoTotalRetenue_7=0;
   $HonoTotalRetenue_8=0;
   $HonoTotalRetenue_9=0;
   $HonoTotalRetenue_10=0;
   $HonoTotalRetenue_11=0;
   $HonoTotalRetenue_12=0;
	
	foreach($resOffre as $cle)
	{
	  $dlm=explode('-',$cle['date_limite']);
	 @$date=$dlm[0];
	
	 @$mois=$dlm[1];
	
	
	 if($_POST['annee']==$date)
	 {
	   //echo '<h1>'.$_POST['annee'] . ' '.$mois.'</h1>';
	 $moisAn=$date.'-'.$mois;
	 if($mois=='01')
	 {
	 
	  $nboffreTotal_1=$nboffreTotal_1+1;
	  $HonoTotal_1=$HonoTotal_1+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_1=$nboffreRetenue_1+1;}
	 }
	else if($mois=='02')
	 {
	 
	  @$nboffreTotal_2=$nboffreTotal_2+1;
	  @$HonoTotal_2=$HonoTotal_2+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_2=$nboffreRetenue_2+1;}
	    
	 }
	
	else if($mois=='03')
	 {
	 
	  @$nboffreTotal_3=$nboffreTotal_3+1;
	  @$HonoTotal_3=$HonoTotal_3+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_3=$nboffreRetenue_3+1;}
	 }
	else if($mois=='04')
	 {
	 
	 @ $nboffreTotal_4=$nboffreTotal_4+1;
	  @$HonoTotal_4=$HonoTotal_4+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_4=$nboffreRetenue_4+1;}
	 }
	 else if($mois=='05')
	 {
	 
	  @$nboffreTotal_5=$nboffreTotal_5+1;
	  @$HonoTotal_5=$HonoTotal_5+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_5=$nboffreRetenue_5+1;}
	 }
	else if($mois=='06')
	 {
	 
	  @$nboffreTotal_6=$nboffreTotal_6+1;
	  @$HonoTotal_6=$HonoTotal_6+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_6=$nboffreRetenue_6+1;}
	 }
	 else if($mois=='07')
	 {
	 
	  @$nboffreTotal_7=$nboffreTotal_7+1;
	  @$HonoTotal_7=$HonoTotal_7+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_7=$nboffreRetenue_7+1;}
	 }
	 else if($mois=='08')
	 {
	 
	  @$nboffreTotal_8=$nboffreTotal_8+1;
	  @$HonoTotal_8=$HonoTotal_8+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_8=$nboffreRetenue_8+1;}
	 }
	 else if($mois=='09')
	 {
	 
	  @$nboffreTotal_9=$nboffreTotal_9+1;
	 @ $HonoTotal_9=$HonoTotal_9+ $cle['hono'];
	 if($cle['etat']==2){@$nboffreRetenue_9=$nboffreRetenue_9+1;}
	 }
	 else if($mois=='10')
	 {
	 
	  @$nboffreTotal_10=$nboffreTotal_10+1;
	  @$HonoTotal_10=$HonoTotal_10+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_10=$nboffreRetenue_10+1;}
	 }
	 else if($mois=='11')
	 {
	 
	  @$nboffreTotal_11=$nboffreTotal_11+1;
	  @$HonoTotal_11=$HonoTotal_11+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_11=$nboffreRetenue_11+1;}
	 }
	 else if($mois=='12')
	 {
	 
	  @$nboffreTotal_12=$nboffreTotal_12+1;
	  @$HonoTotal_12=$HonoTotal_12+ $cle['hono'];
	  if($cle['etat']==2){@$nboffreRetenue_12=$nboffreRetenue_12+1;}
	 }
	 
	 }
	}
	 /****************/
	 foreach($resOffreHonoraire as $cleH)
	{
		
		if($cleH['etat']==2)
		{
			if($cleH['date_limite']){
	  $dlmE=explode('-',$cleH['date_limite']);
			}
			else {
				$dlmE=explode('-',$cleH['date_decharge']);
			}
	 @$dateE=$dlmE[0];
	
	 @$moisE=$dlmE[1];
	
	 if($_POST['annee']==$dateE)
	 {
	  if($moisE=='01' )
	 {
		 
	// echo 'Moi '. $cleH['hono'].'<br>';

	   @$HonoTotalRetenue_1=$HonoTotalRetenue_1+$cleH['hono'];
	 }
	 else  if($moisE=='02')
	 {
	 //echo $moisAn.'<br>';
	
	   @$HonoTotalRetenue_2=$HonoTotalRetenue_2+ $cleH['hono'];
	 }
	  else  if($moisE=='02' )
	 {
	 //echo $moisAn.'<br>';
	  
	   @$HonoTotalRetenue_2=$HonoTotalRetenue_2+ $cleH['hono'];
	 }
	  else  if($moisE=='03' )
	 {
	 //echo $moisAn.'<br>';

	   @$HonoTotalRetenue_3=$HonoTotalRetenue_3+ $cleH['hono'];
	 }
	  else  if($moisE=='04')
	 {
	 //echo $moisAn.'<br>';
	
	  @ $HonoTotalRetenue_4=$HonoTotalRetenue_4+ $cleH['hono'];
	 }
	  else  if($moisE=='05')
	 {
	// echo '<h1> Moi : '.$moisAn.'</h1>';
	 
	  @ $HonoTotalRetenue_5=$HonoTotalRetenue_5+ $cleH['hono'];
	 }
	  else  if($moisE=='06')
	 {
	 //echo $moisAn.'<br>';
	 
	   @$HonoTotalRetenue_6=$HonoTotalRetenue_6+ $cleH['hono'];
	 }
	  else  if($moisE=='07' )
	 {
	 //echo $moisAn.'<br>';
	
	  @ $HonoTotalRetenue_7=$HonoTotalRetenue_7+ $cleH['hono'];
	 }
	  else  if($moisE=='08' )
	 {
	 //echo $moisAn.'<r>';
	
	  @ $HonoTotalRetenue_8=$HonoTotalRetenue_8+ $cleH['hono'];
	 }
	  else  if($moisE=='09' )
	 {
	 //echo $moisAn.'<br>';
	 
	  @ $HonoTotalRetenue_9=$HonoTotalRetenue_9+ $cleH['hono'];
	 }
	  else  if($moisE=='10' )
	 {
	 //echo $moisAn.'<br>';
	
	  @ $HonoTotalRetenue_10=$HonoTotalRetenue_10+ $cleH['hono'];
	 }
	 
	  else  if($moisE=='11' )
	 {
	 //echo $moisAn.'<br>';
	
	  @ $HonoTotalRetenue_11=$HonoTotalRetenue_11+ $cleH['hono'];
	 }
	  else  if($moisE=='12' )
	 {
	 //echo $moisAn.'<br>';
	 
	  @ $HonoTotalRetenue_12=$HonoTotalRetenue_12+ $cleH['hono'];
	 }
	  }
		}
	}
//Table Pontuel
include 'classes/ponctuel.class.php';
	$ponct=new ponctuels();
	$resPonctuels=$ponct->getPonctuelsResultat();
	
		
	$HonoPonct_1=0;
		$HonoPonct_2=0;
			$HonoPonct_3=0;
				$HonoPonct_4=0;
				$HonoPonct_5=0;
				$HonoPonct_6=0;
					$HonoPonct_7=0;
						$HonoPonct_8=0;
							$HonoPonct_9=0;
								$HonoPonct_10=0;
									$HonoPonct_11=0;
										$HonoPonct_12=0;
	foreach($resPonctuels as $cleP)
	{if($cleP['code_offre']==null){
	  $dlm=explode('-',$cleP['arr']);
	 @$date=$dlm[0];
	 @$mois=$dlm[1];
	 $moisAn=$date.'-'.$mois;
	  if($_POST['annee']==$date)
	 {
	 if($mois=='01')
	 {
	 
	 
	 @ $HonoPonct_1=$HonoPonct_1+ $cleP['honoraire'];
	 }
	  else if($mois=='02')
	 {
	 
	 
	 @ $HonoPonct_2=$HonoPonct_2+ $cleP['honoraire'];
	 }
	  else if($mois=='03')
	 {
	 
	 
	 @ $HonoPonct_3=$HonoPonct_3+ $cleP['honoraire'];
	 }
	  else if($mois=='04')
	 {
	 
	 
	  @$HonoPonct_4=$HonoPonct_4+ $cleP['honoraire'];
	 }
	  else if($mois=='05')
	 {
	 
	 
	  @$HonoPonct_5=$HonoPonct_5+ $cleP['honoraire'];
	 }
	  else if($mois=='06')
	 {
	 
	 
	  @$HonoPonct_6=$HonoPonct_6+ $cleP['honoraire'];
	 }
	  else if($mois=='07')
	 {
	 
	 
	  @$HonoPonct_7=$HonoPonct_7+ $cleP['honoraire'];
	 }
	  else if($mois=='08')
	 {
	 
	 
	  @$HonoPonct_8=$HonoPonct_8+ $cleP['honoraire'];
	 }
	  else if($mois=='09')
	 {
	 
	 
	  @$HonoPonct_9=$HonoPonct_9+ $cleP['honoraire'];
	 }
	  else if($mois=='10')
	 {
	 
	 
	  @$HonoPonct_10=$HonoPonct_10+ $cleP['honoraire'];
	 }
	  else if($mois=='11')
	 {
	 
	 
	  @$HonoPonct_11=$HonoPonct_11+ $cleP['honoraire'];
	 }
	  else if($mois=='12')
	 {
	 
	 
	  @$HonoPonct_12=$HonoPonct_12+ $cleP['honoraire'];
	 }
	
	  }
	
	}}
//Recouvrement Ponctuel

include 'classes/Rec_ponctuel.class.php';
	$rec_ponct=new Rec_ponctuel();
	$res_rec_Ponctuels=$rec_ponct->getRec_PonctuelsResultat();
	
		
	$recouvrementRC_1=0;$frais_1=0;
	$recouvrementRC_2=0;$frais_2=0;
	$recouvrementRC_3=0;$frais_3=0;
	$recouvrementRC_4=0;$frais_4=0;
	$recouvrementRC_5=0;$frais_5=0;
	$recouvrementRC_6=0;$frais_6=0;
	$recouvrementRC_7=0;$frais_7=0;
	$recouvrementRC_8=0;$frais_8=0;
	$recouvrementRC_9=0;$frais_9=0;
	$recouvrementRC_10=0;$frais_10=0;
	$recouvrementRC_11=0;$frais_11=0;
	$recouvrementRC_12=0;$frais_12=0;
	if($res_rec_Ponctuels!=null){
	foreach($res_rec_Ponctuels as $cleRc_P)
	{
		
	  $dlm=explode('-',$cleRc_P['date']);
	 @$date=$dlm[0];
	 @$mois=$dlm[1];
	 $moisAn=$date.'-'.$mois;
	  if($_POST['annee']==$date)
	 {
		/**************Recouv .P******/
		if($cleRc_P['FACTURE']==null){
	 if($mois=='01' )
	 {
	 $recouvrementRC_1=$recouvrementRC_1+ $cleRc_P['RECOUV'];
	
	 }
	 if($mois=='02'  )
	 {
	 $recouvrementRC_2=$recouvrementRC_2+ $cleRc_P['RECOUV'];
	
	 }
	 	 if($mois=='03'  )
	 {
	 $recouvrementRC_3=$recouvrementRC_3+ $cleRc_P['RECOUV'];
	
	 }
	 /************/
	 	 if($mois=='04'  )
	 {
	 @$recouvrementRC_4=$recouvrementRC_4+ $cleRc_P['RECOUV'];
	 }
	 /************/
	 	
	  /************/
	 	 if($mois=='05'  )
	 {
	 $recouvrementRC_5=$recouvrementRC_5+ $cleRc_P['RECOUV'];
	
	 }
	  if($mois=='06'  )
	 {
	 @$recouvrementRC_6=$recouvrementRC_6+ $cleRc_P['RECOUV'];
	
	 }
	 	 if($mois=='07'  )
	 {
	 @$recouvrementRC_7=$recouvrementRC_7+ $cleRc_P['RECOUV'];
	
	 }
	 	 if($mois=='08'  )
	 {
	 @$recouvrementRC_8=$recouvrementRC_8+ $cleRc_P['RECOUV'];
	
	 }
	  if($mois=='09'  )
	 {
	 @$recouvrementRC_9=$recouvrementRC_9+ $cleRc_P['RECOUV'];
	
	 }
	 if($mois=='10'  )
	 {
	 @$recouvrementRC_10=$recouvrementRC_10+ $cleRc_P['RECOUV'];
	
	 }
	 
	  if($mois=='11'  )
	 {
	 @$recouvrementRC_11=$recouvrementRC_11+ $cleRc_P['RECOUV'];
	
	 }
	  if($mois=='12'  )
	 {
	 @$recouvrementRC_12=$recouvrementRC_12+ $cleRc_P['RECOUV'];
	
	 }
	 }
	 
	 /***************Fin Recouvrement.P*******/
		 
   if($mois=='01')
	 {
	
	 @ $frais_1=$frais_1+ $cleRc_P['COMM'];
	 }
	 
	 
   if($mois=='02')
	 {
	
	 @ $frais_2=$frais_2+ $cleRc_P['COMM'];
	 }
	 
	 /************/
	 
   if($mois=='03')
	 {
	
	  @$frais_3=$frais_3+ $cleRc_P['COMM'];
	 }
	 
	 
   if($mois=='04')
	 {
	
	  @$frais_4=$frais_4+ $cleRc_P['COMM'];
	 }
	 
	
   if($mois=='05')
	 {
	
	  @$frais_5=$frais_5+ $cleRc_P['COMM'];
	 }
	 
	 
   if($mois=='06')
	 {
	
	  @$frais_6=$frais_6+ $cleRc_P['COMM'];
	 }
	 
	 /************/
	 
   if($mois=='07')
	 {
	
	  @$frais_7=$frais_7+ $cleRc_P['COMM'];
	 }
	 
	 /************/
	 
   if($mois=='08')
	 {
	
	 @ $frais_8=$frais_8+ $cleRc_P['COMM'];
	 }
	 
	 /************/
	 	
   if($mois=='09')
	 {
	
	  @$frais_9=$frais_9+ $cleRc_P['COMM'];
	 }
	 
	 /************/
	 	 
   if($mois=='10')
	 {
	
	  @$frais_10=$frais_10+ $cleRc_P['COMM'];
	 }
	 
	 /************/
	 	
   if($mois=='11')
	 {
	
	  @$frais_11=$frais_11+ $cleRc_P['COMM'];
	 }
	 
	 /************/
	 	
   if($mois=='12')
	 {
	
	  @$frais_12=$frais_12+ $cleRc_P['COMM'];
	 }
	 
	 /************/
  }
	}
	}
	//TAble Facture
	
include 'classes/Facture.class.php';
	$fc=new Factures();
	$res_Factures=$fc->getResFacture();
	$mantants_1=0;$mantantsR_1=0;$mantantsPonctFacture_1=0;
	$mantants_2=0;$mantantsR_2=0;$mantantsPonctFacture_2=0;
	$mantants_3=0;$mantantsR_3=0;$mantantsPonctFacture_3=0;
	$mantants_4=0;$mantantsR_4=0;$mantantsPonctFacture_4=0;
	$mantants_5=0;$mantantsR_5=0;$mantantsPonctFacture_5=0;
	$mantants_6=0;$mantantsR_6=0;$mantantsPonctFacture_6=0;
	$mantants_7=0;$mantantsR_7=0;$mantantsPonctFacture_7=0;
	$mantants_8=0;$mantantsR_8=0;$mantantsPonctFacture_8=0;
	$mantants_9=0;$mantantsR_9=0;$mantantsPonctFacture_9=0;
	$mantants_10=0;$mantantsR_10=0;$mantantsPonctFacture_10=0;
	$mantants_11=0;$mantantsR_11=0;$mantantsPonctFacture_11=0;
	$mantants_12=0;$mantantsR_12=0;$mantantsPonctFacture_12=0;
	
	foreach($res_Factures as $cleF)
	{
	  $dlm=explode('-',$cleF['envoye']);
	 @$date=$dlm[0];
	 @$mois=$dlm[1];
	 $moisAn=$date.'-'.$mois;
	  if($_POST['annee']==$date)
	 {
		 if($mois=='01' )
		 {
			 
		 $mantants_1=$mantants_1+ $cleF['mantant'];
		
		 }
		 else  if($mois=='02' )
		 {
		 $mantants_2=$mantants_2+ $cleF['mantant'];
		 }
		 else  if($mois=='03' )
		 {
		 $mantants_3=$mantants_3+ $cleF['mantant'];
		 }
		 else  if($mois=='04' )
		 {
		 $mantants_4=$mantants_4+ $cleF['mantant'];
		 }
		 else  if($mois=='05' )
		 {
		 $mantants_5=$mantants_5+ $cleF['mantant'];
		 }
		 else  if($mois=='06' )
		 {
		 $mantants_6=$mantants_6+ $cleF['mantant'];
		 }
		 else  if($mois=='07' )
		 {
		 $mantants_7=$mantants_7+ $cleF['mantant'];
		 }
		 else  if($mois=='08' )
		 {
		 $mantants_8=$mantants_8+ $cleF['mantant'];
		 }
		 else  if($mois=='09' )
		 {
		 $mantants_9=$mantants_9+ $cleF['mantant'];
		 }
		 else  if($mois=='10' )
		 {
		 $mantants_10=$mantants_10+ $cleF['mantant'];
		 }
		 else  if($mois=='11' )
		 {
		 $mantants_11=$mantants_11+ $cleF['mantant'];
		 }
		 else  if($mois=='12' )
		 {
		 $mantants_12=$mantants_12+ $cleF['mantant'];
		 }
	 
	 
	//Facture Recouvrement
	$dlmR=explode('-',$cleF['recouvre']);
	 @$dateR=$dlmR[0];
	 @$moisR=$dlmR[1];
	 $moisAnR=$dateR.'-'.$moisR;
	 if($moisR=='01')
	 {
	 
	 $mantantsR_1=$mantantsR_1+ $cleF['mantant'];
	
	 
	 }
	 if($moisR=='01' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_1=$mantantsPonctFacture_1+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='02')
	 {
	 
	 $mantantsR_2=$mantantsR_2+ $cleF['mantant'];
	 
	 }
	 if($moisR=='02' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_2=$mantantsPonctFacture_2+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='03')
	 {
	 
	 $mantantsR_3=$mantantsR_3+ $cleF['mantant'];
	 
	 }
	 if($moisR=='03' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_3=$mantantsPonctFacture_3+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='04')
	 {
	 
	 $mantantsR_4=$mantantsR_4+ $cleF['mantant'];
	 
	 }
	 if($moisR=='04' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_4=$mantantsPonctFacture_4+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='05')
	 {
	 
	 $mantantsR_5=$mantantsR_5+ $cleF['mantant'];
	 
	 }
	 if($moisR=='05' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_6=$mantantsPonctFacture_6+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='07')
	 {
	 
	 $mantantsR_7=$mantantsR_7+ $cleF['mantant'];
	 
	 }
	 if($moisR=='07' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_7=$mantantsPonctFacture_7+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='08')
	 {
	 
	 $mantantsR_8=$mantantsR_8+ $cleF['mantant'];
	 
	 }
	 if($moisR=='08' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_8=$mantantsPonctFacture_8+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='09')
	 {
	 
	 $mantantsR_9=$mantantsR_9+ $cleF['mantant'];
	 
	 }
	 if($moisR=='09' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_9=$mantantsPonctFacture_9+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='10')
	 {
	 
	 $mantantsR_10=$mantantsR_10+ $cleF['mantant'];
	 
	 }
	 if($moisR=='10' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_10=$mantantsPonctFacture_10+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='11')
	 {
	 
	 $mantantsR_11=$mantantsR_11+ $cleF['mantant'];
	 
	 }
	 if($moisR=='11' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_11=$mantantsPonctFacture_11+ $cleF['mantant'];
	 }
	 /**************/
	  if($moisR=='12')
	 {
	 
	 $mantantsR_12=$mantantsR_12+ $cleF['mantant'];
	 
	 }
	 if($moisR=='12' && $cleF['codeAO']=='Ponct')
	 {
	 
	
	  $mantantsPonctFacture_12=$mantantsPonctFacture_12+ $cleF['mantant'];
	 }
	 /**************/
	 
	 
	 
}
	 
	}

//Table dépence 

include 'classes/dep.class.php';
	$dep=new Deps();
	$res_deps=$dep->getRec_Deps();
	
		
	$depense_1=0;$depense_2=0;$depense_3=0;$depense_4=0;$depense_5=0;$depense_6=0;$depense_7=0;$depense_8=0;$depense_9=0;$depense_10=0;
	$depense_11=0;$depense_12=0;
	if($res_deps!=null){
	foreach($res_deps as $cleDeps)
	{
	  $dlm=explode('-',$cleDeps['DATE']);
	 @$date=$dlm[0];
	 @$mois=$dlm[1];
	 $moisAn=$date.'-'.$mois;
	  if($_POST['annee']==$date)
	 {
	 if($mois=='01' )
	 {
	 $depense_1=$depense_1+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='02' )
	 {
	 $depense_2=$depense_2+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='03' )
	 {
	 $depense_3=$depense_3+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='04' )
	 {
	 $depense_4=$depense_4+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='05' )
	 {
	 $depense_5=$depense_5+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='06' )
	 {
	 $depense_6=$depense_6+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='07' )
	 {
	 $depense_7=$depense_7+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='08' )
	 {
	 $depense_8=$depense_8+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='09' )
	 {
	 $depense_9=$depense_9+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='10' )
	 {
	 $depense_10=$depense_10+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='11' )
	 {
	 $depense_11=$depense_11+ $cleDeps['Montant'];
	
	 }
	 else  if($mois=='12' )
	 {
	 $depense_12=$depense_12+ $cleDeps['Montant'];
	
	 }
   }

	}
}
	
}
?>
<table>
<tr>
<form method="post">
<th>


<input list="annee" name="annee"   >
						 <datalist id="annee">

<option>2018
<option>2019
<option>2020
<option>2021
</datalist>
</th>
<th>
<input type="submit" name="ok"/>
</th>
</tr>

</form>
<!--
<tr>
<th>
<form method="post" action="sigma.php?AO_Affiche">
<input type="submit" value="Retour"/>

</form>
</th>-->
</tr></table>
<?php 



if(isset($_POST['ok']))
{
 /*/*if($_POST['code']=='code123')
 {
 $annee=$_POST['annee'];
 $_POST['annee']= $annee;*/

?>
<table width=100% align=center border=1>

<tr><th>Mois</th><th>Nbre Offre<br> Public</th><th>Offre Public<br>Retenue</th><th>Total Offre<br>Public</th><th >Honoraire Offre<br>Retenue</th>
<th>H.Ponct <br>sans Offre</th><th>Frais</th><th>Recv.P<br>Sans Facture</th><th>Facture <br>Envoyer</th><th>Facture <br>Recouvrée</th><th>Facture <br>Ponct.Rec</th><th bgcolor=red>Facture <br>Impayé</th> <th>Autre Fact <br>Envoyée</th>
 <th>Autre Fact <br>Recouvrée</th><th>Recette</th><th>Dépence</th><th>Bénifice</th></tr>

<tr>

<th>01/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_1?></th><th><?php echo $nboffreRetenue_1?></th>
<th><?php echo $HonoTotal_1?></th>
<th><?php echo $HonoTotalRetenue_1?></th>
<th><?php echo $HonoPonct_1?></th><th><?php echo $frais_1?></th><th><?php echo $recouvrementRC_1?></th>
<th><?php echo $mantants_1?></th><th><?php echo $mantantsR_1?></th>
<th><?php echo $mantantsPonctFacture_1?></th>
<th><?php echo $mantants_1-$mantantsR_1?></th>
<th><?php echo $autreFEnvoye_1?></th><th><?php echo $autreFRecouvre_1?></th>
<th><?php echo $recouvrementRC_1+$mantantsR_1+$autreFRecouvre_1?></th>
<th><?php echo $depense_1?></th>
<th><?php echo ($recouvrementRC_1+$mantantsR_1+$autreFRecouvre_1)-$depense_1?></th>
</tr>

<th>02/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_2?></th><th><?php echo $nboffreRetenue_2?></th>
<th><?php echo $HonoTotal_2?></th>
<th><?php echo $HonoTotalRetenue_2?></th>
<th><?php echo $HonoPonct_2?></th><th><?php echo $frais_2?></th><th><?php echo $recouvrementRC_2?></th>
<th><?php echo $mantants_2?></th><th><?php echo $mantantsR_2?></th>
<th><?php echo $mantantsPonctFacture_2?></th>
<th><?php echo $mantants_2-$mantantsR_2?></th>
<th><?php echo $autreFEnvoye_2?></th><th><?php echo $autreFRecouvre_2?></th>
<th><?php echo $recouvrementRC_2+$mantantsR_2+$autreFRecouvre_2?></th>
<th><?php echo $depense_2?></th>
<th><?php echo ($recouvrementRC_2+$mantantsR_2+$autreFRecouvre_2)-$depense_2?></th>
</tr>

<th>03/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_3?></th><th><?php echo $nboffreRetenue_3?></th><th><?php echo $HonoTotal_3?></th>
<th><?php echo $HonoTotalRetenue_3?></th>
<th><?php echo $HonoPonct_3?></th><th><?php echo $frais_3?></th><th><?php echo $recouvrementRC_3?></th><th><?php echo $mantants_3?></th><th><?php echo $mantantsR_3?></th>
<th><?php echo $mantantsPonctFacture_3?></th>
<th><?php echo $mantants_3-$mantantsR_3?></th>
<th><?php echo $autreFEnvoye_3?></th><th><?php echo $autreFRecouvre_3?></th>
<th><?php echo $recouvrementRC_2+$mantantsR_3+$autreFRecouvre_3?></th>
<th><?php echo $depense_3?></th>
<th><?php echo ($recouvrementRC_3+$mantantsR_3+$autreFRecouvre_3)-$depense_3?></th>
</tr>

<th>04/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_4?></th><th><?php echo $nboffreRetenue_4?></th><th><?php echo $HonoTotal_4?></th>
<th><?php echo $HonoTotalRetenue_4?></th>
<th><?php echo $HonoPonct_4?></th><th><?php echo $frais_4?></th><th><?php echo $recouvrementRC_4?></th><th><?php echo $mantants_4?></th><th><?php echo $mantantsR_4?></th>
<th><?php echo $mantantsPonctFacture_4?></th><th><?php echo $mantants_4-$mantantsR_4?></th>
<th><?php echo $autreFEnvoye_4?></th><th><?php echo $autreFRecouvre_4?></th>
<th><?php echo $recouvrementRC_4+$mantantsR_4+$autreFRecouvre_4?></th>
<th><?php echo $depense_4?></th>
<th><?php echo ($recouvrementRC_4+$mantantsR_4+$autreFRecouvre_4)-$depense_4?></th>
</tr>

<th>05/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_5?></th><th><?php echo $nboffreRetenue_5?></th><th><?php echo $HonoTotal_5?></th>
<th><?php echo $HonoTotalRetenue_5?></th>
<th><?php echo $HonoPonct_5?></th><th><?php echo $frais_5?></th><th><?php echo $recouvrementRC_5?></th><th><?php echo $mantants_5?></th><th><?php echo $mantantsR_5?></th>
<th><?php echo $mantantsPonctFacture_5?></th><th><?php echo $mantants_5-$mantantsR_5?></th>
<th><?php echo $autreFEnvoye_5?></th><th><?php echo $autreFRecouvre_5?></th>
<th><?php echo $recouvrementRC_5+$mantantsR_5+$autreFRecouvre_5?></th>
<th><?php echo $depense_5?></th>
<th><?php echo ($recouvrementRC_5+$mantantsR_5+$autreFRecouvre_5)-$depense_5?></th>
</tr>

<th>06/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_6?></th><th><?php echo $nboffreRetenue_6?></th><th><?php echo $HonoTotal_6?></th>
<th><?php echo $HonoTotalRetenue_6?></th>
<th><?php echo $HonoPonct_6?></th><th><?php echo $frais_6?></th><th><?php echo $recouvrementRC_6?></th><th><?php echo $mantants_6?></th><th><?php echo $mantantsR_6?></th>
<th><?php echo $mantantsPonctFacture_6?></th><th><?php echo $mantants_6-$mantantsR_6?></th>
<th><?php echo $autreFEnvoye_6?></th><th><?php echo $autreFRecouvre_6?></th>
<th><?php echo $recouvrementRC_6+$mantantsR_6+$autreFRecouvre_6?></th>
<th><?php echo $depense_6?></th>
<th><?php echo ($recouvrementRC_6+$mantantsR_6+$autreFRecouvre_6)-$depense_6?></th>
</tr>

<th>07/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_7?></th><th><?php echo $nboffreRetenue_7?></th><th><?php echo $HonoTotal_7?></th>
<th><?php echo $HonoTotalRetenue_7?></th>
<th><?php echo $HonoPonct_7?></th><th><?php echo $frais_7?></th><th><?php echo $recouvrementRC_5?></th><th><?php echo $mantants_7?></th><th><?php echo $mantantsR_7?></th>
<th><?php echo $mantantsPonctFacture_7?></th><th><?php echo $mantants_7-$mantantsR_7?></th>
<th><?php echo $autreFEnvoye_7?></th><th><?php echo $autreFRecouvre_7?></th>
<th><?php echo $recouvrementRC_7+$mantantsR_7+$autreFRecouvre_7?></th>
<th><?php echo $depense_7?></th>
<th><?php echo ($recouvrementRC_7+$mantantsR_7+$autreFRecouvre_7)-$depense_7?></th>
</tr>

<th>08/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_8?></th><th><?php echo $nboffreRetenue_8?></th><th><?php echo $HonoTotal_8?></th>
<th><?php echo $HonoTotalRetenue_8?></th>
<th><?php echo $HonoPonct_8?></th><th><?php echo $frais_8?></th><th><?php echo $recouvrementRC_8?></th><th><?php echo $mantants_8?></th><th><?php echo $mantantsR_8?></th>
<th><?php echo $mantantsPonctFacture_8?></th><th><?php echo $mantants_8-$mantantsR_8?></th>
<th><?php echo $autreFEnvoye_8?></th><th><?php echo $autreFRecouvre_8?></th>
<th><?php echo $recouvrementRC_8+$mantantsR_8+$autreFRecouvre_8?></th>
<th><?php echo $depense_8?></th>
<th><?php echo ($recouvrementRC_8+$mantantsR_8+$autreFRecouvre_8)-$depense_8?></th>
</tr>

<th>09/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_9?></th><th><?php echo $nboffreRetenue_9?></th><th><?php echo $HonoTotal_9?></th>
<th><?php echo $HonoTotalRetenue_9?></th>
<th><?php echo $HonoPonct_9?></th><th><?php echo $frais_9?></th><th><?php echo $recouvrementRC_9?></th><th><?php echo $mantants_9?></th><th><?php echo $mantantsR_9?></th>
<th><?php echo $mantantsPonctFacture_9?></th><th><?php echo $mantants_9-$mantantsR_9?></th>
<th><?php echo $autreFEnvoye_9?></th><th><?php echo $autreFRecouvre_9?></th>
<th><?php echo $recouvrementRC_9+$mantantsR_9+$autreFRecouvre_9?></th><th><?php echo $depense_9?></th>
<th><?php echo ($recouvrementRC_9+$mantantsR_9+$autreFRecouvre_9)-$depense_9?></th>
</tr>
<tr>

<th>10/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_10?></th><th><?php echo $nboffreRetenue_10?></th><th><?php echo $HonoTotal_10?></th>
<th><?php echo $HonoTotalRetenue_10?></th>
<th><?php echo $HonoPonct_10?></th><th><?php echo $frais_10?></th><th><?php echo $recouvrementRC_10?></th><th><?php echo $mantants_10?></th><th><?php echo $mantantsR_10?></th>
<th><?php echo $mantantsPonctFacture_10?></th><th><?php echo $mantants_10-$mantantsR_10?></th>
<th><?php echo $autreFEnvoye_10?></th><th><?php echo $autreFRecouvre_10?></th>
<th><?php echo $recouvrementRC_10+$mantantsR_10+$autreFRecouvre_10?></th><th><?php echo $depense_10?></th>
<th><?php echo ($recouvrementRC_10+$mantantsR_10+$autreFRecouvre_10)-$depense_10?></th>
</tr>
<tr>

<th>11/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_11?></th><th><?php echo $nboffreRetenue_11?></th><th><?php echo $HonoTotal_11?></th>
<th><?php echo $HonoTotalRetenue_11?></th>
<th><?php echo $HonoPonct_11?></th><th><?php echo $frais_11?></th><th><?php echo $recouvrementRC_11?></th><th><?php echo $mantants_11?></th><th><?php echo $mantantsR_11?></th>
<th><?php echo $mantantsPonctFacture_11?></th><th><?php echo $mantants_11-$mantantsR_11?></th>
<th><?php echo $autreFEnvoye_11?></th><th><?php echo $autreFRecouvre_11?></th>
<th><?php echo $recouvrementRC_11+$mantantsR_11+$autreFRecouvre_11?></th><th><?php echo $depense_11?></th>
<th><?php echo ($recouvrementRC_11+$mantantsR_11+$autreFRecouvre_11)-$depense_11?></th>
</tr>
<tr>

<th>12/<?php echo $_POST['annee']?></th><th><?php echo $nboffreTotal_12?></th><th><?php echo $nboffreRetenue_12?></th><th><?php echo $HonoTotal_12?></th>
<th><?php echo $HonoTotalRetenue_12?></th>
<th><?php echo $HonoPonct_12?></th><th><?php echo $frais_12?></th><th><?php echo $recouvrementRC_12?></th><th><?php echo $mantants_12?></th><th><?php echo $mantantsR_12?></th>
<th><?php echo $mantantsPonctFacture_12?></th><th><?php echo $mantants_12-$mantantsR_12?></th>
<th><?php echo $autreFEnvoye_12?></th><th><?php echo $autreFRecouvre_12?></th>
<th><?php echo $recouvrementRC_12+$mantantsR_12+$autreFRecouvre_12?></th><th><?php echo $depense_12?></th>
<th><?php echo ($recouvrementRC_12+$mantantsR_12+$autreFRecouvre_12)-$depense_12?></th>
</tr>
<tr>
<?php
$somme_nbOffre=$nboffreTotal_1+$nboffreTotal_2+$nboffreTotal_3+$nboffreTotal_4+$nboffreTotal_5+$nboffreTotal_6+$nboffreTotal_7
+$nboffreTotal_8+$nboffreTotal_9+$nboffreTotal_10+$nboffreTotal_11+$nboffreTotal_12;

$somme_Retenues=$nboffreRetenue_1+$nboffreRetenue_2+$nboffreRetenue_3+$nboffreRetenue_4+$nboffreRetenue_5+$nboffreRetenue_6+$nboffreRetenue_7+$nboffreRetenue_8+$nboffreRetenue_9+$nboffreRetenue_10+$nboffreRetenue_11+$nboffreRetenue_12;

$somme_HonoTotal=$HonoTotal_1+$HonoTotal_2+$HonoTotal_3+$HonoTotal_4+$HonoTotal_5+$HonoTotal_6+$HonoTotal_7+$HonoTotal_8+$HonoTotal_9+$HonoTotal_10+$HonoTotal_11+$HonoTotal_12;

$somme_HonoRetenue=$HonoTotalRetenue_1+$HonoTotalRetenue_2+$HonoTotalRetenue_3+$HonoTotalRetenue_4+$HonoTotalRetenue_5+$HonoTotalRetenue_6+$HonoTotalRetenue_7+$HonoTotalRetenue_8+$HonoTotalRetenue_9+$HonoTotalRetenue_10+$HonoTotalRetenue_11+$HonoTotalRetenue_12;

$somme_HonoPonct=$HonoPonct_1+$HonoPonct_2+$HonoPonct_3+$HonoPonct_4+$HonoPonct_5+$HonoPonct_6+$HonoPonct_7+$HonoPonct_8+$HonoPonct_9+$HonoPonct_10+$HonoPonct_11+$HonoPonct_12;

$somme_Frais=$frais_1+$frais_2+$frais_3+$frais_4+$frais_5+$frais_6+$frais_7+$frais_8+$frais_9+$frais_10+$frais_11+$frais_12;

$somme_RecP=$recouvrementRC_1+$recouvrementRC_2+$recouvrementRC_3+$recouvrementRC_4+$recouvrementRC_5+$recouvrementRC_6+$recouvrementRC_7+$recouvrementRC_8+$recouvrementRC_9+$recouvrementRC_10+$recouvrementRC_11+$recouvrementRC_12;

$somme_FactureEnvoye=$mantants_1+$mantants_2+$mantants_3+$mantants_4+$mantants_5+$mantants_6+$mantants_7+$mantants_8+$mantants_9+$mantants_10+$mantants_11+$mantants_12;

$somme_FactureRecTot=$mantantsR_1+$mantantsR_2+$mantantsR_3+$mantantsR_4+$mantantsR_5+$mantantsR_6+$mantantsR_7+$mantantsR_8+$mantantsR_9+$mantantsR_10+$mantantsR_11+$mantantsR_12;

$somme_RecetteTot=($recouvrementRC_1+$mantantsR_1+$autreFRecouvre_1)+($recouvrementRC_2+$mantantsR_2+$autreFRecouvre_2)
+($recouvrementRC_3+$mantantsR_3+$autreFRecouvre_3)+($recouvrementRC_4+$mantantsR_4+$autreFRecouvre_4)+($recouvrementRC_5+$mantantsR_5+$autreFRecouvre_5)+($recouvrementRC_6+$mantantsR_6+$autreFRecouvre_6)+($recouvrementRC_7+$mantantsR_7+$autreFRecouvre_7)+($recouvrementRC_8+$mantantsR_8+$autreFRecouvre_8)+($recouvrementRC_9+$mantantsR_9+$autreFRecouvre_9)+($recouvrementRC_10+$mantantsR_10+$autreFRecouvre_10)+($recouvrementRC_11+$mantantsR_11+$autreFRecouvre_11)+($recouvrementRC_12+$mantantsR_12+$autreFRecouvre_12);

$somme_Depense=$depense_1+$depense_2+$depense_3+$depense_4+$depense_5+$depense_6+$depense_7+$depense_8+$depense_9+$depense_10+$depense_11+$depense_12;

$somme_Benifice=((($recouvrementRC_1+$mantantsR_1)-$frais_1)-$depense_1)+((($recouvrementRC_2+$mantantsR_2)-$frais_2)-$depense_2)+((($recouvrementRC_3+$mantantsR_3)-$frais_3)-$depense_3)+((($recouvrementRC_4+$mantantsR_4)-$frais_4)-$depense_4)+((($recouvrementRC_5+$mantantsR_5)-$frais_5)-$depense_5)+((($recouvrementRC_6+$mantantsR_6)-$frais_6)-$depense_6)+((($recouvrementRC_7+$mantantsR_7)-$frais_7)-$depense_7)+((($recouvrementRC_8+$mantantsR_8)-$frais_8)-$depense_8)+((($recouvrementRC_9+$mantantsR_9)-$frais_9)-$depense_9)+((($recouvrementRC_10+$mantantsR_10)-$frais_10)-$depense_10)+((($recouvrementRC_11+$mantantsR_11)-$frais_11)-$depense_11)+((($recouvrementRC_12+$mantantsR_12)-$frais_12)-$depense_12);
?>
<tr><th></th><th colspan=2>CONVENTION</th>
<th></th>
<th colspan=2>CHIFFRE D'AFFAIRE</th>
<th colspan=2></th>
<th colspan=2>TOTAL FACTURE</th>
<th colspan=4></th>
<th >TOTAL RECETTE</th>
<th >TOTAL DEPENSE</th>
<th>TOTAL BENIFICE</th>
</tr>
<tr><th>TOTAUX</th><th><?php echo $somme_nbOffre?></th><th><?php echo $somme_Retenues?></th>
<th><?php echo $somme_HonoTotal?></th><th><?php echo $somme_HonoRetenue?></th><th><?php echo $somme_HonoPonct?></th>
<th><?php echo $somme_Frais?></th><th><?php echo $somme_RecP?></th><th><?php echo $somme_FactureEnvoye?></th>
<th><?php echo $somme_FactureRecTot?></th>
<th colspan=4></th>
<th ><?php echo $somme_RecetteTot?></th>
<th ><?php echo $somme_Depense?></th>
<th><?php echo $somme_Benifice?></th>
</tr>
<tr><th colspan="15" align="right"><span onclick="window.print()">Imprimer</span></tr>
<?php }   ?>







</table>