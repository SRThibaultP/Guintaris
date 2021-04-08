<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<?php
if(isset($_POST['username'], $_POST['password'], $_POST['passverif']) and $_POST['username']!='')
{
	
	//On enleve lechappement si get_magic_quotes_gpc est active
	if(get_magic_quotes_gpc())
	{
		$_POST['username'] = stripslashes($_POST['username']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
	}
	if($_POST['password']==$_POST['passverif'])
	{
		if(strlen($_POST['password'])>=6)
		{
				$username = mysqli_real_escape_string($link,$_POST['username']);
				$password = mysqli_real_escape_string($link,$_POST['password']);
				echo 'insert into joueur( nom, password, ) values ( "'.$username.'", "'.$password.'")';
				$dn = mysqli_num_rows(mysqli_query($link,'select id from joueur where nom="'.$username.'"'));
				if($dn==0)
				{
					//On enregistre les informations dans la base de donnee
					if(mysqli_query($link,'insert into joueur( nom, password ) values ( "'.$username.'", "'.$password.'")'))
					{
                        header("location: index.php");
                        exit;
					}
					else
					{
						$message = 'Une erreur est survenue lors de l\'inscription.';
					}
				}
				else
				{
					$message = 'Un autre utilisateur utilise déjà le nom d\'utilisateur que vous désirez utiliser.';
				}
			}
		}
		else
		{

			$message = 'Le mot de passe que vous avez entré contien moins de 6 caractères.';
		}
	}
	else
	{
		$message = 'Les mots de passe que vous avez entré ne sont pas identiques.';
	}

	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}
	//On affiche le formulaire
?>
    	<a href="<?php echo $url_home; ?>">Index du Forum</a>
</div>
    <form action="signup.php" method="post">
        Veuillez remplir ce formulaire pour vous inscrire:<br />
        <div class="center">
            <label for="username">Nom d'utilisateur</label>
			<input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="password">Mot de passe<span class="small">(6 caract&egrave;res min.)</span></label>
			<input type="password" name="password" /><br />
            <label for="passverif">Mot de passe<span class="small">(v&eacute;rification)</span></label>
			<input type="password" name="passverif" /><br />
            <input type="submit" value="Envoyer" />
		</div>
    </form>
</div>
	</body>
</html> 