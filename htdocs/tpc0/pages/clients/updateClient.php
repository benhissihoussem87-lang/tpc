<?php 
include '../../class/client.class.php';
// Modifier
var_dump($_FILES);
echo '<h1> Convention == '.$_FILES['piececonvention']['name'].'</h1>';
	if($clt->Modifier(@$_POST['type'],@$_POST['convention'],@$_FILES['piececonvention']['name'],@$_POST['nom'],@$_POST['code'],@$_POST['adresse'],@$_POST['matriculeFiscale'],@$_POST['exonoration'],@$_FILES['pieceExonoration']['name'],@$_POST['tel'],@$_POST['email'],@$_POST['numexonoration'],@$_POST['ValiditeExonoration'],@$_POST['idClient']))
	{
	
		if($_FILES['pieceExonoration']['name']!=''){
	copy($_FILES['pieceExonoration']['tmp_name'],'pieceExonorationClients/'.$_FILES['pieceExonoration']['name']);
		}
		if($_FILES['piececonvention']['name']!=''){
	@copy($_FILES['piececonvention']['tmp_name'],'pieceConventionClients/'.$_FILES['piececonvention']['name']);
		}
		echo "<script>document.location.href='/tpc/main.php?Gestion_Clients'</script>";
		}
else {echo "<script>alert('Erreur !!! ')</script>";}
?>