<?php
session_start();
if(!isset($_SESSION['user']))
{
 header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIGMA: Accueil</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
<!-- Bootstrap core JavaScript-->

    <script src="vendor/jquery/jquery.min.js"></script>
	 <script src="js/factures.js"></script>
	<script src="js/AO_Ajout.js"></script>
	<script src="js/calcul.js"></script>
	<script src="js/pourcentageFacture.js"></script>
	<script src="js/Facture_Recouvrement.js"></script>
	<!--<script src="js/facture.js"></script>-->
	<script src="js/Ajax.js"></script>
	<script src="js/AjaxMDO.js"></script>
	<script src="js/AjaxBordero.js"></script>
	<script src="js/bordero.js"></script>
	<script src="js/autres.js"></script>
	<script src="js/titre.js"></script>
	<script src="js/OP.js"></script>
		<script src="js/AjaxSousProjet.js"></script>
		<script src="js/VerifAjaxSP.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
  
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
	 <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
   <script src="js/AjoutMdo.js"></script>
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

     

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="deconnexion.php" data-toggle="modal" data-target="#logoutModal">Déconnexion</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper" >

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav"  >
        <li class="nav-item" style="padding-bottom:20px">
          <a class="nav-link" href="?P_Affiche">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AO_Affiche" id="pagesDropdown" >
            
            <span>OFFRE PRIX</span>
          </a>
          
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?P_Affiche">
            
            <span>PROJETS</span>
          </a>
          
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?Partenaire_Afficher">
            
            <span>PARTENAIRES</span>
          </a>
          
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?Arrive_Afficher">
           
            <span>ARRIVES</span>
          </a>
          
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?Sortie_Afficher&redirect=SS" >
            
            <span>SORTIES</span>
          </a>
          
        </li>
        
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?CR_Afficher" >
            
            <span>C.R.VISITES</span>
          </a>
          
        </li>
		<?php if($_SESSION['user']=='Admin' or $_SESSION['user']=='Admin2')
		{ ?>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherFacturation" >
            
            <span>FACTURATION</span>
          </a>
          
        </li>
		<?php } ?>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherFacture&factures" >
            
            <span>FACTURES</span>
          </a>
          
        </li>
		<?php if($_SESSION['user']=='Admin' or $_SESSION['user']=='Admin2' )
		{ ?>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherAutres_Facture&FactureNews" >
            
            <span>Autres FACTURES</span>
          </a>
		<?php } ?>
          
        </li>
	
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherPonctuel" >
            
            <span>PONCTUELS</span>
          </a>
          
        </li>
		
		
		<?php if($_SESSION['user']=='Admin' or $_SESSION['user']=='Admin2')
		{ ?>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherRECP" >
            
            <span>RECOUV.P</span>
          </a>
          
        </li>
		<?php }
		if($_SESSION['user']=='Admin')
		{ ?>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherDep" >
            
            <span>DEPENSES</span>
          </a>
          
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherCHSTB" >
            
            <span>CHQ STB</span>
          </a>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="?AfficherCHBaraka" >
            
            <span>CHQ BARAKA</span>
          </a>
          
        </li>
		
  
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="resultat.php" >
            
            <span>RESULTAT</span>
          </a>
          
        </li>
		<?php } ?>
        
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          

          <!-- Page Content -->
          
          <?php 
		  include 'classes/appel_offres.class.php';
		    include 'classes/projets.class.php';
			 include 'classes/partenaires.class.php';
			 include 'classes/arrives.class.php';
			 include 'classes/sorties.class.php';
			 include 'classes/cr.class.php';
			  include 'classes/bordero.class.php';
			   include 'classes/Facture.class.php';
			   include 'classes/ponctuel.class.php';
			    include 'classes/Rec_ponctuel.class.php';
			include 'classes/dep.class.php';
			include 'classes/cheques.class.php';
			include 'classes/Autres_Facture.class.php';
		  $AO=new offres();
		  $projet=new Projets();
		   $partenaires=new Partenaires();
		   $arrive=new Arrives();
		   $sortie=new Sorties();
			    $cr=new CRS();
			$borderos=new Borderos();
			$facture=new Factures();
			$Autresfacture=new AutresFactures();
			$ponct=new ponctuels();
			$dep=new Deps();
			$recP=new Rec_ponctuel();
			$ch=new Cheques();
		
		  if(isset($_GET['AO_Ajout']))
		  {
		   include 'Appel_offres/Ajout_AO.php';
		  }
		  else if(isset($_GET['P_Ajout']))
		  {
		   include 'Projets/Ajout_P.php';
		  }
		  else if(isset($_GET['P_Affiche']))
		  {
		   if(isset($_GET['P_modifier']))
			{
			include 'Projets/Projet_Modifier.php';
			}
			else
			{
		   
		   include 'Projets/getProjets.php';
		   }
		  }
		  
		  else if(isset($_GET['AO_Affiche']))
		  {
		    if(isset($_GET['AO_modifier']))
			{
			include 'Appel_offres/Modifier_AO.php';
			}
			else
			{
		   include 'Appel_offres/getAppelsOffres.php';
		   }
		  }
		  
		  else if(isset($_GET['Partenaire_Ajout']))
		  {
		   include 'Partenaires/AjoutPartenaire.php';
		  }
		  else if(isset($_GET['Partenaire_Afficher']))
		  {
		   if(isset($_GET['id_modifier']))
		   {
		   include 'Partenaires/PartenaireModifier.php';
		   }
		   else
		   {
		   include 'Partenaires/getPartenaires.php';
		   }
		  }
		  
		  else if(isset($_GET['Arrive_Ajout']))
		  {
		   include 'Arrives/AjoutArrive.php';
		  }
		   else if(isset($_GET['CR_Ajouter']))
		  {
		   include 'CR_Visite/AjouterCR.php';
		  }
		  else if(isset($_GET['Arrive_Afficher']))
		  {
		   if(isset($_GET['id_modifier']))
		   {
		   include 'Arrives/ModifierArrive.php';
		   }
		   else
		   {
		   include 'Arrives/AfficherArrive.php';
		   }
		  }
		  else if(isset($_GET['ARP']) or isset($_GET['ARPonctuel']) )
		  {
		     include 'Arrives/AjoutArriveProjets.php';
		  }
		  
		  else if(isset($_GET['Sortie_Ajout'])or isset($_GET['SRP']) or isset($_GET['SRPonct'])  )
		  {
		   include 'Sortie/AjoutSortie.php';
		  }
		  else if(isset($_GET['Sortie_Afficher']))
		  {
		   if(isset($_GET['id_modifier']))
		   {
		   include 'Sortie/ModifierSortie.php';
		   }
		   else
		   {
		   include 'Sortie/AfficherSortie.php';
		   }
		  }
		  
		  
		  
		  else if(isset($_GET['CR_Ajout']))
		  {
		   include 'CR_Visite/AjoutCR.php';
		  }
		  else if(isset($_GET['CR_Afficher']))
		  {
		   if(isset($_GET['id_modifier']))
		   {
		   include 'CR_Visite/ModifierCR.php';
		   }
		   else
		   {
		   include 'CR_Visite/AfficherCR.php';
		   }
		  }
		  //Sous-projet
		  
		  else if(isset($_GET['SOUSP_Ajout']))
		  {
		   include 'Projets/AjoutSousProjet.php';
		  }
		  
		  else if(isset($_GET['SPAffiche']))
		  {
		   include 'Projets/getSProjets.php';
		  }
		  
		  //Facture
		  
		  else if(isset($_GET['Facture_Ajout']))
		  {
		   include 'Facture/AjoutFacture.php';
		  }
		   else if(isset($_GET['Facture_Modifier']))
		  {
		   include 'Facture/ModifierFacture.php';
		  }
		  else if(isset($_GET['Facture_ModifierAutres']))
		  {
		   include 'FactureNews/ModifierAutreFacture.php';
		  }
		  else if(isset($_GET['AfficherFacture']))
		  {
		   include 'Facture/AfficherFacture.php';
		  }
		  else if(isset($_GET['AfficherAutres_Facture']))
		  {
		   include 'FactureNews/AfficherAutresFacture.php';
		  }
		  
		  //Facturation
		  
		  else if(isset($_GET['Facturation_Ajout']))
		  {
		   include 'Facturation/Ajout.php';
		  }
		  
		  
		  else if(isset($_GET['AfficherFacturation']))
		  {
		   include 'Facturation/Afficher.php';
		  }
		  
		  //Ponctuel
		  
		  else if(isset($_GET['ponctuel_Ajout']))
		  {
		   include 'ponctuel/Ajout_poncteul.php';
		  }
		  
		  
		  else if(isset($_GET['AfficherPonctuel']))
		  {
		   include 'ponctuel/Afficher.php';
		  }
		  else if(isset($_GET['ModifierPonctuel']))
		  {
		   include 'ponctuel/Modifier_Ponctuel.php';
		  }
		  
		   //Deps
		  
		  else if(isset($_GET['dep_Ajout']))
		  {
		   include 'dep/Ajout_dep.php';
		  }
		  
		  
		  else if(isset($_GET['AfficherDep']))
		  {
		   include 'dep/Afficher.php';
		  }
		  else if(isset($_GET['ModifierDep']))
		  {
		   include 'dep/Modifier_Dep.php';
		  }
		  
		  //Rec Ponctuel
		  
		  else if(isset($_GET['recP_Ajout']))
		  {
		   include 'RECP/Ajout_RECP.php';
		  }
		  
		  
		  else if(isset($_GET['AfficherRECP']))
		  {
		   include 'RECP/Afficher.php';
		  }
		  else if(isset($_GET['ModifierRECP']))
		  {
		   include 'RECP/Modifier_RECP.php';
		  }
		  
		  //Gestion Cheques
		  
		  else if(isset($_GET['ch_Ajout']))
		  {
		   include 'Cheques/AjoutCheque.php';
		  }
		  else if(isset($_GET['AfficherCHSTB']))
		  {
		   include 'Cheques/getChequesSTB.php';
		  }
		  else if(isset($_GET['AfficherCHBaraka']))
		  {
		   include 'Cheques/getChequesBaraka.php';
		  }
		  else if(isset($_GET['ModifierCH']))
		  {
		   include 'Cheques/ModifierCheque.php';
		  }
		  
		  ?>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Sigma 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Déconnexion?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Voulez-vous déconnecter</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <a class="btn btn-primary" href="deconnexion.php">Déconnexion</a>
          </div>
        </div>
      </div>
    </div>
	
	

    
  </body>

</html>
