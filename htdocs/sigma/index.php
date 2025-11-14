<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Sigma</title>
	<link rel="stylesheet" href="css/home.css"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
<?php session_start();?>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="post">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="login" class="form-control input_user" value="" placeholder="username" autofocus>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="mdp" class="form-control input_pass" value="" placeholder="password">
						</div>
						
					
				</div>
				<div class="d-flex justify-content-center mt-3 login_container">
					<button type="submit" name="button" class="btn login_btn">Connexion</button>
				</div>
				</form>
				<?php
				  if(isset($_POST['button']))
				  {
				  if($_POST['login']=='tpc' and $_POST['mdp']=='code405')
				  {
				   $_SESSION['user']="Admin";
				   header("location:sigma.php?P_Affiche");
				  }
				  else if($_POST['login']=='sigma' and $_POST['mdp']=='123')
				  {
				   $_SESSION['user']="Admin2";
				   header("location:sigma.php?P_Affiche");
				  }
				  else if($_POST['login']=='sigma' and $_POST['mdp']=='sigma')
				  {
				   $_SESSION['user']="utilisateur";
				   header("location:sigma.php?P_Affiche");
				  }
				    
				  }
				
				
				?>
			</div>
		</div>
	</div>
</body>
</html>
