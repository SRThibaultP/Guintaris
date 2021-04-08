<?php
	//Cette page permet dafficher la liste des categories
	include('config.php');
	if (isset($_SESSION['persoID'])){
		unset($_SESSION['persoID']);
	}
?>
<html">
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		<title>index</title>
	</head>
	<body>
	
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<?php
		if(isset($_SESSION['username']))
		{
	?>
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href= "espaceuser.php"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href = "login.php">deconnexion</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="new_perso.php">nouveau personnage</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="mesPerso.php">mes Pers</a>
						</li>
					</ul>
	<?php
		}
		else {
	?>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href = "signup.php">inscription</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href = "login.php">connexion</a>
						</li>
					</ul>
	<?php
		}
	?>			
				</div>
			</div>
		</nav>
		
		
		<p>le text de presentation<p>
	</body>
</html>
