<?php
//Cette page permet dafficher la liste des categories
include('config.php');
?>
<html">
    <head>
		<link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>index</title>
    </head>
    <body>
	<?php
		if(isset($_SESSION['username']))
		{
	?>
	<a href= "espaceuser.php"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
	<a href = "login.php">deconnexion</a>
	<a href="new_perso.php">nouveau personnage</a>
	<a href="mesperso.php">mes Pers</a>
	
	<?php
		if (isset($_SESSION['persoID'])){
			unset($_SESSION['persoID']);
		}
		}
		else {
	?>
		<a href = "signup.php">inscription</a>
		<a href = "login.php">connexion</a>
	<?php
		}
	?>
	<p>le text de presentation<p>
	</body>
</html>
	